<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Mail\WelcomeEmail;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'account_type' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'country' => 'required|string',
            'terms' => 'accepted',
            'third_first_name' => ['nullable', 'string', 'max:255'],
            'third_last_name' => ['nullable', 'string', 'max:255'],
            'third_phone' => ['nullable', 'string', 'max:20'],
            'third_address' => ['nullable', 'string', 'max:255'],
        ]);
    }

    /**
     * Show the registration form with referral link handling.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        $referred_by = null;

        // Check if there's a referral code in the URL query parameters
        if ($request->has('ref')) {
            $referred_by = User::where('referral_code', $request->query('ref'))->first();
        }

        return view('auth.register', ['referred_by' => $referred_by]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Auto-generate unique account number
        do {
            $account_number =  mt_rand(10000000, 99999999);
        } while (User::where('account_number', $account_number)->exists());


        // Create a new user record in the database
        $user = User::create([
            'account_type' => $data['account_type'],
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'],
            'ref_by' => $data['ref_by'] ?? null, // Store referral ID if present
            'third_first_name' => $data['third_first_name'] ?? null,
            'third_last_name' => $data['third_last_name'] ?? null,
            'third_phone' => $data['third_phone'] ?? null,
            'third_address' => $data['third_address'] ?? null,
            'account_number'     => $account_number,
        ]);

        // Generate a verification code and set its expiration
        // $verificationCode = rand(1000, 9999);
        // $user->update([
        //     'verification_code' => $verificationCode,
        //     'verification_expiry' => now()->addMinutes(10),
        // ]);

        // Prepare email content
        $emailContent = "
    <p>Thank you for registering on our platform. Below are your login details:</p>
    <ul>
        <li><strong>Password:</strong> {$data['email']}</li>
       <li><strong>Password:</strong> {$data['password']}</li>

    </ul>
    <p>We recommend you keep this information safe and secure.</p>
    <p>Best Regards,<br> The Team</p>
        ";

        // Send verification email (uncomment this to enable email sending)
        // Mail::to($user->email)->send(new VerificationEmail($emailContent));

        Mail::to($user->email)->send(new WelcomeEmail($emailContent));

        return $user;
    }
}
