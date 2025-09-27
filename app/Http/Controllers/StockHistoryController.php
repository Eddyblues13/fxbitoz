<?php

namespace App\Http\Controllers;

use App\Models\StockHistory;
use Illuminate\Http\Request;

class StockHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the stock histories.
     */
    public function index()
    {
        $stockHistories = StockHistory::all();
        return response()->json($stockHistories);
    }

    /**
     * Store a newly created stock history in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'user_email' => 'nullable|email|max:250',
            'status' => 'required|string|max:255',
            'stock_name' => 'required|string|max:255',
            'stock_image' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'roi' => 'required|string|max:255',
            'stock_duration' => 'nullable|string|max:255',
            'top_up_interval' => 'nullable|string|max:250',
            'subscription_day' => 'nullable|string|max:250',
            'subscription_hour' => 'nullable|string|max:250',
            'expired_at' => 'nullable|date',
        ]);

        $stockHistory = StockHistory::create($validated);

        return response()->json($stockHistory, 201);
    }

    /**
     * Display the specified stock history.
     */
    public function show(StockHistory $stockHistory)
    {
        return response()->json($stockHistory);
    }

    /**
     * Update the specified stock history in storage.
     */
    public function update(Request $request, StockHistory $stockHistory)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|required|integer',
            'user_email' => 'nullable|email|max:250',
            'status' => 'sometimes|required|string|max:255',
            'stock_name' => 'sometimes|required|string|max:255',
            'stock_image' => 'sometimes|required|string|max:255',
            'amount' => 'sometimes|required|string|max:255',
            'roi' => 'sometimes|required|string|max:255',
            'stock_duration' => 'nullable|string|max:255',
            'top_up_interval' => 'nullable|string|max:250',
            'subscription_day' => 'nullable|string|max:250',
            'subscription_hour' => 'nullable|string|max:250',
            'expired_at' => 'nullable|date',
        ]);

        $stockHistory->update($validated);

        return response()->json($stockHistory);
    }

    /**
     * Remove the specified stock history from storage.
     */
    public function destroy(StockHistory $stockHistory)
    {
        $stockHistory->delete();

        return response()->json(['message' => 'Stock history deleted successfully']);
    }
}
