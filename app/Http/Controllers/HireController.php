<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\JobRolesForHiring;
use Illuminate\Http\Request;

class HireController extends Controller
{
    public function index()
    {
        $jobRoles= JobRolesForHiring::all();
        $instructors=Instructor::where('is_active',1)->get();
        return view('website.Hire_With_US',compact('jobRoles','instructors'));
    }

    public function storeMentor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
            'teaching_hours' => 'required|integer|min:0',
            'specialization' => 'required|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'phone_number' => 'required|string|digits:10',
        ]);

        
        Instructor::create([
            'name' => $request->name,
            'image' => null, // Explicitly set to null since images are not stored
            'teaching_hours' => $request->teaching_hours,
            'specialization' => $request->specialization,
            'linkedin_url' => $request->linkedin_url,
            'facebook_url' => $request->facebook_url,
            'phone_number' => $request->phone_number,
            'is_active' => 0, // Set to inactive pending review
        ]);

        return redirect()->route('hire.index')->with('success', 'Mentor application submitted successfully. Awaiting review.');
    }
}
