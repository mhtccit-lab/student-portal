<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Trade;
use App\Models\Course;
use App\Models\Student;
use App\Models\Institute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        // DB::enableQueryLog();
        
        // $students = Student::with(['trade:id,name','course:id,name'])
        //     ->latest()
        //     ->paginate(10);
        
        $students = Student::select([
            'id',
            'full_name_english',
            'trade_id',
            'course_id',
            'phone',
            'status',
        ])
        ->with(['trade:id,name','course:id,name'])
        ->paginate(10);
        // dd(DB::getQueryLog());
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
            'types_of_card'         => 'required|in:nid,passport',
            'card_number'           => 'required|string|max:255',
            'passport_expiry_date'  => 'required|date',
            'card_file'             => ['required','file','mimes:jpg,jpeg,png,webp','max:5120',],// 5 MB
            'photo' => ['required','image','mimes:jpg,jpeg,png,webp','max:2048', ],// 2 MB
            'institute_id'      => 'required|exists:institutes,id',
            'trade_id'          => 'required|exists:trades,id',
            'course_id'         => 'required|exists:courses,id',
            'course_duration'   => 'required|integer',
            'course_fee'        => 'required|string',
            'amount_receiver_name'  => 'required|string|max:255',
            'reference_name'    => 'nullable|string|max:255',
            'status'            => 'required|in:active,inactive',
        ]);

        $username = Str::slug($validated['full_name_english']);
        // Card file upload
        if ($request->hasFile('card_file')) {
            $cardExt = $request->file('card_file')->getClientOriginalExtension();
            $validated['card_file'] = "students/cards/{$username}_card.{$cardExt}";

            $request->file('card_file')->storeAs(
                'students/cards',
                "{$username}_card.{$cardExt}",
                'public'
            );
        }

        // Photo upload
        if ($request->hasFile('photo')) {
            $photoExt = $request->file('photo')->getClientOriginalExtension();
            $validated['photo'] = "students/photos/{$username}_photo.{$photoExt}";

            $request->file('photo')->storeAs(
                'students/photos',
                "{$username}_photo.{$photoExt}",
                'public'
            );
        }
        
        $course = Course::findOrFail($request->course_id);

        $validated['course_duration'] = $course->duration;
        $validated['course_fee'] = $course->price;

        Student::create($validated);

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
        'card_file' => [
            'nullable',
            'file',
            'mimes:jpg,jpeg,png,webp',
            'max:5120', // 5 MB
        ],

        'photo' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048', // 2 MB
        ],
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
    $username = Str::slug($validated['full_name_english']);

    // Card file
    if ($request->hasFile('card_file')) {
        if ($student->card_file) {
            Storage::disk('public')->delete($student->card_file);
        }

        $ext = $request->file('card_file')->getClientOriginalExtension();
        $validated['card_file'] = "students/cards/{$username}_{$student->id}_card.{$ext}";

        $request->file('card_file')->storeAs(
            'students/cards',
            "{$username}_{$student->id}_card.{$ext}",
            'public'
        );
    }

    // Photo
    if ($request->hasFile('photo')) {
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }

        $ext = $request->file('photo')->getClientOriginalExtension();
        $validated['photo'] = "students/photos/{$username}_{$student->id}_photo.{$ext}";

        $request->file('photo')->storeAs(
            'students/photos',
            "{$username}_{$student->id}_photo.{$ext}",
            'public'
        );
    }

    $student->update($validated);

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

    // 🔥 TRASH LIST
    public function trash()
    {
        $students = Student::onlyTrashed()->paginate(10);
        return view('students.trash', compact('students'));
    }

    // ♻ RESTORE
    public function restore($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->restore();

        return redirect()
            ->route('students.trash')
            ->with('success', 'Student restored successfully.');
    }

    // ❌ PERMANENT DELETE (THIS IS #7)
    public function forceDelete($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);

        // delete files permanently
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }

        if ($student->card_file) {
            Storage::disk('public')->delete($student->card_file);
        }

        $student->forceDelete();

        return back()->with('success', 'Student permanently deleted.');
    }
}
