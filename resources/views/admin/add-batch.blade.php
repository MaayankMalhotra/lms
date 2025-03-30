@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100">
    <div class="mx-4 sm:mx-10">
        <div class="p-6 sm:p-8">
            <!-- Form Header -->
            <div class="mb-8 text-center">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-briefcase mr-2 text-blue-500"></i>Create New Batch
                </h1>
                <p class="text-gray-500 text-sm sm:text-base">Fill in the details to add a new batch program</p>
            </div>

            <form action="{{ route('admin.batches.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="space-y-6">
                    <!-- Basic Information Section -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">
                            <i class="fas fa-info-circle mr-2 text-blue-400"></i>Basic Information
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Batch Start Date -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-alt mr-2 text-blue-400"></i>Batch Start Date
                                </label>
                                <input type="date" name="start_date" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       value="{{ old('start_date') }}">
                                @error('start_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Batch Status -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-info mr-2 text-blue-400"></i>Batch Status
                                </label>
                                <select name="status" required 
                                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                                    <option value="Batch Started" {{ old('status') == 'Batch Started' ? 'selected' : '' }}>Batch Started</option>
                                    <option value="Upcoming" {{ old('status') == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                                    <option value="Soon" {{ old('status') == 'Soon' ? 'selected' : '' }}>Soon</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Course Dropdown -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-book mr-2 text-blue-400"></i>Select Course
                                </label>
                                <select name="course_id" required 
                                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                                    <option value="">-- Select Course --</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Teacher Dropdown -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-chalkboard-teacher mr-2 text-blue-400"></i>Select Teacher
                                </label>
                                <select name="teacher_id" required 
                                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                                    <option value="">-- Select Teacher --</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Batch Details Section -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">
                            <i class="fas fa-clipboard-list mr-2 text-blue-400"></i>Batch Details
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Days of the Week -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-day mr-2 text-blue-400"></i>Days of the Week
                                </label>
                                <select name="days" required 
                                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                                    <option value="SAT - SUN" {{ old('days') == 'SAT - SUN' ? 'selected' : '' }}>SAT - SUN</option>
                                    <option value="MON - FRI" {{ old('days') == 'MON - FRI' ? 'selected' : '' }}>MON - FRI</option>
                                    <!-- Add more options as needed -->
                                </select>
                                @error('days')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Class Duration -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-clock mr-2 text-blue-400"></i>Class Duration
                                </label>
                                <input type="text" name="duration" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       placeholder="e.g., Weekend Class | 6 Months"
                                       value="{{ old('duration') }}">
                                @error('duration')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Time Slot -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-hourglass-start mr-2 text-blue-400"></i>Time Slot
                                </label>
                                <input type="text" name="time_slot" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       placeholder="e.g., 08:00 PM IST to 11:00 PM IST (GMT +5:30)"
                                       value="{{ old('time_slot') }}">
                                @error('time_slot')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-rupee-sign mr-2 text-blue-400"></i>Price (₹)
                                </label>
                                <input type="number" name="price" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       placeholder="e.g., 40014"
                                       value="{{ old('price') }}">
                                @error('price')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Slots Information Section -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-4 text-gray-700">
                            <i class="fas fa-users mr-2 text-blue-400"></i>Slots Information
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Slots Available -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-chair mr-2 text-blue-400"></i>Slots Available
                                </label>
                                <input type="number" name="slots_available" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       placeholder="e.g., 90"
                                       value="{{ old('slots_available') }}">
                                @error('slots_available')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Slots Filled -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user-check mr-2 text-blue-400"></i>Slots Filled
                                </label>
                                <input type="number" name="slots_filled" required 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       placeholder="e.g., 80"
                                       value="{{ old('slots_filled') }}">
                                @error('slots_filled')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Discount Info -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tag mr-2 text-blue-400"></i>Discount Info
                                </label>
                                <input type="text" name="discount_info" 
                                       class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                       placeholder="e.g., 10% OFF expires in -43d -23h -18m -1s"
                                       value="{{ old('discount_info') }}">
                                @error('discount_info')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-center">
                        <button type="submit" 
                                class="w-full sm:w-80 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-4 px-6 rounded-xl transition-all transform hover:scale-[1.01] shadow-lg">
                            <i class="fas fa-plus-circle mr-2"></i>Create Batch Program
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection