<?php
namespace App\Http\Controllers;

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
        $selectedReceiverId = null;

        if ($currentUser->role == '3') { // Student
            $teacher = DB::table('enrollments')
                ->join('batches', 'enrollments.batch_id', '=', 'batches.id')
                ->join('users', 'batches.teacher_id', '=', 'users.id')
                ->where('enrollments.user_id', $currentUser->id)
                ->where('enrollments.status', 'active')
                ->where('users.role', '2')
                ->select('users.id', 'users.name')
                ->first();

            if ($teacher) {
                $teachers = collect([$teacher]);
                $selectedReceiverId = $teacher->id;
            }
        } elseif ($currentUser->role == '2') { // Teacher
            $students = User::where('role', '3')
                ->whereIn('id', function ($query) use ($currentUser) {
                    $query->select('sender_id')
                        ->from('messages')
                        ->where('receiver_id', $currentUser->id)
                        ->whereNotIn('sender_id', function ($subQuery) use ($currentUser) {
                            $subQuery->select('receiver_id')
                                ->from('messages')
                                ->where('sender_id', $currentUser->id);
                        });
                       // ->orderBy('id');
                })
                ->select('id', 'name')
                ->get();

            if ($students->isNotEmpty()) {
                $selectedReceiverId = $students->first()->id;
            }
        }

        return view('chat.index', compact('teachers', 'students', 'selectedReceiverId'));
    }

    public function fetchMessages($receiverId)
    {
        $messages = Message::where(function ($query) use ($receiverId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', auth()->id());
        })
        ->select('sender_id', DB::raw('COUNT(*) as message_count'), DB::raw('MAX(message) as last_message'), DB::raw('MAX(created_at) as last_message_time'))
        ->groupBy('sender_id')
        ->orderBy('id')
        ->get();

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

        return response()->json(['status' => 'Message Sent!', 'receiver_id' => $request->receiver_id]);
    }
}