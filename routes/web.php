<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;



use App\Http\Controllers\CourseController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\StudentQuizController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CodingQuestionController;
use App\Http\Controllers\CodingTestController;
use App\Models\Course;
use App\Models\Internship;
use App\Models\Batch;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminLiveClassController;
use App\Http\Controllers\AdminRecordingController;

use App\Http\Controllers\QuizController;

Route::get('/student/quiz-sets', [StudentQuizController::class, 'index'])->name('student.quiz_sets');
    Route::get('/student/quiz-sets/{id}/take', [StudentQuizController::class, 'takeQuiz'])->name('student.quiz_sets.take');
    Route::post('/student/quiz-sets/{id}/submit', [StudentQuizController::class, 'submitQuiz'])->name('student.quiz_sets.submit');
    
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


Route::get('/', function () {
    if (Auth::user() && Auth::user()->role == 1) {
        return to_route('admin.dash');
    } elseif (Auth::user() && Auth::user()->role == 2) {
        return to_route('trainer.dashboard');
    } elseif (Auth::user() && Auth::user()->role == 3) {
        return to_route('student.dashboard');
    }

    return view('website.home');
})->name('home-page');

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

Route::get('/reveiws', function () {
    if (Auth::user() && Auth::user()->role == 1) {
        return to_route('admin.dash');
    } elseif (Auth::user() && Auth::user()->role == 2) {
        return to_route('trainer.dashboard');
    } elseif (Auth::user() && Auth::user()->role == 3) {
        return to_route('student.dashboard');
    }
    return view('website.reviews');
})->name('website.reviews');

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

Route::get('/news', function () {
    if (Auth::user() && Auth::user()->role == 1) {
        return to_route('admin.dash');
    } elseif (Auth::user() && Auth::user()->role == 2) {
        return to_route('trainer.dashboard');
    } elseif (Auth::user() && Auth::user()->role == 3) {
        return to_route('student.dashboard');
    }
    return view('website.news');
})->name('website.news');

Route::get('/webinar', function () {
    if (Auth::user() && Auth::user()->role == 1) {
        return to_route('admin.dash');
    } elseif (Auth::user() && Auth::user()->role == 2) {
        return to_route('trainer.dashboard');
    } elseif (Auth::user() && Auth::user()->role == 3) {
        return to_route('student.dashboard');
    }
    return view('website.webinars');
})->name('website.webinar');


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


Route::get('/login_check', [LoginController::class, 'login_check'])->name('logincheck');;
Route::get('/register-web', [LoginController::class, 'register']);

Route::get('/student-management', [AdminController::class, 'student_management'])->name('student-management');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/trainer-management', [AdminController::class, 'trainer_management'])->name('trainer-management');

Route::get('admin/student/{id}/edit', [AdminController::class, 'editStudent'])->name('admin.student.edit');
Route::delete('admin/student/{id}/delete', [AdminController::class, 'deleteStudent'])->name('admin.student.delete');

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
        
    
});

Route::get('/api/batches', [BatchController::class, 'getBatchesByCourse'])->name('api.batches');
Route::get('/register', [BatchController::class, 'showr'])->name('register');
// Route::post('/register/submit', [BatchController::class, 'submit'])->name('register.submit');
Route::post('/register/submit', [BatchController::class, 'submitr'])->name('register.submit');

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
use App\Http\Controllers\ChatController;

Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/messages/{receiverId}', [ChatController::class, 'fetchMessages']);
    Route::get('/message/send', [ChatController::class, 'sendMessage']);
});