<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Profit;
use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Models\AccountBalance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Credit/Debit user account using your models
     */
    public function creditDebitUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:Profit,balance,Deposit,Bonus',
            't_type' => 'required|in:Credit,Debit',
            'description' => 'nullable|string|max:500',
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($request->user_id);
            $amount = $request->t_type === 'Debit' ? -abs($request->amount) : abs($request->amount);

            // Handle different types of transactions based on your models
            switch ($request->type) {
                case 'balance':
                    // Update account balance
                    $accountBalance = AccountBalance::firstOrCreate(
                        ['user_id' => $user->id],
                        ['amount' => 0]
                    );

                    $newBalance = $accountBalance->amount + $amount;
                    if ($newBalance < 0) {
                        throw new \Exception("Insufficient balance for debit transaction");
                    }

                    $accountBalance->update(['amount' => $newBalance]);
                    break;

                case 'Profit':
                    // Add to profits
                    Profit::create([
                        'user_id' => $user->id,
                        'amount' => $amount
                    ]);
                    break;

                case 'Deposit':
                    // Add to deposits (only credit allowed for deposits)
                    if ($request->t_type === 'Credit') {
                        Deposit::create([
                            'user_id' => $user->id,
                            'amount' => $amount,
                            'deposit_type' => 'admin_adjustment',
                            'payment_mode' => 'admin',
                            'status' => 'approved'
                        ]);
                    } else {
                        throw new \Exception("Cannot debit from deposits");
                    }
                    break;

                case 'Bonus':
                    // Handle bonus - you might want to create a Bonus model or use account balance
                    $accountBalance = AccountBalance::firstOrCreate(
                        ['user_id' => $user->id],
                        ['amount' => 0]
                    );

                    $newBalance = $accountBalance->amount + $amount;
                    $accountBalance->update(['amount' => $newBalance]);
                    break;
            }

            // Log this action
            $this->logAdminAction(
                "{$request->t_type} {$request->amount} to {$request->type} for user: " . $user->email
            );

            DB::commit();

            return redirect()->back()->with(
                'message',
                "{$request->t_type} of $ {$request->amount} to {$request->type} completed successfully!"
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error processing transaction: ' . $e->getMessage());
        }
    }

    /**
     * Fund user wallet (using crypto address fields from User model)
     */
    public function fundUserWallet(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.00000001',
            'wallet_type' => 'required|in:Bitcoin,Ethereum,USDT,BNB,XRP,LTC', // Added LTC
            'transaction_type' => 'required|in:Credit,Debit',
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($request->user_id);

            // Since you don't have wallet balance fields, we'll use AccountBalance
            // or you can create a separate Wallet model later
            $accountBalance = AccountBalance::firstOrCreate(
                ['user_id' => $user->id],
                ['amount' => 0]
            );

            $amount = $request->transaction_type === 'Debit' ? -abs($request->amount) : abs($request->amount);
            $newBalance = $accountBalance->amount + $amount;

            if ($newBalance < 0) {
                throw new \Exception("Insufficient balance for debit transaction");
            }

            $accountBalance->update(['amount' => $newBalance]);

            // Log this action with wallet type info
            $this->logAdminAction(
                "{$request->transaction_type} {$request->amount} {$request->wallet_type} for user: " . $user->email
            );

            DB::commit();

            return redirect()->back()->with(
                'message',
                "{$request->transaction_type} of {$request->amount} {$request->wallet_type} completed successfully!"
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error processing wallet transaction: ' . $e->getMessage());
        }
    }

    private function logAdminAction($action)
    {
        Log::info('Admin Transaction Action: ' . auth()->user()->email . ' - ' . $action);
    }
}
