<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InternshipController extends Controller
{
    public function create()
    {
        return view('admin.add-internship');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'applicant' => 'required',
            'certified_button' => 'required',
            'price' => 'required|numeric|min:0', // Validate price
        ]);

        // Handle file upload
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('internships'), $imageName);

            // Store only relative path
            $validated['logo'] = 'internships/' . $imageName;
        }

        // Create the internship
        Internship::create($validated);

        return redirect()->route('admin.internship.add')->with('success', 'Internship created successfully!');
    }

    public function internshipList()
    {
        $internships = Internship::latest()->paginate(10);
        return view('admin.internship-list', compact('internships'));
    }

    public function edit(Internship $internship)
    {
        return response()->json($internship);
    }

    public function update(Request $request, Internship $internship)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required|string|max:255',
            'project' => 'required|string|max:255',
            'applicant' => 'required',
            'certified_button' => 'required',
            'price' => 'required|numeric|min:0', // Validate price
        ]);

        // Handle file upload
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($internship->logo && file_exists(public_path($internship->logo))) {
                unlink(public_path($internship->logo));
            }

            $image = $request->file('logo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('internships'), $imageName);

            // Store only relative path
            $validated['logo'] = 'internships/' . $imageName;
        }

        // Update the internship
        $internship->update($validated);

        return redirect()->route('admin.internship.list')->with('success', 'Internship updated successfully!');
    }

    public function destroy(Internship $internship)
    {
        // Delete the logo file if it exists
        if ($internship->logo && file_exists(public_path($internship->logo))) {
            unlink(public_path($internship->logo));
        }

        // Delete the internship record
        $internship->delete();

        return redirect()->route('admin.internship.list')->with('success', 'Internship deleted successfully!');
    }

    public function contentCreate()
    {
        $internships = DB::table('internships')->select('id', 'name')->get();
        return view('admin.content_create', compact('internships'));
    }

    public function contentstore(Request $request)
    {
        $request->validate([
            'internship_id' => 'required|exists:internships,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:5120',
            'deadline' => 'nullable|date|after:today',
        ]);

        $data = $request->only(['internship_id', 'title', 'description', 'deadline']);
        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('content', 'public');
        }
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('internship_contents')->insert($data);

        return redirect()->route('admin.internship.content.create')->with('success', 'Content added.');
    }
}