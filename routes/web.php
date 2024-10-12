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
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/course/{id}/details', [FrontController::class, 'details'])->name('front.details');
// Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');
Route::get('/course', [FrontController::class, 'course'])->name('front.course');
Route::get('/faq', [FrontController::class, 'faq'])->name('front.faq');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');
Route::get('/terms', [FrontController::class, 'terms'])->name('front.terms');
Route::get('/privacy', [FrontController::class, 'privacy'])->name('front.privacy');
Route::get('/404', [FrontController::class, '404'])->name('front.404');
Route::get('/search', [SearchController::class, 'search'])->name('search');


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
    Route::post('/checkout/store', [FrontController::class, 'checkout_store'])->name('front.checkout.store')->middleware('role:student');


});

Route::get('/mycourses', [CourseStudentController::class, 'index'])
    ->middleware(['auth', 'role:student'])
    ->name('mycourses.index');

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
