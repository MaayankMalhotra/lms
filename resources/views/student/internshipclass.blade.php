@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-500 relative">
    <!-- Container -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-3xl font-bold text-gray-900 dark:text-gray-100 tracking-tight">
                Track your internship progress and dive into your tasks.
            </h1>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-8 p-4 bg-green-50 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-2xl shadow-lg flex items-center animate__animated animate__fadeIn">
                <svg class="w-6 h-6 mr-3 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Internships Section -->
        <section class="flex flex-col">
            <!-- Internship List -->
            <div class="w-full">
                @forelse ($internshipClasses as $internshipClass)
                    <div class="bg-white dark:bg-gray-800 bg-opacity-90 dark:bg-opacity-20 backdrop-blur-lg rounded-2xl shadow-xl p-6 mb-8 border border-gray-100 dark:border-gray-700 hover:border-indigo-300 dark:hover:border-indigo-500 transition-all duration-300 group transform hover:-translate-y-2 hover:shadow-2xl">
                        <!-- Internship Card -->
                        <div class="flex flex-col">
                            <!-- Internship Details -->
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                    {{ $internshipClass->subject ?? 'Untitled Internship' }}
                                </h3>

                                <!-- Notes Section -->
                                <div class="mt-6">
                                    <p class="text-gray-600 dark:text-gray-300 font-semibold mb-3">
                                        Notes:
                                    </p>
                                    @if (!empty($internshipClass->notes))
                                        <ul class="list-disc list-inside text-gray-600 dark:text-gray-300">
                                            @foreach ($internshipClass->notes as $note)
                                                <li>
                                                    <a href="{{ $note['url'] }}" target="_blank" class="text-indigo-500 hover:underline">
                                                        {{ $note['name'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-500 dark:text-gray-400">No notes available.</p>
                                    @endif
                                </div>

                                <!-- Assignments (Notes_2) Section -->
                                <div class="mt-6">
                                    <p class="text-gray-600 dark:text-gray-300 font-semibold mb-3">
                                        Assignments:
                                    </p>
                                    @if (!empty($internshipClass->notes_2))
                                        <ul class="list-disc list-inside text-gray-600 dark:text-gray-300">
                                            @foreach ($internshipClass->notes_2 as $assignment)
                                                <li>
                                                    <a href="{{ $assignment['url'] }}" target="_blank" class="text-indigo-500 hover:underline">
                                                        {{ $assignment['name'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-500 dark:text-gray-400">No assignments available.</p>
                                    @endif
                                </div>

                                <!-- Recordings Section -->
                                <div class="mt-6">
                                    <p class="text-gray-600 dark:text-gray-300 font-semibold mb-3">
                                        Recordings:
                                    </p>
                                    @if ($internshipClass->recording)
                                        <a href="{{ $internshipClass->recording->url }}" target="_blank" class="text-indigo-500 hover:underline">
                                            {{ $internshipClass->recording->name ?? 'Recording' }}
                                        </a>
                                    @else
                                        <p class="text-gray-500 dark:text-gray-400">No recording available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-800 bg-opacity-90 dark:bg-opacity-20 backdrop-blur-lg rounded-2xl shadow-xl p-8 text-center border border-gray-100 dark:border-gray-700">
                        <svg class="w-12 h-12 mx-auto text-gray-500 dark:text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-gray-600 dark:text-gray-300 text-lg">
                            No internship classes found. Start your journey today!
                        </p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection