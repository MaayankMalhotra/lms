@extends('admin.layouts.app')

@section('content')
<section class="mb-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Assignments</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($liveClasses as $class)
            @if ($class->assignments->isNotEmpty())
                @foreach ($class->assignments as $assignment)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <h5 class="text-xl font-semibold text-gray-900 mb-3">{{ $assignment->title }}</h5>
                            <p class="text-sm text-gray-600 mb-2">
                                <span class="font-medium">Live Class:</span> 
                                {{ $class->topic }}
                            </p>
                            <p class="text-sm text-gray-600 mb-2">
                                <span class="font-medium">Class Date:</span> 
                                {{ $class->class_datetime->format('Y-m-d H:i') }}
                            </p>
                            <p class="text-sm text-gray-600 mb-2">
                                <span class="font-medium">Due Date:</span> 
                                <span class="{{ $assignment->due_date->isPast() ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $assignment->due_date->format('Y-m-d H:i') }}
                                </span>
                            </p>
                            <p class="text-sm text-gray-600 mb-4">
                                <span class="font-medium">Description:</span> 
                                {{ $assignment->description ?? 'No description provided' }}
                            </p>
                            @if ($assignment->file_path)
                                <a href="{{ $assignment->file_url }}" target="_blank" 
                                   class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors duration-200 text-sm font-medium">
                                    <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download Assignment
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        @empty
            <div class="col-span-full text-center">
                <p class="text-gray-500 text-lg">No assignments available.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection