<?php
//
//namespace App\Http\Controllers;
//
//use Illuminate\Http\Request;
//use App\Models\Salary;
//use App\User; // Updated import statement
//
//class SalaryController extends Controller
//{
//    public function index()
//    {
//        $salaries = Salary::with(['user', 'receiverUser'])->get();
//        return view('pages.support_team.salary.list', compact('salaries'));
//    }
//
//    public function create()
//    {
//        $users = User::all();
//        return view('pages.support_team.salary.create', compact('users'));
//    }
//
//    public function store(Request $request)
//    {
//        $validated = $request->validate([
//            'user_id' => 'required|integer|exists:users,id',
//            'receiver' => 'required|integer|exists:users,id',
//            'amount' => 'required|numeric|min:0',
//            'month' => 'required|string|max:20',
//            'year' => 'required|string|max:4',
//            'type' => 'required|in:yearly,monthly',
//        ]);
//
//        Salary::create($validated);
//        return redirect()->route('salaries.index')->with('success', 'Salary created successfully');
//    }
//
//    public function show($id)
//    {
//        $salary = Salary::findOrFail($id);
//        return view('pages.support_team.salary.show', compact('salary'));
//    }
//
//    public function edit($id)
//    {
//        $salary = Salary::findOrFail($id);
//        $users = User::all();
//        return view('pages.support_team.salary.edit', compact('salary', 'users'));
//    }
//
//    public function update(Request $request, $id)
//    {
//        $validated = $request->validate([
//            'user_id' => 'required|integer|exists:users,id',
//            'receiver' => 'required|integer|exists:users,id',
//            'amount' => 'required|numeric|min:0',
//            'month' => 'required|string|max:20',
//            'year' => 'required|string|max:4',
//            'type' => 'required|in:yearly,monthly',
//        ]);
//
//        $salary = Salary::findOrFail($id);
//        $salary->update($validated);
//        return redirect()->route('salaries.index')->with('success', 'Salary updated successfully');
//    }
//
//    public function destroy($id)
//    {
//        $salary = Salary::findOrFail($id);
//        $salary->delete();
//        return redirect()->route('salaries.index')->with('success', 'Salary deleted successfully');
//    }
//}


namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\User;

// Updated import statement
use Qs;

// Ensure Qs is correctly imported

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with(['user', 'receiverUser'])->get();
        return view('pages.support_team.salary.list', compact('salaries'));
    }

    public function create()
    {
        $users = User::all();
        return view('pages.support_team.salary.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'type' => 'required|in:yearly,monthly',
        ]);
        $date = $request->input('date', Carbon::now()->toDateString()); // Default to current date if not provided
        $carbonDate = Carbon::parse($date);
        $month = $carbonDate->format('F');
        $year = $carbonDate->format('Y');
        $validated['user_id'] = auth()->user()->id;
        $validated['month'] = $month;
        $validated['year'] = $year;

        Salary::create($validated);
        return Qs::storeOk('salaries.index'); // Updated to use Qs helper
    }

    public function show($id)
    {
        $salary = Salary::findOrFail($id);
        return view('pages.support_team.salary.show', compact('salary'));
    }

    public function edit($id)
    {
        $salary = Salary::findOrFail($id);
        $users = User::all();
        return view('pages.support_team.salary.edit', compact('salary', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'receiver' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'month' => 'required|string|max:20',
            'year' => 'required|string|max:4',
            'type' => 'required|in:yearly,monthly',
        ]);

        $salary = Salary::findOrFail($id);
        $salary->update($validated);
        return Qs::updateOk('salaries.index'); // Updated to use Qs helper
    }

    public function destroy($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();
        return Qs::deleteOk('salaries.index'); // Updated to use Qs helper
    }
}
