<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Student;
use App\Models\Registration;
use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

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
        Log::info('Batch store request:', $request->all());
    
        try {
            $validated = $request->validate([
                'start_date' => 'required|date',
                'status' => 'required|in:Batch Started,Upcoming,Soon',
                'days' => 'required',
                'duration' => 'required|string',
                'time_slot' => 'required|string',
                'price' => 'required|numeric|min:0',
                'discount_info' => 'nullable|string',
                'slots_available' => 'required|numeric|min:1',
                'slots_filled' => 'required|numeric|min:0',
                'course_id' => 'required|exists:courses,id',
                'teacher_id' => 'required|exists:users,id',
                'emi_available' => 'nullable|in:on,1,0,true,false',
                'emi_plans' => 'required_if:emi_available,on|array',
                'emi_plans.*.installments' => 'required_if:emi_available,on|integer|min:2',
                'emi_plans.*.amount' => 'required_if:emi_available,on|numeric|min:0',
                'emi_plans.*.interval_months' => 'required_if:emi_available,on|integer|min:1', // Add validation for interval_months
            ]);
    
            $batchData = $validated;
            $batchData['emi_available'] = in_array($request->emi_available, ['on', '1', 'true'], true);
    
            // Ensure emi_plans is set correctly
            if ($batchData['emi_available'] && !empty($validated['emi_plans'])) {
                $batchData['emi_plans'] = array_map(function ($plan) {
                    return [
                        'installments' => (int) $plan['installments'],
                        'amount' => (float) $plan['amount'],
                        'interval_months' => (int) $plan['interval_months'], // Include interval_months
                    ];
                }, $validated['emi_plans']);
    
                // Validate total EMI amount
                foreach ($batchData['emi_plans'] as $plan) {
                    $total = $plan['installments'] * $plan['amount'];
                    if (abs($total - $batchData['price']) > 0.01) {
                        return back()->withErrors(['emi_plans' => 'Total EMI amount must equal the batch price (₹' . $batchData['price'] . ').']);
                    }
                }
            } else {
                $batchData['emi_plans'] = null;
            }
    
            Log::info('Batch data before creation:', $batchData);
    
            $batch = Batch::create($batchData);
    
            Log::info('Batch created:', ['id' => $batch->id, 'emi_available' => $batch->emi_available, 'emi_plans' => $batch->emi_plans]);
    
            return redirect()->route('admin.batches.add')->with('success', 'Batch added successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create batch:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'Failed to create batch: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();
        return redirect()->route('admin.batches.index')->with('success', 'Batch deleted successfully!');
    }

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

    public function update(Request $request, $id)
    {
        Log::info('Batch update request:', $request->all());

        try {
            $batch = Batch::findOrFail($id);
            $validated = $request->validate([
                'start_date' => 'required|date',
                'status' => 'required|in:Batch Started,Upcoming,Soon',
                'days' => 'required',
                'duration' => 'required|string',
                'time_slot' => 'required|string',
                'price' => 'required|numeric|min:0',
                'discount_info' => 'nullable|string',
                'slots_available' => 'required|numeric|min:1',
                'slots_filled' => 'required|numeric|min:0',
                'course_id' => 'required|exists:courses,id',
                'teacher_id' => 'required|exists:users,id',
                'emi_available' => 'nullable|in:on,1,0,true,false',
                'emi_plans' => 'required_if:emi_available,on|array',
                'emi_plans.*.installments' => 'required_if:emi_available,on|integer|min:2',
                'emi_plans.*.amount' => 'required_if:emi_available,on|numeric|min:0',
            ]);

            $batchData = $validated;
            $batchData['emi_available'] = in_array($request->emi_available, ['on', '1', 'true'], true);

            if ($batchData['emi_available'] && !empty($validated['emi_plans'])) {
                $batchData['emi_plans'] = array_map(function ($plan) {
                    return [
                        'installments' => (int) $plan['installments'],
                        'amount' => (float) $plan['amount'],
                    ];
                }, $validated['emi_plans']);

                foreach ($batchData['emi_plans'] as $plan) {
                    $total = $plan['installments'] * $plan['amount'];
                    if (abs($total - $batchData['price']) > 0.01) {
                        return back()->withErrors(['emi_plans' => 'Total EMI amount must equal the batch price (₹' . $batchData['price'] . ').']);
                    }
                }
            } else {
                $batchData['emi_plans'] = null;
            }

            Log::info('Batch data before update:', $batchData);

            $batch->update($batchData);

            Log::info('Batch updated:', ['id' => $batch->id, 'emi_available' => $batch->emi_available, 'emi_plans' => $batch->emi_plans]);

            $course = Course::find($validated['course_id']);
            $teacher = User::find($validated['teacher_id']);

            return response()->json([
                'success' => true,
                'course_name' => $course->name,
                'teacher_name' => $teacher->name,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to update batch:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Failed to update batch: ' . $e->getMessage()], 500);
        }
    }

    public function getBatchesByCourse(Request $request)
    {
        $courseId = $request->query('id');
        if (!$courseId) {
            return response()->json(['error' => 'Course ID is required'], 400);
        }

        $batches = Batch::where('course_id', $courseId)
            ->with('course', 'teacher')
            ->get()
            ->map(function ($batch) {
                return [
                    'id' => $batch->id,
                    'date' => $batch->start_date->format('d M'),
                    'price' => $batch->price,
                    'slotsAvailable' => $batch->slots_available,
                    'slotsFilled' => $batch->slots_filled,
                    'mode' => $batch->course->mode ?? 'Online',
                    'status' => $batch->status === 'Batch Started' ? 'started' : ($batch->status === 'Upcoming' ? 'upcoming' : 'soon'),
                    'startDate' => $batch->start_date->toISOString(),
                    'emi_available' => $batch->emi_available,
                    'emi_plans' => $batch->emi_plans ?? [],
                ];
            });

        return response()->json($batches);
    }

    // public function show(Request $request)
    // {
    //     $batchId = $request->query('batch_id');
    //     if (!$batchId) {
    //         return redirect()->back()->withErrors(['error' => 'Batch ID is required']);
    //     }

    //     $batch = Batch::with('course')->findOrFail($batchId);
    //     $batchData = [
    //         'id' => $batch->id,
    //         'date' => $batch->start_date->format('d M'),
    //         'price' => $batch->price,
    //         'slotsAvailable' => $batch->slots_available,
    //         'slotsFilled' => $batch->slots_filled,
    //         'mode' => $batch->course->mode ?? 'Online',
    //         'status' => $batch->status === 'Batch Started' ? 'started' : ($batch->status === 'Upcoming' ? 'upcoming' : 'soon'),
    //         'startDate' => $batch->start_date->toISOString(),
    //         'emi_available' => $batch->emi_available,
    //         'emi_plans' => $batch->emi_plans ?? [],
    //         'course_name' => $batch->course->name,
    //     ];

    //     return view('register', compact('batchData'));
    // }

    public function show(Request $request)
{
    // Get batch ID from session
    $batchId = session('current_batch_id');
    
    if (!$batchId) {
        return redirect()->back()->withErrors(['error' => 'Please select a batch first']);
    }

    // Clear the session data
    session()->forget('current_batch_id');

    // Fetch all data from database
    $batch = Batch::with('course')->findOrFail($batchId);
    
    $batchData = [
        'id' => $batch->id,
        'date' => $batch->start_date->format('d M'),
        'price' => $batch->price,
        'slotsAvailable' => $batch->slots_available,
        'slotsFilled' => $batch->slots_filled,
        'mode' => $batch->course->mode ?? 'Online',
        'status' => $batch->status === 'Batch Started' ? 'started' : ($batch->status === 'Upcoming' ? 'upcoming' : 'soon'),
        'startDate' => $batch->start_date->toISOString(),
        'emi_available' => $batch->emi_available,
        'emi_plans' => $batch->emi_plans ?? [],
        'course_name' => $batch->course->name,
    ];

    return view('register', compact('batchData'));
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

        Registration::create($validated);

        return redirect()->route('register')->with('success', 'Registration successful!');
    }

    public function submitr(Request $request)
{
    Log::info('Incoming registration request:', $request->all());

    try {
        // Validate request data
        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'batch_date' => 'required|string',
            'batch_status' => 'required|string',
            'mode' => 'required|string',
            'price' => 'required|numeric|min:0',
            'slots_available' => 'required|integer|min:0',
            'slots_filled' => 'required|integer|min:0',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|string|max:15',
            'payment_id' => 'required|string|max:255',
            'payment_method' => 'required|in:full,emi',
            'emi_plan' => 'required_if:payment_method,emi|integer|min:0',
        ]);

        Log::info('Validated data:', $validated);

        // Fetch batch and log EMI plans
        $batch = Batch::findOrFail($validated['batch_id']);
        $batch->emi_plans = $batch->emi_plans ?? [];
        Log::info('Batch EMI plans:', ['batch_id' => $batch->id, 'emi_plans' => $batch->emi_plans]);

        // Calculate payment amount and EMI plan
        $paymentAmount = $validated['price'];
        $emiPlan = null;
        if ($validated['payment_method'] === 'emi') {
            if (empty($batch->emi_plans)) {
                throw new \Exception('No EMI plans available for this batch');
            }
            if (!array_key_exists($validated['emi_plan'], $batch->emi_plans)) {
                throw new \Exception('Invalid EMI plan selected: ' . $validated['emi_plan']);
            }
            $emiPlan = $batch->emi_plans[$validated['emi_plan']];
            if (!isset($emiPlan['installments']) || !isset($emiPlan['amount'])) {
                throw new \Exception('Invalid EMI plan configuration');
            }
            $paymentAmount = $emiPlan['amount'];
            Log::info('EMI plan selected:', ['emi_plan' => $emiPlan, 'payment_amount' => $paymentAmount]);
        }

        // Verify Razorpay payment
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $razorpayPayment = $api->payment->fetch($validated['payment_id']);
        Log::info('Razorpay payment details:', (array) $razorpayPayment);

        $expectedAmount = (int) ($paymentAmount * 100); // Convert to paise
        if ($razorpayPayment->amount !== $expectedAmount) {
            throw new \Exception('Amount mismatch: expected ' . $expectedAmount . ', got ' . $razorpayPayment->amount);
        }

        DB::beginTransaction();

        try {
            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make('123456'),
                'role' => 3,
            ]);
            Log::info('User created:', ['user_id' => $user->id]);

            // Create registration
            $registration = Registration::create([
                'user_id' => $user->id,
                'batch_date' => $validated['batch_date'],
                'batch_status' => $validated['batch_status'],
                'mode' => $validated['mode'],
                'price' => $validated['price'],
                'slots_available' => $validated['slots_available'],
                'slots_filled' => $validated['slots_filled'],
            ]);
            Log::info('Registration created:', ['registration_id' => $registration->id]);

            // Create student
            $student = Student::create([
                'user_id' => $user->id,
                'phone' => $validated['phone'],
            ]);
            Log::info('Student created:', ['student_id' => $student->id]);

            // Create enrollment
            $enrollment = Enrollment::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'batch_id' => $validated['batch_id'],
                'status' => 'active',
            ]);
            Log::info('Enrollment created:', ['enrollment_id' => $enrollment->id]);

            // Use payment creation date as start date for EMI schedule
            $paymentDate = now()->toDateString();

            // Create payment
            $paymentData = [
                'enrollment_id' => $enrollment->id,
                'user_id' => $user->id,
                'batch_id' => $validated['batch_id'],
                'payment_id' => $validated['payment_id'],
                'amount' => $paymentAmount,
                'status' => 'completed',
                'payment_method' => $validated['payment_method'],
                'emi_installments' => $emiPlan ? $emiPlan['installments'] : null,
                'emi_amount' => $emiPlan ? $emiPlan['amount'] : null,
                'emi_schedule' => $emiPlan ? json_encode($this->generateEmiSchedule(
                    $emiPlan['installments'],
                    $emiPlan['amount'],
                    $emiPlan['interval_months'] ?? 1,
                    $paymentDate
                )) : null,
            ];
            Log::info('Payment data to be saved:', $paymentData);

            $payment = Payment::create($paymentData);
            Log::info('Payment created:', ['payment_id' => $payment->id, 'emi_details' => [
                'payment_method' => $payment->payment_method,
                'emi_installments' => $payment->emi_installments,
                'emi_amount' => $payment->emi_amount,
                'emi_schedule' => $payment->emi_schedule,
            ]]);

            // Update batch slots
            $batch->slots_filled += 1;
            $batch->slots_available -= 1;
            $batch->save();
            Log::info('Batch slots updated:', ['batch_id' => $batch->id]);

            DB::commit();

            return redirect()->route('login')->with('message', 'Please check your email for credentials to log in.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Database operation failed:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            throw new \Exception('Registration process failed: ' . $e->getMessage());
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation failed:', $e->errors());
        return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
    } catch (\Exception $e) {
        Log::error('Registration process failed:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        return response()->json(['error' => $e->getMessage()], 400);
    }
}
    private function generateEmiSchedule($installments, $amount, $intervalMonths, $startDate = null)
    {
        $schedule = [];
        $startDate = $startDate ? Carbon::parse($startDate) : now();
    
        // Start from the second installment (first is paid)
        for ($i = 1; $i < $installments; $i++) {
            $schedule[] = [
                'installment_number' => $i + 1, // Start numbering from 2
                'amount' => $amount,
                'due_date' => $startDate->copy()->addMonths($i * $intervalMonths)->toDateString(),
            ];
        }
    
        return $schedule;
    }

// BatchController.php
public function storeBatchData(Request $request)
{
    $request->validate([
        'batch_id' => 'required|exists:batches,id'
    ]);

    // Store only the batch ID in session
    session(['current_batch_id' => $request->batch_id]);

    return response()->json(['success' => true]);
}
}



