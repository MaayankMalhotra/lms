@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }
    th {
        background-color: #f9fafb;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.75rem;
    }
    tr:hover {
        background-color: #f8fafc;
    }
    .dataTables_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        margin-top: 1rem;
        margin-left: 1.5rem;
    }
    .dataTables_wrapper .dataTables_filter label {
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 300px;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        width: 100%;
        outline: none;
        transition: all 0.2s;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }
    .table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: #d1d5db #f9fafb;
    }
    .table-container::-webkit-scrollbar {
        height: 8px;
    }
    .table-container::-webkit-scrollbar-thumb {
        background-color: #d1d5db;
        border-radius: 4px;
    }
    .table-container::-webkit-scrollbar-track {
        background-color: #f9fafb;
    }
    /* Ensure actions column is always visible */
    .dataTables_wrapper .dt-buttons {
        margin-bottom: 1rem;
    }
    .actions-column {
        min-width: 100px;
        white-space: nowrap;
    }
</style>

<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-list mr-2 text-blue-500"></i>Student List
                </h1>
                <p class="text-gray-500 mt-2">Manage all students in the system</p>
            </div>
        </div>

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

        <!-- Student Table -->
        <div class="bg-white rounded-xl shadow-lg table-container">
            <table class="w-full" id="studentsTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Phone</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Registered At</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 actions-column">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($students as $index => $student)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $student['name'] }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student['email'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student['phone'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ date('d M Y', strtotime($student['created_at'])) }}</td>
                            <td class="px-6 py-4 actions-column">
                                <div class="flex space-x-4">
                                    <button class="text-blue-500 hover:text-blue-600 edit-student"
                                            data-id="{{ $student['id'] }}"
                                            data-url="{{ route('admin.student.edit', $student['id']) }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-600 delete-student"
                                            data-id="{{ $student['id'] }}"
                                            data-url="{{ route('admin.student.delete', $student['id']) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4"></i>
                                <p class="text-lg">No trainers found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div id="editStudentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Edit Student</h3>
                <button class="text-gray-500 hover:text-gray-700 modal-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editStudentForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="student_id">
                <div class="space-y-6">
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-blue-400"></i>Name
                        </label>
                        <input type="text" name="name" id="name" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                        <span class="error text-red-500 text-sm" id="name_error"></span>
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-blue-400"></i>Email
                        </label>
                        <input type="email" name="email" id="email" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                        <span class="error text-red-500 text-sm" id="email_error"></span>
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-phone mr-2 text-blue-400"></i>Phone (Optional)
                        </label>
                        <input type="text" name="phone" id="phone" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                        <span class="error text-red-500 text-sm" id="phone_error"></span>
                    </div>
                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="button" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg modal-close">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow p-6 w-96">
        <h2 class="text-lg font-semibold mb-4">Confirm Delete</h2>
        <p>Are you sure you want to delete this Student?</p>
        <div class="flex justify-end mt-6">
            <button class="px-4 py-2 bg-gray-300 rounded mr-2 modal-close">Cancel</button>
            <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('#studentsTable').DataTable({
            paging: false,
            searching: true,
            ordering: true,
            info: false,
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details for ' + data[1];
                        }
                    }),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            autoWidth: false,
            dom: '<"flex justify-between items-center mb-4"<"search"f>>rt<"bottom"lip><"clear">',
            language: {
                search: "",
                searchPlaceholder: "Search Students..."
            },
            columnDefs: [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: 1 },
                { responsivePriority: 3, targets: 5 }
            ]
        });

        $(document).on('click', '.edit-student', function () {
            const url = $(this).data('url');
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    $('#student_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone || '');
                    $('#editStudentForm').attr('action', '{{ route("admin.student.update", ":id") }}'.replace(':id', data.id));
                    $('.error').text('');
                    $('#editStudentModal').removeClass('hidden');
                    document.body.classList.add('modal-open');
                },
                error: function (xhr) {
                    console.error('Edit Error:', xhr);
                    alert('Failed to load student data: ' + (xhr.responseJSON?.message || 'Unknown error'));
                }
            });
        });

        $(document).on('click', '.modal-close', function () {
            $('#editStudentForm')[0].reset();
            $('.error').text('');
            $('#editStudentModal').addClass('hidden');
            $('#deleteModal').addClass('hidden');
            document.body.classList.remove('modal-open');
        });

        $('#editStudentForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    $('#editStudentModal').addClass('hidden');
                    document.body.classList.remove('modal-open');
                    alert(response.message || 'Student updated successfully');
                    window.location.reload();
                },
                error: function (xhr) {
                    console.error('Update Error:', xhr);
                    const errors = xhr.responseJSON?.errors;
                    $('.error').text('');
                    if (errors) {
                        $('#name_error').text(errors.name ? errors.name[0] : '');
                        $('#email_error').text(errors.email ? errors.email[0] : '');
                        $('#phone_error').text(errors.phone ? errors.phone[0] : '');
                    } else {
                        alert('Failed to update student: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                }
            });
        });

        let deleteId = null;

        $(document).on('click', '.delete-student', function () {
            deleteId = $(this).data('id');
            $('#deleteModal').removeClass('hidden');
            document.body.classList.add('modal-open');
        });

        $('#confirmDeleteBtn').on('click', function () {
            if (deleteId) {
                const url = $('.delete-student[data-id="' + deleteId + '"]').data('url');
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('#deleteModal').addClass('hidden');
                        document.body.classList.remove('modal-open');
                        alert(response.message || 'Student deleted successfully');
                        window.location.reload();
                    },
                    error: function (xhr) {
                        console.error('Delete Error:', xhr);
                        alert('Failed to delete student: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });
            }
        });
    });
</script>
@endsection