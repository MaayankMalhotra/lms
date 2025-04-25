@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="mx-4 sm:mx-10">
        <div class="p-6 sm:p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Submissions for {{ $internship->name }}</h1>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($submissions as $submission)
                <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Task: {{ $submission->content->title }}
                    </h3>
                    <p class="text-gray-600">Student: {{ $submission->enrollment->user->name }}</p>
                    <p class="text-gray-600">Submission File: 
                        <a href="{{ asset('storage/' . $submission->submission_file) }}" class="text-blue-500" target="_blank">Download</a>
                    </p>
                    <p class="text-gray-600">Current Mark: {{ $submission->mark ? number_format($submission->mark, 2) : 'Not Assigned' }}</p>

                    <form action="{{ route('admin.internship.submission.feedback', $submission) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="flex items-center">
                            <label for="mark" class="mr-2 text-gray-600">Assign Mark:</label>
                            <input type="number" name="mark" id="mark" step="0.01" min="0" max="100" value="{{ old('mark', $submission->mark) }}"
                                   class="border-gray-300 rounded-lg p-2 w-24" required>
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg ml-4">
                                Submit Mark
                            </button>
                        </div>
                        @error('mark')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            @empty
                <p class="text-gray-600">No submissions found for this internship.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection