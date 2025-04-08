@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Recordings Section -->
        <section class="mb-10">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Recordings</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($recordings as $recording)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <h5 class="text-xl font-semibold text-gray-900 mb-3">{{ $recording->topic }}</h5>
                            <p class="text-sm text-gray-600 mb-2">
                                <span class="font-medium">Live Class Date:</span> 
                                {{ $recording->liveClass->class_datetime->format('Y-m-d H:i') ?? 'N/A' }}
                            </p>
                            <p class="text-sm text-gray-600 mb-4">
                                <span class="font-medium">Recorded On:</span> 
                                {{ $recording->created_at->format('Y-m-d H:i') }}
                            </p>
                            <a href="{{ $recording->video_url }}" target="_blank" 
                               class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200 text-sm font-medium">
                                <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-6.104-3.552A1 1 0 007 8.552v6.896a1 1 0 001.648.764l6.104-3.552a1 1 0 000-1.696z"></path>
                                </svg>
                                Watch Recording
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center">
                        <p class="text-gray-500 text-lg">No recordings available.</p>
                    </div>
                @endforelse
            </div>
        </section>

       
    </div>
@endsection