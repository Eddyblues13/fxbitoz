@include('home.header')
    <!-- toastr-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
           alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- Start Page Title Area -->
<div class="page-title-area bg-9">
    <div class="container">
        <div class="page-title-content">
            <h2>Email Verification</h2>
            <ul>
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="active">Verify Email</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Verification Area -->
<section class="user-area-all-style verification-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h2>Verify your email address</h2>
            <p>We have sent a verification code to your email. Please enter the code below to verify your account.</p>
        </div>

        <div class="contact-form-action">
            <form method="POST" action="{{ route('verify.code') }}" accept-charset="utf-8">
                @csrf
                <div class="row">
                    
                    <!-- Verification Code -->
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <input class="form-control @error('verification_code') is-invalid @enderror"
                                   type="text" name="verification_code"
                                   placeholder="Enter Verification Code" required>
                            @error('verification_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                                    @error('verification_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" class="btn btn-primary">Verify Email</button>
                    </div>
                    
                    <!-- Resend Verification Code -->
                    <div class="col-12">
                        <p class="account-desc">
                            Didn't receive the code?
                            <a href="{{ route('resend.verification.code') }}">Resend Verification Code</a>
                        </p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>
<!-- End Verification Area -->

@include('home.footer')
