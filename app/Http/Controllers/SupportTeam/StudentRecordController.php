<?php
namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Helpers\Mk;
use App\Http\Requests\Student\StudentRecordCreate;
use App\Http\Requests\Student\StudentRecordUpdate;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\StudentRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentRecordController extends Controller
{
    protected $loc, $my_class, $user, $student;

    /**
     * Constructor to initialize repositories and middleware
     */
    public function __construct(LocationRepo $loc, MyClassRepo $my_class, UserRepo $user, StudentRepo $student)
    {
        $this->middleware('teamSA', ['only' => ['edit', 'update', 'reset_pass', 'create', 'store', 'graduated']]);
        $this->middleware('super_admin', ['only' => ['destroy']]);
        $this->loc = $loc;
        $this->my_class = $my_class;
        $this->user = $user;
        $this->student = $student;
    }

    /**
     * Reset a student's password to default
     */
    public function reset_pass($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        $data['password'] = Hash::make('student');
        $this->user->update($st_id, $data);
        return back()->with('flash_success', __('msg.p_reset'));
    }

    /**
     * Display the form to create a new student record
     */
    public function create()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        $data['states'] = $this->loc->getStates();
        $data['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.students.add', $data);
    }

    /**
     * Store a new student record
     */
    public function store(StudentRecordCreate $req)
    {
        $userData = $req->only(['email', 'phone', 'phone2', 'gender']);
        $userData['user_type'] = 'student';
        $userData['name'] = $req->student_name;
        $userData['password'] = Hash::make('student');
        $userData['photo'] = Qs::getDefaultUserImage();

        if ($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo_' . time() . '.' . $f['ext'];

            // Store in the public disk under storage/app/public/students/{student_name}
            $filePath = $photo->storeAs('public/students/' . $userData['name'], $f['name']);

            // Convert storage path to public URL
            $userData['photo'] = 'students/' . $userData['name'] . '/' . $f['name'];
        }

        $userData['code'] = strtoupper(Str::random(10));
        $user = $this->user->create($userData);

        $srData = $req->except(['email', 'phone', 'phone2', 'gender', 'photo']);
        $srData['user_id'] = $user->id;
        $srData['session'] = Qs::getSetting('current_session');

        if(!$req->adm_no) {
            $ct = $this->my_class->findTypeByClass($req->my_class_id)->code;
            $srData['adm_no'] = strtoupper(Qs::getAppCode() . '/' . $ct . '/' . $srData['year_admitted'] . '/' . mt_rand(1000, 99999));
        }

        $srData['student_code'] = $userData['code'];
        $srData['dob'] = date('Y-m-d', strtotime($req->dob));
        $srData['admission_date'] = date('Y-m-d', strtotime($req->admission_date));

        // Store photo in student record as well
        $srData['photo'] = $userData['photo'];

        $this->student->createRecord($srData);

        return Qs::jsonStoreOk('Student added successfully');
    }

    /**
     * List students by class
     */
    public function listByClass($class_id)
    {
//        $data['my_class'] = $mc = $this->my_class->getMC(['id' => $class_id])->first();
//        $data['students'] = $this->student->findStudentsByClass($class_id);
//        $data['sections'] = $this->my_class->getClassSections($class_id);
        $data['students'] = $mc = $this->student->findActiveStudents();
        return is_null($mc) ? Qs::goWithDanger() : view('pages.support_team.students.list', $data);
    }

    /**
     * Display a list of graduated students
     */
    public function graduated()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['students'] = $this->student->allGradStudents();
        return view('pages.support_team.students.graduated', $data);
    }

    /**
     * Mark a student as not graduated
     */
    public function not_graduated($sr_id)
    {
        $d['grad'] = 0;
        $d['grad_date'] = null;
        $d['session'] = Qs::getSetting('current_session');
        $this->student->updateRecord($sr_id, $d);
        return back()->with('flash_success', __('msg.update_ok'));
    }

    /**
     * Display a student's profile
     */
    public function show($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if (!$sr_id) {
            return Qs::goWithDanger();
        }

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();

        if (Auth::user()->id != $data['sr']->user_id && !Qs::userIsTeamSAT() && !Qs::userIsMyChild($data['sr']->user_id, Auth::user()->id)) {
            return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }

        $data['sr']->load('user', 'my_class', 'section');
        return view('pages.support_team.students.show', $data);
    }

    /**
     * Display the form to edit a student's record
     */
    public function edit($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if (!$sr_id) {
            return Qs::goWithDanger();
        }

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        $data['states'] = $this->loc->getStates();
        $data['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.students.edit', $data);
    }

    /**
     * Update a student's record
     */
    public function update(StudentRecordUpdate $req, $sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if (!$sr_id) {
            return Qs::goWithDanger();
        }

        $sr = $this->student->getRecord(['id' => $sr_id])->first();

        // Update user record data
        $userData = $req->only(['email', 'phone', 'phone2', 'gender']);
        $userData['name'] = ucwords($req->student_name);

        if ($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath('student') . $sr->user->name, $f['name']);
            $userData['photo'] = asset('storage/' . $f['path']);
        }

        $this->user->update($sr->user->id, $userData);

        // Update student record data
        $srData = $req->only([
            'my_class_id', 'section_id', 'adm_no', 'my_parent_id', 'discount', 'age', 'year_admitted',
            'admission_date', 'student_name', 'dob', 'father_name', 'mother_name', 'permanent_address',
            'village', 'post_office', 'police_station', 'district', 'guardian_name', 'guardian_relation',
            'guardian_occupation', 'guardian_mobile', 'previous_institution_name', 'previous_institution_address',
            'prev_class_admitted', 'examiner', 'is_residential', 'department'
        ]);
        $srData['session'] = Qs::getSetting('current_session');

        $this->student->updateRecord($sr_id, $srData);

        Mk::deleteOldRecord($sr->user->id, $srData['my_class_id']);

        return Qs::jsonUpdateOk();
    }

    /**
     * Delete a student's record
     */
    public function destroy($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        if (!$st_id) {
            return Qs::goWithDanger();
        }

        $sr = $this->student->getRecord(['user_id' => $st_id])->first();
        $path = Qs::getUploadPath('student') . $sr->user->name;
        Storage::exists($path) ? Storage::deleteDirectory($path) : false;
        $this->user->delete($sr->user->id);

        return back()->with('flash_success', __('msg.del_ok'));
    }
}
