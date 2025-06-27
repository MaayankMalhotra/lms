@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-briefcase text-blue-500 mr-2"></i>Job Roles List
                </h2>
                <p class="text-gray-500 mt-1">Manage all job roles from the panel below.</p>
            </div>
            <a href="{{ route('admin.job-roles.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                + Add Job Role
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 text-left text-sm font-semibold">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Title</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Technologies</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Created At</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Updated At</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobRoles as $jobRole)
                        <tr class="border-t">
                            <td class="px-4 py-3 text-sm">{{ $jobRole->id }}</td>
                            <td class="px-4 py-3 text-sm">{{ $jobRole->title }}</td>
                            <td class="px-4 py-3 text-sm">
                                {{ collect($jobRole->technologies)->pluck('name')->implode(', ') }}
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $jobRole->created_at->format('d M Y, h:i A') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $jobRole->updated_at->format('d M Y, h:i A') }}</td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('admin.job-roles.edit', $jobRole->id) }}" class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                                <form action="{{ route('admin.job-roles.destroy', $jobRole->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this job role?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center px-4 py-4 text-gray-500">No job roles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $jobRoles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection