<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Stock;
use App\Models\Trade;
use App\Models\Profit;
use App\Models\Trader;
use App\Models\Wallet;
use App\Models\Deposit;
use App\Models\Document;
use App\Models\Transfer;
use App\Models\Withdrawal;
use App\Models\TradingPlan;
use App\Mail\StockPurchased;
use App\Models\StockHistory;
use App\Models\TradeHistory;
use Illuminate\Http\Request;
use App\Mail\TradeStartedMail;
use App\Models\AccountBalance;
use App\Models\AccountDetails;
use App\Models\PaymentSetting;
use App\Models\PlanHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['deposits'] = Deposit::where('user_id', Auth::id())->get();

        // Fetching the user's KYC status
        $data['kyc_status'] = User::where('id', Auth::id())->pluck('kyc_status')->first();

        // Check if the status is 1, meaning KYC is approved
        $data['kyc_required'] = $data['kyc_status'] != 1;

        // Sum of pending deposits
        $data['pending_deposits_sum'] = Deposit::where('user_id', Auth::id())
            ->where('status', '0')
            ->sum('amount');

        // Sum of successful deposits
        $data['successful_deposits_sum'] = Deposit::where('user_id', Auth::id())
            ->where('status', '1')
            ->sum('amount');

        // Sum of pending withdrawals
        $data['pending_withdrawals_sum'] = Withdrawal::where('user_id', Auth::id())
            ->where('status', '0')
            ->sum('amount');

        // Sum of successful withdrawals
        $data['successful_withdrawals_sum'] = Withdrawal::where('user_id', Auth::id())
            ->where('status', '1')
            ->sum('amount');

        // Sum of successful account balance
        $data['balance_sum'] = AccountBalance::where('user_id', Auth::id())
            ->sum('amount');

        // Sum of successful account balance
        $data['profit_sum'] = Profit::where('user_id', Auth::id())
            ->sum('amount');
        $data['stockHistories'] = StockHistory::with('user')->get();



        // Total sum of all calculations
        $total_sum =
            $data['successful_deposits_sum'] +
            $data['successful_withdrawals_sum'] +
            $data['balance_sum'] +
            $data['profit_sum'];

        $data['total_sum'] = $total_sum;








        // Fetch all trades associated with the user

        $data['trades']  = Trade::with('user')->where('user_id', Auth::id())->get();

        $data['open_trades'] = Trade::with('user')
            ->where('user_id', Auth::id())
            ->where('status', 'open')
            ->get();

        $data['closed_trades'] = Trade::with('user')
            ->where('user_id', Auth::id())
            ->where('status', 'close')
            ->get();







        return view('dashboard.home', $data);
    }


    public function depositPage()
    {
        $data['payment'] = DB::table('payment_settings')->get();
        return view('dashboard.deposit', $data);
    }

    public function paymentPage(Request $request)
    {
        $payment_id = $request->input('payment_id');
        $data['payment'] = PaymentSetting::find($payment_id);
        $amount = $request->input('amount');
        $data['amount'] = $amount;

        $payment_method = $request->input('payment_method');

        // if ($payment_id == 'Paypal') {
        //     return view('user.bank', $data);
        // }

        // if ($payment_id == 'Bank Transfer') {
        //     return view('user.bank', $data);
        // }

        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        // // Store the deposit
        // $deposit = Deposit::create([
        //     'user_id' => Auth::id(),
        //     'amount' => $request->amount,
        //     'deposit_type' => 'crypto', // You can adjust this value dynamically
        //     'payment_mode' => $request->payment_id, // Storing the selected payment method
        //     'proof' => null, // Proof can be handled separately if needed
        //     'status' => 'pending', // Default status
        // ]);
        return view('dashboard.payment', $data);
    }


    /**
     * Store the deposit information.
     */
    public function storeDeposit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'wallet_address' => 'required|string',
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:20480', // Max 20MB
            'type' => 'required|string',
            'name' => 'required|string',
        ]);

        // Handle file upload
        $proofPath = null;
        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $proofPath = $file->storeAs('uploads/deposits', $filename, 'public');
        }

        // Create the deposit record
        Deposit::create([
            'user_id' => Auth::id(),
            'amount' => $request->input('amount'),
            'deposit_type' => $request->input('type'),
            'payment_mode' => $request->input('name'),
            'proof' => $proofPath,
            'status' => '0', // Default status
        ]);

        return redirect()->route('user.deposit')->with('success', 'Deposit successfully created!');
    }

    /**
     * Display a listing of deposits.
     */
    public function userDepositHistory()
    {
        $deposits = Deposit::where('user_id', Auth::id())->get();

        return view('dashboard.deposit_history', compact('deposits'));
    }


    public function copyTraderPage()
    {
        $data['traders'] = DB::table('traders')->get();
        return view('dashboard.copy_trader', $data);
    }


    public function showTraderPage($trader_id)
    {
        $data['trader'] = Trader::findOrFail($trader_id);

        $data['deposits'] = Deposit::where('user_id', Auth::id())->get();

        // Sum of pending deposits
        $data['pending_deposits_sum'] = Deposit::where('user_id', Auth::id())
            ->where('status', '0')
            ->sum('amount');

        // Sum of successful deposits
        $data['successful_deposits_sum'] = Deposit::where('user_id', Auth::id())
            ->where('status', '1')
            ->sum('amount');

        // Sum of pending withdrawals
        $data['pending_withdrawals_sum'] = Withdrawal::where('user_id', Auth::id())
            ->where('status', '0')
            ->sum('amount');

        // Sum of successful withdrawals
        $data['successful_withdrawals_sum'] = Withdrawal::where('user_id', Auth::id())
            ->where('status', '1')
            ->sum('amount');

        // Sum of successful account balance
        $data['balance_sum'] = AccountBalance::where('user_id', Auth::id())
            ->sum('amount');

        // Sum of successful account balance
        $data['profit_sum'] = Profit::where('user_id', Auth::id())
            ->sum('amount');
        return view('dashboard.show_trader', $data);
    }




    public function userStartTrade(Request $request)
    {
        // Validate the form input
        $request->validate([
            'amount' => 'required|numeric|min:1',
            //'withdraw_from' => 'required|string',
            'trader_name' => 'required|string',
            'trader_image' => 'required|string',
            // 'roi' => 'required|numeric',
            // 'trade_duration' => 'required|string',
            // 'top_up_interval' => 'required|string',
        ]);

        // Get current date and time
        $currentDate = now();
        $expiredAt = $currentDate->addDays((int) filter_var($request->trade_duration, FILTER_SANITIZE_NUMBER_INT));

        $user = Auth::user(); // Assuming the user is authenticated
        $amount = $request->amount;
        $withdrawFrom = $request->withdraw_from;

        // Validate and process withdrawal
        switch ($withdrawFrom) {
            case 'account_balance':
                $totalAccountBalance = AccountBalance::where('user_id', $user->id)->sum('amount');

                if ($amount > $totalAccountBalance) {
                    return back()->withErrors(['amount' => 'Insufficient account balance.']);
                }

                // Deduct the amount from account balance (oldest to newest)
                $remainingAmount = $amount;
                $accountBalances = AccountBalance::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();

                // foreach ($accountBalances as $accountBalance) {
                //     if ($remainingAmount <= 0) break;

                //     if ($accountBalance->amount >= $remainingAmount) {
                //         $accountBalance->amount -= $remainingAmount;
                //         $accountBalance->save();
                //         $remainingAmount = 0;
                //     } else {
                //         $remainingAmount -= $accountBalance->amount;
                //         $accountBalance->amount = 0;
                //         $accountBalance->save();
                //     }
                // }
                break;
            case 'deposit':
                $totalDeposits = $user->deposits()->where('status', '1')->sum('amount');
                // if ($amount > $totalDeposits) {
                //     return back()->withErrors(['amount' => 'Insufficient deposit balance.']);
                // }

                // Deduct the amount from deposits (oldest to newest)
                $remainingAmount = $amount;
                $deposits = $user->deposits()
                    ->where('status', '1')
                    ->orderBy('created_at', 'asc')
                    ->get();

                // foreach ($deposits as $deposit) {
                //     if ($remainingAmount <= 0) break;

                //     if ($deposit->amount >= $remainingAmount) {
                //         $deposit->amount -= $remainingAmount;
                //         $deposit->save();
                //         $remainingAmount = 0;
                //     } else {
                //         $remainingAmount -= $deposit->amount;
                //         $deposit->amount = 0;
                //         $deposit->save();
                //     }
                // }
                break;

            case 'profit':
                $totalProfit = Profit::where('user_id', $user->id)->sum('amount');

                if ($amount > $totalProfit) {
                    return back()->withErrors(['amount' => 'Insufficient profit balance.']);
                }

                // Deduct the amount from profits (oldest to newest)
                $remainingAmount = $amount;
                $profits = Profit::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();

                // foreach ($profits as $profit) {
                //     if ($remainingAmount <= 0) break;

                //     if ($profit->amount >= $remainingAmount) {
                //         $profit->amount -= $remainingAmount;
                //         $profit->save();
                //         $remainingAmount = 0;
                //     } else {
                //         $remainingAmount -= $profit->amount;
                //         $profit->amount = 0;
                //         $profit->save();
                //     }
                // }
                break;

            default:
                return back()->withErrors(['withdraw_from' => 'Invalid withdrawal type selected.']);
        }


        // Store trade history in the database
        TradeHistory::create([
            'user_id' => Auth::id(),
            'user_email' => $request->email,
            'status' => 'active',
            'trader_name' => $request->trader_name,
            'trader_image' => $request->trader_image,
            'asset' => $request->withdraw_from,
            'amount' => $request->amount,
            'roi' => $request->roi,
            'trade_duration' => $request->trade_duration,
            'top_up_interval' => $request->top_up_interval,
            'subscription_day' => $currentDate->toDateString(),
            'subscription_hour' => $currentDate->toTimeString(),
            'expired_at' => $expiredAt,
        ]);

        // Send an email notification
        $tradeDetails = [
            'user_name' => $user->name,
            'trader_name' => $request->trader_name,
            'amount' => $amount,
            'roi' => $request->roi,
            'trade_duration' => $request->trade_duration,
            'subscription_day' => $currentDate->toDateString(),
            'expired_at' => $expiredAt->toDateString(),
        ];

        // Mail::to($user->email)->send(new TradeStartedMail($tradeDetails));


        // Redirect with success message
        return redirect()->back()->with('success', 'Trade successfully started!');
    }


    public function showTradeHistory()
    {
        // Fetch all trade histories with related user data
        $data['tradeHistories'] = TradeHistory::with('user')->latest()->get();
        return view('dashboard.trade-history', $data);
    }


    public function showKycForm()
    {
        // Retrieve the user's document if it exists
        $document = Document::where('user_id', Auth::id())->first();

        return view('dashboard.verify', compact('document'));
    }


    /**
     * Handle KYC document upload.
     */
    public function uploadKycDocuments(Request $request)
    {
        // Validate the input files
        $request->validate([
            'id_card' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'passport_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Retrieve or create the user's document record
        $document = Document::firstOrNew(['user_id' => Auth::id()]);

        // Handle ID Card file upload
        if ($request->hasFile('id_card')) {
            $idCardPath = $request->file('id_card')->store('uploads/kyc/id_cards', 'public');
            $document->id_card_path = $idCardPath;
        }

        // Handle Passport Photograph file upload
        if ($request->hasFile('passport_photo')) {
            $passportPhotoPath = $request->file('passport_photo')->store('uploads/kyc/passport_photos', 'public');
            $document->passport_photo_path = $passportPhotoPath;
        }

        // Set the status to 'pending' and save the document
        $document->status = '0';
        $document->save();

        // Redirect back with a success message
        return back()->with('success', 'KYC documents uploaded successfully!');
    }

    public function updateProfilePage()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    public function updateProfile(Request $request, $section)
    {
        $user = Auth::user();

        switch ($section) {
            case 'personal_info':
                $data = $request->validate([
                    'name' => 'required|string|max:255',
                    'phone' => 'required|string|max:15',
                    'date_of_birth' => 'required|date',
                    'country' => 'required|string|max:255',
                ]);
                break;

            case 'account_details':
                $data = $request->validate([
                    'username' => 'required|string|max:255',
                    'account_type' => 'nullable|string|max:255',
                ]);
                break;

            case 'bank_details':
                $data = $request->validate([
                    'bank_name' => 'required|string|max:255',
                    'account_number' => 'required|string|max:20',
                ]);
                break;

            case 'kyc_documents':
                $data = $request->validate([
                    'id_card' => 'nullable|file|mimes:jpeg,png,pdf',
                    'passport' => 'nullable|file|mimes:jpeg,png,pdf',
                ]);
                if ($request->hasFile('id_card')) {
                    $data['id_card'] = $request->file('id_card')->store('kyc', 'public');
                }
                if ($request->hasFile('passport')) {
                    $data['passport'] = $request->file('passport')->store('kyc', 'public');
                }
                break;

            default:
                return back()->withErrors(['error' => 'Invalid section']);
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }


    public function contactUsPage()
    {
        // Display the Contact Us page
        return view('dashboard.contact');
    }

    public function contactUs(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            // Send an email (or save to database if needed)
            // Mail::send('emails.contact', $validatedData, function ($message) use ($validatedData) {
            //     $message->to('admin@example.com')
            //         ->subject('Contact Us Form: ' . $validatedData['subject']);
            // });

            // Redirect with success message
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to send your message. Please try again later.');
        }
    }


    public function userRefererPage()
    {
        // Get the authenticated user
        $referrer = Auth::user();

        // Fetch downliners (users referred by the authenticated user)
        $downliners = User::where('referred_by', $referrer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return the downliner view with data
        return view('dashboard.downliners', compact('downliners'));
    }



    /**
     * Show the withdrawal form.
     */
    public function userWithdrawalPage()
    {

        $data['deposits'] = Deposit::where('user_id', Auth::id())->get();

        // Sum of pending deposits
        $data['pending_deposits_sum'] = Deposit::where('user_id', Auth::id())
            ->where('status', '0')
            ->sum('amount');

        // Sum of successful deposits
        $data['successful_deposits_sum'] = Deposit::where('user_id', Auth::id())
            ->where('status', '1')
            ->sum('amount');

        // Sum of pending withdrawals
        $data['pending_withdrawals_sum'] = Withdrawal::where('user_id', Auth::id())
            ->where('status', '0')
            ->sum('amount');

        // Sum of successful withdrawals
        $data['successful_withdrawals_sum'] = Withdrawal::where('user_id', Auth::id())
            ->where('status', '1')
            ->sum('amount');

        // Sum of successful account balance
        $data['balance_sum'] = AccountBalance::where('user_id', Auth::id())
            ->sum('amount');

        // Sum of successful account balance
        $data['profit_sum'] = Profit::where('user_id', Auth::id())
            ->sum('amount');
        return view('dashboard.withdrawal', $data);
    }

    /**
     * Handle the withdrawal request submission.
     */
    public function userWithdrawal(Request $request)

    {
        $request->validate([
            'withdraw_from' => 'nullable|string',
            'method' => 'nullable|string',
            'amount' => 'nullable|numeric|min:1',
            'details' => 'nullable|string',
        ]);

        $user = Auth::user(); // Assuming the user is authenticated
        $amount = $request->amount;
        $withdrawFrom = $request->withdraw_from;

        // Validate and process withdrawal
        switch ($withdrawFrom) {
            case 'account_balance':
                $accountBalance = AccountBalance::where('user_id', $user->id)->first();

                if (!$accountBalance || $amount > $accountBalance->amount) {
                    return back()->withErrors(['amount' => 'Insufficient account balance.']);
                }

                $accountBalance->amount -= $amount;
                $accountBalance->save();
                break;

            case 'deposit':
                $totalDeposits = $user->deposits()->where('status', '1')->sum('amount');
                if ($amount > $totalDeposits) {
                    return back()->withErrors(['amount' => 'Insufficient deposit balance.']);
                }

                // Deduct the amount from deposits (oldest to newest)
                $remainingAmount = $amount;
                $deposits = $user->deposits()
                    ->where('status', '1')
                    ->orderBy('created_at', 'asc')
                    ->get();

                foreach ($deposits as $deposit) {
                    if ($remainingAmount <= 0) break;

                    if ($deposit->amount >= $remainingAmount) {
                        $deposit->amount -= $remainingAmount;
                        $deposit->save();
                        $remainingAmount = 0;
                    } else {
                        $remainingAmount -= $deposit->amount;
                        $deposit->amount = 0;
                        $deposit->save();
                    }
                }
                break;

            case 'profit':
                $totalProfit = Profit::where('user_id', $user->id)->sum('amount');

                if ($amount > $totalProfit) {
                    return back()->withErrors(['amount' => 'Insufficient profit balance.']);
                }

                // Deduct the amount from profits (oldest to newest)
                $remainingAmount = $amount;
                $profits = Profit::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();

                foreach ($profits as $profit) {
                    if ($remainingAmount <= 0) break;

                    if ($profit->amount >= $remainingAmount) {
                        $profit->amount -= $remainingAmount;
                        $profit->save();
                        $remainingAmount = 0;
                    } else {
                        $remainingAmount -= $profit->amount;
                        $profit->amount = 0;
                        $profit->save();
                    }
                }
                break;

            default:
                return back()->withErrors(['withdraw_from' => 'Invalid withdrawal type selected.']);
        }

        // Save the withdrawal request
        $withdrawal = Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'withdraw_from' => $withdrawFrom,
            'method' => $request->method,
            'status' => 'pending', // Default status
            'details' => $request->details,
        ]);

        return redirect()->route('user.withdrawal.page')->with('success', 'Withdrawal request submitted successfully.');
    }



    public function deposits()
    {
        $data['deposits'] = Deposit::where('user_id', Auth::id())->get();
        $data['wallets'] = Wallet::all();

        return view('dashboard.deposits', $data);
    }

    public function handleDeposit(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'deposit_type' => 'required',
            'amount' => 'required|numeric',
            'payment_mode' => 'required',
        ]);

        // Get the selected coin (wallet) based on payment_mode
        $payment_mode = $validatedData['payment_mode'];

        // Assuming Wallet model stores details about payment methods (like BTC, ETH, etc.)
        // Use where to search for a wallet by its payment mode (code or type)
        $wallet = Wallet::where('id', $payment_mode)->first();

        // Pass all necessary data to the view
        return view('dashboard.payment', [
            'wallet' => $wallet, // Wallet details
            'deposit_type' => $validatedData['deposit_type'], // Deposit type
            'amount' => $validatedData['amount'], // Amount
            'payment_mode' => $validatedData['payment_mode'], // Payment mode (e.g., BTC, ETH)
        ]);
    }


    public function handlePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deposit_type' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|string',
            'proof' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $depositType = $request->input('deposit_type');
        $amount = $request->input('amount');
        $paymentMode = $request->input('payment_mode');

        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            $filePath = $file->store('payment_proofs', 'public');
        }

        Deposit::create([
            'user_id' => Auth::user()->id,
            'deposit_type' => $depositType,
            'amount' => $amount,
            'payment_mode' => $paymentMode,
            'status' => '0',
            'proof' => $filePath ?? null,
        ]);

        return redirect()->route('deposits')->with('status', 'Payment submitted successfully!');
    }


    public function stocksPage()
    {
        $data['stocks'] = Stock::all();

        $data['deposits'] = Deposit::where('user_id', Auth::id())->get();

        // Sum of pending deposits
        $data['pending_deposits_sum'] = Deposit::where('user_id', Auth::id())
            ->where('status', '0')
            ->sum('amount');

        // Sum of successful deposits
        $data['successful_deposits_sum'] = Deposit::where('user_id', Auth::id())
            ->where('status', '1')
            ->sum('amount');

        // Sum of pending withdrawals
        $data['pending_withdrawals_sum'] = Withdrawal::where('user_id', Auth::id())
            ->where('status', '0')
            ->sum('amount');

        // Sum of successful withdrawals
        $data['successful_withdrawals_sum'] = Withdrawal::where('user_id', Auth::id())
            ->where('status', '1')
            ->sum('amount');

        // Sum of successful account balance
        $data['balance_sum'] = AccountBalance::where('user_id', Auth::id())
            ->sum('amount');

        // Sum of successful account balance
        $data['profit_sum'] = Profit::where('user_id', Auth::id())
            ->sum('amount');
        return view('dashboard.buy_stock', $data);
    }


    public function buyStock(Request $request)
    {
        $validated = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'stock_name' => 'required|string',
            'stock_image' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);


        $user = Auth::user(); // Assuming the user is authenticated
        $amount = $request->amount;
        $withdrawFrom = $request->withdraw_from;

        // Validate and process withdrawal
        switch ($withdrawFrom) {
            case 'account_balance':
                $accountBalance = AccountBalance::where('user_id', $user->id)->first();

                if (!$accountBalance || $amount > $accountBalance->amount) {
                    return back()->withErrors(['amount' => 'Insufficient account balance.']);
                }

                $accountBalance->amount -= $amount;
                $accountBalance->save();
                break;

            case 'deposit':
                $totalDeposits = $user->deposits()->where('status', '1')->sum('amount');
                if ($amount > $totalDeposits) {
                    return back()->withErrors(['amount' => 'Insufficient deposit balance.']);
                }

                // Deduct the amount from deposits (oldest to newest)
                $remainingAmount = $amount;
                $deposits = $user->deposits()
                    ->where('status', '1')
                    ->orderBy('created_at', 'asc')
                    ->get();

                foreach ($deposits as $deposit) {
                    if ($remainingAmount <= 0) break;

                    if ($deposit->amount >= $remainingAmount) {
                        $deposit->amount -= $remainingAmount;
                        $deposit->save();
                        $remainingAmount = 0;
                    } else {
                        $remainingAmount -= $deposit->amount;
                        $deposit->amount = 0;
                        $deposit->save();
                    }
                }
                break;

            case 'profit':
                $totalProfit = Profit::where('user_id', $user->id)->sum('amount');

                if ($amount > $totalProfit) {
                    return back()->withErrors(['amount' => 'Insufficient profit balance.']);
                }

                // Deduct the amount from profits (oldest to newest)
                $remainingAmount = $amount;
                $profits = Profit::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();

                foreach ($profits as $profit) {
                    if ($remainingAmount <= 0) break;

                    if ($profit->amount >= $remainingAmount) {
                        $profit->amount -= $remainingAmount;
                        $profit->save();
                        $remainingAmount = 0;
                    } else {
                        $remainingAmount -= $profit->amount;
                        $profit->amount = 0;
                        $profit->save();
                    }
                }
                break;

            default:
                return back()->withErrors(['withdraw_from' => 'Invalid withdrawal type selected.']);
        }

        $stock = Stock::findOrFail($request->stock_id);

        StockHistory::create([
            'user_id' => Auth::user()->id,
            'user_email' => Auth::user()->email,
            'status' => 'purchased',
            'stock_name' => $request->stock_name,
            'stock_image' => $request->stock_image,
            'amount' => $request->amount,
            'roi' => $stock->performance,
            'stock_duration' => $stock->duration,
            'top_up_interval' => $stock->top_up_interval,
            'subscription_day' => now()->format('l'),
            'subscription_hour' => now()->format('H:i:s'),

        ]);

        // Prepare email data
        $emailData = [
            'user_name' => $user->name,
            'stock_name' => $request->stock_name,
            'amount' => $amount,
            'roi' => $stock->performance,
            'stock_duration' => $stock->duration,
        ];


        // Send email
        Mail::to($user->email)->send(new StockPurchased($emailData));

        return redirect()->back()->with('success', 'Stock purchased successfully!');
    }





    public function stockHistory()
    {
        // Fetch the authenticated user's stock histories with pagination
        $stockHistories = StockHistory::where('user_id',  Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Adjust the number per page as needed

        return view('dashboard.stock_history', compact('stockHistories'));
    }

    public function showPlans()
    {

        $data['deposits'] = Deposit::where('user_id', Auth::id())->get();

        // Sum of pending deposits
        $data['pending_deposits_sum'] = Deposit::where('user_id', Auth::id())
            ->where('status', '0')
            ->sum('amount');

        // Sum of successful deposits
        $data['successful_deposits_sum'] = Deposit::where('user_id', Auth::id())
            ->where('status', '1')
            ->sum('amount');

        // Sum of pending withdrawals
        $data['pending_withdrawals_sum'] = Withdrawal::where('user_id', Auth::id())
            ->where('status', '0')
            ->sum('amount');

        // Sum of successful withdrawals
        $data['successful_withdrawals_sum'] = Withdrawal::where('user_id', Auth::id())
            ->where('status', '1')
            ->sum('amount');

        // Sum of successful account balance
        $data['balance_sum'] = AccountBalance::where('user_id', Auth::id())
            ->sum('amount');

        // Sum of successful account balance
        $data['profit_sum'] = Profit::where('user_id', Auth::id())
            ->sum('amount');

        $tradingPlans = TradingPlan::all(); // Fetch all trading plans
        return view('dashboard.buy_plan', compact('tradingPlans'), $data);
    }

    public function storePlanHistory(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan' => 'required|string',
            'amount' => 'required|numeric',
        ]);


        $user = Auth::user(); // Assuming the user is authenticated
        $amount = $request->amount;
        $withdrawFrom = $request->withdraw_from;

        // Validate and process withdrawal
        switch ($withdrawFrom) {
            case 'account_balance':
                $accountBalance = AccountBalance::where('user_id', $user->id)->first();

                if (!$accountBalance || $amount > $accountBalance->amount) {
                    return back()->withErrors(['amount' => 'Insufficient account balance.']);
                }

                $accountBalance->amount -= $amount;
                $accountBalance->save();
                break;

            case 'deposit':
                $totalDeposits = $user->deposits()->where('status', '1')->sum('amount');
                if ($amount > $totalDeposits) {
                    return back()->withErrors(['amount' => 'Insufficient deposit balance.']);
                }

                // Deduct the amount from deposits (oldest to newest)
                $remainingAmount = $amount;
                $deposits = $user->deposits()
                    ->where('status', '1')
                    ->orderBy('created_at', 'asc')
                    ->get();

                foreach ($deposits as $deposit) {
                    if ($remainingAmount <= 0) break;

                    if ($deposit->amount >= $remainingAmount) {
                        $deposit->amount -= $remainingAmount;
                        $deposit->save();
                        $remainingAmount = 0;
                    } else {
                        $remainingAmount -= $deposit->amount;
                        $deposit->amount = 0;
                        $deposit->save();
                    }
                }
                break;

            case 'profit':
                $totalProfit = Profit::where('user_id', $user->id)->sum('amount');

                if ($amount > $totalProfit) {
                    return back()->withErrors(['amount' => 'Insufficient profit balance.']);
                }

                // Deduct the amount from profits (oldest to newest)
                $remainingAmount = $amount;
                $profits = Profit::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();

                foreach ($profits as $profit) {
                    if ($remainingAmount <= 0) break;

                    if ($profit->amount >= $remainingAmount) {
                        $profit->amount -= $remainingAmount;
                        $profit->save();
                        $remainingAmount = 0;
                    } else {
                        $remainingAmount -= $profit->amount;
                        $profit->amount = 0;
                        $profit->save();
                    }
                }
                break;

            default:
                return back()->withErrors(['withdraw_from' => 'Invalid withdrawal type selected.']);
        }



        PlanHistory::create([
            'user_id' => $request->user_id,
            'plan' => $request->plan,
            'amount' => $request->amount,
            'type' => $request->withdraw_from, // Specify the type
        ]);

        return redirect()->back()->with('success', 'Plan successfully purchased!');
    }




    public function showPlanHistory()
    {
        $tradingHistory = PlanHistory::where('user_id', Auth::id())->paginate(10);
        return view('dashboard.plan_history', compact('tradingHistory'));
    }



    public function UserLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been logged out successfully.');
    }
}
