<!-- resources/views/admin/internship-classes/index.blade.php -->

@extends('admin.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Internship Classes</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Batch</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Class Date & Time</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Link</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Thumbnail</th>
                    <th class="px-6 py-3 text-right text-sm font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($internshipClasses as $class)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $class->batch->batch_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($class->class_date_time)->format('d M Y h:i A') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500"><a href="{{ $class->link }}" target="_blank" class="text-blue-500">{{ $class->link }}</a></td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            @if($class->thumbnail)
                                <img src="{{ asset('storage/' . $class->thumbnail) }}" alt="Thumbnail" class="w-16 h-16 object-cover rounded">
                            @else
                                No Thumbnail
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('admin.internship.class.edit', $class->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            |
                            <form action="{{ route('admin.internship-classes.destroy', $class->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $internshipClasses->links() }}
    </div>
</div>
@endsection
