@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center mb-6">
            <i class="fas fa-briefcase text-blue-500 mr-2"></i>Edit Job Role
        </h2>

        <form action="{{ route('admin.job-roles.update', $jobRole->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $jobRole->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="technologies" class="block text-sm font-medium text-gray-700">Technologies (JSON format)</label>
                <textarea name="technologies" id="technologies" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('technologies') border-red-500 @enderror">{{ old('technologies', json_encode($jobRole->technologies)) }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Example: [{"name": "HTML", "image_url": "https://..."}, {"name": "CSS", "image_url": "https://..."}]</p>
                @error('technologies')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Update Job Role</button>
            </div>
        </form>
    </div>
</div>
@endsection