@extends('website.layouts.app')

@section('title', 'Register for Batch')

@section('content')
<!-- MAIN TITLE & SUBHEADING -->
<section class="wave-container relative bg-white py-20">
    <div class="container mx-auto px-4">
        <h1 class="main-heading text-center text-3xl font-bold text-gray-800">
            Register for Batch
        </h1>
        <p class="subheading text-center text-gray-600 text-base mt-4 mb-8">
            Complete the form below to enroll in your selected batch.<br>
            We’ll confirm your registration shortly.
        </p>
    </div>

    <div class="container mx-auto px-4">
        <div class="flex flex-wrap -mx-2">
            <!-- Left Column: Form -->
            <div class="w-full md:w-1/2 px-2 fade-up">
                <div class="glass-card bg-gray-50 rounded-lg shadow-lg p-6 mb-8">
                    <h4 class="mb-4 text-lg font-bold text-gray-800">Registration Form</h4>
                    <p class="mb-3 text-sm text-gray-600">
                        Fill out the details below to confirm your enrollment in the selected batch.
                    </p>
                    <form action="{{ route('register.submit') }}" method="POST">
                        @csrf

                        <!-- Hidden Input for Batch ID -->
                        <input type="hidden" name="batch_id" value="{{ request()->query('batch_id') ??'' }}">

                        <!-- Batch Details (Pre-filled) -->
                        <div class="mb-4">
                            <label for="batch_date" class="block mb-1 font-semibold text-gray-800">Batch Date</label>
                            <input type="text" id="batch_date" name="batch_date" value="{{ $batch['date'] ?? '' }}" readonly 
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-gray-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <label for="batch_status" class="block mb-1 font-semibold text-gray-800">Batch Status</label>
                            <input type="text" id="batch_status" name="batch_status" value="{{ $batch['status'] ?? '' }}" readonly 
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-gray-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <label for="mode" class="block mb-1 font-semibold text-gray-800">Mode of Teaching</label>
                            <input type="text" id="mode" name="mode" value="{{ $batch['mode'] ?? '' }}" readonly 
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-gray-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block mb-1 font-semibold text-gray-800">Price (₹)</label>
                            <input type="text" id="price" name="price" value="{{ $batch['price'] ?? '' }}" readonly 
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-gray-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <label for="slots_available" class="block mb-1 font-semibold text-gray-800">Slots Available</label>
                            <input type="text" id="slots_available" name="slots_available" value="{{ $batch['slotsAvailable'] ?? '' }}" readonly 
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-gray-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <label for="slots_filled" class="block mb-1 font-semibold text-gray-800">Slots Filled</label>
                            <input type="text" id="slots_filled" name="slots_filled" value="{{ $batch['slotsFilled'] ?? '' }}" readonly 
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-gray-100 focus:outline-none">
                        </div>

                        <!-- User Details -->
                        <div class="mb-4">
                            <label for="fullName" class="block mb-1 font-semibold text-gray-800">Full Name</label>
                            <input type="text" id="fullName" name="name" class="w-full px-3 py-2 rounded border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Full Name" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="emailAddress" class="block mb-1 font-semibold text-gray-800">Email Address</label>
                            <input type="email" id="emailAddress" name="email" class="w-full px-3 py-2 rounded border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Email Address" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="contactNumber" class="block mb-1 font-semibold text-gray-800">Contact Number</label>
                            <input type="tel" id="contactNumber" name="phone" class="w-full px-3 py-2 rounded border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contact Number" required>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <p class="text-xs text-gray-600 mb-2">
                            <em>
                                Your information is secure with us. We do not share your
                                details with third parties. For more information, please
                                read our
                                <a href="#" class="text-orange-500 hover:text-orange-600">Privacy Policy</a>.
                            </em>
                        </p>

                        <button type="submit" class="btn-submit bg-orange-500 hover:bg-orange-600 px-5 py-2 rounded text-white font-bold mt-2 transition-all">
                            Submit Registration
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Batch Info -->
            <div class="w-full md:w-1/2 px-2 fade-up">
                <div class="glass-card bg-gray-50 rounded-lg shadow-lg p-6">
                    <h2 class="queries-title text-xl font-bold text-gray-800">Batch Details</h2>
                    <p class="text-sm text-gray-600 mb-3">
                        You have selected the following batch. Please review the details before submitting your registration.
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Batch Date:</strong> {{ $batch['date'] ?? 'N/A' }}<br>
                        <strong>Start Date:</strong> {{ $batch['startDate'] ? \Carbon\Carbon::parse($batch['startDate'])->format('d M Y, h:i A') : 'N/A' }}<br>
                        <strong>Status:</strong> {{ $batch['status'] ?? 'N/A' }}<br>
                        <strong>Mode:</strong> {{ $batch['mode'] ?? 'N/A' }}<br>
                        <strong>Price:</strong> ₹{{ $batch['price'] ? number_format($batch['price'], 2) : 'N/A' }}<br>
                        <strong>Slots Available:</strong> {{ $batch['slotsAvailable'] ?? 'N/A' }}<br>
                        <strong>Slots Filled:</strong> {{ $batch['slotsFilled'] ?? 'N/A' }}
                    </p>
                    <hr class="my-3 border-gray-300">
                    <p class="text-xs leading-relaxed text-gray-600">
                        <strong>Support:</strong> Need help? Contact us at<br>
                        <strong>Call our toll-free number:</strong> 1800-00-0000<br>
                        <strong>WhatsApp:</strong>
                        <a href="https://wa.me/1234567890" target="_blank" class="inline-flex items-center" title="Message us on WhatsApp">
                            <i class="fab fa-whatsapp fa-2x text-green-500 ml-2"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection