<?php

namespace App\Http\Controllers;

use App\Models\InternshipBatch;
use App\Models\InternshipClass;
use App\Models\InternshipEnrollment;
use Illuminate\Http\Request;

class InternshipEnrollmentController extends Controller
{
    public function assignBatchView(){
        $batches = InternshipBatch::all();
        $students = InternshipEnrollment::all();
        return view('admin.internship-enrollments.assign-view', compact('batches', 'students'));
    }

    public function assignStudentsToBatch(Request $request)
{
    $request->validate([
        'batch_id' => 'required|exists:internship_batches,id',
        'student_ids' => 'required|array',
        'student_ids.*' => 'exists:internship_enrollments,id',
    ]);
    $batch = InternshipBatch::findOrFail($request->batch_id);
    $batch->students()->syncWithoutDetaching($request->student_ids);
    

    return redirect()->back()->with('success', 'Students assigned to batch successfully.');
}

  // Handle the update of internship class


}
