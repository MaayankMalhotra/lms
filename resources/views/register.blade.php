@extends('website.layouts.app')

@section('title', 'Register for Batch')

@section('content')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
                <div class="w-full md:w-1/2 px-2 fade-up">
                    <div class="glass-card bg-gray-50 rounded-lg shadow-lg p-6 mb-8">
                        <h4 class="mb-4 text-lg font-bold text-gray-800">Registration Form</h4>
                        <p class="mb-3 text-sm text-gray-600">
                            Fill out the details below to confirm your enrollment in the selected batch.
                        </p>
                        <form id="registrationForm">
                            @csrf
                            <input type="hidden" name="batch_id" value="{{ $batch['id'] ?? 1 }}">
                            <input type="hidden" name="batch_date" value="{{ $batch['date'] ?? '11 Nov' }}">
                            <input type="hidden" name="batch_status" value="{{ $batch['status'] ?? 'upcoming' }}">
                            <input type="hidden" name="mode" value="{{ $batch['mode'] ?? 'Online' }}">
                            <input type="hidden" name="price" value="{{ $batch['price'] ?? '10000.00' }}">
                            <input type="hidden" name="slots_available" value="{{ $batch['slotsAvailable'] ?? 90 }}">
                            <input type="hidden" name="slots_filled" value="{{ $batch['slotsFilled'] ?? 60 }}">

                            <div class="mb-4">
                                <label for="batch_date" class="block mb-1 font-semibold text-gray-800">Batch Date</label>
                                <input type="text" id="batch_date" value="{{ $batch['date'] ?? '11 Nov' }}" readonly
                                    class="w-full px-3 py-2 rounded border border-gray-300 bg-gray-100 focus:outline-none">
                            </div>
                            <div class="mb-4">
                                <label for="price" class="block mb-1 font-semibold text-gray-800">Price (₹)</label>
                                <input type="text" id="price" value="{{ $batch['price'] ?? '10000.00' }}" readonly
                                    class="w-full px-3 py-2 rounded border border-gray-300 bg-gray-100 focus:outline-none">
                            </div>

                            <div class="mb-4">
                                <label for="fullName" class="block mb-1 font-semibold text-gray-800">Full Name</label>
                                <input type="text" id="fullName" name="name"
                                    class="w-full px-3 py-2 rounded border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Full Name" required value="Ashwani Rai">
                            </div>
                            <div class="mb-4">
                                <label for="emailAddress" class="block mb-1 font-semibold text-gray-800">Email Address</label>
                                <input type="email" id="emailAddress" name="email"
                                    class="w-full px-3 py-2 rounded border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Email Address" required value="ashwanirai@mail.com">
                            </div>
                            <div class="mb-4">
                                <label for="contactNumber" class="block mb-1 font-semibold text-gray-800">Contact Number</label>
                                <input type="tel" id="contactNumber" name="phone"
                                    class="w-full px-3 py-2 rounded border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Contact Number" required value="9140755973">
                            </div>

                            <button type="button" id="payButton"
                                class="btn-submit bg-orange-500 hover:bg-orange-600 px-5 py-2 rounded text-white font-bold mt-2 transition-all">
                                Pay Now
                            </button>
                        </form>
                    </div>
                </div>

                <div class="w-full md:w-1/2 px-2 fade-up">
                    <div class="glass-card bg-gray-50 rounded-lg shadow-lg p-6">
                        <h2 class="queries-title text-xl font-bold text-gray-800">Batch Details</h2>
                        <p class="text-sm text-gray-600 mb-3">
                            You have selected the following batch. Please review the details before submitting your registration.
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Batch Date:</strong> {{ $batch['date'] ?? '11 Nov' }}<br>
                            <strong>Start Date:</strong> {{ $batch['startDate'] ? \Carbon\Carbon::parse($batch['startDate'])->format('d M Y, h:i A') : 'N/A' }}<br>
                            <strong>Status:</strong> {{ $batch['status'] ?? 'upcoming' }}<br>
                            <strong>Mode:</strong> {{ $batch['mode'] ?? 'Online' }}<br>
                            <strong>Price:</strong> ₹{{ $batch['price'] ? number_format($batch['price'], 2) : '10000.00' }}<br>
                            <strong>Slots Available:</strong> {{ $batch['slotsAvailable'] ?? 90 }}<br>
                            <strong>Slots Filled:</strong> {{ $batch['slotsFilled'] ?? 60 }}
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

    <script>
        document.getElementById('payButton').addEventListener('click', function (e) {
            e.preventDefault();

            const form = document.getElementById('registrationForm');
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);

            console.log('Form Data Sent to Razorpay:', data);

            const options = {
                key: '{{ env('RAZORPAY_KEY') }}',
                amount: parseFloat(data.price) * 100,
                currency: 'INR',
                name: 'Think Champ',
                description: 'Batch Registration Payment',
                handler: function (response) {
                    console.log('Razorpay Response:', response);

                    const payload = {
                        batch_id: data.batch_id,
                        batch_date: data.batch_date,
                        batch_status: data.batch_status,
                        mode: data.mode,
                        price: data.price,
                        slots_available: data.slots_available,
                        slots_filled: data.slots_filled,
                        name: data.name,
                        email: data.email,
                        phone: data.phone,
                        payment_id: response.razorpay_payment_id,
                    };
                    console.log('Payload Sent to Backend:', payload);

                    fetch('/batch/submitr', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': data._token,
                        },
                        body: JSON.stringify(payload),
                    })
                    .then(response => {
                        console.log('Response Status:', response.status);
                        if (response.redirected) {
                            // Follow the redirect manually
                            window.location.href = response.url;
                        } else {
                            return response.json().then(data => {
                                throw new Error('Unexpected response: ' + JSON.stringify(data));
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                        alert('Something went wrong: ' + error.message);
                    });
                },
                prefill: {
                    name: data.name,
                    email: data.email,
                    contact: data.phone,
                },
                theme: {
                    color: '#F97316',
                },
            };

            const rzp = new Razorpay(options);
            rzp.open();
        });
    </script>
@endsection