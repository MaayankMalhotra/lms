@extends('admin.layouts.app')

@section('content')
    <div class="">
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">
                <i class="fas fa-list mr-2 text-blue-500"></i>Batch Listing
            </h1>
            <p class="text-gray-500 text-sm sm:text-base">View and manage all batch programs</p>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg" id="success-message">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New Batch Button -->
        <div class="mb-6 flex justify-end">
            <a href="{{ route('admin.batches.add') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-all">
                <i class="fas fa-plus-circle mr-2"></i>Add New Batch
            </a>
        </div>

        <!-- Batch Table -->
        <div class="bg-white p-6 rounded-lg shadow-sm" id="batch-table-container">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">
                <i class="fas fa-table mr-2 text-blue-400"></i>All Batches
            </h2>

            @if ($batches->isEmpty())
                <p class="text-gray-500">No batches found.</p>
            @else
                <div class="max-w-5xl overflow-x-scroll">
                    <table class="" id="batchTable">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Start Date</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Days</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Duration</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Time Slot</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Price (₹)</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Discount Info</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Slots (Available/Filled)</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Course</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Teacher</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batches as $batch)
                                <tr class="border-b" data-id="{{ $batch->id }}">
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $batch->start_date }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $batch->status }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $batch->days }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $batch->duration }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $batch->time_slot }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">₹{{ number_format($batch->price, 2) }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $batch->discount_info ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $batch->slots_available }} / {{ $batch->slots_filled }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $batch->course->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $batch->teacher->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">
                                        <button onclick="openEditModal({{ $batch->id }})"
                                            class="text-blue-500 hover:text-blue-700 mr-2" title="Edit Batch">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.batches.destroy', $batch->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete Batch"
                                                onclick="return confirm('Are you sure you want to delete this batch?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-700">
                    <i class="fas fa-edit mr-2 text-blue-400"></i>Edit Batch
                </h2>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="editBatchForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_batch_id">

                <div class="space-y-6">
                    <!-- Basic Information Section -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3 text-gray-700">
                            <i class="fas fa-info-circle mr-2 text-blue-400"></i>Basic Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-alt mr-2 text-blue-400"></i>Batch Start Date
                                </label>
                                <input type="date" name="start_date" id="edit_start_date" required
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-info mr-2 text-blue-400"></i>Batch Status
                                </label>
                                <select name="status" id="edit_status" required
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                                    <option value="Batch Started">Batch Started</option>
                                    <option value="Upcoming">Upcoming</option>
                                    <option value="Soon">Soon</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-book mr-2 text-blue-400"></i>Select Course
                                </label>
                                <select name="course_id" id="edit_course_id" required
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-chalkboard-teacher mr-2 text-blue-400"></i>Select Teacher
                                </label>
                                <select name="teacher_id" id="edit_teacher_id" required
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Batch Details Section -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3 text-gray-700">
                            <i class="fas fa-clipboard-list mr-2 text-blue-400"></i>Batch Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-day mr-2 text-blue-400"></i>Days of Batch
                                </label>
                                <select name="days" id="edit_days" required
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200">
                                    <option value="SAT - SUN">SAT - SUN</option>
                                    <option value="MON - FRI">MON - FRI</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-clock mr-2 text-blue-400"></i>Class Duration
                                </label>
                                <input type="text" name="duration" id="edit_duration" required
                                    placeholder="e.g., Weekend Class | 6 Months">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-hourglass-start mr-2 text-blue-400"></i>Time Slot
                                </label>
                                <input type="text" name="time_slot" id="edit_time_slot" required
                                    placeholder="e.g., 08:00 PM IST to 11:00 PM IST (GMT +5:30)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-rupee-sign mr-2 text-blue-400"></i>Price (₹)
                                </label>
                                <input type="number" name="price" id="edit_price" required
                                    placeholder="e.g., 40014">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-rupee-sign mr-2 text-blue-400"></i>EMI Price (₹)
                                </label>
                                <input type="number" name="emi_price" id="edit_emi_price"
                                    placeholder="e.g., 40014">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-check-circle mr-2 text-blue-400"></i>EMI Available
                                </label>
                                <input type="checkbox" name="emi_available" id="edit_emi_available" value="on">
                            </div>
                        </div>
                    </div>

                    <!-- Slots Information Section -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3 text-gray-700">
                            <i class="fas fa-users mr-2 text-blue-400"></i>Slots Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-chair mr-2 text-blue-400"></i>Slots Available
                                </label>
                                <input type="number" name="slots_available" id="edit_slots_available" required
                                    placeholder="e.g., 90">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user-check mr-2 text-blue-400"></i>Slots Filled
                                </label>
                                <input type="number" name="slots_filled" id="edit_slots_filled" required
                                    placeholder="e.g., 80">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tag mr-2 text-blue-400"></i>Discount Info
                                </label>
                                <input type="text" name="discount_info" id="edit_discount_info"
                                    placeholder="e.g., 10% OFF expires in -43d -23h -18m -1s">
                            </div>
                        </div>
                    </div>

                    <!-- EMI Plans Section (Simplified) -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-3 text-gray-700">
                            <i class="fas fa-money-check-alt mr-2 text-blue-400"></i>EMI Plans
                        </h3>
                        <div id="emi-plans-container">
                            <!-- Dynamically populated via JavaScript -->
                        </div>
                        <button type="button" onclick="addEmiPlan()"
                            class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Add EMI Plan</button>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6 flex justify-center">
                        <button type="submit"
                            class="w-full sm:w-80 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-xl">
                            <i class="fas fa-save mr-2"></i>Update Batch
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(batchId) {
            console.log('Fetching batch data for ID:', batchId);
            fetch(`/admin/batches/${batchId}/edit`)
                .then(response => {
                    console.log('Edit response status:', response.status);
                    if (!response.ok) throw new Error('Failed to fetch batch data');
                    return response.json();
                })
                .then(data => {
                    console.log('Edit response data:', data);
                    // Populate form fields
                    document.getElementById('edit_batch_id').value = data.batch.id;
                    document.getElementById('edit_start_date').value = data.batch.start_date;
                    document.getElementById('edit_status').value = data.batch.status;
                    document.getElementById('edit_days').value = data.batch.days;
                    document.getElementById('edit_duration').value = data.batch.duration;
                    document.getElementById('edit_time_slot').value = data.batch.time_slot;
                    document.getElementById('edit_price').value = data.batch.price;
                    document.getElementById('edit_emi_price').value = data.batch.emi_price || '';
                    document.getElementById('edit_discount_info').value = data.batch.discount_info || '';
                    document.getElementById('edit_slots_available').value = data.batch.slots_available;
                    document.getElementById('edit_slots_filled').value = data.batch.slots_filled;
                    document.getElementById('edit_emi_available').checked = data.batch.emi_available;

                    // Populate course dropdown
                    const courseSelect = document.getElementById('edit_course_id');
                    courseSelect.innerHTML = '';
                    data.courses.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course.id;
                        option.text = course.name;
                        if (course.id == data.batch.course_id) option.selected = true;
                        courseSelect.appendChild(option);
                    });

                    // Populate teacher dropdown
                    const teacherSelect = document.getElementById('edit_teacher_id');
                    teacherSelect.innerHTML = '';
                    data.teachers.forEach(teacher => {
                        const option = document.createElement('option');
                        option.value = teacher.id;
                        option.text = teacher.name;
                        if (teacher.id == data.batch.teacher_id) option.selected = true;
                        teacherSelect.appendChild(option);
                    });

                    // Populate EMI plans
                    const emiContainer = document.getElementById('emi-plans-container');
                    emiContainer.innerHTML = '';
                    if (data.batch.emi_plans && data.batch.emi_plans.length > 0) {
                        data.batch.emi_plans.forEach((plan, index) => {
                            const planDiv = document.createElement('div');
                            planDiv.className = 'emi-plan mb-2 p-2 border rounded';
                            planDiv.innerHTML = `
                                <div class="grid grid-cols-3 gap-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Installments</label>
                                        <input type="number" name="emi_plans[${index}][installments]" value="${plan.installments}" class="w-full px-2 py-1 rounded border">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Amount (₹)</label>
                                        <input type="number" name="emi_plans[${index}][amount]" value="${plan.amount}" class="w-full px-2 py-1 rounded border">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Interval (Months)</label>
                                        <input type="number" name="emi_plans[${index}][interval_months]" value="${plan.interval_months}" class="w-full px-2 py-1 rounded border">
                                    </div>
                                </div>
                                <button type="button" onclick="this.parentElement.remove()" class="mt-2 text-red-500">Remove</button>
                            `;
                            emiContainer.appendChild(planDiv);
                        });
                    }

                    document.getElementById('editModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching batch data:', error);
                    alert('Failed to load batch data.');
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function addEmiPlan() {
            const emiContainer = document.getElementById('emi-plans-container');
            const index = emiContainer.children.length;
            const planDiv = document.createElement('div');
            planDiv.className = 'emi-plan mb-2 p-2 border rounded';
            planDiv.innerHTML = `
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Installments</label>
                        <input type="number" name="emi_plans[${index}][installments]" class="w-full px-2 py-1 rounded border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Amount (₹)</label>
                        <input type="number" name="emi_plans[${index}][amount]" class="w-full px-2 py-1 rounded border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Interval (Months)</label>
                        <input type="number" name="emi_plans[${index}][interval_months]" class="w-full px-2 py-1 rounded border">
                    </div>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="mt-2 text-red-500">Remove</button>
            `;
            emiContainer.appendChild(planDiv);
        }

        document.getElementById('editBatchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const batchId = document.getElementById('edit_batch_id').value;
            const formData = new FormData(this);
            console.log('Submitting form data:', Object.fromEntries(formData));

            fetch(`/admin/batches/${batchId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            })
                .then(response => {
                    console.log('Update response status:', response.status);
                    if (!response.ok) throw new Error('Update failed');
                    return response.json();
                })
                .then(data => {
                    console.log('Update response data:', data);
                    if (data.success) {
                        closeEditModal();
                        // Update table row
                        const row = document.querySelector(`#batchTable tr[data-id="${batchId}"]`);
                        if (row) {
                            row.cells[0].textContent = formData.get('start_date');
                            row.cells[1].textContent = formData.get('status');
                            row.cells[2].textContent = formData.get('days');
                            row.cells[3].textContent = formData.get('duration');
                            row.cells[4].textContent = formData.get('time_slot');
                            row.cells[5].textContent = `₹${parseFloat(formData.get('price')).toFixed(2)}`;
                            row.cells[6].textContent = formData.get('discount_info') || 'N/A';
                            row.cells[7].textContent = `${formData.get('slots_available')} / ${formData.get('slots_filled')}`;
                            row.cells[8].textContent = data.course_name;
                            row.cells[9].textContent = data.teacher_name;
                        }
                        // Show success message
                        let successDiv = document.getElementById('success-message');
                        if (!successDiv) {
                            successDiv = document.createElement('div');
                            successDiv.id = 'success-message';
                            successDiv.className = 'mb-6 p-4 bg-green-100 text-green-700 rounded-lg';
                            document.getElementById('batch-table-container').prepend(successDiv);
                        }
                        successDiv.textContent = 'Batch updated successfully!';
                        setTimeout(() => successDiv.remove(), 5000); // Remove after 5 seconds
                    } else {
                        alert('Error updating batch: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error updating batch:', error);
                    alert('Error updating batch: ' + error.message);
                });
        });
    </script>
@endsection