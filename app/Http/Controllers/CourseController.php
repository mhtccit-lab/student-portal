<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Trade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('trade')->latest()->paginate(10);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trades = Trade::where('status', 'active')->get();
        return view('courses.create', compact('trades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trade_id' => 'required|exists:trades,id',
            'name'     => 'required|string|max:255',
            'duration' => 'required|string|max:100',
            'price'    => 'required|numeric|min:0',
            'status'   => 'required|in:active,inactive',
        ]);

        Course::create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $trades = Trade::where('status', 'active')->get();
        return view('courses.edit', compact('course', 'trades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'trade_id' => 'required|exists:trades,id',
            'name'     => 'required|string|max:255',
            'duration' => 'required|string|max:100',
            'price'    => 'required|numeric|min:0',
            'status'   => 'required|in:active,inactive',
        ]);

        $course->update($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully');
    }
}
