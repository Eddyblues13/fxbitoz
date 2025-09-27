<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PaymentSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = PaymentSetting::all();
        return view('admin.payment_settings.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment_settings.create');
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
            'name' => 'nullable|string|max:255',
            'min_amount' => 'nullable|string|max:255',
            'max_amount' => 'nullable|string|max:255',
            'charges' => 'nullable|string|max:255',
            'charge_type' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'bar_code' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'wallet_address' => 'nullable|string|max:250',
            'wallet_type' => 'nullable|string|max:250',
            'wallet_network' => 'nullable|string|max:250',
            'icon' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'status' => 'nullable|string|max:255',
            'type_for' => 'nullable|string|max:255',
            'optional_note' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $validated['icon'] = $icon->store('uploads/icons', 'public');
        }

        if ($request->hasFile('bar_code')) {
            $barCode = $request->file('bar_code');
            $validated['bar_code'] = $barCode->store('uploads/barcodes', 'public');
        }

        PaymentSetting::create($validated);

        return redirect()->route('payment.index')->with('success', 'Payment setting created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentSetting  $paymentSetting
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentSetting $paymentSetting)
    {
        return view('admin.payment_settings.show', compact('paymentSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentSetting  $paymentSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentSetting $paymentSetting)
    {
        return view('admin.payment_settings.edit', compact('paymentSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentSetting  $paymentSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentSetting $paymentSetting)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'min_amount' => 'nullable|string|max:255',
            'max_amount' => 'nullable|string|max:255',
            'charges' => 'nullable|string|max:255',
            'charge_type' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'bar_code' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'wallet_address' => 'nullable|string|max:250',
            'wallet_type' => 'nullable|string|max:250',
            'wallet_network' => 'nullable|string|max:250',
            'icon' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'status' => 'nullable|string|max:255',
            'type_for' => 'nullable|string|max:255',
            'optional_note' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $validated['icon'] = $icon->store('uploads/icons', 'public');
        }

        if ($request->hasFile('bar_code')) {
            $barCode = $request->file('bar_code');
            $validated['bar_code'] = $barCode->store('uploads/barcodes', 'public');
        }

        $paymentSetting->update($validated);

        return redirect()->route('payment.index')->with('success', 'Payment setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentSetting  $paymentSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentSetting $paymentSetting)
    {
        $paymentSetting->delete();

        return redirect()->route('payment.index')->with('success', 'Payment setting deleted successfully.');
    }

    /**
     * Display payment settings in admin view.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentSettings()
    {
        $paymentSettings = PaymentSetting::all();
        return view('admin.payment_settings', compact('paymentSettings'));
    }

    /**
     * Add a new payment setting.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPayment(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'min_amount' => 'nullable|string|max:255',
            'max_amount' => 'nullable|string|max:255',
            'charges' => 'nullable|string|max:255',
            'charge_type' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'bar_code' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'wallet_address' => 'nullable|string|max:250',
            'wallet_type' => 'nullable|string|max:250',
            'icon' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'status' => 'nullable|string|max:255',
            'type_for' => 'nullable|string|max:255',
            'optional_note' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('uploads/icons', 'public');
        }

        if ($request->hasFile('bar_code')) {
            $validated['bar_code'] = $request->file('bar_code')->store('uploads/barcodes', 'public');
        }

        PaymentSetting::create($validated);

        return back()->with('message', 'Payment created successfully.');
    }
}
