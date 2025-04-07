<?php

namespace App\Http\Controllers;

use App\Models\QuizSet;
use App\Models\StudentQuizSetAttempt;
use App\Models\StudentQuizAnswer;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentQuizController extends Controller
{
    public function index()
    {
        $student = Auth::user();
        
        $enrolledBatches = $student->enrollments()->pluck('batch_id');
        $quizSets = QuizSet::whereIn('batch_id', $enrolledBatches)->get();
        return view('student.quiz_sets.index', compact('quizSets', 'student'));
    }

    public function takeQuiz($id)
    {
        $student = Auth::user();
        $quizSet = QuizSet::with('quizzes')->findOrFail($id);
        
        // Check enrollment
        $enrolledBatches = $student->enrollments()->pluck('batch_id');
        if (!$enrolledBatches->contains($quizSet->batch_id)) {
            return redirect()->route('student.quiz_sets')->with('error', 'You are not enrolled in this batch!');
        }

        // Check if already attempted
        if ($student->studentQuizSetAttempts()->where('quiz_set_id', $id)->exists()) {
            return redirect()->route('student.quiz_sets')->with('error', 'You have already taken this quiz set!');
        }

        return view('student.quiz_sets.take', compact('quizSet'));
    }

    public function submitQuiz_old(Request $request, $id)
    {
        $student = Auth::user();
        $quizSet = QuizSet::with('quizzes')->findOrFail($id);

        // Validate enrollment and attempt
        $enrolledBatches = $student->enrollments()->pluck('batch_id');
        if (!$enrolledBatches->contains($quizSet->batch_id)) {
            return redirect()->route('student.quiz_sets')->with('error', 'Unauthorized!');
        }
        if ($student->studentQuizSetAttempts()->where('quiz_set_id', $id)->exists()) {
            return redirect()->route('student.quiz_sets')->with('error', 'You have already taken this quiz set!');
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer|between:1,4',
        ]);

        $answers = $request->input('answers');
        $correctCount = 0;

        // Create attempt
        $attempt = StudentQuizSetAttempt::create([
            'user_id' => $student->id,
            'quiz_set_id' => $quizSet->id,
            'score' => 0,
        ]);

        // Save answers and calculate score
        foreach ($quizSet->quizzes as $quiz) {
            $studentAnswer = $answers[$quiz->id] ?? null;
            if ($studentAnswer) {
                StudentQuizAnswer::create([
                    'attempt_id' => $attempt->id,
                    'quiz_id' => $quiz->id,
                    'student_answer' => $studentAnswer,
                ]);
                if ($studentAnswer == $quiz->correct_option) {
                    $correctCount++;
                }
            }
        }

        $attempt->update(['score' => $correctCount]);
        return redirect()->route('student.quiz_sets')
            ->with('success', "Your score is $correctCount/{$quizSet->total_quizzes}");
    }
    public function batchQuizRanking($batchId)
    {
        $quizSets = QuizSet::where('batch_id', $batchId)->pluck('id');
        $quizIds = Quiz::whereIn('quiz_set_id', $quizSets)->pluck('id');
    
        $studentResults = StudentQuizAnswer::whereIn('quiz_id', $quizIds)
            ->with(['quiz.quizSet', 'user'])
            ->get()
            ->groupBy('user_id')
            ->map(function ($answers) {
                $score = $answers->sum(function ($answer) {
                    return $answer->student_answer == $answer->quiz->correct_option ? 1 : 0;
                });
                $totalQuizzes = $answers->first()->quiz->quizSet->total_quizzes;
    
                return [
                    'student_name' => $answers->first()->user->name,
                    'quiz_set_title' => $answers->first()->quiz->quizSet->title,
                    'score' => $score,
                    'total_quizzes' => $totalQuizzes,
                    'percentage' => ($score / $totalQuizzes) * 100
                ];
            })
            ->sortByDesc('percentage')
            ->values();
    
        $batch = \App\Models\Batch::with('course')->findOrFail($batchId);
    
        return view('student.quiz_sets.batch_ranking', compact('studentResults', 'batch'));
    }
    public function batchQuizRanking_old($batchId)
{
    $quizSets = QuizSet::where('batch_id', $batchId)->pluck('id');
    $quizIds = Quiz::whereIn('quiz_set_id', $quizSets)->pluck('id');

    $studentResults = StudentQuizAnswer::whereIn('quiz_id', $quizIds)
        ->with(['quiz.quizSet'])
        ->get()
        ->groupBy('user_id') // Ab user_id se group karo
        ->map(function ($answers) {
            $score = $answers->sum(function ($answer) {
                return $answer->student_answer == $answer->quiz->correct_option ? 1 : 0;
            });
            $totalQuizzes = $answers->first()->quiz->quizSet->total_quizzes;
            $student = User::find($answers->first()->user_id);

            return [
                'student_name' => $student->name,
                'quiz_set_title' => $answers->first()->quiz->quizSet->title,
                'score' => $score,
                'total_quizzes' => $totalQuizzes,
                'percentage' => ($score / $totalQuizzes) * 100
            ];
        })
        ->sortByDesc('percentage')
        ->values();

    $batch = \App\Models\Batch::with('course')->findOrFail($batchId);

    return view('student.quiz_sets.batch_ranking', compact('studentResults', 'batch'));
}
public function submitQuiz(Request $request, $id)
{
    $student = Auth::user();
    $quizSet = QuizSet::with('quizzes')->findOrFail($id);

    $enrolledBatches = $student->enrollments()->pluck('batch_id');
    if (!$enrolledBatches->contains($quizSet->batch_id)) {
        return redirect()->route('student.quiz_sets')->with('error', 'Unauthorized!');
    }
    if ($student->studentQuizSetAttempts()->where('quiz_set_id', $id)->exists()) {
        return redirect()->route('student.quiz_sets')->with('error', 'You have already taken this quiz set!');
    }

    $request->validate([
        'answers' => 'required|array',
        'answers.*' => 'required|integer|between:1,4',
    ]);

    $answers = $request->input('answers');
    $correctCount = 0;

    $attempt = StudentQuizSetAttempt::create([
        'user_id' => $student->id,
        'quiz_set_id' => $quizSet->id,
        'score' => 0,
    ]);

    foreach ($quizSet->quizzes as $quiz) {
        $studentAnswer = $answers[$quiz->id] ?? null;
        if ($studentAnswer) {
            StudentQuizAnswer::create([
                'attempt_id' => $attempt->id,
                'quiz_id' => $quiz->id,
                'student_answer' => $studentAnswer,
                'user_id' => $student->id,
            ]);
            if ($studentAnswer == $quiz->correct_option) {
                $correctCount++;
            }
        }
    }

    $attempt->update(['score' => $correctCount]);
    return redirect()->route('student.quiz_sets')
        ->with('success', "Your score is $correctCount/{$quizSet->total_quizzes}");
}
   }