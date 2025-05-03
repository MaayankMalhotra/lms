@extends('website.layouts.app')
@section('content')

<div class="font-sans bg-gray-100">
       <!-- Image Section -->
       <div class="mx-auto mt-10">
        <img src="https://d1d5cy0fmpy9m8.cloudfront.net/images/17462649220b4fd04b664e18c9453cce7b2c17539931f08657_(3).jpg" alt="People at Table" class="w-full h-48 object-cover rounded-lg shadow-md">
      </div>
    
    <!-- Event Header Section -->
    <div class="bg-white p-6 rounded-lg shadow-md  mx-auto mt-6">
      <div class="flex justify-between items-center">
        <div>
          <p class="text-gray-500 uppercase text-sm">Event</p>
          <h1 class="text-2xl font-bold text-gray-800">EVENT YOUR CAREER NEXT LEVELY FUTURE APPROACH</h1>
          <p class="text-gray-500 mt-2">Entry Fee</p>
          <p class="text-lg font-semibold text-gray-800">FREE</p>
          <p class="text-gray-500">120000 other are participating</p>
        </div>
        <div class="bg-indigo-100 text-indigo-800 rounded-lg p-4 text-center">
          <p class="text-sm">Contest starts in</p>
          <div class="flex space-x-2 mt-2">
            <div class="bg-indigo-500 text-white rounded-lg p-2">
              <p class="text-lg font-bold">1</p>
              <p class="text-xs">Days</p>
            </div>
            <div class="bg-indigo-500 text-white rounded-lg p-2">
              <p class="text-lg font-bold">4</p>
              <p class="text-xs">Hours</p>
            </div>
            <div class="bg-indigo-500 text-white rounded-lg p-2">
              <p class="text-lg font-bold">34</p>
              <p class="text-xs">Mins</p>
            </div>
            <div class="bg-indigo-500 text-white rounded-lg p-2">
              <p class="text-lg font-bold">21</p>
              <p class="text-xs">Sec</p>
            </div>
          </div>
        </div>
      </div>
      <button class="bg-orange-500 text-white font-semibold py-2 px-6 rounded-lg mt-4 hover:bg-orange-600">
        Login to register
      </button>
    </div>
  
 
    <!-- Webinar Details Section -->
    <div class="bg-[#FDF5E6] p-6 rounded-lg shadow-md  mx-auto mt-6">
      <h2 class="text-2xl font-bold text-gray-800 text-center">Webinar details</h2>
      <h3 class="text-lg font-semibold text-gray-800 mt-4">ROUND 1:</h3>
      <div class="grid grid-cols-4 gap-4 mt-4 text-center">
        <div>
          <p class="text-gray-500">Participation points</p>
          <p class="text-2xl font-bold text-gray-800">30</p>
        </div>
        <div>
          <p class="text-gray-500">Start time</p>
          <p class="text-lg font-semibold text-gray-800">15-Sep-23</p>
          <p class="text-gray-500">(08:00 PM IST)</p>
        </div>
        <div>
          <p class="text-gray-500">End time</p>
          <p class="text-lg font-semibold text-gray-800">15-Sep-23</p>
          <p class="text-gray-500">(10:00 PM IST)</p>
        </div>
        <div>
          <p class="text-gray-500">Duration:</p>
          <p class="text-lg font-semibold text-gray-800">1 hour</p>
        </div>
      </div>
      <p class="text-gray-600 mt-4">
        Learn to build entire web applications from start to finish on one of the most versatile tech stacks: MongoDB, Express.js, React.js and Node.js
      </p>
      <p class="text-gray-800 mt-4">
        <span class="font-semibold">TOPIC:</span> <span class="text-orange-500">Roadmap to SWE Career at Google</span>
      </p>
      <p class="text-gray-800">
        <span class="font-semibold">SPEAKER:</span> <span class="text-orange-500">Joo muri (Web Solution Engineer II @ Google)</span>
      </p>
      <p class="text-gray-800 flex items-center mt-2">
        <svg class="w-5 h-5 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm1 2h6v2H7V4zm-3 4h12v8H4V8zm2 2v4h2v-4H6zm4 0v4h2v-4h-2z"/>
        </svg>
        <span class="text-orange-500">August 9, 2023</span>
      </p>
      <h3 class="text-lg font-semibold text-gray-800 mt-4">About Speaker:</h3>
      <p class="text-gray-600 mt-2">
        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.
      </p>
      <h3 class="text-lg font-semibold text-gray-800 mt-4">What You'll Learn?</h3>
      <ul class="list-disc list-inside text-gray-600 mt-2">
        <li>What skills do product companies look for?</li>
        <li>How to prepare and master these skills?</li>
        <li>How to showcase your skills?</li>
      </ul>
      <p class="text-gray-800 mt-4 font-semibold">Register today to secure your spot.</p>
      <p class="text-gray-800 font-semibold">See you at the masterclass!!</p>
    </div>
</div>

@endsection