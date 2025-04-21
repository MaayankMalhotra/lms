@extends('admin.layouts.app')

@extends('layouts.app')

@section('title', 'Quiz Attempt')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Quiz Attempt: {{ $attempt->quizSet->title }}</h4>
                </div>

                <div class="card-body">
                    <p class="mb-4"><strong>Tera Score:</strong> {{ $attempt->score }} / {{ $attempt->quizSet->total_quizzes }}</p>

                    @foreach ($attempt->quizSet->quizzes as $index => $quiz)
                        <div class="mb-4 border-bottom pb-4">
                            <h5 class="font-weight-bold">Sawaal {{ $index + 1 }}: {{ $quiz->question }}</h5>
                            
                            <!-- Student ka answer check karo -->
                            @php
                                $studentAnswer = $attempt->answers->where('quiz_id', $quiz->id)->first();
                                $isCorrect = $studentAnswer && $studentAnswer->student_answer == $quiz->correct_option;
                            @endphp

                            <div class="mt-2">
                                <p><strong>Tera Jawab:</strong> 
                                    @if ($studentAnswer)
                                        {{ $quiz->{'option_' . $studentAnswer->student_answer} }}
                                        <span class="{{ $isCorrect ? 'text-success' : 'text-danger' }}">
                                            ({{ $isCorrect ? 'Sahi' : 'Galat' }})
                                        </span>
                                    @else
                                        <span class="text-muted">Tune iska jawab nahi diya</span>
                                    @endif
                                </p>
                                <p><strong>Sahi Jawab:</strong> {{ $quiz->{'option_' . $quiz->correct_option} }}</p>
                            </div>

                            <!-- Saare options dikhao -->
                            <div class="mt-3">
                                <p><strong>Options:</strong></p>
                                <ul class="list-group">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <li class="list-group-item {{ $quiz->correct_option == $i ? 'bg-success text-white' : '' }}">
                                            {{ $quiz->{'option_' . $i} }}
                                            @if ($studentAnswer && $studentAnswer->student_answer == $i)
                                                (Tera choice)
                                            @endif
                                        </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    @endforeach

                    <a href="{{ route('student.quiz_sets') }}" class="btn btn-primary mt-4">
                        Wapas Quiz Sets Pe Jao
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection