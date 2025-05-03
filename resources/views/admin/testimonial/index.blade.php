@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-comments mr-2 text-green-500"></i>Testimonials
                </h1>
                <p class="text-gray-500 mt-2">Manage testimonials submitted by students or partners</p>
            </div>
            <a href="{{ route('admin.testimonials.create') }}"
               class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition-all">
                <i class="fas fa-plus-circle mr-2"></i>Add New Testimonial
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Photo</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Department</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Positon</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Company</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Rating</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($testimonials as $testimonial)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            @if($testimonial->image_url)
                            <img src="{{ asset($testimonial->image_url) }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $testimonial->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $testimonial->department }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $testimonial->position }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $testimonial->company }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $testimonial->rating }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-4">
                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" 
                                   class="text-blue-500 hover:text-blue-600">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Are you sure? You want to delete!!')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($testimonials->isEmpty())
            <div class="p-12 text-center text-gray-500">
                <i class="fas fa-inbox text-4xl mb-4"></i>
                <p class="text-lg">No testimonials found. Start by adding one!</p>
            </div>
            @endif
        </div>

        @if($testimonials->hasPages())
        <div class="mt-8">
            {{ $testimonials->links() }}
        </div>
        @endif
    </div>
</div>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this testimonial?");
    }
</script>
@endsection
