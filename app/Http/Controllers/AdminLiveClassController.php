<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\LiveClass;
use App\Models\Recording;
use Illuminate\Http\Request;

class AdminLiveClassController extends Controller
{
    public function index()
    {
        $batches = Batch::with('course', 'liveClasses')->get();
        return view('admin.live_classes.index', compact('batches'));
    }

    public function create()
    {
        $batches = Batch::with('course')->get();
        return view('admin.live_classes.create', compact('batches'));
    }

    public function getRecordings($batchId)
    {
        $batch = Batch::findOrFail($batchId);
        $courseId = $batch->course_id;
        $recordings = Recording::where('course_id', $courseId)
            ->get(['id', 'topic']);
        return response()->json($recordings);
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'google_meet_link' => 'required|url',
            'class_datetime' => 'required|date',
            'duration_minutes' => 'required|integer|min:1',
            'recording_id' => 'nullable|exists:recordings,id',
        ]);

        $recording = $request->recording_id ? Recording::find($request->recording_id) : null;

        $liveClass = LiveClass::create([
            'batch_id' => $request->batch_id,
            'topic' => $recording ? $recording->topic : 'Untitled Live Class',
            'google_meet_link' => $request->google_meet_link,
            'class_datetime' => $request->class_datetime,
            'duration_minutes' => $request->duration_minutes,
            'status' => 'Scheduled',
        ]);

        if ($recording) {
            $recording->update(['live_class_id' => $liveClass->id]);
        }

        return redirect()->route('admin.live_classes.index')->with('success', 'Live class created successfully');
    }

    public function edit($id)
    {
        $liveClass = LiveClass::findOrFail($id);
        $batches = Batch::with('course')->get();
        return view('admin.live_classes.index', compact('liveClass', 'batches')); // Load into index for modal
    }

    public function update(Request $request, $id)
    {
        $liveClass = LiveClass::findOrFail($id);    

        $recording = $request->recording_id ? Recording::find($request->recording_id) : null;
        $liveClass->update([
            'batch_id' => $request->batch_id,
            'topic' => $recording ? $recording->topic : 'Untitled Live Class',
            'google_meet_link' => $request->google_meet_link,
            'class_datetime' => $request->class_datetime,
            'duration_minutes' => $request->duration_minutes,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.live_classes.index')->with('success', 'Live class updated successfully');
    }

    public function destroy($id)
    {
        $liveClass = LiveClass::findOrFail($id);
        $liveClass->delete();
        return redirect()->route('admin.live_classes.index')->with('success', 'Live class deleted successfully');
    }
}
