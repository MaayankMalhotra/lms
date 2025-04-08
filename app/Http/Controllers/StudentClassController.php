<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\LiveClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StudentClassController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        $enrollments = $student->enrollments()->where('status', 'active')->get();

        $upcomingClasses = collect();
        $ongoingClasses = collect();
        $endedClasses = collect();

        foreach ($enrollments as $enrollment) {
            $liveClasses = $enrollment->liveClasses()->where('status', 'Scheduled')->get();
           
            foreach ($liveClasses as $class) {
                if ($class->isUpcoming()) {
                    $upcomingClasses->push($class);
                } elseif ($class->isOngoing()) {
                    $ongoingClasses->push($class);
                } elseif ($class->isEnded()) {
                    $endedClasses->push($class);
                }
            }
        }
        return view('student.classes.index', compact('upcomingClasses', 'ongoingClasses', 'endedClasses'));
    }

    public function joinClass($liveClassId)
    {
        $student = Auth::user();
        $liveClass = LiveClass::findOrFail($liveClassId);

        $now = Carbon::now();
        $classStart = Carbon::parse($liveClass->class_datetime);
        $classEnd = $classStart->copy()->addMinutes($liveClass->duration_minutes);

        if (!$liveClass->isOngoing()) {
            return redirect()->route('student.dashboard')->with('error', 'You can only join the class during its scheduled time.');
        }

        if (!$liveClass->hasAttended($student->id)) {
            Attendance::create([
                'user_id' => $student->id,
                'live_class_id' => $liveClass->id,
                'date' => $now->toDateString(),
            ]);
        }

        return redirect($liveClass->google_meet_link);
    }
}
