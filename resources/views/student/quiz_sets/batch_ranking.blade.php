@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Quiz Rankings for {{ $batch->course->name }} - {{ $batch->name }} (Started: {{ $batch->start_date }})</h1>

    @if($quizSets->isEmpty())
        <div class="alert alert-warning">
            No quiz sets found for this batch.
        </div>
    @else
        <!-- Quiz Set Filter Dropdown -->
        <form method="GET" action="{{ route('student.batch_quiz_ranking', $batch->id) }}" class="mb-4">
            <div class="form-group">
                <label for="quiz_set_id">Filter by Quiz Set:</label>
                <select name="quiz_set_id" id="quiz_set_id" class="form-control" onchange="this.form.submit()">
                    <option value="">All Quiz Sets</option>
                    @foreach($quizSets as $quizSet)
                        <option value="{{ $quizSet->id }}" {{ $selectedQuizSetId == $quizSet->id ? 'selected' : '' }}>
                            {{ $quizSet->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    @endif

    @if(empty($studentResults))
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
                @foreach($studentResults as $index => $result)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $result->student_name }}</td>
                        <td>{{ $result->quiz_set_title }}</td>
                        <td>{{ $result->score }} / {{ $result->total_quizzes }}</td>
                        <td>{{ number_format($result->percentage, 2) }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('student.quiz_sets') }}" class="btn btn-secondary">Back to Quiz Sets</a>
</div>
@endsection