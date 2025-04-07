@extends('admin.layouts.app')

@section('content')
<!-- Include DataTables and Font Awesome -->
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* Custom Styles */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ced4da;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        width: 100%;
        outline: none;
        transition: all 0.3s ease;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    .dataTables_wrapper .dataTables_filter label {
        position: relative;
        width: 100%;
    }
    .dataTables_wrapper .dataTables_filter label::before {
        content: '\f002';
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
    }
    .dataTables_wrapper .dataTables_filter input {
        padding-left: 2.5rem;
    }
    .custom-select {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }
    .custom-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f5f9;
        transition: background-color 0.3s ease;
    }
    .badge-rank {
        font-size: 0.9rem;
        padding: 0.4em 0.7em;
    }
</style>

<!-- Card Section -->
<div class="bg-white shadow-lg rounded-lg overflow-hidden mt-4">
    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-900 to-purple-800 text-white px-6 py-4 border-b-2 border-orange-500">
        <h4 class="text-xl font-bold">
            Quiz Rankings for {{ $batch->course->name }} - {{ $batch->name }}
            <small class="text-gray-200">(Started: {{ $batch->start_date }})</small>
        </h4>
    </div>

    <!-- Body -->
    <div class="p-6">
        <!-- Filter Section -->
        @if($quizSets->isEmpty())
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg mb-4">
                <i class="fas fa-exclamation-triangle mr-2"></i> No quiz sets found for this batch.
            </div>
        @else
            <div class="mb-4">
                <form method="GET" action="{{ route('student.batch_quiz_ranking', $batch->id) }}">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <label for="quiz_set_id" class="font-semibold text-gray-700">Filter by Quiz Set:</label>
                        </div>
                        <div class="col-md-6">
                            <select name="quiz_set_id" id="quiz_set_id" class="custom-select w-full" onchange="this.form.submit()">
                                <option value="">All Quiz Sets</option>
                                @foreach($quizSets as $quizSet)
                                    <option value="{{ $quizSet->id }}" {{ $selectedQuizSetId == $quizSet->id ? 'selected' : '' }}>
                                        {{ $quizSet->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 text-end">
                            <a href="{{ route('student.quiz_sets') }}" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600 transition duration-300 inline-flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i> Back to Quiz Sets
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        @endif

        <!-- Results Table -->
        @if(empty($studentResults))
            <div class="bg-blue-100 text-blue-700 p-4 rounded-lg">
                <i class="fas fa-info-circle mr-2"></i> No quiz attempts found for this batch yet.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="rankingsTable">
                    <thead class="bg-gradient-to-r from-indigo-900 to-purple-800 text-white">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Rank</th>
                            <th class="px-4 py-3 font-semibold">Student Name</th>
                            <th class="px-4 py-3 font-semibold">Quiz Set</th>
                            <th class="px-4 py-3 font-semibold">Score</th>
                            <th class="px-4 py-3 font-semibold">Percentage</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($studentResults as $index => $result)
                            <tr class="hover:bg-orange-500 hover:text-white transition duration-200">
                                <td class="px-4 py-3 text-gray-600">
                                    <span class="badge badge-pill badge-primary badge-rank">{{ $index + 1 }}</span>
                                </td>
                                <td class="px-4 py-3 text-gray-800">{{ $result->student_name }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $result->quiz_set_title }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $result->score }} / {{ $result->total_quizzes }}</td>
                                <td class="px-4 py-3">
                                    <span class="font-semibold {{ $result->percentage >= 70 ? 'text-green-600' : ($result->percentage >= 40 ? 'text-yellow-600' : 'text-red-600') }}">
                                        {{ number_format($result->percentage, 2) }}%
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function () {
        $('#rankingsTable').DataTable({
            paging: false,
            searching: true,
            ordering: true,
            info: false,
            responsive: true,
            autoWidth: false,
            dom: '<"flex justify-between items-center mb-4"<"search"f>>rt<"bottom"lip><"clear">',
            language: {
                search: "",
                searchPlaceholder: "Search rankings..."
            }
        });
    });
</script>
@endsection