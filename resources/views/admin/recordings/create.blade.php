@extends('admin.layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Upload Recording Link</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.recordings.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Select Course</label>
            <select name="course_id" class="w-full p-2 border rounded" required>
                <option value="">Choose a course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Topic</label>
            <input type="text" name="topic" class="w-full p-2 border rounded" placeholder="e.g., Python Basics" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Recording Link</label>
            <input type="url" name="video_url" class="w-full p-2 border rounded" placeholder="e.g., https://drive.google.com/file/..." required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Recording Link</button>
    </form>
@endsection