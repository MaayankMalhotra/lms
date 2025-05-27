<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User; 
class AdminController extends Controller
{
    public function student_management()
    {
        $students = User::where('role', 3)->get();
    return view('admin.studentmanagement', compact('students'));
    }
     public function trainer_management()
    {
        $students = User::where('role', 2)->get();
    return view('admin.trainermanagement', compact('students'));
    }





    public function editTrainer($id)
    {
        $trainer = User::findOrFail($id);
        return response()->json([
            'id' => $trainer->id,
            'name' => $trainer->name,
            'email' => $trainer->email,
            'phone' => $trainer->phone ?? '',
        ]);
    }

    public function updateTrainer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
        ]);

        $trainer = User::findOrFail($id);
        $trainer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.trainer_management')->with('success', 'Trainer updated successfully');
    }

    public function deleteTrainer($id)
    {
        $trainer = User::findOrFail($id);
        $trainer->delete();
        return redirect()->route('admin.trainer_management')->with('success', 'Trainer deleted successfully');
    }
}
