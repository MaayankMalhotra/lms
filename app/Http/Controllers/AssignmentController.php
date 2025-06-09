<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function assignment()
    {
        // Get batch_id for the authenticated user
        $batch = DB::selectOne('SELECT batch_id FROM enrollments WHERE user_id = ? LIMIT 1', [Auth::id()]);
        
        if (!$batch) {
            return view('student.assignment.assignment', ['liveClasses' => []]);
        }

        // Fetch live classes with assignments and submission status
        $liveClasses = DB::select("
            SELECT lc.id AS live_class_id, 
                   lc.batch_id, 
                   lc.topic, 
                   lc.class_datetime, 
                   a.id AS assignment_id, 
                   a.title AS assignment_title, 
                   a.description AS assignment_description, 
                   a.due_date AS assignment_due_date, 
                   a.file_path AS assignment_file_path,
                   (SELECT COUNT(*) 
                    FROM assignment_submissions asub 
                    WHERE asub.assignment_id = a.id 
                    AND asub.user_id = ?) AS has_submission
            FROM live_classes lc
            LEFT JOIN assignments a ON lc.id = a.live_class_id
            WHERE lc.batch_id = ?
            ORDER BY lc.class_datetime ASC
        ", [Auth::id(), $batch->batch_id]);

        // Group results to structure like Eloquent collections
        $liveClasses = collect($liveClasses)->groupBy('live_class_id')->map(function ($classes) {
            $first = $classes->first();
            $liveClass = (object) [
                'id' => $first->live_class_id,
                'batch_id' => $first->batch_id,
                'topic' => $first->topic,
                'class_datetime' => $first->class_datetime,
                'assignments' => $classes->filter(function ($item) {
                    return !is_null($item->assignment_id);
                })->map(function ($item) {
                    return (object) [
                        'id' => $item->assignment_id,
                        'title' => $item->assignment_title,
                        'description' => $item->assignment_description,
                        'due_date' => $item->assignment_due_date,
                        'file_path' => $item->assignment_file_path,
                        'file_url' => $item->assignment_file_path ? Storage::url($item->assignment_file_path) : null,
                        'has_submission' => $item->has_submission > 0,
                    ];
                })->values(),
            ];
            return $liveClass;
        })->values();

        return view('student.assignment.assignment', compact('liveClasses'));
    }

    public function submitAssignment(Request $request, $assignmentId)
    {
        $request->validate([
            'submission_file' => 'required|file|mimes:pdf,doc,docx,zip|max:20480', // 20MB max
        ]);

        // Verify assignment exists and get live_class_id
        $assignment = DB::selectOne('SELECT id, live_class_id FROM assignments WHERE id = ?', [$assignmentId]);
        if (!$assignment) {
            return redirect()->back()->with('error', 'Assignment not found.');
        }

        // Store the file
        $file = $request->file('submission_file');
        $fileName = time() . '_' . Auth::id() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('assignment_submissions', $fileName, 'public');

        // Insert submission record
        DB::insert("
            INSERT INTO assignment_submissions (user_id, live_class_id, assignment_id, file_path, created_at, updated_at)
            VALUES (?, ?, ?, ?, NOW(), NOW())
        ", [Auth::id(), $assignment->live_class_id, $assignmentId, $filePath]);

        return redirect()->back()->with('success', 'Assignment submitted successfully!');
    }
}
