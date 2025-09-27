<?php

namespace App\Http\Controllers\Admin;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::join('users', 'withdrawals.user_id', '=', 'users.id')
            ->select('withdrawals.*', 'users.first_name as name', 'users.email as user_email') // You can select any user fields you need
            ->get();

        return view('admin.withdrawals.index', compact('withdrawals'));
    }


    public function edit($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        return view('admin.withdrawals.edit', compact('withdrawal'));
    }

    public function update(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->update($request->all());
        return redirect()->route('withdrawals.index')->with('success', 'Withdrawal updated successfully');
    }

    public function destroy($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->delete();
        return redirect()->route('withdrawals.index')->with('success', 'Withdrawal deleted successfully');
    }

    public function approve($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->update(['status' => '1']);
        return redirect()->route('withdrawals.index')->with('success', 'Withdrawal approved successfully');
    }
}
