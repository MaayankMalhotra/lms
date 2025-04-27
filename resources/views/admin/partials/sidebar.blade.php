<!-- Sidebar Container -->
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>

<!-- Logo -->
<div class="text-center mb-4 mt-4 flex-shrink-0">
    <img src="https://think-champ.com/wp-content/uploads/2024/05/THINK-CHAMP-logo-1024x502.png" alt="Logo"
        class="h-12 w-auto mx-auto">
</div>

<!-- Navigation -->
<nav class="bg-white shadow-lg rounded-tl-lg rounded-tr-lg p-4 flex-grow overflow-y-auto scrollbar-hide">
    <ul class="list-none p-0 m-0 space-y-2 !text-sm">
        <!-- Dashboard (Sabko dikhega) -->
        <li>
            <a href="{{ route('admin.dash') }}"
                class="flex items-center p-3 {{ request()->routeIs('admin.dash') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                <i class="fas fa-home mr-3 text-lg"></i> Dashboard Panel
            </a>
        </li>
        @if (auth()->user()->role == 3)
            <!-- Quiz Management Students -->
            <li>
                <a href="{{ route('student.quiz_sets') }}"
                    class="flex items-center p-3 {{ request()->routeIs('student.quiz_sets') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Quiz Management
                </a>
                <a href="{{ route('student.coding_tests.index') }}"
                    class="flex items-center p-3 {{ request()->routeIs('student.coding_tests.index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Coding Module
                </a>
            </li>
        @endif
        @if (auth()->user()->role == 2 || auth()->user()->role == 3)
            <!-- Quiz Management Students -->
            <li>
                <a href="{{ route('chat.index') }}"
                    class="flex items-center p-3 {{ request()->routeIs('chat.index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Chat Management
                </a>

            </li>
        @endif
        @if (auth()->user()->role == 2)
            <!-- Quiz Management Students -->
            <li>
                <a href="{{ route('get-trainer-course') }}"
                    class="flex items-center p-3 {{ request()->routeIs('get-trainer-course') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> My Batches
                </a>

            </li>
        @endif
        @if (auth()->user()->role == 3)
            <li>
                <a href="{{ route('student.classes.index') }}"
                    class="flex items-center p-3 {{ request()->routeIs('student.classes.index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> My Classes
                </a>

            </li>

            <li>
                <a href="{{ route('student.attendance') }}"
                    class="flex items-center p-3 {{ request()->routeIs('student.attendance') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Attendance
                </a>

            </li>
            <li>
                <a href="{{ route('recordings') }}"
                    class="flex items-center p-3 {{ request()->routeIs('recordings') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Recordings
                </a>

            </li>

            <li>
                <a href="{{ route('assignment') }}"
                    class="flex items-center p-3 {{ request()->routeIs('assignment') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> My Assignments
                </a>

            </li>
            <li>
                <a href="{{ route('student.internships.index') }}"
                    class="flex items-center p-3 {{ request()->routeIs('student.internships.index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> My Internships
                </a>

            </li>
        @endif
        <!-- Admin ke liye baaki sections (Sirf role == 1 ko dikhega) -->
        @if (auth()->user()->role == 1)
            <!-- Course Management -->
            <li x-data="{ isOpen: {{ request()->routeIs('admin.course.*') ? 'true' : 'false' }} }">
                <a href="javascript:void(0)" @click="isOpen = !isOpen"
                    class="flex items-center justify-between p-3 {{ request()->routeIs('admin.course.*') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <span class="flex items-center">
                        <i class="fas fa-book mr-3 text-lg"></i> Course Management
                    </span>
                    <i class="fas fa-chevron-down text-sm transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                </a>
                <ul x-show="isOpen" x-collapse class="ml-6 mt-2 space-y-2 border-l-2 border-gray-300 pl-4">
                    <li>
                        <a href="{{ route('admin.course.add') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.course.add') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-plus-circle mr-2"></i> Add Course
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.course.list') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.course.list') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> View Courses
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('course-details-index') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('course-details-index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-plus-circle mr-2"></i> Add Course Details
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->user()->role == 1)
            <!-- Internship Management -->
            <li x-data="{ isOpen: {{ request()->routeIs('admin.internship.*') ? 'true' : 'false' }} }">
                <a href="javascript:void(0)" @click="isOpen = !isOpen"
                    class="flex items-center justify-between p-3 {{ request()->routeIs('admin.internship.*') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <span class="flex items-center">
                        <i class="fas fa-briefcase mr-3 text-lg"></i> Internship Management
                    </span>
                    <i class="fas fa-chevron-down text-sm transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                </a>
                <ul x-show="isOpen" x-collapse class="ml-6 mt-2 space-y-2 border-l-2 border-gray-300 pl-4">
                    <li>
                        <a href="{{ route('admin.internship.add') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.internship.add') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-plus-circle mr-2"></i> Add Internship
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.internship.list') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.internship.list') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> View Internships
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.internship.content.create') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.internship.content.create') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> Create Internships Content
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('get-internship-list') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('get-internship-list') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> Get Internships List
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->user()->role == 1)
            <!-- enrollment Management -->
            <li x-data="{ isOpen: {{ request()->routeIs('admin.enrollment.*') ? 'true' : 'false' }} }">
                <a href="javascript:void(0)" @click="isOpen = !isOpen"
                    class="flex items-center justify-between p-3 {{ request()->routeIs('admin.enrollment.*') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <span class="flex items-center">
                        <i class="fas fa-briefcase mr-3 text-lg"></i> Enrollment Management
                    </span>
                    <i class="fas fa-chevron-down text-sm transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                </a>
                <ul x-show="isOpen" x-collapse class="ml-6 mt-2 space-y-2 border-l-2 border-gray-300 pl-4">

                    <li>
                        <a href="{{ route('admin.enrollment.index') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.enrollment.list') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> View Enrollments
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->user()->role == 1 || auth()->user()->role == 2)
            <!-- Coding Module -->
            <li x-data="{ isOpen: {{ request()->routeIs('admin.enrollment.*') ? 'true' : 'false' }} }">
                <a href="javascript:void(0)" @click="isOpen = !isOpen"
                    class="flex items-center justify-between p-3 {{ request()->routeIs('admin.enrollment.*') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <span class="flex items-center">
                        <i class="fas fa-briefcase mr-3 text-lg"></i> Coding Module
                    </span>
                    <i class="fas fa-chevron-down text-sm transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                </a>
                <ul x-show="isOpen" x-collapse class="ml-6 mt-2 space-y-2 border-l-2 border-gray-300 pl-4">

                    <li>
                        <a href="{{ route('admin.coding_questions.index') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.coding_questions.index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> Coding Module
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if (auth()->user()->role == 1)
            <!-- Batch Management -->
            <li x-data="{ isOpen: {{ request()->routeIs('admin.batches.*') ? 'true' : 'false' }} }">
                <a href="javascript:void(0)" @click="isOpen = !isOpen"
                    class="flex items-center justify-between p-3 {{ request()->routeIs('admin.batches.*') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <span class="flex items-center">
                        <i class="fas fa-briefcase mr-3 text-lg"></i> Batches Management
                    </span>
                    <i class="fas fa-chevron-down text-sm transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                </a>
                <ul x-show="isOpen" x-collapse class="ml-6 mt-2 space-y-2 border-l-2 border-gray-300 pl-4">
                    <li>
                        <a href="{{ route('admin.batches.add') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.batches.add') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-plus-circle mr-2"></i> Add Batches
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.batches.index') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.batches.list') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> View Batches
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->user()->role == 1)
            <!-- Recordings Class Management -->
            <li x-data="{ isOpen: {{ request()->routeIs('admin.recordings.*') ? 'true' : 'false' }} }">
                <a href="javascript:void(0)" @click="isOpen = !isOpen"
                    class="flex items-center justify-between p-3 {{ request()->routeIs('admin.recordings.*') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <span class="flex items-center">
                        <i class="fas fa-briefcase mr-3 text-lg"></i> Recordings Management
                    </span>
                    <i class="fas fa-chevron-down text-sm transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                </a>
                <ul x-show="isOpen" x-collapse class="ml-6 mt-2 space-y-2 border-l-2 border-gray-300 pl-4">
                    <li>
                        <a href="{{ route('admin.recordings.create') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.recordings.create') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-plus-circle mr-2"></i> Add Recordings
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.recordings.index') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.recordings.index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> View Recording
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->user()->role == 1)
            <!-- Live Class Management -->
            <li x-data="{ isOpen: {{ request()->routeIs('admin.live_classes.*') ? 'true' : 'false' }} }">
                <a href="javascript:void(0)" @click="isOpen = !isOpen"
                    class="flex items-center justify-between p-3 {{ request()->routeIs('admin.live_classes.*') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <span class="flex items-center">
                        <i class="fas fa-briefcase mr-3 text-lg"></i> Live Class Management
                    </span>
                    <i class="fas fa-chevron-down text-sm transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                </a>
                <ul x-show="isOpen" x-collapse class="ml-6 mt-2 space-y-2 border-l-2 border-gray-300 pl-4">
                    <li>
                        <a href="{{ route('admin.live_classes.create') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.live_classes.create') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-plus-circle mr-2"></i> Add Live Class
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.live_classes.index') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.live_classes.index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> View Live Class
                        </a>
                    </li>
                </ul>
            </li>
        @endif


        @if (auth()->user()->role == 1 || auth()->user()->role == 2)
            <!-- Quiz Management -->
            <li>
                <a href="{{ route('admin.quiz_sets') }}"
                    class="flex items-center p-3 {{ request()->routeIs('admin.quiz_sets') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Quiz Management
                </a>
                <a href="{{ route('student.batch_quiz_ranking') }}"
                    class="flex items-center p-3 {{ request()->routeIs('student.batch_quiz_ranking') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Rankings
                </a>
            </li>
        @endif
        @if (auth()->user()->role == 1)
            <!-- Student Management -->
            <li>
                <a href="{{ route('student-management') }}"
                    class="flex items-center p-3 {{ request()->routeIs('student-management') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Student Management
                </a>
            </li>
            <!-- Trainer Management -->
            <li>
                <a href="{{ route('trainer-management') }}"
                    class="flex items-center p-3 {{ request()->routeIs('trainer-management') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Trainer Management
                </a>
            </li>

            <li x-data="{ isOpen: {{ request()->routeIs('admin.news.*') ? 'true' : 'false' }} }">
                <a href="javascript:void(0)" @click="isOpen = !isOpen"
                    class="flex items-center justify-between p-3 {{ request()->routeIs('admin.news.*') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <span class="flex items-center">
                        <i class="fas fa-book mr-3 text-lg"></i> News Management
                    </span>
                    <i class="fas fa-chevron-down text-sm transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                </a>
                <ul x-show="isOpen" x-collapse class="ml-6 mt-2 space-y-2 border-l-2 border-gray-300 pl-4">
                    <li>
                        <a href="{{ route('admin.news.create') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.news.create') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-plus-circle mr-2"></i> Create News
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.news.index') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.news.index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> View News
                        </a>
                    </li>
                </ul>
            </li>

             <!-- Events Management -->
             <li x-data="{ isOpen: {{ request()->routeIs('admin.events.*') || request()->routeIs('admin.event-categories.*') ? 'true' : 'false' }} }">
                <a href="javascript:void(0)" @click="isOpen = !isOpen"
                    class="flex items-center justify-between p-3 {{ request()->routeIs('admin.events.*') || request()->routeIs('admin.event-categories.*') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <span class="flex items-center">
                        <i class="fas fa-calendar-alt mr-3 text-lg"></i> Events Management
                    </span>
                    <i class="fas fa-chevron-down text-sm transition-transform" :class="{ 'rotate-180': isOpen }"></i>
                </a>
                <ul x-show="isOpen" x-collapse class="ml-6 mt-2 space-y-2 border-l-2 border-gray-300 pl-4">
                    <li>
                        <a href="{{ route('admin.event-categories.create') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.event-categories.create') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-folder-plus mr-2"></i> Create Category
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.event-categories.index') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.event-categories.index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-folder mr-2"></i> View Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.events.create') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.events.create') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-plus-circle mr-2"></i> Create Event
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.events.index') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.events.index') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-list mr-2"></i> View Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.events.enrollments') }}"
                            class="flex items-center p-2 text-sm {{ request()->routeIs('admin.events.enrollments') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800]/20' }} rounded transition">
                            <i class="fas fa-users mr-2"></i> View Enrollments
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->user()->role == 1 || auth()->user()->role == 2)
            <!-- Trainer Management -->
            <li>
                <a href="{{ route('admin.leaves') }}"
                    class="flex items-center p-3 {{ request()->routeIs('admin.leaves') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Attendance Management
                </a>
            </li>

            <li>
                <a href="{{ route('admin.assignments.create') }}"
                    class="flex items-center p-3 {{ request()->routeIs('admin.assignments.create') ? 'bg-[#ff9800] text-white' : 'hover:bg-[#ff9800] hover:text-white' }} rounded transition">
                    <i class="fas fa-question-circle mr-3 text-lg"></i> Assignment Management
                </a>
            </li>
        @endif
    </ul>
</nav>
