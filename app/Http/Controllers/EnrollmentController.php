<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('user', 'batch.course', 'batch.teacher', 'payment')->paginate(10);
        
        return view('admin.enrollments', compact('enrollments'));
    }

    public function edit($id)
    {
        $enrollment = Enrollment::with('user', 'batch.course', 'batch.teacher', 'payment')->findOrFail($id);
        return response()->json([
            'id' => $enrollment->id,
            'student_name' => $enrollment->user->name ?? 'N/A',
            'course_name' => $enrollment->batch->course->name ?? 'N/A',
            'batch_name' => $enrollment->batch->name ?? 'N/A',
            'teacher_name' => $enrollment->batch->teacher->name ?? 'N/A',
            'start_date' => $enrollment->batch->start_date 
                ? \Carbon\Carbon::parse($enrollment->batch->start_date)->format('F d, Y') 
                : 'N/A',
            'amount' => $enrollment->payment ? number_format($enrollment->payment->amount, 2) : 'N/A', // Add amount
            'status' => $enrollment->status,
        ]);
    }

    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update([
            'status' => $request->status,
        ]);
        return redirect()->route('admin.enrollment.index')->with('success', 'Enrollment updated successfully!');
    }

    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();
        return redirect()->route('admin.enrollment.index')->with('success', 'Enrollment deleted successfully!');
    }
    public function approve($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        if ($enrollment->canBeApproved()) {
            $enrollment->update(['status' => 'approved']);
            return redirect()->route('admin.enrollment.index')->with('success', 'Enrollment approved successfully!');
        }
        return redirect()->route('admin.enrollment.index')->with('error', 'Enrollment cannot be approved.');
    }
}