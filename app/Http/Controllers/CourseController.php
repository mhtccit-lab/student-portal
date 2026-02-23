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
    public function index(Request $request)
    {
        $trades = Trade::select('id','name')->get();

        $courses = Course::with('trade')

            // Filter by Trade
            ->when($request->trade_id, function ($query) use ($request) {
                $query->where('trade_id', $request->trade_id);
            })

            // Filter by Status
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })

            // Filter by Min Price
            ->when($request->min_price, function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price);
            })

            // Filter by Max Price
            ->when($request->max_price, function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price);
            })

            // Filter by Duration
            ->when($request->duration, function ($query) use ($request) {
                $query->where('duration', $request->duration);
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('courses.index', compact('courses','trades'));
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
