<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{
    public function index()
    {
        // Join deposits with users table based on the user_id field
        $deposits = Deposit::join('users', 'deposits.user_id', '=', 'users.id')
            ->select('deposits.*', 'users.first_name as name', 'users.email as user_email') // You can select any user fields you need
            ->get();

        return view('admin.deposits.index', compact('deposits'));
    }



    public function edit($id)
    {
        $deposit = Deposit::findOrFail($id);
        return view('admin.deposits.edit', compact('deposit'));
    }

    public function update(Request $request, $id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit->update($request->all());
        return redirect()->route('deposits.index')->with('success', 'Deposit updated successfully');
    }

    public function destroy($id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit->delete();
        return redirect()->route('deposits.index')->with('success', 'Deposit deleted successfully');
    }

    public function approve($id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit->update(['status' => '1']);
        return redirect()->route('deposits.index')->with('success', 'Deposit approved successfully');
    }
}
