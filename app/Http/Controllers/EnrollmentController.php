<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function index()
    {
        // Fetch enrollments with related student, payment, batch, course, and instructor data
        $enrollments = Enrollment::select(
            'enrollments.id as enrollment_id',
            'enrollments.email as enrollment_email',
            'enrollments.status as enrollment_status',
            'enrollments.created_at as enrollment_created_at',
            'users.name as student_name',
            'users.email as student_email',
            'students.phone',
            'payments.payment_id',
            'payments.amount',
            'payments.status as payment_status',
            'batches.start_date',
            'batches.time_slot',
            'batches.price as batch_price',
            'batches.slots_available',
            'batches.slots_filled',
            'courses.name as course_name',
            'courses.price as course_price',
            'teachers.name as instructor_name'
        )
        ->join('users', 'enrollments.user_id', '=', 'users.id')
        ->join('students', 'enrollments.user_id', '=', 'students.user_id')
        ->join('payments', 'enrollments.id', '=', 'payments.enrollment_id')
        ->join('batches', 'enrollments.batch_id', '=', 'batches.id')
        ->join('courses', 'batches.course_id', '=', 'courses.id')
        ->leftJoin('users as teachers', 'batches.teacher_id', '=', 'teachers.id') // Assuming trainers are stored in users table with role 2
        ->where('users.role', 3) // Only students (role = 3)
        ->orderBy('enrollments.created_at', 'desc')
        ->get();

        return view('admin.enrollments.index', compact('enrollments'));
    }
}