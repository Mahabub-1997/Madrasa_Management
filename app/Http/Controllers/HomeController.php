<?php
namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Models\ClassType;
use App\Models\Expense;
use App\Models\MyClass;
use App\Models\Salary;
use App\Repositories\UserRepo;

class HomeController extends Controller
{
    protected $user;

    public function __construct(UserRepo $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function privacy_policy()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.privacy_policy', $data);
    }

    public function terms_of_use()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.terms_of_use', $data);
    }


    public function dashboard()
    {
        $d = [];

        if (Qs::userIsTeamSAT()) {
            $d['users'] = $this->user->getAll();

            // Load all classes with class_type and students
            $my_classes = MyClass::with(['class_type'])->get();
            $d['countClass'] = count($my_classes);

            // Group classes by class_type name
            $d['grouped_classes'] = $my_classes->groupBy(fn($c) => $c->class_type->name ?? 'Unknown');
        }

        // Total income and expenses (optional if used)
        $d['report'] = [
            'total_expenses' => Expense::sum('amount'),
            'total_income'   => Salary::sum('amount'),
        ];

        return view('pages.support_team.dashboard', $d);
    }
}
