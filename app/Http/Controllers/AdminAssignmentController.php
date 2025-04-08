<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\LiveClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAssignmentController extends Controller
{
    public function create()
    {
        $liveClasses = LiveClass::all(); // Fetch all live classes for dropdown
        return view('admin.assignment.assignment', compact('liveClasses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'live_class_id' => 'required|exists:live_classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Max 2MB
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assignments', 'public');
        }

        Assignment::create([
            'live_class_id' => $request->live_class_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.assignments.create')->with('success', 'Assignment uploaded successfully!');
    }
}
