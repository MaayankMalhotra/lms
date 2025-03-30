@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Manage Live Classes</h1>
        
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.live_classes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Add New Live Class</a>

        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="p-4 text-left">Course</th>
                    <th class="p-4 text-left">Batch</th>
                    <th class="p-4 text-left">Topic</th>
                    <th class="p-4 text-left">Class Time</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($batches as $batch)
                    @foreach($batch->liveClasses as $class)
                        <tr class="border-b">
                            <td class="p-4">{{ $batch->course->name }}</td>
                            <td class="p-4">{{ $batch->start_date->format('Y-m-d') }}</td>
                            <td class="p-4">{{ $class->topic }}</td>
                            <td class="p-4">{{ Carbon\Carbon::parse($class->class_datetime)->format('Y-m-d H:i') }}</td>
                            <td class="p-4">{{ $class->status }}</td>
                            <td class="p-4">
                                <button onclick="openModal('edit-modal-{{ $class->id }}')" class="text-blue-500 hover:underline">Edit</button>
                                <form action="{{ route('admin.live_classes.destroy', $class->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>

                                <!-- Edit Modal -->
                                <div id="edit-modal-{{ $class->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
                                    <div class="bg-white p-6 rounded-lg max-w-lg w-full">
                                        <h3 class="text-lg font-bold mb-4">Edit Live Class</h3>
                                        <form action="{{ route('admin.live_classes.update', $class->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4">
                                                <label class="block text-gray-700">Batch</label>
                                                <select name="batch_id" id="batch_id_{{ $class->id }}" class="w-full p-2 border rounded" required>
                                                    @foreach($batches as $b)
                                                        <option value="{{ $b->id }}" {{ $b->id == $class->batch_id ? 'selected' : '' }}>{{ $b->course->name }} - {{ $b->start_date->format('Y-m-d') }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-gray-700">Select Recording Topic (Optional)</label>
                                                <select name="topic" id="recording_id_{{ $class->id }}" class="w-full p-2 border rounded">
                                                    <option value="">No recording topic</option>
                                                    @if($class->recording)
                                                        <option value="{{ $class->recording->id }}" selected>{{ $class->recording->topic }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-gray-700">Topic</label>
                                                <input type="text" disabled name="topic" id="topic_{{ $class->id }}" value="{{ $class->topic }}" class="w-full p-2 border rounded" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-gray-700">Google Meet Link</label>
                                                <input type="url" name="google_meet_link" value="{{ $class->google_meet_link }}" class="w-full p-2 border rounded" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-gray-700">Class Date & Time</label>
                                                <input type="datetime-local" name="class_datetime" value="{{ Carbon\Carbon::parse($class->class_datetime)->format('Y-m-d\TH:i') }}" class="w-full p-2 border rounded" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-gray-700">Duration (minutes)</label>
                                                <input type="number" name="duration_minutes" value="{{ $class->duration_minutes }}" class="w-full p-2 border rounded" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-gray-700">Status</label>
                                                <select name="status" class="w-full p-2 border rounded" required>
                                                    <option value="Scheduled" {{ $class->status == 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                                                    <option value="Live" {{ $class->status == 'Live' ? 'selected' : '' }}>Live</option>
                                                    <option value="Ended" {{ $class->status == 'Ended' ? 'selected' : '' }}>Ended</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                                            <button type="button" onclick="closeModal('edit-modal-{{ $class->id }}')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-2">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        @foreach($batches as $batch)
            @foreach($batch->liveClasses as $class)
                document.getElementById('batch_id_{{ $class->id }}').addEventListener('change', function() {
                    const batchId = this.value;
                    const recordingSelect = document.getElementById('recording_id_{{ $class->id }}');
                    recordingSelect.innerHTML = '<option value="">Loading...</option>';

                    if (batchId) {
                        fetch("{{ route('admin.live_classes.recordings', '') }}/" + batchId)
                            .then(response => response.json())
                            .then(data => {
                                recordingSelect.innerHTML = '<option value="">No recording topic</option>';
                                data.forEach(recording => {
                                    const isSelected = {{ $class->recording && $class->recording->id ? $class->recording->id : 'null' }} === recording.id;
                                    recordingSelect.innerHTML += `<option value="${recording.id}" ${isSelected ? 'selected' : ''}>${recording.topic}</option>`;
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

                document.getElementById('recording_id_{{ $class->id }}').addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const topicInput = document.getElementById('topic_{{ $class->id }}');
                    if (selectedOption.value) {
                        topicInput.value = selectedOption.text; // Update topic field with selected recording topic
                    }
                });

                // Trigger initial load for current batch
                document.getElementById('batch_id_{{ $class->id }}').dispatchEvent(new Event('change'));
            @endforeach
        @endforeach

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection