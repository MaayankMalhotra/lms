@extends('admin.layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">{{ $enrollment->name }}</h1>
    @if (session('success'))
        <p class="text-green-500 mb-4">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p class="text-red-500 mb-4">{{ session('error') }}</p>
    @endif
    @foreach ($contents as $content)
        <div class="bg-white p-4 mb-4 border rounded">
            <h2 class="text-lg font-semibold">{{ $content->title }}</h2>
            <p>{{ $content->description ?: 'No description' }}</p>
            @if ($content->file_path)
                <a href="{{ asset('storage/' . $content->file_path) }}" class="text-blue-500">Download</a>
            @endif
            <p>Deadline: {{ $content->deadline ?: 'None' }}</p>
            @if (!$content->submission_file)
                <form action="{{ route('student.internship.submit', $content->id) }}" method="POST" enctype="multipart/form-data" class="mt-2">
                    @csrf
                    <input type="file" name="submission_file" accept=".pdf,.zip" required class="p-2 border rounded">
                    @error('submission_file')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-2">Submit</button>
                </form>
            @else
                <p class="text-green-500">Submitted: <a href="{{ asset('storage/' . $content->submission_file) }}" class="text-blue-500">View</a></p>
            @endif
        </div>
    @endforeach
</div>
@endsection