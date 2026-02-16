<?php

// use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\StudentEnrollmentController;


Auth::routes(['register' => false]);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::resource('enrollments', StudentEnrollmentController::class);

    Route::get('/courses/{course}/info', function (\App\Models\Course $course) {
        return response()->json([
            'duration' => $course->duration,
            'price'    => $course->price,
        ]);
    })->name('courses.info');

    // Trash list
    Route::get('students-trash', [StudentController::class, 'trash'])
        ->name('students.trash');

    // Restore
    Route::patch('students/{id}/restore', [StudentController::class, 'restore'])
        ->name('students.restore');

    // Force delete (permanent)
    Route::delete('students/{id}/force-delete', [StudentController::class, 'forceDelete'])
        ->name('students.forceDelete');
    });

    Route::get('/order-course/{course}', function ($courseId) {
        return redirect()->route('login')
            ->with('course_id', $courseId);
    })->name('course.order');
    
require __DIR__.'/auth.php';
