@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">News Management</h1>
        <a href="{{ route('admin.news.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create
            News</a>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-4 text-left">Image</th>
                    <th class="p-4 text-left">Title</th>
                    <th class="p-4 text-left">Category</th>
                    <th class="p-4 text-left">Published At</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td class="p-4">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                class="w-16 h-16 object-cover rounded">
                        </td>
                        <td class="p-4">{{ $item->title }}</td>
                        <td class="p-4">{{ $item->category }}</td>
                        <td class="p-4">{{ $item->published_at->format('M d, Y') }}</td>
                        <td class="p-4">
                            <a href="{{ route('admin.news.edit', $item) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $news->links() }}
    </div>
@endsection
