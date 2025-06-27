@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <div class="mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-users text-blue-500 mr-2"></i>Webinar Enrollments
            </h2>
            <p class="text-gray-500 mt-1">Manage all webinar enrollments from the panel below.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 text-left text-sm font-semibold">Webinar ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Phone</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enrollments as $enrollment)
                        <tr class="border-t">
                            <td class="px-4 py-3 text-sm">{{ $enrollment->webinar_id }}</td>
                            <td class="px-4 py-3 text-sm">{{ $enrollment->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $enrollment->email }}</td>
                            <td class="px-4 py-3 text-sm">{{ $enrollment->phone ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $enrollment->comments ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center px-4 py-4 text-gray-500">No enrollments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $enrollments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection