<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseDetailsController extends Controller
{
    public function index()
    {
        $course_name = Course::all();
        $instructors = User::where('role', 2)->get();
        return view('course-details-index', compact('instructors', 'course_name'));
    }

    public function edit($id)
    {
        $courseDetail = CourseDetail::findOrFail($id);
        $course_name = Course::all();
        $instructors = User::where('role', 2)->get();
        return view('course-details-edit', compact('courseDetail', 'instructors', 'course_name'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_curriculum' => 'nullable|array',
            'course_curriculum.*.module_number' => 'required|string',
            'course_curriculum.*.title' => 'required|string',
            'course_curriculum.*.duration' => 'required|string',
            'course_curriculum.*.description' => 'required|string',
            'course_curriculum.*.topics' => 'nullable|array',
            'course_curriculum.*.topics.*.category' => 'required|string',
            'course_curriculum.*.topics.*.subtopics' => 'required|string',
            'demo_syllabus' => 'nullable|array',
            'demo_syllabus.*.module_number' => 'required|string',
            'demo_syllabus.*.title' => 'required|string',
            'demo_syllabus.*.duration' => 'required|string',
            'demo_syllabus.*.description' => 'required|string',
            'demo_syllabus.*.topics' => 'nullable|array',
            'demo_syllabus.*.topics.*.category' => 'required|string',
            'demo_syllabus.*.topics.*.subtopics' => 'required|string',
            'key_features' => 'nullable|array',
            'key_features.*.icon' => 'required|string|max:255',
            'key_features.*.topic' => 'required|string|max:255',
            'key_features.*.description' => 'required|string',
            'certifications' => 'nullable|array',
            'certifications.*.name' => 'required|string|max:255',
            'certificate_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'certificate_description' => 'nullable|array',
            'certificate_description.*.text' => 'required|string',
        ]);

        $bannerPath = null;
        if ($request->hasFile('course_banner')) {
            $bannerPath = $request->file('course_banner')->store('banners', 'public');
        }

        $certificateImagePath = null;
        if ($request->hasFile('certificate_image')) {
            $certificateImagePath = $request->file('certificate_image')->store('certificates', 'public');
        }

        if (isset($validated['course_curriculum'])) {
            foreach ($validated['course_curriculum'] as &$module) {
                if (isset($module['topics'])) {
                    foreach ($module['topics'] as &$topic) {
                        $topic['subtopics'] = array_filter(array_map('trim', explode("\n", $topic['subtopics'])));
                    }
                }
            }
        }

        if (isset($validated['demo_syllabus'])) {
            foreach ($validated['demo_syllabus'] as &$module) {
                if (isset($module['topics'])) {
                    foreach ($module['topics'] as &$topic) {
                        $topic['subtopics'] = array_filter(array_map('trim', explode(',', $topic['subtopics'])));
                    }
                }
            }
        }

        CourseDetail::create([
           // 'course_name' => $request->course_name,
            'course_id' => $request->course_id,
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
            'demo_syllabus' => $validated['demo_syllabus'] ?? [],
            'instructor_ids' => $request->instructor_ids,
            'faqs' => $request->faqs,
            'key_features' => $validated['key_features'] ?? [],
            'certifications' => $validated['certifications'] ?? [],
            'certificate_image' => $certificateImagePath,
            'certificate_description' => $validated['certificate_description'] ?? [],
        ]);

        return redirect()->back()->with('success', 'Course details saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $courseDetail = CourseDetail::findOrFail($id);

        $validated = $request->validate([
            'course_id' => 'required',
            'course_description' => 'nullable|string',
            'course_rating' => 'nullable|numeric|min:0|max:5',
            'course_rating_student_number' => 'nullable|string',
            'course_learner_enrolled' => 'nullable|string',
            'course_lecture_hours' => 'nullable|integer|min:0',
            'course_problem_counts' => 'nullable|integer|min:0',
            'course_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'course_curriculum' => 'nullable|array',
            'course_curriculum.*.module_number' => 'required|string',
            'course_curriculum.*.title' => 'required|string',
            'course_curriculum.*.duration' => 'required|string',
            'course_curriculum.*.description' => 'required|string',
            'course_curriculum.*.topics' => 'nullable|array',
            'course_curriculum.*.topics.*.category' => 'required|string',
            'course_curriculum.*.topics.*.subtopics' => 'required|string',
            'demo_syllabus' => 'nullable|array',
            'demo_syllabus.*.module_number' => 'required|string',
            'demo_syllabus.*.title' => 'required|string',
            'demo_syllabus.*.duration' => 'required|string',
            'demo_syllabus.*.description' => 'required|string',
            'demo_syllabus.*.topics' => 'nullable|array',
            'demo_syllabus.*.topics.*.category' => 'required|string',
            'demo_syllabus.*.topics.*.subtopics' => 'required|string',
            'key_features' => 'nullable|array',
            'key_features.*.icon' => 'required|string|max:255',
            'key_features.*.topic' => 'required|string|max:255',
            'key_features.*.description' => 'required|string',
            'certifications' => 'nullable|array',
            'certifications.*.name' => 'required|string|max:255',
            'certificate_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'certificate_description' => 'nullable|array',
            'certificate_description.*.text' => 'required|string',
            'learning_outcomes' => 'nullable|array',
            'learning_outcomes.*' => 'required|string',
            'points' => 'nullable|array',
            'points.*' => 'required|string',
            'instructor_ids' => 'nullable|array',
            'instructor_ids.*' => 'required|exists:users,id',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required|string',
            'faqs.*.answer' => 'required|string',
        ]);

        $bannerPath = $courseDetail->course_banner;
        if ($request->hasFile('course_banner')) {
            if ($bannerPath) {
                Storage::disk('public')->delete($bannerPath);
            }
            $bannerPath = $request->file('course_banner')->store('banners', 'public');
        }

        $certificateImagePath = $courseDetail->certificate_image;
        if ($request->hasFile('certificate_image')) {
            if ($certificateImagePath) {
                Storage::disk('public')->delete($certificateImagePath);
            }
            $certificateImagePath = $request->file('certificate_image')->store('certificates', 'public');
        }

        if (isset($validated['course_curriculum'])) {
            foreach ($validated['course_curriculum'] as &$module) {
                if (isset($module['topics'])) {
                    foreach ($module['topics'] as &$topic) {
                        $topic['subtopics'] = array_filter(array_map('trim', explode("\n", $topic['subtopics'])));
                    }
                }
            }
        }

        if (isset($validated['demo_syllabus'])) {
            foreach ($validated['demo_syllabus'] as &$module) {
                if (isset($module['topics'])) {
                    foreach ($module['topics'] as &$topic) {
                        $topic['subtopics'] = array_filter(array_map('trim', explode(',', $topic['subtopics'])));
                    }
                }
            }
        }

        $courseDetail->update([
            'course_name' => $request->course_name,
            'course_id' => $request->course_id,
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
            'demo_syllabus' => $validated['demo_syllabus'] ?? [],
            'instructor_ids' => $request->instructor_ids,
            'faqs' => $request->faqs,
            'key_features' => $validated['key_features'] ?? [],
            'certifications' => $validated['certifications'] ?? [],
            'certificate_image' => $certificateImagePath,
            'certificate_description' => $validated['certificate_description'] ?? [],
        ]);

        return redirect()->route('course-details-index')->with('success', 'Course details updated successfully!');
    }
}