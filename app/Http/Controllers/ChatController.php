<?php
namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $currentUser = auth()->user();
        $teachers = collect();
        $students = collect();

        if ($currentUser->role == '3') {
            // Student hai, toh uska assigned teacher fetch karo
            $teachers = DB::table('enrollments')
                ->join('batches', 'enrollments.batch_id', '=', 'batches.id')
                ->join('users', 'batches.teacher_id', '=', 'users.id')
                ->where('enrollments.user_id', $currentUser->id)
                ->where('enrollments.status', 'active')
                ->where('users.role', '2')
                ->select('users.id', 'users.name')
                ->get();
        } elseif ($currentUser->role == '2') {
            // Teacher hai, toh saare students fetch karo
            $students = User::where('role', '3')->get();
        }
       

        return view('chat.index', compact('teachers', 'students'));
    }

    public function fetchMessages($receiverId)
    {
        $messages = Message::where(function ($query) use ($receiverId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', auth()->id());
        })->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        event(new MessageSent($message));

        return response()->json(['status' => 'Message Sent!']);
    }
}