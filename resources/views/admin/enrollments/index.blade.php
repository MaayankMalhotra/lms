@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <div class="max-w-7xl mx-auto p-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Enrollment Details (Total: )</h1>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Section -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <form action="" method="GET">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lead Fresh Range</label>
                        <select name="lead_fresh_range" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select options</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lead Quality</label>
                        <select name="lead_quality" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select options</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lead Source</label>
                        <select name="lead_source" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select options</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Followup Date Range</label>
                        <select name="followup_date_range" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select options</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Campaign Date Range</label>
                        <select name="campaign_date_range" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select options</option>
                        </select>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Filter</button>
                    <button type="button" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">Reset</button>
                </div>
            </form>
        </div>

      <!-- Include DataTables CSS -->

<!-- Table Container -->
<div class="bg-white shadow-lg rounded-lg overflow-hidden w-[70rem] p-2">
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
            scrollX: true, // Enable horizontal scrolling
            scrollY: '60vh', // Enable vertical scrolling with a fixed height
            scrollCollapse: true, // Adjust table height if less data
            paging: true, // Enable pagination
            pageLength: 10, // Number of rows per page
            lengthMenu: [10, 25, 50, 100], // Options for rows per page
            searching: true, // Enable search
            ordering: true, // Enable column sorting
            columnDefs: [
                { orderable: false, targets: 1 }, // Disable sorting for "Action" column
                { width: '80px', targets: 0 }, // Set width for ID column
                { width: '160px', targets: 1 }, // Set width for Action column
                { width: '140px', targets: 2 }, // Set width for Student column
                { width: '200px', targets: 3 }, // Set width for Email column
                // Add more columnDefs as needed
            ],
            fixedColumns: {
                leftColumns: 1 // Fix the ID column
            },
            dom: 'Bfrtip', // Customize DataTables layout
        });
    });
</script>
    </div>
@endsection