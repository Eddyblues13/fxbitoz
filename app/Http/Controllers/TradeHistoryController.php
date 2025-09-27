<?php

namespace App\Http\Controllers;

use App\Models\TradeHistory;
use Illuminate\Http\Request;

class TradeHistoryController extends Controller
{
    /**
     * Display a listing of the trade histories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tradeHistories = TradeHistory::all();
        return response()->json($tradeHistories);
    }

    /**
     * Store a newly created trade history in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'user_email' => 'nullable|email',
            'status' => 'required|string',
            'trader_name' => 'required|string',
            'trader_image' => 'required|string',
            'asset' => 'required|string',
            'amount' => 'required|string',
            'roi' => 'required|string',
            'trade_duration' => 'nullable|string',
            'top_up_interval' => 'nullable|string',
            'subscription_day' => 'nullable|string',
            'subscription_hour' => 'nullable|string',
            'expired_at' => 'nullable|date',
        ]);

        $tradeHistory = TradeHistory::create($request->all());
        return response()->json($tradeHistory, 201);
    }

    /**
     * Display the specified trade history.
     *
     * @param  TradeHistory  $tradeHistory
     * @return \Illuminate\Http\Response
     */
    public function show(TradeHistory $tradeHistory)
    {
        return response()->json($tradeHistory);
    }

    /**
     * Update the specified trade history in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  TradeHistory  $tradeHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TradeHistory $tradeHistory)
    {
        $tradeHistory->update($request->all());
        return response()->json($tradeHistory);
    }

    /**
     * Remove the specified trade history from storage.
     *
     * @param  TradeHistory  $tradeHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TradeHistory $tradeHistory)
    {
        $tradeHistory->delete();
        return response()->noContent();
    }
}
