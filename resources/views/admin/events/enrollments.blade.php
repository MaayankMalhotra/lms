<!-- admin/events/enrollments.blade.php -->
<table class="w-full">
    <thead>
        <tr class="bg-gray-100 text-gray-600 text-sm uppercase tracking-wider">
            <th class="p-4 text-left">Event</th>
            <th class="p-4 text-left">Name</th>
            <th class="p-4 text-left">Email</th>
            <th class="p-4 text-left">Phone</th>
            <th class="p-4 text-left">Comments</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($enrollments as $enrollment)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="p-4">{{ $enrollment->event->title }}</td>
                <td class="p-4">{{ $enrollment->name }}</td>
                <td class="p-4">{{ $enrollment->email }}</td>
                <td class="p-4">{{ $enrollment->phone ?? 'N/A' }}</td>
                <td class="p-4">{{ $enrollment->comments ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>