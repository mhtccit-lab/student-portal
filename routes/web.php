<?php

// use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstituteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/new-admission', function () {
//     return view('newAdmission');
// })->middleware(['auth', 'verified'])->name('newAdmission');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->group(function () {
    // Route::resource('profile', ProfileController::class);
    Route::resource('institutes', InstituteController::class);
    Route::resource('trades', TradeController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('students', StudentController::class);

    Route::get('/courses/{course}/info', function (\App\Models\Course $course) {
    return response()->json([
        'duration' => $course->duration,
        'price'    => $course->price,
    ]);
})->name('courses.info');
});

require __DIR__.'/auth.php';
