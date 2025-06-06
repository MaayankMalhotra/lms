<?php

use App\Http\Controllers\AdminAssignmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminInternshipClassCreateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\StudentQuizController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CodingQuestionController;
use App\Http\Controllers\CodingTestController;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Models\Internship;
use App\Models\Batch;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminLiveClassController;
use App\Http\Controllers\AdminRecordingController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CareerHighlightController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CourseDetailsController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\InternshipRegistrationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\InternshipBatchController;
use App\Http\Controllers\InternshipEnrollmentController;
use App\Http\Controllers\InternshipRecordingController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\YouTubeReviewController;



Route::get('admin/internship-recordings-by-course/{courseId}', [InternshipRecordingController::class, 'getRecordingsByCourse']);
Route::get('/api/batches', [BatchController::class, 'getBatchesByCourse'])->name('api.batches');
Route::get('/register', [BatchController::class, 'show'])->name('register');
// Route::post('/register/submit', [BatchController::class, 'submit'])->name('register.submit');
Route::post('/register/submit', [BatchController::class, 'submitr'])->name('register.submit');
Route::get('/student/quiz-sets', [StudentQuizController::class, 'index'])->name('student.quiz_sets');
Route::get('/student/quiz-sets/{id}/take', [StudentQuizController::class, 'takeQuiz'])->name('student.quiz_sets.take');
Route::post('/student/quiz-sets/{id}/submit', [StudentQuizController::class, 'submitQuiz'])->name('student.quiz_sets.submit');
Route::get('/student/batch/{batchId}/quiz-ranking', [StudentQuizController::class, 'batchQuizRanking'])
    ->name('student.batch_quiz_ranking');
Route::get('/admin/quiz-sets', [QuizController::class, 'index'])->name('admin.quiz_sets');
Route::get('/admin/quiz-sets/create', [QuizController::class, 'createSet'])->name('admin.quiz_sets.create');
Route::post('/admin/quiz-sets/store', [QuizController::class, 'storeSet'])->name('admin.quiz_sets.store');
Route::get('/admin/quiz-sets/{id}/edit', [QuizController::class, 'editSet'])->name('admin.quiz_sets.edit');
Route::put('/admin/quiz-sets/{id}/update', [QuizController::class, 'updateSet'])->name('admin.quiz_sets.update');
Route::delete('/admin/quiz-sets/{id}', [QuizController::class, 'deleteSet'])->name('admin.quiz_sets.delete');

// Quizzes Routes
Route::get('/admin/quiz-sets/{id}/quizzes', [QuizController::class, 'showQuizzes'])->name('admin.quiz_sets.show_quizzes');
Route::get('/admin/quiz-sets/{id}/add-quizzes', [QuizController::class, 'addQuizzes'])->name('admin.quiz_sets.add_quizzes');
Route::post('/admin/quiz-sets/{id}/store-quizzes', [QuizController::class, 'storeQuizzes'])->name('admin.quiz_sets.store_quizzes');
Route::get('/admin/quizzes/{id}/edit', [QuizController::class, 'editQuiz'])->name('admin.quizzes.edit');
Route::put('/admin/quizzes/{id}/update', [QuizController::class, 'updateQuiz'])->name('admin.quizzes.update');
Route::delete('/admin/quizzes/{id}', [QuizController::class, 'deleteQuiz'])->name('admin.quizzes.delete');


// Route::get('/', function () {
//     if (Auth::user() && Auth::user()->role == 1) {
//         return to_route('admin.dash');
//     } elseif (Auth::user() && Auth::user()->role == 2) {
//         return to_route('trainer.dashboard');
//     } elseif (Auth::user() && Auth::user()->role == 3) {
//         return to_route('student.dashboard');
//     }

//     return to_route('home-page');
// })->name('home-page');

// Route::get('/', [HomeController::class, 'index'])->name('home-page');


public function index()
{
    if (Auth::check()) {
        if (Auth::user()->role == 1) {
            return to_route('admin.dash');
        } elseif (Auth::user()->role == 2) {
            return to_route('trainer.dashboard');
        } elseif (Auth::user()->role == 3) {
            return to_route('student.dashboard');
        }
    }

    $placements = DB::select("SELECT * FROM home_placements WHERE is_active = 1 LIMIT 2");
    $courses = DB::select("SELECT * FROM home_courses WHERE is_active = 1 LIMIT 3");
    $upcomingCourses = DB::select("SELECT * FROM home_upcoming_courses WHERE is_active = 1 LIMIT 3");
    $internships = DB::select("SELECT * FROM home_internships WHERE is_active = 1 LIMIT 3");
    $instructors = DB::select("SELECT * FROM home_instructors WHERE is_active = 1 LIMIT 4");
    $testimonials = DB::select("SELECT * FROM home_testimonials WHERE is_active = 1 LIMIT 3");
    $faqs = DB::select("SELECT * FROM home_faqs WHERE is_active = 1");

    return view('website.home', compact(
        'placements',
        'courses',
        'upcomingCourses',
        'internships',
        'instructors',
        'testimonials',
        'faqs'
    ));
}
Route::get('/about', function () {
    if (Auth::user() && Auth::user()->role == 1) {
        return to_route('admin.dash');
    } elseif (Auth::user() && Auth::user()->role == 2) {
        return to_route('trainer.dashboard');
    } elseif (Auth::user() && Auth::user()->role == 3) {
        return to_route('student.dashboard');
    }
    return view('website.about');
})->name('about-page');

// Route::get('/reveiws', function () {
//     if (Auth::user() && Auth::user()->role == 1) {
//         return to_route('admin.dash');
//     } elseif (Auth::user() && Auth::user()->role == 2) {
//         return to_route('trainer.dashboard');
//     } elseif (Auth::user() && Auth::user()->role == 3) {
//         return to_route('student.dashboard');
//     }
//     return view('website.reviews');
// })->name('website.reviews');

Route::get('/contact', function () {
    if (Auth::user() && Auth::user()->role == 1) {
        return to_route('admin.dash');
    } elseif (Auth::user() && Auth::user()->role == 2) {
        return to_route('trainer.dashboard');
    } elseif (Auth::user() && Auth::user()->role == 3) {
        return to_route('student.dashboard');
    }
    return view('website.contact_us');
})->name('website.contact');

Route::get('/events', function () {
    if (Auth::user() && Auth::user()->role == 1) {
        return to_route('admin.dash');
    } elseif (Auth::user() && Auth::user()->role == 2) {
        return to_route('trainer.dashboard');
    } elseif (Auth::user() && Auth::user()->role == 3) {
        return to_route('student.dashboard');
    }
    return view('website.events');
})->name('website.events');


// Route::get('/webinar', function () {
//     if (Auth::user() && Auth::user()->role == 1) {
//         return to_route('admin.dash');
//     } elseif (Auth::user() && Auth::user()->role == 2) {
//         return to_route('trainer.dashboard');
//     } elseif (Auth::user() && Auth::user()->role == 3) {
//         return to_route('student.dashboard');
//     }
//     return view('website.webinars');
// })->name('website.webinar');


Route::get('/course', function () {
    if (Auth::user() && Auth::user()->role == 1) {
        return to_route('admin.dash');
    } elseif (Auth::user() && Auth::user()->role == 2) {
        return to_route('trainer.dashboard');
    } elseif (Auth::user() && Auth::user()->role == 3) {
        return to_route('student.dashboard');
    }
    $courses = Course::all();
    return view('website.course', compact('courses'));
})->name('website.course');

Route::get('/internship_details', function () {
    if (Auth::user() && Auth::user()->role == 1) {
        return to_route('admin.dash');
    } elseif (Auth::user() && Auth::user()->role == 2) {
        return to_route('trainer.dashboard');
    } elseif (Auth::user() && Auth::user()->role == 3) {
        return to_route('student.dashboard');
    }
    $internships = Internship::all();
    return view('website.internship_course', compact('internships'));
})->name('website.internship_details');
// Route::get('/course_details', function () {
//     if (Auth::user() && Auth::user()->role == 1) {
//         return to_route('admin.dash');
//     } elseif (Auth::user() && Auth::user()->role == 2) {
//         return to_route('trainer.dashboard');
//     } elseif (Auth::user() && Auth::user()->role == 3) {
//         return to_route('student.dashboard');
//     }
//     return view('website.course_details');
// })->name('website.course_details');


// Route::get('/course_details', [CourseController::class, 'courseDetails'])->name('website.course_details');
// Edit Profile route
Route::get('/edit-profile', [BatchController::class, 'editProfile'])->name('edit-profile');

// Update Profile route
Route::put('/update-profile', [BatchController::class, 'updateProfile'])->name('update-profile');
Route::get('/profile', [BatchController::class, 'profile'])->name('profile');
Route::get('/login', function () {

    if (Auth::user() && Auth::user()->role == 1) {
        return to_route('admin.dash');
    } elseif (Auth::user() && Auth::user()->role == 2) {
        return to_route('trainer.dashboard');
    } elseif (Auth::user() && Auth::user()->role == 3) {
        return to_route('student.dashboard');
    }
    return view('website.login');
})->name('login');


Route::get('/login_check', [LoginController::class, 'login_check'])->name('logincheck');
Route::get('/register-web', [LoginController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('trainer-management', [AdminController::class, 'trainer_management'])->name('trainer-management');
Route::post('admin/trainers', [AdminController::class, 'store'])->name('admin.trainers.store');
Route::get('admin/trainers/{id}/edit', [AdminController::class, 'edit'])->name('admin.trainers.edit');
Route::put('admin/trainers/{id}', [AdminController::class, 'update'])->name('admin.trainers.update');
Route::delete('admin/trainers/{id}/delete', [AdminController::class, 'destroy'])->name('admin.trainers.delete');

Route::get('/student-management', [AdminController::class, 'student_management'])->name('student-management');
Route::get('admin/student/{id}/edit', [AdminController::class, 'editStudent'])->name('admin.student.edit');
Route::put('admin/student/{id}', [AdminController::class, 'updateStudent'])->name('admin.student.update');
Route::delete('admin/student/{id}', [AdminController::class, 'deleteStudent'])->name('admin.student.delete');

Route::get('/upload', [ImageUploadController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload', [ImageUploadController::class, 'uploadImage'])->name('upload.image');

Route::get('/student-dashboard', function () {
    return view('student.dashboard');
})->name('student.dashboard');

Route::get('/trainer-dashboard', function () {
    return view('website.trainerdashboard');
})->name('trainer.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dash');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('courses')->name('course.')->group(function () {
            Route::get('/add', [CourseController::class, 'addCourse'])->name('add');
            Route::post('/store', [CourseController::class, 'storeCourse'])->name('store');
            Route::get('/list', [CourseController::class, 'courseList'])->name('list');
            Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit');
            Route::put('/{course}', [CourseController::class, 'update'])->name('update');
            Route::delete('/{course}', [CourseController::class, 'destroy'])->name('delete');
        });

        Route::prefix('internship')->name('internship.')->group(function () {
            Route::get('/add', [InternshipController::class, 'create'])->name('add');
            Route::post('/store', [InternshipController::class, 'store'])->name('store');
            Route::get('/list', [InternshipController::class, 'internshipList'])->name('list');
            Route::get('/{internship}/edit', [InternshipController::class, 'edit'])->name('edit');
            Route::put('/{internship}', [InternshipController::class, 'update'])->name('update');
            Route::delete('/{internship}', [InternshipController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('batches')->name('batches.')->group(function () {
            Route::get('/add', [BatchController::class, 'create'])->name('add');
            Route::post('/store', [BatchController::class, 'store'])->name('store');
            Route::get('/index', [BatchController::class, 'index'])->name('index'); // Listing route
            Route::delete('/batch/{id}', [BatchController::class, 'destroy'])->name('destroy'); // Delete route
            Route::get('/{id}/edit', [BatchController::class, 'edit'])->name('edit');
            Route::put('/{id}', [BatchController::class, 'update'])->name('update');
        });

        Route::get('/recordings', [AdminRecordingController::class, 'index'])->name('recordings.index');
        Route::get('/recordings/create', [AdminRecordingController::class, 'create'])->name('recordings.create');
        Route::post('/recordings', [AdminRecordingController::class, 'store'])->name('recordings.store');
        Route::get('/recordings/{id}/edit', [AdminRecordingController::class, 'edit'])->name('recordings.edit');
        Route::put('/recordings/{id}', [AdminRecordingController::class, 'update'])->name('recordings.update');
        Route::delete('/recordings/{id}', [AdminRecordingController::class, 'destroy'])->name('recordings.destroy');

        Route::get('/live-classes', [AdminLiveClassController::class, 'index'])->name('live_classes.index');
        Route::get('/live-classes/create', [AdminLiveClassController::class, 'create'])->name('live_classes.create');
        Route::post('/live-classes', [AdminLiveClassController::class, 'store'])->name('live_classes.store');
        Route::get('/live-classes/recordings/{batchId}', [AdminLiveClassController::class, 'getRecordings'])->name('live_classes.recordings');
        Route::get('/live-classes/{id}/edit', [AdminLiveClassController::class, 'edit'])->name('live_classes.edit');
        Route::put('/live-classes/{id}', [AdminLiveClassController::class, 'update'])->name('live_classes.update');
        Route::delete('/live-classes/{id}', [AdminLiveClassController::class, 'destroy'])->name('live_classes.destroy');
    });

    Route::get('/attendance/monthly', [AttendanceController::class, 'showMonthlyAttendance']);
    Route::post('/leave/apply', [AttendanceController::class, 'applyLeave'])->name('leave.apply');
    Route::post('/leave/{leave}/approve', [AttendanceController::class, 'approveLeave'])->name('leave.approve');

    Route::get('/index-create-cd', [CourseDetailsController::class, 'index'])->name('course-details-index');
});

Route::get('/course-details/{id}/edit', [CourseDetailsController::class, 'edit'])->name('course.edit');
Route::put('/course-details/{id}', [CourseDetailsController::class, 'update'])->name('course.update');

// // Enrollment Management Routes
// Route::get('/admin/enrollments', [EnrollmentController::class, 'index'])->name('admin.enrollment.index');
// Route::get('/admin/enrollment/add', [EnrollmentController::class, 'create'])->name('admin.enrollment.add');
// Route::get('/admin/enrollment/edit/{id}', [EnrollmentController::class, 'edit'])->name('admin.enrollment.edit');
// Route::put('/admin/enrollment/update/{id}', [EnrollmentController::class, 'update'])->name('admin.enrollment.update');
// Route::delete('/admin/enrollment/destroy/{id}', [EnrollmentController::class, 'destroy'])->name('admin.enrollment.destroy');

// Add this to your existing enrollment routes
// Route::post('/admin/enrollment/approve/{id}', [EnrollmentController::class, 'approve'])->name('admin.enrollment.approve');

Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('admin.enrollment.index');

// Admin routes for coding questions
Route::prefix('admin')->group(function () {
    Route::get('/coding-questions', [CodingQuestionController::class, 'index'])->name('admin.coding_questions.index');
    Route::get('/coding-questions/create', [CodingQuestionController::class, 'create'])->name('admin.coding_questions.create');
    Route::post('/coding-questions', [CodingQuestionController::class, 'store'])->name('admin.coding_questions.store');
    Route::get('/coding-questions/{id}/edit', [CodingQuestionController::class, 'edit'])->name('admin.coding_questions.edit');
    Route::put('/coding-questions/{id}', [CodingQuestionController::class, 'update'])->name('admin.coding_questions.update');
    Route::delete('/coding-questions/{id}', [CodingQuestionController::class, 'destroy'])->name('admin.coding_questions.destroy');

    //news for admin

  // News Routes
  Route::get('/news', [NewsController::class, 'adminIndex'])->name('admin.news.index');
  Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
  Route::post('/news', [NewsController::class, 'store'])->name('admin.news.store');
  Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
  Route::put('/news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
  Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

  // News Category Routes
  Route::get('/news-categories', [NewsCategoryController::class, 'index'])->name('admin.news-categories.index');
  Route::get('/news-categories/create', [NewsCategoryController::class, 'create'])->name('admin.news-categories.create');
  Route::post('/news-categories', [NewsCategoryController::class, 'store'])->name('admin.news-categories.store');
  Route::get('/news-categories/{category}/edit', [NewsCategoryController::class, 'edit'])->name('admin.news-categories.edit');
  Route::put('/news-categories/{category}', [NewsCategoryController::class, 'update'])->name('admin.news-categories.update');
  Route::delete('/news-categories/{category}', [NewsCategoryController::class, 'destroy'])->name('admin.news-categories.destroy');

    Route::get('/events', [EventController::class, 'adminIndex'])->name('admin.events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');
    Route::get('/events/enrollments', [EventController::class, 'enrollments'])->name('admin.events.enrollments');

    Route::get('/event-categories', [EventCategoryController::class, 'index'])->name('admin.event-categories.index');
    Route::get('/event-categories/create', [EventCategoryController::class, 'create'])->name('admin.event-categories.create');
    Route::post('/event-categories', [EventCategoryController::class, 'store'])->name('admin.event-categories.store');
    Route::get('/event-categories/{category}/edit', [EventCategoryController::class, 'edit'])->name('admin.event-categories.edit');
    Route::put('/event-categories/{category}', [EventCategoryController::class, 'update'])->name('admin.event-categories.update');
    Route::delete('/event-categories/{category}', [EventCategoryController::class, 'destroy'])->name('admin.event-categories.destroy');
});
Route::get('/coding-questions/delete-solution', [CodingQuestionController::class, 'deleteSolution'])->name('admin.coding_questions.delete_solution');
// Student routes for coding tests
Route::prefix('student')->middleware('auth')->group(function () {
    Route::get('/coding-tests', [CodingTestController::class, 'index'])->name('student.coding_tests.index');
    Route::get('/coding-tests/{id}', [CodingTestController::class, 'show'])->name('student.coding_tests.show');
    Route::post('/coding-tests/{id}/submit', [CodingTestController::class, 'submit'])->name('student.coding_tests.submit');
});

// Add this to your existing admin routes
Route::get('/admin/coding-questions/{id}/submissions', [CodingQuestionController::class, 'showSubmissions'])->name('admin.coding_questions.show_submissions');
Route::get('course_details/{slug?}', [CourseController::class, 'courseDetails'])->name('website.course_details');



Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{receiverId}', [ChatController::class, 'fetchMessages']);
    Route::get('/message/send', [ChatController::class, 'sendMessage']);
});

Route::get('my-classes', [StudentClassController::class, 'index'])->name('student.classes.index');
Route::get('/student/join-class/{liveClassId}', [StudentClassController::class, 'joinClass'])->name('student.join-class');
Route::get('/student/batch/quiz-ranking', [StudentQuizController::class, 'batchQuizRanking'])
    ->name('student.batch_quiz_ranking');

Route::middleware(['auth'])->group(function () {
    // Student Routes
    Route::get('/student/attendance', [AttendanceController::class, 'studentAttendance'])
        ->name('student.attendance');
    Route::post('/student/leave/apply', [AttendanceController::class, 'applyLeave'])
        ->name('leave.apply');

    // Admin Routes
    Route::get('/admin/leaves', [AttendanceController::class, 'adminLeaves'])
        ->name('admin.leaves');
    Route::post('/admin/leave/{leave}/approve', [AttendanceController::class, 'approveLeave'])
        ->name('leave.approve');

    Route::get('/recordings', [StudentClassController::class, 'recordings'])->name('recordings');

    Route::get('/assignments/create', [AdminAssignmentController::class, 'create'])->name('admin.assignments.create');
    Route::post('/assignments', [AdminAssignmentController::class, 'store'])->name('admin.assignments.store');

    Route::get('/assignment', [StudentClassController::class, 'assignment'])->name('assignment');

    //career hightlight
    
    Route::get('/career-highlights-create',[CareerHighlightController::class, 'create'])->name('admin.career_highlight.create');
    Route::post('/career-highlights-store',[CareerHighlightController::class, 'store'])->name('admin.career_highlight.store');
    Route::get('/career-highlights-show',[CareerHighlightController::class, 'show_career_highlight'])->name('admin.career_highlight.show');
    Route::delete('/admin/career-highlight/delete-all', [CareerHighlightController::class, 'deleteAll'])->name('admin.career_highlight.deleteAll');
    Route::get('/testimonials/index', [TestimonialController::class, 'index'])->name('admin.testimonials.index');
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('admin.testimonials.create');
    Route::post('/testimonials/', [TestimonialController::class, 'store'])->name('admin.testimonials.store');
    Route::get('/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('admin.testimonials.edit');
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('admin.testimonials.update');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
    Route::get('/youtubereview/index', [YouTubeReviewController::class, 'index'])->name('admin.youtubereview.index');
    Route::get('/youtubereview/create', [YouTubeReviewController::class, 'create'])->name('admin.youtubereview.create');
    Route::post('/youtubereview', [YouTubeReviewController::class, 'store'])->name('admin.youtubereview.store'); 
    Route::get('/youtubereview/{id}/edit', [YouTubeReviewController::class, 'edit'])->name('admin.youtubereview.edit');
    Route::put('/youtubereview/{id}', [YouTubeReviewController::class, 'update'])->name('admin.youtubereview.update');
    Route::delete('/youtubereview/{id}', [YouTubeReviewController::class, 'destroy'])->name('admin.youtubereview.destroy');
    Route::get('/webinar/index', [WebinarController::class, 'index'])->name('admin.webinar.index');
    Route::get('/webinar/create', [WebinarController::class, 'create'])->name('admin.webinar.create');
    Route::post('/webinar', [WebinarController::class, 'store'])->name('admin.webinar.store'); 
    Route::get('/webinar/{id}/edit', [WebinarController::class, 'edit'])->name('admin.webinar.edit');
    Route::put('/webinar/{id}', [WebinarController::class, 'update'])->name('admin.webinar.update');
    Route::delete('/webinar/{id}', [WebinarController::class, 'destroy'])->name('admin.webinar.destroy');
    Route::get('/contact-us', [ContactUsController::class, 'contactindex'])->name('admin.contactus.index');
    Route::post('/contact-us/{id}/resolve', [ContactUsController::class, 'resolve'])->name('admin.contactus.resolve');

    //end

    Route::get('/view-batch-enrollment',[InternshipEnrollmentController::class, 'assignBatchView'])->name('view-batch-enrollment');

    Route::get('/internship-class-create', [AdminInternshipClassCreateController::class, 'create'])->name('admin.internship.class.create');

    Route::get('/internship-class-index', [AdminInternshipClassCreateController::class, 'index'])->name('admin.internship.class.index');
    // New routes for adding notes
Route::post('/internship-class/{id}/add-notes', [AdminInternshipClassCreateController::class, 'addNotes'])->name('admin.internship.class.addNotes');
Route::post('/internship-class/{id}/add-notes-2', [AdminInternshipClassCreateController::class, 'addNotes2'])->name('admin.internship.class.addNotes2');
    Route::get('/internship-class-edit/{id}', [AdminInternshipClassCreateController::class, 'edit'])
    ->name('admin.internship.class.edit');

    Route::put('/admin/internship-class-update/{id}', [AdminInternshipClassCreateController::class, 'update'])->name('admin.internship.class.update');

    Route::delete('/internship-class-destroy/{id}', [AdminInternshipClassCreateController::class, 'destroy'])->name('admin.internship-classes.destroy');

//////
// Recording Courses
Route::get('/internship-recording-courses', [InternshipRecordingController::class, 'index'])->name('admin.internship-recording-courses.index');
Route::post('/internship-recording-courses', [InternshipRecordingController::class, 'store'])->name('admin.internship-recording-courses.store');
Route::put('/internship-recording-courses/{recordingCourse}', [InternshipRecordingController::class, 'update'])->name('admin.internship-recording-courses.update');
Route::delete('/internship-recording-courses/{recordingCourse}', [InternshipRecordingController::class, 'destroy'])->name('admin.internship-recording-courses.destroy');

// Recordings
Route::get('/internship-recordings/create', [InternshipRecordingController::class, 'create'])->name('admin.internship-recordings.create');
Route::post('/internship-recordings', [InternshipRecordingController::class, 'storeRecording'])->name('admin.internship-recordings.store');
Route::get('/internship-recordings/{recording}/edit', [InternshipRecordingController::class, 'edit'])->name('admin.internship-recordings.edit');
Route::put('/internship-recordings/{recording}', [InternshipRecordingController::class, 'updateRecording'])->name('admin.internship-ecordings.update');
Route::delete('/internship-recordings/{recording}', [InternshipRecordingController::class, 'destroyRecording'])->name('admin.internship-recordings.destroy');

// Fetch recordings by course (for live class creation)
Route::get('/internship-enrollment-view',[InternshipEnrollmentController::class, 'viewEnrollments'])->name('admin.internship-enrollment-view');
Route::patch('/admin/internship-enrollments/{id}/toggle-status', [InternshipEnrollmentController::class, 'toggleEnrollmentStatus'])
    ->name('admin.internship-enrollments.toggleStatus');
});

Route::get('admin/internship-enrollments/{id}/edit', [InternshipEnrollmentController::class, 'edit'])->name('admin.internship-enrollments.edit');
Route::put('admin/internship-enrollments/{id}', [InternshipEnrollmentController::class, 'update'])->name('admin.internship-enrollments.update');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('internship-batches', InternshipBatchController::class)->except(['show']);
});

Route::post('/admin/quiz-sets/{quizSetId}/bulk-upload', [QuizController::class, 'bulkUpload'])
    ->name('admin.quiz_sets.bulk_upload');

    Route::get('/internship-enrollment-view',[InternshipEnrollmentController::class, 'viewEnrollments'])->name('admin.internship-enrollment-view');

Route::get('/get-trainer-course', [TrainerController::class, 'myCourse'])->name('get-trainer-course');
// extra code 
Route::get('/student/quiz-attempt/{attemptId}', [StudentQuizController::class, 'viewAttempt'])
    ->name('student.quiz_attempt')
    ->middleware('auth');


Route::post('/course-form', [CourseDetailsController::class, 'store'])->name('course.store');

Route::get('/internship/register/{id}', [InternshipRegistrationController::class, 'show'])->name('internship.register');
Route::post('/internship/register/submit', [InternshipRegistrationController::class, 'store'])->name('internship.register.submit');


Route::get('/admin/internship/content/create', [InternshipController::class, 'contentCreate'])->name('admin.internship.content.create');
Route::post('/admin/internship/content', [InternshipController::class, 'contentstore'])->name('admin.internship.content.store');
Route::get('/student-internships-classes', [InternshipController::class, 'internshipclasses'])->name('student.internship.class');
Route::get('/student-internships', [InternshipController::class, 'showOnStudentDashboard'])->name('student.internships.index');
Route::get('/student/internship/{enrollmentId}/content', [InternshipController::class, 'studentInternshipContent'])->name('student.internship.content');
Route::post('/student/internship/content/{contentId}/submit', [InternshipController::class, 'studentInternshipSubmit'])->name('student.internship.submit');

Route::get('get-internship-list', [InternshipController::class, 'getInternshipList'])->name('get-internship-list');
Route::get('/admin/internships/{internship}/submissions', [InternshipRegistrationController::class, 'submissions'])->name('admin.internship.submissions');
Route::post('/admin/internship/submissions/{submission}/feedback', [InternshipRegistrationController::class, 'submitFeedback'])->name('admin.internship.submission.feedback');


Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/image/{news}', [NewsController::class, 'showImage'])->name('news.image');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{slug}/enroll', [EventController::class, 'enroll'])->name('events.enroll');

Route::post('/assign-students-to-batch', [InternshipEnrollmentController::class, 'assignStudentsToBatch'])->name('assign.students.to.batch');

Route::post('/admin/internship-classes', [AdminInternshipClassCreateController::class, 'store'])->name('admin.internship-classes.store');

// routes/web.php
Route::post('/store-batch-data', [BatchController::class, 'storeBatchData'])->name('store.batch.data');

Route::get('/register-website', function () {
    return view('website.register-page');
})->name('website-register-page');

Route::post('/register-teacher', [BatchController::class, 'register_teacher'])->name('register.submit.teacher');
// Route::post('/register', [LoginController::class, 'register'])->name('register.submit');

Route::get('/career-highlights',[CareerHighlightController::class, 'show'])->name('career_hightlight_show');
Route::get('/webinars', [WebinarController::class, 'show'])->name('webinar.show');
Route::get('/webinars/{id}', [WebinarController::class, 'showWebinar'])->name('webinars.show');
Route::post('/webinars/{id}/enroll', [WebinarController::class, 'enroll'])->name('webinars.enroll');

Route::get('/contactus', [ContactUsController::class, 'index'])->name('contact.index');
// Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact.store');

// Route::get('/reveiws', function () {
//     if (Auth::user() && Auth::user()->role == 1) {
//         return to_route('admin.dash');
//     } elseif (Auth::user() && Auth::user()->role == 2) {
//         return to_route('trainer.dashboard');
//     } elseif (Auth::user() && Auth::user()->role == 3) {
//         return to_route('student.dashboard');
//     }
//     return view('website.reviews');
// })->name('website.reviews');

// Route::get('/webinar-detail',function(){
//     return view('website.webinar.webinar_detail');
// });

