<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreInstituteRequest;
use App\Http\Requests\UpdateInstituteRequest;

class InstituteController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $institutes = Institute::latest()->paginate(10);
        return view('institutes.index', compact('institutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('institutes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'code'    => 'required|string|max:50|unique:institutes,code',
            'address' => 'nullable|string',
            'status'  => 'required|in:active,inactive',
        ]);

        Institute::create($validated);

        return redirect()
            ->route('institutes.index')
            ->with('success', 'Institute Created Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Institute $institute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institute $institute)
    {
        return view('institutes.edit', compact('institute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institute $institute)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'code'    => 'required|string|max:50|unique:institutes,code,' . $institute->id,
            'address' => 'nullable|string',
            'status'  => 'required|in:active,inactive',
        ]);

        $institute->update($validated);

        return redirect()
            ->route('institutes.index')
            ->with('success', 'Institute Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institute $institute)
    {
        $institute->delete();

        return redirect()
            ->route('institutes.index')
            ->with('success', 'Institute Deleted Successfully.');
    }
}
