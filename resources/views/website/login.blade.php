@extends('website.layouts.app')
@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-gray-50 font-poppins relative overflow-x-hidden">
    <!-- Floating Tech Icons -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
        <i class="fas fa-laptop-code absolute text-6xl text-orange-500/25 animate-float top-[10%] left-[5%]"></i>
        <i class="fas fa-code absolute text-6xl text-orange-500/25 animate-float top-[35%] left-[80%] animation-delay-2000"></i>
        <i class="fas fa-graduation-cap absolute text-6xl text-orange-500/25 animate-float top-[60%] left-[15%] animation-delay-4000"></i>
        <i class="fas fa-chalkboard-teacher absolute text-6xl text-orange-500/25 animate-float top-[75%] left-[70%] animation-delay-1000"></i>
        <i class="fas fa-book-open absolute text-6xl text-orange-500/25 animate-float top-[20%] left-[50%] animation-delay-3000"></i>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pb-12 pt-20 relative z-10">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Edutech Platform</h1>
            <p class="text-gray-600 text-base md:text-lg">Empowering Students & Professionals with Quality Education</p>
        </div>

        <!-- Messages -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 max-w-md mx-auto">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6 max-w-md mx-auto">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6 max-w-md mx-auto">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tab Buttons -->
        <div class="flex justify-center mb-8 space-x-4">
            <button id="loginBtn" class="bg-blue-600 text-white px-6 py-3 rounded-md font-semibold w-36 hover:bg-orange-500 transform hover:-translate-y-1 transition-all duration-300 active">Login</button>
            <button id="registerBtn" class="bg-blue-600 text-white px-6 py-3 rounded-md font-semibold w-36 hover:bg-orange-500 transform hover:-translate-y-1 transition-all duration-300">Register</button>
        </div>

        <!-- Login/Register Forms -->
        <div class="max-w-md mx-auto">
            <!-- Login Tab -->
            <div id="loginTab" class="bg-white/20 backdrop-blur-lg border border-white/30 rounded-xl p-6 shadow-lg">
                <h4 class="text-xl font-bold text-gray-800 mb-6">Welcome Back</h4>
                <form action="{{ url('/login_check') }}" method="get">
                    @csrf
                    <div class="mb-4">
                        <label for="loginEmail" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                        <input type="email" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all" 
                               id="loginEmail" 
                               name="email" 
                               placeholder="Enter your email" 
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="loginPassword" class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all" 
                               id="loginPassword" 
                               name="password" 
                               placeholder="Enter your password" 
                               required>
                    </div>
                    <div class="text-right mb-6">
                        <a href="#" class="text-orange-500 text-sm hover:underline">Forgot Password?</a>
                    </div>
                    <button type="submit" 
                            class="w-full bg-orange-500 text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transform hover:-translate-y-1 transition-all duration-300">
                        Login
                    </button>
                </form>
            </div>

            <!-- Register Tab -->
            <div id="registerTab" class="bg-white/20 backdrop-blur-lg border border-white/30 rounded-xl p-6 shadow-lg hidden">
                <h4 class="text-xl font-bold text-gray-800 mb-6">Create an Account</h4>
                <form action="{{ url('/register-web') }}" method="get">
                    <div class="mb-4">
                        <label for="registerUserType" class="block text-gray-700 font-semibold mb-2">I am a:</label>
                        <select id="registerUserType" 
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all" 
                                required 
                                name="role">
                            <option value="">-- Select --</option>
                            <option value="1">Admin</option>
                            <option value="3">Student</option>
                            <option value="2">Employee</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="registerFullName" class="block text-gray-700 font-semibold mb-2">Full Name</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all" 
                               id="registerFullName" 
                               name="name" 
                               placeholder="Your full name" 
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="registerEmail" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                        <input type="email" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all" 
                               id="registerEmail" 
                               name="email" 
                               placeholder="Your email" 
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="registerPassword" class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" 
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all" 
                               id="registerPassword" 
                               name="password" 
                               placeholder="Choose a password" 
                               required>
                    </div>

                    <!-- Student Fields -->
                    <div id="register-student-fields" class="hidden">
                        <div class="mb-4">
                            <label for="registerStudentYear" class="block text-gray-700 font-semibold mb-2">Year of Study</label>
                            <input type="text" 
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all" 
                                   id="registerStudentYear" 
                                   name="year" 
                                   placeholder="e.g. 2nd Year">
                        </div>
                        <div class="mb-4">
                            <label for="registerStudentDept" class="block text-gray-700 font-semibold mb-2">Department</label>
                            <input type="text" 
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all" 
                                   id="registerStudentDept" 
                                   placeholder="e.g. Computer Science">
                        </div>
                    </div>

                    <!-- Employee Fields -->
                    <div id="register-employee-fields" class="hidden">
                        <div class="mb-4">
                            <label for="registerCompany" class="block text-gray-700 font-semibold mb-2">Company Name</label>
                            <input type="text" 
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all" 
                                   id="registerCompany" 
                                   placeholder="Your company">
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-orange-500 text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transform hover:-translate-y-1 transition-all duration-300">
                        Register
                    </button>
                    <div class="text-right mt-4">
                        <span class="text-sm text-gray-600">Already have an account?</span>
                        <a href="#" id="goToLoginLink" class="text-orange-500 text-sm hover:underline ml-2">Login</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Disclaimer -->
        <div class="text-center mt-8 max-w-xl mx-auto">
            <p class="text-sm text-gray-600">
                By creating an account, you agree to our 
                <a href="#" class="text-orange-500 hover:underline">Terms & Conditions</a> and 
                <a href="#" class="text-orange-500 hover:underline">Privacy Policy</a>.
            </p>
        </div>

        <!-- Why Choose Section -->
        <div class="max-w-2xl mx-auto mt-12">
            <div class="bg-white/20 backdrop-blur-lg border border-white/30 rounded-xl p-6 shadow-lg">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Why Choose Our Edutech Platform?</h3>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start">
                        <span class="text-orange-500 mr-2">•</span>
                        Expert-led video lectures & interactive tutorials
                    </li>
                    <li class="flex items-start">
                        <span class="text-orange-500 mr-2">•</span>
                        Flexible learning paths for both students and professionals
                    </li>
                    <li class="flex items-start">
                        <span class="text-orange-500 mr-2">•</span>
                        Industry-recognized certifications & job assistance
                    </li>
                    <li class="flex items-start">
                        <span class="text-orange-500 mr-2">•</span>
                        24/7 support and personalized mentorship
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(180deg); }
        100% { transform: translateY(0px) rotate(360deg); }
    }
    .animate-float {
        animation: float 10s linear infinite;
    }
    .animation-delay-1000 { animation-delay: 1s; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-3000 { animation-delay: 3s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>

<script>
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const loginTab = document.getElementById('loginTab');
    const registerTab = document.getElementById('registerTab');
    const goToLoginLink = document.getElementById('goToLoginLink');

    function showLogin() {
        loginTab.classList.remove('hidden');
        registerTab.classList.add('hidden');
        loginBtn.classList.add('bg-orange-500', 'active');
        loginBtn.classList.remove('bg-blue-600');
        registerBtn.classList.add('bg-blue-600');
        registerBtn.classList.remove('bg-orange-500', 'active');
    }

    function showRegister() {
        registerTab.classList.remove('hidden');
        loginTab.classList.add('hidden');
        registerBtn.classList.add('bg-orange-500', 'active');
        registerBtn.classList.remove('bg-blue-600');
        loginBtn.classList.add('bg-blue-600');
        loginBtn.classList.remove('bg-orange-500', 'active');
    }

    loginBtn.addEventListener('click', showLogin);
    registerBtn.addEventListener('click', showRegister);
    goToLoginLink.addEventListener('click', (e) => {
        e.preventDefault();
        showLogin();
    });

    const registerUserType = document.getElementById('registerUserType');
    const studentFields = document.getElementById('register-student-fields');
    const employeeFields = document.getElementById('register-employee-fields');

    registerUserType.addEventListener('change', function() {
        studentFields.classList.add('hidden');
        employeeFields.classList.add('hidden');
        
        if (this.value === '3') { // Student
            studentFields.classList.remove('hidden');
        } else if (this.value === '2') { // Employee
            employeeFields.classList.remove('hidden');
        }
    });
</script>
@endsection