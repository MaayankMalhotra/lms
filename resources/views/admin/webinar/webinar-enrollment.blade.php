@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-users text-blue-500 mr-2"></i>Webinar Enrollments
            </h2>
            <p class="text-gray-500 mt-1">Manage all webinar enrollments from the panel below.</p>
            </div>
            <button id="send-confirmation-btn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Send Confirmation Mail
            </button>
        </div>

        <div id="confirmation-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Send Confirmation Mail</h3>
                <form id="confirmation-form">
                    <input type="hidden" id="webinar-id" name="webinar_id" value="{{ request('webinar_id') }}">
                    <div class="mb-4">
                        <label for="attendance-code" class="block text-sm font-medium text-gray-700">Attendance Verification Code</label>
                        <input type="text" id="attendance-code" name="attendance_code" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Enter code" required>
                    </div>
                    <div class="mb-4">
                        <label for="meeting-id" class="block text-sm font-medium text-gray-700">Meeting ID</label>
                        <input type="text" id="meeting-id" name="meeting_id" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Enter meeting ID" required>
                    </div>
                    <div class="mb-4">
                        <label for="meeting-link" class="block text-sm font-medium text-gray-700">Meeting Link</label>
                        <input type="url" id="meeting-link" name="meeting_link" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Enter meeting link" required>
                    </div>
                    <div class="mb-4">
                        <label for="meeting-password" class="block text-sm font-medium text-gray-700">Meeting Password</label>
                        <input type="text" id="meeting-password" name="meeting_password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Enter password" required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" id="close-modal-btn" class="px-4 py-2 text-gray-500 hover:text-gray-700">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Send</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- @if (empty($webinars) || $webinars->isEmpty())
            <p class="text-red-500 mb-4">No webinars enrollment found in the database.</p>
        @else
            <p class="text-green-500 mb-4">{{ $webinars->count() }} webinars enrollment loaded.</p>
        @endif --}}
   
        <div class="mb-6">
            <form action="{{ route('admin.webinar.enrollments') }}" method="GET" class="flex items-center">
                <div class="relative w-full max-w-sm">
                    <select name="webinar_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Webinar Title</option>
                        @foreach($webinars as $webinar)
                            <option value="{{ $webinar->id }}" {{ request('webinar_id') == $webinar->id ? 'selected' : '' }}>
                                {{ $webinar->title ?? 'Untitled Webinar (ID: ' . $webinar->id . ')' }}
                            </option>
                        @endforeach
                    </select>  
                </div>
                <button type="submit" class="px-4 py-2 text-blue-500 hover:text-blue-700">
                    <i class="fas fa-search"></i>
                </button>
                
                @if (request('webinar_id'))
                    <a href="{{ route('admin.webinar.enrollments') }}" 
                       class="ml-4 text-sm text-blue-500 hover:text-blue-700">Clear Filter</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 text-left text-sm font-semibold">Webinar Title</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Name</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Phone</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enrollments as $enrollment)
                        <tr class="border-t">
                            <td class="px-4 py-3 text-sm">
                                @if ($enrollment->webinar)
                                    {{ $enrollment->webinar->title ?? 'Untitled Webinar' }}
                                @else
                                    N/A (Webinar ID: {{ $enrollment->webinar_id }})
                                @endif
                            </td>
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
                {{ $enrollments->appends(['webinar_id' => request('webinar_id')])->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('confirmation-modal');
        const openBtn = document.getElementById('send-confirmation-btn');
        const closeBtn = document.getElementById('close-modal-btn');
        const form = document.getElementById('confirmation-form');

        // Open modal
        openBtn.addEventListener('click', function () {
            modal.classList.remove('hidden');
        });

        // Close modal
        closeBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
        });

        // Close modal when clicking outside
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });

        // Handle form submission (placeholder)
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const attendanceCode = document.getElementById('attendance-code').value;
            const meetingId = document.getElementById('meeting-id').value;
            const meetingLink = document.getElementById('meeting-link').value;
            const meetingPassword = document.getElementById('meeting-password').value;
            const webinarId = document.getElementById('webinar-id').value;
        fetch('{{ route('admin.webinar.send-confirmation') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    attendance_code: attendanceCode,
                    meeting_id: meetingId,
                    meeting_link: meetingLink,
                    meeting_password: meetingPassword,
                    webinar_id: webinarId
                })
            })
            .then(response => {
                console.log('Response Status:', response.status); // Log status
                console.log('Response Headers:', response.headers.get('Content-Type')); // Log content type
                return response.text(); // Get raw text response
            })
            .then(text => {
    console.log('Raw Response:', text); // Log raw response
    try {
        const data = JSON.parse(text); // Attempt to parse as JSON
        alert(data.message || 'Confirmation emails sent and data saved successfully!');
        modal.classList.add('hidden');
    } catch (error) {
        console.error('JSON Parse Error:', error);
        alert('Error: Failed to parse response as JSON');
    }
})
            .catch(error => {
                console.error('Fetch Error:', error);
                alert('Error: ' + error);
            });
        });
    });    
</script>
@endsection