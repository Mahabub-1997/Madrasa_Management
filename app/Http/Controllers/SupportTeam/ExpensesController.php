<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return view('pages.support_team.Expense.list',['expenses'=>$expenses]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'purpose' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'month' => 'required|string',
            'year' => 'required|integer',
            'type' => 'required|in:monthly,yearly',
        ]);

        // Prepare the data
        $data = [
            'purpose' => $request->purpose,
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
            'type' => $request->type,
            'user_id' => auth()->user()->id, // Store the authenticated user's ID
        ];
        Expense::insert($data);
        return Qs::jsonStoreOk();
    }


    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('pages.support_team.expense.edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'purpose' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer',
            'type' => 'required|in:monthly,yearly',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update($validatedData);

        return Qs::updateOk('expenses.index');
    }

    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        return QS::DeleteOk('expenses.index');
    }
}
