<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\TrainerDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Log;
class AdminController extends Controller
{
    public function trainer_management(){
        $trainers = User::where('role', 2)
                ->with('trainerDetail')
                ->get()
                ->map(function ($user) {
            $trainer = $user->trainerDetail;
            $courses = [];

            if ($trainer && $trainer->course_ids) {
                $decoded = json_decode($trainer->course_ids, true); // could be ["18,16,17"] or [18,16,17]
                $ids = [];

                // ✅ Handle both old (["18,16,17"]) and new ([18,16,17]) formats
                if (is_array($decoded)) {
                    if (count($decoded) === 1 && is_string($decoded[0]) && str_contains($decoded[0], ',')) {
                        $ids = explode(',', $decoded[0]);
                    } else {
                        $ids = $decoded;
                    }

                    $ids = array_map('intval', $ids); // ensure integers
                    $courses = Course::whereIn('id', $ids)->pluck('name')->toArray();
                }
            }
            $user->course_names = $courses ? implode(', ', $courses) : 'None';

            return $user;  // <-- Important: return the modified user!
        });
        $courses = Course::select('id', 'name')->get();
        $availableTrainers = User::where('role', 2)
            ->whereDoesntHave('trainerDetail')
            ->select('id', 'name', 'email')
            ->get();
        return view('admin.trainermanagement', compact('trainers', 'courses', 'availableTrainers'));
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

    public function edit($id)
    {
        $trainerDetail = TrainerDetail::findOrFail($id);
        $courseIds = $trainerDetail->course_ids ? json_decode($trainerDetail->course_ids, true) : [];
        $courseIds = array_map('intval', $courseIds); // Convert to integers
        return response()->json([
            'id' => $trainerDetail->id,
            'user_id' => $trainerDetail->user_id,
            'experience' => $trainerDetail->experience,
            'teaching_hours' => $trainerDetail->teaching_hours,
            'course_ids' => $courseIds,
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id,role,2',
            'experience' => 'required|string|max:255',
            'teaching_hours' => 'required|integer|min:0',
            'course_ids' => 'nullable|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $trainerDetail = TrainerDetail::findOrFail($id);

        // Check if another trainer detail exists for the same user_id (excluding current record)
        if (TrainerDetail::where('user_id', $validated['user_id'])->where('id', '!=', $id)->exists()) {
            return response()->json(['errors' => ['user_id' => ['This user is already a trainer.']]], 422);
        }

        $trainerDetail->update([
            'user_id' => $validated['user_id'],
            'experience' => $validated['experience'],
            'teaching_hours' => $validated['teaching_hours'],
            'course_ids' => !empty($validated['course_ids']) ? json_encode($validated['course_ids']) : null,
        ]);

        return response()->json(['message' => 'Trainer updated successfully!']);
    }

    public function destroy($id)
    {
        $trainerDetail = TrainerDetail::findOrFail($id);
        $trainerDetail->delete();
        if (request()->ajax()) {
        return response()->json(['success' => true, 'message' => 'Trainer deleted successfully']);
        }
        return redirect()->route('trainer-management')->with('success', 'Trainer deleted successfully!');
    }


public function student_management()
    {
        $students = User::where('role', 3)->get()->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'phone' => $student->phone ?? 'N/A',
                'created_at' => $student->created_at,
            ];
        });

        return view('admin.studentmanagement', compact('students'));
    }

    public function editStudent($id)
    {
        $student = User::findOrFail($id);

        return response()->json([
            'id' => $student->id,
            'name' => $student->name,
            'email' => $student->email,
            'phone' => $student->phone ?? '',
        ]);
    }

    public function updateStudent(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'phone' => 'nullable|string|max:20',
            ]);

            $student = User::findOrFail($id);
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            return response()->json(['message' => 'Student updated successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Update Student Error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update student'], 500);
        }
    }

    public function deleteStudent($id)
    {
        try {
            $student = User::findOrFail($id);
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Delete Student Error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete student'], 500);
        }
    }
}
