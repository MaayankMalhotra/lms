@extends('admin.layouts.app')

@section('content')
 <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom Tailwind Overrides */
        .dataTables_wrapper .dataTables_filter input {
            @apply border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500;
        }
    </style>
            <!-- Card Section -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-900 to-purple-800 text-white px-6 py-4 border-b-2 border-orange-500">
                    <h4 class="text-xl font-bold">Trainer List</h4>
                </div>
                <div class="p-6">
                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">{{ session('error') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" id="studentsTable">
                            <thead class="bg-gradient-to-r from-indigo-900 to-purple-800 text-white">
                                <tr>
                                    <th class="px-4 py-3 font-semibold">#</th>
                                    <th class="px-4 py-3 font-semibold">Name</th>
                                    <th class="px-4 py-3 font-semibold">Email</th>
                                    <th class="px-4 py-3 font-semibold">Phone</th>
                                    <th class="px-4 py-3 font-semibold">Registered At</th>
                                    <th class="px-4 py-3 font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($students as $index => $student)
                                    <tr class="hover:bg-orange-500 hover:text-white transition duration-200">
                                        <td class="px-4 py-3 text-gray-600">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 text-gray-800">{{ $student->name }}</td>
                                        <td class="px-4 py-3 text-gray-800">{{ $student->email }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $student->phone ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ date('d M Y', strtotime($student->created_at)) }}</td>
                                        <td class="px-4 py-3 flex space-x-2">
                                            <a href="{{ route('admin.student.edit', $student->id) }}"
                                               class="bg-orange-500 text-white px-3 py-1 rounded-md hover:bg-orange-600 transition duration-300 flex items-center">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.student.delete', $student->id) }}"
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this student?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-300 flex items-center">
                                                    <i class="fas fa-trash mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-3 text-center text-gray-500">No students found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#studentsTable').DataTable({
                paging: false,
                searching: true,
                ordering: true,
                info: false,
                responsive: true,
                autoWidth: false,
                dom: '<"flex justify-between items-center mb-4"<"search"f>>rt<"bottom"lip><"clear">',
                language: {
                    search: "",
                    searchPlaceholder: "Search students..."
                }
            });
        });
    </script>
@endsection