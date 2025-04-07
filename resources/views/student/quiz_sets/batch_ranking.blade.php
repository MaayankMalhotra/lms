@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-dark font-weight-bold">
            Quiz Rankings for {{ $batch->course->name }} - {{ $batch->name }}
            <small class="text-muted">(Started: {{ $batch->start_date }})</small>
        </h1>
        <a href="{{ route('student.quiz_sets') }}" class="btn btn-outline-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back to Quiz Sets
        </a>
    </div>

    <!-- Quiz Set Filter Section -->
    @if($quizSets->isEmpty())
        <div class="alert alert-warning shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i> No quiz sets found for this batch.
        </div>
    @else
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('student.batch_quiz_ranking', $batch->id) }}">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <label for="quiz_set_id" class="font-weight-bold text-dark">Filter by Quiz Set:</label>
                        </div>
                        <div class="col-md-6">
                            <select name="quiz_set_id" id="quiz_set_id" class="form-control custom-select shadow-sm" onchange="this.form.submit()">
                                <option value="">All Quiz Sets</option>
                                @foreach($quizSets as $quizSet)
                                    <option value="{{ $quizSet->id }}" {{ $selectedQuizSetId == $quizSet->id ? 'selected' : '' }}>
                                        {{ $quizSet->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Results Table -->
    @if(empty($studentResults))
        <div class="alert alert-info shadow-sm" role="alert">
            <i class="fas fa-info-circle mr-2"></i> No quiz attempts found for this batch yet.
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="py-3 px-4">Rank</th>
                                <th class="py-3 px-4">Student Name</th>
                                <th class="py-3 px-4">Quiz Set</th>
                                <th class="py-3 px-4">Score</th>
                                <th class="py-3 px-4">Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentResults as $index => $result)
                                <tr class="align-middle">
                                    <td class="py-3 px-4">
                                        <span class="badge badge-pill badge-primary">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="py-3 px-4">{{ $result->student_name }}</td>
                                    <td class="py-3 px-4">{{ $result->quiz_set_title }}</td>
                                    <td class="py-3 px-4">{{ $result->score }} / {{ $result->total_quizzes }}</td>
                                    <td class="py-3 px-4">
                                        <span class="font-weight-bold {{ $result->percentage >= 70 ? 'text-success' : ($result->percentage >= 40 ? 'text-warning' : 'text-danger') }}">
                                            {{ number_format($result->percentage, 2) }}%
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Custom CSS -->
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f5f9;
        transition: background-color 0.3s ease;
    }
    .badge-primary {
        font-size: 1rem;
        padding: 0.5em 0.8em;
    }
    .custom-select {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
    }
    .card {
        border-radius: 0.75rem;
        border: none;
    }
    .alert {
        border-radius: 0.5rem;
    }
    .btn-outline-secondary {
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection