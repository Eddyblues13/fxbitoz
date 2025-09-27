<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TraderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $traders = Trader::all();
        return view('admin.traders.index', compact('traders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.traders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'trader_name' => 'required|string|max:255',
            'followers' => 'required|numeric|min:0',  // Validate followers as a non-negative number
            'copier_roi' => 'required|numeric|min:0',  // Validate copier ROI as a non-negative number
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validate picture as an optional image
            'risk_index' => 'required|numeric|min:0|max:100',  // Validate risk index within a 0-100 range
            'total_copied_trade' => 'required|numeric|min:0',  // Validate total copied trade as a non-negative number
            'verified_status' => 'required|',  // Validate verified status field
        ]);


        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/traders'), $fileName);
            $validated['picture'] = 'uploads/traders/' . $fileName;
        }

        Trader::create($validated);

        return redirect()->route('traders.index')->with('success', 'Trader created successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function show(Trader $trader)
    {
        return view('admin.traders.show', compact('trader'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function edit(Trader $trader)
    {
        return view('admin.traders.edit', compact('trader'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trader $trader)
    {
        // Validate input fields
        $validated = $request->validate([
            'trader_name' => 'required|string|max:255',
            'followers' => 'required|numeric|min:0',  // Validate followers as a non-negative number
            'copier_roi' => 'required|numeric|min:0',  // Validate copier ROI as a non-negative number
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validate picture as an optional image
            'risk_index' => 'required|numeric|min:0|max:100',  // Validate risk index within a 0-100 range
            'total_copied_trade' => 'required|numeric|min:0',  // Validate total copied trade as a non-negative number
            'verified_status' => 'required|',  // Validate verified status field
        ]);

        // Check if a new picture is uploaded
        if ($request->hasFile('picture')) {
            // Delete the old picture if it exists
            if ($trader->picture && file_exists(public_path($trader->picture))) {
                unlink(public_path($trader->picture));
            }

            // Save the new picture
            $file = $request->file('picture');
            $filename = time() . '_trader.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/traders/'), $filename);
            $validated['picture'] = 'uploads/traders/' . $filename;
        }

        // Update trader details
        $trader->update($validated);

        return redirect()->route('traders.index')->with('success', 'Trader updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trader  $trader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trader $trader)
    {
        $trader->delete();

        return redirect()->route('traders.index')->with('success', 'Trader deleted successfully!');
    }
}
