<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\User;
use Illuminate\Http\Request;

class CourseDetailsController extends Controller
{
    public function index(){
        $course_name  = Course::all();
        $instructors = User::where('role',2)->get();
     return view('course-details-index',compact('instructors','course_name'));
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'course_curriculum' => 'nullable|array',
            'course_curriculum.*.module_number' => 'required|string',
            'course_curriculum.*.title' => 'required|string',
            'course_curriculum.*.duration' => 'required|string',
            'course_curriculum.*.description' => 'required|string',
            'course_curriculum.*.topics' => 'nullable|array',
            'course_curriculum.*.topics.*.category' => 'required|string',
            'course_curriculum.*.topics.*.subtopics' => 'required|string'
        ]);

        // Handle file upload
        $bannerPath = null;
        if ($request->hasFile('course_banner')) {
            $bannerPath = $request->file('course_banner')->store('banners', 'public');
        }

   // Process topics: Convert subtopics textarea into an array
   if (isset($validated['course_curriculum'])) {
    foreach ($validated['course_curriculum'] as &$module) {
        if (isset($module['topics'])) {
            foreach ($module['topics'] as &$topic) {
                $topic['subtopics'] = array_filter(array_map('trim', explode("\n", $topic['subtopics'])));
            }
        }
    }
}

        // Store data in course_details table
        CourseDetail::create([
            'course_name' => $request->course_name,
            'course_description' => $request->course_description,
            'course_rating' => $request->course_rating,
            'course_rating_student_number' => $request->course_rating_student_number,
            'course_learner_enrolled' => $request->course_learner_enrolled,
            'course_lecture_hours' => $request->course_lecture_hours,
            'course_problem_counts' => $request->course_problem_counts,
            'course_banner' => $bannerPath,
            'key_points' => $request->points,
            'course_overview_description' => $request->course_overview_description,
            'learning_outcomes' => $request->learning_outcomes,
            'instructor_info' => $request->instructor_info,
            'course_curriculum' => $validated['course_curriculum'] ?? [],
            'instructor_ids' => $request->instructor_ids,
            'faqs' => $request->faqs
        ]);

        return redirect()->back()->with('success', 'Course details saved successfully!');
    }
}
