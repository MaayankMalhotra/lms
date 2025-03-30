@extends('website.layouts.app')

@section('title', 'Reviews')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />



    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#2c0b57",
                        secondary: "#0c3c7c",
                        accent: "#ff7f00",
                        "accent-hover": "#e76e00",
                    },
                    fontFamily: {
                        poppins: ["Poppins", "sans-serif"],
                    },
                    animation: {
                        gradientBG: "gradientBG 5s infinite alternate-reverse",
                        shine: "shine 3s infinite",
                        footerGlow: "footerGlow 3s infinite alternate",
                    },
                    keyframes: {
                        gradientBG: {
                            "0%": {
                                backgroundPosition: "0% 50%"
                            },
                            "50%": {
                                backgroundPosition: "100% 50%"
                            },
                            "100%": {
                                backgroundPosition: "0% 50%"
                            },
                        },
                        shine: {
                            "0%": {
                                left: "-100%"
                            },
                            "50%": {
                                left: "100%"
                            },
                            "100%": {
                                left: "-100%"
                            },
                        },
                        footerGlow: {
                            "0%": {
                                boxShadow: "0px 0px 10px rgba(255, 115, 0, 0.3)"
                            },
                            "50%": {
                                boxShadow: "0px 0px 20px rgba(255, 115, 0, 0.6)"
                            },
                            "100%": {
                                boxShadow: "0px 0px 10px rgba(255, 115, 0, 0.3)"
                            },
                        },
                    },
                },
            },
        };
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <!-- Animation Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <section class="bg-gradient-to-r from-primary to-secondary text-white py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center">
                <!-- Left Column: Stats -->
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <h2 class="text-4xl font-bold mb-6">
                        Trusted by thousands to launch
                        <br />
                        great software <span class="text-accent">careers</span>
                    </h2>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-building text-accent mr-2"></i>
                            <strong>1500+</strong> Companies
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-user-friends text-accent mr-2"></i>
                            <strong>12k+</strong> Hiring Partners
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-graduation-cap text-accent mr-2"></i>
                            <strong>3000+</strong> Colleges
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-chart-line text-accent mr-2"></i>
                            We Shape the Change for the Careers
                        </li>
                    </ul>
                    <button
                        class="mt-6 bg-accent text-white px-8 py-3 rounded-lg font-semibold hover:bg-accent-hover transition-all">
                        Get Career Expert
                    </button>
                </div>

                <!-- Right Column: 3 side-by-side rotating cards -->
                <div class="lg:w-1/2 relative">
                    <!-- Swiper Container -->
                    <div class="swiper-container mySwiper overflow-hidden w-96 lg:w-full">
                        <div class="swiper-wrapper">
                            <!-- Testimonial Cards -->
                            <div class="swiper-slide">
                                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                                    <img src="https://via.placeholder.com/80" alt="Profile"
                                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                                    <h5 class="text-lg font-semibold">Joe Muri</h5>
                                    <div class="text-sm text-gray-600">Computer Science Engineering</div>
                                    <div class="text-sm text-gray-600">Software Engineer</div>
                                    <div class="text-sm text-yellow-500 mt-2">Google ★★★★★</div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                                    <img src="https://via.placeholder.com/80/ff0000" alt="Profile"
                                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                                    <h5 class="text-lg font-semibold">Jane Doe</h5>
                                    <div class="text-sm text-gray-600">Information Technology</div>
                                    <div class="text-sm text-gray-600">Full-Stack Developer</div>
                                    <div class="text-sm text-yellow-500 mt-2">Microsoft ★★★★★</div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                                    <img src="https://via.placeholder.com/80/008000" alt="Profile"
                                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                                    <h5 class="text-lg font-semibold">John Smith</h5>
                                    <div class="text-sm text-gray-600">Electronics & Comm.</div>
                                    <div class="text-sm text-gray-600">Front-End Engineer</div>
                                    <div class="text-sm text-yellow-500 mt-2">Amazon ★★★★★</div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                                    <img src="https://via.placeholder.com/80/0000ff" alt="Profile"
                                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                                    <h5 class="text-lg font-semibold">Sara Lee</h5>
                                    <div class="text-sm text-gray-600">Mechanical Engineering</div>
                                    <div class="text-sm text-gray-600">Backend Engineer</div>
                                    <div class="text-sm text-yellow-500 mt-2">Google ★★★★★</div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                                    <img src="https://via.placeholder.com/80" alt="Profile"
                                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                                    <h5 class="text-lg font-semibold">Tom Brown</h5>
                                    <div class="text-sm text-gray-600">Civil Engineering</div>
                                    <div class="text-sm text-gray-600">DevOps Engineer</div>
                                    <div class="text-sm text-yellow-500 mt-2">Apple ★★★★★</div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                                    <img src="https://via.placeholder.com/80" alt="Profile"
                                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                                    <h5 class="text-lg font-semibold">Emily Clark</h5>
                                    <div class="text-sm text-gray-600">Biotech</div>
                                    <div class="text-sm text-gray-600">Data Analyst</div>
                                    <div class="text-sm text-yellow-500 mt-2">Facebook ★★★★★</div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                                    <img src="https://via.placeholder.com/80" alt="Profile"
                                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                                    <h5 class="text-lg font-semibold">Chris Martin</h5>
                                    <div class="text-sm text-gray-600">Electrical Eng.</div>
                                    <div class="text-sm text-gray-600">ML Engineer</div>
                                    <div class="text-sm text-yellow-500 mt-2">Tesla ★★★★★</div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                                    <img src="https://via.placeholder.com/80" alt="Profile"
                                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                                    <h5 class="text-lg font-semibold">Alice Kim</h5>
                                    <div class="text-sm text-gray-600">CS & AI</div>
                                    <div class="text-sm text-gray-600">AI Specialist</div>
                                    <div class="text-sm text-yellow-500 mt-2">IBM ★★★★★</div>
                                </div>
                            </div>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>

                    <!-- Include Swiper JS -->
                    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
                </div>
            </div>
        </div>
    </section>
    <section class="container mx-auto px-4 py-16">
        <!-- Section Heading -->
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-8">
            Our Seniors share their placement success and reviews
            <br />
            <span class="text-orange-500">Launching Great Software Careers</span>
        </h2>

        <!-- Testimonial Sets Container -->
        <div class="testimonial-sets-container relative min-h-[600px]">
            <!-- SET 1: 2 rows x 4 columns each (8 total) -->
            <div class="testimonial-set active grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Row 1 -->
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Joe Muri</h5>
                    <div class="text-sm text-gray-600">Computer Science Engineering</div>
                    <div class="text-sm text-gray-600">Software Engineer</div>
                    <div class="text-sm text-yellow-500 mt-2">Google ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80/ff0000" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Jane Doe</h5>
                    <div class="text-sm text-gray-600">Information Technology</div>
                    <div class="text-sm text-gray-600">Full-Stack Developer</div>
                    <div class="text-sm text-yellow-500 mt-2">Microsoft ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80/008000" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">John Smith</h5>
                    <div class="text-sm text-gray-600">Electronics & Comm.</div>
                    <div class="text-sm text-gray-600">Front-End Engineer</div>
                    <div class="text-sm text-yellow-500 mt-2">Amazon ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80/0000ff" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Sara Lee</h5>
                    <div class="text-sm text-gray-600">Mechanical Engineering</div>
                    <div class="text-sm text-gray-600">Backend Engineer</div>
                    <div class="text-sm text-yellow-500 mt-2">Google ★★★★★</div>
                </div>

                <!-- Row 2 -->
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Tom Brown</h5>
                    <div class="text-sm text-gray-600">Civil Engineering</div>
                    <div class="text-sm text-gray-600">DevOps Engineer</div>
                    <div class="text-sm text-yellow-500 mt-2">Apple ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Emily Clark</h5>
                    <div class="text-sm text-gray-600">Biotech</div>
                    <div class="text-sm text-gray-600">Data Analyst</div>
                    <div class="text-sm text-yellow-500 mt-2">Facebook ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Chris Martin</h5>
                    <div class="text-sm text-gray-600">Electrical Eng.</div>
                    <div class="text-sm text-gray-600">ML Engineer</div>
                    <div class="text-sm text-yellow-500 mt-2">Tesla ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Alice Kim</h5>
                    <div class="text-sm text-gray-600">CS & AI</div>
                    <div class="text-sm text-gray-600">AI Specialist</div>
                    <div class="text-sm text-yellow-500 mt-2">IBM ★★★★★</div>
                </div>
            </div>

            <!-- SET 2: Another 2 rows x 4 columns (8 total) -->
            <div class="testimonial-set hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Row 1 -->
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Jacob Brown</h5>
                    <div class="text-sm text-gray-600">Computer Science</div>
                    <div class="text-sm text-gray-600">SWE Intern</div>
                    <div class="text-sm text-yellow-500 mt-2">Netflix ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80/ff0000" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Linda Roy</h5>
                    <div class="text-sm text-gray-600">Data Science</div>
                    <div class="text-sm text-gray-600">ML Ops</div>
                    <div class="text-sm text-yellow-500 mt-2">AWS ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80/008000" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Gina Hall</h5>
                    <div class="text-sm text-gray-600">Business Analytics</div>
                    <div class="text-sm text-gray-600">BI Developer</div>
                    <div class="text-sm text-yellow-500 mt-2">Oracle ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80/0000ff" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Mark Davis</h5>
                    <div class="text-sm text-gray-600">IT & Cloud</div>
                    <div class="text-sm text-gray-600">Cloud Engineer</div>
                    <div class="text-sm text-yellow-500 mt-2">Google ★★★★★</div>
                </div>

                <!-- Row 2 -->
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Anna White</h5>
                    <div class="text-sm text-gray-600">Cybersecurity</div>
                    <div class="text-sm text-gray-600">Security Analyst</div>
                    <div class="text-sm text-yellow-500 mt-2">Cisco ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Peter Wong</h5>
                    <div class="text-sm text-gray-600">UI/UX Design</div>
                    <div class="text-sm text-gray-600">Product Designer</div>
                    <div class="text-sm text-yellow-500 mt-2">Adobe ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Lucy Chan</h5>
                    <div class="text-sm text-gray-600">Networking</div>
                    <div class="text-sm text-gray-600">Network Engineer</div>
                    <div class="text-sm text-yellow-500 mt-2">Juniper ★★★★★</div>
                </div>
                <div class="testimonial-common bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="https://via.placeholder.com/80" alt="Profile"
                        class="w-20 h-20 rounded-full mx-auto mb-4" />
                    <h5 class="text-lg font-semibold">Oliver Ray</h5>
                    <div class="text-sm text-gray-600">Software Systems</div>
                    <div class="text-sm text-gray-600">System Architect</div>
                    <div class="text-sm text-yellow-500 mt-2">Intel ★★★★★</div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 mb-5">
        <h2 class="text-3xl font-bold text-center mb-8">
            YouTube <span class="text-blue-600">Reviews</span>
        </h2>

        <div class="text-center mb-8">
            <div class="font-bold text-yellow-500 text-lg mb-2">
                5 ★★★★★ (10,000)
            </div>
            <p class="text-gray-600 md:text-lg">
                Over 10,000 satisfied learners sharing their success stories!
            </p>
        </div>

        <!-- Video Container -->
        <div class="overflow-hidden">
            <!-- Video Set 1 -->
            <div class="hidden flex flex-wrap -mx-2" id="videoSet1">
                <div class="w-full md:w-1/2 px-2 mb-4">
                    <div class="relative cursor-pointer group" data-bs-toggle="modal" data-bs-target="#youtubeModal"
                        data-video-id="dQw4w9WgXcQ">
                        <img src="https://via.placeholder.com/400x200/000/fff?text=YouTube+Review+1"
                            alt="YouTube Review 1" class="w-full h-48 object-cover rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center rounded-lg transition-opacity group-hover:bg-opacity-20">
                            <div
                                class="w-12 h-12 bg-white rounded-full flex items-center justify-center transform transition-transform group-hover:scale-110">
                                <i class="fas fa-play text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="font-semibold mt-2">Joo Muri</div>
                    <div class="text-gray-600 text-sm">Watch how Joo started her journey</div>
                </div>

                <!-- Repeat similar structure for other video items -->
            </div>

            <!-- Video Set 2 -->
            <div class="hidden flex flex-wrap -mx-2" id="videoSet2">
                <!-- Similar structure as above -->
            </div>

            <!-- Active Video Set 3 -->
            <div class="flex flex-wrap -mx-2" id="videoSet3">
                <div class="w-full md:w-1/2 px-2 mb-4">
                    <div class="relative cursor-pointer group" data-bs-toggle="modal" data-bs-target="#youtubeModal"
                        data-video-id="tPEE9ZwTmy0">
                        <img src="https://via.placeholder.com/400x200/000/fff?text=YouTube+Review+5"
                            alt="YouTube Review 5" class="w-full h-48 object-cover rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center rounded-lg transition-opacity group-hover:bg-opacity-20">
                            <div
                                class="w-12 h-12 bg-white rounded-full flex items-center justify-center transform transition-transform group-hover:scale-110">
                                <i class="fas fa-play text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="font-semibold mt-2">Tom Brown</div>
                    <div class="text-gray-600 text-sm">From Civil to DevOps: Tom's journey</div>
                </div>

                <div class="w-full md:w-1/2 px-2 mb-4">
                    <div class="relative cursor-pointer group" data-bs-toggle="modal" data-bs-target="#youtubeModal"
                        data-video-id="xvFZjo5PgG0">
                        <img src="https://via.placeholder.com/400x200/000/fff?text=YouTube+Review+6"
                            alt="YouTube Review 6" class="w-full h-48 object-cover rounded-lg">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center rounded-lg transition-opacity group-hover:bg-opacity-20">
                            <div
                                class="w-12 h-12 bg-white rounded-full flex items-center justify-center transform transition-transform group-hover:scale-110">
                                <i class="fas fa-play text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="font-semibold mt-2">Emily Clark</div>
                    <div class="text-gray-600 text-sm">Data Analyst story at Facebook</div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const set1 = document.getElementById("testimonialSet1");
        const set2 = document.getElementById("testimonialSet2");

        let showingSet1 = true;

        setInterval(() => {
            if (showingSet1) {
                set1.classList.add("hidden");
                set2.classList.remove("hidden");
            } else {
                set2.classList.add("hidden");
                set1.classList.remove("hidden");
            }
            showingSet1 = !showingSet1;
        }, 5000); // Switch every 5 seconds
    </script>
    <script>
        // Hero Card Rotation
        const card1 = document.querySelector("#carouselCard1");
        const card2 = document.querySelector("#carouselCard2");
        const card3 = document.querySelector("#carouselCard3");

        let positions = [card1, card2, card3];

        function rotateHeroCards() {
            positions.push(positions.shift());
            positions[0].classList.add("card-center");
            positions[1].classList.add("card-right");
            positions[2].classList.add("card-left");
        }

        setInterval(rotateHeroCards, 3000);
    </script>
    <script>
        const swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
            autoplay: {
        delay: 1000, // Delay between transitions in milliseconds
        disableOnInteraction: false, // Continue autoplay after user interactions
    },
            breakpoints: {
                // Responsive breakpoints
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
@endsection
