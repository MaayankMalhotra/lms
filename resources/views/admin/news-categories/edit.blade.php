@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 ">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-folder mr-2"></i> Edit News Category
            </h1>
            <p class="text-gray-500 mt-2">Update the category details.</p>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-[#2c1d56] p-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> Category Details
                </h2>
            </div>
            <form action="{{ route('admin.news-categories.update', $category) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                        <i class="fas fa-folder mr-1"></i> Name
                    </label>
                    <input type="text" name="name" id="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('name') border-red-500 @enderror"
                        value="{{ old('name', $category->name) }}" placeholder="Enter category name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

            

                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.news-categories.index') }}"
                        class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-100 transition duration-200 flex items-center">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 flex items-center">
                        <i class="fas fa-save mr-1"></i> Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection