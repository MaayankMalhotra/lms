@extends('admin.layouts.app')

@section('content')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
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
</style>

<!-- Edit Course Modal -->
<div id="editCourseModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl p-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Edit Course</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editCourseForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Course Name & Code -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-book mr-2 text-blue-400"></i>Course Name
                            </label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                id="edit_name">
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-hashtag mr-2 text-blue-400"></i>Course Code
                            </label>
                            <input type="text" name="course_code_id" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                id="edit_course_code_id">
                        </div>
                    </div>

                    <!-- Course Logo Upload -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-image mr-2 text-blue-400"></i>Course Logo
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col w-full h-32 border-4 border-dashed hover:border-gray-300 hover:bg-gray-50 transition-all rounded-xl cursor-pointer">
                                <div id="logoPreview" class="flex flex-col items-center justify-center">
                                    <!-- Preview will be inserted here -->
                                </div>
                                <input type="file" name="logo" class="opacity-0">
                            </label>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Current logo: <span id="currentLogo"></span></p>
                    </div>

                    <!-- Duration & Learners -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-clock mr-2 text-blue-400"></i>Course Duration
                            </label>
                            <input type="text" name="duration"
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                id="edit_duration">
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-users mr-2 text-blue-400"></i>Placed Learners
                            </label>
                            <input type="number" name="placed_learner" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                id="edit_placed_learner">
                        </div>
                    </div>

                    <!-- Slug & Rating -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-link mr-2 text-blue-400"></i>Course Slug
                            </label>
                            <input type="text" name="slug" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                id="edit_slug">
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-star mr-2 text-blue-400"></i>Course Rating : Example-4.8 (17K+ students)
                            </label>
                            <div class="relative">
                                <input type="text" name="rating" step="0.1"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                    id="edit_rating">
                            </div>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tag mr-2 text-blue-400"></i>Course Price
                        </label>
                        <div class="relative">
                            <input type="text" name="price"
                                class="w-full pl-8 pr-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                id="edit_price">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-4 px-6 rounded-xl transition-all">
                            Update Course
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8">
            <div class="text-center">
                <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                <h3 class="text-2xl font-bold mb-4">Delete Course</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this course? This action cannot be undone.</p>
                <div class="flex justify-center space-x-4">
                    <button onclick="closeDeleteModal()" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                        Cancel
                    </button>
                    <button id="confirmDelete" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Initialize route URLs
    const updateRoute = "{{ route('admin.course.update', ['course' => ':id']) }}";
    const deleteRoute = "{{ route('admin.course.delete', ['course' => ':id']) }}";
</script>

<script>
function closeModal() {
    document.getElementById('editCourseModal').classList.add('hidden');
}

// Function to close the delete modal
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
$(document).ready(function() {
    // Open modal and load data
    window.openEditModal = function(editUrl) {
        $.ajax({
            url: editUrl,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Populate form fields
                $('#edit_name').val(data.name);
                $('#edit_course_code_id').val(data.course_code_id);
                $('#edit_duration').val(data.duration);
                $('#edit_placed_learner').val(data.placed_learner);
                $('#edit_slug').val(data.slug);
                $('#edit_rating').val(data.rating);
                $('#edit_price').val(data.price);
                console.log(data.logo)

                // Handle logo preview
                const logoPreview = $('#logoPreview');
                const currentLogo = $('#currentLogo');
                if (data.logo) {
                    const imageUrl = "{{ asset('') }}" + data.logo; // Ensure correct asset path
                    logoPreview.html(`<img src="${imageUrl}" class="h-28 object-contain p-2" alt="Course logo">`);
                    currentLogo.text('Upload new file to change');
                } else {
                    logoPreview.html(`
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-500">Drag & drop or click to upload</p>
                    `);
                    currentLogo.text('No logo uploaded');
                }

                // Update form action using named route
                $('#editCourseForm').attr('action', updateRoute.replace(':id', data.id));

                // Show modal
                $('#editCourseModal').removeClass('hidden');
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    };

    // Delete Course Modal functions
    window.openDeleteModal = function(deleteUrl) {
        $('#deleteModal').data('delete-url', deleteUrl).removeClass('hidden');
    };

    // Handle delete confirmation
    $('#confirmDelete').click(function() {
        const deleteUrl = $('#deleteModal').data('delete-url');
        
        $.ajax({
            url: deleteUrl,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.success) {
                    location.reload();
                }
            },
            error: function(xhr) {
                let errorMessage = 'Error deleting course';
                if (xhr.status === 404) {
                    errorMessage = 'Course not found';
                } else if (xhr.status === 500) {
                    errorMessage = 'Server error';
                }
                showError(errorMessage);
                console.error('Error details:', xhr.responseText);
            }
        });
    });
});
</script>

<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-list mr-2 text-blue-500"></i>Course List
                </h1>
                <p class="text-gray-500 mt-2">Manage all available courses in the system</p>
            </div>
            <a href="{{ route('admin.course.add') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition-all">
                <i class="fas fa-plus-circle mr-2"></i>Add New Course
            </a>
        </div>

        <!-- Courses Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Logo</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Course Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Course Slug</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Code</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Duration</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Price</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($courses as $course)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            @if($course->logo)
                            <img src="{{ asset($course->logo) }}"
                                class="w-12 h-12 rounded-lg object-cover shadow-sm"
                                alt="{{ $course->name }} logo">
                            @else
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $course->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">{{ $course->slug }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $course->course_code_id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $course->duration }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-blue-600">
                            ₹{{ number_format($course->price, 2) }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-4">
                                <button onclick="openEditModal(`{{ route('admin.course.edit', $course->id) }}`)" 
                                        class="text-blue-500 hover:text-blue-600" title="Edit Course">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @if($course->course_details_id)
                                    <a href="{{ route('course.edit', $course->course_details_id) }}" 
                                       class="text-green-500 hover:text-green-600" title="Edit Course Detail">
                                        <i class="fas fa-book-open"></i>
                                    </a>
                                @endif
                                <button type="button"
                                        onclick="openDeleteModal(`{{ route('admin.course.delete', $course->id) }}`)" 
                                        class="text-red-500 hover:text-red-600" title="Delete Course">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($courses->isEmpty())
            <div class="p-12 text-center text-gray-500">
                <i class="fas fa-inbox text-4xl mb-4"></i>
                <p class="text-lg">No courses found. Start by adding a new course!</p>
            </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($courses->hasPages())
        <div class="mt-8">
            {{ $courses->links() }}
        </div>
        @endif
    </div>
</div>
@endsection