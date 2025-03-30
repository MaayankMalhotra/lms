@extends('website.layouts.app')
@section('title', 'Course Details')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
<!-- Swiper CSS -->


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script src="https://cdn.tailwindcss.com"></script>
<!-- Animation Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<style>
    /* 🌍 Universal Styling - Resets Default Browser Styles */
    /* 🌍 Universal Styling - Resets Default Browser Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      scroll-behavior: smooth;
      /* Enables smooth scrolling */
    }

  
    /* ✅ Responsive Typography */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-weight: bold;
      line-height: 1.3;
    }

    h1 {
      font-size: 2.8rem;
    }

    h2 {
      font-size: 2.4rem;
    }

    h3 {
      font-size: 2rem;
    }

    h4 {
      font-size: 1.8rem;
    }

    h5 {
      font-size: 1.5rem;
    }

    h6 {
      font-size: 1.3rem;
    }

    /* ✨ Section Spacing */
    section {
      padding: 80px 0;
    }

    /* 🔥 Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #ddd;
    }

    ::-webkit-scrollbar-thumb {
      background: #ff7300;
      /* Orange scrollbar */
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #ff4500;
      /* Darker shade on hover */
    }

    /* ✅ Responsive Layout Fixes */
    @media (max-width: 1200px) {
      body {
        font-size: 15px;
      }

      section {
        padding: 70px 0;
      }
    }

    @media (max-width: 992px) {
      body {
        font-size: 14px;
      }

      section {
        padding: 60px 0;
      }
    }

    @media (max-width: 768px) {
      body {
        font-size: 13px;
      }

      section {
        padding: 50px 0;
      }

      h1 {
        font-size: 2.2rem;
      }

      h2 {
        font-size: 2rem;
      }

      h3 {
        font-size: 1.8rem;
      }
    }

    @media (max-width: 576px) {
      body {
        font-size: 12px;
      }

      section {
        padding: 40px 0;
      }

      h1 {
        font-size: 2rem;
      }

      h2 {
        font-size: 1.8rem;
      }

      h3 {
        font-size: 1.6rem;
      }

      .navbar {
        padding: 10px 20px;
      }

      .nav-link,
      .dropdown-item {
        font-size: 0.9rem;
      }

      .btn-login {
        padding: 5px 30px;
        font-size: 16px;
      }
    }

    /* Additional Media Query for very small devices */
    @media (max-width: 360px) {
      .navbar {
        padding: 8px 15px;
      }

      .btn-login {
        padding: 4px 25px;
        font-size: 14px;
      }
    }


    .dropdown-item {
      color: white;
      font-weight: 500;
      padding: 10px;
      transition: all 0.3s ease-in-out;
    }

    .dropdown-item:hover {
      background: linear-gradient(90deg, #ffba42, #ff7300);
      color: white;
      transform: scale(1.05);
    }

    /* Login Button with Animated Gradient */
    .btn-login {
      background: linear-gradient(270deg, #ff7300, #ff5700, #ff4500);
      background-size: 200% 200%;
      border-radius: 6px;
      padding: 6px 80px;
      color: white;
      font-size: 18px;
      font-weight: bold;
      display: inline-block;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: all 0.4s ease-in-out;
      position: relative;
      overflow: hidden;
      box-shadow: 0px 4px 15px rgba(255, 115, 0, 0.5);
      animation: gradientBG 5s infinite alternate-reverse;
    }

    /* Animated Gradient Background */
    @keyframes gradientBG {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    /* Hover Effects */
    .btn-login:hover {
      background: linear-gradient(90deg, #ff4500, #ff7300);
      box-shadow: 0 0 20px rgba(255, 115, 0, 0.8),
        0 0 25px rgba(255, 186, 66, 0.6);
      transform: scale(1.08);
    }

    /* Add 3D Lift Effect */
    .btn-login:active {
      transform: scale(0.98);
      box-shadow: 0px 3px 10px rgba(255, 115, 0, 0.5);
    }

    /* Light Reflection Shine Effect */
    .btn-login::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(120deg,
          rgba(255, 255, 255, 0.4),
          transparent);
      transform: rotate(45deg);
      transition: all 0.3s ease-in-out;
      animation: shine 3s infinite;
    }

    /* Shine Animation */
    @keyframes shine {
      0% {
        left: -100%;
      }

      50% {
        left: 100%;
      }

      100% {
        left: -100%;
      }
    }

    /* Fade-in Effect for Dropdown */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* nav end */
    /*                    Navbar Styling end*/

    /*                                 Hero Section */
    .header-text {
      color: #007bff;
      font-size: 20px;
      margin-bottom: 10px;
      font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
        sans-serif;
    }

    .course-title {
      font-size: 40px;
      color: #000000;
      font-weight: 500;
      margin-top: 20px;
      margin-bottom: 10px;
      font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande",
        "Lucida Sans", Arial, sans-serif;
    }

    .course-description {
      font-size: 16px;
      color: #666666;
      margin-bottom: 20px;
    }

    .btn-primary {
      background-color: #ff8c00;
      /* Custom orange color for the button */
      color: white;
      /* White text for visibility */
      border: none;
      /* No border for a cleaner look */
      padding: 10px 20px;
      /* Padding inside the button */
      font-size: 18px;
      /* Font size for legibility */
      display: flex;
      /* Ensures contents within the button are aligned */
      align-items: center;
      /* Centers the arrow icon vertically with the text */
      margin-right: 10px;
      /* Space between button and ratings */
    }

    .btn-primary i {
      margin-left: 5px;
      /* Space between 'Enroll now' text and the arrow icon */
    }

    .ratings {
      display: flex;
      /* Ensures the stars and the number are in a row */
      align-items: center;
      /* Aligns the stars and the rating text vertically */
      font-size: 13px;
      /* Adequate size for visibility */
      color: #333;
      /* Dark color for text to enhance readability */
    }

    .stars {
      color: #ffc107;
      /* Gold color for stars to stand out */
      margin-right: 5px;
      /* Space between stars and the number */
    }

    .rating {
      color: #333;
      /* Dark color for text to ensure readability */
    }

    .stats {
      display: flex;
      justify-content: space-around;
      /* Distributes space evenly around items */
      align-items: center;
      background-color: #f2f8fe;
      /* Matches body background for consistency */
      padding: 20px 0;
      /* Vertical padding for spacing */
    }

    .stat-box {
      flex-grow: 0;
      margin: 0 10px;
      /* Provides spacing between boxes */
      background-color: #e9ecef;
      /* Light gray background */
      border-radius: 8px;
      /* Rounded corners */
      padding: 15px;
      /* Padding inside each box */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .stat-value {
      font-size: 24px;
      font-weight: bold;
      color: #007bff;
      /* Blue color for the number */
      margin-bottom: 5px;
      /* Reduces the gap between the number and text */
    }

    .stat-text {
      font-size: 16px;
      color: #666;
      /* Dark gray for text */
    }

    .stat-line {
      height: 50px;
      /* Height of the separator line */
      width: 2px;
      /* Thin line width */
      background-color: #dee2e6;
      /* Light grey color for the line */
    }

    @media (max-width: 768px) {
      .stats {
        flex-direction: column;
        /* Stacks stats vertically on smaller screens */
      }

      .stat-line {
        width: 50%;
        /* Adjusts line width for horizontal layout */
        height: 2px;
        /* Adjusts line height for a horizontal separator */
        margin: 10px auto;
        /* Centers line horizontally with margin */
      }
    }

    /*                               Hero Section End */

    /*                                           Batchs Section Styling */



    .course-batches {
      background-color: #f9f5f0;
      padding: 40px;
      border-radius: 10px;
    }

    .section-title {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .course-text {
      color: black;
    }

    .batches-text {
      color: #ff7b00;
      font-weight: bold;
    }

    /* Batch Header */
    .batch-container {
      background: #ffffff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.15);
    }

    .batch-header {
      border-bottom: 2px solid #ddd;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }

    .batch-title {
      font-weight: bold;
      font-size: 20px;
    }

    .preferred-tag {
      background-color: #6f42c1;
      color: white;
      font-size: 12px;
      padding: 5px 10px;
      border-radius: 4px;
    }

    /* Batch Features */
    .batch-features {
      font-size: 14px;
      color: #333;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
    }

    .batch-features span {
      display: flex;
      align-items: center;
    }

    /* Batch Cards */
    .batch-card {
      background: #ffffff;
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 8px;
      text-align: center;
      transition: 0.3s;
      cursor: pointer;
      position: relative;
      /* Fix: Ensure absolute elements stay inside */
      overflow: hidden;
      /* Prevent content overflow */
    }

    .batch-card.active {
      border: 2px solid #ff7b00;
      position: relative;
    }

    .batch-card.active::before {
      content: "✔";
      position: absolute;
      top: -1px;
      left: -1px;
      background: #ff7b00;
      color: white;
      font-size: 16px;
      padding: 3px 6px;
      border-radius: 4px;
    }

    .batch-date {
      font-size: 18px;
      font-weight: bold;
    }

    .batch-details p {
      font-size: 14px;
      margin: 3px 0;
    }

    /* Pricing & CTA */
    .batch-footer {
      border-top: 2px solid #ddd;
      padding-top: 15px;
      margin-top: 20px;
    }

    .batch-price {
      font-size: 24px;
      font-weight: bold;
    }

    .discount-text {
      font-size: 12px;
      color: #007bff;
    }

    .btn-warning {
      background: #ff7b00;
      border: none;
      padding: 12px 20px;
      font-weight: bold;
      transition: 0.3s;
    }

    .btn-warning:hover {
      background: #e06b00;
    }

    .batch-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    /* Active batch card and soon functionality */
    .batch-card.soon {
      background-color: #f5f5f5;
      cursor: not-allowed;
    }

    .batch-card.soon:hover {
      border-color: #777;
      /* New border color on hover */
    }

    .batch-card.soon .batch-date {
      color: #777;
    }

    .batch-card.soon .batch-details {
      color: #777;
    }

    .batch-card.soon::after {
      content: "Soon";
      position: absolute;
      top: -1px;
      /* Adjusted for better alignment */
      right: -1px;
      /* Adjusted for better alignment */
      background-color: #ff0400;
      color: white;
      font-size: 12px;
      font-weight: bold;
      padding: 5px 10px;
      border-radius: 0 8px;
      border-color: #938c8c;
      z-index: 2;
      /* Ensure it appears above everything */
    }


    /*                             Batchs Section Styling End */

    /*                            About Course Overview Section */

    .course-overview {
      background-color: #f9f5f0;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    }

    .section-title {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 30px;
      text-align: center;
    }

    .course-text {
      color: #333;
    }

    .overview-text {
      color: #ff7b00;
      font-weight: bold;
    }

    .course-intro {
      font-size: 16px;
      color: #333;
      margin-bottom: 20px;
      text-align: center;
    }

    .learning-outcomes {
      list-style-type: none;
      padding: 0;
      font-size: 16px;
      color: #666;
    }

    .learning-outcomes li {
      margin-bottom: 10px;
    }

    .instructor-info {
      font-size: 16px;
      color: #666;
      margin-bottom: 20px;
    }

    /* Add-on Benefits Section */
    .additional-benefits {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
    }

    .benefit-card {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      width: 23%;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      margin-top: 30px;
    }

    .benefit-card:hover {
      transform: translateY(-5px);
      /* Lifting effect on hover */
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      /* Deeper shadow */
      background-color: #f3f3ed;
      color: white;
    }

    .benefit-card:hover h5 {
      color: #ff7b00;
    }

    .benefit-icon {
      width: 60px;
      height: 60px;
      margin-bottom: 15px;
      transition: transform 0.3s ease;
    }

    .benefit-card:hover .benefit-icon {
      transform: scale(1.1);
      /* Icon scale effect */
    }

    .benefit-card h5 {
      font-size: 18px;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }

    .benefit-card p {
      font-size: 14px;
      color: #666;
      line-height: 1.6;
      margin: 0;
    }

    /* Key Features Section */
    .key-features {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
      margin-top: 30px;
    }

    .features-container {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
    }

    .feature-card {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 8px;
      width: 23%;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
      /* Lifting effect on hover */
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      /* Deeper shadow */
      background-color: #f9e79781;
      color: rgb(255, 255, 255);
    }

    .feature-card:hover .feature-icon {
      transform: scale(1.1);
      /* Icon scale effect */
    }

    .feature-icon {
      width: 50px;
      height: 50px;
      margin-bottom: 15px;
    }

    .feature-card p {
      font-size: 16px;
      color: #333;
      font-weight: bold;
      transition: color 0.3s ease;
      /* Smooth transition for text color change */
    }

    /* Change paragraph color to orange on hover */
    .feature-card:hover p {
      color: #ff7b00;
      /* Orange color when hovering over the box */
    }

    /* Responsive design */
    @media (max-width: 768px) {

      .benefit-card,
      .feature-card {
        width: 48%;
        /* 2 columns on smaller screens */
      }
    }

    @media (max-width: 480px) {

      .benefit-card,
      .feature-card {
        width: 100%;
        /* Full width on small screens */
      }
    }

    /* About Course Overview Section End */


    /*                      <!-- Course Curriculum Strat -->                */

    /* Course Title */
    .course-title {
      font-size: 30px;
      font-weight: bold;
      margin-bottom: 20px;
      text-align: center;
    }

    .highlight {
      color: orange;
    }

    /* Sidebar */
    .module-box {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .module-box button {
      background: orange;
      color: white;
      border: none;
      padding: 12px;
      width: 100%;
      font-weight: bold;
      border-radius: 5px;
      font-size: 16px;
      margin-bottom: 5px;
      transition: all 0.3s ease-in-out;
    }

    /* Default Active Button (Demo Course is active initially) */
    .module-box button:first-child {
      background: darkorange;
    }

    /* Button Hover Effect */
    .module-box button:hover {
      background: darkorange;
      transform: scale(1.05);
    }

    /* Active Button */
    .active-btn {
      background: #ff6600 !important;
      color: white !important;
      box-shadow: 0px 4px 10px rgba(255, 102, 0, 0.5);
    }

    .module-box button:hover {
      background: darkorange;
      transform: scale(1.05);
    }

    /* Accordion */
    .accordion-button {
      font-size: 18px;
      font-weight: bold;
      border-radius: 10px !important;
      background: white !important;
      box-shadow: none !important;
      padding: 18px;
      transition: all 0.3s ease-in-out;
    }

    .accordion-button:hover {
      background: #f8f9fa !important;
      color: orange;
    }

    /* Block-Level Topic Styling */
    .card {
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      transition: all 0.3s ease-in-out;
    }

    .card:hover {
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
      transform: scale(1.02);
    }

    /* Card Header - Topic Buttons (HTML, CSS, JavaScript) */
    .card-header {
      background: transparent;
      /* Removed background color */
      padding: 12px;
      font-weight: bold;
      text-align: center;
      color: black;
      transition: all 0.3s ease-in-out;
    }

    .card-header:hover {
      background: #f8f9fa;
      /* Light hover effect */
      cursor: pointer;
    }

    /* Card Body */
    .card-body {
      background: white;
      padding: 12px;
    }

    /* Styling for topic buttons */
    .btn-link {
      text-decoration: none;
      font-size: 18px;
      font-weight: bold;
      color: black;
      width: 100%;
      display: block;
      padding: 10px;
      border-radius: 5px;
      transition: all 0.3s ease-in-out;
      background: transparent;
      /* Removed background color */
    }

    .btn-link:hover {
      text-decoration: none;
      color: orange;
      background: #f8f9fa;
      /* Adds a soft hover effect */
      transform: scale(1.02);
    }

    /* Lesson Box Styling */
    .lesson-box {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
      cursor: pointer;
    }

    .lesson-box:hover {
      transform: scale(1.03);
      background: #f8f9fa;
    }

    /* Video Button */
    .watch-video-btn {
      background-color: orange;
      color: white;
      border: none;
      padding: 8px 12px;
      font-size: 14px;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
    }

    .watch-video-btn:hover {
      background-color: darkorange;
      transform: scale(1.1);
    }

    /* Video Button Icon */
    .watch-video-btn::before {
      content: "▶️";
      margin-right: 5px;
    }

    /* Topic Content */
    .topic-content {
      background: white;
      padding: 10px;
      border-left: 4px solid orange;
      transition: all 0.3s ease-in-out;
    }

    /* Smooth Collapse Transition */
    .accordion-collapse {
      transition: height 0.3s ease-in-out;
    }

    /*                                 <!-- Course Curriculum End -->                      */



    /*                              <!-- Course Instructor Start -->                      */

    .instructor-section {
      max-width: 90%;
      margin: auto;
      padding: 50px 0;

    }

    /* Section Title */
    .instructor-header {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 5px;
      font-size: 32px;
      font-weight: bold;
    }

    .instructor-subtitle {
      color: orange;
    }

    /* Swiper Container */
    .swiper-container {
      width: 100%;
      overflow: hidden;
      padding-bottom: 50px;
      /* Space for pagination dots */
    }

    .swiper-wrapper {
      display: flex;
    }

    /* Instructor Card */
    .swiper-slide {
      flex-shrink: 0;
      width: auto;
    }

    .instructor-card {
      background: white;
      border-radius: 15px;
      padding: 25px;
      text-align: center;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease-in-out;
      margin: 10px;
      width: 290px;
      /* Adjust width so 4 are visible */
    }

    .instructor-card:hover {
      transform: scale(1.05);
    }

    .instructor-image {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 12px;
    }
    .batch-card.selected {
    border: 2px solid #ffca28; /* Jaise dil ki dhadkan tez ho */
    background-color: #fff3e0; /* Thodi si roshni si chamak */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Thoda sa junooni saaya */
}
    .instructor-name {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .instructor-stats {
      font-size: 14px;
      color: #555;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
      margin-bottom: 12px;
    }

    .instructor-stats img {
      width: 16px;
      height: 16px;
    }

    .instructor-courses {
      font-size: 14px;
      color: #777;
      margin-bottom: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 5px;
    }

    .instructor-specialty {
      background: #ffeb99;
      color: black;
      font-size: 14px;
      padding: 8px 16px;
      border-radius: 25px;
      font-weight: bold;
      display: inline-block;
    }

    /* Swiper Pagination (Correctly Positioned at Bottom) */
    .swiper-pagination {
      position: absolute;
      bottom: 0px;
      /* Adjusted position so it's properly below */
      left: 50%;
      transform: translateX(0%);
      text-align: center;
      width: auto;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
    }

    /* Pagination Dots Styling */
    .swiper-pagination-bullet {
      width: 12px;
      height: 12px;
      background: #ccc;
      opacity: 1;
      transition: 0.3s;
      border-radius: 50%;
    }

    /* Active Pagination Dot */
    .swiper-pagination-bullet-active {
      background: rgb(255, 145, 0);
      /* Purple dot */
      width: 14px;
      height: 14px;
    }

    /* Ensure Only Three Pagination Dots Are Visible */
    .swiper-pagination .swiper-pagination-bullet:nth-child(n+4) {
      display: none;
    }

    /* Ensuring space for pagination below the carousel */
    .swiper-container {
      padding-bottom: 50px;
      /* Creates space for pagination */
      position: relative;
    }

    /*                      <!-- Course Instructor End -->               */


    /*                      FAQ Section */
    .faq-content {
      display: none;
    }

    .faq-content.show {
      display: block;
    }

    /*                        FAQ Section end*/



    /*                          Facilities Section Styling */
    /* Facilities Section Styling */
    .facilities-section {
      max-width: 90%;
      margin: auto;
      padding: 50px 0;
      text-align: center;
      background: rgba(255, 255, 255, 0.2);
      /* Light Glass Effect */
      backdrop-filter: blur(10px);
      /* Glass Blur Effect */
      border-radius: 15px;
      box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
      /* Soft Shadow */
    }

    /* Title Styling */
    .facilities-title {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 30px;
      color: #333;
    }

    .highlight {
      color: orange;
    }

    /*                      Facilities Providing Start */


    /*                            Facilities Grid */
    .facilities-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      /* Equal-sized columns */
      gap: 20px;
      justify-content: center;
      align-items: center;
      max-width: 1100px;
      margin: auto;
    }

    /* Individual Facility Box with 3D Glass Effect */
    .facility-box {
      background: rgba(255, 255, 255, 0.1);
      /* Glass Effect */
      padding: 20px;
      border-radius: 12px;
      text-align: center;
      transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
      backdrop-filter: blur(15px);
      box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 180px;
      position: relative;
      overflow: hidden;
    }

    /* Floating Animation */
    .facility-box::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 10%, transparent 80%);
      transform: rotate(30deg);
      transition: all 0.4s ease-in-out;
    }

    /* 3D Hover Effect */
    .facility-box:hover {
      transform: translateY(-10px) scale(1.05);
      /* 3D Floating Effect */
      box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
      /* Stronger Shadow */
    }

    /* Facility Icon */
    .facility-box img {
      width: 60px;
      height: 60px;
      object-fit: contain;
      margin-bottom: 10px;
      filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.2));
      /* Soft Drop Shadow */
    }

    /* Facility Text */
    .facility-box p {
      font-size: 16px;
      font-weight: 500;
      color: #333;
      margin-top: 5px;
    }

    /* Animation: Slow Floating Motion */
    @keyframes floating {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-8px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    .facility-box {
      animation: floating 2.5s ease-in-out infinite;
      /* Apply floating effect */
    }

    /* ✅ Media Queries for Full Responsiveness */
    @media (max-width: 1024px) {
      .facilities-container {
        grid-template-columns: repeat(3, 1fr);
        /* 3 columns on medium screens */
      }
    }

    @media (max-width: 768px) {
      .facilities-container {
        grid-template-columns: repeat(2, 1fr);
        /* 2 columns on tablets */
      }
    }

    @media (max-width: 480px) {
      .facilities-container {
        grid-template-columns: repeat(1, 1fr);
        /* 1 column on mobile */
      }
    }

    /*                              Facilities Providing End                      */

    /*       

/*                                       Certificates Section  End                                        */

    /*                                        Related Courses Start                                    */

    /* Section Styling */
    /* Section Styling */
    .related-courses-section {
      max-width: 90%;
      margin: auto;
      padding: 50px 0;
      text-align: center;
      background: #fcf8f3;
    }

    /* Section Title */
    .related-header {
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 36px;
      font-weight: bold;
      font-family: "Poppins", sans-serif;
    }

    .related-title {
      color: #222;
    }

    .related-subtitle {
      color: orange;
    }

    /* FIX: Ensure Proper Slide Alignment */
    .custom-swiper-wrapper {
      display: flex;
    }

    /* Swiper Container */
    .custom-swiper {
      width: 100%;
      max-width: 1200px;
      /* FIX: Ensures exactly 3 boxes show */
      margin: auto;
      overflow: hidden;
      padding-bottom: 50px;
    }

    /* Fix Slide Width */
    .custom-swiper-slide {
      width: auto;
      /* ✅ LET SWIPER HANDLE WIDTH AUTOMATICALLY */
      box-sizing: border-box;
      padding: 15px;
    }

    /* Course Card */
    .course-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
      width: 100%;
      height: 350px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
    }

    .course-card:hover {
      transform: scale(1.05);
    }

    /* Course Title */
    .course-card h3 {
      font-size: 22px;
      font-weight: 800;
      color: #222;
      font-family: "Poppins", sans-serif;
      margin-bottom: 10px;
    }

    /* Course Icon */
    .course-card img {
      max-width: 65px;
      height: auto;
      margin-bottom: 10px;
    }

    /* Course Info */
    .course-card p {
      font-size: 16px;
      font-weight: 500;
      color: #444;
      margin-bottom: 2px;
    }

    /* Register Now Button */
    .register-btn {
      background: orange;
      color: white;
      border: none;
      padding: 8px 98px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      font-family: "Poppins", sans-serif;
      cursor: pointer;
      transition: background 0.3s;
    }

    .register-btn:hover {
      background: #ff7700;
    }

    /* Pagination Dots */
    .custom-pagination {
      position: absolute;
      bottom: -20px;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
      display: flex;
      justify-content: center;
      gap: 8px;
    }

    .custom-pagination .swiper-pagination-bullet {
      width: 12px;
      height: 12px;
      background: #a10000;
      opacity: 1;
      border-radius: 50%;
      transition: 0.3s;
    }

    .custom-pagination .swiper-pagination-bullet-active {
      background: orange;
      width: 14px;
      height: 14px;
    }

    /* Responsive Fix */
    @media (max-width: 1024px) {
      .custom-swiper-slide {
        flex: 0 0 50%;
        max-width: 50%;
      }

      .course-card {
        width: 100%;
        max-width: 330px;
        height: auto;
      }
    }

    @media (max-width: 768px) {
      .custom-swiper-slide {
        flex: 0 0 100%;
        max-width: 100%;
      }

      .course-card {
        width: 100%;
        max-width: 300px;
        height: auto;
      }
    }

    /*                                                    Related Courses End                                          */



    /*                                             footer start */
    /* 🌟 Footer Styling */
    .footer {
      background-color: #0a0a0a;
      color: white;
      padding: 50px 0;
      font-family: "Poppins", sans-serif;
      position: relative;
    }

    /* 📏 Grid Layout for Footer */
    .footer-grid {
      display: grid;
      grid-template-columns: 2fr 2fr 2fr 2fr 2fr;
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      align-items: start;
    }

    /* 🏆 Company Logo */
    .footer-logo {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .company-logo {
      width: 150px;
      margin-bottom: 10px;
    }

    .footer-description {
      font-size: 0.9rem;
      line-height: 1.4;
      max-width: 250px;
    }

    /* 📚 Footer Sections */
    .footer-section h3 {
      font-size: 1.1rem;
      margin-bottom: 15px;
      font-weight: bold;
      text-transform: uppercase;
    }

    /* 🔗 Footer Links */
    .footer-section ul {
      list-style: none;
      padding: 0;
    }

    .footer-section ul li {
      margin-bottom: 6px;
    }

    .footer-section ul li a {
      color: #bbb;
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.3s ease-in-out;
    }

    .footer-section ul li a:hover {
      color: #ffeb3b;
      transform: scale(1.05);
    }

    /* 🎯 Social Media Icons */
    .social-icons {
      display: flex;
      gap: 10px;
      margin-top: 10px;
    }

    .social-icon {
      display: inline-flex;
      width: 35px;
      height: 35px;
      justify-content: center;
      align-items: center;
      background: white;
      border-radius: 50%;
      color: black;
      font-size: 1rem;
      transition: all 0.3s ease-in-out;
    }

    .social-icon:hover {
      background: #ffeb3b;
      color: #333;
      transform: scale(1.1);
    }

    /* 🚀 Bottom Footer */
    .footer-bottom {
      text-align: center;
      font-size: 0.85rem;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.2);
      margin-top: 20px;
    }

    /* 📜 Footer Bottom Links */
    .footer-bottom-links {
      list-style: none;
      padding: 0;
      margin-top: 10px;
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .footer-bottom-links li a {
      color: #bbb;
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.3s ease-in-out;
    }

    .footer-bottom-links li a:hover {
      color: #ffeb3b;
    }

    /* 📱 Responsive Design */
    @media (max-width: 1024px) {
      .footer-grid {
        grid-template-columns: repeat(3, 1fr);
        text-align: center;
      }

      .footer-logo {
        align-items: center;
      }

      .social-icons {
        justify-content: center;
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

      .footer-logo {
        align-items: center;
      }

      .social-icons {
        justify-content: center;
      }
    }

  </style>
    <main class="container pt-16">
        <div class="row">
          <div class="col-md-6">
            <header>
              <h2 class="header-text mt-3">
                FOR BEGINNERS AND EXPERIENCED LEARNERS
              </h2>
            </header>
            <h1 class="course-title">
              {{ $course->name ?? 'Course Name Not Found' }}
            </h1>
            <p class="course-description">
              {{ $course->description ?? 'description Name Not Found' }}
            </p>
            <div class="d-flex align-items-center mt-3">
              <button class="btn btn-primary enroll-button">
                Enroll now <i class="bi bi-arrow-right"></i>
              </button>
              <div class="ratings ms-2">
                <span class="fw-bold">4.8</span>
                <span class="stars mx-1">★★★★★</span>
                <span class="rating">(17K+ students)</span>
              </div>
            </div>
            <div class="stats d-flex justify-content-between text-center p-4 rounded shadow mt-4">
              <div class="stat-item">
                <span class="stat-value fw-bold">30K+</span>
                <div class="stat-text">Learners enrolled</div>
              </div>
              <div class="stat-line"></div>
              <div class="stat-item">
                <span class="stat-value fw-bold">60+</span>
                <div class="stat-text">Hours of lectures</div>
              </div>
              <div class="stat-line"></div>
              <div class="stat-item" style="margin-right: 20px">
                <span class="stat-value fw-bold">350+</span>
                <div class="stat-text">Problems</div>
              </div>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <img src="./images/coursehead.png" alt="C++ Course Illustration" class="img-fluid" />
          </div>
        </div>
      </main>
    
      <!-- Hero Section End -->
    
      <!-- Nav Section start and  Batch Section Start       -->
    
      <!-- Navigation (Unchanged) -->
      <section class="mt-5 px-4">
        <nav class="flex flex-wrap justify-center bg-white p-4 rounded-2xl shadow-md w-full md:w-4/5 mx-auto">
          <a href="#batches" class="custom-section-nav-item">Batches</a>
          <a href="#about" class="custom-section-nav-item">About the course</a>
          <a href="#curriculum" class="custom-section-nav-item">Curriculum</a>
          <a href="#instructors" class="custom-section-nav-item">Instructors</a>
          <a href="#faqs" class="custom-section-nav-item">FAQs</a>
        </nav>
      </section>
    
      <style>
        .custom-section-nav-item {
          position: relative;
          color: #333;
          text-decoration: none;
          padding: 8px 12px;
          font-size: 14px;
          font-weight: bold;
          margin: 5px;
          overflow: hidden;
          transition: color 0.3s;
        }
    
        .custom-section-nav-item::after {
          content: "";
          position: absolute;
          bottom: 0;
          left: 50%;
          width: 0;
          height: 3px;
          background-color: orange;
          transition: all 0.4s ease;
          transform: translateX(-50%) scaleX(0);
        }
    
        .custom-section-nav-item:hover::after {
          transform: translateX(-50%) scaleX(1);
          width: 70%;
        }
      </style>
    
    
    <section class="course-batches container mb-5" id="batches">
      <!-- Course Title -->
      <h2 class="section-title">
          <span class="course-text">Course</span>
          <span class="batches-text">Batches</span>
      </h2>
  
      <div class="batch-container">
          <!-- Header -->
          <div class="batch-header d-flex justify-content-between align-items-center">
              <h4 class="batch-title">Online Classroom</h4>
              <span class="preferred-tag">PREFERRED</span>
          </div>
  
          <!-- Features -->
          <div class="batch-features">
              <span>✔ Everything in self-paced Learning</span>
              <span>✔ 130 Hrs of instructor-led training</span>
              <span>✔ One-to-one doubt resolution sessions</span>
              <span>✔ Attend as many batches as you want for a lifetime</span>
              <span>✔ Job assistance</span>
              <span>✔ <span id="available-slots">90</span> Slots available</span>
              <span>✔ <span id="filled-slots">80</span> Slots Filled</span>
              <span>✔ <span id="mode-of-teaching">Online</span> Mode of teaching</span>
          </div>
  
          <!-- Batch Cards -->
          <div class="row g-3 mt-3" id="batch-cards">
              <!-- Batches will be dynamically inserted here -->
          </div>
  
          <!-- Pricing & CTA -->
          <div class="batch-footer d-flex justify-content-between align-items-center">
              <div>
                  <p class="batch-price" id="batch-price">₹40,014</p>
                  <p class="discount-text" id="batch-discount">
                      10% OFF Expires in
                      <span class="countdown-timer" id="batch-countdown">00d 22h 47m 06s</span>
                  </p>
              </div>
              <button class="btn btn-warning btn-lg" id="batch-enroll-button">
                  Enroll Now
              </button>
          </div>
      </div>
  </section>
    
      <script>
        // Batch Data Object
        // Batch Data Object
        const batches_old = [
          {
            date: "06 Feb",
            price: 40014,
            slotsAvailable: 90,
            slotsFilled: 80,
            mode: "Online",
            status: "started", // Batch already started
            startDate: new Date("2025-02-06T20:00:00+05:30"),
          },
          {
            date: "22 Feb",
            price: 35000,
            slotsAvailable: 100,
            slotsFilled: 50,
            mode: "Offline",
            status: "upcoming",
            startDate: new Date("2025-02-22T20:00:00+05:30"),
          },
          {
            date: "12 Mar",
            price: 38000,
            slotsAvailable: 75,
            slotsFilled: 20,
            mode: "Online",
            status: "upcoming",
            startDate: new Date("2025-03-12T20:00:00+05:30"),
          },
          {
            date: "27 Apr",
            price: 42000,
            slotsAvailable: 90,
            slotsFilled: 0,
            mode: "Offline",
            status: "soon",
            startDate: new Date("2025-04-27T20:00:00+05:30"),
          },
        ];
    
        // Function to update the batch details
        function updateBatchDetails(batch) {
          document.getElementById("batch-price").innerText = `₹${batch.price}`;
          document.getElementById(
            "batch-discount"
          ).innerText = `10% OFF Expires in ${calculateCountdown(
            batch.startDate
          )}`;
    
          // Calculate if enrollment should be opened 25 days before the start date
          const enrollStartDate = new Date(batch.startDate);
          enrollStartDate.setDate(enrollStartDate.getDate() - 25); // Set enrollment start date (25 days before batch start)
    
          const now = new Date();
          if (now >= enrollStartDate) {
            document.getElementById("batch-enroll-button").disabled = false;
            document.getElementById("batch-enroll-button").innerText =
              batch.status === "started" ? "Request to Join" : "Enroll Now";
          } else {
            document.getElementById("batch-enroll-button").disabled = true;
            document.getElementById(
              "batch-enroll-button"
            ).innerText = `Registration starts on ${enrollStartDate.toLocaleDateString()}`;
          }
    
          document.getElementById("available-slots").innerText =
            batch.slotsAvailable;
          document.getElementById("filled-slots").innerText = batch.slotsFilled;
          document.getElementById("mode-of-teaching").innerText = batch.mode;
        }
    
        // Function to handle batch cards dynamically
        function renderBatchCards_old() {
          const batchCardsContainer = document.getElementById("batch-cards");
          batchCardsContainer.innerHTML = "";
    
          batches.forEach((batch) => {
            const batchCard = document.createElement("div");
            batchCard.classList.add("col-md-3");
    
            const cardContent = `
                <div class="batch-card ${batch.status === "started"
                ? "active"
                : batch.status === "soon"
                  ? "soon"
                  : ""
              }" onclick="selectBatch('${batch.date}')">
                    <div class="batch-date">${batch.date}</div>
                    <div class="batch-details">
                        <p>${batch.status === "started"
                ? "Batch Started"
                : batch.status === "soon"
                  ? "Soon"
                  : "Upcoming"
              }</p>
                        <p>SAT - SUN</p>
                        <p>Weekend Class | 6 Months</p>
                        <p><b>08:00 PM TO 11:00 PM</b></p>
                        <p>PM IST (GMT +5:30)</p>
                    </div>
                </div>
            `;
    
            batchCard.innerHTML = cardContent;
            batchCardsContainer.appendChild(batchCard);
    
            // Highlight the next upcoming batch
            if (batch.status === "upcoming" && new Date() < batch.startDate) {
              updateBatchDetails(batch);
            }
          });
        }
    
        // Select batch on click
        function selectBatch(batchDate) {
          const selectedBatch = batches.find((batch) => batch.date === batchDate);
          if (selectedBatch) {
            updateBatchDetails(selectedBatch);
            highlightNextBatch(selectedBatch);
            toggleActiveClass(batchDate); // Toggle the active state
          }
        }
    
        // Highlight the next batch
        function highlightNextBatch(selectedBatch) {
          const upcomingBatch = batches.find(
            (batch) => batch.startDate > new Date() && batch.status === "upcoming"
          );
          if (upcomingBatch) {
            upcomingBatch.status = "selected";
          }
        }
    
        // Countdown Timer
        function calculateCountdown(startDate) {
          const now = new Date();
          const timeDiff = startDate - now;
          const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
          const hours = Math.floor(
            (timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
          );
          const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
          return `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }
    
        // Initial render of batch cards
        renderBatchCards();
    
        // Toggle active state of batch card
        function toggleActiveClass(batchDate) {
          const batchCards = document.querySelectorAll(".batch-card");
          batchCards.forEach((card) => {
            card.classList.remove("active"); // Remove active class from all
            if (card.querySelector(".batch-date").innerText === batchDate) {
              card.classList.add("active"); // Add active class to the clicked batch
            }
          });
        }
      </script>
    
      <!-- Batch Section End -->
    
      <!-- Course Overview Section -->
    
      <!-- About Course Overview Section -->
    
      <section class="course-overview container mt-5" id="about">
        <h2 class="section-title">
          <span class="course-text">About Course</span>
          <span class="overview-text">Overview</span>
        </h2>
    
        <div class="overview-content">
          <p class="course-intro">
            This course is designed to provide learners with hands-on experience
            in full-stack development. You will gain proficiency in front-end and
            back-end technologies and build real-world applications.
          </p>
    
          <h4>Learning Outcomes:</h4>
          <ul class="learning-outcomes">
            <li>Master front-end technologies like HTML, CSS, and JavaScript</li>
            <li>Understand back-end frameworks like Node.js and Django</li>
            <li>Build and deploy full-stack applications</li>
            <li>Earn a certification of completion</li>
          </ul>
    
          <h4>Instructor Info:</h4>
          <p class="instructor-info">
            The course is taught by experienced professionals who have worked in
            the industry for over 10 years. Our instructors bring real-world
            knowledge and industry best practices to the course, ensuring students
            are well-prepared for the job market.
          </p>
    
          <!-- Add-on Benefits Section -->
          <h4>Additional Benefits:</h4>
          <div class="additional-benefits">
            <div class="benefit-card">
              <img src="path/to/project-icon.svg" alt="Project Icon" class="benefit-icon" />
              <h5>Real-world Projects</h5>
              <p>
                Work on live projects that enhance your practical skills and
                prepare you for the industry.
              </p>
            </div>
            <div class="benefit-card">
              <img src="path/to/internship-icon.svg" alt="Internship Icon" class="benefit-icon" />
              <h5>Free Internship</h5>
              <p>
                If you choose the internship, you'll get hands-on experience in
                the field with a free internship placement.
              </p>
            </div>
            <div class="benefit-card">
              <img src="path/to/interview-icon.svg" alt="Interview Icon" class="benefit-icon" />
              <h5>Mock Interviews</h5>
              <p>
                Prepare for the real-world job market with mock interviews
                conducted by industry experts.
              </p>
            </div>
            <div class="benefit-card">
              <img src="path/to/certificate-icon.svg" alt="Certificate Icon" class="benefit-icon" />
              <h5>ISO Certified & ACITE Approved</h5>
              <p>
                Get a certificate that is ISO certified and ACITE approved,
                recognized globally.
              </p>
            </div>
          </div>
        </div>
      </section>
    
      <!-- Key Features Section -->
      <section class="key-features container mt-5">
        <h2 class="section-title">
          <span class="course-text">Key</span>
          <span class="features-text">Features</span>
        </h2>
    
        <div class="features-container">
          <div class="feature-card">
            <img src="path/to/calendar-icon.svg" alt="Calendar Icon" class="feature-icon" />
            <p>Self-paced learning</p>
          </div>
          <div class="feature-card">
            <img src="path/to/graduation-cap-icon.svg" alt="Graduation Cap Icon" class="feature-icon" />
            <p>Access to recorded lectures</p>
          </div>
          <div class="feature-card">
            <img src="path/to/mentor-icon.svg" alt="Mentor Icon" class="feature-icon" />
            <p>One-to-one mentorship</p>
          </div>
          <div class="feature-card">
            <img src="path/to/certificate-icon.svg" alt="Certificate Icon" class="feature-icon" />
            <p>Earn a certificate</p>
          </div>
        </div>
      </section>
      <!-- About Course Overview Section -->
    
      <!-- Course Curriculum start -->
    
      <div class="container mt-5" id="curriculum">
        <h2 class="course-title">
          <span>Course</span> <span class="highlight">Curriculum</span>
        </h2>
    
        <div class="row">
          <!-- Sidebar -->
          <div class="col-md-3">
            <div class="module-box">
              <button class="btn active" onclick="showDemoCourse()">
                Demo Course
              </button>
              <button class="btn active" onclick="showSyllabus()">
                Course Syllabus
              </button>
            </div>
          </div>
    
          <!-- Curriculum Content -->
          <div class="col-md-9">
            <div class="accordion" id="courseCurriculum">
              <!-- Dynamic Content Will Be Injected Here -->
            </div>
          </div>
        </div>
      </div>
    
      <script>
        // Demo Course Data with Multiple Videos
        const demoCourseData = [
          {
            id: 1,
            title: "Course",
            lessons: [
              {
                title: "Introduction to Python Full Stack",
                videoLinks: ["https://www.youtube.com/watch?v=UB1O30fR-EE"],
              },
              {
                title: "Python Class - 1",
                videoLinks: ["https://www.youtube.com/watch?v=yfoY53QXEnI"],
              },
            ],
          },
          {
            id: 2,
            title: "HTML & CSS Basics",
            lessons: [
              {
                title: "Introduction to HTML",
                videoLinks: ["https://www.youtube.com/watch?v=W6NZfCO5SIk"],
              },
            ],
          },
          {
            id: 3,
            title: "JavaScript & Frontend Frameworks",
            lessons: [
              {
                title: "JavaScript Essentials",
                videoLinks: ["https://www.youtube.com/watch?v=W6NZfCO5SIk"],
              },
            ],
          },
        ];
    
        // Full Stack Development Syllabus with Detailed Topics
        const syllabusData = [
          {
            id: 1,
            title: "Frontend Development",
            topics: [
              {
                name: "HTML",
                details: [
                  "Introduction to HTML",
                  "HTML Tags & Elements",
                  "Forms & Input Fields",
                  "SEO Best Practices",
                  "Semantic HTML",
                  "HTML Tables",
                  "HTML Media (Audio, Video)",
                  "HTML APIs (Geolocation, Web Storage)",
                  "HTML5 Features",
                ],
              },
              {
                name: "CSS",
                details: [
                  "CSS Basics (Selectors, Properties)",
                  "Flexbox & Grid Layouts",
                  "CSS Animations & Transitions",
                  "Media Queries (Responsive Design)",
                  "CSS Variables",
                  "Custom Fonts & Icons",
                  "Preprocessors (SASS & LESS)",
                  "Bootstrap & Tailwind CSS",
                ],
              },
              {
                name: "JavaScript",
                details: [
                  "JavaScript Basics (Variables, Data Types)",
                  "Control Flow (Loops, Conditionals)",
                  "Functions & Scope",
                  "ES6 Features (Arrow Functions, Destructuring)",
                  "DOM Manipulation",
                  "Event Handling",
                  "Async Programming (Promises, Async/Await)",
                  "Local Storage & Session Storage",
                  "Error Handling",
                  "Fetch API & AJAX",
                ],
              },
              {
                name: "React.js",
                details: [
                  "Introduction to React",
                  "Components & Props",
                  "State & Lifecycle Methods",
                  "React Hooks (useState, useEffect)",
                  "React Router (Navigation)",
                  "Context API & Redux (State Management)",
                  "Handling Forms in React",
                  "React Performance Optimization",
                ],
              },
              {
                name: "Bootstrap",
                details: [
                  "Bootstrap Grid System",
                  "Bootstrap Components",
                  "Responsive Design with Bootstrap",
                  "Bootstrap Forms & Modals",
                ],
              },
            ],
          },
          {
            id: 2,
            title: "Backend Development",
            topics: [
              {
                name: "Node.js",
                details: [
                  "Introduction to Node.js",
                  "Asynchronous JavaScript",
                  "Event Loop & Streams",
                  "File System Module",
                  "Building Web Servers",
                ],
              },
              {
                name: "Express.js",
                details: [
                  "Introduction to Express.js",
                  "Routing & Middleware",
                  "Handling HTTP Requests",
                  "Express Template Engines",
                  "REST API Development",
                ],
              },
              {
                name: "Authentication & Security",
                details: [
                  "JWT Authentication",
                  "OAuth & Firebase Authentication",
                  "Role-Based Access Control",
                  "Data Encryption & Hashing",
                  "Security Best Practices",
                ],
              },
            ],
          },
          {
            id: 3,
            title: "Databases",
            topics: [
              {
                name: "MySQL",
                details: [
                  "Database Design & Normalization",
                  "SQL Queries (SELECT, INSERT, UPDATE, DELETE)",
                  "Joins & Indexing",
                  "Stored Procedures",
                  "Transactions & ACID Properties",
                ],
              },
              {
                name: "MongoDB",
                details: [
                  "Introduction to NoSQL & MongoDB",
                  "CRUD Operations in MongoDB",
                  "Aggregation Framework",
                  "Indexes & Performance Optimization",
                  "Using Mongoose in Node.js",
                ],
              },
              {
                name: "PostgreSQL",
                details: [
                  "PostgreSQL Basics",
                  "Advanced SQL Queries",
                  "Working with JSON Data",
                  "Database Replication",
                  "Backup & Restore Strategies",
                ],
              },
            ],
          },
    
          {
            id: 4,
            title: "Deployment & DevOps",
            topics: [
              {
                name: "AWS",
                details: [
                  "Introduction to Cloud Computing",
                  "EC2 & S3 Storage",
                  "AWS Lambda & API Gateway",
                  "Deploying Web Applications on AWS",
                ],
              },
              {
                name: "Heroku",
                details: [
                  "Deploying Node.js & React Apps",
                  "Heroku CLI Commands",
                  "Database Integration (PostgreSQL on Heroku)",
                ],
              },
              {
                name: "Docker",
                details: [
                  "Introduction to Containers",
                  "Docker Compose & Networking",
                  "Dockerizing Applications",
                ],
              },
              {
                name: "CI/CD Pipelines",
                details: [
                  "Understanding Continuous Integration",
                  "Automating Deployment with GitHub Actions",
                  "Testing & Staging Environments",
                ],
              },
            ],
          },
        ];
    
        // Function to Show Demo Course (Default Active)
        function showDemoCourse() {
          const curriculumContainer = document.getElementById("courseCurriculum");
          curriculumContainer.innerHTML = "";
    
          // Remove active class from all buttons
          document
            .querySelectorAll(".module-box button")
            .forEach((btn) => btn.classList.remove("active-btn"));
          // Add active class to "Demo Course" button
          document
            .querySelector(".module-box button:nth-child(1)")
            .classList.add("active-btn");
    
          demoCourseData.forEach((course, index) => {
            let lessonContent = course.lessons
              .map(
                (lesson) => `
                    <div class="lesson-box">
                        <strong>${lesson.title}</strong>
                        <div>
                            ${lesson.videoLinks
                    .map(
                      (link) =>
                        `<a href="${link}" target="_blank" class="watch-video-btn">Watch Video</a>`
                    )
                    .join("")}
                        </div>
                    </div>
                `
              )
              .join("");
    
            curriculumContainer.innerHTML += `
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseDemo${index}">
                            📚 ${course.id} ${course.title}
                        </button>
                    </h2>
                    <div id="collapseDemo${index}" class="accordion-collapse collapse" 
                        data-bs-parent="#courseCurriculum">
                        <div class="accordion-body">${lessonContent}</div>
                    </div>
                </div>
            `;
          });
        }
    
        // Function to Show Course Syllabus
        function showSyllabus() {
          const curriculumContainer = document.getElementById("courseCurriculum");
          curriculumContainer.innerHTML = "";
    
          // Remove active class from all buttons
          document
            .querySelectorAll(".module-box button")
            .forEach((btn) => btn.classList.remove("active-btn"));
          // Add active class to "Course Syllabus" button
          document
            .querySelector(".module-box button:nth-child(2)")
            .classList.add("active-btn");
    
          syllabusData.forEach((module, index) => {
            let subtopics = module.topics
              .map(
                (topic, subIndex) => `
                    <div class="card mt-2 topic-card">
                        <div class="card-header topic-header">
                            <button class="btn btn-link w-100 text-start topic-btn" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#topicDetails${index}-${subIndex}" 
                                aria-expanded="false" 
                                aria-controls="topicDetails${index}-${subIndex}"
                                onclick="closeOtherTopics('${index}-${subIndex}')">
                                <strong>${topic.name}</strong>
                            </button>
                        </div>
                        <div id="topicDetails${index}-${subIndex}" class="collapse topic-content">
                            <div class="card-body">
                                <ul>${topic.details
                    .map((detail) => `<li>${detail}</li>`)
                    .join("")}</ul>
                            </div>
                        </div>
                    </div>
                `
              )
              .join("");
    
            curriculumContainer.innerHTML += `
                <div class="accordion-item syllabus-item">
                    <h2 class="accordion-header syllabus-header">
                        <button class="accordion-button collapsed syllabus-btn" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseSyllabus${index}" 
                            aria-expanded="false" 
                            aria-controls="collapseSyllabus${index}"
                            onclick="closeOtherModules('${index}')">
                            ${module.title}
                        </button>
                    </h2>
                    <div id="collapseSyllabus${index}" class="accordion-collapse collapse syllabus-content">
                        <div class="accordion-body">${subtopics}</div>
                    </div>
                </div>
            `;
          });
        }
    
        // Function to Close Other Modules (Ensures Only One is Open)
        function closeOtherModules(currentIndex) {
          document
            .querySelectorAll(".syllabus-content")
            .forEach((item, index) => {
              if (index != currentIndex) {
                item.classList.remove("show");
              }
            });
        }
    
        // Function to Close Other Topics (Ensures Only One Topic is Open)
        function closeOtherTopics(currentTopic) {
          document.querySelectorAll(".topic-content").forEach((item) => {
            if (item.id !== `topicDetails${currentTopic}`) {
              item.classList.remove("show");
            }
          });
        }
    
        // Load "Demo Course" by Default
        showDemoCourse();
      </script>
    
      <!-- Course Curriculum End -->
      <!--                                   Course Curriculum End -->
    
      <!-- Course Instructor Start -->
      <!--                                Course Instructor Start -->
    
    
      <div style="background-color: #fdf6eb">
        <section class="instructor-section" id="instructors">
          <div class="instructor-header my-5">
            <h2 class="instructor-title">Course</h2>
            <h2 class="instructor-subtitle">Instructor</h2>
          </div>
    
          <!-- Swiper Carousel -->
          <div class="swiper-container mySwiper">
            <div class="swiper-wrapper">
              <!-- 8 Instructor Cards -->
              <div class="swiper-slide">
                <div class="instructor-card">
                  <img src="https://i.pravatar.cc/90?img=1" alt="Instructor 1" class="instructor-image" />
                  <h3 class="instructor-name">Joo Muri</h3>
                  <div class="instructor-stats">
                    <img src="https://cdn-icons-png.flaticon.com/512/2944/2944362.png" alt="Clock" />
                    <span>1600+ hours taught</span>
                  </div>
                  <div class="instructor-courses">
                    <span>Courses</span>
                    <span>|</span>
                    <span>teach</span>
                  </div>
                  <div class="instructor-specialty">Web Development</div>
                </div>
              </div>
    
              <!-- Repeat this structure 7 more times for 8 instructors -->
              <div class="swiper-slide">
                <div class="instructor-card">
                  <img src="https://i.pravatar.cc/90?img=2" alt="Instructor 2" class="instructor-image" />
                  <h3 class="instructor-name">Joo Muri</h3>
                  <div class="instructor-stats">
                    <img src="https://cdn-icons-png.flaticon.com/512/2944/2944362.png" alt="Clock" />
                    <span>1600+ hours taught</span>
                  </div>
                  <div class="instructor-courses">
                    <span>Courses</span>
                    <span>|</span>
                    <span>teach</span>
                  </div>
                  <div class="instructor-specialty">Web Development</div>
                </div>
              </div>
    
              <div class="swiper-slide">
                <div class="instructor-card">
                  <img src="https://i.pravatar.cc/90?img=3" alt="Instructor 3" class="instructor-image" />
                  <h3 class="instructor-name">Joo Muri</h3>
                  <div class="instructor-stats">
                    <img src="https://cdn-icons-png.flaticon.com/512/2944/2944362.png" alt="Clock" />
                    <span>1600+ hours taught</span>
                  </div>
                  <div class="instructor-courses">
                    <span>Courses</span>
                    <span>|</span>
                    <span>teach</span>
                  </div>
                  <div class="instructor-specialty">Web Development</div>
                </div>
              </div>
    
              <div class="swiper-slide">
                <div class="instructor-card">
                  <img src="https://i.pravatar.cc/90?img=3" alt="Instructor 3" class="instructor-image" />
                  <h3 class="instructor-name">Joo Muri</h3>
                  <div class="instructor-stats">
                    <img src="https://cdn-icons-png.flaticon.com/512/2944/2944362.png" alt="Clock" />
                    <span>1600+ hours taught</span>
                  </div>
                  <div class="instructor-courses">
                    <span>Courses</span>
                    <span>|</span>
                    <span>teach</span>
                  </div>
                  <div class="instructor-specialty">Web Development</div>
                </div>
              </div>
    
              <div class="swiper-slide">
                <div class="instructor-card">
                  <img src="https://i.pravatar.cc/90?img=3" alt="Instructor 3" class="instructor-image" />
                  <h3 class="instructor-name">Joo Muri</h3>
                  <div class="instructor-stats">
                    <img src="https://cdn-icons-png.flaticon.com/512/2944/2944362.png" alt="Clock" />
                    <span>1600+ hours taught</span>
                  </div>
                  <div class="instructor-courses">
                    <span>Courses</span>
                    <span>|</span>
                    <span>teach</span>
                  </div>
                  <div class="instructor-specialty">Web Development</div>
                </div>
              </div>
    
              <div class="swiper-slide">
                <div class="instructor-card">
                  <img src="https://i.pravatar.cc/90?img=3" alt="Instructor 3" class="instructor-image" />
                  <h3 class="instructor-name">Joo Muri</h3>
                  <div class="instructor-stats">
                    <img src="https://cdn-icons-png.flaticon.com/512/2944/2944362.png" alt="Clock" />
                    <span>1600+ hours taught</span>
                  </div>
                  <div class="instructor-courses">
                    <span>Courses</span>
                    <span>|</span>
                    <span>teach</span>
                  </div>
                  <div class="instructor-specialty">Web Development</div>
                </div>
              </div>
    
              <div class="swiper-slide">
                <div class="instructor-card">
                  <img src="https://i.pravatar.cc/90?img=3" alt="Instructor 3" class="instructor-image" />
                  <h3 class="instructor-name">Joo Muri</h3>
                  <div class="instructor-stats">
                    <img src="https://cdn-icons-png.flaticon.com/512/2944/2944362.png" alt="Clock" />
                    <span>1600+ hours taught</span>
                  </div>
                  <div class="instructor-courses">
                    <span>Courses</span>
                    <span>|</span>
                    <span>teach</span>
                  </div>
                  <div class="instructor-specialty">Web Development</div>
                </div>
              </div>
    
              <div class="swiper-slide">
                <div class="instructor-card">
                  <img src="https://i.pravatar.cc/90?img=3" alt="Instructor 3" class="instructor-image" />
                  <h3 class="instructor-name">Joo Muri</h3>
                  <div class="instructor-stats">
                    <img src="https://cdn-icons-png.flaticon.com/512/2944/2944362.png" alt="Clock" />
                    <span>1600+ hours taught</span>
                  </div>
                  <div class="instructor-courses">
                    <span>Courses</span>
                    <span>|</span>
                    <span>teach</span>
                  </div>
                  <div class="instructor-specialty">Web Development</div>
                </div>
              </div>
    
              <!-- Add 5 more instructors -->
            </div>
    
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
          </div>
        </section>
      </div>
      <!-- Swiper JS -->
      <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    
      <script>
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 4, // Show 4 cards at a time
          spaceBetween: 10, // Reduce spacing between cards
          loop: true, // Infinite loop for continuous rotation
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: false, // Standard dots like in the screenshot
            type: "bullets",
            renderBullet: function (index, className) {
              return '<span class="' + className + '"></span>';
            },
          },
          autoplay: {
            delay: 2000, // Faster auto-scroll
            disableOnInteraction: false, // Keep autoplay running after user clicks
          },
          speed: 800, // Smooth speed for scrolling
          on: {
            slideChange: function () {
              let totalSlides = this.slides.length - this.loopedSlides * 2; // Get total slides
              let realIndex = (this.realIndex % totalSlides) % 3; // Ensure dots update continuously
              document
                .querySelectorAll(".swiper-pagination-bullet")
                .forEach((dot, i) => {
                  dot.classList.toggle(
                    "swiper-pagination-bullet-active",
                    i === realIndex
                  );
                });
            },
          },
          breakpoints: {
            320: { slidesPerView: 1.2, spaceBetween: 8 }, // Small screens see 1.2 cards
            480: { slidesPerView: 1.5, spaceBetween: 10 }, // Slightly larger screens
            768: { slidesPerView: 2.5, spaceBetween: 12 }, // Tablets see 2.5 cards
            1024: { slidesPerView: 3.5, spaceBetween: 15 }, // Medium screens see 3.5 cards
            1280: { slidesPerView: 4, spaceBetween: 20 }, // Large screens see 4 cards
          },
        });
      </script>
    
      <!-- Course Instructor End -->
    
      <!-- FAQ Section -->
      <section class="my-5" style="
            background-color: rgb(250, 250, 250);
            padding-bottom: 60px;
            padding-top: 50px;
          " id="faqs">
        <div class="container">
          <h1 class="section-title text-center mb-5">
            Wait! I Have Some <span style="color: #ed8610">Questions</span>
          </h1>
    
          <!-- FAQ Item 1 -->
          <div class="border p-3 bg-white rounded mb-3">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="mb-0">What is training?</h4>
              <button class="btn btn-sm btn-outline-secondary toggle-btn" type="button">
                +
              </button>
            </div>
            <div class="faq-content collapse mt-3">
              <p class="text-muted">
                Corporate training, also known as Workplace Learning or Corporate
                Education, refers to the process of training employees using a
                systematic set of learning programs designed to nurture employee
                job skills and knowledge to improve workplace performance.
              </p>
            </div>
          </div>
    
          <!-- FAQ Item 2 -->
          <div class="border p-3 bg-white rounded mb-3">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="mb-0">Why Upskill Students?</h4>
              <button class="btn btn-sm btn-outline-secondary toggle-btn" type="button">
                +
              </button>
            </div>
            <div class="faq-content collapse mt-3">
              <p class="text-muted">
                Upskilling helps students gain industry-relevant skills,
                increasing their job opportunities and career growth in emerging
                technologies.
              </p>
            </div>
          </div>
    
          <!-- FAQ Item 3 -->
          <div class="border p-3 bg-white rounded mb-3">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="mb-0">How do I enroll in a course?</h4>
              <button class="btn btn-sm btn-outline-secondary toggle-btn" type="button">
                +
              </button>
            </div>
            <div class="faq-content collapse mt-3">
              <p class="text-muted">
                You can enroll by selecting a course, filling in your details, and
                completing the payment process. Once registered, you'll receive
                course access.
              </p>
            </div>
          </div>
        </div>
      </section>
    
    
    
      <!-- ✅ JavaScript Fix for Toggling (+/-) and Proper Hide/Show -->
      <script>
        document.querySelectorAll(".toggle-btn").forEach((btn) => {
          btn.addEventListener("click", function () {
            const faqContent = this.parentElement.nextElementSibling;
    
            // Check if currently open
            const isOpen = faqContent.classList.contains("show");
    
            // Close all FAQ items first
            document
              .querySelectorAll(".faq-content")
              .forEach((content) => content.classList.remove("show"));
            document
              .querySelectorAll(".toggle-btn")
              .forEach((button) => (button.textContent = "+"));
    
            // If it was closed, open it; otherwise, keep it closed
            if (!isOpen) {
              faqContent.classList.add("show");
              this.textContent = "-";
            }
          });
        });
      </script>
    
      <!-- FAQ Section end -->
    
      <!-- /* Facilities Providing Strat */ -->
    
      <section class="facilities-section">
        <h2 class="facilities-title mb-5">
          Facilities <span class="highlight">Providing</span>
        </h2>
    
        <div class="facilities-container">
          <div class="facility-box">
            <img src="https://cdn-icons-png.flaticon.com/128/1828/1828479.png" alt="Coding Exam" />
            <p>Coding exam</p>
          </div>
          <div class="facility-box">
            <img src="https://cdn-icons-png.flaticon.com/128/3065/3065619.png" alt="Mock Interviews" />
            <p>Mock interviews</p>
          </div>
          <div class="facility-box">
            <img src="https://cdn-icons-png.flaticon.com/128/2659/2659360.png" alt="Recording Classes" />
            <p>Recording classes</p>
          </div>
          <div class="facility-box">
            <img src="https://cdn-icons-png.flaticon.com/128/2991/2991103.png" alt="Materials" />
            <p>Materials</p>
          </div>
          <div class="facility-box">
            <img src="https://cdn-icons-png.flaticon.com/128/5993/5993518.png" alt="GD Rounds" />
            <p>GD rounds</p>
          </div>
          <div class="facility-box">
            <img src="https://cdn-icons-png.flaticon.com/128/4207/4207291.png" alt="Spot Doubts" />
            <p>Spot doubts</p>
          </div>
          <div class="facility-box">
            <img src="https://cdn-icons-png.flaticon.com/128/3065/3065674.png" alt="Live Classes" />
            <p>Live classes</p>
          </div>
          <div class="facility-box">
            <img src="https://cdn-icons-png.flaticon.com/128/3125/3125712.png" alt="Career Guidance" />
            <p>Career guidance</p>
          </div>
          <div class="facility-box">
            <img src="https://cdn-icons-png.flaticon.com/128/3135/3135706.png" alt="Placement Assistance" />
            <p>Placement assistance</p>
          </div>
          <div class="facility-box">
            <img src="https://cdn-icons-png.flaticon.com/128/8091/8091544.png" alt="Internship Courses" />
            <p>Internship courses</p>
          </div>
        </div>
      </section>
      <!-- 
        /* Facilities Providing End */ -->
    
      <section class="mt-5 px-4 text-center bg-[#fcf8f3] py-12">
        <div class="mb-4">
          <h2 class="text-2xl font-bold text-gray-800 inline">Course</h2>
          <h2
            class="text-2xl font-bold bg-gradient-to-r from-orange-400 to-orange-600 bg-clip-text text-transparent inline">
            Certificates</h2>
        </div>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
          Our business analyst Master’s program is led by industry experts who will make you proficient in the field of
          business analytics. The projects and case studies that are provided as part of this course will help you gain
          industry-grade experience, which will be a bonus in your resume.
        </p>
    
        <div class="flex flex-col md:flex-row justify-center items-center gap-10 mt-8">
          <!-- Left Box: Certification List -->
          <div
            class="bg-white p-6 rounded-lg max-w-lg text-left shadow-md border-t-4 border-orange-400 transition-transform transform hover:scale-105">
            <p class="text-gray-700 font-medium">Our online business analytics master's course aims to help you clear
              several certification exams, including the ones below:</p>
            <ul class="mt-4 space-y-3">
              <li class="flex items-center gap-2 text-gray-800 font-medium"><span
                  class="text-green-500 font-bold text-lg">✔</span> CCBA – Certification of Competency in Business Analysis
              </li>
              <li class="flex items-center gap-2 text-gray-800 font-medium"><span
                  class="text-green-500 font-bold text-lg">✔</span> Agile Scrum Foundation</li>
              <li class="flex items-center gap-2 text-gray-800 font-medium"><span
                  class="text-green-500 font-bold text-lg">✔</span> Digital Transformation Course for Leaders</li>
            </ul>
          </div>
    
          <!-- Right Box: Certificate Image -->
          <img
            src="https://media.licdn.com/dms/image/v2/D5622AQGoUBZSCAP82g/feedshare-shrink_2048_1536/feedshare-shrink_2048_1536/0/1731245943907?e=2147483647&v=beta&t=55eBVsL3PaAH74TFdAM3qEz8RBRcwxX_ZHYYpst400I"
            alt="Certificate Preview"
            class="w-full max-w-xs md:max-w-sm rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:rotate-2">
        </div>
      </section>
      <!-- Add this at the end of your body -->
    
    
      <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
      <script>
        // Apply 3D Tilt Effect
        VanillaTilt.init(
          document.querySelectorAll(".certificates-box, .certificate-img"),
          {
            max: 10, // Maximum tilt rotation
            speed: 400, // Speed of the tilt effect
            glare: true, // Enables glare effect
            "max-glare": 0.3, // Adjust glare intensity
          }
        );
    
        // Apply Scroll Animation (Fade-in Effect)
        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                entry.target.classList.add("fade-in");
              }
            });
          },
          { threshold: 0.2 } // Triggers when 20% of the element is visible
        );
    
        document
          .querySelectorAll(".certificates-box, .certificate-img")
          .forEach((el) => {
            observer.observe(el);
          });
      </script>
    
      <section class="related-courses-section">
        <div class="related-header">
          <h2 class="related-title">Related</h2>
          <h2 class="related-subtitle">Courses</h2>
        </div>
    
        <div class="swiper-container custom-swiper related-swiper">
          <div class="swiper-wrapper custom-swiper-wrapper">
            <!-- Course Box 1 -->
            <!-- Course 1 -->
            <div class="swiper-slide custom-swiper-slide">
              <div class="course-card">
                <h3>Python Full Stack Development</h3>
                <p>[updated in 2023]</p>
                <img src="./images/pythonicon.gif" alt="Java">
                <p>⏳ Duration: <strong>4 Months</strong></p>
                <p>👥 <strong>30+ Placed</strong></p>
                <p>⭐ 4.8 (17K+ students)</p>
                <button class="register-btn">Register Now</button>
              </div>
            </div>
    
            <!-- Course 2 -->
            <div class="swiper-slide custom-swiper-slide">
              <div class="course-card">
                <h3>AI for Beginners</h3>
                <p>[updated in 2023]</p>
                <img src="./images/artificial-intelligence.gif" alt="Java">
                <p>⏳ Duration: <strong>4 Months</strong></p>
                <p>👥 <strong>30+ Placed</strong></p>
                <p>⭐ 4.8 (17K+ students)</p>
                <button class="register-btn">Register Now</button>
              </div>
            </div>
    
            <!-- Course 3 -->
            <div class="swiper-slide custom-swiper-slide">
              <div class="course-card">
                <h3>Cyber Security Fundamentals</h3>
                <p>[updated in 2023]</p>
                <img src="./images/cybersecurity.png" alt="Java">
                <p>⏳ Duration: <strong>4 Months</strong></p>
                <p>👥 <strong>30+ Placed</strong></p>
                <p>⭐ 4.8 (17K+ students)</p>
                <button class="register-btn">Register Now</button>
              </div>
            </div>
    
            <!-- Course 4 -->
            <div class="swiper-slide custom-swiper-slide">
              <div class="course-card">
                <h3>Full Stack Web Development</h3>
                <p>[updated in 2023]</p>
                <img src="./images/full stack web development.png" alt="Java">
                <p>⏳ Duration: <strong>4 Months</strong></p>
                <p>👥 <strong>30+ Placed</strong></p>
                <p>⭐ 4.8 (17K+ students)</p>
                <button class="register-btn">Register Now</button>
              </div>
            </div>
    
            <!-- Course 5 -->
            <div class="swiper-slide custom-swiper-slide">
              <div class="course-card">
                <h3>Machine Learning with Python</h3>
                <p>[updated in 2023]</p>
                <img src="./images/pythonicon.gif" alt="Java">
                <p>⏳ Duration: <strong>4 Months</strong></p>
                <p>👥 <strong>30+ Placed</strong></p>
                <p>⭐ 4.8 (17K+ students)</p>
                <button class="register-btn">Register Now</button>
              </div>
            </div>
    
            <!-- Course Box 6 -->
            <div class="swiper-slide custom-swiper-slide">
              <div class="course-card">
                <h3>UI/UX Design</h3>
                <p>[updated in 2023]</p>
                <img src="./images/icons8-figma.gif" alt="Java">
                <p>⏳ Duration: <strong>4 Months</strong></p>
                <p>👥 <strong>30+ Placed</strong></p>
                <p>⭐ 4.8 (17K+ students)</p>
                <button class="register-btn">Register Now</button>
              </div>
            </div>
    
            <!-- Course Box 7 -->
            <div class="swiper-slide custom-swiper-slide">
              <div class="course-card">
                <h3>Cloud Computing</h3>
                <p>[updated in 2023]</p>
                <img src="./images/Cloud Computing.png" alt="Java">
                <p>⏳ Duration: <strong>4 Months</strong></p>
                <p>👥 <strong>30+ Placed</strong></p>
                <p>⭐ 4.8 (17K+ students)</p>
                <button class="register-btn">Register Now</button>
              </div>
            </div>
    
            <!-- Course Box 8 -->
            <div class="swiper-slide custom-swiper-slide">
              <div class="course-card">
                <h3>Java Full Stack Web Development</h3>
                <p>[updated in 2023]</p>
                <img src="./images/icons8-java.gif" alt="Java">
                <p>⏳ Duration: <strong>4 Months</strong></p>
                <p>👥 <strong>30+ Placed</strong></p>
                <p>⭐ 4.8 (17K+ students)</p>
                <button class="register-btn">Register Now</button>
              </div>
            </div>
    
            <!-- Course Box 9 -->
            <div class="swiper-slide custom-swiper-slide">
              <div class="course-card">
                <h3>Data Science with Python</h3>
                <p>[updated in 2023]</p>
                <img src="./images/pythonicon.gif" alt="Java">
                <p>⏳ Duration: <strong>4 Months</strong></p>
                <p>👥 <strong>30+ Placed</strong></p>
                <p>⭐ 4.8 (17K+ students)</p>
                <button class="register-btn">Register Now</button>
              </div>
            </div>
    
    
          </div>
    
          <!-- Pagination Dots -->
          <div class="custom-pagination"></div>
      </section>
    
      <script>
        /* Fix Swiper Initialization */
        var swiper = new Swiper(".custom-swiper", {
          slidesPerView: 3,
          slidesPerGroup: 3,
          spaceBetween: 20,
          loop: true,
          centeredSlides: false, /* ✅ FIXED */
          grabCursor: true,
          pagination: {
            el: ".custom-pagination",
            clickable: true,
            dynamicBullets: true,
          },
          autoplay: {
            delay: 2500,
            disableOnInteraction: false,
          },
          speed: 700,
          breakpoints: {
            320: { slidesPerView: 1, slidesPerGroup: 1 },
            768: { slidesPerView: 2, slidesPerGroup: 2 },
            1024: { slidesPerView: 3, slidesPerGroup: 3 },
          },
        });
    
    
    
      </script>
      <!-- Bootstrap 5 JS (Required for Collapse to Work) -->
    
    
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
        let batches = []; // Global variable to store fetched batches

// Function to get query parameter from URL
function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// Function to fetch batches dynamically
async function fetchBatches() {
    const courseId = getQueryParam('id');
    if (!courseId) {
        console.error('Course ID not found in URL');
        return;
    }

    try {
        // const response = await fetch(`/api/batches?id=${courseId}`);
        const response = await fetch(`https://think-champ.com/thinkchampion/public/api/batches?id=${courseId}`);
        batches = await response.json();
console.log(batches)
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
        batchCard.classList.add("col-md-3");

        const cardContent = `
            <div class="batch-card ${batch.status === "started"
                ? "active"
                : batch.status === "soon"
                  ? "soon"
                  : ""
            }" onclick="selectBatch('${batch.date}')">
                <div class="batch-date">${batch.date}</div>
                <div class="batch-details">
                    <p>${batch.status === "started"
                        ? "Batch Started"
                        : batch.status === "soon"
                          ? "Soon"
                          : "Upcoming"
                    }</p>
                    <p>SAT - SUN</p>
                    <p>Weekend Class | 6 Months</p>
                    <p><b>08:00 PM TO 11:00 PM</b></p>
                    <p>PM IST (GMT +5:30)</p>
                </div>
            </div>
        `;

        batchCard.innerHTML = cardContent;
        batchCardsContainer.appendChild(batchCard);

        // Highlight the next upcoming batch
        if (batch.status === "upcoming" && new Date() < new Date(batch.startDate)) {
            updateBatchDetails(batch);
        }
    });
}

// Function to update batch details (slots, price, mode, etc.)
function updateBatchDetails(batch) {
    document.getElementById("available-slots").textContent = batch.slotsAvailable;
    document.getElementById("filled-slots").textContent = batch.slotsFilled;
    document.getElementById("mode-of-teaching").textContent = batch.mode;
    document.getElementById("batch-price").textContent = `₹${batch.price.toLocaleString('en-IN')}`;
    document.getElementById("batch-enroll-button").disabled = batch.status !== "upcoming";

    // Store selected batch in a global variable for Enroll Now button
    window.selectedBatch = batch;
}

// Function to handle batch selection
function selectBatch(date) {
    const selectedBatch = batches.find(batch => batch.date === date);
    if (selectedBatch) {
        updateBatchDetails(selectedBatch);
    }
}

// Function to handle Enroll Now button click
document.getElementById("batch-enroll-button").addEventListener("click", function() {
    if (window.selectedBatch) {
        const batch = window.selectedBatch;
        // Redirect to registration page with batch details as query parameters
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
        // window.location.href = `/public/register?${params.toString()}`;
        window.location.href = `https://think-champ.com/thinkchampion/public/register?${params.toString()}`;
    }
});
function selectBatch(date) {
    const selectedBatch = batches.find(batch => batch.date === date);
    if (selectedBatch) {
      
        document.querySelectorAll(".batch-card").forEach(card => {
            card.classList.remove("selected");
        });

       
        const selectedCard = document.querySelector(`.batch-card[onclick="selectBatch('${date}')"]`);
        selectedCard.classList.add("selected");

       
        updateBatchDetails(selectedBatch);
    }
}

// Call fetchBatches on page load
document.addEventListener("DOMContentLoaded", fetchBatches);
       
      </script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
@endsection