@extends('admin.layouts.app')

@section('content')
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom Tailwind Overrides */
        .dataTables_wrapper .dataTables_filter input {
            @apply border-gray-500 border-2 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500;
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Slightly darker overlay */
            z-index: 1000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.4s ease-in-out, visibility 0.4s ease-in-out;
            visibility: hidden;
        }
        .modal.show {
            display: flex;
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            background-color: #f9fafb; /* Light gray for modern look */
            padding: 32px;
            border-radius: 16px; /* Softer corners */
            width: 100%;
            max-width: 540px; /* Slightly smaller for focus */
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
            transform: translateY(-100px);
            transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out;
        }
        .modal.show .modal-content {
            transform: translateY(0);
            opacity: 1;
        }
        .modal-close {
            position: absolute;
            top: 12px;
            right: 12px;
            cursor: pointer;
            font-size: 1.75rem;
            color: #6b7280; /* Gray for subtlety */
            transition: color 0.2s, transform 0.2s;
        }
        .modal-close:hover {
            color: #1f2937;
            transform: scale(1.1); /* Subtle zoom on hover */
        }
        .modal-content input,
        .modal-content textarea {
            @apply border-gray-300 border-2 rounded-lg p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 w-full transition-all duration-300;
        }
        .modal-content label {
            @apply text-gray-800 font-medium mb-2 block text-sm uppercase tracking-wider;
        }
        .modal-content .error {
            @apply mt-1.5 text-red-500 text-xs font-medium;
        }
        .modal-header {
            @apply bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-4 rounded-t-lg -mx-8 -mt-8 mb-6;
        }
        /* Button Hover Effects */
        .modal-content button[type="submit"] {
            @apply bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 hover:shadow-lg transition-all duration-300;
        }
        .modal-content button.modal-close:not(.modal-close-icon) {
            @apply bg-gray-100 text-gray-600 px-6 py-2.5 rounded-lg hover:bg-gray-200 hover:shadow-md transition-all duration-300;
        }
    </style>

    <!-- Card Section (Unchanged) -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-900 to-purple-800 text-white px-6 py-4 border-b-2 border-orange-500">
            <h4 class="text-xl font-bold">Trainer List</h4>
        </div>
        <div class="p-6">
            <!-- Alerts (Unchanged) -->
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

            <!-- Table (Unchanged) -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="trainersTable">
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
                        @forelse ($trainers as $index => $trainer)
                            <tr class="hover:bg-orange-500 hover:text-white transition duration-200">
                                <td class="px-4 py-3 text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $trainer->name }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $trainer->email }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $trainer->phone ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ date('d M Y', strtotime($trainer->created_at)) }}</td>
                                <td class="px-4 py-3 flex space-x-2">
                                    <button type="button"
                                            class="bg-orange-500 text-white px-3 py-1 rounded-md hover:bg-orange-600 transition duration-300 flex items-center edit-trainer"
                                            data-id="{{ $trainer->id }}"
                                            data-url="{{ route('admin.trainer.edit', $trainer->id) }}">
                                        <i class="fas fa-edit mr-1"></i>
                                    </button>
                                    <button type="button"
                                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-300 flex items-center delete-trainer"
                                            data-id="{{ $trainer->id }}"
                                            data-url="{{ route('admin.trainer.delete', $trainer->id) }}">
                                        <i class="fas fa-trash mr-1"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-3 text-center text-gray-500">No trainers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Trainer Modal (Updated) -->
    <div class="modal" id="editTrainerModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-xl font-semibold">Edit Trainer</h2>
                <span class="modal-close modal-close-icon">×</span>
            </div>
            <form id="editTrainerForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="trainer_id">
                <div class="mb-6">
                    <label for="name" class="block">Name</label>
                    <input type="text" name="name" id="name" class="transition-all duration-300">
                    <span class="error" id="name_error"></span>
                </div>
                <div class="mb-6">
                    <label for="email" class="block">Email</label>
                    <input type="email" name="email" id="email" class="transition-all duration-300">
                    <span class="error" id="email_error"></span>
                </div>
                <div class="mb-6">
                    <label for="phone" class="block">Phone (Optional)</label>
                    <input type="text" name="phone" id="phone" class="transition-all duration-300">
                    <span class="error" id="phone_error"></span>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" class="modal-close">Cancel</button>
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts (Unchanged) -->
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
            $('#trainersTable').DataTable({
                paging: false,
                searching: true,
                ordering: true,
                info: false,
                responsive: true,
                autoWidth: false,
                dom: '<"flex justify-between items-center mb-4"<"search"f>>rt<"bottom"lip><"clear">',
                language: {
                    search: "",
                    searchPlaceholder: "Search trainers..."
                }
            });

            $('.edit-trainer').on('click', function () {
                const url = $(this).data('url');
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (data) {
                        $('#trainer_id').val(data.id);
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#phone').val(data.phone);
                        $('#editTrainerForm').attr('action', '{{ url("admin/trainer") }}/' + data.id);
                        $('.error').text('');
                        $('#editTrainerModal').addClass('show');
                    },
                    error: function (xhr) {
                        console.error('Edit Error:', xhr);
                        alert('Failed to load trainer data: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });
            });

            $('.modal-close').on('click', function () {
                $('#editTrainerModal').removeClass('show');
            });

            $('#editTrainerForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#editTrainerModal').removeClass('show');
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
                            alert('Failed to update trainer: ' + (xhr.responseJSON?.message || 'Unknown error'));
                        }
                    }
                });
            });

            $('.delete-trainer').on('click', function () {
                if (!confirm('Are you sure you want to delete this trainer?')) return;
                const url = $(this).data('url');
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        window.location.reload();
                    },
                    error: function (xhr) {
                        console.error('Delete Error:', xhr);
                        alert('Failed to delete trainer: ' + (xhr.responseJSON?.message || 'Unknown error'));
                    }
                });
            });
        });
    </script>
@endsection