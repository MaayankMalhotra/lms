@extends('website.layouts.app')

@section('title', 'Home Page')

@section('content')
<style>
  .swiper-button-next svg,.swiper-button-prev svg {
    width: 100%;
    height: 64%;
    object-fit: contain;
    transform-origin: center
}
</style>

  <section class="relative bg-gradient-to-r from-[#161c44] to-[#0c3c7c] text-white overflow-hidden">
    <div class="container mx-auto px-4 py-16 md:py-24">
      <div class="pt-10 flex flex-col md:flex-row items-center gap-8">
        <!-- Left Content -->
        <div class="md:w-1/2">
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in-up">
            Change the world <br>
            with <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Think Champ</span>
          </h1>
          <p class="text-lg md:text-xl mb-8 opacity-0 animate-fade-in-up delay-100">
            Learn coding using 500+ courses, practice problems, and AI. Become
            job ready <strong class="font-semibold">10x faster</strong>.
          </p>
          <div class="text-center">
          <a href="#" class="inline-block bg-gradient-to-r from-orange-500 to-amber-400 text-white px-8 py-4 rounded-full text-lg font-bold hover:scale-105 transition-transform duration-300 shadow-lg hover:shadow-xl hover:shadow-orange-500/30">
            Start your coding journey
          </a>
          </div>
        </div>
  
        <!-- Right Content -->
        <div class="md:w-1/2 w-full mt-8 md:mt-0">
          <div class="grid gap-16 md:gap-6 md:grid-cols-2">
            <!-- Placement Card 1 -->
            <div class="relative bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 group">
              <div class="flex flex-col">
                <div class="mb-16">
                  <h3 class="text-black font-bold text-lg">J Murali Reddy</h3>
                  <p class="text-gray-600 text-sm">Diploma Tirupathi</p>
                </div>
                <img src="./images/m1.png" alt="Student" class="absolute w-24 h-24 bg-white object-cover rounded-lg -top-12 right-4 shadow-md">
                <div class="space-y-2">
                  <div class="flex flex-wrap gap-2">
                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-3 py-1 rounded-full">
                      POST 12TH / INTERMEDIATE
                    </span>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">
                      1ST, 2ND, 3RD YEAR
                    </span>
                  </div>
                  <p class="text-black text-sm"><strong>🏢 Placed At:</strong> Google</p>
                  <p class="text-black text-sm"><strong>💰 Package:</strong> ₹32 LPA</p>
                  <p class="text-red-500 text-sm font-semibold">🔥 Limited Seats Available</p>
                </div>
                <a href="#" class="mt-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white text-center py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-opacity">
                  REQUEST CALLBACK
                </a>
              </div>
            </div>
  
            <!-- Placement Card 2 -->
            <div class="relative bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 group">
              <div class="flex flex-col">
                <div class="mb-16">
                  <h3 class="text-black font-bold text-lg">P Sri Hari</h3>
                  <p class="text-gray-600 text-sm">Degree Tirupathi</p>
                </div>
                <img src="./images/hari.png" alt="Student" class="absolute w-24 h-24 bg-white object-cover rounded-lg -top-12 right-4 shadow-md">
                <div class="space-y-2">
                  <div class="flex flex-wrap gap-2">
                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-3 py-1 rounded-full">
                      POST 12TH / INTERMEDIATE
                    </span>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">
                      1ST, 2ND, 3RD YEAR
                    </span>
                  </div>
                  <p class="text-black text-sm"><strong>🏢 Placed At:</strong> Google</p>
                  <p class="text-black text-sm"><strong>💰 Package:</strong> ₹32 LPA</p>
                  <p class="text-red-500 text-sm font-semibold">🔥 Limited Seats Available</p>
                </div>
                <a href="#" class="mt-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white text-center py-2 rounded-lg text-sm font-medium hover:opacity-90 transition-opacity">
                  REQUEST CALLBACK
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Bottom Curve -->
    <div class="absolute bottom-0 left-0 w-full">
      <svg viewBox="0 0 1440 120" class="fill-current text-[#161c44]">
        <path d="M0,240 L720,300 L1440,250 L1440,320 L0,320Z"></path>
      </svg>
    </div>
  </section>
  
  <style>
    @keyframes fade-in-up {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
  
    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out forwards;
    }
  
    .delay-100 {
      animation-delay: 0.2s;
    }
  
    .placement-card:hover .student-img {
      transform: translateY(-5px);
    }
  
    .student-img {
      transition: transform 0.3s ease-in-out;
    }
  </style>

  <section class="bg-[#f8eeea] py-6">
    <div class="container mx-auto px-4">
      <!-- Title -->
      <h2 class="text-3xl lg:text-5xl font-bold text-center text-[#2c0b57]">
        Instantly & <span class="text-[#ffb31a]">Interactively Maayank</span>
      </h2>
      <p class="text-lg text-center text-gray-600 mt-4">
        Learn from carefully curated learning paths with up-to-date interactive courses.
      </p>

      <!-- Navigation Tabs -->
      <div class="mt-8 oscroll-smooth hide-scrollbar">
        <div class="inline-flex w-full md:w-auto md:justify-center">
          <ul class="flex space-x-4 whitespace-nowrap">
            <li>
              <a href="#studyCourses"
                class="nav-tab text-base md:text-lg font-bold
                            hover:text-[#ff7300] hover:border-[#ff7300] transition-all duration-300 
                            data-[active=true]:text-white data-[active=true]:bg-[#ff7300] data-[active=true]:py-2 data-[active=true]:px-4 data-[active=true]:rounded-xl "
                data-tab="studyCourses" data-active="true">
                Courses
              </a>
            </li>
            <li>
              <a href="#studyUpcoming"
                class="nav-tab text-base md:text-lg font-bold
                            hover:text-[#ff7300] hover:border-[#ff7300] transition-all duration-300 
                            data-[active=true]:text-white data-[active=true]:bg-[#ff7300] data-[active=true]:py-2 data-[active=true]:px-4 data-[active=true]:rounded-xl "
                data-tab="studyUpcoming">
                Upcoming Courses
              </a>
            </li>
            <li>
              <a href="#studyInternships"
                class="nav-tab text-base md:text-lg font-bold
                            hover:text-[#ff7300] hover:border-[#ff7300] transition-all duration-300 
                            data-[active=true]:text-white data-[active=true]:bg-[#ff7300] data-[active=true]:py-2 data-[active=true]:px-4 data-[active=true]:rounded-xl "
                data-tab="studyInternships">
                Internships
              </a>
            </li>
          </ul>
        </div>
      </div>



      <!-- Tab Content -->
      <div class="mt-12">
        <div class="mt-12">
          <!-- Courses Tab -->
          <div id="studyCourses" class="tab-pane">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              <!-- Python Course -->
              <div
                class="study-box bg-white rounded-lg shadow-md p-6 text-center transition-all hover:scale-105 hover:shadow-lg">
                <h3 class="text-xl font-bold text-[#2c0b57]">
                  Python with DSA [Updated 2023]
                </h3>
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg"
                  class="w-12 h-12 mx-auto my-4 transition-transform hover:rotate-y-180" alt="Python" />
                <div class="text-gray-600 space-y-2">
                  <p>
                    <i class="far fa-clock"></i> Duration:
                    <span class="font-bold">3-4 Months</span>
                  </p>
                  <p>
                    <i class="fas fa-users"></i>
                    <span class="font-bold">20+ Placed</span>
                  </p>
                  <p>⭐ 4.8 (17K+ students)</p>
                </div>
                <button
                  class="mt-4 w-full bg-[#ff7b00] text-white py-2 rounded-lg font-bold hover:bg-[#ff5500] transition-all">
                  Register Now
                </button>
              </div>

              <!-- Java Course -->
              <div
                class="study-box bg-white rounded-lg shadow-md p-6 text-center transition-all hover:scale-105 hover:shadow-lg">
                <h3 class="text-xl font-bold text-[#2c0b57]">
                  Java with DSA [Updated 2023]
                </h3>
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg"
                  class="w-12 h-12 mx-auto my-4 transition-transform hover:rotate-y-180" alt="Java" />
                <div class="text-gray-600 space-y-2">
                  <p>
                    <i class="far fa-clock"></i> Duration:
                    <span class="font-bold">4 Months</span>
                  </p>
                  <p>
                    <i class="fas fa-users"></i>
                    <span class="font-bold">30+ Placed</span>
                  </p>
                  <p>⭐ 4.8 (17K+ students)</p>
                </div>
                <button
                  class="mt-4 w-full bg-[#ff7b00] text-white py-2 rounded-lg font-bold hover:bg-[#ff5500] transition-all">
                  Register Now
                </button>
              </div>

              <!-- C++ Course -->
              <div
                class="study-box bg-white rounded-lg shadow-md p-6 text-center transition-all hover:scale-105 hover:shadow-lg">
                <h3 class="text-xl font-bold text-[#2c0b57]">
                  C++ with DSA [Updated 2023]
                </h3>
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/cplusplus/cplusplus-original.svg"
                  class="w-12 h-12 mx-auto my-4 transition-transform hover:rotate-y-180" alt="C++" />
                <div class="text-gray-600 space-y-2">
                  <p>
                    <i class="far fa-clock"></i> Duration:
                    <span class="font-bold">3 Months</span>
                  </p>
                  <p>
                    <i class="fas fa-users"></i>
                    <span class="font-bold">25+ Placed</span>
                  </p>
                  <p>⭐ 4.8 (17K+ students)</p>
                </div>
                <button
                  class="mt-4 w-full bg-[#ff7b00] text-white py-2 rounded-lg font-bold hover:bg-[#ff5500] transition-all">
                  Register Now
                </button>
              </div>
            </div>
            <div id="viewAllCourses" class="text-center mt-8">
              <a href="course.html"
                class="inline-block bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white px-8 py-3 rounded-lg font-bold hover:shadow-lg hover:shadow-orange-300 transition-all">
                View All Courses
              </a>
            </div>
          </div>

          <!-- Upcoming Courses Tab -->
          <div id="studyUpcoming" class="tab-pane hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              <!-- Advanced AI Techniques -->
              <div
                class="study-box bg-white rounded-lg shadow-md p-6 text-center transition-all hover:scale-105 hover:shadow-lg">
                <h3 class="text-xl font-bold text-[#2c0b57]">
                  Advanced AI Techniques
                </h3>
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tensorflow/tensorflow-original.svg"
                  class="w-12 h-12 mx-auto my-4 transition-transform hover:rotate-y-180" alt="AI Techniques" />
                <p class="text-gray-600">
                  <i class="fas fa-calendar"></i> Start Date:
                  <span class="font-bold">April 15, 2024</span>
                </p>
                <p class="text-green-600 mt-2">
                  <i class="fas fa-check-circle"></i> Slots Open
                </p>
                <button
                  class="mt-4 w-full bg-[#ff7b00] text-white py-2 rounded-lg font-bold hover:bg-[#ff5500] transition-all">
                  Pre-register Now
                </button>
              </div>

              <!-- Cybersecurity Essentials -->
              <div
                class="study-box bg-white rounded-lg shadow-md p-6 text-center transition-all hover:scale-105 hover:shadow-lg">
                <h3 class="text-xl font-bold text-[#2c0b57]">
                  Cybersecurity Essentials
                </h3>
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/linux/linux-original.svg"
                  class="w-12 h-12 mx-auto my-4 transition-transform hover:rotate-y-180" alt="Cybersecurity" />
                <p class="text-gray-600">
                  <i class="fas fa-calendar"></i> Start Date:
                  <span class="font-bold">May 10, 2024</span>
                </p>
                <p class="text-green-600 mt-2">
                  <i class="fas fa-check-circle"></i> Slots Open
                </p>
                <button
                  class="mt-4 w-full bg-[#ff7b00] text-white py-2 rounded-lg font-bold hover:bg-[#ff5500] transition-all">
                  Pre-register Now
                </button>
              </div>

              <!-- Cloud Computing Basics -->
              <div
                class="study-box bg-white rounded-lg shadow-md p-6 text-center transition-all hover:scale-105 hover:shadow-lg">
                <h3 class="text-xl font-bold text-[#2c0b57]">
                  Cloud Computing Basics
                </h3>
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/aws/aws-original.svg"
                  class="w-12 h-12 mx-auto my-4 transition-transform hover:rotate-y-180" alt="Cloud Computing" />
                <p class="text-gray-600">
                  <i class="fas fa-calendar"></i> Start Date:
                  <span class="font-bold">May 25, 2024</span>
                </p>
                <p class="text-green-600 mt-2">
                  <i class="fas fa-check-circle"></i> Slots Open
                </p>
                <button
                  class="mt-4 w-full bg-[#ff7b00] text-white py-2 rounded-lg font-bold hover:bg-[#ff5500] transition-all">
                  Pre-register Now
                </button>
              </div>
            </div>
            <div id="viewAllUpcoming" class="text-center mt-8 hidden">
              <a href="#"
                class="inline-block bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white px-8 py-3 rounded-lg font-bold hover:shadow-lg hover:shadow-orange-300 transition-all">
                View All Upcoming Courses
              </a>
            </div>
          </div>

          <!-- Internships Tab -->
          <div id="studyInternships" class="tab-pane hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              <!-- Software Internship -->
              <div
                class="study-box bg-white rounded-lg shadow-md p-6 text-center transition-all hover:scale-105 hover:shadow-lg">
                <h4 class="text-xl font-bold text-[#2c0b57]">
                  Software Internship
                </h4>
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg"
                  class="w-12 h-12 mx-auto my-4 transition-transform hover:rotate-y-180" alt="React" />
                <div class="text-gray-600 space-y-2">
                  <div class="flex justify-around">
                    <span>
                      <i class="far fa-clock"></i> 6 Months
                    </span>
                    <span>
                      <i class="fas fa-tasks"></i> 5 Projects
                    </span>
                  </div>
                  <p>⭐ 4.9 (2K+ applicants)</p>
                </div>
                <span class="inline-block bg-[#ffd700] text-[#333] px-3 py-1 rounded-full text-sm font-bold mt-2">
                  AICTE & MSME Certified
                </span>
                <button
                  class="mt-4 w-full bg-[#ff7b00] text-white py-2 rounded-lg font-bold hover:bg-[#ff5500] transition-all">
                  Register Now
                </button>
              </div>

              <!-- AI Research Internship -->
              <div
                class="study-box bg-white rounded-lg shadow-md p-6 text-center transition-all hover:scale-105 hover:shadow-lg">
                <h4 class="text-xl font-bold text-[#2c0b57]">
                  AI Research Internship
                </h4>
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tensorflow/tensorflow-original.svg"
                  class="w-12 h-12 mx-auto my-4 transition-transform hover:rotate-y-180" alt="TensorFlow" />
                <div class="text-gray-600 space-y-2">
                  <div class="flex justify-around">
                    <span>
                      <i class="far fa-clock"></i> 6 Months
                    </span>
                    <span>
                      <i class="fas fa-tasks"></i> 5 Projects
                    </span>
                  </div>
                  <p>⭐ 4.9 (2K+ applicants)</p>
                </div>
                <span class="inline-block bg-[#ffd700] text-[#333] px-3 py-1 rounded-full text-sm font-bold mt-2">
                  AICTE & MSME Certified
                </span>
                <button
                  class="mt-4 w-full bg-[#ff7b00] text-white py-2 rounded-lg font-bold hover:bg-[#ff5500] transition-all">
                  Register Now
                </button>
              </div>

              <!-- Cybersecurity Internship -->
              <div
                class="study-box bg-white rounded-lg shadow-md p-6 text-center transition-all hover:scale-105 hover:shadow-lg">
                <h4 class="text-xl font-bold text-[#2c0b57]">
                  Cybersecurity Internship
                </h4>
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/linux/linux-original.svg"
                  class="w-12 h-12 mx-auto my-4 transition-transform hover:rotate-y-180" alt="Linux" />
                <div class="text-gray-600 space-y-2">
                  <div class="flex justify-around">
                    <span>
                      <i class="far fa-clock"></i> 6 Months
                    </span>
                    <span>
                      <i class="fas fa-tasks"></i> 5 Projects
                    </span>
                  </div>
                  <p>⭐ 4.9 (2K+ applicants)</p>
                </div>
                <span class="inline-block bg-[#ffd700] text-[#333] px-3 py-1 rounded-full text-sm font-bold mt-2">
                  AICTE & MSME Certified
                </span>
                <button
                  class="mt-4 w-full bg-[#ff7b00] text-white py-2 rounded-lg font-bold hover:bg-[#ff5500] transition-all">
                  Register Now
                </button>
              </div>
            </div>
            <div id="viewAllInternships" class="text-center mt-8 hidden">
              <a href="internship_coures.html"
                class="inline-block bg-gradient-to-r from-[#ff7300] to-[#ff4500] text-white px-8 py-3 rounded-lg font-bold hover:shadow-lg hover:shadow-orange-300 transition-all">
                View All Internships
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-6 md:py-10 px-6 lg:px-16">
    <div class="max-w-7xl mx-auto">
      <!-- Recognition Section -->
      <div class="mb-6 text-center">
        <span class="text-sm font-semibold text-blue-600 tracking-wide">TRUSTED BY INDUSTRY LEADERS</span>
        <h2 class="text-3xl md:text-5xl font-extrabold mt-2">Globally Recognized Excellence</h2>
        <div class="flex justify-center space-x-10 overflow-x-auto py-6">
          <img src="./images/aicte.png" alt="AICTE" class="h-12 lg:h-20 object-contain opacity-80 hover:opacity-100 transition rounded">
          <img src="./images/iso.jpg" alt="ISO Certified"
            class="h-12 lg:h-20 object-contain opacity-80 hover:opacity-100 transition rounded">
          <img src="./images/msme.png" alt="MSME" class="h-12 lg:h-20 object-contain opacity-80 hover:opacity-100 transition rounded">
        </div>
      </div>

      <!-- Impact Section -->
      <div class="grid lg:grid-cols-2 gap-8 items-center">
        <!-- Image with Floating Effect -->
        <div class="relative group">
          <div
            class="absolute -inset-4 bg-gradient-to-r from-blue-200 to-purple-200 rounded-2xl blur-lg opacity-40 group-hover:opacity-60 transition">
          </div>
          <img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/0f938c1f3d199500f30705cd757a025543cd56a6a374094b8fbbaa4f83e5a0b0"
            alt="Student Success"
            class="relative w-full rounded-2xl shadow-2xl">
        </div>

        <!-- Content -->
        <div class="space-y-4 md:space-y-6">
          <h3 class="text-3xl md:text-5xl font-bold leading-tight">
            Shaping the Future of <span
              class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Tech
              Education</span>
          </h3>
          <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
            Join 10,000+ students who transformed their careers through our immersive learning programs.
          </p>
          <!-- Stats Grid -->
          <div class="grid grid-cols-2 gap-6">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl border border-gray-100">
              <div class="text-4xl font-bold text-blue-600">300+</div>
              <p class="text-gray-600 font-semibold">Hiring Partners</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl border border-gray-100">
              <div class="text-4xl font-bold text-purple-600">5.5K+</div>
              <p class="text-gray-600 font-semibold">Career Transitions</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl border border-gray-100">
              <div class="text-4xl font-bold text-blue-600">500+</div>
              <p class="text-gray-600 font-semibold">Live Projects</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl border border-gray-100">
              <div class="text-4xl font-bold text-purple-600">98%</div>
              <p class="text-gray-600 font-semibold">Success Rate</p>
            </div>
          </div>
          <!-- CTA -->
          <div class="mt-12 text-center">
            <a href="#"
              class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-purple-600 text-white md:px-8 px-6 py-3  md:py-5 rounded-full text-lg font-bold hover:shadow-xl hover:scale-105 transition-all">
              Start Free Trial Today
              <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                </path>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-6 lg:py-10 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50">
    <div class="max-w-6xl mx-auto text-center">
      <span
        class="inline-block px-4 py-1 bg-blue-100 text-blue-700 text-sm font-semibold tracking-wider uppercase rounded-full mb-4">Enrollment
        Process</span>
      <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mt-3 mb-12 leading-tight">
        Start Your Child's Coding Journey
        <span
          class="block mt-2 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">In
          4 Simple Steps</span>
      </h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-8 mt-8 relative">
      <!-- Enhanced Connecting Line with Animation -->
      <div class="hidden lg:block absolute top-1/2 left-0 w-full">
        <div class="h-1 bg-gradient-to-r from-blue-200 via-indigo-300 to-purple-200 rounded-full animate-pulse">
        </div>
      </div>

      <!-- Step 1 -->
      <div
        class="group relative bg-white p-8 rounded-3xl shadow-lg border border-blue-50 hover:border-blue-100 transform hover:-translate-y-2 transition-all duration-300">
        <div
          class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-500 to-blue-600 text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold shadow-lg group-hover:scale-110 transition-transform">
          1</div>
        <div class="flex justify-center mb-6">
          <div class="relative">
            <div
              class="absolute inset-0 bg-blue-100 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12">
            </div>
            <img src="https://img.freepik.com/free-vector/sign-up-concept-illustration_114360-7865.jpg"
              class="relative w-36 h-36 object-cover rounded-2xl shadow-md transform transition-transform group-hover:scale-105"
              alt="Sign Up">
          </div>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">Sign Up
        </h3>
        <p class="text-gray-600">Begin your child's exciting journey with our free demo session!</p>
      </div>

      <!-- Step 2 -->
      <div
        class="group relative bg-white p-8 rounded-3xl shadow-lg border border-indigo-50 hover:border-indigo-100 transform hover:-translate-y-2 transition-all duration-300">
        <div
          class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold shadow-lg group-hover:scale-110 transition-transform">
          2</div>
        <div class="flex justify-center mb-6">
          <div class="relative">
            <div
              class="absolute inset-0 bg-indigo-100 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12">
            </div>
            <img src="https://img.freepik.com/free-vector/online-education-concept_52683-37480.jpg"
              class="relative w-36 h-36 object-cover rounded-2xl shadow-md transform transition-transform group-hover:scale-105"
              alt="Select Course">
          </div>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-indigo-600 transition-colors">Select
          Course</h3>
        <p class="text-gray-600">Choose the perfect course for your child's age and skill level.</p>
      </div>

      <!-- Similar pattern for Steps 3 and 4 -->
      <!-- Step 3 -->
      <div
        class="group relative bg-white p-8 rounded-3xl shadow-lg border border-purple-50 hover:border-purple-100 transform hover:-translate-y-2 transition-all duration-300">
        <div
          class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-purple-500 to-purple-600 text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold shadow-lg group-hover:scale-110 transition-transform">
          3</div>
        <div class="flex justify-center mb-6">
          <div class="relative">
            <div
              class="absolute inset-0 bg-purple-100 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12">
            </div>
            <img src="https://img.freepik.com/free-vector/online-tutorials-concept_52683-37481.jpg"
              class="relative w-36 h-36 object-cover rounded-2xl shadow-md transform transition-transform group-hover:scale-105"
              alt="Start Learning">
          </div>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors">Start
          Learning</h3>
        <p class="text-gray-600">Pick from 200+ expert mentors at your preferred time.</p>
      </div>

      <!-- Step 4 -->
      <div
        class="group relative bg-white p-8 rounded-3xl shadow-lg border border-blue-50 hover:border-blue-100 transform hover:-translate-y-2 transition-all duration-300">
        <div
          class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-500 to-blue-600 text-white w-10 h-10 rounded-xl flex items-center justify-center font-bold shadow-lg group-hover:scale-110 transition-transform">
          4</div>
        <div class="flex justify-center mb-6">
          <div class="relative">
            <div
              class="absolute inset-0 bg-blue-100 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12">
            </div>
            <img src="https://img.freepik.com/free-vector/certificate-concept-illustration_114360-5743.jpg"
              class="relative w-36 h-36 object-cover rounded-2xl shadow-md transform transition-transform group-hover:scale-105"
              alt="Get Certificate">
          </div>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">Get
          Certified</h3>
        <p class="text-gray-600">Earn an industry-recognized certificate upon completion.</p>
      </div>
    </div>
  </section>

  <section class="bg-[#f8eeea] py-6 lg:py-10 px-4">
    <div class="container mx-auto ">
      <!-- Main Title -->
      <h2 class="text-center text-3xl md:text-5xl font-extrabold text-gray-900 md:mb-10 mb-6 leading-tight">
        Learn to Code from our <span class="text-[#ed8610]">Instructors</span>
      </h2>

      <div class="">
  <div class="grid md:grid-cols-2 gap-8 ">
    <!-- Instructor Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-8">
      <!-- Dynamic Instructor Card (Use loop in your framework) -->
      <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 text-center">
  <div class="relative">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
    <img 
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/96df78dd43bad50cda5cee9f5ca4b17599ffda292d20d8ca0346b8b84e3da674" 
      alt="Instructor" 
      class="relative mx-auto rounded-full w-24 md:w-32 border-4 border-white shadow-lg"
    >
  </div>
  <h4 class="mt-5 text-xl md:text-2xl font-bold text-gray-900 mx-auto">Joo Muri</h4>
  <div class="mt-3 flex justify-center items-center bg-blue-50 px-4 py-2 rounded-full mx-auto w-fit">
    <img 
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/02d1f6ec7bc2f9edf0e80994b3ac27cc85554083b07b37408f4abd328b683522" 
      class="w-5 h-5 mr-2" 
      alt="Hours"
    >
    <span class="text-sm font-medium text-blue-600">1600+ hours</span>
  </div>
  <p class="mt-4 text-gray-600 font-medium mx-auto">Web Development</p>
  <div class="mt-4 flex justify-center space-x-3 opacity-80 group-hover:opacity-100 transition-opacity">
    <a href="#" class="text-blue-500 hover:text-blue-600">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
    </a>
    <a href="#" class="text-purple-500 hover:text-purple-600">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.3.931-2.692 3.029-2.692h1.971v3z"/></svg>
    </a>
  </div>
</div>
<div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 text-center">
  <div class="relative">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
    <img 
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/96df78dd43bad50cda5cee9f5ca4b17599ffda292d20d8ca0346b8b84e3da674" 
      alt="Instructor" 
      class="relative mx-auto rounded-full w-24 md:w-32 border-4 border-white shadow-lg"
    >
  </div>
  <h4 class="mt-5 text-xl md:text-2xl font-bold text-gray-900 mx-auto">Joo Muri</h4>
  <div class="mt-3 flex justify-center items-center bg-blue-50 px-4 py-2 rounded-full mx-auto w-fit">
    <img 
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/02d1f6ec7bc2f9edf0e80994b3ac27cc85554083b07b37408f4abd328b683522" 
      class="w-5 h-5 mr-2" 
      alt="Hours"
    >
    <span class="text-sm font-medium text-blue-600">1600+ hours</span>
  </div>
  <p class="mt-4 text-gray-600 font-medium mx-auto">Web Development</p>
  <div class="mt-4 flex justify-center space-x-3 opacity-80 group-hover:opacity-100 transition-opacity">
    <a href="#" class="text-blue-500 hover:text-blue-600">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
    </a>
    <a href="#" class="text-purple-500 hover:text-purple-600">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.3.931-2.692 3.029-2.692h1.971v3z"/></svg>
    </a>
  </div>
</div>
<div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 text-center">
  <div class="relative">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
    <img 
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/96df78dd43bad50cda5cee9f5ca4b17599ffda292d20d8ca0346b8b84e3da674" 
      alt="Instructor" 
      class="relative mx-auto rounded-full w-24 md:w-32 border-4 border-white shadow-lg"
    >
  </div>
  <h4 class="mt-5 text-xl md:text-2xl font-bold text-gray-900 mx-auto">Joo Muri</h4>
  <div class="mt-3 flex justify-center items-center bg-blue-50 px-4 py-2 rounded-full mx-auto w-fit">
    <img 
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/02d1f6ec7bc2f9edf0e80994b3ac27cc85554083b07b37408f4abd328b683522" 
      class="w-5 h-5 mr-2" 
      alt="Hours"
    >
    <span class="text-sm font-medium text-blue-600">1600+ hours</span>
  </div>
  <p class="mt-4 text-gray-600 font-medium mx-auto">Web Development</p>
  <div class="mt-4 flex justify-center space-x-3 opacity-80 group-hover:opacity-100 transition-opacity">
    <a href="#" class="text-blue-500 hover:text-blue-600">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
    </a>
    <a href="#" class="text-purple-500 hover:text-purple-600">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.3.931-2.692 3.029-2.692h1.971v3z"/></svg>
    </a>
  </div>
</div>
<div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 text-center">
  <div class="relative">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
    <img 
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/96df78dd43bad50cda5cee9f5ca4b17599ffda292d20d8ca0346b8b84e3da674" 
      alt="Instructor" 
      class="relative mx-auto rounded-full w-24 md:w-32 border-4 border-white shadow-lg"
    >
  </div>
  <h4 class="mt-5 text-xl md:text-2xl font-bold text-gray-900 mx-auto">Joo Muri</h4>
  <div class="mt-3 flex justify-center items-center bg-blue-50 px-4 py-2 rounded-full mx-auto w-fit">
    <img 
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/02d1f6ec7bc2f9edf0e80994b3ac27cc85554083b07b37408f4abd328b683522" 
      class="w-5 h-5 mr-2" 
      alt="Hours"
    >
    <span class="text-sm font-medium text-blue-600">1600+ hours</span>
  </div>
  <p class="mt-4 text-gray-600 font-medium mx-auto">Web Development</p>
  <div class="mt-4 flex justify-center space-x-3 opacity-80 group-hover:opacity-100 transition-opacity">
    <a href="#" class="text-blue-500 hover:text-blue-600">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
    </a>
    <a href="#" class="text-purple-500 hover:text-purple-600">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.3.931-2.692 3.029-2.692h1.971v3z"/></svg>
    </a>
  </div>
</div>
    </div>

    <!-- Quality Section -->
    <div class="md:pl-8 lg:pl-16">
      <h3 class="text-3xl md:text-4xl font-bold text-gray-900 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
        Elite Trainer Standards
      </h3>
      <p class="mt-4 text-lg md:text-xl text-gray-600 leading-relaxed">
        We implement a 5-stage vetting process to ensure only top-tier educators join our team.
      </p>

      <div class="mt-8 space-y-6">
        <div class="flex items-start p-5 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
          <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
            <span class="text-blue-600 font-bold">1%</span>
          </div>
          <div class="ml-4">
            <h4 class="text-lg font-semibold text-gray-900">Rigorous Selection</h4>
            <p class="mt-1 text-gray-600">Only top 1% of applicants make it through</p>
          </div>
        </div>

        <div class="flex items-start p-5 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
          <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
          <div class="ml-4">
            <h4 class="text-lg font-semibold text-gray-900">Proven Experts</h4>
            <p class="mt-1 text-gray-600">Industry leaders from top tech companies</p>
          </div>
        </div>

        <div class="flex items-start p-5 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
          <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
            <span class="text-green-600 font-bold">4.9</span>
          </div>
          <div class="ml-4">
            <h4 class="text-lg font-semibold text-gray-900">Student Approved</h4>
            <p class="mt-1 text-gray-600">Consistently top-rated teaching quality</p>
          </div>
        </div>
      </div>
<div class="text-center">
      <a href="#" class=" mt-8 inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all hover:scale-[1.02]">
        <span>Join Our Team</span>
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
      </a>
      </div>
    </div>
  </div>
</div>
    </div>
  </section>

  <section class="bg-cover bg-center py-3 md:py-6" style="
    background-image: url('https://img.freepik.com/free-vector/realistic-navy-blue-glitter-background_23-2150020453.jpg?uid=R138041806&ga=GA1.1.356124932.1739451029&semt=ais_hybrid');
    
  ">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap">
        <!-- Left Column: Headings + Paragraph -->
        <div class="w-full md:w-1/3 mt-4 text-white">
          <h2 class="text-2xl">Recognized as</h2>
          <h2 class="text-2xl">Best Tech Skilling EdTech</h2>
          <h2 class="text-2xl">Company of the year 2022</h2>
          <p class="mt-3">
            Our trainers go through a unique selection process to ensure there’s no compromise in quality of teaching
            kids are endowed with.
          </p>
        </div>

        <!-- Right Column: Two images -->
        <div class="w-full md:w-2/3">
          <div class="flex flex-wrap">
            <div class="w-1/2 mt-4">
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/65ef900b7499bb80cf778e3951ca7ae47f10b24e30402a24dc0ea921477b9792"
                alt="Award Image" class="w-full h-auto" />
            </div>
            <div class="w-1/2 mb-3">
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/bcc2e01c48312dfb6ae5527985d740713afd42647672912e37e7de5a83104cb3"
                alt="Award Logo" class="w-full h-auto" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  

<section class="bg-amber-50 py-8 px-4 sm:px-6 lg:px-8">
  <div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 items-center">
      <!-- Image Section -->
      <div class="order-1 lg:order-none">
        <img src="./images/testimonals.png" 
             alt="Happy students" 
             class="w-full h-auto rounded-xl shadow-xl border-2">
      </div>

      <!-- Testimonials Carousel -->
      <div class="space-y-4">
        <div class="text-center space-y-4">
          <h2 class="text-3xl lg:text-5xl font-bold bg-gradient-to-r from-orange-500 to-amber-600 bg-clip-text text-transparent">
            Testimonials
          </h2>
          <p class="text-xl lg:text-2xl font-semibold text-gray-800">
            Our Students Are Our Strength.<br>
            See What They Say About Us
          </p>
        </div>

        <!-- Swiper Container -->
        <div class="swiper testimonialSwiper relative">
          <div class="swiper-wrapper">
            <!-- Testimonial Items -->
            <div class="swiper-slide">
              <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100 relative">
                       <p class="text-gray-600 text-lg relative z-10">
                  "The quality of instruction here is unmatched. The trainers' expertise and teaching methods helped me transition into a React developer role seamlessly."
                </p>
                <div class="flex items-center gap-6 mt-8">
                  <img src="./images/Testimonials-1.jpg" 
                       alt="John Doe" 
                       class="w-20 h-20 rounded-full border-4 border-white shadow-lg">
                  <div>
                    <h4 class="text-xl font-bold text-gray-800">John Doe</h4>
                    <p class="text-gray-600">Senior React Developer</p>
                    <div class="flex items-center mt-2">
                      <div class="flex text-amber-400">
                        ★★★★☆
                      </div>
                      <span class="ml-2 text-gray-500">4.8/5</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  <div class="swiper-slide">
              <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100 relative">
                
                <p class="text-gray-600 text-lg relative z-10">
                  "The quality of instruction here is unmatched. The trainers' expertise and teaching methods helped me transition into a React developer role seamlessly."
                </p>
                <div class="flex items-center gap-6 mt-8">
                  <img src="./images/Testimonials-1.jpg" 
                       alt="John Doe" 
                       class="w-20 h-20 rounded-full border-4 border-white shadow-lg">
                  <div>
                    <h4 class="text-xl font-bold text-gray-800">John Doe</h4>
                    <p class="text-gray-600">Senior React Developer</p>
                    <div class="flex items-center mt-2">
                      <div class="flex text-amber-400">
                        ★★★★☆
                      </div>
                      <span class="ml-2 text-gray-500">4.8/5</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100 relative">
            
                <p class="text-gray-600 text-lg relative z-10">
                  "The quality of instruction here is unmatched. The trainers' expertise and teaching methods helped me transition into a React developer role seamlessly."
                </p>
                <div class="flex items-center gap-6 mt-8">
                  <img src="./images/Testimonials-1.jpg" 
                       alt="John Doe" 
                       class="w-20 h-20 rounded-full border-4 border-white shadow-lg">
                  <div>
                    <h4 class="text-xl font-bold text-gray-800">John Doe</h4>
                    <p class="text-gray-600">Senior React Developer</p>
                    <div class="flex items-center mt-2">
                      <div class="flex text-amber-400">

                      </div>
                      <span class="ml-2 text-gray-500">4.8/5</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Custom Navigation -->
          <div class="flex items-center justify-center gap-4 mt-8">
            <div class="swiper-button-prev carousel-prev "></div>
            <div class="swiper-pagination !relative !w-auto"></div>
            <div class="swiper-button-next carousel-next "></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  // Initialize Swiper after DOM load
  document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.testimonialSwiper', {
      loop: true,
      grabCursor: true,
      spaceBetween: 30,
      autoplay: {
        delay: 8000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
        renderBullet: (index, className) => {
          return `<span class="${className} w-2 h-2 rounded-full bg-gray-300 mx-1"></span>`;
        },
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        640: { slidesPerView: 1 },
        1024: { slidesPerView: 1, spaceBetween: 40 }
      }
    });
  });
</script>

<style>
  /* Custom Swiper Styles */
  .swiper-button-prev::after,
  .swiper-button-next::after {
    content: '';
    display: none;
  }

  .swiper-button-prev,
  .swiper-button-next {
    @apply !static !mt-0 !-translate-y-0 flex items-center justify-center;
    background-image: none !important;
  }

  .swiper-button-prev svg,
  .swiper-button-next svg {
    @apply w-5 h-5;
  }

  .swiper-pagination-bullet-active {
    @apply bg-gradient-to-r from-orange-500 to-amber-600 !scale-125;
  }

  .swiper-slide {
    @apply opacity-50 scale-95 transition-transform duration-300;
  }

  .swiper-slide-active {
    @apply opacity-100 scale-100;
  }
</style>

<!-- Add custom arrow icons -->
<svg style="display: none;">
  <symbol id="left-arrow" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
  </symbol>
  <symbol id="right-arrow" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
  </symbol>
</svg>

<script>
  // Add custom arrow icons
  document.querySelectorAll('.swiper-button-prev').forEach(btn => {
    btn.innerHTML = `<svg class="w-5 h-2 text-white bg-[#2c0b57] rounded-full"><use href="#left-arrow"></use></svg>`;
  });
  document.querySelectorAll('.swiper-button-next').forEach(btn => {
    btn.innerHTML = `<svg class="w-5 h-2 text-white bg-[#2c0b57] rounded-full"><use href="#right-arrow"></use></svg>`;
  });
</script>

  <div
    class="container mx-auto lg:my-10 p-8 bg-gradient-to-r from-purple-600 via-indigo-500 to-blue-500 text-white rounded-3xl shadow-2xl overflow-hidden">
    <div class="flex flex-wrap items-center justify-between">

      <!-- Left Section: Offer & Timer -->
      <div class="w-full md:w-6/12 space-y-6">
        <h1 class="text-3xl lg:text-5xl font-extrabold leading-tight">🚀 Free Access to 200+ Premium Courses!</h1>
        <p class="text-lg font-medium">Hurry up! This exclusive offer expires soon! ⏳</p>

        <!-- Timer Section -->
        <div class="flex gap-1">
          <div class="text-center">
            <div
              class="w-20 h-20 bg-white/20 backdrop-blur-lg text-white flex flex-col items-center justify-center rounded-xl shadow-lg">
              <span id="days" class="text-3xl font-extrabold">00</span>
              <small class="text-sm uppercase">Days</small>
            </div>
          </div>
          <div class="text-center">
            <div
              class="w-20 h-20 bg-white/20 backdrop-blur-lg text-white flex flex-col items-center justify-center rounded-xl shadow-lg">
              <span id="hours" class="text-3xl font-extrabold">00</span>
              <small class="text-sm uppercase">Hours</small>
            </div>
          </div>
          <div class="text-center">
            <div
              class="w-20 h-20 bg-white/20 backdrop-blur-lg text-white flex flex-col items-center justify-center rounded-xl shadow-lg">
              <span id="minutes" class="text-3xl font-extrabold">00</span>
              <small class="text-sm uppercase">Minutes</small>
            </div>
          </div>
          <div class="text-center">
            <div
              class="w-20 h-20 bg-white/20 backdrop-blur-lg text-white flex flex-col items-center justify-center rounded-xl shadow-lg">
              <span id="seconds" class="text-3xl font-extrabold">00</span>
              <small class="text-sm uppercase">Seconds</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Section: Registration Form -->
      <div class="w-full md:w-5/12 mt-8 md:mt-0">
        <div class="bg-white text-gray-900 p-8 rounded-2xl shadow-xl">
          <h3 class="text-2xl font-bold mb-5 text-center">✨ Sign Up for Free</h3>
          <form>
            <div class="mb-4">
              <label class="block text-sm font-medium">Full Name</label>
              <input type="text"
                class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition"
                required />
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium">Email Address</label>
              <input type="email"
                class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition"
                required />
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium">Phone Number</label>
              <input type="tel"
                class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-500 transition"
                required />
            </div>
            <button type="submit"
              class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-purple-600 text-white font-semibold py-3 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
              ✅ Register Now
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <section class="relative bg-cover bg-center text-center text-gray-900 py-8 lg:py-12"
    style="background-image: url('https://via.placeholder.com/1200x600'); background-color: rgb(252, 247, 241);">
    <div class="container mx-auto px-4">
      <div class="flex justify-center">
        <!-- Centered Content -->
        <div
          class="w-full md:w-10/12 lg:w-7/12 p-4 bg-[rgba(246,237,233,0.6)] rounded-[20px] p-6 md:p-[50px] relative z-10">
          <h2 class="text-3xl md:text-4xl font-bold font-gill-sans">
            Special <span class="text-[#ed8610]">Offers</span>
          </h2>
          <p class="text-gray-600 mt-4 text-sm md:text-base">
            It is a long-established fact that a reader will be distracted by
            the readable content of a page when looking at its layout. The
            point of using Lorem Ipsum is that it has a more-or-less normal
            distribution of letters, as opposed to using 'Content here,
            content here', making it look like readable English. Many desktop
            publishing packages and web page editors now use Lorem Ipsum as
            their default model text.
          </p>
        
          <a href="#join"
            class="inline-block mt-6 px-6 py-2 md:px-8 md:py-3 bg-[#f8ad56] text-white text-base md:text-lg rounded-full hover:bg-[#e67e22] transition duration-300">
            Join Now
          </a>
         
        </div>
      </div>
    </div>

    <!-- Left 3D Character -->
    <img src="./images/special offer.png" alt="3D Character Left"
      class="hidden md:block absolute left-[1%] bottom-0 w-[300px] lg:w-[400px] z-1 hover:scale-105 transition-transform duration-300">

    <!-- Right 3D Character -->
    <img src="./images/special_offers3.png" alt="3D Character Right"
      class="hidden md:block absolute right-[1%] bottom-0 w-[300px] lg:w-[400px] z-1 rounded-lg hover:scale-105 transition-transform duration-300">
  </section>

  <section class="py-6 lg:py-10 px-6">
    <h1 class="text-3xl lg:text-5xl font-[700] md:mb-8">Wait! I Have Some <span class="text-[#ed8610]">Questions</span></h1>
    <div class="w-full space-y-4 mt-4">
      <div class="flex w-full flex-col gap-4 ">
        <div x-data="{ isExpanded: false }"
          class="divide-y divide-slate-300 overflow-hidden rounded-lg border border-slate-300 bg-white ">
          <button id="controlsAccordionItemOne" type="button"
            class="flex w-full items-center justify-between gap-2 bg-white text-base p-3 lg:p-5 lg:text-[18px] text-left underline-offset-2 font-[600]"
            aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded"
            :class="isExpanded ? 'text-[#024c84] font-[600]'  : 'font-[600]'"
            :aria-expanded="isExpanded ? 'true' : 'false'" aria-expanded="false">
            What is training?
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
              stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true"
              :class="isExpanded  ?  'rotate-180'  :  ''">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
            </svg>
          </button>
          <div x-show="isExpanded" id="accordionItemOne" role="region" class="p-4"
            aria-labelledby="controlsAccordionItemOne" x-collapse=""
            style="height: 0px; overflow: hidden; display: none;" hidden="">
            <p class="text-[16px] font-[400]">Corporate training, also known as Workplace Learning or Corporate Education, refers to the process of training employees using a systematic set of learning programs designed to nurture employee job skills and knowledge to improve workplace performance.</p>
          </div>
        </div>
        <div x-data="{ isExpanded: false }"
          class="divide-y divide-slate-300 overflow-hidden rounded-lg border border-slate-300 bg-white ">
          <button id="controlsAccordionItemTwo" type="button"
            class="flex w-full items-center justify-between gap-2 bg-white text-base p-3 lg:p-5 lg:text-[18px] text-left underline-offset-2 font-[600]"
            aria-controls="accordionItemTwo" @click="isExpanded = ! isExpanded"
            :class="isExpanded ? 'text-[#024c84] font-[600]'  : 'font-[600]'"
            :aria-expanded="isExpanded ? 'true' : 'false'" aria-expanded="false">
            Why Upskill Students?
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
              stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true"
              :class="isExpanded  ?  'rotate-180'  :  ''">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
            </svg>
          </button>
          <div x-show="isExpanded" id="accordionItemTwo" role="region" class="p-4"
            aria-labelledby="controlsAccordionItemTwo" x-collapse=""
            style="display: none; height: 0px; overflow: hidden;" hidden="">
            <p class="text-[16px] font-[400]">Upskilling helps students gain industry-relevant skills, increasing their job opportunities and career growth in emerging technologies.</p>
          </div>
        </div>
        <div x-data="{ isExpanded: false }"
          class="divide-y divide-slate-300 overflow-hidden rounded-lg border border-slate-300 bg-white ">
          <button id="controlsAccordionItemThree" type="button"
            class="flex w-full items-center justify-between gap-2 bg-white text-base p-3 lg:p-5 lg:text-[18px] text-left underline-offset-2 font-[600]"
            aria-controls="accordionItemThree" @click="isExpanded = ! isExpanded"
            :class="isExpanded ? 'text-[#024c84] font-[600]'  : 'font-[600]'"
            :aria-expanded="isExpanded ? 'true' : 'false'" aria-expanded="false">
            How do I enroll in a course?
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
              stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true"
              :class="isExpanded  ?  'rotate-180'  :  ''">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
            </svg>
          </button>
          <div x-show="isExpanded" id="accordionItemThree" role="region" class="p-4"
            aria-labelledby="controlsAccordionItemThree" x-collapse=""
            style="display: none; height: 0px; overflow: hidden;" hidden="">
            <p class="text-[16px] font-[400]">You can enroll by selecting a course, filling in your details, and completing the payment process. Once registered, you'll receive course access.</p>
          </div>
        </div>
        
      </div>
    </div>
  </section>

 

  <!-- slider 3 start-->

  <script>
    var swiper3 = new Swiper('.swiper-3', {
      slidesPerView: 1,
      spaceBetween: 3,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      speed: 600,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-3-button-next',
        prevEl: '.swiper-3-button-prev',
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 3,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 3,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
      },
    });
  </script>
  <!-- slider 3 end -->

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const tabs = document.querySelectorAll(".nav-tab");
      const tabPanes = document.querySelectorAll(".tab-pane");
      const viewAllButtons = document.querySelectorAll(".view-all-container");

      function activateTab(tab) {
        // Remove active states
        tabs.forEach(t => t.setAttribute("data-active", "false"));
        tabPanes.forEach(pane => pane.classList.add("hidden"));
        viewAllButtons.forEach(btn => btn.classList.add("hidden"));

        // Set active state
        tab.setAttribute("data-active", "true");
        const targetTab = tab.dataset.tab;
        document.getElementById(targetTab).classList.remove("hidden");

        // Show corresponding view all button
        const viewAllId = `viewAll${targetTab.replace("study", "")}`;
        document.getElementById(viewAllId).classList.remove("hidden");
      }

      tabs.forEach(tab => {
        tab.addEventListener("click", function (e) {
          e.preventDefault();
          activateTab(this);
        });
      });

      // Activate first tab by default
      activateTab(tabs[0]);
    });
  </script>



  <!-- tabs syllabus js start -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let tabs = document.querySelectorAll('.tab');
      let contents = document.querySelectorAll('.tab-content');


      function activateTab(tabId) {
        let targetId = tabId.replace('Tab', 'Content');

        contents.forEach(function (content) {
          content.classList.add('hidden');
        });


        tabs.forEach(function (tab) {
          tab.classList.remove('text-white', 'font-bold', 'bg-[#024c84]');
          tab.classList.add('text-[#024c84]', 'font-semibold', 'bg-white');
        });

        document.getElementById(targetId).classList.remove('hidden');


        document.getElementById(tabId).classList.add('text-white', 'font-bold', 'bg-[#024c84]');
        document.getElementById(tabId).classList.remove('text-[#024c84]', 'font-semibold', 'bg-white');
      }


      activateTab('knowledgeTab');

      tabs.forEach(function (tab) {
        tab.addEventListener('click', function (e) {
          activateTab(tab.id);
        });
      });
    });
  </script>
  <!-- tabs syllabus js end -->

@endsection
