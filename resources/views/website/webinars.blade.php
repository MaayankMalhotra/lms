@extends('website.layouts.app')
@section('title', 'Webinars')
@section('content')
<!-- All Webinars Section -->
<section class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">All <span class="text-blue-500">Webinars</span></h2>
  
    <!-- Tags Box on Top (Optional) -->
    <div class="bg-gray-100 p-6 rounded-lg mb-8">
      <h5 class="text-lg font-semibold mb-4">Tags</h5>
      <ul class="flex flex-wrap gap-2">
        <li class="bg-white px-4 py-2 rounded-full text-sm">Interview Preparation</li>
        <li class="bg-white px-4 py-2 rounded-full text-sm">Contest Solutions</li>
        <li class="bg-white px-4 py-2 rounded-full text-sm">Competitive Programming</li>
        <li class="bg-white px-4 py-2 rounded-full text-sm">Android</li>
        <li class="bg-white px-4 py-2 rounded-full text-sm">Campus Event</li>
      </ul>
    </div>
  
    <!-- 4 Webinar Cards in 2 rows x 2 columns -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Card 1 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img
          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKF_YlFFlKS6AQ8no0Qs_xM6AkjvwFwP61og&s"
          alt="Webinar 1"
          class="w-full h-48 object-cover"
        />
        <div class="p-6">
          <h5 class="text-xl font-semibold mb-2">Event: Your Career Next Level Future Approach</h5>
          <div class="text-gray-600 mb-2">
            Starts on <strong>08:00 PM, 15 Sep 2023</strong>
          </div>
          <div class="text-gray-600 mb-2">
            Entry Free | Registration Open till 15 Sep 2023
          </div>
          <div class="text-gray-600 mb-4">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour.
          </div>
          <div class="text-gray-600 mb-4">120000 participants Registered</div>
          <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
            Register Now
          </button>
        </div>
      </div>
  
      <!-- Card 2 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img
          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKF_YlFFlKS6AQ8no0Qs_xM6AkjvwFwP61og&s"
          alt="Webinar 2"
          class="w-full h-48 object-cover"
        />
        <div class="p-6">
          <h5 class="text-xl font-semibold mb-2">Event: Your Career Next Level Future Approach</h5>
          <div class="text-gray-600 mb-2">
            Starts on <strong>08:00 PM, 15 Sep 2023</strong>
          </div>
          <div class="text-gray-600 mb-2">
            Entry Free | Registration Open till 15 Sep 2023
          </div>
          <div class="text-gray-600 mb-4">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour.
          </div>
          <div class="text-gray-600 mb-4">120000 participants Registered</div>
          <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
            Register Now
          </button>
        </div>
      </div>
    </div>
  
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
      <!-- Card 3 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img
          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKF_YlFFlKS6AQ8no0Qs_xM6AkjvwFwP61og&s"
          alt="Webinar 3"
          class="w-full h-48 object-cover"
        />
        <div class="p-6">
          <h5 class="text-xl font-semibold mb-2">Event: Your Career Next Level Future Approach</h5>
          <div class="text-gray-600 mb-2">
            Starts on <strong>08:00 PM, 15 Sep 2023</strong>
          </div>
          <div class="text-gray-600 mb-2">
            Entry Free | Registration Open till 15 Sep 2023
          </div>
          <div class="text-gray-600 mb-4">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour.
          </div>
          <div class="text-gray-600 mb-4">120000 participants Registered</div>
          <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
            Register Now
          </button>
        </div>
      </div>
  
      <!-- Card 4 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img
          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKF_YlFFlKS6AQ8no0Qs_xM6AkjvwFwP61og&s"
          alt="Webinar 4"
          class="w-full h-48 object-cover"
        />
        <div class="p-6">
          <h5 class="text-xl font-semibold mb-2">Event: Your Career Next Level Future Approach</h5>
          <div class="text-gray-600 mb-2">
            Starts on <strong>08:00 PM, 15 Sep 2023</strong>
          </div>
          <div class="text-gray-600 mb-2">
            Entry Free | Registration Open till 15 Sep 2023
          </div>
          <div class="text-gray-600 mb-4">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour.
          </div>
          <div class="text-gray-600 mb-4">120000 participants Registered</div>
          <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
            Register Now
          </button>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Course Certificates Section -->
  <section class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">Course <span class="text-blue-500">Certificates</span></h2>
  
    <!-- Description Paragraph -->
    <p class="text-gray-600 mb-8">
      Our business analyst Master's program is led by industry experts who will make you proficient in the field of business analytics. The projects and case studies that are provided as part of this course will help you gain industry-grade experience, which will be a bonus in your resume.
    </p>
  
    <!-- Two-Column Layout -->
    <div class="flex flex-col md:flex-row gap-8">
      <!-- Left Column: Bullet Points -->
      <div class="w-full md:w-1/2">
        <ul class="space-y-4">
          <li class="flex items-center text-gray-700">
            <span class="mr-2">•</span> CEBA – Certification of Competency in Business Analysis
          </li>
          <li class="flex items-center text-gray-700">
            <span class="mr-2">•</span> Agile Scrum Foundation
          </li>
          <li class="flex items-center text-gray-700">
            <span class="mr-2">•</span> Digital Transformation Course for Leaders
          </li>
        </ul>
      </div>
  
      <!-- Right Column: Certificate Image -->
      <div class="w-full md:w-1/2 flex justify-center">
        <img
          src="https://media.licdn.com/dms/image/v2/D5622AQGoUBZSCAP82g/feedshare-shrink_2048_1536/feedshare-shrink_2048_1536/0/1731245943907?e=2147483647&v=beta&t=55eBVsL3PaAH74TFdAM3qEz8RBRcwxX_ZHYYpst400I"
          alt="Certificate Sample"
          class="w-full max-w-md rounded-lg shadow-md"
        />
      </div>
    </div>
  </section>
  
  <!-- Optional Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- 🚀 GSAP Scroll Animations -->
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