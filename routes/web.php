<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\CourseVideoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscribeTransactionController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details', [FrontController::class, 'details'])->name('front.details');
// Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');
Route::get('/resume', [FrontController::class, 'resume'])->name('front.resume');
Route::get('/course', [FrontController::class, 'course'])->name('front.course');

Route::get('/about-us', [FrontController::class, 'aboutUs'])->name('front.about-us');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::get('/blog', [FrontController::class, 'program'])->name('front.program');
Route::get('/faq', [FrontController::class, 'faq'])->name('front.faq');
Route::get('/become-teacher', [FrontController::class, 'becomeTeacher'])->name('front.become-teacher');
Route::get('/rules-requirements', [FrontController::class, 'rulesRequirements'])->name('front.rules-requirements');
Route::get('/help-center', [FrontController::class, 'helpCenter'])->name('front.help-center');
Route::get('/terms', [FrontController::class, 'terms'])->name('front.terms');
Route::get('/privacy', [FrontController::class, 'privacy'])->name('front.privacy');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings.edit');

    Route::get('/checkout', [FrontController::class, 'checkout'])->name('front.checkout')->middleware('role:student');
    Route::get('/mycourses', [CourseStudentController::class, 'index'])->name('mycourses.index')->middleware('role:student');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class)
        ->middleware('role:owner'); // admin.categories.index

    Route::resource('teachers', TeacherController::class)
        ->middleware('role:owner');

    Route::resource('courses', CourseController::class)
        ->middleware('role:owner|teacher');

    Route::resource('subscribe_transactions', SubscribeTransactionController::class)
        ->middleware('role:owner');

    Route::resource('course_videos', CourseVideoController::class)
        ->middleware('role:owner|teacher');

    Route::get('/add/video/{course:id}', [CourseVideoController::class, 'create'])
        ->middleware('role:owner|teacher')
        ->name('course.add_video');

    Route::post('/add/video/save/{course:id}', [CourseVideoController::class, 'store'])
        ->middleware('role:owner|teacher')
        ->name('course.add_video.save');
});

require __DIR__ . '/auth.php';
