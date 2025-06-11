@extends('admin.layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">View Recordings</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.recordings.storeView') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Select Course</label>
            <select name="course_id" id="course_id" class="w-full p-2 border rounded" required onchange="loadFolders()">
                <option value="">Choose a course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Select Folder</label>
            <select name="folder_name" id="folder_name" class="w-full p-2 border rounded" required>
                <option value="">Create or select folder</option>
            </select>
            <button type="button" onclick="addFolder()" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Folder</button>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Topic Name</label>
            <input type="text" name="topic" class="w-full p-2 border rounded" placeholder="e.g., HTML Basics" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Topic Discussion</label>
            <textarea name="topic_discussion" class="w-full p-2 border rounded" placeholder="Enter discussion details" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Recording Link</label>
            <input type="url" name="video_url" class="w-full p-2 border rounded" placeholder="e.g., https://drive.google.com/file/..." required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Recording</button>
    </form>

    <script>
        function loadFolders() {
            const courseId = document.getElementById('course_id').value;
            if (courseId) {
                fetch(`/get-folders/${courseId}`)
                    .then(response => response.json())
                    .then(data => {
                        const folderSelect = document.getElementById('folder_name');
                        folderSelect.innerHTML = '<option value="">Create or select folder</option>';
                        data.folders.forEach(folder => {
                            folderSelect.innerHTML += `<option value="${folder}">${folder}</option>`;
                        });
                    });
            }
        }

        function addFolder() {
            const courseId = document.getElementById('course_id').value;
            const newFolder = prompt('Enter new folder name (e.g., html, css, js):');
            if (newFolder && courseId) {
                fetch(`/add-folder/${courseId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ folder_name: newFolder })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadFolders();
                    }
                });
            }
        }
    </script>
@endsection