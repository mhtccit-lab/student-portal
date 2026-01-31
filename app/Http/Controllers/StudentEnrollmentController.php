<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\Course;
use App\Models\Student;
use App\Models\Institute;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = StudentEnrollment::with([
        'student',
        'institute',
        'trade',
        'course'
    ])->latest()->paginate(10);

        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('enrollments.create', [
            'students'   => Student::with('course','trade','institute')->get(),
            'institutes' => Institute::all(),
            'trades'     => Trade::all(),
            'courses'    => Course::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated  = $request->validate([
            'student_id'       => 'required|exists:students,id',
            'institute_id'     => 'required|exists:institutes,id',
            'trade_id'         => 'required|exists:trades,id',
            'course_id'        => 'required|exists:courses,id',
            'enroll_date'      => 'required|date',
            'status'           => 'required',
        ]);
    
        StudentEnrollment::create($validated );
        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Student enrolled successfully');
        //dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $enrollment = StudentEnrollment::findOrFail($id);
        return view('enrollments.edit', [
            'enrollment' => $enrollment,
            'students'   => Student::orderBy('full_name_english')->get(),
            'institutes' => Institute::orderBy('name')->get(),
            'trades'     => Trade::orderBy('name')->get(),
            'courses'    => Course::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentEnrollment $enrollment)
    {
        $validated = $request->validate([
        'student_id'   => 'required|exists:students,id',
        'institute_id' => 'required|exists:institutes,id',
        'trade_id'     => 'required|exists:trades,id',
        'course_id'    => 'required|exists:courses,id',
        'status'       => 'required|in:enrolled,completed,cancelled',
    ]);

    $enrollment->update($validated);

    return redirect()
        ->route('enrollments.index')
        ->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
