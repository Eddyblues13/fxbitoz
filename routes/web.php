<?php

use App\Models\TradingPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\TradeController;
use App\Http\Controllers\Admin\TraderController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\StockHistoryController;
use App\Http\Controllers\TradeHistoryController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\BrandingController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Http\Controllers\Admin\SmtpSettingController;
use App\Http\Controllers\Admin\TradingPlanController;
use App\Http\Controllers\Admin\PaymentSettingController;

Route::get('/', function () {
    // Fetch all trading plans from the database
    $plans = TradingPlan::all();

    // Return the view and pass the data to it
    return view('home.homepage', compact('plans'));
});



Route::get('/about', function () {
    return view('home.about');
});
Route::get('/contact', function () {
    return view('home.contact');
});
Route::get('/faq', function () {
    return view('home.faq');
});
Route::get('/terms', function () {
    return view('home.terms');
});
Route::get('/investments', function () {
    return view('home.investments');
});
Route::get('/forgot-password', function () {
    return view('home.forgot-password');
});


Auth::routes();

// Verification Routes
Route::get('/verify/{id}', [CustomAuthController::class, 'verify'])->name('verify');
Route::post('/verify-code', [CustomAuthController::class, 'verifyCode'])->name('verify.code');
Route::get('/resend-verification-code', [CustomAuthController::class, 'resendVerificationCode'])->name('resend.verification.code');
Route::get('logout', [HomeController::class, 'UserLogout'])->name('user.logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::prefix('user')->middleware('user')->group(function () {
    // Existing routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/deposit', [HomeController::class, 'depositPage'])->name('user.deposit');
    Route::put('/deposit', [HomeController::class, 'paymentPage'])->name('user.payment');
    Route::post('/deposit', [HomeController::class, 'storeDeposit'])->name('user.store.deposit');
    Route::get('/deposits-history', [HomeController::class, 'userDepositHistory'])->name('user.deposits.history');
    Route::post('/payment', [HomeController::class, 'handlePayment'])->name('handle.payment');
    Route::get('/copy-trader', [HomeController::class, 'copyTraderPage'])->name('user.copy.trader.page');
    Route::get('/trader/{id}', [HomeController::class, 'showTraderPage'])->name('user.show.trader.page');
    Route::post('/start-trade', [HomeController::class, 'userStartTrade'])->name('user.start.trade');
    Route::get('/trade-history', [HomeController::class, 'showTradeHistory'])->name('user.show.trade.history');
    Route::get('/kyc', [HomeController::class, 'showKycForm'])->name('user.kyc.form');
    Route::post('/kyc/upload', [HomeController::class, 'uploadKycDocuments'])->name('user.kyc.upload');
    Route::get('/profile', [HomeController::class, 'updateProfilePage'])->name('user.profile.page');
    Route::post('/profile/update/{section}', [HomeController::class, 'updateProfile'])->name('profile.update');
    Route::get('/contact-us', [HomeController::class, 'contactUsPage'])->name('user.contact.page');
    Route::post('/contact-us', [HomeController::class, 'contactUs'])->name('contact.submit');
    Route::get('/referrer', [HomeController::class, 'userRefererPage'])->name('user.downliners.page');
    Route::get('/withdrawals', [HomeController::class, 'userWithdrawalPage'])->name('user.withdrawal.page');
    Route::post('/withdrawals', [HomeController::class, 'userWithdrawal'])->name('user.withdrawal');
    Route::get('/stocks', [HomeController::class, 'stocksPage'])->name('user.stocks.page');
    Route::post('/stocks/buy', [HomeController::class, 'buyStock'])->name('user.buy.stock');
    Route::get('/stock-history', [HomeController::class, 'stockHistory'])->name('user.stocks.history');







    Route::post('/account/upgrade', [HomeController::class, 'upgradeAccount'])->name('account.upgrade');
    Route::post('/account/change_pics', [HomeController::class, 'updateProfilePic'])->name('profile.pix.update');
    Route::post('/account/changetheme', [HomeController::class, 'changeTheme'])->name('theme.change');
    Route::get('/change_password', [HomeController::class, 'changePassword'])->name('password');
    Route::post('/change_password', [HomeController::class, 'updatePassword'])->name('password.update');
    Route::get('/support', [HomeController::class, 'support'])->name('support');
    Route::get('/notification', [HomeController::class, 'notification'])->name('notification');
    Route::get('/account_details', [HomeController::class, 'accountDetails'])->name('account.details');
    Route::post('/wallets/update', [HomeController::class, 'updateWallet'])->name('user.wallets.update');
    Route::post('/bank/update', [HomeController::class, 'updateBank'])->name('user.bank.update');

    Route::get('/refer_user', [HomeController::class, 'referUser'])->name('refer.user');
    // routes/web.php
    Route::get('/referrals', [HomeController::class, 'referral'])->name('referrals.index');

    Route::get('/trading_history', [HomeController::class, 'tradingHistory'])->name('trading.history');

    Route::get('/m_plans', [HomeController::class, 'mPlans'])->name('m.plans');
    Route::post('/m_plans', [HomeController::class, 'store'])->name('trade.store');
    Route::get('/my_plans', [HomeController::class, 'myPlans'])->name('my.plans');
    Route::get('/loans', [HomeController::class, 'loans'])->name('loans');
    Route::post('/loans', [HomeController::class, 'applyForLoan'])->name('loan.apply');
    Route::get('/send_funds', [HomeController::class, 'sendFundsPage'])->name('send.funds');
    Route::post('/send_funds', [HomeController::class, 'sendFunds'])->name('send.fund');



    //Route::post('/logout', [HomeController::class, 'UserLogout'])->name('logout');
    Route::resource('trade-histories', TradeHistoryController::class);
    Route::get('/plans', [HomeController::class, 'showPlans'])->name('user.show.plans');
    Route::get('/plan-history', [HomeController::class, 'showPlanHistory'])->name('user.show.plan.history');
    Route::post('/plan-history', [HomeController::class, 'storePlanHistory'])->name('user.store.plan.history');
});




Route::get('admin/login', [AdminLoginController::class, 'adminLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('login.submit');



// Admin Routes
Route::prefix('admin')->group(function () {
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Protecting admin routes using the 'admin' middleware
    Route::middleware(['admin'])->group(function () { // Admin Profile Routes
        Route::get('/profile', [AdminController::class, 'editProfile'])->name('admin.profile');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
        Route::post('/profile/password', [AdminController::class, 'updatePassword'])->name('admin.profile.password.update');
        Route::put('/admin/user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');

        Route::get('/change/user/password/page/{id}', [AdminController::class, 'showResetPasswordForm'])->name('admin.change.user.password.page');
        Route::post('/user-password-reset', [AdminController::class, 'resetPassword'])->name('admin.user.password_reset');


        Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
        Route::get('/manage-users', [AdminController::class, 'manageUsersPage'])->name('manage.users.page');
        Route::get('/manage-deposit', [AdminController::class, 'manageDepositsPage'])->name('manage.deposits.page');
        Route::get('/manage-withdrawals', [AdminController::class, 'manageWithdrawalsPage'])->name('manage.withdrawals.page');
        Route::get('/view-deposit/{id}/', [AdminController::class, 'viewDeposit']);
        Route::get('process-deposit/{id}', [AdminController::class, 'processDeposit'])->name('admin.process-deposit');
        Route::get('delete-deposit/{id}', [AdminController::class, 'deleteDeposit'])->name('admin.delete-deposit');
        Route::get('/view-withdrawal/{user_id}/{withdrawal_id}', [AdminController::class, 'viewWithdrawal']);
        Route::get('/manage-kyc', [AdminController::class, 'manageKycPage'])->name('manage.kyc.page');
        Route::get('/accept-kyc/{id}/', [AdminController::class, 'acceptKyc']);
        Route::get('/reject-kyc/{id}/', [AdminController::class, 'rejectKyc']);
        Route::get('/reset-password/{user}', [AdminController::class, 'resetUserPassword'])->name('reset.password');
        Route::get('/clear-account/{id}', [AdminController::class, 'clearAccount'])->name('clear.account');

        Route::get('/{user}/impersonate',  [AdminController::class, 'impersonate'])->name('users.impersonate');
        Route::get('/leave-impersonate',  [AdminController::class, 'leaveImpersonate'])->name('users.leave-impersonate');

        Route::post('/edit-user/{user}', [AdminController::class, 'editUser'])->name('edit.user');
        Route::post('/add-new-user',  [AdminController::class, 'newUser'])->name('add.user');
        Route::get('/delete-user/{user}',  [AdminController::class, 'deleteUser'])->name('delete.user');
        Route::match(['get', 'post'], '/send-mail', [AdminController::class, 'sendMail'])->name('admin.send.mail');
        // Route for viewing user details
        Route::get('/user/{id}', [AdminController::class, 'viewUser'])->name('admin.user.view');
        Route::post('/transfer/suspend/{id}', [AdminController::class, 'suspendTransfer'])->name('transfer.suspend');
        Route::post('/transfer/unblock/{id}', [AdminController::class, 'unblockTransfer'])->name('transfer.unblock');
        Route::post('/account/suspend/{id}', [AdminController::class, 'suspendAccount'])->name('account.suspend');
        Route::post('/account/unblock/{id}', [AdminController::class, 'unblockAccount'])->name('account.unblock');

        // Define the route for opening an account
        Route::get('/user/open', [AdminController::class, 'openAccount'])->name('admin.user.open');



        // Route for viewing user details
        Route::get('/credit-user/{id}', [AdminController::class, 'creditUserPage'])->name('admin.credit.user.page');

        Route::post('credit-debit', [AdminController::class, 'creditDebit'])->name('credit-debit');


        // Route::post('/credit-user', [AdminController::class, 'creditUser'])->name('credit_user');


        // Route for updating user details
        Route::post('/user/update/{id}', [AdminController::class, 'updateUserDetail'])->name('update_user_detail');

        // Route for updating bank details
        Route::post('/user/update/bank/{id}', [AdminController::class, 'updateBankDetail'])->name('update_bank_detail');

        // Route for fund user
        Route::get('/user/fund/{accountnumber}/{id}', [AdminController::class, 'fundUser'])->name('fund_user');

        // Route for user transaction history
        Route::get('/user/transaction/{id}', [AdminController::class, 'userTransaction'])->name('user_transaction');

        // Route for user transfer tracking
        Route::get('/user/transfer/tracking/{id}', [AdminController::class, 'userTransferTracking'])->name('user_transfer_tracking');

        // Route for debit user
        Route::get('/user/debit/{accountnumber}/{id}', [AdminController::class, 'debitUser'])->name('debit_user');

        // Route for changing user photo
        Route::get('/user/photo/{id}', [AdminController::class, 'updatePhoto'])->name('update_photo');

        // Route for user activity
        Route::get('/user/activity/{id}', [AdminController::class, 'userActivity'])->name('user_activity');

        // Route for user password reset
        Route::get('/user/password/reset/{userid}', [AdminController::class, 'userPasswordReset'])->name('user_password_reset');


        // Route for changing email user
        Route::get('/send/email', [AdminController::class, 'sendEmailPage'])->name('send.email');
        Route::post('/send/email', [AdminController::class, 'sendEmail'])->name('send.mail');

        // logo favicon settings
        Route::get('/branding', [BrandingController::class, 'index'])->name('branding.index');
        Route::post('/branding/update', [BrandingController::class, 'update'])->name('branding.update');

        Route::get('/smtp-settings', [SmtpSettingController::class, 'index'])->name('smtp.settings');
        Route::post('/smtp-settings', [SmtpSettingController::class, 'update'])->name('smtp.update');

        // Wallet resource routes
        Route::resource('wallets', WalletController::class);
        // Deposit resource routes
        Route::resource('deposits', DepositController::class);
        Route::patch('deposits/{deposit}/approve', [DepositController::class, 'approve'])->name('deposits.approve');

        // Withdrawal resource routes
        Route::resource('withdrawals', WithdrawalController::class);
        Route::patch('withdrawals/{withdrawal}/approve', [WithdrawalController::class, 'approve'])->name('withdrawals.approve');

        //kyc resource routes
        Route::resource('kyc', KycController::class);
        Route::get('kyc/{id}/approve', [KycController::class, 'approve'])->name('kyc.approve');

        //trade resource routes
        // Resource routes for Stock
        Route::resource('stock', StockController::class);
        Route::resource('traders', TraderController::class);
        Route::resource('payment', PaymentSettingController::class);

        // Route::get('admin/stock/{stock}/edit', [StockController::class, 'edit'])->name('stock.edit');

        // Route::get('/stock/{stock}/edit', [StockController::class, 'edit'])->name('stock.edit'); // Edit route
        // Route::delete('/stock/{stock}', [StockController::class, 'destroy'])->name('stock.destroy'); // Destroy route

        Route::get('/stock-history', [AdminController::class, 'viewStockHistory'])->name('admin.stock.history');

        Route::get('/trade-histories', [AdminController::class, 'viewTradeHistory'])->name('admin.trade_histories');

        Route::get('/trading-plans/create', [TradingPlanController::class, 'create'])->name('admin.create-trading-plan');
        Route::post('/trading-plans/store', [TradingPlanController::class, 'store'])->name('admin.store-trading-plan');
        Route::get('/trading-plans', [TradingPlanController::class, 'index'])->name('admin.view-trading-plans');
        Route::get('/trading-plans/edit/{id}', [TradingPlanController::class, 'edit'])->name('admin.edit-trading-plan');
        Route::post('/trading-plans/update/{id}', [TradingPlanController::class, 'update'])->name('admin.update-trading-plan');
        Route::delete('/trading-plans/delete/{id}', [TradingPlanController::class, 'destroy'])->name('admin.delete-trading-plan');
        Route::post('/add-signal-strength', [AdminController::class, 'addSignalStrength'])->name('admin.add_signal_strength');
        Route::get('/user/{id}/trades', [TradeController::class, 'index'])->name('admin.user.trades');
        Route::post('/trades', [TradeController::class, 'store'])->name('admin.trades.store');
        Route::put('/trades/{trade}', [TradeController::class, 'update'])->name('admin.trades.update');
        Route::delete('/trades/{trade}', [TradeController::class, 'destroy'])->name('admin.trades.destroy');
    });
});
