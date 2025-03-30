<nav class="bg-gradient-to-r from-[#2c0b57] to-[#0c3c7c] shadow-xl fixed w-full z-50">
  <div class="container mx-auto px-4">
    <div class="flex justify-between items-center h-16">
      <a href="{{ route('home-page') }}" class="flex items-center">
        <img src="./images/THINK CHAMP logo2.png" alt="Logo" class="h-10" />
      </a>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-button" class="lg:hidden text-white focus:outline-none" aria-label="Toggle Menu">
        <!-- Hamburger Icon -->
        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <!-- Close Icon -->
        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex items-center space-x-8">
        <a href="{{ route('home-page') }}" class="text-white hover:text-amber-400 transition-colors duration-300">Home</a>
        <a href="about" class="text-white hover:text-amber-400 transition-colors duration-300">About</a>

        <!-- Dropdown 1 -->
        <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @click.away="open = false">
          <button @click="open = !open" class="text-white hover:text-amber-400 flex items-center gap-1 transition-colors duration-300">
            What we offer <i class="fas fa-chevron-down text-sm transition-transform duration-200" :class="{ 'transform rotate-180': open }"></i>
          </button>
          <div x-show="open" x-transition:enter="transition ease-out duration-200" 
               x-transition:enter-start="opacity-0 scale-95" 
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-150" 
               x-transition:leave-start="opacity-100 scale-100" 
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute bg-black/90 rounded-lg p-2 min-w-[200px] mt-2 shadow-lg z-50">
            <a href="{{ route('website.course') }}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">Courses</a>
            <a href="{{ route('website.internship_details') }}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">Internships</a>
            <a href="{{ route('website.course_details') }}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">Course Details</a>
          </div>
        </div>

        <!-- Dropdown 2 -->
        <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" @click.away="open = false">
          <button @click="open = !open" class="text-white hover:text-amber-400 flex items-center gap-1 transition-colors duration-300">
            Update <i class="fas fa-chevron-down text-sm transition-transform duration-200" :class="{ 'transform rotate-180': open }"></i>
          </button>
          <div x-show="open" x-transition:enter="transition ease-out duration-200" 
               x-transition:enter-start="opacity-0 scale-95" 
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-150" 
               x-transition:leave-start="opacity-100 scale-100" 
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute bg-black/90 rounded-lg p-2 min-w-[200px] mt-2 shadow-lg z-50">
            <a href="{{ route('website.events')}}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">Event</a>
            <a href="{{ route('website.news')}}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">News</a>
            <a href="{{ route('website.webinar')}}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">Webinars</a>
          </div>
        </div>

        <a href="{{ route('website.reviews') }}" class="text-white hover:text-amber-400 transition-colors duration-300">Reviews</a>
        <a href="{{ route('website.contact')}}" class="text-white hover:text-amber-400 transition-colors duration-300">Contact</a>
        <a href="{{ route('login') }}" class="bg-gradient-to-r from-orange-600 to-amber-500 px-6 py-2 rounded-lg text-white font-semibold hover:shadow-lg hover:shadow-orange-300 transition-all">Login</a>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden flex flex-col space-y-4 p-4 bg-[#2c0b57]">
      <a href="{{ route('home-page') }}" class="text-white hover:text-amber-400">Home</a>
      <a href="{{ route('about-page') }}" class="text-white hover:text-amber-400">About</a>

      <!-- Mobile Dropdown 1 -->
      <div x-data="{ open: false }">
        <button @click="open = !open" class="text-white hover:text-amber-400 flex items-center justify-between w-full">
          What we offer
          <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="open" x-transition class="pl-4">
          <a href="{{ route('website.course') }}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">Courses</a>
          <a href="{{ route('website.internship_details') }}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">Internships</a>
          <a href="{{ route('website.course_details') }}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">Course Details</a>
        </div>
      </div>

      <!-- Mobile Dropdown 2 -->
      <div x-data="{ open: false }">
        <button @click="open = !open" class="text-white hover:text-amber-400 flex items-center justify-between w-full">
          Update
          <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="open" x-transition class="pl-4">
          <a href="{{ route('website.events') }}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">Event</a>
          <a href="{{ route('website.news')}}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">News</a>
          <a href="{{ route('website.webinar')}}" class="block px-4 py-2 text-white hover:bg-orange-500 rounded-md transition-colors">Webinars</a>
        </div>
      </div>

      <a href="{{ route('website.reviews') }}" class="text-white hover:text-amber-400">Reviews</a>
      <a href="{{ route('website.contact')}}" class="text-white hover:text-amber-400">Contact</a>
      <a href="{{ route('login') }}" class="bg-orange-500 px-6 py-2 rounded-lg text-white text-center hover:bg-orange-600">Login</a>
    </div>
  </div>
</nav>

<script>
// Mobile menu toggle functionality
document.getElementById('mobile-menu-button').addEventListener('click', function() {
  const mobileMenu = document.getElementById('mobile-menu');
  const menuIcon = document.getElementById('menu-icon');
  const closeIcon = document.getElementById('close-icon');
  
  mobileMenu.classList.toggle('hidden');
  menuIcon.classList.toggle('hidden');
  closeIcon.classList.toggle('hidden');
});

// Initialize Alpine.js for dropdown functionality
document.addEventListener('alpine:init', () => {
  // Alpine is already handling our dropdowns
});
</script>