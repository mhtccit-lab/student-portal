<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\Course;
use App\Models\Student;
use App\Models\Institute;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class StudentEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = StudentEnrollment::with([
            'student',
            'institute',
            'trade',
            'course'
        ]);

        // 🔍 Student Name Search
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        // 🏫 Institute Filter
        if ($request->filled('institute_id')) {
            $query->where('institute_id', $request->institute_id);
        }

        // 🎓 Trade Filter
        if ($request->filled('trade_id')) {
            $query->where('trade_id', $request->trade_id);
        }

        // 📚 Course Filter
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // 📅 Date Filter
        if ($request->filled('enroll_date')) {
            $query->whereDate('enroll_date', $request->enroll_date);
        }

        // 🟢 Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $enrollments = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('enrollments.index', [
            'enrollments' => $enrollments,
            'students'    => Student::all(),
            'institutes'  => Institute::all(),
            'trades'      => Trade::all(),
            'courses'     => Course::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('enrollments.create', [
        //     'students'   => Student::with('course','trade','institute')->get(),
        //     'institutes' => Institute::all(),
        //     'trades'     => Trade::all(),
        //     'courses'    => Course::all(),
        // ]);
        // $existingEnrollments = StudentEnrollment::pluck('course_id', 'student_id');

        $enrolledStudentIds = StudentEnrollment::pluck('student_id')->unique();

        return view('enrollments.create', [
            'students' => Student::all(),
            'enrolledStudentIds' => $enrolledStudentIds,
            'institutes' => Institute::all(),
            'trades' => Trade::all(),
            'courses' => Course::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'student_id'   => 'required|exists:students,id',
        'institute_id' => 'required|exists:institutes,id',
        'trade_id'     => 'required|exists:trades,id',
        'course_id' => [
            'required',
            'exists:courses,id',
            Rule::unique('student_enrollments')
                ->where(fn ($q) =>
                    $q->where('student_id', $request->student_id)
                ),
        ],
        'enroll_date'  => 'required|date',
        'status'       => 'required',
    ], [
        'course_id.unique' => 'This student is already enrolled in this course.'
    ]);
// dd($request->all());
    StudentEnrollment::create($validated);

    return redirect()
        ->route('enrollments.index')
        ->with('success', 'Student Enrolled Successfully');
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
    ], [
        'course_id.unique' => 'This Student is Already Enrolled in this Course.'
    ]);

    $enrollment->update($validated);

    return redirect()
        ->route('enrollments.index')
        ->with('success', 'Enrollment Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentEnrollment $enrollment)
    {
        $enrollment->delete(); // soft delete

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment deleted successfully.');
    }
}
