<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\Institute;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTradeRequest;
use App\Http\Requests\UpdateTradeRequest;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trades = Trade::with('institute')
            ->latest()
            ->paginate(10);

        return view('trades.index', compact('trades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutes = Institute::where('status', 'active')->get();

        return view('trades.create', compact('institutes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'institute_id' => 'required|exists:institutes,id',
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'status'       => 'required|in:active,inactive',
        ]);

        Trade::create($validated);

        return redirect()
            ->route('trades.index')
            ->with('success', 'Trade created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trade $trade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trade $trade)
    {
        $institutes = Institute::where('status', 'active')->get();

        return view('trades.edit', compact('trade', 'institutes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trade $trade)
    {
        $validated = $request->validate([
            'institute_id' => 'required|exists:institutes,id',
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'status'       => 'required|in:active,inactive',
        ]);

        $trade->update($validated);

        return redirect()
            ->route('trades.index')
            ->with('success', 'Trade updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trade $trade)
    {
        $trade->delete();

        return redirect()
            ->route('trades.index')
            ->with('success', 'Trade deleted successfully');
    }
}
