<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'C++ Course')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .batch-card {
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }
        .batch-card.active {
            border: 2px solid #f97316 !important;
            background-color: #fff7ed;
        }
        .batch-card.soon {
            background-color: #f3f4f6;
            cursor: not-allowed;
        }
        .batch-card.soon::after {
            content: "Soon";
            position: absolute;
            top: -1px;
            right: -1px;
            background-color: #dc2626;
            color: white;
            font-size: 12px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 0 8px 0 8px;
        }
        .batch-card.active::before {
            content: "✔";
            position: absolute;
            top: -1px;
            left: -1px;
            background: #f97316;
            color: white;
            font-size: 16px;
            padding: 3px 6px;
            border-radius: 4px 0 4px 0;
        }
    </style>
</head>
<body class="bg-gray-100">
    @extends('website.layouts.app')
    @section('title', 'Course Details')
    @section('content')
    <div class="container mx-auto px-5 py-10 max-w-6xl bg-white rounded-lg shadow-md">
        <div class="content flex flex-wrap justify-between items-center gap-5">
            <div class="left-section flex-1 min-w-[300px] text-center md:text-left order-2 md:order-1">
                <p class="audience text-blue-500 text-sm font-bold uppercase mb-2">
                    FOR BEGINNER AND EXPERIENCED LEARNERS
                </p>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight mb-5">
                    {{ $course->name ?? 'Basics of C++ with Data Structures and Algorithms [updated in 2023]' }}
                </h1>
                <p class="description text-base md:text-lg text-gray-600 leading-relaxed mb-5">
                    {{ $course->description ?? 'This is the course to pick if you are just getting into coding and want to build a strong foundation. Widely used in competitive programming.' }}
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-5 mb-5">
                    <button class="bg-orange-500 text-white font-bold py-3 px-6 rounded-md flex items-center gap-2 hover:bg-orange-600 transition-colors">
                        Enroll now <span>→</span>
                    </button>
                    <div class="flex items-center gap-1">
                        <span class="text-orange-500 text-lg font-bold">4.8</span>
                        <div class="flex">
                            <span class="text-orange-500 text-lg">★</span>
                            <span class="text-orange-500 text-lg">★</span>
                            <span class="text-orange-500 text-lg">★</span>
                            <span class="text-orange-500 text-lg">★</span>
                            <span class="text-orange-500 text-lg">★</span>
                        </div>
                        <span class="text-gray-600 text-sm">(17K+ student)</span>
                    </div>
                </div>
                <div class="stats flex flex-col md:flex-row gap-5 mt-5 bg-blue-100 p-5 rounded-lg justify-between max-w-lg mx-auto md:mx-0">
                    <div class="stat text-center">
                        <span class="rating text-orange-500 text-2xl font-bold">
                            4.8 <span class="star text-xl">★</span>
                        </span>
                        <p class="text-sm text-gray-600 mt-1">30K+ Learners enrolled</p>
                    </div>
                    <div class="stat text-center">
                        <span class="text-2xl font-bold text-gray-800">60+</span>
                        <p class="text-sm text-gray-600 mt-1">Hours of lectures</p>
                    </div>
                    <div class="stat text-center">
                        <span class="text-2xl font-bold text-gray-800">350+</span>
                        <p class="text-sm text-gray-600 mt-1">Problems</p>
                    </div>
                </div>
            </div>
            <div class="right-section flex-1 min-w-[300px] text-center order-1 md:order-2">
                <img src="{{ asset('images/coursehead.png') }}" alt="Person studying with laptop and books" class="max-w-full h-auto">
            </div>
        </div>
    </div>

   

    <!-- Navigation Tabs -->
    <div class="tabs flex flex-col sm:flex-row justify-center items-center mx-auto w-11/12 sm:w-auto sm:max-w-6xl gap-2 sm:gap-4 md:gap-8 mt-5 sm:mt-10 bg-white p-2 sm:p-3 rounded-lg sm:rounded-full shadow-md">
        <a href="#about" class="w-full sm:w-auto text-center text-orange-500 font-bold text-sm sm:text-base md:text-lg px-3 sm:px-4 py-1 sm:py-2 hover:text-orange-500 transition-colors">About the course</a>
        <a href="#batches" class="w-full sm:w-auto text-center text-gray-600 text-sm sm:text-base md:text-lg px-3 sm:px-4 py-1 sm:py-2 hover:text-orange-500 transition-colors">Batches</a>
        <a href="#curriculum" class="w-full sm:w-auto text-center text-gray-600 text-sm sm:text-base md:text-lg px-3 sm:px-4 py-1 sm:py-2 hover:text-orange-500 transition-colors">Curriculum</a>
        <a href="#instructors" class="w-full sm:w-auto text-center text-gray-600 text-sm sm:text-base md:text-lg px-3 sm:px-4 py-1 sm:py-2 hover:text-orange-500 transition-colors">Instructors</a>
        <a href="#faqs" class="w-full sm:w-auto text-center text-gray-600 text-sm sm:text-base md:text-lg px-3 sm:px-4 py-1 sm:py-2 hover:text-orange-500 transition-colors">FAQs</a>
    </div>

    <!-- Course Batches Section -->
    <div class="container mx-auto px-5 py-10 max-w-6xl" id="batches">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-5">
            Course <span class="text-orange-500">Batches</span>
        </h2>
        <div class="bg-white p-5 rounded-lg shadow-md">
            <!-- Online Classroom Header -->
            <div class="flex items-center gap-3 mb-5">
                <h3 class="text-xl font-semibold text-gray-800">Online Classroom</h3>
                <span class="bg-purple-600 text-white text-xs font-bold px-2 py-1 rounded">PREFERRED</span>
            </div>
            <!-- Features List -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
                <div class="flex items-center gap-2">
                    <span class="text-green-500">✔</span>
                    <p class="text-sm text-gray-600">Everything in self-paced Learning</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-green-500">✔</span>
                    <p class="text-sm text-gray-600">130 Hrs of instructor-led training</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-green-500">✔</span>
                    <p class="text-sm text-gray-600">One-to-one doubt resolution sessions</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-green-500">✔</span>
                    <p class="text-sm text-gray-600">Attend as many batches as you want for a lifetime</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-green-500">✔</span>
                    <p class="text-sm text-gray-600"><span id="available-slots">90</span> Slots available</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-green-500">✔</span>
                    <p class="text-sm text-gray-600"><span id="filled-slots">80</span> Slots Filled</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-green-500">✔</span>
                    <p class="text-sm text-gray-600"><span id="mode-of-teaching">Online</span> Mode of teaching</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-green-500">✔</span>
                    <p class="text-sm text-gray-600">Job assistance</p>
                </div>
            </div>
            <!-- Batch Cards and Pricing -->
            <div class="flex flex-col lg:flex-row items-center gap-5">
                <!-- Batch Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 flex-1" id="batch-cards">
                    <!-- Batches will be dynamically inserted here -->
                </div>
                <!-- Pricing and Enroll Button -->
                <div class="text-center lg:text-right">
                    <p class="text-2xl font-bold text-gray-800" id="batch-price">₹40,014</p>
                    <p class="text-sm text-gray-600" id="batch-discount">
                        10% OFF Expires in <span class="countdown-timer" id="batch-countdown">00d 22h 47m 06s</span>
                    </p>
                    <button class="bg-orange-500 text-white font-bold py-3 px-6 rounded-md mt-3 hover:bg-orange-600 transition-colors" id="batch-enroll-button">
                        Enroll Now
                    </button>
                </div>
            </div>
        </div>
    </div>
     <!-- About Course Overview Section -->
     <div class="container mx-auto px-5 py-10 max-w-6xl bg-gray-50">
      <h2 class="text-3xl font-bold mb-6 text-orange-500">About Course Overview</h2>
      <p class="text-gray-600 mb-6">
          This course is designed to provide learners with hands-on experience in full-stack development. You will gain proficiency in front-end and back-end technologies and build real-world applications.
      </p>

      <h3 class="text-2xl font-bold mb-4 text-gray-900">Learning Outcomes:</h3>
      <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
          <li>Master front-end technologies like HTML, CSS, and JavaScript</li>
          <li>Understand back-end frameworks like Node.js and Django</li>
          <li>Build and deploy full-stack applications</li>
          <li>Earn a certification of completion</li>
      </ul>

      <h3 class="text-2xl font-bold mb-4 text-gray-900">Instructor Info:</h3>
      <p class="text-gray-600 mb-6">
          The course is taught by experienced professionals who have worked in the industry for over 10 years. Our instructors bring real-world knowledge and industry best practices to the course, ensuring students are well-prepared for the job market.
      </p>

      <h3 class="text-2xl font-bold mb-4 text-gray-900">Additional Benefits:</h3>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
          <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-200">
              <div class="text-4xl mb-4 text-gray-400">📄</div>
              <h4 class="text-lg font-semibold text-gray-800 mb-2">Project Icon</h4>
              <p class="text-gray-600">Real-world Projects<br>Work on live projects that enhance your practical skills and prepare you for the industry.</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-200">
              <div class="text-4xl mb-4 text-gray-400">👨‍💼</div>
              <h4 class="text-lg font-semibold text-gray-800 mb-2">Internship Icon</h4>
              <p class="text-gray-600">Free Internship<br>If you choose the internship, you'll get hands-on experience in the field with a free internship placement.</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-200">
              <div class="text-4xl mb-4 text-gray-400">🎙️</div>
              <h4 class="text-lg font-semibold text-gray-800 mb-2">Interview Icon</h4>
              <p class="text-gray-600">Mock Interviews<br>Prepare for the real-world job market with mock interviews conducted by industry experts.</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-200">
              <div class="text-4xl mb-4 text-gray-400">🎓</div>
              <h4 class="text-lg font-semibold text-gray-800 mb-2">Certifica Icon</h4>
              <p class="text-gray-600">ISO Certified & ACITE Approved<br>Get a certificate that is ISO certified and ACITE approved, recognized globally.</p>
          </div>
      </div>
  </div>

    <!-- Key Features Section -->
    <div class="container mx-auto px-5 py-10 max-w-6xl bg-white">
      <h2 class="text-3xl font-bold mb-6 text-gray-900">Key Features</h2>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
          <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-200">
              <div class="text-3xl mb-4 text-gray-400">📅</div>
              <h4 class="text-lg font-semibold text-gray-800 mb-2">Calender Icon</h4>
              <p class="text-gray-600">Self-paced learning</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-200">
              <div class="text-3xl mb-4 text-gray-400">🎓</div>
              <h4 class="text-lg font-semibold text-gray-800 mb-2">Gradue Icon</h4>
              <p class="text-gray-600">Access to recorded lectures</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-200">
              <div class="text-3xl mb-4 text-gray-400">👩‍🏫</div>
              <h4 class="text-lg font-semibold text-gray-800 mb-2">Mentor Icon</h4>
              <p class="text-gray-600">One-to-one mentorship</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-200">
              <div class="text-3xl mb-4 text-gray-400">🏆</div>
              <h4 class="text-lg font-semibold text-gray-800 mb-2">Certific Icon</h4>
              <p class="text-gray-600">Earn a certificate</p>
          </div>
      </div>
  </div>
    <!-- Course Curriculum Section -->
    <div class="container mx-auto px-5 py-10 max-w-6xl" id="curriculum">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-5">
            Course <span class="text-orange-500">Curriculum</span>
        </h2>
        <div class="bg-white p-5 rounded-lg shadow-md grid lg:grid-cols-[1fr,3fr] gap-5">
            <!-- Filter Button -->
            <div>
                <div class="p-6 bg-white shadow-lg flex flex-col gap-3 mb-5">
                    <button class="bg-orange-500 text-white font-bold py-2 px-4 rounded-md" onclick="showDemoCourse()">
                        Demo Course
                    </button>
                    <button class="bg-orange-500 text-white font-bold py-2 px-4 rounded-md" onclick="showSyllabus()">
                        Course Syllabus
                    </button>
                </div>
            </div>
            <!-- Accordion -->
            <div class="p-5 rounded-lg shadow-md bg-white">
                <div class="accordion" id="courseCurriculum">
                    <!-- Dynamic Content Will Be Injected Here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Course Instructor Section -->
    <div class="container mx-auto px-5 py-10 max-w-6xl" id="instructors">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-5">
            Course <span class="text-orange-500">Instructor</span>
        </h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="swiper-slide">
                        <div class="bg-white p-5 rounded-lg shadow-md text-center">
                            <img src="https://via.placeholder.com/150" alt="Instructor" class="w-24 h-24 rounded-full mx-auto mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">Joo Muri</h3>
                            <p class="text-sm text-gray-600 flex items-center justify-center gap-1 mt-1">
                                <i class="fas fa-clock text-orange-500"></i>
                                1600+ hours taught
                            </p>
                            <p class="text-sm text-gray-600 mt-1">Courses | teach</p>
                            <p class="text-sm text-gray-600">Web Development</p>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="swiper-pagination mt-5"></div>
        </div>
    </div>

    <!-- FAQs Section -->
    <div class="container mx-auto px-5 py-10 max-w-6xl" id="faqs">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-5">
            Wait! I Have Some <span class="text-orange-500">Questions</span>
        </h2>
        <div x-data="{ openAccordion: null }" class="space-y-2">
            <div class="border border-blue-500 rounded-lg">
                <button @click="openAccordion = openAccordion === 1 ? null : 1" class="w-full flex justify-between items-center p-4 text-left text-gray-800 font-semibold">
                    <span>What is training?</span>
                    <i :class="openAccordion === 1 ? 'fa-minus' : 'fa-plus'" class="fas text-blue-500"></i>
                </button>
                <div x-show="openAccordion === 1" x-transition class="p-4 bg-white">
                    <p class="text-gray-600">
                        Corporate training, also known as Workplace Learning or Corporate Education, refers to the process of training employees using a systematic set of learning programs designed to nurture employee job skills and knowledge to improve performance in the workplace.
                    </p>
                </div>
            </div>
            <div class="border border-red-500 rounded-lg">
                <button @click="openAccordion = openAccordion === 2 ? null : 2" class="w-full flex justify-between items-center p-4 text-left text-gray-800 font-semibold">
                    <span>Why Upskill Student?</span>
                    <i :class="openAccordion === 2 ? 'fa-minus' : 'fa-plus'" class="fas text-red-500"></i>
                </button>
                <div x-show="openAccordion === 2" x-transition class="p-4 bg-white">
                    <p class="text-gray-600">
                        Upskilling helps students gain industry-relevant skills, increasing their job opportunities and career growth in emerging technologies.
                    </p>
                </div>
            </div>
            <div class="border border-red-500 rounded-lg">
                <button @click="openAccordion = openAccordion === 3 ? null : 3" class="w-full flex justify-between items-center p-4 text-left text-gray-800 font-semibold">
                    <span>How do I enroll in a course?</span>
                    <i :class="openAccordion === 3 ? 'fa-minus' : 'fa-plus'" class="fas text-red-500"></i>
                </button>
        </div>
    </div>

    <!-- Facilities Providing Section -->
    <div class="container mx-auto px-5 py-10 max-w-6xl">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-5">
            Facilities <span class="text-orange-500">Providing</span>
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <i class="fas fa-code text-3xl text-blue-500 mb-2"></i>
                <p class="text-sm text-gray-600">Coding exam</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <i class="fas fa-users text-3xl text-blue-500 mb-2"></i>
                <p class="text-sm text-gray-600">Mock interview</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <i class="fas fa-video text-3xl text-blue-500 mb-2"></i>
                <p class="text-sm text-gray-600">Recording classes</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <i class="fas fa-book text-3xl text-blue-500 mb-2"></i>
                <p class="text-sm text-gray-600">Materials</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <i class="fas fa-users-cog text-3xl text-blue-500 mb-2"></i>
                <p class="text-sm text-gray-600">GD rounds</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <i class="fas fa-question-circle text-3xl text-blue-500 mb-2"></i>
                <p class="text-sm text-gray-600">Spot doubts</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <i class="fas fa-chalkboard-teacher text-3xl text-blue-500 mb-2"></i>
                <p class="text-sm text-gray-600">LIVE classes</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <i class="fas fa-briefcase text-3xl text-blue-500 mb-2"></i>
                <p class="text-sm text-gray-600">Career guidance</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <i class="fas fa-hands-helping text-3xl text-blue-500 mb-2"></i>
                <p class="text-sm text-gray-600">Placement assistance</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md text-center">
                <i class="fas fa-graduation-cap text-3xl text-blue-500 mb-2"></i>
                <p class="text-sm text-gray-600">Internship courses</p>
            </div>
        </div>
    </div>

    <!-- Course Certificates Section -->
    <div class="container mx-auto px-5 py-10 max-w-6xl">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-5">
            Course <span class="text-orange-500">Certificates</span>
        </h2>
        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1">
                <p class="text-gray-600 mb-4">
                    Our business analyst Master’s program is led by industry experts who will make you proficient in the field of business analytics. The projects and case studies that are provided as part of this course will help you gain industry-grade experience, which will be a bonus in your resume.
                </p>
                <p class="text-gray-600 mb-4">
                    Our online business analytics master’s course aims to help you clear several certification exams, including the ones mentioned below:
                </p>
                <ul class="space-y-2">
                    <li class="flex items-center gap-2 text-gray-600">
                        <i class="fas fa-check text-green-500"></i>
                        CCBA – Certification of Competency in Business Analysis
                    </li>
                    <li class="flex items-center gap-2 text-gray-600">
                        <i class="fas fa-check text-green-500"></i>
                        Agile Scrum Foundation
                    </li>
                    <li class="flex items-center gap-2 text-gray-600">
                        <i class="fas fa-check text-green-500"></i>
                        Digital Transformation Course for Leaders
                    </li>
                </ul>
            </div>
            <div class="flex-1">
                <img src="https://media.licdn.com/dms/image/v2/D5622AQGoUBZSCAP82g/feedshare-shrink_2048_1536/feedshare-shrink_2048_1536/0/1731245943907?e=2147483647&v=beta&t=55eBVsL3PaAH74TFdAM3qEz8RBRcwxX_ZHYYpst400I" alt="Certificate" class="w-full rounded-lg shadow-md">
            </div>
        </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Initialize Swiper
        var swiper = new Swiper('.mySwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                768: { slidesPerView: 3, spaceBetween: 20 },
                1024: { slidesPerView: 4, spaceBetween: 20 },
            },
        });

        // Batch Section JavaScript
        let batches = [];
        const courseId = "{{ $course->id ?? '' }}";

        // Function to fetch batches dynamically
        async function fetchBatches() {
            try {
                const response = await fetch(`/api/batches?id=${courseId}`);
                batches = await response.json();
                if (response.ok) {
                    renderBatchCards(batches);
                } else {
                    console.error('Error fetching batches:', batches.error);
                }
            } catch (error) {
                console.error('Error fetching batches:', error);
            }
        }

        // Function to render batch cards dynamically
        function renderBatchCards(batches) {
            const batchCardsContainer = document.getElementById("batch-cards");
            batchCardsContainer.innerHTML = "";
            batches.forEach((batch) => {
                const batchCard = document.createElement("div");
                batchCard.classList.add("border", "rounded-lg", "p-4", "text-center", "relative", "max-w-xs", "batch-card");
                if (batch.status === "started") {
                    batchCard.classList.add("active", "border-orange-500");
                } else if (batch.status === "soon") {
                    batchCard.classList.add("soon", "border-gray-300");
                } else {
                    batchCard.classList.add("border-gray-300");
                }
                batchCard.setAttribute("onclick", `selectBatch('${batch.date}')`);
                const cardContent = `
                    <div class="batch-date text-sm text-gray-600 font-semibold">${batch.date}</div>
                    <div class="batch-details">
                        <p class="text-sm text-gray-600 mt-1">${
                            batch.status === "started" ? "Batch Started" : batch.status === "soon" ? "Soon" : "Upcoming"
                        }</p>
                        <p class="text-sm text-gray-600">SAT - SUN</p>
                        <p class="text-sm text-gray-600">Weekend Class | 6 Months</p>
                        <p class="text-sm text-gray-600 mt-2">08:00 PM TO 11:00 PM IST (GMT +5:30)</p>
                    </div>
                `;
                batchCard.innerHTML = cardContent;
                batchCardsContainer.appendChild(batchCard);
                if (batch.status === "upcoming" && new Date() < new Date(batch.startDate)) {
                    updateBatchDetails(batch);
                }
            });
        }

        // Function to update batch details
        function updateBatchDetails(batch) {
            document.getElementById("batch-price").innerText = `₹${batch.price.toLocaleString('en-IN')}`;
            document.getElementById("batch-discount").innerHTML = `10% OFF Expires in <span class="countdown-timer" id="batch-countdown">${calculateCountdown(batch.startDate)}</span>`;
            const enrollStartDate = new Date(batch.startDate);
            enrollStartDate.setDate(enrollStartDate.getDate() - 25);
            const now = new Date();
            const enrollButton = document.getElementById("batch-enroll-button");
            if (now >= enrollStartDate) {
                enrollButton.disabled = false;
                enrollButton.innerText = batch.status === "started" ? "Request to Join" : "Enroll Now";
            } else {
                enrollButton.disabled = true;
                enrollButton.innerText = `Registration starts on ${enrollStartDate.toLocaleDateString()}`;
            }
            document.getElementById("available-slots").innerText = batch.slotsAvailable;
            document.getElementById("filled-slots").innerText = batch.slotsFilled;
            document.getElementById("mode-of-teaching").innerText = batch.mode;
            window.selectedBatch = batch;
        }

        // Function to select batch
        function selectBatch(batchDate) {
            const selectedBatch = batches.find((batch) => batch.date === batchDate);
            if (selectedBatch) {
                updateBatchDetails(selectedBatch);
                document.querySelectorAll(".batch-card").forEach((card) => {
                    card.classList.remove("active");
                    if (card.querySelector(".batch-date").innerText === batchDate) {
                        card.classList.add("active");
                        card.classList.add("border-orange-500");
                        card.classList.remove("border-gray-300");
                    } else {
                        card.classList.add("border-gray-300");
                        card.classList.remove("border-orange-500");
                    }
                });
            }
        }

        // Function to calculate countdown
        function calculateCountdown(startDate) {
            const now = new Date();
            const timeDiff = new Date(startDate) - now;
            const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
            return `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }

        // Handle Enroll Now button click
        document.getElementById("batch-enroll-button").addEventListener("click", function () {
            if (window.selectedBatch) {
                const batch = window.selectedBatch;
                const params = new URLSearchParams({
                    batch_id: batch.id,
                    date: batch.date,
                    price: batch.price,
                    slotsAvailable: batch.slotsAvailable,
                    slotsFilled: batch.slotsFilled,
                    mode: batch.mode,
                    status: batch.status,
                    startDate: batch.startDate,
                });
                window.location.href = `/register?${params.toString()}`;
            }
        });

        // Update countdown timer every second
        setInterval(() => {
            if (window.selectedBatch) {
                document.getElementById("batch-countdown").innerText = calculateCountdown(window.selectedBatch.startDate);
            }
        }, 1000);

        // Fetch batches on page load
        document.addEventListener("DOMContentLoaded", fetchBatches);

        // Demo Course and Syllabus JavaScript (from old code)
        const demoCourseData = [
            {
                id: 1,
                title: "Course",
                lessons: [
                    { title: "Introduction to Python Full Stack", videoLinks: ["https://www.youtube.com/watch?v=UB1O30fR-EE"] },
                    { title: "Python Class - 1", videoLinks: ["https://www.youtube.com/watch?v=yfoY53QXEnI"] },
                ],
            },
            {
                id: 2,
                title: "HTML & CSS Basics",
                lessons: [
                    { title: "Introduction to HTML", videoLinks: ["https://www.youtube.com/watch?v=W6NZfCO5SIk"] },
                ],
            },
            {
                id: 3,
                title: "JavaScript & Frontend Frameworks",
                lessons: [
                    { title: "JavaScript Essentials", videoLinks: ["https://www.youtube.com/watch?v=W6NZfCO5SIk"] },
                ],
            },
        ];

        const syllabusData = [
            {
                id: 1,
                title: "Frontend Development",
                topics: [
                    { name: "HTML", details: ["Introduction to HTML", "HTML Tags & Elements", "Forms & Input Fields"] },
                    { name: "CSS", details: ["CSS Basics (Selectors, Properties)", "Flexbox & Grid Layouts"] },
                    { name: "JavaScript", details: ["JavaScript Basics (Variables, Data Types)", "DOM Manipulation"] },
                ],
            },
            {
                id: 2,
                title: "Backend Development",
                topics: [
                    { name: "Node.js", details: ["Introduction to Node.js", "Building Web Servers"] },
                    { name: "Express.js", details: ["Introduction to Express.js", "Routing & Middleware"] },
                ],
            },
        ];

        function showDemoCourse() {
            const curriculumContainer = document.getElementById("courseCurriculum");
            curriculumContainer.innerHTML = "";
            document.querySelectorAll(".module-box button").forEach((btn) => btn.classList.remove("bg-orange-600"));
            document.querySelector(".module-box button:nth-child(1)").classList.add("bg-orange-600");
            demoCourseData.forEach((course, index) => {
                let lessonContent = course.lessons.map(lesson => `
                    <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-md">
                        <strong class="text-gray-700">${lesson.title}</strong>
                        <div>
                            ${lesson.videoLinks.map(link => `<a href="${link}" target="_blank" class="bg-orange-500 text-white px-3 py-1 rounded-md hover:bg-orange-600">Watch Video</a>`).join("")}
                        </div>
                    </div>
                `).join("");
                curriculumContainer.innerHTML += `
                    <div class="border border-gray-200 rounded-lg mb-2">
                        <button class="w-full flex justify-between items-center p-4 text-left text-gray-800 font-semibold" data-bs-toggle="collapse" data-bs-target="#collapseDemo${index}">
                            📚 ${course.id} ${course.title}
                            <i class="fas fa-chevron-down text-gray-600"></i>
                        </button>
                        <div id="collapseDemo${index}" class="collapse" data-bs-parent="#courseCurriculum">
                            <div class="p-4 bg-white">${lessonContent}</div>
                        </div>
                    </div>
                `;
            });
        }

        function showSyllabus() {
            const curriculumContainer = document.getElementById("courseCurriculum");
            curriculumContainer.innerHTML = "";
            document.querySelectorAll(".module-box button").forEach((btn) => btn.classList.remove("bg-orange-600"));
            document.querySelector(".module-box button:nth-child(2)").classList.add("bg-orange-600");
            syllabusData.forEach((module, index) => {
                let subtopics = module.topics.map((topic, subIndex) => `
                    <div class="card mt-2">
                        <div class="border-b border-gray-200">
                            <button class="w-full text-left p-3 text-gray-800 font-semibold" data-bs-toggle="collapse" data-bs-target="#topicDetails${index}-${subIndex}">
                                <strong>${topic.name}</strong>
                            </button>
                        </div>
                        <div id="topicDetails${index}-${subIndex}" class="collapse">
                            <div class="p-3">
                                <ul class="list-disc pl-5">${topic.details.map(detail => `<li class="text-gray-600">${detail}</li>`).join("")}</ul>
                            </div>
                        </div>
                    </div>
                `).join("");
                curriculumContainer.innerHTML += `
                    <div class="border border-gray-200 rounded-lg mb-2">
                        <button class="w-full flex justify-between items-center p-4 text-left text-gray-800 font-semibold" data-bs-toggle="collapse" data-bs-target="#collapseSyllabus${index}">
                            ${module.title}
                            <i class="fas fa-chevron-down text-gray-600"></i>
                        </button>
                        <div id="collapseSyllabus${index}" class="collapse">
                            <div class="p-4 bg-white">${subtopics}</div>
                        </div>
                    </div>
                `;
            });
        }

        // Load Demo Course by Default
        document.addEventListener("DOMContentLoaded", showDemoCourse);
    </script>
    <!-- Bootstrap JS for Collapse -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
</body>
</html>