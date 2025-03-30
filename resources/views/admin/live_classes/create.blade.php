@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Add New Live Class</h1>

        <form action="{{ route('admin.live_classes.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Batch</label>
                <select name="batch_id" id="batch_id" class="w-full p-2 border rounded" required>
                    <option value="">Choose a batch</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->course->name }} - {{ $batch->start_date->format('Y-m-d') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Google Meet Link</label>
                <input type="url" name="google_meet_link" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Class Date & Time</label>
                <input type="datetime-local" name="class_datetime" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Duration (minutes)</label>
                <input type="number" name="duration_minutes" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Select Recording Topic (Optional)</label>
                <select name="recording_id" id="recording_id" class="w-full p-2 border rounded">
                    <option value="">No recording topic</option>
                    <!-- Options will be populated dynamically -->
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Live Class</button>
        </form>
    </div>

    <script>
        document.getElementById('batch_id').addEventListener('change', function() {
            const batchId = this.value;
            const recordingSelect = document.getElementById('recording_id');
            recordingSelect.innerHTML = '<option value="">Loading...</option>';

            if (batchId) {
                // Pass batchId as a parameter to the route helper
                fetch("{{ route('admin.live_classes.recordings', '') }}/" + batchId)
                    .then(response => response.json())
                    .then(data => {
                        recordingSelect.innerHTML = '<option value="">No recording topic</option>';
                        data.forEach(recording => {
                            recordingSelect.innerHTML += `<option value="${recording.id}">${recording.topic}</option>`;
                        });
                    })
                    .catch(error => {
                        recordingSelect.innerHTML = '<option value="">Error loading topics</option>';
                        console.error(error);
                    });
            } else {
                recordingSelect.innerHTML = '<option value="">No recording topic</option>';
            }
        });
    </script>
@endsection