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
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Notes</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Notes 2</th>
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
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $class->notes ?? 'No Notes' }}
                            <button class="ml-2 text-blue-600 hover:text-blue-900" onclick="openNotesModal({{ $class->id }})">Add Notes</button>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $class->notes_2 ?? 'No Notes 2' }}
                            <button class="ml-2 text-blue-600 hover:text-blue-900" onclick="openNotes2Modal({{ $class->id }})">Add Notes 2</button>
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

<!-- Modal for Add Notes -->
<div id="notesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Add Notes</h3>
        <form id="notesForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea id="notes" name="notes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="3" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeNotesModal()" class="mr-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancel</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Add Notes 2 -->
<div id="notes2Modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Add Notes 2</h3>
        <form id="notes2Form" method="POST">
            @csrf
            <div class="mb-4">
                <label for="notes_2" class="block text-sm font-medium text-gray-700">Notes 2</label>
                <textarea id="notes_2" name="notes_2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="3" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeNotes2Modal()" class="mr-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancel</button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Modals -->
<script>
    function openNotesModal(classId) {
        const modal = document.getElementById('notesModal');
        const form = document.getElementById('notesForm');
        form.action = `/internship-class/${classId}/add-notes`; // Set the form action dynamically
        modal.classList.remove('hidden');
    }

    function closeNotesModal() {
        const modal = document.getElementById('notesModal');
        modal.classList.add('hidden');
        document.getElementById('notes').value = ''; // Clear the textarea
    }

    function openNotes2Modal(classId) {
        const modal = document.getElementById('notes2Modal');
        const form = document.getElementById('notes2Form');
        form.action = `/internship-class/${classId}/add-notes-2`; // Set the form action dynamically
        modal.classList.remove('hidden');
    }

    function closeNotes2Modal() {
        const modal = document.getElementById('notes2Modal');
        modal.classList.add('hidden');
        document.getElementById('notes_2').value = ''; // Clear the textarea
    }
</script>
@endsection