<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomAuthController extends Controller
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
        // Check the user's role and redirect accordingly
        $user = Auth::user();

        if ($user) {
            switch ($user->role) {
                case 'advertiser':
                    return view('dashboard.homepage');
                case 'media_org':
                    return redirect()->route('media_org.dashboard');
                case 'marketer':
                    return redirect()->route('marketer.dashboard');
                default:
                    return redirect('/home'); // Redirect to a default route or home if role is not recognized
            }
        }

        // If no user is authenticated, redirect to login
        ///
        return redirect()->route('login');
    }


    public function verify($id)
    {
        $user = User::where('id', $id)->first();
        $data['email'] = $user->email;
        $data['hash'] = $user->password;
        $data['id'] = $user->id;

        return view('auth.email_verify', $data);
    }






    public function verifyCode(Request $request)
    {
        // Validate the input
        $request->validate([
            'verification_code' => ['required', 'integer'],
        ]);

        $user = Auth::user();

        // Check if the verification code is correct and not expired
        if ($user->verification_code === $request->verification_code) {
            if (now()->lt($user->verification_expiry)) {
                // Mark email as verified
                $user->is_verified = 1;
                $user->save();



                $full_name =  $user->fname . ' ' .  $user->lname;
                $email = $user->email;



                $message = "<p style='line-height: 24px;margin-bottom:15px;'>
                Hello $full_name,
                </p>
                <br>
                <p>We are so happy to have you on board, and thank you for joining us.</p>
                <br>
                <p>
                <a href='https://cytopiacapital.com/home' style='display: inline-block; padding: 10px 20px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 5px;'>
                Continue To Your Account
                </a>
                </p>
                <br>
                <p>Don't hesitate to get in touch if you have any questions; we'll always get back to you</p>";



                // Mail::to($email)->send(new WelcomeEmail($message));

                return redirect()->route('home')->with('success', 'Your email has been verified successfully!');
            } else {
                return redirect()->back()->withErrors(['verification_code' => 'The verification code has expired. Please request a new one.']);
            }
        } else {
            return back()->withErrors(['verification_code' => 'The verification code is incorrect.']);
        }
    }



    public function resendVerificationCode(Request $request)
    {
        $user = $request->user();

        // Generate and save the verification code and expiry time
        $validToken = rand(1000, 9999);
        $user->verification_code = $validToken;
        $user->verification_expiry = now()->addMinutes(10); // Code expires in 10 minutes
        $user->save();

        $full_name =  $user->fname . ' ' .  $user->lname;
        $email = $user->email;

        $vmessage = "
       <p style='line-height: 24px;margin-bottom:15px;'>
             Hello $full_name,
       </p>
       <br>
        <p>
        We are so happy to have you on board, and thank you for joining us.
        </p>
        <p>
       We just need to verify your email address before you can access cytopiacapital.
       </p>
       <br>
       <p>
      Use this code to verify your email: <strong>$validToken</strong>
      </p>
      <p style='color: red;'>
      Please note that this code will expire in 10 minutes.
     </p>
    <br>
    <p>
    Don't hesitate to get in touch if you have any questions; we'll always get back to you.
    </p>
    ";

        Mail::to($email)->send(new VerificationEmail($vmessage));

        // Flash success message to the session
        return redirect()->back()->with('success', 'A new verification code has been sent to your email.');
    }
}
