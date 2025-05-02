@extends('admin.layouts.app')

@section('content')

<!-- Filter Form -->
<div class="mb-6">
    <form method="GET" action="{{ route('admin.internship-enrollment-view') }}">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Internship</label>
                <select name="internship_id" class="w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">All Internships</option>
                    @foreach ($internships as $internship)
                        <option value="{{ $internship->id }}" {{ request('internship_id') == $internship->id ? 'selected' : '' }}>
                            {{ $internship->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="">All</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="md:col-span-2 flex items-end gap-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Filter</button>
                <a href="{{ route('admin.internship-enrollment-view') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Reset</a>
            </div>
        </div>
    </form>
</div>

<!-- Enrollments Table -->
<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100 text-xs text-gray-700 uppercase">
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Phone</th>
                <th class="px-4 py-2">Internship</th>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">PaymentId</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($enrollments as $index => $enrollment)
                <tr>
                    <td class="px-4 py-2">{{ $enrollments->firstItem() + $index }}</td>
                    <td class="px-4 py-2">{{ $enrollment->name }}</td>
                    <td class="px-4 py-2">{{ $enrollment->email }}</td>
                    <td class="px-4 py-2">{{ $enrollment->phone }}</td>
                    <td class="px-4 py-2">{{ $enrollment->internship->name ?? '-' }}</td>
                    <td class="px-4 py-2">₹{{ number_format($enrollment->amount, 2) }}</td>
                    <td class="px-4 py-2">{{ $enrollment->payment_id }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $enrollment->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($enrollment->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <!-- Toggle Status -->
                        <form method="POST" action="{{ route('admin.internship-enrollments.toggleStatus', $enrollment->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-sm text-white px-3 py-1 rounded {{ $enrollment->status == 'active' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                                {{ $enrollment->status == 'active' ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>

                        <!-- Edit Button -->
                        <button
    onclick="openEditModal(this)"
    data-id="{{ $enrollment->id }}"
    data-edit-url="{{ route('admin.internship-enrollments.edit', $enrollment->id) }}"
    data-update-url="{{ route('admin.internship-enrollments.update', $enrollment->id) }}"
    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
>
    Edit
</button>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-4">No enrollments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-4">
        {{ $enrollments->withQueryString()->links() }}
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed z-50 inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-md w-full max-w-lg relative">
        <button onclick="closeEditModal()" class="absolute top-2 right-3 text-gray-500 text-xl font-bold">&times;</button>
        <form method="POST" id="editEnrollmentForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="enrollment_id" id="editEnrollmentId">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="editName" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="editPhone" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" id="editAmount" class="w-full border border-gray-300 p-2 rounded" step="0.01">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(button) {
        const id = button.getAttribute('data-id');
        const editUrl = button.getAttribute('data-edit-url');
        const updateUrl = button.getAttribute('data-update-url');

        fetch(editUrl)
            .then(res => res.json())
            .then(data => {
                document.getElementById('editEnrollmentForm').action = updateUrl;
                document.getElementById('editEnrollmentId').value = id;
                document.getElementById('editName').value = data.name;
                document.getElementById('editPhone').value = data.phone;
                document.getElementById('editAmount').value = data.amount;
                document.getElementById('editModal').classList.remove('hidden');
                document.getElementById('editModal').classList.add('flex');
            });
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }
</script>



<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect('select[name="internship_id"]');
</script>
@endsection



