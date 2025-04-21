@extends('admin.layouts.app')
@section('title', 'Quiz Attempt')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quiz Attempt: {{ $attempt->quizSet->title }}</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-4"><strong>Your Score:</strong> {{ $attempt->score }} / {{ $attempt->quizSet->total_quizzes }}</p>

                        @foreach ($attempt->quizSet->quizzes as $index => $quiz)
                            <div class="mb-4 border-bottom pb-4">
                                <h5 class="font-weight-bold">Question {{ $index + 1 }}: {{ $quiz->question }}</h5>
                                
                                @php
                                    $studentAnswer = $attempt->answers->where('quiz_id', $quiz->id)->first();
                                    $isCorrect = $studentAnswer && $studentAnswer->student_answer == $quiz->correct_option;
                                @endphp

                                <div class="mt-2">
                                    <p><strong>Your Answer:</strong> 
                                        @if ($studentAnswer)
                                            {{ $quiz->{'option_' . $studentAnswer->student_answer} }}
                                            <span class="{{ $isCorrect ? 'text-success' : 'text-danger' }}">
                                                ({{ $isCorrect ? 'Correct' : 'Incorrect' }})
                                            </span>
                                        @else
                                            <span class="text-muted">You did not answer this question</span>
                                        @endif
                                    </p>
                                    <p><strong>Correct Answer:</strong> {{ $quiz->{'option_' . $quiz->correct_option} }}</p>
                                </div>

                                <div class="mt-3">
                                    <p><strong>Options:</strong></p>
                                    <ul class="list-group">
                                        @for ($i = 1; $i <= 4; $i++)
                                            <li class="list-group-item {{ $quiz->correct_option == $i ? 'bg-success text-white' : '' }}">
                                                {{ $quiz->{'option_' . $i} }}
                                                @if ($studentAnswer && $studentAnswer->student_answer == $i)
                                                    (Your choice)
                                                @endif
                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        <a href="{{ route('student.quiz_sets') }}" class="btn btn-primary mt-4">
                            Back to Quiz Sets
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
