@extends('website.layouts.app')

@section('title', 'Register for Internship')

@section('content')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<section class="py-20 px-4 md:px-8 bg-gray-50">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-4">
            Register for {{ $internship->name }}
        </h1>
        <p class="text-center text-gray-600 text-base mb-12">
            Complete the form below to enroll in this internship program.<br>
            We’ll confirm your registration shortly.
        </p>

        <div class="flex flex-wrap -mx-4">
            <!-- Registration Form -->
            <div class="w-full md:w-1/2 px-4 mb-8">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Registration Form</h4>
                    <p class="text-sm text-gray-600 mb-6">
                        Fill out the details below to confirm your enrollment in the selected internship.
                    </p>
                    <form id="registrationForm">
                        @csrf
                        <input type="hidden" name="internship_id" value="{{ $internship->id }}">
                        <input type="hidden" name="price" value="{{ $internship->price }}">

                        <div class="mb-4">
                            <label for="internship_name" class="block mb-1 font-semibold text-gray-800">Internship Name</label>
                            <input type="text" id="internship_name" value="{{ $internship->name }}" readonly
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-gray-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block mb-1 font-semibold text-gray-800">Price (₹)</label>
                            <input type="text" id="price" value="{{ number_format($internship->price, 2) }}" readonly
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-gray-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <label for="fullName" class="block mb-1 font-semibold text-gray-800">Full Name</label>
                            <input type="text" id="fullName" name="name"
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500"
                                   placeholder="Full Name" required>
                        </div>
                        <div class="mb-4">
                            <label for="emailAddress" class="block mb-1 font-semibold text-gray-800">Email Address</label>
                            <input type="email" id="emailAddress" name="email"
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500"
                                   placeholder="Email Address" required>
                        </div>
                        <div class="mb-4">
                            <label for="contactNumber" class="block mb-1 font-semibold text-gray-800">Contact Number</label>
                            <input type="tel" id="contactNumber" name="phone"
                                   class="w-full px-3 py-2 rounded border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500"
                                   placeholder="Contact Number" required>
                        </div>

                        <button type="button" id="payButton"
                                class="w-full bg-orange-500 hover:bg-orange-600 px-5 py-2.5 rounded-lg text-white font-bold transition-all">
                            Pay Now
                        </button>
                    </form>
                </div>
            </div>

            <!-- Internship Details -->
            <div class="w-full md:w-1/2 px-4">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Internship Details</h2>
                    <p class="text-sm text-gray-600 mb-6">
                        You have selected the following internship. Please review the details before submitting your registration.
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Name:</strong> {{ $internship->name }}<br>
                        <strong>Duration:</strong> {{ $internship->duration }}<br>
                        <strong>Projects:</strong> {{ $internship->project }}<br>
                        <strong>Applicant Rating:</strong> {{ $internship->applicant }}<br>
                        <strong>Certification:</strong> {{ $internship->certified_button }}<br>
                        <strong>Price:</strong> ₹{{ number_format($internship->price, 2) }}
                    </p>
                    @if($internship->logo)
                        <div class="mt-4">
                            <img src="{{ asset($internship->logo) }}" 
                                 class="w-32 h-32 object-contain rounded-lg mx-auto" 
                                 alt="{{ $internship->name }} logo">
                        </div>
                    @endif
                    <hr class="my-6 border-gray-300">
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
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    console.log('Form Data Sent to Razorpay:', data);

    // Validate form fields
    if (!data.name || !data.email || !data.phone) {
        alert('Please fill in all required fields.');
        return;
    }

    const options = {
        key: "{{ env('RAZORPAY_KEY') }}",
        amount: parseFloat(data.price) * 100, // Convert to paise
        currency: 'INR',
        name: 'Think Champ',
        description: 'Internship Registration Payment',
        handler: async function (response) {
            console.log('Razorpay Response:', response);

            const payload = {
                internship_id: data.internship_id,
                name: data.name,
                email: data.email,
                phone: data.phone,
                payment_id: response.razorpay_payment_id,
                amount: parseFloat(data.price),
                _token: data._token,
            };
            console.log('Payload Sent to Backend:', payload);

            try {
                const fetchResponse = await fetch("{{ route('internship.register.submit') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': data._token,
                    },
                    body: JSON.stringify(payload),
                });

                console.log('Response Status:', fetchResponse.status);

                if (!fetchResponse.ok) {
                    const errorText = await fetchResponse.text();
                    throw new Error(`Server returned ${fetchResponse.status}: ${errorText}`);
                }

                const result = await fetchResponse.json();
                console.log('Server Response:', result);

                if (result.success) {
                    alert('Registration successful! Please check your email.');
                    window.location.href = '/login'; // Redirect to internships page
                } else {
                    throw new Error(result.message || 'Registration failed');
                }
            } catch (error) {
                console.error('Fetch Error:', error);
                alert('Something went wrong: ' + error.message);
            }
        },
        prefill: {
            name: data.name,
            email: data.email,
            contact: data.phone,
        },
        theme: {
            color: '#F97316', // Orange theme
        },
    };

    try {
        const rzp = new Razorpay(options);
        rzp.on('payment.failed', function (response) {
            console.error('Payment Failed:', response.error);
            alert('Payment failed: ' + response.error.description);
        });
        rzp.open();
    } catch (error) {
        console.error('Razorpay Initialization Error:', error);
        alert('Failed to initialize payment. Please try again later.');
    }
});
</script>
@endsection