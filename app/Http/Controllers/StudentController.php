<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Student;
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

    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('name')) {
            $query->where('full_name_english', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $students = $query->latest()->paginate(10);

        return view('students.index', compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name_english'     => 'required|string|max:255',
            'full_name_bangla'      => 'required|string|max:255',
            'father_name'           => 'required|string|max:255',
            'mother_name'           => 'required|string|max:255',
            'gender'                => 'required',
            'current_address'       => 'nullable|string',
            'permanent_address'     => 'nullable|string',
            'phone'                 => 'required',
            'email'                 => 'required|email|unique:students,email',
            'date_of_birth'         => 'required|date',
            'district'              => 'required|string|max:255',
            'police_station'        => 'required|string|max:255',
            'postal_code'           => 'required|string|max:20',
            'types_of_card'         => 'required|in:nid,passport',
            'card_number'           => 'required|string|max:255',
            'passport_expiry_date'  => 'required|date',
            'card_file'             => ['required','file','mimes:jpg,jpeg,png,webp','max:5120',],// 5 MB
            'photo'                 => ['required','image','mimes:jpg,jpeg,png,webp','max:2048', ],// 2 MB
            'reference_name'        => 'nullable|string|max:255',
            'status'                => 'required|in:active,inactive',
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

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success','Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Student $student)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', [
            'student'    => $student,
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
        'phone'             => 'required',
        'email'             => 'required|email|unique:students,email,' . $student->id,
        'status'            => 'required',
    ]);

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
