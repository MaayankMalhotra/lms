<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User; 
class AdminController extends Controller
{
    public function student_management()
    {
        $students = User::where('role', 3)->get();
    return view('admin.studentmanagement', compact('students'));
    }
     public function trainer_management()
    {
        $students = User::where('role', 2)->get();
    return view('admin.trainermanagement', compact('students'));
    }
}
