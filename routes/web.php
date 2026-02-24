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


Route::get('/', function () {
    return view('welcome');
});


//Profile route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Protected Routes (requires login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Institutes CRUD
    Route::resource('institutes', InstituteController::class);

    // Trades CRUD
    Route::resource('trades', TradeController::class);

    // Courses CRUD
    Route::resource('courses', CourseController::class);

    // Students CRUD
    Route::resource('students', StudentController::class);

    // Student Enrollment CRUD
    Route::resource('enrollments', StudentEnrollmentController::class);

    /*
    |--------------------------------------------------------------------------
    | AJAX Routes for Dependent Dropdowns
    |--------------------------------------------------------------------------
    |
    | These routes return JSON for Trade & Course dropdowns in enrollment filters.
    |
    */

    Route::get('/student/get-courses/{id}', [StudentController::class, 'getCourses'])
    ->name('students.get-courses');

    Route::get('/get-trades/{institute}', [StudentEnrollmentController::class, 'getTrades'])
        ->name('ajax.get-trades');

    Route::get('/get-courses/{trade}', [StudentEnrollmentController::class, 'getCourses'])
        ->name('ajax.get-courses');

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

    Route::get('/order-course/{course}', function ($courseId) {
        return redirect()->route('login')
            ->with('course_id', $courseId);
    })->name('course.order');

    // // API routes for dynamic dropdowns
    Route::get('/get-trades/{institute}', function ($instituteId) {
        return \App\Models\Trade::where('institute_id', $instituteId)
            ->select('id', 'name')
            ->get();
    });

    Route::get('/get-courses/{trade}', function ($tradeId) {
        return \App\Models\Course::where('trade_id', $tradeId)
            ->select('id', 'name')
            ->get();
    });
});

require __DIR__.'/auth.php';
