@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">News Management</h1>
                <p class="text-gray-500 mt-2">Manage your news articles efficiently.</p>
            </div>
            <a href="{{ route('admin.news.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Create News
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <!-- News Table Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4">
                <h2 class="text-xl font-semibold text-white">News Articles</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 text-sm uppercase tracking-wider">
                            <th class="p-4 text-left"><i class="fas fa-image mr-1"></i> Image</th>
                            <th class="p-4 text-left"><i class="fas fa-heading mr-1"></i> Title</th>
                            <th class="p-4 text-left"><i class="fas fa-folder mr-1"></i> Category</th>
                            <th class="p-4 text-left"><i class="fas fa-calendar-alt mr-1"></i> Published At</th>
                            <th class="p-4 text-left"><i class="fas fa-cog mr-1"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200">
                                <td class="p-4">
                                    @if ($item->image_url)
                                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                            class="w-12 h-12 object-cover rounded-lg">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-4">{{ Str::limit($item->title, 50) }}</td>
                                <td class="p-4">{{ $item->category }}</td>
                                <td class="p-4">{{ $item->published_at->format('M d, Y') }}</td>
                                <td class="p-4 flex space-x-2">
                                    <a href="{{ route('admin.news.edit', $item) }}"
                                        class="text-blue-500 hover:text-blue-700 transition duration-200 flex items-center">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 transition duration-200 flex items-center"
                                            onclick="return confirm('Are you sure you want to delete this news article?')">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-500">
                                    <i class="fas fa-newspaper text-2xl mb-2"></i>
                                    <p>No news articles found. Start by creating one!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

 
    </div>
@endsection