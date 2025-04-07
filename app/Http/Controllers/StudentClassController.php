<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function index(){
        $students = \App\Models\Student::with('class')->get();
        dd($students);
        return view('students.index', compact('students'));
    }
}
