@extends('admin.layouts.app') <!-- Adjust to student.layouts.app if needed -->

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Recordings</h1>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 shadow-md">
                {{ session('error') }}
            </div>
        @endif

        @if ($recordings->isEmpty())
            <p class="text-gray-500 text-lg">No recordings available.</p>
        @else
            <div class="space-y-8">
                @foreach ($recordings->groupBy('topic.folder.name') as $folderName => $folderRecordings)
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-semibold text-purple-600 mb-4 border-b-2 border-purple-200 pb-2">
                            {{ $folderName }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($folderRecordings->groupBy('topic.name') as $topicName => $topicRecordings)
                                @foreach ($topicRecordings as $recording)
                                    <div class="bg-gray-50 rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow duration-300">
                                        <h3 class="text-md font-medium text-indigo-600 mb-2">{{ $topicName }}</h3>
                                        <a href="{{ $recording->video_url }}" target="_blank" class="text-blue-500 hover:text-blue-700 text-lg">
                                            Recording {{ $recording->id }}
                                        </a>
                                        <p class="text-sm text-gray-600 mt-2">Date: {{ $recording->created_at->format('Y-m-d') }}</p>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

<style>
    /* No need for material-icons style if icon is removed */
</style>