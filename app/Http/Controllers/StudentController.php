<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\Course;
use App\Models\Student;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['institute','trade','course'])
            ->latest()
            ->paginate(10);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('students.create', [
            'institutes' => Institute::where('status','active')->get(),
            'trades'     => Trade::where('status','active')->get(),
            'courses'    => Course::where('status','active')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name_english' => 'required|string|max:255',
            'full_name_bangla'  => 'required|string|max:255',
            'gender'            => 'required',
            'phone'             => 'required',
            'email'             => 'required|email|unique:students,email',
            'date_of_birth'     => 'required|date',
            'current_address'   => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'district'              => 'required|string|max:255',
            'police_station'        => 'required|string|max:255',
            'postal_code'           => 'required|string|max:20',
            'types_of_card'     => 'required|in:nid,passport',
            'card_number'           => 'required|string|max:255',
            'passport_expiry_date'  => 'required|date',
            'card_file'         => 'required|file',
            'photo'             => 'required|image',
            'institute_id'      => 'required|exists:institutes,id',
            'trade_id'          => 'required|exists:trades,id',
            'course_id'         => 'required|exists:courses,id',
            'course_duration'   => 'required|integer',
            'course_fee'        => 'required|string',
            'amount_receiver_name'  => 'required|string|max:255',
            'reference_name'    => 'nullable|string|max:255',
            'status'            => 'required|in:active,inactive',
        ]);

        // File uploads
        $validated['card_file'] = $request->file('card_file')->store('students/cards', 'public');
        $validated['photo'] = $request->file('photo')->store('students/photos', 'public');

        
        $course = Course::findOrFail($request->course_id);

        $validated['course_duration'] = $course->duration;
        $validated['course_fee'] = $course->price;

        Student::create($request->validated() + [
            'card_file' => $cardFilePath ?? null,
            'photo' => $photoPath ?? null,
        ]);

        return redirect()->route('students.index')
            ->with('success','Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', [
            'student'    => $student,
            'institutes' => Institute::where('status','active')->get(),
            'trades'     => Trade::where('status','active')->get(),
            'courses'    => Course::where('status','active')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
       $validated = $request->validate([
        'full_name_english' => 'required|string|max:255',
        'full_name_bangla'  => 'required|string|max:255',
        'gender'            => 'required',
        'phone'             => 'required',
        'email'             => 'required|email|unique:students,email,' . $student->id,
        'date_of_birth'     => 'required|date',
        'district'          => 'required',
        'police_station'    => 'required',
        'postal_code'       => 'required',
        'types_of_card'     => 'required|in:nid,passport',
        'card_number'       => 'required',
        'passport_expiry_date' => 'nullable|date',
        'institute_id'      => 'required|exists:institutes,id',
        'trade_id'          => 'required|exists:trades,id',
        'course_id'         => 'required|exists:courses,id',
        'amount_receiver_name' => 'required',
        'status'            => 'required|in:active,inactive',
    ]);

    // 🔐 always trust DB, not form
    $course = Course::findOrFail($request->course_id);
    $validated['course_duration'] = $course->duration;
    $validated['course_fee'] = $course->price;

    // File updates (optional)
    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')->store('students/photos', 'public');
    }

    if ($request->hasFile('card_file')) {
        $validated['card_file'] = $request->file('card_file')->store('students/cards', 'public');
    }

    $student->update($request->validated() + [
        'card_file' => $cardFilePath ?? $student->card_file,
        'photo' => $photoPath ?? $student->photo,
    ]);

    return redirect()->route('students.index')
        ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success','Student deleted');
    }
}
