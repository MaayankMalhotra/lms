@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="mx-auto px-3 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Enrollment Details (Total: {{ is_countable($enrollments) ? count($enrollments) : 0 }})</h1>
    </div>

    <!-- Success Message -->
    @if (session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <!-- Filter Section -->
    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
        <form action="{{ route('admin.enrollment.index') }}" method="GET">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Student Name</label>
                    <select name="student_name" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select options</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->name }}" {{ request('student_name') == $student->name ? 'selected' : '' }}>{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Student Email</label>
                    <select name="student_email" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select options</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->email }}" {{ request('student_email') == $student->email ? 'selected' : '' }}>{{ $student->email }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                    <select name="course_name" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select options</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->name }}" {{ request('course_name') == $course->name ? 'selected' : '' }}>{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Batch Name</label>
                    <select name="batch_name" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select options</option>
                        @foreach ($batches as $batch)
                            <option value="{{ $batch->batch_name }}" {{ request('batch_name') == $batch->batch_name ? 'selected' : '' }}>{{ $batch->batch_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">From</label>
                    <input type="date" name="from_date" value="{{ request('from_date') }}" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="YYYY-MM-DD">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">To</label>
                    <input type="date" name="to_date" value="{{ request('to_date') }}" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="YYYY-MM-DD">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                    <select name="payment_status" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select options</option>
                        <option value="completed" {{ request('payment_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Filter</button>
                <a href="{{ route('admin.enrollment.index') }}" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">Reset</a>
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="bg-white shadow-lg rounded-lg p-2">
        <div class="relative">
            <table id="enrollmentsTable" class="w-full text-sm text-gray-800 table-fixed">
                <thead class="bg-gray-100 text-xs text-gray-600 uppercase tracking-wider sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold min-w-[80px]">ID</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[140px]">Student</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[200px]">Email</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[140px]">Phone</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[140px]">Payment ID</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[120px]">Amount</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[120px]">Payment</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[160px]">EMI Details</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[160px]">Course</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[140px]">Start Date</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[120px]">Time Slot</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[140px]">Batch Price</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[120px]">Slots</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[140px]">Instructor</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[160px]">Enrolled At</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[120px]">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($enrollments ?? [] as $enrollment)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-4 py-3 truncate">{{ $enrollment->enrollment_id }}</td>
                        <td class="px-4 py-3 truncate">{{ $enrollment->student_name }}</td>
                        <td class="px-4 py-3">{{ $enrollment->student_email }}</td>
                        <td class="px-4 py-3 truncate">{{ $enrollment->phone }}</td>
                        <td class="px-4 py-3 truncate">{{ $enrollment->payment_id }}</td>
                        <td class="px-4 py-3 truncate">₹{{ number_format($enrollment->amount, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $enrollment->payment_status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($enrollment->payment_status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if ($enrollment->payment_method === 'emi' && !empty($enrollment->emi_schedule))
                            @php
                            $emiScheduleRaw = json_decode($enrollment->emi_schedule, true);
                            $emiSchedule = is_string($emiScheduleRaw) ? json_decode($emiScheduleRaw, true) : $emiScheduleRaw;

                            $totalEmis = is_array($emiSchedule) ? count($emiSchedule) : 0;

                            // Get next pending EMI
                            $nextEmi = null;
                            if (is_array($emiSchedule)) {
                            foreach ($emiSchedule as $emi) {
                            if (($emi['status'] ?? '') === 'pending') {
                            $nextEmi = $emi;
                            break;
                            }
                            }
                            }
                            @endphp

                            <button class="text-blue-600 hover:underline py-1 px-2 bg-green-600 rounded text-white" onclick="openEMIModal('emiModal{{ $enrollment->enrollment_id }}')">
                                View EMI Details
                            </button>

                            <div class="mt-2 text-xs">
                                <p><strong>Total EMIs:</strong> {{ $totalEmis }}</p>
                                @if ($nextEmi)
                                <p><strong>Next EMI:</strong> ₹{{ number_format($nextEmi['amount'], 2) }} due on {{ $nextEmi['due_date'] ?? 'N/A' }}</p>
                                @else
                                <p><strong>Next EMI:</strong> None</p>
                                @endif
                            </div>

                            <!-- EMI Modal -->
                            <div id="emiModal{{ $enrollment->enrollment_id }}" class="fixed inset-0 z-50 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
                                <div class="bg-white rounded-lg p-6 w-full max-w-lg h-[60vh] overflow-auto">
                                    <h2 class="text-lg font-bold mb-4">EMI Schedule</h2>
                                    @if (is_array($emiSchedule) && !empty($emiSchedule))
                                    <table class="w-full text-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-left py-2">Installment</th>
                                                <th class="text-left py-2">Amount</th>
                                                <th class="text-left py-2">Date</th>
                                                <th class="text-left py-2">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($emiSchedule as $emi)
                                            <tr>
                                                <td class="py-2">{{ $emi['installment_number'] ?? 'N/A' }}</td>
                                                <td class="py-2">₹{{ number_format($emi['amount'] ?? 0, 2) }}</td>
                                                <td class="py-2">
                                                    {{ $emi['paid_date'] ?? $emi['due_date'] ?? 'N/A' }}
                                                </td>
                                                <td class="py-2">{{ ucfirst($emi['status'] ?? 'N/A') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <p class="text-gray-500">No EMI schedule available.</p>
                                    @endif
                                    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700" onclick="closeEMIModal('emiModal{{ $enrollment->enrollment_id }}')">Close</button>
                                </div>
                            </div>

                            @else
                            <span class="text-gray-500">No EMI</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 truncate">{{ $enrollment->course_name }}</td>
                        <td class="px-4 py-3 truncate">{{ \Carbon\Carbon::parse($enrollment->start_date)->format('Y-m-d') }}</td>
                        <td class="px-4 py-3 truncate">{{ $enrollment->time_slot }}</td>
                        <td class="px-4 py-3 truncate">₹{{ number_format($enrollment->batch_price, 2) }}</td>
                        <td class="px-4 py-3 truncate">{{ $enrollment->slots_available }} / {{ $enrollment->slots_filled }}</td>
                        <td class="px-4 py-3 truncate">{{ $enrollment->instructor_name ?? 'N/A' }}</td>
                        <td class="px-4 py-3 truncate">{{ \Carbon\Carbon::parse($enrollment->enrollment_created_at)->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $enrollment->enrollment_status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-800' }}">
                                {{ ucfirst($enrollment->enrollment_status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="16" class="px-4 py-3 text-center text-gray-500">No enrollments found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#enrollmentsTable').DataTable({
                scrollX: true,
                scrollY: '60vh',
                scrollCollapse: true,
                paging: true,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                searching: true,
                ordering: true,
                columnDefs: [{
                        orderable: false,
                        targets: 1
                    },
                    {
                        width: '80px',
                        targets: 0
                    },
                    {
                        width: '160px',
                        targets: 1
                    },
                    {
                        width: '140px',
                        targets: 2
                    },
                    {
                        width: '200px',
                        targets: 3
                    },
                    {
                        width: '160px',
                        targets: 7
                    }, // EMI Details column
                ],
                fixedColumns: {
                    leftColumns: 1
                },
                dom: 'Bfrtip',
            });
        });

        // Modal functions
        function openEMIModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeEMIModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</div>
@endsection