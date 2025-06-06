@extends('admin.layouts.app')

@section('title', 'Manage Homepage')

@section('content')
<div class="bg-[#f8eeea] p-8 rounded-3xl shadow-lg">
    <h1 class="text-4xl font-bold text-center text-[#2c0b57] mb-8">
        Manage Homepage Content
    </h1>

    <!-- Tabs Navigation -->
    <div class="mt-8 overflow-x-auto hide-scrollbar">
        <ul class="flex space-x-4 whitespace-nowrap justify-center">
            @foreach(['Placements', 'Courses', 'Upcoming Courses', 'Internships', 'Instructors', 'Testimonials', 'FAQs'] as $tab)
                <li>
                    <button class="nav-tab text-lg font-bold hover:text-[#ff7300] hover:border-[#ff7300] transition-all duration-300 px-4 py-2 rounded-xl {{ $loop->first ? 'text-white bg-[#ff7300]' : '' }}" data-tab="tab-{{ str_replace(' ', '-', strtolower($tab)) }}" data-active="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $tab }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Tab Content -->
    <div class="mt-12">
        <!-- Placements -->
        <div id="tab-placements" class="tab-pane">
            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Add Placement</h2>
            <form action="{{ route('admin.placements.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-lg card mb-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Qualification</label>
                        <input type="text" name="qualification" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" accept="image/*" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tags (comma-separated)</label>
                        <input type="text" name="tags" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Company</label>
                        <input type="text" name="company" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Package</label>
                        <input type="text" name="package" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-3 rounded-lg font-bold hover:shadow-lg transition-all">Add Placement</button>
            </form>

            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Existing Placements</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-xl shadow-lg text-left">
                    <thead>
                        <tr class="bg-[#2c0b57] text-white">
                            <th class="p-4 w-40 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($placements as $placement)
                            <tr class="card hover:bg-gray-50">
                                <td class="p-4 text-center">
                                    <button x-data="{ open{{ $placement->id }}: false }" @click="open{{ $placement->id }} = !open{{ $placement->id }}" class="text-blue-500 hover:text-blue-700 text-sm mr-2">Edit</button>
                                    <form x-show="open{{ $placement->id }}" action="{{ route('admin.placements.update', $placement->id) }}" method="POST" enctype="multipart/form-data" class="mt-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 gap-2">
                                            <input type="text" name="name" value="{{ $placement->name }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="qualification" value="{{ $placement->qualification }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="file" name="image" accept="image/*" class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="tags" value="{{ $placement->tags }}" class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="company" value="{{ $placement->company }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="package" value="{{ $placement->id }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="checkbox" name="is_active" value="1" {{ $placement->is_active ? 'checked' : '' }} class="h-4 w-4">
                                            <button type="submit" class="bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-1 px-3 rounded-lg text-sm">Update</button>
                                        </div>
                                    </form>
                                    <form action="{{ route('admin.placements.delete', $placement->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Courses -->
        <div id="tab-courses" class="tab-pane hidden">
            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Add Course</h2>
            <form action="{{ route('admin.courses.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-lg card mb-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image URL</label>
                        <input type="text" name="image" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Duration</label>
                        <input type="text" name="duration" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Placed Count</label>
                        <input type="number" name="placed_count" required min="0" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rating (0-5)</label>
                        <input type="number" name="rating" required min="0" max="5" step="0.1" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Student Count</label>
                        <input type="number" name="student_count" required min="0" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-3 rounded-lg font-bold hover:shadow-lg transition-all">Add Course</button>
            </form>

            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Existing Courses</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-xl shadow-lg text-left">
                    <thead>
                        <tr class="bg-[#2c0b57] text-white">
                            <th class="p-4 w-40 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr class="card hover:bg-gray-50">
                                <td class="p-4 text-center">
                                    <button x-data="{ open{{ $course->id }}: false }" @click="open{{ $course->id }} = !open{{ $course->id }}" class="text-blue-500 hover:text-blue-700 text-sm mr-2">Edit</button>
                                    <form x-show="open{{ $course->id }}" action="{{ route('admin.courses.update', $course->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 gap-2">
                                            <input type="text" name="title" value="{{ $course->title }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="image" value="{{ $course->image }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="duration" value="{{ $course->duration }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="number" name="placed_count" value="{{ $course->placed_count }}" required min="0" class="p-2 border rounded-lg text-sm">
                                            <input type="number" name="rating" value="{{ $course->rating }}" required min="0" max="5" step="0.1" class="p-2 border rounded-lg text-sm">
                                            <input type="number" name="student_count" value="{{ $course->student_count }}" required min="0" class="p-2 border rounded-lg text-sm">
                                            <input type="checkbox" name="is_active" value="1" {{ $course->is_active ? 'checked' : '' }} class="h-4 w-4">
                                            <button type="submit" class="bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-1 px-3 rounded-lg text-sm">Update</button>
                                        </div>
                                    </form>
                                    <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Upcoming Courses -->
        <div id="tab-upcoming-courses" class="tab-pane hidden">
            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Add Upcoming Course</h2>
            <form action="{{ route('admin.upcoming_courses.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-lg card mb-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image URL</label>
                        <input type="text" name="image" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="start_date" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="slots_open" value="1" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm font-medium text-gray-700">Slots Open</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-3 rounded-lg font-bold hover:shadow-lg transition-all">Add Upcoming Course</button>
            </form>

            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Existing Upcoming Courses</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-xl shadow-lg text-left">
                    <thead>
                        <tr class="bg-[#2c0b57] text-white">
                            <th class="p-4 w-40 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($upcomingCourses as $course)
                            <tr class="card hover:bg-gray-50">
                                <td class="p-4 text-center">
                                    <button x-data="{ open{{ $course->id }}: false }" @click="open{{ $course->id }} = !open{{ $course->id }}" class="text-blue-500 hover:text-blue-700 text-sm mr-2">Edit</button>
                                    <form x-show="open{{ $course->id }}" action="{{ route('admin.upcoming_courses.update', $course->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 gap-2">
                                            <input type="text" name="title" value="{{ $course->title }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="image" value="{{ $course->image }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="date" name="start_date" value="{{ $course->start_date }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="checkbox" name="slots_open" value="1" {{ $course->slots_open ? 'checked' : '' }} class="h-4 w-4">
                                            <input type="checkbox" name="is_active" value="1" {{ $course->is_active ? 'checked' : '' }} class="h-4 w-4">
                                            <button type="submit" class="bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-1 px-3 rounded-lg text-sm">Update</button>
                                        </div>
                                    </form>
                                    <form action="{{ route('admin.upcoming_courses.delete', $course->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Internships -->
        <div id="tab-internships" class="tab-pane hidden">
            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Add Internship</h2>
            <form action="{{ route('admin.internships.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-lg card mb-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image URL</label>
                        <input type="text" name="image" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Duration</label>
                        <input type="text" name="duration" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Project Count</label>
                        <input type="number" name="project_count" required min="0" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rating (0-5)</label>
                        <input type="number" name="rating" required min="0" max="5" step="0.1" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Applicant Count</label>
                        <input type="number" name="applicant_count" required min="0" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Certification</label>
                        <input type="text" name="certification" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-3 rounded-lg font-bold hover:shadow-lg transition-all">Add Internship</button>
            </form>

            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Existing Internships</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-xl shadow-lg text-left">
                    <thead>
                        <tr class="bg-[#2c0b57] text-white">
                            <th class="p-4 w-40 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($internships as $internship)
                            <tr class="card hover:bg-gray-50">
                                <td class="p-4 text-center">
                                    <button x-data="{ open{{ $internship->id }}: false }" @click="open{{ $internship->id }} = !open{{ $internship->id }}" class="text-blue-500 hover:text-blue-700 text-sm mr-2">Edit</button>
                                    <form x-show="open{{ $internship->id }}" action="{{ route('admin.internships.update', $internship->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 gap-2">
                                            <input type="text" name="title" value="{{ $internship->title }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="image" value="{{ $internship->image }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="duration" value="{{ $internship->duration }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="number" name="project_count" value="{{ $internship->project_count }}" required min="0" class="p-2 border rounded-lg text-sm">
                                            <input type="number" name="rating" value="{{ $internship->rating }}" required min="0" max="5" step="0.1" class="p-2 border rounded-lg text-sm">
                                            <input type="number" name="applicant_count" value="{{ $internship->applicant_count }}" required min="0" class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="certification" value="{{ $internship->certification }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="checkbox" name="is_active" value="1" {{ $internship->is_active ? 'checked' : '' }} class="h-4 w-4">
                                            <button type="submit" class="bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-1 px-3 rounded-lg text-sm">Update</button>
                                        </div>
                                    </form>
                                    <form action="{{ route('admin.internships.delete', $internship->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Instructors -->
        <div id="tab-instructors" class="tab-pane hidden">
            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Add Instructor</h2>
            <form action="{{ route('admin.instructors.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-lg card mb-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" accept="image/*" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Teaching Hours</label>
                        <input type="number" name="teaching_hours" required min="0" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Specialization</label>
                        <input type="text" name="specialization" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Facebook URL</label>
                        <input type="url" name="facebook_url" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-3 rounded-lg font-bold hover:shadow-lg transition-all">Add Instructor</button>
            </form>

            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Existing Instructors</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-xl shadow-lg text-left">
                    <thead>
                        <tr class="bg-[#2c0b57] text-white">
                            <th class="p-4 w-40 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($instructors as $instructor)
                            <tr class="card hover:bg-gray-50">
                                <td class="p-4 text-center">
                                    <button x-data="{ open{{ $instructor->id }}: false }" @click="open{{ $instructor->id }} = !open{{ $instructor->id }}" class="text-blue-500 hover:text-blue-700 text-sm mr-2">Edit</button>
                                    <form x-show="open{{ $instructor->id }}" action="{{ route('admin.instructors.update', $instructor->id) }}" method="POST" enctype="multipart/form-data" class="mt-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 gap-2">
                                            <input type="text" name="name" value="{{ $instructor->name }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="file" name="image" accept="image/*" class="p-2 border rounded-lg text-sm">
                                            <input type="number" name="teaching_hours" value="{{ $instructor->teaching_hours }}" required min="0" class="p-2 border rounded-lg text-sm">
                                            <input type="text" name="specialization" value="{{ $instructor->specialization }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="url" name="linkedin_url" value="{{ $instructor->linkedin_url }}" class="p-2 border rounded-lg text-sm">
                                            <input type="url" name="facebook_url" value="{{ $instructor->facebook_url }}" class="p-2 border rounded-lg text-sm">
                                            <input type="checkbox" name="is_active" value="1" {{ $instructor->is_active ? 'checked' : '' }} class="h-4 w-4">
                                            <button type="submit" class="bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-1 px-3 rounded-lg text-sm">Update</button>
                                        </div>
                                    </form>
                                    <form action="{{ route('admin.instructors.delete', $instructor->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Testimonials -->
        <div id="tab-testimonials" class="tab-pane hidden">
            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Add Testimonial</h2>
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-lg card mb-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" accept="image/*" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition" rows="4"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Designation</label>
                        <input type="text" name="designation" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rating (0-5)</label>
                        <input type="number" name="rating" required min="0" max="5" step="0.1" class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-3 rounded-lg font-bold hover:shadow-lg transition-all">Add Testimonial</button>
            </form>

            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Existing Testimonials</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-xl shadow-lg text-left">
                    <thead>
                        <tr class="bg-[#2c0b57] text-white">
                            <th class="p-4 w-40 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                            <tr class="card hover:bg-gray-50">
                                <td class="p-4 text-center">
                                    <button x-data="{ open{{ $testimonial->id }}: false }" @click="open{{ $testimonial->id }} = !open{{ $testimonial->id }}" class="text-blue-500 hover:text-blue-700 text-sm mr-2">Edit</button>
                                    <form x-show="open{{ $testimonial->id }}" action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="mt-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 gap-2">
                                            <input type="text" name="name" value="{{ $testimonial->name }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="file" name="image" accept="image/*" class="p-2 border rounded-lg text-sm">
                                            <textarea name="content" required class="p-2 border rounded-lg text-sm">{{ $testimonial->content }}</textarea>
                                            <input type="text" name="designation" value="{{ $testimonial->designation }}" required class="p-2 border rounded-lg text-sm">
                                            <input type="number" name="rating" value="{{ $testimonial->rating }}" required min="0" max="5" step="0.1" class="p-2 border rounded-lg text-sm">
                                            <input type="checkbox" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }} class="h-4 w-4">
                                            <button type="submit" class="bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-1 px-3 rounded-lg text-sm">Update</button>
                                        </div>
                                    </form>
                                    <form action="{{ route('admin.testimonials.delete', $testimonial->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- FAQs -->
        <div id="tab-faqs" class="tab-pane hidden">
            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Add FAQ</h2>
            <form action="{{ route('admin.faqs.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow-lg card mb-8">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Question</label>
                        <input type="text" name="question" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Answer</label>
                        <textarea name="answer" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition" rows="4"></textarea>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label class="ml-2 text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-3 rounded-lg font-bold hover:shadow-lg transition-all">Add FAQ</button>
            </form>

            <h2 class="text-2xl font-bold text-[#2c0b57] mb-4">Existing FAQs</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-xl shadow-lg text-left">
                    <thead>
                        <tr class="bg-[#2c0b57] text-white">
                            <th class="p-4 w-40 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                            <tr class="card hover:bg-gray-50">
                                <td class="p-4 text-center">
                                    <button x-data="{ open{{ $faq->id }}: false }" @click="open{{ $faq->id }} = !open{{ $faq->id }}" class="text-blue-500 hover:text-blue-700 text-sm mr-2">Edit</button>
                                    <form x-show="open{{ $faq->id }}" action="{{ route('admin.faqs.update', $faq->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 gap-2">
                                            <input type="text" name="question" value="{{ $faq->question }}" required class="p-2 border rounded-lg text-sm">
                                            <textarea name="answer" required class="p-2 border rounded-lg text-sm">{{ $faq->answer }}</textarea>
                                            <input type="checkbox" name="is_active" value="1" {{ $faq->is_active ? 'checked' : '' }} class="h-4 w-4">
                                            <button type="submit" class="bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white py-1 px-3 rounded-lg text-sm">Update</button>
                                        </div>
                                    </form>
                                    <form action="{{ route('admin.faqs.delete', $faq->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll(".nav-tab");
        const tabPanes = document.querySelectorAll(".tab-pane");

        function activateTab(tab) {
            tabs.forEach(t => {
                t.setAttribute("data-active", "false");
                t.classList.remove("text-white", "bg-[#ff7300]");
            });
            tabPanes.forEach(pane => pane.classList.add("hidden"));

            tab.setAttribute("data-active", "true");
            tab.classList.add("text-white", "bg-[#ff7300]");
            document.getElementById(tab.dataset.tab).classList.remove("hidden");
        }

        tabs.forEach(tab => {
            tab.addEventListener("click", function (e) {
                e.preventDefault();
                activateTab(this);
            });
        });

        // Activate first tab by default
        if (tabs.length > 0) {
            activateTab(tabs[0]);
        }
    });
</script>
@endsection