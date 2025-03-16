<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Helpers\Pay;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentCreate;
use App\Http\Requests\Payment\PaymentUpdate;
use App\Models\Expense;
use App\Models\PaymentRecord;
use App\Models\Receipt;
use App\Models\Setting;
use App\Repositories\MyClassRepo;
use App\Repositories\PaymentRepo;
use App\Repositories\StudentRepo;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Log;
use PDF;

class PaymentController extends Controller
{
    protected $my_class, $pay, $student, $year;

    public function __construct(MyClassRepo $my_class, PaymentRepo $pay, StudentRepo $student)
    {
        $this->my_class = $my_class;
        $this->pay = $pay;
        $this->year = Qs::getCurrentSession();
        $this->student = $student;

        $this->middleware('teamAccount');
    }

    public function index()
    {
//        $d['selected'] = false;
        $d = $this->pay->getPaymentYears();

        return view('pages.support_team.payments.index', ['p' => $d]);
    }

    public function show($year)
    {
        $d['payments'] = $p = $this->pay->getPayment(['year' => $year])->get();

        if(($p->count() < 1)){
            return Qs::goWithDanger('payments.index');
        }

        $d['selected'] = true;
        $d['my_classes'] = $this->my_class->all();
        $d['years'] = $this->pay->getPaymentYears();
        $d['year'] = $year;

        return view('pages.support_team.payments.index', $d);

    }

    public function select_year(Request $req)
    {
        return Qs::goToRoute(['payments.show', $req->year]);
    }

    public function create()
    {
        $d['p'] = $this->pay->getPaymentYears();
        return view('pages.support_team.payments.create', $d);
    }

    public function invoice($st_id, $year = NULL)
    {
        if(!$st_id) {return Qs::goWithDanger();}

//        $inv = $year ? $this->pay->getAllMyPR($st_id, $year) : $this->pay->getAllMyPR($st_id);

        $d['sr'] = $this->student->findByUserId($st_id)->first();
        $d['payments'] = $this->pay->getPaymentYears();
        $d['month'] = Carbon::now()->format('F Y');
//        $pr = $inv->get();
//        $d['uncleared'] = $pr->where('paid', 0);
//        $d['cleared'] = $pr->where('paid', 1);

        $admissionDate = Carbon::parse($d['sr']->admission_date);
        $currentDate = Carbon::now();

        $payableMonths = [];

        // Loop through all months from admission date till current month
        for ($date = clone $admissionDate->copy(); $date->lessThanOrEqualTo($currentDate); $date->addMonth()) {
            $month = $date->format('F');
            $year = $date->format('Y');
            $existingRecord = PaymentRecord::where('student_id', $d['sr']->id)
                ->where('month', $month)
                ->where('year', $year)
                ->select(['id', 'month', 'year', 'student_id', 'tution_fee', 'khoraki', 'discount', 'due', 'amt_paid'])
                ->first();
            if(!$existingRecord) {
                $payableMonths[] = [
                    'month' => $month,
                    'year' => $year,
                    'tution_fee' => $d['payments']->tution_fee,
                    'khoraki' => $d['payments']->khoraki,
                    'amount' => $d['payments']->amount,
                    'paid' => 0,
                    'amt_paid' => 0,
                    'due' => $d['payments']->tution_fee + $d['payments']->khoraki - $d['sr']->discount,
                    'date_sort' => $date->format('Y-m'),
                ];
            }else{
                $payableMonths[] = [
                    'month' => $month,
                    'year' => $year,
                    'tution_fee' => $existingRecord->tution_fee,
                    'khoraki' => $existingRecord->khoraki,
                    'amount' => $existingRecord->balance,
                    'paid' => $existingRecord->paid,
                    'amt_paid' => $existingRecord->amt_paid,
                    'due' => $existingRecord->due ,
                    'pr_id' => $existingRecord->id ,
                    'date_sort' => $date->format('Y-m'),
                ];
            }

        }
        usort($payableMonths, function ($a, $b) {
            return strcmp($b['date_sort'], $a['date_sort']); // Descending order
        });
        $d['payable_months'] = $payableMonths;




        return view('pages.support_team.payments.invoice', $d);
    }

    public function profit_loss_report()
    {
        $d['payments'] = $this->pay->getPaymentYears();
        $month = $month ?? Carbon::now()->format('F');
        $year = $year ?? Carbon::now()->format('Y');
        $year1 = Carbon::now()->format('Y');   // Get current year (e.g., 2025)
        $month1 = Carbon::now()->format('m');  // Get current month (e.g., 03 for March)

        $totalAdmissionThisMonth = DB::table('student_records')
            ->whereYear('admission_date', $year)   // Extracts year from `admission_date`
            ->whereMonth('admission_date', $month) // Extracts month from `admission_date`
            ->count();

        $totalIncome = DB::table('payment_records')
            ->where('month', $month)
            ->where('year', $year)
            ->sum('amt_paid');

        $totalSalaries = DB::table('salaries')
            ->where('month', $month)
            ->where('year', $year)
            ->sum('amount');

        $totalExpenses = DB::table('expenses')
            ->where('month', $month)
            ->where('year', $year)
            ->sum('amount');

        $totalAdmissionThisMonth = DB::table('student_records')
            ->whereYear('admission_date', $year1)   // Extracts year from `admission_date`
            ->whereMonth('admission_date', $month1) // Extracts month from `admission_date`
            ->count();

        $profitOrLoss = $totalIncome - ($totalSalaries + $totalExpenses) + ($totalAdmissionThisMonth * $d['payments']->admission_fee);

        $d['report'] = [
            'id' => 1,
            'month' => $month,
            'year' => $year,
            'total_income' => $totalIncome,
            'total_salaries' => $totalSalaries,
            'total_expenses' => $totalExpenses,
            'totalAdmissionThisMonth' => $totalAdmissionThisMonth * $d['payments']->admission_fee,
            'profit_or_loss' => $profitOrLoss
        ];
        return view('pages.support_team.Report.profit_loss', $d);
    }
    public function receipts($pr_id)
    {
        if(!$pr_id) {return Qs::goWithDanger();}

        try {
             $d['pr'] = $pr = $this->pay->getRecord(['id' => $pr_id])->with('receipt')->first();
        } catch (ModelNotFoundException $ex) {
            return back()->with('flash_danger', __('msg.rnf'));
        }
        $d['receipts'] = $pr->receipt;
        $d['payment'] = $pr->payment;
        $d['sr'] = $this->student->findByUserId($pr->student_id)->first();
        $d['s'] = Setting::all()->flatMap(function($s){
            return [$s->type => $s->description];
        });

        return view('pages.support_team.payments.receipt', $d);
    }

    public function pdf_receipts($pr_id)
    {
        if(!$pr_id) {return Qs::goWithDanger();}

        try {
            $d['pr'] = $pr = $this->pay->getRecord(['id' => $pr_id])->with('receipt')->first();
        } catch (ModelNotFoundException $ex) {
            return back()->with('flash_danger', __('msg.rnf'));
        }
        $d['receipts'] = $pr->receipt;
        $d['payment'] = $pr->payment;
        $d['sr'] = $sr =$this->student->findByUserId($pr->student_id)->first();
        $d['s'] = Setting::all()->flatMap(function($s){
            return [$s->type => $s->description];
        });

        $pdf_name = 'Receipt_'.$pr->ref_no;

        return PDF::loadView('pages.support_team.payments.receipt', $d)->download($pdf_name);

        //return $this->downloadReceipt('pages.support_team.payments.receipt', $d, $pdf_name);
    }

    protected function downloadReceipt($page, $data, $name = NULL){
        $path = 'receipts/file.html';
        $disk = Storage::disk('local');
        $disk->put($path, view($page, $data) );
        $html = $disk->get($path);
        return PDF::loadHTML($html)->download($name);
    }

    public function pay_now(Request $req)
    {
        $validated = $this->validate($req, [
            'amt_paid' => 'required|numeric',
            'discount' => 'required|numeric',
            'student_id' => 'required',
            'month' => 'required',
            'year' => 'required',
            'pr_id' => 'nullable'
        ], [], ['amt_paid' => 'Amount Paid']);

        $student = $this->student->findByUserId($req->student_id)->first();
        $payments = $this->pay->getPaymentYears();
        $record = '';

        if ($req->pr_id) {
            $pr = $this->pay->findRecord($req->pr_id);
            $subtotal = $pr->tution_fee + $pr->khoraki - $req->discount - $pr->amt_paid;
            $due = $subtotal - $req->amt_paid;

            $data['amt_paid'] = $amt_p = $pr->amt_paid + $req->amt_paid;
            $data['due'] = $due;
            $data['tution_fee'] = $pr->tution_fee;
            $data['khoraki'] = $pr->khoraki;
            $data['paid'] = $due < 1 ? 1 : 0;
            $record = $this->pay->updateRecord($pr->id, $data);
            $d2['pr_id'] = $pr->id;
        }else{
            $subtotal = $payments->tution_fee + $payments->khoraki - $req->discount ;
            $due = $subtotal - $req->amt_paid;
            $due <= 0 ? $pay_status = 1 : $pay_status = 0;

            $data = [
                'tution_fee' => $payments->tution_fee,
                'khoraki' => $payments->khoraki,
                'discount' => $req->discount,
                'due' => $due,
                'paid' => $pay_status,
                'amt_paid' => $req->amt_paid,
                'student_id' => $student->id,
                'department' => $student->department,
                'payment_id' => $payments->id,
                'month' => $req->month,
                'year' => $req->year,
            ];
            $data['ref_no'] = Pay::genRefCode();
            $record = $this->pay->createRecord($data);
            $d2['pr_id'] = $record->id;
        }

        $rcpt = Receipt::where('pr_id', $req->pr_id)->delete();
        $d2['amt_paid'] = $data['amt_paid'];
        $d2['due'] = $data['due'];
        $d2['total'] = $data['tution_fee'] + $data['khoraki'];
        $d2['year'] = $req->year;
        $d2['month'] = $req->month;

        $this->pay->createReceipt($d2);
        return Qs::jsonUpdateOk();


//        $pr = $this->pay->findRecord($req->pr_id);
//        $payment = $this->pay->find($pr->payment_id);
//        $d['amt_paid'] = $amt_p = $pr->amt_paid + $req->amt_paid;
//        $d['balance'] = $bal = $payment->amount - $amt_p;
//        $d['paid'] = $bal < 1 ? 1 : 0;
//
//        $this->pay->updateRecord($req->pr_id, $d);
//
//        $d2['amt_paid'] = $req->amt_paid;
//        $d2['balance'] = $bal;
//        $d2['pr_id'] = $req->pr_id;
//        $d2['year'] = $this->year;
//
//        $this->pay->createReceipt($d2);
//        return Qs::jsonUpdateOk();
    }

    public function manage($class_id = NULL)
    {
        $d['my_classes'] = $this->my_class->all();
        $d['selected'] = false;

        if($class_id){
            $d['students'] = $st = $this->student->getRecord(['my_class_id' => $class_id])->get()->sortBy('user.name');
            if($st->count() < 1){
                return Qs::goWithDanger('payments.manage');
            }
            $d['selected'] = true;
            $d['my_class_id'] = $class_id;
        }else{
            $d['students'] = $st = $this->student->activeStudents()->get()->sortBy('user.name');
            if($st->count() < 1){
                return Qs::goWithDanger('payments.manage');
            }
            $d['selected'] = true;
        }

        return view('pages.support_team.payments.manage', $d);
    }

    public function select_class(Request $req)
    {
        $this->validate($req, [
            'my_class_id' => 'required|exists:my_classes,id'
        ], [], ['my_class_id' => 'Class']);

        $wh['my_class_id'] = $class_id = $req->my_class_id;

        $pay1 = $this->pay->getPayment(['my_class_id' => $class_id, 'year' => $this->year])->get();
        $pay2 = $this->pay->getGeneralPayment(['year' => $this->year])->get();
        $payments = $pay2->count() ? $pay1->merge($pay2) : $pay1;
        $students = $this->student->getRecord($wh)->get();

        if($payments->count() && $students->count()){
            foreach($payments as $p){
                foreach($students as $st){
                    $pr['student_id'] = $st->user_id;
                    $pr['payment_id'] = $p->id;
                    $pr['year'] = $this->year;
                    $rec = $this->pay->createRecord($pr);
                    $rec->ref_no ?: $rec->update(['ref_no' => mt_rand(100000, 99999999)]);

                }
            }
        }

        return Qs::goToRoute(['payments.manage', $class_id]);
    }

    public function store(PaymentCreate $req)
    {
        $data = $req->all();
        $data['title'] = 'Monthly Payment';
        $data['year'] = $this->year;
        $data['amount'] = $req->tution_fee + $req->khoraki;
        $data['ref_no'] = Pay::genRefCode();
        $id = 1;
        $this->pay->update($id, $data);

        return Qs::updateOk('payments.create');
    }

    public function edit($id)
    {
        $d['payment'] = $pay = $this->pay->find($id);

        return is_null($pay) ? Qs::goWithDanger('payments.index') : view('pages.support_team.payments.edit', $d);
    }

    public function update(PaymentUpdate $req, $id)
    {
        $data = $req->all();
        $this->pay->update($id, $data);

        return Qs::jsonUpdateOk();
    }

    public function destroy($id)
    {
        $this->pay->find($id)->delete();

        return Qs::deleteOk('payments.index');
    }

    public function reset_record($id)
    {
        $pr['amt_paid'] = $pr['paid'] = $pr['balance'] = 0;
        $this->pay->updateRecord($id, $pr);
        $this->pay->deleteReceipts(['pr_id' => $id]);

        return back()->with('flash_success', __('msg.update_ok'));
    }
}
