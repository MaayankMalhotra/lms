@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="mx-4 sm:mx-10">
        <div class="p-6 sm:p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">My Dashboard</h1>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">My Internships</h2>
            @forelse ($enrollments as $enrollment)
                <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">{{ $enrollment->internship->name }}</h3>
                    <p class="text-gray-600">Status: {{ $enrollment->status }}</p>
                    <p class="text-gray-600">Progress: {{ number_format($enrollment->progress, 2) }}%</p>
                    <p class="text-gray-600">Average Mark: {{ $enrollment->average_mark }}</p>
                    <a href="{{ route('student.internship.content', $enrollment) }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 inline-block">
                        View Tasks & Materials
                    </a>
                </div>
            @empty
                <p class="text-gray-600">No internships enrolled.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection