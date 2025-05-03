@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>Webinars List
                </h2>
                <p class="text-gray-500 mt-1">Manage all webinars from the panel below.</p>
            </div>
            <a href="{{ route('admin.webinar.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                + Add Webinar
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 text-left text-sm font-semibold">Title</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Start Time</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Deadline</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Entry</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Participants</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Tags</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($webinars as $webinar)
                        <tr class="border-t">
                            <td class="px-4 py-3 text-sm">{{ $webinar->title }}</td>
                            <td class="px-4 py-3 text-sm">{{ $webinar->start_time->format('d M Y, h:i A') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $webinar->registration_deadline->format('d M Y, h:i A') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $webinar->entry_type }}</td>
                            <td class="px-4 py-3 text-sm">{{ $webinar->participants_count }}</td>
                            <td class="px-4 py-3 text-sm">{{ $webinar->tags }}</td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('admin.webinar.edit', $webinar->id) }}" class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                                <form action="{{ route('admin.webinar.destroy', $webinar->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure? you want to delete!!!')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center px-4 py-4 text-gray-500">No webinars found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $webinars->links() }}
            </div>
        </div>
    </div>
</div>
@endsection