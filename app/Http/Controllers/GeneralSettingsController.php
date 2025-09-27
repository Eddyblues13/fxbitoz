<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSettings;

class GeneralSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function edit()
    {
        $settings = GeneralSettings::first();
        return view('admin.site_settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_url' => 'required|url',
            'sitename' => 'required|string|max:255',
            'shortname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'currency' => 'required|string|max:3',
            'phone' => 'required|string|max:15',
            'country' => 'required|string|max:50',
            'bots' => 'required|boolean',
            'theme' => 'required|in:light,dark',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
        ]);

        $settings = GeneralSettings::first();
        if (!$settings) {
            $settings = new GeneralSettings();
        }

        $settings->update($validated);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
