@extends('website.layouts.app')
@section('title', 'login')
@section('content')
<style>
    /* -----------------------------------------------------
       1) BASE & GLOBAL STYLES
    ----------------------------------------------------- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      scroll-behavior: smooth; 
    }
    body {
      font-family: "Poppins", sans-serif;
      font-size: 16px;
      font-weight: 400;
      line-height: 1.6;
      background-color: #f8f9fa;
      color: #333;
      overflow-x: hidden;
    }
    h1, h2, h3, h4, h5, h6 {
      font-weight: bold;
      line-height: 1.3;
    }
    h1 { font-size: 2.8rem; }
    h2 { font-size: 2.4rem; }
    h3 { font-size: 2rem; }
    section { padding: 80px 0; }

    /* Custom scrollbar (Orange) */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #ddd; }
    ::-webkit-scrollbar-thumb {
      background: #ff7300;
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #ff4500;
    }

    /* Responsive scaling */
    @media (max-width: 992px) {
      body { font-size: 15px; }
      section { padding: 60px 0; }
    }
    @media (max-width: 768px) {
      body { font-size: 14px; }
      h1 { font-size: 2.2rem; }
      h2 { font-size: 2rem; }
      h3 { font-size: 1.8rem; }
      section { padding: 50px 0; }
    }
    @media (max-width: 576px) {
      body { font-size: 13px; }
      h1 { font-size: 2rem; }
      h2 { font-size: 1.8rem; }
      h3 { font-size: 1.6rem; }
      section { padding: 40px 0; }
    }

    /* -----------------------------------------------------
       2) NAVBAR STYLES
    ----------------------------------------------------- */
    .navbar {
      background: linear-gradient(90deg, #2c0b57, #0c3c7c);
      padding: 15px 50px;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }
    .nav-link {
      color: white !important;
      font-weight: 500;
      position: relative;
      padding-bottom: 5px;
      transition: all 0.3s ease-in-out;
    }
    .nav-link::after {
      content: "";
      position: absolute;
      width: 0; 
      height: 3px;
      background: linear-gradient(90deg, #ffba42, #ff7300);
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      transition: width 0.3s ease-in-out;
    }
    .nav-link:hover::after { width: 60%; }
    .nav-link:hover {
      color: #ffba42 !important;
      transform: scale(1.1);
      text-shadow: 0 0 10px rgba(255, 186, 66, 0.7);
    }

    /* Dropdown menu override */
    .dropdown-menu {
      background: rgba(0, 0, 0, 0.9);
      border: none;
      border-radius: 8px;
      animation: fadeIn 0.3s ease-in-out;
    }
    .dropdown-item {
      color: white; 
      font-weight: 500;
      transition: all 0.3s ease-in-out;
    }
    .dropdown-item:hover {
      background: linear-gradient(90deg, #ffba42, #ff7300);
      color: white;
      transform: scale(1.05);
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Login button with animated gradient */
    .btn-login {
      background: linear-gradient(270deg, #ff7300, #ff5700, #ff4500);
      background-size: 200% 200%;
      border-radius: 6px;
      color: white;
      font-size: 18px;
      font-weight: bold;
      position: relative;
      overflow: hidden;
      box-shadow: 0px 4px 15px rgba(255, 115, 0, 0.5);
      animation: gradientBG 5s infinite alternate-reverse;
      text-transform: uppercase;
      transition: all 0.4s ease-in-out;
      letter-spacing: 1px;
    }
    @keyframes gradientBG {
      0%   { background-position: 0% 50%; }
      50%  { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .btn-login:hover {
      background: linear-gradient(90deg, #ff4500, #ff7300);
      box-shadow: 0 0 20px rgba(255, 115, 0, 0.8),
        0 0 25px rgba(255, 186, 66, 0.6);
      transform: scale(1.08);
    }
    .btn-login:active {
      transform: scale(0.98);
      box-shadow: 0px 3px 10px rgba(255, 115, 0, 0.5);
    }
    .btn-login::before {
      content: "";
      position: absolute;
      top: -50%; left: -50%;
      width: 200%; height: 200%;
      background: linear-gradient(120deg, rgba(255,255,255,0.4), transparent);
      transform: rotate(45deg);
      animation: shine 3s infinite;
    }
    @keyframes shine {
      0%   { left: -100%; }
      50%  { left: 100%; }
      100% { left: -100%; }
    }

    /* -----------------------------------------------------
       3) FLOATING TECH ICONS
    ----------------------------------------------------- */
    .tech-icons-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      overflow: hidden;
      z-index: 0;
    }
    .tech-icon {
      position: absolute;
      font-size: 4rem;
      color: rgba(255, 140, 0, 0.25);
      text-shadow: 0 0 15px rgba(255, 140, 0, 0.3);
      animation: floatRotate 10s linear infinite;
    }
    @keyframes floatRotate {
      0%   { transform: translateY(0px) rotate(0deg); }
      50%  { transform: translateY(-30px) rotate(180deg); }
      100% { transform: translateY(0px) rotate(360deg); }
    }
    .tech-icon:nth-child(1) { top: 10%; left: 5%; animation-delay: 0s; }
    .tech-icon:nth-child(2) { top: 35%; left: 80%; animation-delay: 2s; }
    .tech-icon:nth-child(3) { top: 60%; left: 15%; animation-delay: 4s; }
    .tech-icon:nth-child(4) { top: 75%; left: 70%; animation-delay: 1s; }
    .tech-icon:nth-child(5) { top: 20%; left: 50%; animation-delay: 3s; }
    @media (max-width: 576px) {
      .tech-icon { font-size: 2.5rem; }
    }

    /* -----------------------------------------------------
       4) GLASSMORPHIC CARD
    ----------------------------------------------------- */
    .glass-card {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(12px);
      border-radius: 15px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      position: relative;
      z-index: 1;
    }

    /* -----------------------------------------------------
       5) BRANDING HEADINGS
    ----------------------------------------------------- */
    .brand-title {
      font-size: 2rem;
      font-weight: 700;
      color: #333;
      margin-bottom: 0.5rem;
      text-align: center;
    }
    .brand-subtitle {
      font-size: 1rem;
      color: #555;
      text-align: center;
      margin-bottom: 2rem;
    }
    @media (min-width: 992px) {
      .brand-title { font-size: 2.4rem; }
    }

    /* Utility for form width */
    .custom-form-width {
      max-width: 500px;
      margin: 0 auto;
    }

    /* -----------------------------------------------------
       6) TAB BUTTONS
    ----------------------------------------------------- */
    .tab-buttons button {
      background-color: #517fff;
      border: none;
      color: #fff;
      padding: 0.75rem 1.5rem;
      margin: 0 0.25rem;
      border-radius: 5px;
      font-weight: 600;
      cursor: pointer;
      width: 150px;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .tab-buttons button:hover {
      background-color: #ff7b00;
      transform: translateY(-2px);
    }
    .tab-buttons button.active {
      background-color: #ff820e;
    }
    .tab-content.inactive { display: none; }

    /* -----------------------------------------------------
       7) FORM STYLES
    ----------------------------------------------------- */
    .form-group label {
      font-weight: 500;
    }
    .form-control {
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .form-control:focus {
      box-shadow: 0 0 5px rgba(255, 127, 0, 0.5);
      border-color: #ff7f00;
      outline: none;
    }
    .btn-auth {
      background-color: #ff7f00;
      border: none;
      color: #fff;
      font-weight: 600;
      transition: background-color 0.3s ease, transform 0.3s ease;
      margin-top: 1rem;
      width: 100%;
    }
    .btn-auth:hover {
      background-color: #e76e00;
      transform: translateY(-2px);
    }
    .extra-links {
      font-size: 0.9rem;
      margin-top: 1rem;
      text-align: right;
    }
    .extra-links a {
      color: #ff7f00;
      text-decoration: none;
      margin-left: 0.5rem;
    }
    .extra-links a:hover {
      text-decoration: underline;
    }

    /* Show/hide for user type fields */
    #register-student-fields,
    #register-employee-fields { display: none; }

    /* -----------------------------------------------------
       8) DISCLAIMER
    ----------------------------------------------------- */
    .disclaimer {
      font-size: 0.85rem;
      color: #555;
      text-align: center;
      max-width: 600px;
      margin: 0 auto;
    }
    .disclaimer a {
      color: #ff7f00;
      text-decoration: none;
    }
    .disclaimer a:hover {
      text-decoration: underline;
    }

    /* -----------------------------------------------------
       9) "WHY CHOOSE" SECTION
    ----------------------------------------------------- */
    .features-section h3 {
      margin-bottom: 1rem;
      font-weight: 700;
    }
    .features-section ul {
      list-style: none;
      padding-left: 1rem;
    }
    .features-section li {
      margin-bottom: 0.5rem;
      position: relative;
    }
    .features-section li::before {
      content: "•";
      color: #ff7f00;
      font-weight: bold;
      margin-right: 0.5rem;
    }

    /* -----------------------------------------------------
       10) FOOTER
    ----------------------------------------------------- */
    .footer {
      background-color: #0a0a0a;
      color: white;
      padding: 50px 0;
      position: relative;
    }
    .footer-grid {
      display: grid;
      grid-template-columns: 2fr 2fr 2fr 2fr 2fr;
      gap: 20px; 
      max-width: 1200px; 
      margin: 0 auto; 
      align-items: start;
    }
    .company-logo {
      width: 150px; margin-bottom: 10px;
    }
    .footer-description {
      font-size: 0.9rem; line-height: 1.4; max-width: 250px;
    }
    .footer-section h3 {
      font-size: 1.1rem; margin-bottom: 15px; font-weight: bold; text-transform: uppercase;
    }
    .footer-section ul { list-style: none; padding: 0; }
    .footer-section ul li { margin-bottom: 6px; }
    .footer-section ul li a {
      color: #bbb; text-decoration: none; font-size: 0.9rem;
      transition: color 0.3s ease-in-out;
    }
    .footer-section ul li a:hover {
      color: #ffeb3b; transform: scale(1.05);
    }
    .social-icons { display: flex; gap: 10px; margin-top: 10px; }
    .social-icon {
      display: inline-flex; width: 35px; height: 35px; justify-content: center; align-items: center;
      background: white; border-radius: 50%; color: black; font-size: 1rem;
      transition: all 0.3s ease-in-out;
    }
    .social-icon:hover {
      background: #ffeb3b; color: #333; transform: scale(1.1);
    }
    .footer-bottom {
      text-align: center; font-size: 0.85rem; padding-top: 20px;
      border-top: 1px solid rgba(255,255,255,0.2); margin-top: 20px;
    }
    .footer-bottom-links {
      list-style: none; padding: 0; margin-top: 10px; display: flex; justify-content: center; gap: 15px;
    }
    .footer-bottom-links li a {
      color: #bbb; text-decoration: none; font-size: 0.9rem;
      transition: color 0.3s ease-in-out;
    }
    .footer-bottom-links li a:hover { color: #ffeb3b; }

    @media (max-width: 1024px) {
      .footer-grid {
        grid-template-columns: repeat(3, 1fr);
        text-align: center;
      }
    }
    @media (max-width: 768px) {
      .footer-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    @media (max-width: 480px) {
      .footer-grid {
        grid-template-columns: 1fr;
        text-align: center;
      }
    }
  </style>

    <!-- MAIN CONTENT -->
    <div class="container mx-auto relative z-10">
        <!-- Header / Branding -->
        <div class="row flex flex-wrap justify-center mt-8">
          <div class="col-12 w-full text-center">
            <h1 class="brand-title text-2xl md:text-3xl font-bold mb-2">Edutech Platform</h1>
            <p class="brand-subtitle text-base text-[#555]">
              Empowering Students & Professionals with Quality Education
            </p>
          </div>
        </div>
       <!-- Success Message -->
@if (session('success'))
<div class="bg-green-500 text-white p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<!-- General Error Message -->
@if (session('error'))
<div class="bg-red-500 text-white p-3 rounded mb-4">
    {{ session('error') }}
</div>
@endif

<!-- Validation Errors -->
@if ($errors->any())
<div class="bg-red-500 text-white p-3 rounded mb-4">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

        <!-- Tab Buttons -->
        <div class="row flex flex-wrap justify-center mb-3">
          <div class="col-auto tab-buttons">
            <button id="loginBtn" class="active">Login</button>
            <button id="registerBtn">Register</button>
          </div>
          <!-- Error Message -->

        </div>
  
        <!-- Login / Register Panels -->
        <div class="row flex flex-wrap justify-center mb-6">
          <div class="col-md-5 w-full custom-form-width">
            <!-- LOGIN TAB -->
            <div id="loginTab" class="glass-card p-6 tab-content">
              <h4 class="mb-3 text-lg font-bold">Welcome Back</h4>
              <form action="{{ url('/login_check') }}" method="get">
                @csrf
                <div class="form-group">
                    <label for="loginEmail" class="block mb-1 font-semibold">Email Address</label>
                    <input
                        type="email"
                        class="form-control w-full px-3 py-2 rounded border"
                        id="loginEmail"
                        name="email"
                        placeholder="Enter your email"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="loginPassword" class="block mb-1 font-semibold">Password</label>
                    <input
                        type="password"
                        class="form-control w-full px-3 py-2 rounded border"
                        id="loginPassword"
                        name="password"
                        placeholder="Enter your password"
                        required
                    />
                </div>
                <div class="extra-links text-right text-sm mt-2">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn-auth px-5 py-2 rounded mt-4">
                    Login
                </button>
            </form>
            
            </div>
  
            <!-- REGISTER TAB -->
            <div id="registerTab" class="glass-card p-6 tab-content inactive">
              <h4 class="mb-3 text-lg font-bold">Create an Account</h4>
              <form action="{{ url('/register-web') }}" method="get">
                <!-- User Type Selection -->
                <div class="form-group">
                  <label for="registerUserType" class="block mb-1 font-semibold"
                    >I am a:</label
                  >
                  <select
                    id="registerUserType"
                    class="form-control w-full px-3 py-2 rounded border"
                    required
                    name='role'
                  >
                    <option value="">-- Select --</option>
                    <option value="1">Admin</option>
                    <option value="3">Student</option>
                    <option value="2">Employee</option>
                  </select>
                </div>
  
                <!-- Common Fields -->
                <div class="form-group">
                  <label for="registerFullName" class="block mb-1 font-semibold"
                    >Full Name</label
                  >
                  <input
                    type="text"
                    class="form-control w-full px-3 py-2 rounded border"
                    id="registerFullName"
                    name='name'
                    placeholder="Your full name"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="registerEmail" class="block mb-1 font-semibold"
                    >Email Address</label
                  >
                  <input
                    type="email"
                    class="form-control w-full px-3 py-2 rounded border"
                    id="registerEmail"
                     name='email'
                    placeholder="Your email"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="registerPassword" class="block mb-1 font-semibold"
                    >Password</label
                  >
                  <input
                    type="password"
                    class="form-control w-full px-3 py-2 rounded border"
                    id="registerPassword"
                    name='password'
                    placeholder="Choose a password"
                    required
                  />
                </div>
  
                <!-- Student Fields -->
                <div id="register-student-fields">
                  <div class="form-group">
                    <label for="registerStudentYear" class="block mb-1 font-semibold"
                      >Year of Study</label
                    >
                    <input
                      type="text"
                      class="form-control w-full px-3 py-2 rounded border"
                      id="registerStudentYear"
                      name='year'
                      placeholder="e.g. 2nd Year"
                    />
                  </div>
                  <div class="form-group">
                    <label for="registerStudentDept" class="block mb-1 font-semibold"
                      >Department</label
                    >
                    <input
                      type="text"
                      class="form-control w-full px-3 py-2 rounded border"
                      id="registerStudentDept"
                      placeholder="e.g. Computer Science"
                    />
                  </div>
                </div>
  
                <!-- Employee Fields -->
                <div id="register-employee-fields">
                  <div class="form-group">
                    <label for="registerCompany" class="block mb-1 font-semibold"
                      >Company Name</label
                    >
                    <input
                      type="text"
                      class="form-control w-full px-3 py-2 rounded border"
                      id="registerCompany"
                      placeholder="Your company"
                    />
                  </div>
                </div>
  
                <button type="submit" class="btn-auth px-5 py-2 rounded mt-4">
                  Register
                </button>
              </form>
              <div class="extra-links text-right text-sm mt-2">
                <span>Already have an account?</span>
                <a href="#" id="goToLoginLink">Login</a>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Disclaimer -->
        <div class="row flex flex-wrap justify-center mb-6">
          <div class="col-md-8 w-full px-2">
            <div class="disclaimer mx-auto text-sm text-[#555]">
              <p>
                By creating an account, you agree to our
                <a href="#" class="text-[#ff7f00]">Terms & Conditions</a> and
                <a href="#" class="text-[#ff7f00]">Privacy Policy</a>.
              </p>
            </div>
          </div>
        </div>
  
        <!-- "Why Choose" Section -->
        <div class="row flex flex-wrap justify-center mb-10">
          <div class="col-md-8 w-full px-2">
            <div class="glass-card p-6 features-section">
              <h3 class="text-xl font-bold mb-4">Why Choose Our Edutech Platform?</h3>
              <ul class="list-none ml-2 text-sm">
                <li>Expert-led video lectures & interactive tutorials</li>
                <li>Flexible learning paths for both students and professionals</li>
                <li>Industry-recognized certifications & job assistance</li>
                <li>24/7 support and personalized mentorship</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Tab & Field Toggle Scripts -->
      <script>
        const loginBtn = document.getElementById("loginBtn");
        const registerBtn = document.getElementById("registerBtn");
        const loginTab = document.getElementById("loginTab");
        const registerTab = document.getElementById("registerTab");
        const goToLoginLink = document.getElementById("goToLoginLink");
  
        function showLogin() {
          loginTab.classList.remove("inactive");
          registerTab.classList.add("inactive");
          loginBtn.classList.add("active");
          registerBtn.classList.remove("active");
        }
  
        function showRegister() {
          registerTab.classList.remove("inactive");
          loginTab.classList.add("inactive");
          registerBtn.classList.add("active");
          loginBtn.classList.remove("active");
        }
  
        loginBtn.addEventListener("click", showLogin);
        registerBtn.addEventListener("click", showRegister);
        goToLoginLink.addEventListener("click", function (e) {
          e.preventDefault();
          showLogin();
        });
  
        // Toggle Student / Employee fields
        const registerUserType = document.getElementById("registerUserType");
        const studentFields = document.getElementById("register-student-fields");
        const employeeFields = document.getElementById("register-employee-fields");
  
        registerUserType.addEventListener("change", function () {
          const value = this.value;
          studentFields.style.display = "none";
          employeeFields.style.display = "none";
  
          if (value === "student") {
            studentFields.style.display = "block";
          } else if (value === "employee") {
            employeeFields.style.display = "block";
          }
        });
      </script>
          <!-- GSAP Scroll Animations -->
    <script>
        gsap.registerPlugin(ScrollTrigger);
  
        gsap.from(".footer-grid", {
          opacity: 0,
          y: 50,
          duration: 1.2,
          ease: "power2.out",
          scrollTrigger: {
            trigger: ".footer",
            start: "top 95%",
            toggleActions: "play none none reverse",
          },
        });
  
        gsap.from(".footer-section h3, .footer-section ul li", {
          opacity: 0,
          y: 20,
          stagger: 0.2,
          duration: 1,
          ease: "power2.out",
          scrollTrigger: {
            trigger: ".footer",
            start: "top 95%",
            toggleActions: "play none none reverse",
          },
        });
      </script>
@endsection