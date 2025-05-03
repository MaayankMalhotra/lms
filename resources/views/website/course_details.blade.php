@extends('website.layouts.app')

@section('title', $course_details ? $course_details->course_name : 'Course Details')

@section('content')
<style>
    /* Custom rotate animation for the chevron */
    .rotate-180 {
        transform: rotate(180deg);
    }
    /* Highlight selected batch card */
    .batch-card.selected {
        border: 2px solid #f97316;
        background-color: #fff7ed;
    }
</style>

<div class="mt-10 container mx-auto px-5 py-10 max-w-7xl bg-white rounded-lg shadow-md">
    <div class="content flex flex-wrap justify-between items-center gap-5">
        <div class="left-section flex-1 min-w-[300px] text-center md:text-left order-2 md:order-1">
            @if($course_details)
                <p class="audience text-blue-500 text-sm font-bold uppercase mb-2">
                    FOR BEGINNER AND EXPERIENCED LEARNERS
                </p>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight mb-5">
                    {{ $course_details->course_name }}
                </h1>
                <p class="description text-base md:text-lg text-gray-600 leading-relaxed mb-5">
                    {{ $course_details->course_description }}
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-5 mb-5">
                    <button class="bg-orange-500 text-white font-bold py-3 px-6 rounded-md flex items-center gap-2 hover:bg-orange-600 transition-colors">
                        Enroll now <span>→</span>
                    </button>
                    <div class="flex items-center gap-1">
                        <span class="text-orange-500 text-lg font-bold">{{ $course_details->course_rating }}</span>
                        <div class="flex">
                            <span class="text-orange-500 text-lg">★</span>
                            <span class="text-orange-500 text-lg">★</span>
                            <span class="text-orange-500 text-lg">★</span>
                            <span class="text-orange-500 text-lg">★</span>
                            <span class="text-orange-500 text-lg">★</span>
                        </div>
                        <span class="text-gray-600 text-sm">({{ $course_details->course_rating_student_number }}K+ student)</span>
                    </div>
                </div>
                <div class="stats flex flex-col md:flex-row gap-5 mt-5 bg-blue-100 p-5 rounded-lg justify-between max-w-lg mx-auto md:mx-0">
                    <div class="stat text-center">
                        <span class="rating text-orange-500 text-2xl font-bold">
                            4.8 <span class="star text-xl">★</span>
                        </span>
                        <p class="text-sm text-gray-600 mt-1">{{ $course_details->course_learner_enrolled }}K+ Learners enrolled</p>
                    </div>
                    <div class="stat text-center">
                        <span class="text-2xl font-bold text-gray-800">{{ $course_details->course_lecture_hours }}+</span>
                        <p class="text-sm text-gray-600 mt-1">Hours of lectures</p>
                    </div>
                    <div class="stat text-center">
                        <span class="text-2xl font-bold text-gray-800">{{ $course_details->course_problem_counts }}+</span>
                        <p class="text-sm text-gray-600 mt-1">Problems</p>
                    </div>
                </div>
            @else
                <p class="text-red-500 text-lg">Course details not found!</p>
            @endif
        </div>
        <div class="right-section flex-1 min-w-[300px] text-center order-1 md:order-2">
            @if($course_details && $course_details->course_banner)
                <img src="{{ asset('storage/' . $course_details->course_banner) }}" alt="Person studying with laptop and books" class="max-w-full h-auto">
            @else
                <p class="text-gray-600">No course banner available.</p>
            @endif
        </div>
    </div>
</div>

<!-- Navigation Tabs -->
<div class="tabs flex flex-col sm:flex-row justify-center items-center mx-auto w-11/12 sm:w-auto sm:max-w-7xl gap-2 sm:gap-4 md:gap-8 mt-5 sm:mt-10 bg-white p-2 sm:p-3 rounded-lg sm:rounded-full shadow-md">
    <a href="#about" class="w-full sm:w-auto text-center text-orange-500 font-bold text-sm sm:text-base md:text-lg px-3 sm:px-4 py-1 sm:py-2 hover:text-orange-500 transition-colors">About the course</a>
    <a href="#batches" class="w-full sm:w-auto text-center text-gray-600 text-sm sm:text-base md:text-lg px-3 sm:px-4 py-1 sm:py-2 hover:text-orange-500 transition-colors">Batches</a>
    <a href="#curriculum" class="w-full sm:w-auto text-center text-gray-600 text-sm sm:text-base md:text-lg px-3 sm:px-4 py-1 sm:py-2 hover:text-orange-500 transition-colors">Curriculum</a>
    <a href="#instructors" class="w-full sm:w-auto text-center text-gray-600 text-sm sm:text-base md:text-lg px-3 sm:px-4 py-1 sm:py-2 hover:text-orange-500 transition-colors">Instructors</a>
    <a href="#faqs" class="w-full sm:w-auto text-center text-gray-600 text-sm sm:text-base md:text-lg px-3 sm:px-4 py-1 sm:py-2 hover:text-orange-500 transition-colors">FAQs</a>
</div>

<!-- Course Batches Section -->
<div class="container mx-auto px-5 py-10 max-w-7xl" id="batches">
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
        <div class="flex flex-col items-right gap-5">
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
                <button class="bg-orange-500 text-white font-bold py-3 px-6 rounded-md mt-3 hover:bg-orange-600 transition-colors" id="batch-enroll-button" disabled>
                    Enroll Now
                </button>
            </div>
        </div>
    </div>
</div>

<!-- About Course Overview Section -->
<div class="container mx-auto px-5 py-10 max-w-7xl bg-gray-50">
    <h2 class="text-3xl font-bold mb-6 text-orange-500">About Course Overview</h2>
    @if($course_details)
        <p class="text-gray-600 mb-6">
            {{ $course_details->course_overview_description }}
        </p>

        <h3 class="text-2xl font-bold mb-4 text-gray-900">Learning Outcomes:</h3>
        <ul class="list-disc pl-6 mb-6 text-gray-700 space-y-2">
            @foreach($course_details->learning_outcomes as $outcome)
                <li>{{ $outcome }}</li>
            @endforeach
        </ul>

        <h3 class="text-2xl font-bold mb-4 text-gray-900">Instructor Info:</h3>
        <p class="text-gray-600 mb-6">
            {{ $course_details->instructor_info }}
        </p>
    @else
        <p class="text-gray-600 mb-6">No course overview available.</p>
    @endif

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
<div class="container mx-auto px-5 py-10 max-w-7xl bg-white">
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
<div class="container mx-auto px-4 py-12 max-w-7xl" id="curriculum">
    <!-- Course Curriculum Container -->
    <div class="course-container bg-white rounded-xl shadow-lg p-8">
        <!-- Header: Course Description and Download Button -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6">
            <div class="max-w-2xl">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">Course Curriculum</h2>
                <p class="text-gray-600 text-base leading-relaxed">
                    This online master’s course is designed to empower working professionals. Explore a multi-domain curriculum that encourages learners to carve their own paths to success.
                </p>
            </div>
            <a href="#" class="bg-teal-700 text-white text-sm font-semibold px-6 py-3 rounded-lg hover:bg-teal-800 transition duration-300 shadow-sm">
                Download Curriculum
            </a>
        </div>

        <!-- Course Modules Section -->
        <div class="text-xl font-semibold text-gray-800 mb-6 border-b-2 border-teal-100 pb-3">
            Course Modules
        </div>

        @if($course_details && !empty($course_details->course_curriculum))
            @forelse($course_details->course_curriculum as $index => $module)
                <div class="accordion-item mb-4" x-data="{ open: false }">
                    <!-- Accordion Title -->
                    <div class="accordion-title flex justify-between items-center p-5 bg-gray-50 rounded-lg cursor-pointer hover:bg-gray-100 transition duration-200" role="button" aria-expanded="false" @click="open = !open">
                        <div class="flex items-center space-x-4">
                            <span class="bg-teal-100 text-teal-800 text-sm font-medium px-4 py-1.5 rounded-sm">
                                Module {{ $module['module_number'] }}
                            </span>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $module['title'] }}</h3>
                        </div>
                        <svg class="chevron w-6 h-6 text-gray-500 transform transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- Accordion Content -->
                    <div class="accordion-content p-6 bg-white rounded-b-lg shadow-sm border border-gray-100" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-y-0" x-transition:enter-end="opacity-100 transform scale-y-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-y-100" x-transition:leave-end="opacity-0 transform scale-y-0">
                        <!-- Duration -->
                        <div class="flex items-center space-x-3 text-gray-600 mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm font-medium">{{ $module['duration'] }}</span>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-base leading-relaxed mb-6">{{ $module['description'] }}</p>

                        <!-- Topics and Subtopics -->
                        <ul class="space-y-4">
                            @foreach($module['topics'] as $topic)
                                <li class="text-gray-700">
                                    <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $topic['category'] }}</h4>
                                    <ul class="ml-5 mt-2 space-y-2 list-disc">
                                        @foreach($topic['subtopics'] as $subtopic)
                                            @foreach(explode(',', $subtopic) as $item)
                                                <li class="text-gray-600 text-sm">{{ trim($item) }}</li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-center py-8">No modules available for this course.</p>
            @endforelse
        @else
            <p class="text-gray-600 text-center py-8">No curriculum available for this course.</p>
        @endif
    </div>
</div>

<!-- Course Instructor Section -->
<div class="container mx-auto px-5 py-10 max-w-7xl" id="instructors">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-5">
        Course <span class="text-orange-500">Instructor</span>
    </h2>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @if($course_details && !empty($course_details->instructor_ids))
                @foreach($course_details->instructor_ids as $instructor)
                    @php
                        $teacher = \App\Models\User::find($instructor);
                    @endphp
                    <div class="swiper-slide">
                        <div class="bg-white p-5 rounded-lg shadow-md text-center">
                            <img src="https://via.placeholder.com/150" alt="Instructor" class="w-24 h-24 rounded-full mx-auto mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $teacher ? $teacher->name : 'Unknown Instructor' }}</h3>
                            <p class="text-sm text-gray-600 flex items-center justify-center gap-1 mt-1">
                                <i class="fas fa-clock text-orange-500"></i>
                                1600+ hours taught
                            </p>
                            <p class="text-sm text-gray-600 mt-1">Courses | teach</p>
                            <p class="text-sm text-gray-600">Web Development</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="swiper-slide">
                    <div class="bg-white p-5 rounded-lg shadow-md text-center">
                        <p class="text-gray-600">No instructors available for this course.</p>
                    </div>
                </div>
            @endif
        </div>
        <div class="swiper-pagination mt-5"></div>
    </div>
</div>

<!-- FAQs Section -->
<div class="container mx-auto px-5 py-10 max-w-7xl" id="faqs">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-5">
        Wait! I Have Some <span class="text-orange-500">Questions</span>
    </h2>
    <div x-data="{ openAccordion: null }" class="space-y-2">
        @if($course_details && !empty($course_details->faqs))
            @foreach($course_details->faqs as $index => $faq)
                <div class="border border-blue-500 rounded-lg">
                    <button @click="openAccordion = openAccordion === {{ $index + 1 }} ? null : {{ $index + 1 }}" class="w-full flex justify-between items-center p-4 text-left text-gray-800 font-semibold">
                        <span>{{ $faq['question'] }}</span>
                        <i :class="openAccordion === {{ $index + 1 }} ? 'fa-minus' : 'fa-plus'" class="fas text-blue-500"></i>
                    </button>
                    <div x-show="openAccordion === {{ $index + 1 }}" x-transition class="p-4 bg-white">
                        <p class="text-gray-600">
                            {{ $faq['answer'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-600">No FAQs available for this course.</p>
        @endif
    </div>
</div>

<!-- Facilities Providing Section -->
<div class="container mx-auto px-5 py-10 max-w-7xl">
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
<div class="container mx-auto px-5 py-10 max-w-7xl">
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
            640: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20
            },
        },
    });

    // Fetch batches dynamically
    document.addEventListener('DOMContentLoaded', function () {
        const courseId = @json($course_details->id ?? null);
        if (!courseId) {
            console.error('Course ID not found');
            document.getElementById('batch-cards').innerHTML = '<p class="text-gray-600">Unable to load batches. Course not found.</p>';
            return;
        }

        fetch(`/api/batches/by-course?id=${courseId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            const batchCardsContainer = document.getElementById('batch-cards');
            const availableSlotsElement = document.getElementById('available-slots');
            const filledSlotsElement = document.getElementById('filled-slots');
            const modeOfTeachingElement = document.getElementById('mode-of-teaching');
            const batchPriceElement = document.getElementById('batch-price');
            const batchDiscountElement = document.getElementById('batch-discount');
            const batchCountdownElement = document.getElementById('batch-countdown');
            const enrollButton = document.getElementById('batch-enroll-button');

            if (!data || data.length === 0) {
                batchCardsContainer.innerHTML = '<p class="text-gray-600">No batches available for this course.</p>';
                return;
            }

            // Render batch cards
            batchCardsContainer.innerHTML = data.map(batch => `
                <div class="batch-card bg-gray-100 p-5 rounded-lg shadow-md text-center cursor-pointer" data-batch-id="${batch.id}" data-batch='${JSON.stringify(batch)}'>
                    <p class="text-lg font-semibold text-gray-800">${batch.date}</p>
                    <p class="text-sm text-gray-600 capitalize">${batch.status}</p>
                </div>
            `).join('');

            // Add click event listeners to batch cards
            let selectedBatch = null;
            const batchCards = document.querySelectorAll('.batch-card');
            batchCards.forEach(card => {
                card.addEventListener('click', function () {
                    // Remove selected class from all cards
                    batchCards.forEach(c => c.classList.remove('selected'));
                    // Add selected class to clicked card
                    this.classList.add('selected');

                    // Parse batch data
                    selectedBatch = JSON.parse(this.dataset.batch);

                    // Update slots and mode
                    availableSlotsElement.textContent = selectedBatch.slotsAvailable;
                    filledSlotsElement.textContent = selectedBatch.slotsFilled;
                    modeOfTeachingElement.textContent = selectedBatch.mode;

                    // Update price and discount
                    const originalPrice = selectedBatch.price;
                    const discountPercentage = selectedBatch.discount_percentage || 0;
                    const discountedPrice = originalPrice * (1 - discountPercentage / 100);
                    batchPriceElement.textContent = `₹${discountedPrice.toLocaleString('en-IN', { minimumFractionDigits: 0 })}`;

                    if (discountPercentage > 0) {
                        batchDiscountElement.innerHTML = `${discountPercentage}% OFF Expires in <span class="countdown-timer" id="batch-countdown"></span>`;
                    } else {
                        batchDiscountElement.innerHTML = 'No discount available';
                    }

                    // Update countdown timer
                    if (selectedBatch.startDate) {
                        const startDate = new Date(selectedBatch.startDate);
                        const now = new Date();
                        if (startDate > now) {
                            const diff = startDate - now;
                            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                            batchCountdownElement.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;

                            // Update countdown every second
                            const countdownInterval = setInterval(() => {
                                const newDiff = startDate - new Date();
                                if (newDiff <= 0) {
                                    clearInterval(countdownInterval);
                                    batchCountdownElement.textContent = 'Batch Started';
                                    return;
                                }
                                const d = Math.floor(newDiff / (1000 * 60 * 60 * 24));
                                const h = Math.floor((newDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const m = Math.floor((newDiff % (1000 * 60 * 60)) / (1000 * 60));
                                const s = Math.floor((newDiff % (1000 * 60)) / 1000);
                                batchCountdownElement.textContent = `${d}d ${h}h ${m}m ${s}s`;
                            }, 1000);
                        } else {
                            batchCountdownElement.textContent = 'Batch Started';
                        }
                    }

                    // Enable enroll button
                    enrollButton.disabled = false;
                });
            });

            // Handle enroll button click
            enrollButton.addEventListener('click', function () {
                if (!selectedBatch) {
                    alert('Please select a batch to enroll.');
                    return;
                }

                // Send batch ID to store in session
                fetch('/store-batch-data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ batch_id: selectedBatch.id })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to registration page
                        window.location.href = '/register';
                    } else {
                        alert('Failed to proceed with enrollment. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error storing batch data:', error);
                    alert('An error occurred while proceeding to enrollment. Please try again.');
                });
            });
        })
        .catch(error => {
            console.error('Error fetching batches:', error);
            document.getElementById('batch-cards').innerHTML = '<p class="text-gray-600">Error loading batches. Please try again later.</p>';
        });
703
    });
</script>

<!-- Include Alpine.js for Accordion Functionality -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection