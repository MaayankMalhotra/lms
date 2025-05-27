<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User; 
class AdminController extends Controller
{
    public function student_management()
    {
        $trainers = User::where('role', 3)->get();
    return view('admin.studentmanagement', compact('trainers'));
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
        try {
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

            return response()->json(['message' => 'Trainer updated successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Update Trainer Error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update trainer'], 500);
        }
    }

    public function deleteTrainer($id)
    {
        try {
            $trainer = User::findOrFail($id);
            $trainer->delete();
            return response()->json(['message' => 'Trainer deleted successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Delete Trainer Error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete trainer'], 500);
        }
    }
}
