@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="mx-4 sm:mx-10">
        <div class="p-6 sm:p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Internships</h1>

            @forelse ($internships as $internship)
                <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">{{ $internship->name }}</h3>
                    <a href="{{ route('admin.internship.submissions', $internship) }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 inline-block">
                        View Submissions
                    </a>
                </div>
            @empty
                <p class="text-gray-600">No internships available.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection