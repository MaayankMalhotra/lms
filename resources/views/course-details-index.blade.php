@extends('admin.layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Simplified and professional styles */
        .admin-panel {
            min-height: 100vh;
            background-color: #f9fafb;
        }
        .form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 1.5rem;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }
        .full-width {
            grid-column: 1 / -1;
        }
        .field-container {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .field-container label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
        }
        .field-container input,
        .field-container textarea,
        .field-container select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #111827;
            background-color: #fff;
            transition: border-color 0.2s;
        }
        .field-container input:focus,
        .field-container textarea:focus,
        .field-container select:focus {
            outline: none;
            border-color: #3b82f6;
        }
        .field-container textarea {
            resize: vertical;
            min-height: 80px;
        }
        .field-container select[multiple] {
            min-height: 100px;
        }
        .error {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
        .success {
            color: #10b981;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background-color: #ecfdf5;
            border-radius: 6px;
        }
        .collapsible-section {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            margin-bottom: 1rem;
        }
        .collapsible-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            background-color: #f9fafb;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
        }
        .collapsible-header:hover {
            background-color: #f3f4f6;
        }
        .collapsible-content {
            padding: 1rem;
            display: none;
        }
        .collapsible-content.active {
            display: block;
        }
        .dynamic-section {
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background-color: #f9fafb;
        }
        .dynamic-field {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }
        .dynamic-field:last-child {
            margin-bottom: 0;
        }
        .nested-section {
            padding: 0.5rem;
            border: 1px dashed #d1d5db;
            border-radius: 4px;
            margin-top: 0.5rem;
        }
        .button {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background-color 0.2s;
            cursor: pointer;
        }
        .add-button {
            background-color: #3b82f6;
            color: #ffffff;
        }
        .add-button:hover {
            background-color: #2563eb;
        }
        .remove-button {
            background-color: #ef4444;
            color: #ffffff;
        }
        .remove-button:hover {
            background-color: #dc2626;
        }
        .submit-button {
            background-color: #10b981;
            color: #ffffff;
        }
        .submit-button:hover {
            background-color: #059669;
        }
        .chevron {
            transition: transform 0.2s;
        }
        .chevron.active {
            transform: rotate(180deg);
        }
    </style>

    <div class="px-4">
        <h1 class="section-title">Add Course Details</h1>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <!-- Basic Information Section -->
                <div class="collapsible-section full-width">
                    <div class="collapsible-header" onclick="toggleSection(this)">
                        <span>Basic Information</span>
                        <svg class="chevron w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="collapsible-content active">
                        <div class="form-grid">
                            <!-- Course Name -->
                            <div class="field-container">
                                <label for="course_name">Course Name</label>
                                <select name="course_name" id="course_name">
                                    @foreach($course_name as $course)
                                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @error('course_name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Course Rating -->
                            <div class="field-container">
                                <label for="course_rating">Course Rating (0-5)</label>
                                <input type="number" name="course_rating" id="course_rating" step="0.1" min="0" max="5" value="{{ old('course_rating') }}">
                                @error('course_rating')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Course Rating by Student Number -->
                            <div class="field-container">
                                <label for="course_rating_student_number">Rated by Students (e.g., 15K)</label>
                                <input type="text" name="course_rating_student_number" id="course_rating_student_number" value="{{ old('course_rating_student_number') }}">
                                @error('course_rating_student_number')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Learners Enrolled -->
                            <div class="field-container">
                                <label for="course_learner_enrolled">Learners Enrolled (e.g., 30K)</label>
                                <input type="text" name="course_learner_enrolled" id="course_learner_enrolled" value="{{ old('course_learner_enrolled') }}">
                                @error('course_learner_enrolled')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Course Lecture Hours -->
                            <div class="field-container">
                                <label for="course_lecture_hours">Lecture Hours (e.g., 60)</label>
                                <input type="number" name="course_lecture_hours" id="course_lecture_hours" min="0" value="{{ old('course_lecture_hours') }}">
                                @error('course_lecture_hours')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Course Problems -->
                            <div class="field-container">
                                <label for="course_problem_counts">Problems (e.g., 350)</label>
                                <input type="number" name="course_problem_counts" id="course_problem_counts" min="0" value="{{ old('course_problem_counts') }}">
                                @error('course_problem_counts')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Course Banner -->
                            <div class="field-container">
                                <label for="course_banner">Course Banner Image</label>
                                <input type="file" name="course_banner" id="course_banner" accept="image/*">
                                @error('course_banner')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Description Section -->
                <div class="collapsible-section full-width">
                    <div class="collapsible-header" onclick="toggleSection(this)">
                        <span>Course Description</span>
                        <svg class="chevron w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="collapsible-content">
                        <div class="field-container">
                            <label for="course_description">Course Description</label>
                            <textarea name="course_description" id="course_description">{{ old('course_description') }}</textarea>
                            @error('course_description')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Course Overview Description Section -->
                <div class="collapsible-section full-width">
                    <div class="collapsible-header" onclick="toggleSection(this)">
                        <span>About Course Overview Description</span>
                        <svg class="chevron w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="collapsible-content">
                        <div class="field-container">
                            <label for="course_overview_description">Course Overview Description</label>
                            <textarea name="course_overview_description" id="course_overview_description">{{ old('course_overview_description') }}</textarea>
                            @error('course_overview_description')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Learning Outcomes Section -->
                <div class="collapsible-section full-width">
                    <div class="collapsible-header" onclick="toggleSection(this)">
                        <span>Learning Outcomes</span>
                        <svg class="chevron w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="collapsible-content">
                        <div class="field-container">
                            <div id="outcomes-container" class="dynamic-section">
                                <div class="dynamic-field">
                                    <input type="text" name="learning_outcomes[]" required value="{{ old('learning_outcomes.0') }}">
                                    <button type="button" class="button remove-button" onclick="removeOutcome(this)">Remove</button>
                                </div>
                            </div>
                            <button type="button" class="button add-button mt-2" onclick="addOutcome()">Add Learning Outcome</button>
                            @error('learning_outcomes')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            @error('learning_outcomes.*')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Course Curriculum Section -->
                <div class="collapsible-section full-width">
                    <div class="collapsible-header" onclick="toggleSection(this)">
                        <span>Course Curriculum</span>
                        <svg class="chevron w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="collapsible-content">
                        <div class="field-container">
                            <div id="curriculum-container" class="dynamic-section">
                                <div class="dynamic-field">
                                    <div class="form-grid">
                                        <div class="field-container">
                                            <label>Module Number (e.g., Module 0)</label>
                                            <input type="text" name="course_curriculum[0][module_number]" required value="{{ old('course_curriculum.0.module_number') }}">
                                            @error('course_curriculum.0.module_number')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="field-container">
                                            <label>Title (e.g., Programming Fundamentals)</label>
                                            <input type="text" name="course_curriculum[0][title]" required value="{{ old('course_curriculum.0.title') }}">
                                            @error('course_curriculum.0.title')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="field-container">
                                            <label>Duration (e.g., 4 Weeks)</label>
                                            <input type="text" name="course_curriculum[0][duration]" required value="{{ old('course_curriculum.0.duration') }}">
                                            @error('course_curriculum.0.duration')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="field-container full-width">
                                            <label>Description</label>
                                            <textarea name="course_curriculum[0][description]" required>{{ old('course_curriculum.0.description') }}</textarea>
                                            @error('course_curriculum.0.description')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- Topics Section -->
                                        <div class="field-container full-width">
                                            <label>Topics</label>
                                            <div class="nested-section" id="topics-0-0">
                                                <div class="form-grid">
                                                    <div class="field-container">
                                                        <label>Topic Category (e.g., HTML)</label>
                                                        <input type="text" name="course_curriculum[0][topics][0][category]" required value="{{ old('course_curriculum.0.topics.0.category') }}">
                                                    </div>
                                                    <div class="field-container full-width">
                                                        <label>Subtopics (use comma(,) for multiple subtopics)</label>
                                                        <textarea name="course_curriculum[0][topics][0][subtopics]" required placeholder="Enter subtopics, (use comma(,) for multiple subtopics)">{{ old('course_curriculum.0.topics.0.subtopics') }}</textarea>
                                                    </div>
                                                </div>
                                                <button type="button" class="button remove-button mt-2" onclick="removeTopic(0, this)">Remove Topic</button>
                                            </div>
                                            <button type="button" class="button add-button mt-2" onclick="addTopic(0)">Add Topic</button>
                                        </div>
                                    </div>
                                    <button type="button" class="button remove-button mt-2" onclick="removeCurriculum(this)">Remove Module</button>
                                </div>
                            </div>
                            <button type="button" class="button add-button mt-2" onclick="addCurriculum()">Add Curriculum Module</button>
                            @error('course_curriculum')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Key Points Section -->
                <div class="collapsible-section full-width">
                    <div class="collapsible-header" onclick="toggleSection(this)">
                        <span>Key Points of Learning</span>
                        <svg class="chevron w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="collapsible-content">
                        <div class="field-container">
                            <div id="points-container" class="dynamic-section">
                                <div class="dynamic-field">
                                    <input type="text" name="points[]" required value="{{ old('points.0') }}">
                                    <button type="button" class="button remove-button" onclick="removePoint(this)">Remove</button>
                                </div>
                            </div>
                            <button type="button" class="button add-button mt-2" onclick="addPoint()">Add Key Point</button>
                            @error('points')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            @error('points.*')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Instructors Section -->
                <div class="collapsible-section full-width">
                    <div class="collapsible-header" onclick="toggleSection(this)">
                        <span>Instructors</span>
                        <svg class="chevron w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="collapsible-content">
                        <div class="field-container">
                            <label for="instructor_ids">Select Instructors</label>
                            <select name="instructor_ids[]" id="instructor_ids" multiple required>
                                <option value="">Select Instructor</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                @endforeach
                            </select>
                            @error('instructor_ids')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            @error('instructor_ids.*')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- FAQs Section -->
                <div class="collapsible-section full-width">
                    <div class="collapsible-header" onclick="toggleSection(this)">
                        <span>FAQs</span>
                        <svg class="chevron w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="collapsible-content">
                        <div class="field-container">
                            <div id="faqs-container" class="dynamic-section">
                                <div class="dynamic-field">
                                    <div class="form-grid">
                                        <div class="field-container">
                                            <label>Question</label>
                                            <input type="text" name="faqs[0][question]" required value="{{ old('faqs.0.question') }}">
                                            @error('faqs.0.question')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="field-container full-width">
                                            <label>Answer</label>
                                            <textarea name="faqs[0][answer]" required>{{ old('faqs.0.answer') }}</textarea>
                                            @error('faqs.0.answer')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="button" class="button remove-button mt-2" onclick="removeFaq(this)">Remove FAQ</button>
                                </div>
                            </div>
                            <button type="button" class="button add-button mt-2" onclick="addFaq()">Add FAQ</button>
                            @error('faqs')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            @error('faqs.*')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="field-container">
                    <button type="submit" class="button submit-button">Add Course Detail</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let moduleCount = 1;
        let faqCount = 1;
        let topicCounts = { 0: 1 }; // Track topic counts for each module

        function toggleSection(element) {
            const content = element.nextElementSibling;
            const chevron = element.querySelector('.chevron');
            content.classList.toggle('active');
            chevron.classList.toggle('active');
        }

        function addOutcome() {
            const container = document.getElementById('outcomes-container');
            const div = document.createElement('div');
            div.className = 'dynamic-field';
            div.innerHTML = `
                <input type="text" name="learning_outcomes[]" required>
                <button type="button" class="button remove-button" onclick="removeOutcome(this)">Remove</button>
            `;
            container.appendChild(div);
        }

        function removeOutcome(button) {
            const fields = document.querySelectorAll('#outcomes-container .dynamic-field');
            if (fields.length > 1) {
                button.parentElement.remove();
            } else {
                alert('At least one learning outcome is required.');
            }
        }

        function addCurriculum() {
            topicCounts[moduleCount] = 1; // Initialize topic count for new module
            const container = document.getElementById('curriculum-container');
            const div = document.createElement('div');
            div.className = 'dynamic-field';
            div.innerHTML = `
                <div class="form-grid">
                    <div class="field-container">
                        <label>Module Number (e.g., Module ${moduleCount})</label>
                        <input type="text" name="course_curriculum[${moduleCount}][module_number]" required>
                    </div>
                    <div class="field-container">
                        <label>Title</label>
                        <input type="text" name="course_curriculum[${moduleCount}][title]" required>
                    </div>
                    <div class="field-container">
                        <label>Duration (e.g., 4 Weeks)</label>
                        <input type="text" name="course_curriculum[${moduleCount}][duration]" required>
                    </div>
                    <div class="field-container full-width">
                        <label>Description</label>
                        <textarea name="course_curriculum[${moduleCount}][description]" required></textarea>
                    </div>
                    <div class="field-container full-width">
                        <label>Topics</label>
                        <div class="nested-section" id="topics-${moduleCount}-0">
                            <div class="form-grid">
                                <div class="field-container">
                                    <label>Topic Category (e.g., HTML)</label>
                                    <input type="text" name="course_curriculum[${moduleCount}][topics][0][category]" required>
                                </div>
                                <div class="field-container full-width">
                                    <label>Subtopics (one per line)</label>
                                    <textarea name="course_curriculum[${moduleCount}][topics][0][subtopics]" required placeholder="Enter subtopics, one per line"></textarea>
                                </div>
                            </div>
                            <button type="button" class="button remove-button mt-2" onclick="removeTopic(${moduleCount}, this)">Remove Topic</button>
                        </div>
                        <button type="button" class="button add-button mt-2" onclick="addTopic(${moduleCount})">Add Topic</button>
                    </div>
                </div>
                <button type="button" class="button remove-button mt-2" onclick="removeCurriculum(this)">Remove Module</button>
            `;
            container.appendChild(div);
            moduleCount++;
        }

        function removeCurriculum(button) {
            const fields = document.querySelectorAll('#curriculum-container .dynamic-field');
            if (fields.length > 1) {
                const moduleIndex = Array.from(fields).indexOf(button.parentElement);
                delete topicCounts[moduleIndex];
                button.parentElement.remove();
                moduleCount--;
            } else {
                alert('At least one curriculum module is required.');
            }
        }

        function addTopic(moduleIndex) {
            if (!topicCounts[moduleIndex]) topicCounts[moduleIndex] = 0;
            const topicIndex = topicCounts[moduleIndex]++;
            const container = document.getElementById(`topics-${moduleIndex}-${topicIndex - 1}`).parentElement;
            const div = document.createElement('div');
            div.className = 'nested-section';
            div.id = `topics-${moduleIndex}-${topicIndex}`;
            div.innerHTML = `
                <div class="form-grid">
                    <div class="field-container">
                        <label>Topic Category (e.g., HTML)</label>
                        <input type="text" name="course_curriculum[${moduleIndex}][topics][${topicIndex}][category]" required>
                    </div>
                    <div class="field-container full-width">
                        <label>Subtopics (one per line)</label>
                        <textarea name="course_curriculum[${moduleIndex}][topics][${topicIndex}][subtopics]" required placeholder="Enter subtopics, one per line"></textarea>
                    </div>
                </div>
                <button type="button" class="button remove-button mt-2" onclick="removeTopic(${moduleIndex}, this)">Remove Topic</button>
            `;
            container.insertBefore(div, container.lastElementChild);
        }

        function removeTopic(moduleIndex, button) {
            const topicContainer = button.parentElement.parentElement;
            const topics = topicContainer.querySelectorAll('.nested-section');
            if (topics.length > 1) {
                button.parentElement.remove();
                topicCounts[moduleIndex]--;
            } else {
                alert('At least one topic is required per module.');
            }
        }

        function addPoint() {
            const container = document.getElementById('points-container');
            const div = document.createElement('div');
            div.className = 'dynamic-field';
            div.innerHTML = `
                <input type="text" name="points[]" required>
                <button type="button" class="button remove-button" onclick="removePoint(this)">Remove</button>
            `;
            container.appendChild(div);
        }

        function removePoint(button) {
            const fields = document.querySelectorAll('#points-container .dynamic-field');
            if (fields.length > 1) {
                button.parentElement.remove();
            } else {
                alert('At least one key point is required.');
            }
        }

        function addFaq() {
            const container = document.getElementById('faqs-container');
            const div = document.createElement('div');
            div.className = 'dynamic-field';
            div.innerHTML = `
                <div class="form-grid">
                    <div class="field-container">
                        <label>Question</label>
                        <input type="text" name="faqs[${faqCount}][question]" required>
                    </div>
                    <div class="field-container full-width">
                        <label>Answer</label>
                        <textarea name="faqs[${faqCount}][answer]" required></textarea>
                    </div>
                </div>
                <button type="button" class="button remove-button mt-2" onclick="removeFaq(this)">Remove FAQ</button>
            `;
            container.appendChild(div);
            faqCount++;
        }

        function removeFaq(button) {
            const fields = document.querySelectorAll('#faqs-container .dynamic-field');
            if (fields.length > 1) {
                button.parentElement.remove();
                faqCount--;
            } else {
                alert('At least one FAQ is required.');
            }
        }
    </script>
    @endsection
