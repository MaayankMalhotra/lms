<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\InternshipEnrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class InternshipRegistrationController extends Controller
{

    public function show($id)
    {
        $internship = Internship::findOrFail($id);
        return view('website.internship-register', compact('internship'));
    }
    public function store(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
        // Check if user exists, or create new user
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 3,
                'password' => bcrypt('123456789'), // Hash the password
            ]);
        }
    
        // Update or create enrollment
        $enrollment = InternshipEnrollment::updateOrCreate(
            [
                'email' => $request->email,
                'internship_id' => $request->internship_id
            ],
            [
                'user_id' => $user->id, // Use the fetched/created user ID
                'name' => $request->name,
                'phone' => $request->phone,
                'payment_id' => $request->payment_id,
                'amount' => $request->amount,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    
    
        return response()->json([
            'success' => true,
            'message' => 'Registration and payment successful',
            'enrollment_id' => $enrollment->id,
        ], 200);
    }
}
