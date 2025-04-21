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
                        <p class="mb-4"><strong>Tera Score:</strong> {{ $attempt->score }} / {{ $attempt->quizSet->total_quizzes }}</p>

                        @foreach ($attempt->quizSet->quizzes as $index => $quiz)
                            <div class="card mb-3 shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Sawaal {{ $index + 1 }}: {{ $quiz->question }}</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        $studentAnswer = $attempt->answers->where('quiz_id', $quiz->id)->first();
                                        $isCorrect = $studentAnswer && $studentAnswer->student_answer == $quiz->correct_option;
                                    @endphp

                                    <p class="mb-2">
                                        <strong>Your selection:</strong> 
                                        @if ($studentAnswer)
                                            {{ $quiz->{'option_' . $studentAnswer->student_answer} }}
                                            <span class="{{ $isCorrect ? 'text-success font-weight-bold' : 'text-danger font-weight-bold' }}">
                                                ({{ $isCorrect ? 'Sahi' : 'Galat' }})
                                            </span>
                                        @else
                                            <span class="text-muted">Tune iska jawab nahi diya</span>
                                        @endif
                                    </p>
                                    <p class="mb-3">
                                        <strong>Correct Option:</strong> {{ $quiz->{'option_' . $quiz->correct_option} }}
                                    </p>

                                    <div class="mt-3">
                                        <p class="font-weight-bold mb-2">Options:</p>
                                        <ul class="list-group">
                                            @for ($i = 1; $i <= 4; $i++)
                                                <li class="list-group-item {{ $quiz->correct_option == $i ? 'bg-success text-white' : ($studentAnswer && $studentAnswer->student_answer == $i && !$isCorrect ? 'bg-danger text-white' : '') }}">
                                                    {{ $quiz->{'option_' . $i} }}
                                                    @if ($studentAnswer && $studentAnswer->student_answer == $i)
                                                        <span class="badge badge-light ml-2">Your choice</span>
                                                    @endif
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
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