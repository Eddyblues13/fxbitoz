<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="3w5AVl4D6j0qwvQbEgRWQxreNZZiGCgF2CFyzuZH">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="bingbot" content="noindex, nofollow">
    <meta name="scam-advisor" content="noindex, nofollow">
    <meta name="scam-adviser" content="noindex, nofollow">
    <meta name="scamadviser" content="noindex, nofollow">
    <meta name="google" content="noindex, nofollow">

    <link rel="icon" href="account/storage/app/public/photos/uPYDzhfavicon.png1677339254" type="image/png" />
    <link href="account/temp/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="account/temp/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="account/temp/css/line.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="account/temp/css/style.css" rel="stylesheet" type="text/css" />
    <link href="account/temp/css/colors/default.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body class="h-100 bg-soft-primary">
    <section class="y auth" style="background-color:black">
        <div class="container">
            <div class="pb-3 row justify-content-center">
                <div class="col-12 col-md-6 col-lg-6 col-sm-10 col-xl-6">
                    <div class="text-center">
                        <a href="/"><img src="{{ asset('logo.png') }}" alt="" class="mb-3 img-fluid auth__logo"
                                style="width:180px"></a>
                    </div>

                    <div class="bg-white shadow card login-page roundedd border-1">
                        <div class="card-body">
                            <h4 class="text-center card-title">User Login</h4>
                            <form method="POST" action="{{ route('login') }}" class="mt-4 login-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="login">Email or Username <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="email" name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter Email or Username" required>
                                            @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <input type="password" id="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Enter Password" required>
                                            @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group d-flex justify-content-between">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" id="remember" name="remember"
                                                    class="custom-control-input">
                                                <label class="custom-control-label" for="remember">Remember Me</label>
                                            </div>
                                            <a href="{{ route('password.request') }}" class="text-primary">Forgot
                                                Password?</a>
                                        </div>
                                    </div>
                                    <div class="mb-0 col-lg-12">
                                        <button class="btn btn-primary btn-block pad" type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="account/temp/js/jquery-3.5.1.min.js"></script>
    <script src="account/temp/js/bootstrap.bundle.min.js"></script>
    <script src="account/temp/js/owl.carousel.min.js"></script>
    <script src="account/temp/js/owl.init.js"></script>
    <script src="account/temp/js/feather.min.js"></script>
    <script src="account/temp/js/bundle.js"></script>
    <script src="account/temp/js/app.js"></script>
    <script src="account/temp/js/widget.js"></script>
    <script>
        $('#input1').on('keypress', function(e) {
            return e.which !== 32;
        });
    </script>
</body>

</html>