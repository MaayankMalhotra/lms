<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use App\Models\LiveClass;
use App\Models\Recording;
use Illuminate\Http\Request;

class AdminRecordingController extends Controller
{
    public function index()
    {
        $recordings = Recording::with('course')->get(); // Fetch recordings with courses
        $courses = Course::all(); // Fetch all courses for the edit modal
        return view('admin.recordings.index', compact('recordings', 'courses'));
    }

    public function create()
    {
        $courses = Course::all(); // Fetch all courses for dropdown
        return view('admin.recordings.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'topic' => 'required|string|max:255',
            'video_url' => 'required|url',
        ]);

        Recording::create([
            'course_id' => $request->course_id,
            'topic' => $request->topic,
            'video_url' => $request->video_url,
            'uploaded_at' => now(),
        ]);

        return redirect()->route('admin.recordings.index')->with('success', 'Recording added successfully');
    }

    public function edit($id)
    {
        $recording = Recording::findOrFail($id);
        $courses = Course::all();
        $recordings = Recording::with('course')->get(); // Pass recordings for index consistency
        return view('admin.recordings.index', compact('recording', 'courses', 'recordings')); // Load into index for modal
    }

    public function update(Request $request, $id)
    {
        $recording = Recording::findOrFail($id);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'topic' => 'required|string|max:255',
            'video_url' => 'required|url',
        ]);

        $recording->update([
            'course_id' => $request->course_id,
            'topic' => $request->topic,
            'video_url' => $request->video_url,
        ]);

        return redirect()->route('admin.recordings.index')->with('success', 'Recording updated successfully');
    }

    public function destroy($id)
    {
        $recording = Recording::findOrFail($id);
        if ($recording->live_class_id) {
            return redirect()->route('admin.recordings.index')->with('error', 'Cannot delete recording linked to a live class.');
        }
        $recording->delete();
        return redirect()->route('admin.recordings.index')->with('success', 'Recording deleted successfully');
    }
}
