<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Trade;
use App\Models\Profit;
use App\Models\Deposit;
use App\Models\Document;
use App\Models\Withdrawal;
use App\Mail\sendUserEmail;
use App\Models\StockHistory;
use App\Models\TradeHistory;
use Illuminate\Http\Request;
use App\Models\AccountBalance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionNotificationMail; 
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with a list of all users.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $data['users'] = User::select('users.id', 'users.username', 'users.name', 'users.email', 'users.created_at')
            ->leftJoin('account_balances', 'users.id', '=', 'account_balances.user_id')
            ->leftJoin('profits', 'users.id', '=', 'profits.user_id')
            ->groupBy('users.id', 'users.username', 'users.name', 'users.email', 'users.created_at')
            ->selectRaw('SUM(account_balances.amount) as balance_sum, SUM(profits.amount) as profit_sum')
            ->get();
        // Sum of account balance
        $data['balance_sum'] = AccountBalance::sum('amount');



        // Sum of pending deposits
        $data['pending_deposits_sum'] = Deposit::where('status', 'pending')->sum('amount');

        // Sum of successful deposits
        $data['total_deposits'] = Deposit::sum('amount');

        // Sum of pending withdrawals
        $data['pending_withdrawals_sum'] = Withdrawal::where('status', 'pending')->sum('amount');

        // Sum of successful withdrawals
        $data['total_withdrawals'] = Withdrawal::sum('amount');

        // sum total users
        $data['total_users'] = User::count();

        // sum total users
        $data['suspended_users'] = User::count();

        return view('admin.home', $data);
    }

    public function manageUsersPage()
    {
        $data['users'] = User::select('users.id', 'users.username', 'users.name', 'users.email', 'users.created_at')
            ->leftJoin('account_balances', 'users.id', '=', 'account_balances.user_id')
            ->leftJoin('profits', 'users.id', '=', 'profits.user_id')
            ->groupBy('users.id', 'users.username', 'users.name', 'users.email', 'users.created_at')
            ->selectRaw('SUM(account_balances.amount) as balance_sum, SUM(profits.amount) as profit_sum')
            ->get();


        return view('admin.manage_users', $data);
    }


    public function manageDepositsPage()
    {

        $data['deposits'] = User::join('deposits', 'users.id', '=', 'deposits.user_id')
            ->get(['users.email', 'users.name', 'deposits.*']);

        return view('admin.manage_deposit', $data);
    }

    public function manageWithdrawalsPage()
    {

        $data['withdrawals'] = User::join('withdrawals', 'users.id', '=', 'withdrawals.user_id')
            ->get(['users.email', 'users.name', 'withdrawals.*']);

        return view('admin.manage_withdrawal', $data);
    }


    public function viewDeposit($id)
    {

        $data['proof']  = Deposit::findOrFail($id);

        return view('admin.proof', $data);
    }

    public function processDeposit($id)
    {
        $deposit = Deposit::find($id);

        if (!$deposit) {
            return redirect()->back()->with('message', 'Deposit not found!');
        }

        if ($deposit->status === '1') {
            return redirect()->back()->with('message', 'Deposit already processed.');
        }

        $deposit->status = '1'; // Mark as processed
        $deposit->save();

        return redirect()->back()->with('message', 'Deposit processed successfully!');
    }

    /**
     * Delete a deposit.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteDeposit($id)
    {
        $deposit = Deposit::find($id);

        if (!$deposit) {
            return redirect()->back()->with('message', 'Deposit not found!');
        }

        $deposit->delete();

        return redirect()->back()->with('message', 'Deposit deleted successfully!');
    }

    public function viewWithdrawal($user_id, $withdrawal_id)
    {

        $data['withdrawal_details']  = Withdrawal::findOrFail($withdrawal_id);
        $data['user_details']  = User::findOrFail($user_id);


        return view('admin.user_withdrawal', $data);
    }


    public function manageKycPage()
    {
        $data['kyc'] = User::leftJoin('documents', 'users.id', '=', 'documents.user_id')
            ->get(['users.id as real_user_id', 'users.email', 'users.name', 'users.kyc_status', 'documents.*']);

        return view('admin.kyc', $data);
    }



    public function acceptKyc($id)
    {

        $user  = User::where('id', $id)->first();
        $user->kyc_status = 1;
        $user->save();
        return back()->with('message', 'Kyc Approved Successfully');
    }


    public function rejectKyc($id)
    {

        $user  = User::where('id', $id)->first();
        $user->kyc_status = 0;
        $user->save();
        return back()->with('message', 'Kyc Rejected Successfully');;
    }


    public function resetUserPassword($user_id)
    {

        $user = User::findOrFail($user_id);


        $user->update([
            'password' => Hash::make('user01236'),
        ]);

        return back()->with('message', 'Password has been reset successfully.');
    }


    public function clearAccount($id)
    {
        $user = User::find($id);
        if ($user) {

            // Delete related records (posts, comments, likes) associated with the user
            $user->profit()->delete();
            $user->deposits()->delete();
            $user->balance()->delete();
            $user->trade()->delete();
            $user->withdrawal()->delete();

            return back()->with('message', 'Records deleted successfully');
        } else {
            return back()->with('message', 'User Not Found');
        }
    }



    public function editUser(Request $request, User $user)
    {

        //$user = User::findOrFail($user_id);


        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',


        ]);

        $user->update([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'country' => $request->input('country'),
        ]);

        return back()->with('message', 'user updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();
            return redirect()->route('manage.users.page')->with('message', 'User deleted successfully');
        }

        return redirect()->route('manage.users.page')->with('error', 'User not found');
    }


    public function newUser(Request $request)
    {

        $user = new User;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->account_type = "Joint Account";
        $user->password = Hash::make($request['password']);
        $user->save();

        return back()->with('message', 'New User Created  Successfully');
    }



    public function sendMail(Request $request)
    {
        // Validate the request input
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = $request->message;

        // Prepare the data for the email (escaping any HTML tags for safety)
        $data = "<p>" . e($message) . "</p>";

        $subject = $request->subject;

        // Send the email using the SendUserEmail mailable
        Mail::to($request->email)->send(new SendUserEmail($data, $subject));

        // Redirect back with a success message
        return back()->with('status', 'Email successfully sent!');
    }






    /**
     * Display the user profile.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function viewUser($id)
    {
        $data['user'] = User::where('id', $id)
            ->first();;

        if (!$data['user']) {
            abort(404, 'User not found');
        }

        // Fetch deposits for the user
        $data['deposits'] = Deposit::where('user_id', $id)->get();

        // Sum of pending deposits
        $data['pending_deposits_sum'] = Deposit::where('user_id', $id)
            ->where('status', 'pending')
            ->sum('amount');

        // Sum of successful deposits
        $data['successful_deposits_sum'] = Deposit::where('user_id', $id)
            ->where('status', 'successful')
            ->sum('amount');

        // Sum of pending withdrawals
        $data['pending_withdrawals_sum'] = Withdrawal::where('user_id', $id)
            ->where('status', 'pending')
            ->sum('amount');

        // Sum of successful withdrawals
        $data['successful_withdrawals_sum'] = Withdrawal::where('user_id', $id)
            ->where('status', 'successful')
            ->sum('amount');

        // Sum of account balance
        $data['balance_sum'] = AccountBalance::where('user_id', $id)
            ->sum('amount');


        // Sum of profit
        $data['profit_sum'] = Profit::where('user_id', $id)
            ->sum('amount');



        return view('admin.user_data', $data);
    }





    public function creditUserPage($id)
    {
        $user = User::find($id);

        $data['user'] = $user;

        // Sum of successful account balance
        $data['balance_sum'] = AccountBalance::where('user_id',  $user->id)
            ->sum('amount');

        // Sum of successful account balance
        $data['profit_sum'] = Profit::where('user_id', $user)
            ->sum('amount');

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('admin.credit_user', $data);
    }

    /**
     * Open a new account.
     *
     * @return \Illuminate\View\View
     */
    public function openAccount()
    {
        // Display form for opening a new account
        return view('admin.open_account');
    }


    /**
     * Open a new account.
     *
     * @return \Illuminate\View\View
     */
    public function sendEmailPage()
    {
        // Display form for opening a new account
        return view('admin.send_email');
    }

    public function sendEmail(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $email = $request->input('email');
        $subject = $request->input('subject');
        $messageBody = $request->input('message');

        try {
            Mail::send([], [], function ($message) use ($email, $subject, $messageBody) {
                $message->to($email)
                    ->subject($subject)
                    ->setBody($messageBody, 'text/html');
            });

            return response()->json(['success' => 'Email sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email. Please try again.']);
        }
    }




    public function suspendAccount(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            // Logic to suspend the user account
            $user->account_suspended = 1;
            $user->save();

            return response()->json(['message' => 'Account suspended successfully.']);
        }

        return response()->json(['message' => 'User not found.'], 404);
    }

    public function unblockAccount(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            // Logic to unblock the user account
            $user->account_suspended = 0;
            $user->save();

            return response()->json(['message' => 'Account unblocked successfully.']);
        }

        return response()->json(['message' => 'User not found.'], 404);
    }
    /**
     * Update user details.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserDetail(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->first_name = $request->input('firstname');
            $user->last_name = $request->input('lastname');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->dob = $request->input('dob');
            $user->address = $request->input('addressB');
            $user->save();

            return response()->json(['success' => 'User details updated successfully.']);
        }

        return response()->json(['error' => 'User not found.'], 404);
    }


    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'country' => 'nullable|string|max:100',
            // 'ref_link' => 'required|url',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'first_name' => $request->username,
            'last_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            // 'ref_link' => $request->ref_link,
        ]);

        return redirect()->back()->with('message', 'User details updated successfully.');
    }

    /**
     * Update bank details.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateBankDetail(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->account_type = $request->input('accounttype');
            $user->account_number = $request->input('accountnumber');
            $user->currency = $request->input('usercurrency');
            $user->imf_code = $request->input('imf');
            $user->cot_code = $request->input('cot');
            $user->daily_limit = $request->input('daily_limit');
            $user->secret_code = $request->input('secretCode');
            $user->save();

            return response()->json(['success' => 'Bank details updated successfully.']);
        }

        return response()->json(['error' => 'User not found.'], 404);
    }

    /**
     * Fund a user account.
     *
     * @param string $accountnumber
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function fundUser($accountnumber, $id)
    {
        // Implement logic to fund user account
        return response()->view('admin.fund_user', compact('accountnumber', 'id'));
    }

    /**
     * View user transaction history.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function userTransaction($id)
    {
        // Implement logic to view user transactions
        return response()->view('admin.user_transaction', compact('id'));
    }

    /**
     * Track user transfers.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function userTransferTracking($id)
    {
        // Implement logic to track user transfers
        return response()->view('admin.user_transfer_tracking', compact('id'));
    }

    /**
     * Debit a user account.
     *
     * @param string $accountnumber
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function debitUser($accountnumber, $id)
    {
        // Implement logic to debit user account
        return response()->view('admin.debit_user', compact('accountnumber', 'id'));
    }

    /**
     * Update user profile photo.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto($id)
    {
        // Implement logic to update user profile photo
        return response()->view('admin.update_photo', compact('id'));
    }

    /**
     * View user activity.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function userActivity($id)
    {
        // Implement logic to view user activity
        return response()->view('admin.user_activity', compact('id'));
    }

    /**
     * Reset user password.
     *
     * @param int $userid
     * @return \Illuminate\Http\Response
     */
    public function userPasswordReset($userid)
    {
        // Implement logic to reset user password
        return response()->view('admin.user_password_reset', compact('userid'));
    }


    public function changeLogoFavicon()
    {
        // Display form for opening a new account
        return view('admin.change_logo_favicon');
    }



    public function creditUser(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'scope' => 'required|in:Account Balance,Profit',
            'emailnotify' => 'required|in:Yes,No',
            'memo' => 'nullable|string',
        ]);

        $user = User::findOrFail($request->id);
        $amount = $request->amount;
        $scope = $request->scope;

        if ($scope == 'Account Balance') {
            $accountBalance = new AccountBalance();
            $accountBalance->user_id = $user->id;
            $accountBalance->amount = $amount;
            $accountBalance->save();
        } else {
            $profit = new Profit();
            $profit->user_id = $user->id;
            $profit->amount = $amount;
            $profit->save();
        }

        // if ($request->emailnotify == 'Yes') {
        //     Mail::to($user->email)->send(new \App\Mail\CreditNotification($user, $amount, $scope, $request->memo));
        // }
        // Redirect back with a success message
        return back()->with('success', 'Funds have been credited successfully.');
    }



    // public function creditDebit(Request $request)
    // {
    //     $type = $request['type'];

    //     if ($type === 'Profit') {
    //         $transactionType = $request['t_type'];
    //         $creditDebit = new Profit;

    //         if ($transactionType === 'Credit') {
    //             $creditDebit->user_id = $request['user_id'];
    //             $creditDebit->amount = $request['amount'];
    //         } elseif ($transactionType === 'Debit') {
    //             $creditDebit->user_id = $request['user_id'];
    //             $creditDebit->amount = -$request['amount'];
    //         }
    //         $creditDebit->save();

    //         return back()->with('message', 'User Profit Topped Up Successfully');
    //     }

    //     // if ($type === 'Ref_Bonus') {
    //     //     $transactionType = $request['t_type'];
    //     //     $creditDebit = new Refferal;

    //     //     if ($transactionType === 'Credit') {
    //     //         $creditDebit->credit = $request['amount'];
    //     //         $creditDebit->debit = 0;
    //     //     } elseif ($transactionType === 'Debit') {
    //     //         $creditDebit->credit = 0;
    //     //         $creditDebit->debit = $request['amount'];
    //     //     }

    //     //     $creditDebit->status = '1';
    //     //     $creditDebit->user_id = $request['user_id'];
    //     //     $creditDebit->save();

    //     //     return back()->with('message', 'Referral Bonus Added Successfully');
    //     // }
    //     if ($type === 'balance') {
    //         $transactionType = $request['t_type'];
    //         $creditDebit = new AccountBalance();

    //         if ($transactionType === 'Credit') {
    //             $creditDebit->user_id = $request['user_id'];
    //             $creditDebit->amount = $request['amount'];
    //         } elseif ($transactionType === 'Debit') {
    //             $creditDebit->user_id = $request['user_id'];
    //             $creditDebit->amount = -$request['amount'];
    //         }
    //         $creditDebit->save();

    //         return back()->with('message', 'Account Balance Added Successfully');
    //     }



    //     if ($type === 'Deposit') {

    //         $transactionType = $request['t_type'];

    //         $creditDebit = new Deposit;

    //         if ($transactionType === 'Credit') {

    //             $creditDebit->amount = $request['amount'];
    //         } elseif ($transactionType === 'Debit') {

    //             return back()->with('message', 'Sorry you can not Debit Deposit');
    //         }
    //         $creditDebit->deposit_type = 'Express Deposit';
    //         $creditDebit->payment_mode = 'Express Deposit';
    //         $creditDebit->proof = 'Express Deposit';
    //         $creditDebit->status = '1';
    //         $creditDebit->user_id = $request->input('user_id');
    //         $creditDebit->save();

    //         return back()->with('message', 'Deposit Added Successfully');
    //     }
    // }


    public function creditDebit(Request $request)
    {
        $type = $request['type'];
        $transactionType = $request['t_type'];
        $amount = $request['amount'];
        $userId = $request['user_id'];

        if ($type === 'Profit') {
            $creditDebit = new Profit;

            $creditDebit->user_id = $userId;
            $creditDebit->amount = $transactionType === 'Credit' ? $amount : -$amount;
            $creditDebit->save();

            $this->sendTransactionEmail($userId, $transactionType, $amount, 'Profit');

            return back()->with('message', 'User Profit Topped Up Successfully');
        }

        if ($type === 'balance') {
            $creditDebit = new AccountBalance;

            $creditDebit->user_id = $userId;
            $creditDebit->amount = $transactionType === 'Credit' ? $amount : -$amount;
            $creditDebit->save();

            $this->sendTransactionEmail($userId, $transactionType, $amount, 'Account Balance');

            return back()->with('message', 'Account Balance Updated Successfully');
        }

        if ($type === 'Deposit') {
            if ($transactionType === 'Debit') {
                return back()->with('message', 'Sorry, you cannot Debit a Deposit');
            }

            $creditDebit = new Deposit;

            $creditDebit->user_id = $userId;
            $creditDebit->amount = $amount;
            $creditDebit->deposit_type = 'Express Deposit';
            $creditDebit->payment_mode = 'Express Deposit';
            $creditDebit->proof = 'Express Deposit';
            $creditDebit->status = '1';
            $creditDebit->save();

            $this->sendTransactionEmail($userId, $transactionType, $amount, 'Deposit');

            return back()->with('message', 'Deposit Added Successfully');
        }
    }

    /**
     * Send an email notification for the transaction.
     *
     * @param int $userId
     * @param string $transactionType
     * @param float $amount
     * @param string $transactionCategory
     * @return void
     */
    protected function sendTransactionEmail($userId, $transactionType, $amount, $transactionCategory)
    {
        $user = User::find($userId);

        if ($user) {
            $details = [
                'name' => $user->name,
                'transactionType' => $transactionType,
                'amount' => $amount,
                'transactionCategory' => $transactionCategory,
                'date' => now()->toDateTimeString(),
            ];

            Mail::to($user->email)->send(new TransactionNotificationMail($details));
        }
    }




    // Method to show the profile update form
    public function editProfile()
    {
        // Retrieve the authenticated admin using the 'admin' guard
        $admin = Auth::guard('admin')->user();
        return view('admin.admin_profile', compact('admin')); // Profile Blade file
    }

    // Method to handle the profile update
    public function updateProfile(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Update the profile of the authenticated admin
        $admin = Auth::guard('admin')->user();
        $admin->name = $request->firstname;
        // $admin->middlename = $request->middlename;
        // $admin->lastname = $request->lastname;
        // $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully!'
        ]);
    }

    // Method to handle password update
    public function updatePassword(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Retrieve the authenticated admin
        $admin = Auth::guard('admin')->user();

        // Check if the old password matches
        if (!Hash::check($request->old_password, $admin->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Old password is incorrect.'
            ], 422);
        }

        // Update the new password
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully!'
        ]);
    }



    public function showResetPasswordForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin.admin_change_user_password', compact('user'));
    }


    public function resetPassword(Request $request)
    {
        // Validate input
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'id' => 'required|exists:users,id',
        ]);

        // Find user by ID
        $user = User::findOrFail($request->id);

        // Update user password
        $user->password = Hash::make($request->password);
        $user->save();

        // Return success message
        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully.',
        ]);
    }


    public function impersonate(User $user)
    {
        // Store the original user's ID in the session (if not already stored)
        if (!session()->has('impersonate')) {
            session()->put('impersonate', Auth::id());
        }

        // Impersonate the specified user
        Auth::loginUsingId($user->id);

        // Get deposits and sums for the impersonated user
        $data['deposits'] = Deposit::where('user_id', $user->id)->get();
        $data['pending_deposits_sum'] = Deposit::where('user_id', $user->id)->where('status', 'pending')->sum('amount');
        $data['successful_deposits_sum'] = Deposit::where('user_id', $user->id)->where('status', 'successful')->sum('amount');
        $data['pending_withdrawals_sum'] = Withdrawal::where('user_id', $user->id)->where('status', 'pending')->sum('amount');
        $data['successful_withdrawals_sum'] = Withdrawal::where('user_id', $user->id)->where('status', 'successful')->sum('amount');
        $data['balance_sum'] = AccountBalance::where('user_id', $user->id)->sum('amount');
        $data['profit_sum'] = Profit::where('user_id', $user->id)->sum('amount');

        $data['trades']  = Trade::with('user')->where('user_id', $user->id)->get();


        // Total sum of all calculations
        $total_sum =
            $data['successful_deposits_sum'] +
            $data['successful_withdrawals_sum'] +
            $data['balance_sum'] +
            $data['profit_sum'];
 
        $data['total_sum'] = $total_sum;

        $data['open_trades'] = Trade::with('user')
            ->where('user_id', $user->id)
            ->where('status', 'open')
            ->get();

        $data['closed_trades'] = Trade::with('user')
            ->where('user_id', $user->id)
            ->where('status', 'close')
            ->get();

        // Fetching the user's KYC status
        $data['kyc_status'] = User::where('id', $user->id)->pluck('kyc_status')->first();


        // Check if the status is 1, meaning KYC is approved
        $data['kyc_required'] = $data['kyc_status'] != 1;


        // Redirect to the user's home page with the relevant data
        return view('dashboard.home', $data)->with('message', 'You are logged in as ' . $user->first_name . ' ' . $user->last_name);
    }


    public function leaveImpersonate()
    {
        // Check if the session has an 'impersonate' value
        if (session()->has('impersonate')) {
            // Retrieve the original user's ID from the session
            $originalUserId = session()->get('impersonate');

            // Log in as the original user
            Auth::loginUsingId($originalUserId);

            // Forget the impersonation session data
            session()->forget('impersonate');


            $data['users'] = User::select('users.id', 'users.name', 'users.email', 'users.created_at')
                ->leftJoin('account_balances', 'users.id', '=', 'account_balances.user_id')
                ->leftJoin('profits', 'users.id', '=', 'profits.user_id')
                ->groupBy('users.id', 'users.name', 'users.email', 'users.created_at')
                ->selectRaw('SUM(account_balances.amount) as balance_sum, SUM(profits.amount) as profit_sum')
                ->get();
            // Sum of account balance
            $data['balance_sum'] = AccountBalance::sum('amount');

            // Sum of pending deposits
            $data['pending_deposits_sum'] = Deposit::where('status', 'pending')->sum('amount');

            // Sum of successful deposits
            $data['total_deposits'] = Deposit::sum('amount');

            // Sum of pending withdrawals
            $data['pending_withdrawals_sum'] = Withdrawal::where('status', 'pending')->sum('amount');

            // Sum of successful withdrawals
            $data['total_withdrawals'] = Withdrawal::sum('amount');

            // sum total users
            $data['total_users'] = User::count();

            // sum total users
            $data['suspended_users'] = User::where('account_suspended', '1')->count();




            // Redirect to the original user's dashboard or home page
            return redirect()->route('admin.home', $data)->with('message', 'You have returned to your original account.');
        }

        // If no impersonation is happening, redirect to home
        return redirect()->route('admin.home')->with('message', 'No impersonation found.');
    }


    public function viewStockHistory()
    {
        $stockHistories = StockHistory::with('user')->get(); // Include related user data
        return view('admin.user_stock_history', compact('stockHistories'));
    }

    public function viewTradeHistory()
    {
        $tradeHistories = TradeHistory::with('user')->get();
        return view('admin.user_trade_history', compact('tradeHistories'));
    }

    public function addSignalStrength(Request $request)
    {
        // Validate the input
        $request->validate([
            'signal_strength' => 'required|integer|min:0|max:100',
            'user_id' => 'required|exists:users,id',
        ]);

        // Find the user by ID
        $user = User::find($request->user_id);

        if ($user) {
            // Update the user's signal_strength
            $user->signal_strength = $request->signal_strength;
            $user->save();

            return redirect()->back()->with('message', 'Signal strength updated successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }


    public function addTradePage()
    {
        //$stockHistories = StockHistory::with('user')->get(); // Include related user data
        return view('admin.trades');
    }
}
