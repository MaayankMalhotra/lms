<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Payment;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Registration;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Hash;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::with('course', 'teacher')->get();
        return view('admin.batch_listing', compact('batches'));
    }

    public function create()
    {
        $teachers = User::where('role', 2)->get();
        $courses = Course::all();
        return view('admin.add-batch', compact('teachers', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'status' => 'required|in:Batch Started,Upcoming,Soon',
            'days' => 'required',
            'duration' => 'required|string',
            'time_slot' => 'required|string',
            'price' => 'required|numeric',
            'discount_info' => 'nullable|string',
            'slots_available' => 'required|numeric',
            'slots_filled' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Batch::create($validated);

        return redirect()->route('admin.batches.add')->with('success', 'Batch added successfully!');
    }

    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();
        return redirect()->route('admin.batches.index')->with('success', 'Batch deleted successfully!');
    }

    // Edit method for modal (returns JSON)
    public function edit($id)
    {
        $batch = Batch::findOrFail($id);
        $teachers = User::where('role', 2)->get();
        $courses = Course::all();
        return response()->json([
            'batch' => $batch,
            'teachers' => $teachers,
            'courses' => $courses,
        ]);
    }

    // Update method (handles AJAX request)
    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);
        $validated = $request->validate([
            'start_date' => 'required|date',
            'status' => 'required|in:Batch Started,Upcoming,Soon',
            'days' => 'required',
            'duration' => 'required|string',
            'time_slot' => 'required|string',
            'price' => 'required|numeric',
            'discount_info' => 'nullable|string',
            'slots_available' => 'required|numeric',
            'slots_filled' => 'required|numeric',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $batch->update($validated);

        // Fetch updated course and teacher names for the response
        $course = Course::find($validated['course_id']);
        $teacher = User::find($validated['teacher_id']);

        return response()->json([
            'success' => true,
            'course_name' => $course->name,
            'teacher_name' => $teacher->name,
        ]);
    }

    public function getBatchesByCourse(Request $request)
    {
        $courseId = $request->query('id'); // Get course_id from query parameter
        if (!$courseId) {
            return response()->json(['error' => 'Course ID is required'], 400);
        }

        $batches = Batch::where('course_id', $courseId)
            ->with('course', 'teacher')
            ->get()
            ->map(function ($batch) {
                return [
                    'id' => $batch->id,
                    'date' => $batch->start_date->format('d M'), // e.g., "06 Feb"
                    'price' => $batch->price,
                    'slotsAvailable' => $batch->slots_available,
                    'slotsFilled' => $batch->slots_filled,
                    'mode' => $batch->course->mode ?? 'Online', // Assuming course table has a mode field
                    'status' => $batch->status === 'Batch Started' ? 'started' : ($batch->status === 'Upcoming' ? 'upcoming' : 'soon'),
                    'startDate' => $batch->start_date->toISOString(), // For JavaScript Date object
                ];
            });

        return response()->json($batches);
    }

    public function show(Request $request)
    {
        // Get batch details from query parameters
        $batch = [
            'date' => $request->query('date'),
            'price' => $request->query('price'),
            'slotsAvailable' => $request->query('slotsAvailable'),
            'slotsFilled' => $request->query('slotsFilled'),
            'mode' => $request->query('mode'),
            'status' => $request->query('status'),
            'startDate' => $request->query('startDate'),
        ];

        return view('register', compact('batch'));
    }

    public function showr(Request $request)
    {
        $batch = [
            'date' => $request->query('date'),
            'price' => $request->query('price'),
            'slotsAvailable' => $request->query('slotsAvailable'),
            'slotsFilled' => $request->query('slotsFilled'),
            'mode' => $request->query('mode'),
            'status' => $request->query('status'),
            'startDate' => $request->query('startDate'),
        ];

        return view('register', compact('batch'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:registrations,email',
            'phone' => 'required|string|max:15',
            'batch_date' => 'required',
            'batch_status' => 'required',
            'mode' => 'required',
            'price' => 'required|numeric',
            'slots_available' => 'required|numeric',
            'slots_filled' => 'required|numeric',
        ]);

        // Save registration data to database
        Registration::create($validated);

        return redirect()->route('register')->with('success', 'Registration successful!');
    }
    // public function submitr(Request $request)
    // {
    //     // Form data validate karo, jaise dil se dil tak baat check karna
    //     $validated = $request->validate([
    //         'batch_date' => 'required|string',
    //         'batch_status' => 'required|string',
    //         'mode' => 'required|string',
    //         'price' => 'required|numeric',
    //         'slots_available' => 'required|integer',
    //         'slots_filled' => 'required|integer',
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email|max:255',
    //         'phone' => 'required|string|max:15',
    //     ]);

    //     // User banayo with role 3, jaise ek nayi kahani shuru karna
    //     $user = User::create([
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'password' => Hash::make('123456'), // Default password, badal sakta hai
    //         'role' => 3, // Student role
    //     ]);

    //     // Registration table mein entry, jaise batch ke saath rishta jodna
    //     $registration = Registration::create([
    //         'user_id' => $user->id,
    //         'batch_date' => $validated['batch_date'],
    //         'batch_status' => $validated['batch_status'],
    //         'mode' => $validated['mode'],
    //         'price' => $validated['price'],
    //         'slots_available' => $validated['slots_available'],
    //         'slots_filled' => $validated['slots_filled'],
    //     ]);

    //     // Student table mein entry, jaise student ka safar shuru karna
    //     $student = Student::create([
    //         'user_id' => $user->id,
    //         'phone' => $validated['phone'],
    //         // Aur jo bhi fields chahiye, yahan add karo
    //     ]);
    //     $enrollment = Enrollment::create([
    //         'user_id' => $user->id,
    //         'batch_id' => $validated['batch_id'],
    //     ]);

    //     // Success message ke saath redirect, jaise pyar bhara jawab
    //     return redirect()->back()->with('success', 'Registration successful! Welcome to the journey.');
    // }
    
     public function submitr(Request $request)
    {
        // Form data validate karo, jaise dil se dil tak baat check karna
        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id', // Batch ID validate karo
            'batch_date' => 'required|string',
            'batch_status' => 'required|string',
            'mode' => 'required|string',
            'price' => 'required|numeric',
            'slots_available' => 'required|integer',
            'slots_filled' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|string|max:15',
        ]);
    
        // User banayo with role 3, jaise ek nayi kahani shuru karna
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('123456'), // Default password, badal sakta hai
            'role' => 3, // Student role
        ]);
    
        // Registration table mein entry, jaise batch ke saath rishta jodna
        $registration = Registration::create([
            'user_id' => $user->id,
            'batch_date' => $validated['batch_date'],
            'batch_status' => $validated['batch_status'],
            'mode' => $validated['mode'],
            'price' => $validated['price'],
            'slots_available' => $validated['slots_available'],
            'slots_filled' => $validated['slots_filled'],
        ]);
    
        // Student table mein entry, jaise student ka safar shuru karna
        $student = Student::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'],
            // Aur jo bhi fields chahiye, yahan add karo
        ]);
    
        // Enrollment table mein entry, jaise batch aur student ka pyar ka bandhan
        $enrollment = Enrollment::create([
            'user_id' => $user->id,
            'batch_id' => $validated['batch_id'],
        ]);
        // Payments table mein entry
    $payment = Payment::create([
        'amount' => $validated['price'], // Price ko amount ke roop mein use karo
        'batch_id' => $validated['batch_id'], // Batch ID
        'student_id' => $student->id, // Student ID
        'enrollment_id' => $enrollment->id, // Student ID
    ]);
    
        // Success message ke saath redirect, jaise pyar bhara jawab
        return redirect()->back()->with('success', 'Registration successful! Welcome to the journey.');
    }
}

