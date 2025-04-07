@extends('layouts.app') <!-- Assuming you have a layout -->

@section('content')
<div class="container">
    <h1>Quiz Rankings for {{ $batch->course->name }} - {{ $batch->name }} (Started: {{ $batch->start_date }})</h1>
    
    @if($attempts->isEmpty())
        <div class="alert alert-info">
            No quiz attempts found for this batch yet.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Student Name</th>
                    <th>Quiz Set</th>
                    <th>Score</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attempts as $index => $attempt)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $attempt['student_name'] }}</td>
                        <td>{{ $attempt['quiz_set_title'] }}</td>
                        <td>{{ $attempt['score'] }} / {{ $attempt['total_quizzes'] }}</td>
                        <td>{{ number_format($attempt['percentage'], 2) }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('student.quiz_sets') }}" class="btn btn-secondary">Back to Quiz Sets</a>
</div>
@endsection