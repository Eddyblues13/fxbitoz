<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Trade;
use App\Models\TradeHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TradeController extends Controller
{

    // Display trades for a specific user
    public function index($id)
    {

        // Fetch the user
        $user = User::findOrFail($id);


        // Check if there is any trade history for this user
        $hasTradeHistory = TradeHistory::where('user_id', $user->id)->exists();

        // Redirect or allow access based on the condition
        if (!$hasTradeHistory) {
            return redirect()->back()->with('message', 'This user has no trade history. You cannot proceed.');
        }

        // Fetch unique trader names from the trade_histories table
        // Check if there is any trade history for this user
        $traders = TradeHistory::where('user_id', $user->id)->get();
        $trades = Trade::where('user_id', $user->id)->get();

        return view('admin.trades', compact('user', 'trades','traders', 'hasTradeHistory'));
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'asset' => 'required|string',
            'category' => 'required|string',
            'company' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'take_profit' => 'nullable|numeric|min:0',
            'stop_loss' => 'nullable|numeric|min:0',
        ]);

        Trade::create($validated);

        return redirect()->back()->with('message', 'Trade successfully created!');
    }

    // Update the specified trade in storage
    public function update(Request $request, Trade $trade)
    {
        $request->validate([
            'asset' => 'required|string',
            'category' => 'required|string',
            'company' => 'required|string',
            'amount' => 'required|numeric',
            'take_profit' => 'nullable|numeric',
            'stop_loss' => 'nullable|numeric',
            'status' => 'required|string',
        ]);

        $trade->update($request->all());

        return redirect()->back()->with('message', 'Trade updated successfully.');
    }

    // Remove the specified trade from storage
    public function destroy(Trade $trade)
    {
        $trade->delete();

        return redirect()->back()->with('message', 'Trade deleted successfully.');
    }
}
