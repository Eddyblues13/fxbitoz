<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Trade;
use App\Models\Profit;
use App\Models\Deposit;
use App\Models\Transfer;
use App\Models\Withdrawal;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use App\Models\AccountBalance;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserManagementController extends Controller
{
    /**
     * Display all users
     */
    public function index()
    {
        $users = User::with(['accountBalance', 'profits', 'deposits', 'trade'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display user details
     */
    public function show($id)
    {
        $user = User::with(['accountBalance', 'profits', 'deposits', 'trade', 'withdrawals'])->findOrFail($id);

        // Calculate user statistics using your actual models
        $balance_sum = $user->accountBalance ? $user->accountBalance->amount : 0;
        $profit_sum = $user->profits->sum('amount');
        $successful_deposits_sum = $user->deposits()->where('status', 'approved')->sum('amount');

        return view('admin.users.details', compact(
            'user',
            'balance_sum',
            'profit_sum',
            'successful_deposits_sum'
        ));
    }

    /**
     * Update user information
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'country' => 'nullable|string|max:100',
            'account_status' => 'required|in:Active,Suspended,Pending,Inactive',
            'kyc_status' => 'required|in:not_submitted,pending,verified,rejected',
        ]);

        try {
            $user->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'username' => $request->first_name . $request->last_name, // or generate unique username
                'email' => $request->email,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'country' => $request->country,
                'status' => $request->account_status, // Using 'status' field from your User model
                'kyc_status' => $request->kyc_status,
            ]);

            // Log this action
            $this->logAdminAction('Updated user details for: ' . $user->email);

            return redirect()->back()->with('message', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    /**
     * Delete user permanently
     */
    public function destroy(Request $request, $id)
    {
        $request->validate([
            'confirmation' => 'required|in:DELETE'
        ]);

        $user = User::findOrFail($id);

        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account!');
        }

        try {
            // Store user email for logging before deletion
            $userEmail = $user->email;

            // Delete related records first (important for foreign key constraints)
            AccountBalance::where('user_id', $id)->delete();
            Profit::where('user_id', $id)->delete();
            Deposit::where('user_id', $id)->delete();
            Trade::where('user_id', $id)->delete();
            Withdrawal::where('user_id', $id)->delete();
            StockHistory::where('user_id', $id)->delete();
            Transfer::where('user_id', $id)->delete();

            // Then delete the user
            $user->delete();

            // Log this action
            $this->logAdminAction('Permanently deleted user: ' . $userEmail);

            return redirect()->route('manage.users.page')->with('message', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    /**
     * Suspend user account
     */
    public function suspend($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->update([
                'status' => 'Suspended', // Using 'status' field from your User model
            ]);

            // Log this action
            $this->logAdminAction('Suspended user account: ' . $user->email);

            return redirect()->back()->with('message', 'User account suspended successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error suspending user: ' . $e->getMessage());
        }
    }

    /**
     * Activate user account
     */
    public function activate($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->update([
                'status' => 'Active', // Using 'status' field from your User model
            ]);

            // Log this action
            $this->logAdminAction('Activated user account: ' . $user->email);

            return redirect()->back()->with('message', 'User account activated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error activating user: ' . $e->getMessage());
        }
    }

    /**
     * Reset user password
     */
    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        try {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            // Log this action
            $this->logAdminAction('Reset password for user: ' . $user->email);

            return redirect()->back()->with('message', 'Password reset successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error resetting password: ' . $e->getMessage());
        }
    }

    /**
     * Clear user account balances
     */
    public function clearAccount(Request $request, $id)
    {
        $request->validate([
            'confirmation' => 'required|in:CLEAR'
        ]);

        $user = User::findOrFail($id);

        try {
            // Clear account balance
            AccountBalance::where('user_id', $id)->update(['amount' => 0]);

            // Clear profits (you might want to keep history, so consider carefully)
            // Profit::where('user_id', $id)->delete(); // Uncomment if you want to delete profit history

            // Log this action
            $this->logAdminAction('Cleared account balance for user: ' . $user->email);

            return redirect()->back()->with('message', 'Account balance cleared successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error clearing account: ' . $e->getMessage());
        }
    }

    /**
     * Impersonate user (login as user)
     */
    public function impersonate($id)
    {
        $user = User::findOrFail($id);

        // Prevent impersonating other admins for security
        if ($user->role === 'admin') { // Using 'role' field from your User model
            return redirect()->back()->with('error', 'Cannot impersonate other administrators!');
        }

        try {
            // Store original admin ID in session
            session()->put('impersonator_id', Auth::id());

            // Login as the user
            Auth::login($user);

            // Log this action
            $this->logAdminAction('Started impersonating user: ' . $user->email);

            return redirect()->route('user.dashboard')->with('message', 'Now logged in as ' . $user->name);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error impersonating user: ' . $e->getMessage());
        }
    }

    /**
     * Stop impersonating and return to admin account
     */
    public function stopImpersonating()
    {
        $impersonatorId = session()->get('impersonator_id');

        if ($impersonatorId) {
            $admin = User::find($impersonatorId);

            if ($admin) {
                Auth::login($admin);
                session()->forget('impersonator_id');

                return redirect()->route('admin.dashboard')->with('message', 'Returned to admin account');
            }
        }

        return redirect('/');
    }

    /**
     * Update user signal strength (you'll need to add this field to users table)
     */
    public function updateSignalStrength(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'signal_strength' => 'required|integer|min:0|max:100',
        ]);

        $user = User::findOrFail($request->user_id);

        try {
            // If you add a 'signal_strength' field to users table
            $user->update([
                'signal_strength' => $request->signal_strength
            ]);

            // Log this action
            $this->logAdminAction('Updated signal strength to ' . $request->signal_strength . '% for user: ' . $user->email);

            return redirect()->back()->with('message', 'Signal strength updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating signal strength: ' . $e->getMessage());
        }
    }

    /**
     * Display user trades
     */
    public function userTrades($id)
    {
        $user = User::findOrFail($id);
        $trades = Trade::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.users.trades', compact('user', 'trades'));
    }

    /**
     * Add trade for user
     */
    public function addTrade(Request $request, $id)
    {
        $request->validate([
            'asset' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'take_profit' => 'nullable|numeric|min:0.01',
            'stop_loss' => 'nullable|numeric|min:0.01',
            'status' => 'required|in:open,closed,pending',
        ]);

        try {
            Trade::create([
                'user_id' => $id,
                'asset' => $request->asset,
                'category' => $request->category,
                'company' => $request->company,
                'amount' => $request->amount,
                'take_profit' => $request->take_profit,
                'stop_loss' => $request->stop_loss,
                'status' => $request->status,
            ]);

            // Log this action
            $this->logAdminAction('Added trade for user: ' . User::find($id)->email);

            return redirect()->back()->with('message', 'Trade added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding trade: ' . $e->getMessage());
        }
    }

    /**
     * Display user login activity (you'll need to create LoginActivity model)
     */
    public function loginActivity($id)
    {
        $user = User::findOrFail($id);
        // You'll need to create a LoginActivity model and migration
        // $loginActivities = LoginActivity::where('user_id', $id)->paginate(20);

        return view('admin.users.login-activity', compact('user'));
    }

    /**
     * Log admin actions for audit trail
     */
    private function logAdminAction($action)
    {
        Log::info('Admin Action: ' . Auth::user()->email . ' - ' . $action);
    }
}
