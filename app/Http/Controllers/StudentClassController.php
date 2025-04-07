<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\LiveClass;
use Illuminate\Support\Facades\Auth;

class StudentClassController extends Controller
{
    public function index()
    {
        $student = Auth::user(); // Get logged-in student
        $enrollments = $student->enrollments()->where('status', 'active')->get();
// dd($enrollments);
        $upcomingClasses = [];
        $endedClasses = [];

        foreach ($enrollments as $enrollment) {
            $liveClasses = $enrollment->liveClasses()->where('status', 'Scheduled')->get();
            foreach ($liveClasses as $class) {
                if ($class->isUpcoming()) {
                    $upcomingClasses[] = $class;
                } elseif ($class->isEnded()) {
                    $endedClasses[] = $class;
                }
            }
        }
        return view('student.classes.index', compact('upcomingClasses', 'endedClasses'));
    }
}
