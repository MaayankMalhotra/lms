<?php

   namespace App\Http\Controllers;

   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Mail;
   use App\Mail\OfferLetter;

   class CourseToInternshipController extends Controller
   {
       public function index()
       {
           $enrollments = DB::table('enrollments')
               ->join('batches', 'enrollments.batch_id', '=', 'batches.id')
               ->join('users', 'enrollments.user_id', '=', 'users.id')
               ->where('batches.start_date', '<', now())
               ->select(
                   'users.id as user_id',
                   'users.name',
                   'users.email',
                   'users.phone',
                   'users.internship'
               )
               ->distinct('enrollments.user_id')
               ->get();

           return view('enrollments.report', compact('enrollments'));
       }

       public function sendOfferLetter(Request $request)
       {
           $request->validate([
               'user_id' => 'required|exists:users,id',
               'email' => 'required|email',
               'name' => 'required|string',
           ]);

           try {
               $user = DB::table('users')
                   ->where('id', $request->user_id)
                   ->first();

               if ($user->internship) {
                   return response()->json([
                       'success' => false,
                       'message' => 'Internship offer already sent to this user.',
                   ], 400);
               }

               DB::table('users')
                   ->where('id', $request->user_id)
                   ->update(['internship' => 1]);

               Mail::to($request->email)->send(new OfferLetter($request->name));

               return response()->json([
                   'success' => true,
                   'message' => 'Offer letter sent successfully.',
               ]);
           } catch (\Exception $e) {
               return response()->json([
                   'success' => false,
                   'message' => 'Failed to send offer letter: ' . $e->getMessage(),
               ], 500);
           }
       }

       public function sendTestEmail()
       {
           try {
               Mail::to('maayankmalhotra095@gmail.com')->send(new OfferLetter('Test User'));
               return response()->json([
                   'success' => true,
                   'message' => 'Test email sent successfully to maayankmalhotra095@gmail.com.',
               ]);
           } catch (\Exception $e) {
               return response()->json([
                   'success' => false,
                   'message' => 'Failed to send test email: ' . $e->getMessage(),
               ], 500);
           }
       }
   }