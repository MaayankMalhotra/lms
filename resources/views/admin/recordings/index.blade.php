@extends('admin.layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Recordings</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{ route('admin.recordings.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Add New Recording Link</a>

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="p-4 text-left">Course Name</th>
                <th class="p-4 text-left">Topic</th>
                <th class="p-4 text-left">Recording Link</th>
                <th class="p-4 text-left">Uploaded At</th>
                <th class="p-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recordings as $recording)
                <tr class="border-b">
                    <td class="p-4">{{ $recording->course->name }}</td>
                    <td class="p-4">{{ $recording->topic }}</td>
                    <td class="p-4">
                        <a href="{{ $recording->video_url }}" target="_blank" class="text-blue-500 hover:underline truncate block max-w-xs">{{ $recording->video_url }}</a>
                    </td>
                    <td class="p-4">{{ \Carbon\Carbon::parse($recording->uploaded_at)->format('Y-m-d H:i') }}</td>
                    <td class="p-4">
                        <button onclick="openModal('edit-modal-{{ $recording->id }}')" class="text-blue-500 hover:underline"><i class="fas fa-edit"></i></button>
                        <form action="{{ route('admin.recordings.destroy', $recording->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('Are you sure you want to delete this recording?')"> <i class="fas fa-trash"></i></button>
                        </form>

                        <!-- Edit Modal -->
                        <div id="edit-modal-{{ $recording->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
                            <div class="bg-white p-6 rounded-lg max-w-lg w-full">
                                <h3 class="text-lg font-bold mb-4">Edit Recording</h3>
                                <form action="{{ route('admin.recordings.update', $recording->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Select Course</label>
                                        <select name="course_id" class="w-full p-2 border rounded" required>
                                            <option value="">Choose a course</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" {{ $course->id == $recording->course_id ? 'selected' : '' }}>{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Topic</label>
                                        <input type="text" name="topic" value="{{ $recording->topic }}" class="w-full p-2 border rounded" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Recording Link</label>
                                        <input type="url" name="video_url" value="{{ $recording->video_url }}" class="w-full p-2 border rounded" required>
                                    </div>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                                    <button type="button" onclick="closeModal('edit-modal-{{ $recording->id }}')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-2">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">No recordings found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection