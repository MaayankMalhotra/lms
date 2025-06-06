@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        min-width: 1000px;
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
        margin-left: 1rem;
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
</style>

<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-list mr-2 text-blue-500"></i>Trainer List
                </h1>
                <p class="text-gray-500 mt-2">Manage all trainers in the system</p>
            </div>
            <button onclick="openModal('createTrainerModal')"
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition-all flex items-center">
                <i class="fas fa-plus-circle mr-2"></i>Add New Trainer
            </button>
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

        <!-- Trainers Table -->
        <div class="bg-white rounded-xl shadow-lg table-container">
            <table class="w-full" id="trainersTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Phone</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Experience</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Teaching Hours</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Courses</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Registered At</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($trainers as $index => $trainer)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $trainer->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $trainer->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $trainer->phone ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $trainer->trainerDetail->experience ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $trainer->trainerDetail->teaching_hours ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $trainer->course_names ?? 'None' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $trainer->created_at ? date('d M Y', strtotime($trainer->created_at)) : 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-4">
                                    @if($trainer->trainerDetail)
                                        <button onclick="openEditModal('{{$trainer->trainerDetail->id}}')"
                                         class="text-blue-500 hover:text-blue-600">
                                         <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal({{ $trainer->trainerDetail->id }})" 
                                        class="text-red-500 hover:text-red-600">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-4"></i>
                                <p class="text-lg">No trainers found. Start by adding a new trainer!</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Trainer Modal -->
<div id="createTrainerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Create New Trainer</h3>
                <button onclick="closeModal('createTrainerModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('admin.trainers.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-blue-400"></i>Select Trainer
                        </label>
                        <select name="user_id" id="create_user_id" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" required>
                            <option value="" disabled selected>Select a trainer</option>
                            @foreach ($availableTrainers as $trainer)
                                <option value="{{ $trainer->id }}">{{ $trainer->name }} ({{ $trainer->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-briefcase mr-2 text-blue-400"></i>Experience
                        </label>
                        <input type="text" name="experience" id="create_experience" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" required>
                        @error('experience')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-2 text-blue-400"></i>Teaching Hours
                        </label>
                        <input type="number" name="teaching_hours" id="create_teaching_hours" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" min="0" required>
                        @error('teaching_hours')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-book mr-2 text-blue-400"></i>Courses
                        </label>
                        <select name="course_ids[]" id="create_course_ids" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" multiple>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        <div id="selectedCoursesDisplay" class="mt-2 text-sm text-gray-700">No courses selected</div>
                        @error('course_ids')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-book mr-2 text-blue-400"></i>Courses
                        </label>
                    <div id="create_course_container" class="flex flex-wrap gap-2 mb-2"></div>
                    <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto border border-gray-200 rounded-lg p-2">
                        @foreach ($courses as $course)
                            <div onclick="toggleCourseSelection('create', {{ $course->id }}, '{{ $course->name }}')" class="cursor-pointer px-3 py-2 rounded-lg border border-blue-400 text-blue-600 hover:bg-blue-100" id="create_course_{{ $course->id }}">
                            {{ $course->name }}
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="course_ids[]" id="create_course_ids_input">
                    @error('course_ids')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="button" onclick="closeModal('createTrainerModal')" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Trainer Modal -->
<div id="editTrainerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Edit Trainer</h3>
                <button onclick="closeModal('editTrainerModal')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editTrainerForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editTrainerId">
                <input type="hidden" name="user_id" id="edit_user_id_hidden">
                <div class="space-y-6">
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-blue-400"></i>Trainer
                        </label>
                        <select id="edit_user_id" class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-100 cursor-not-allowed" disabled>
                            <option value="" disabled>Select a trainer</option>
                            @foreach ($availableTrainers as $trainer)
                                <option value="{{ $trainer->id }}">{{ $trainer->name }} ({{ $trainer->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-briefcase mr-2 text-blue-400"></i>Experience
                        </label>
                        <input type="text" name="experience" id="edit_experience" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all required">
                            @error('experience')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-clock mr-2 text-blue-400"></i>Teaching Hours
                        </label>
                        <input type="number" name="teaching_hours" id="edit_teaching_hours" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" min="0" required>
                        @error('teaching_hours')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-book mr-2 text-blue-400"></i>Courses
                        </label>
                        <select name="course_ids[]" id="edit_course_ids" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all" multiple>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                         <div id="editCoursesDisplay" class="mt-2 text-sm text-gray-700">No courses selected</div>
                        @error('course_ids')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-book mr-2 text-blue-400"></i>Courses
                        </label>
                    <div id="edit_course_container" class="flex flex-wrap gap-2 mb-2"></div>
                    <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto border border-gray-200 rounded-lg p-2">
                        @foreach ($courses as $course)
                            <div onclick="toggleCourseSelection('edit', {{ $course->id }}, '{{ $course->name }}')" class="cursor-pointer px-3 py-2 rounded-lg border border-blue-400 text-blue-600 hover:bg-blue-100" id="edit_course_{{ $course->id }}">
                            {{ $course->name }}
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="course_ids[]" id="edit_course_ids_input">
                        @error('course_ids')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="button" onclick="closeModal('editTrainerModal')" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">
                            Update
                        </button>
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
        <p>Are you sure you want to delete this trainer?</p>
        <div class="flex justify-end mt-6">
            <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 rounded mr-2">Cancel</button>
            <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
        </div>
    </div>
</div>

<!-- START OF UPDATED SECTION -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    const selectedCourses = {
        create: [],
        edit: []
    };

    function toggleCourseSelection(mode, courseId, courseName) {
        const index = selectedCourses[mode].indexOf(courseId);
        const courseDiv = document.getElementById(`${mode}_course_${courseId}`);

        if (index === -1) {
            selectedCourses[mode].push(courseId);
            courseDiv.classList.add('bg-blue-200');
        } else {
            selectedCourses[mode].splice(index, 1);
            courseDiv.classList.remove('bg-blue-200');
        }

        updateHiddenInput(mode);
        updateCourseTags(mode);
    }

    function updateHiddenInput(mode) {
        const input = document.getElementById(`${mode}_course_ids_input`);
        input.value = selectedCourses[mode].join(',');
    }

    function updateCourseTags(mode) {
        const container = document.getElementById(`${mode}_course_container`);
        container.innerHTML = '';
        selectedCourses[mode].forEach(id => {
            const tag = document.createElement('span');
            tag.className = 'bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded';
            tag.innerText = document.getElementById(`${mode}_course_${id}`).innerText;
            container.appendChild(tag);
        });
    }

    function preloadEditCourses(courseIds) {
        selectedCourses.edit = [...courseIds];
        updateHiddenInput('edit');
        updateCourseTags('edit');
        selectedCourses.edit.forEach(id => {
            const div = document.getElementById(`edit_course_${id}`);
            if (div) div.classList.add('bg-blue-200');
        });
    }

    $(document).ready(function () {
        var table = $('#trainersTable').DataTable({
            paging: false,
            searching: true,
            ordering: true,
            info: false,
            autoWidth: false,
            dom: '<"flex justify-between items-center mb-4"<"search"f>>t<"bottom"lip><"clear">',
            language: {
                search: "",
                searchPlaceholder: "Search trainers..."
            },
            columns: [
                { data: null, searchable: false },
                { data: 'name', searchable: true },
                { data: 'email', searchable: true },
                { data: 'phone', searchable: true },
                { data: 'experience', searchable: false },
                { data: 'teaching_hours', searchable: false },
                { data: 'courses', searchable: false },
                { data: 'registered_at', searchable: false },
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return $('#trainersTable tbody tr:eq(' + meta.row + ') td:eq(8)').html();
                    }
                }
            ],
            createdRow: function (row, data, dataIndex) {
                $('td:eq(0)', row).html(dataIndex + 1);
                $('td:eq(1)', row).html('<div class="text-sm font-medium text-gray-900">' + (data.name || '') + '</div>');
                $('td:eq(2)', row).html(data.email || '');
                $('td:eq(3)', row).html(data.phone || 'N/A');
                $('td:eq(4)', row).html(data.experience || 'N/A');
                $('td:eq(5)', row).html(data.teaching_hours || 'N/A');
                $('td:eq(6)', row).html(data.courses || 'None');
                $('td:eq(7)', row).html(data.registered_at || 'N/A');
            },
            initComplete: function () {
                console.log('DataTable data:', this.api().data().toArray());
            }
        });

        $('.dataTables_filter input').on('input', function () {
            table.search($(this).val()).draw();
        });
    });

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('modal-open');
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('modal-open');
        }

        if (modalId === 'editTrainerModal') {
            $('#editTrainerForm')[0].reset();
            $('#edit_user_id_hidden').val('');
            selectedCourses.edit = [];
            updateHiddenInput('edit');
            updateCourseTags('edit');
            document.querySelectorAll('[id^="edit_course_"]').forEach(div => {
                div.classList.remove('bg-blue-200');
            });
        }

        if (modalId === 'createTrainerModal') {
            selectedCourses.create = [];
            updateHiddenInput('create');
            updateCourseTags('create');
            document.querySelectorAll('[id^="create_course_"]').forEach(div => {
                div.classList.remove('bg-blue-200');
            });
        }
    }

    function openEditModal(id) {
        $.ajax({
            url: '{{ route("admin.trainers.edit", ":id") }}'.replace(':id', id),
            method: 'GET',
            success: function (data) {
                $('#editTrainerForm')[0].reset();
                $('#editTrainerId').val(data.id);
                $('#edit_user_id').val(data.user_id);
                $('#edit_user_id_hidden').val(data.user_id);
                $('#edit_experience').val(data.experience);
                $('#edit_teaching_hours').val(data.teaching_hours);

                // Reset previous selections
                document.querySelectorAll('[id^="edit_course_"]').forEach(div => {
                    div.classList.remove('bg-blue-200');
                });

                const courseIds = (data.course_ids || []).map(id => parseInt(id));
                preloadEditCourses(courseIds);
                openModal('editTrainerModal');
            },
            error: function (xhr) {
                alert('Failed to load trainer data: ' + (xhr.responseJSON?.message || 'Unknown error'));
            }
        });
    }

    $('#editTrainerForm').on('submit', function (e) {
        e.preventDefault();
        var trainerId = $('#editTrainerId').val();
        $.ajax({
            url: '{{ route("admin.trainers.update", ":id") }}'.replace(':id', trainerId),
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                closeModal('editTrainerModal');
                alert(response.message || 'Trainer updated successfully');
                location.reload();
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors || { message: xhr.responseJSON?.message || 'Unknown error' };
                let errorMessage = Object.values(errors).flat().join('\n');
                alert('Failed to update trainer:\n' + errorMessage);
            }
        });
    });
</script>


<script>
    let deleteId = null;

    function openDeleteModal(id) {
        deleteId = id;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        deleteId = null;
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (deleteId) {
            fetch(`/admin/trainers/${deleteId}/delete`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest', 
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(async response => {
                const contentType = response.headers.get("content-type");
                let result = null;

                if (contentType && contentType.includes("application/json")) {
                    result = await response.json();
                } else {
                    result = await response.text();
                }

                if (response.ok && result && result.success) {
                    alert(result.message || 'Trainer deleted successfully!');
                    closeDeleteModal();
                    window.location.reload();
                } else {
                    console.error('Delete error:', result);
                    alert('Failed to delete trainer. Check console for more info.');
                }
            })
            .catch(error => {
                console.error('Request failed:', error);
                alert('Something went wrong. Please try again.');
            });
        }
    });
</script>

@endsection