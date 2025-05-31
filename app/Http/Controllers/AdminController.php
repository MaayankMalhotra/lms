<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\TrainerDetail;
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
    
    public function trainer_management(){
        $students = User::where('role', 2)->get();
        $courses = Course::select('id', 'name')->get();
        $availableTrainers = User::where('role', 2)
            ->whereDoesntHave('trainerDetail')
            ->select('id', 'name', 'email')
            ->get();
        return view('admin.trainermanagement', compact('students', 'courses', 'availableTrainers'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id,role,2',
            'experience' => 'required|string|max:255',
            'teaching_hours' => 'required|integer|min:0',
            'course_ids' => 'nullable|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        // Prevent duplicate TrainerDetail for the same user
        if (TrainerDetail::where('user_id', $validated['user_id'])->exists()) {
            return redirect()->back()->withErrors(['user_id' => 'This user is already a trainer.']);
        }

        TrainerDetail::create([
            'user_id' => $validated['user_id'],
            'experience' => $validated['experience'],
            'teaching_hours' => $validated['teaching_hours'],
            'course_ids' => !empty($validated['course_ids']) ? json_encode($validated['course_ids']) : null,
        ]);

        return redirect()->route('trainer-management')->with('success', 'Trainer created successfully!');
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
