<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Communication;
use App\Models\UserType;
use Illuminate\Support\Facades\Auth;

class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Display all communications and the form
    public function index()
    {
        // Load all communication messages with sender and receiver relationships
        $messages = Communication::with(['sender', 'receiver'])->latest()->get();

        // Load all users and user types
        $users = User::all();
        $user_types = UserType::all(); // Make sure you have a UserType model and table

        return view('pages.support_team.communication.sms-list', compact('messages', 'users', 'user_types'));
    }

//    public function store(Request $request)
//    {
//        $validated = $request->validate([
//            'user_type'    => 'required',
//            'receiver_id'  => 'required|exists:users,id',
//            'title'        => 'required|string|max:255',
//            'body'         => 'required|string',
//        ]);
//
//        Communication::create([
//            'sender_id'   => auth()->id(),
//            'sender_type' => $request->user_type,
//            'receiver_id' => $request->receiver_id,
//            'title'       => $request->title,
//            'body'        => $request->body,
//        ]);
//
//        return back()->with('flash_success', 'বার্তা সফলভাবে প্রেরণ করা হয়েছে');
//    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
        ]);

        $validated['sender_id'] = auth()->id();             // ✅ ফিক্সড প্রেরক
        $validated['sender_type'] = 'SupportTeam';          // অথবা আপনার নির্দিষ্ট টাইপ দিন

        Communication::create($validated);

        return redirect()->back()->with('flash_success', 'এসএমএস  সফলভাবে প্রেরণ করা হয়েছে।');
    }



    public function edit($id)
    {
        $message = Communication::findOrFail($id);
        $users = User::all(); // For both sender_type dropdown and receiver_id dropdown
        return view('pages.support_team.communication.sms-list-edit', compact('message', 'users'));
    }

    public function update(Request $request, $id)
    {
        $message = Communication::findOrFail($id);

        $validated = $request->validate([
            'user_type'    => 'required',
            'receiver_id'  => 'required|exists:users,id',
            'title'        => 'required|string|max:255',
            'body'         => 'required|string',
        ]);

        $message->update([
            'sender_type' => $validated['user_type'],
            'receiver_id' => $validated['receiver_id'],
            'title'       => $validated['title'],
            'body'        => $validated['body'],
            // Optional: Update sender_id if needed
            // 'sender_id' => Auth::id(),
        ]);

        return redirect()->route('communication.index')->with('flash_success', 'এসএমএস সফলভাবে আপডেট করা হয়েছে।');
    }


    public function show($id)
    {
        return redirect()->route('communication.index');
    }


    public function destroy($id)
    {
        $message = Communication::findOrFail($id);
        $message->delete();

        return redirect()->route('communication.index')->with('flash_success', 'এসএমএস সফলভাবে মুছে ফেলা হয়েছে।');
    }

}
