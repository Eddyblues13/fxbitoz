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
    <!-- Icons -->
    <link href="account/temp/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="account/temp/css/line.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Main Css -->
    <link href="account/temp/css/style.css" rel="stylesheet" type="text/css" />
    <link href="account/temp/css/colors/default.css" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>

<body class="h-100 bg-soft-primary">
    <script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "c0e51a93-afe6-4887-b6f7-a7cbeff14c63";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>
    <section class="y auth" style="background-color:black">
        <div class="container">
            <div class="pb-3 row justify-content-center">

                <div class="col-12 col-md-6 col-lg-6 col-sm-10 col-xl-6">
                    <div class="text-center">
                        <a href="/"><img src="{{ asset('logo.png') }}" alt="" class="mb-3 img-fluid auth__logo"
                                style="width:180px"></a>
                    </div>




                    <div class="bg-white shadow card login-page roundedd border-1 ">
                        <div class="card-body">
                            <h4 class="text-center card-title">Create an Account</h4>
                            <form method="POST" action="{{ route('register') }}" class="mt-4 login-form">
                                @csrf
                                <div class="row">
                                    <!-- Account Type -->
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="selector">Account Type</label>
                                            <select id="selector" onchange="yesnoCheck(this);"
                                                class="w3-input w3-border form-control @error('account_type') is-invalid @enderror"
                                                name="account_type" required>
                                                <option value="">Select account type</option>
                                                <option value="Personal" {{ old('account_type')=='Personal' ? 'selected'
                                                    : '' }}>Personal Account</option>
                                                <option value="Joint" {{ old('account_type')=='Joint' ? 'selected' : ''
                                                    }}>Joint Account</option>
                                            </select>
                                            @error('account_type')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Username -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="input1">Username <span class="text-danger">*</span></label>
                                            <input type="text" id="input1" name="username" value="{{ old('username') }}"
                                                class="form-control @error('username') is-invalid @enderror"
                                                placeholder="Enter Unique Username" required>
                                            @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Full Name -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="f_name">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" id="f_name" name="name" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter Full Name" required>
                                            @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Your Email <span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="name@example.com" required>
                                            @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Enter Phone Number" required>
                                            @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password -->
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

                                    <!-- Confirm Password -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="confirm-password">Confirm Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" id="confirm-password" name="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                placeholder="Confirm Password" required>
                                            @error('password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="country">Country <span class="text-danger">*</span></label>
                                            <select id="country" name="country"
                                                class="form-control @error('country') is-invalid @enderror" required>
                                                <option value="" disabled {{ old('country') ? '' : 'selected' }}>Choose
                                                    Country</option>
                                                <option value="Afghanistan" {{ old('country')=='Afghanistan'
                                                    ? 'selected' : '' }}>Afghanistan</option>
                                                <option value="Albania" {{ old('country')=='Albania' ? 'selected' : ''
                                                    }}>Albania</option>
                                                <option value="Algeria" {{ old('country')=='Algeria' ? 'selected' : ''
                                                    }}>Algeria</option>
                                                <option value="Andorra" {{ old('country')=='Andorra' ? 'selected' : ''
                                                    }}>Andorra</option>
                                                <option value="Angola" {{ old('country')=='Angola' ? 'selected' : '' }}>
                                                    Angola</option>
                                                <option value="Antigua and Barbuda" {{
                                                    old('country')=='Antigua and Barbuda' ? 'selected' : '' }}>Antigua
                                                    and Barbuda</option>
                                                <option value="Argentina" {{ old('country')=='Argentina' ? 'selected'
                                                    : '' }}>Argentina</option>
                                                <option value="Armenia" {{ old('country')=='Armenia' ? 'selected' : ''
                                                    }}>Armenia</option>
                                                <option value="Australia" {{ old('country')=='Australia' ? 'selected'
                                                    : '' }}>Australia</option>
                                                <option value="Austria" {{ old('country')=='Austria' ? 'selected' : ''
                                                    }}>Austria</option>
                                                <option value="Azerbaijan" {{ old('country')=='Azerbaijan' ? 'selected'
                                                    : '' }}>Azerbaijan</option>
                                                <option value="Bahamas" {{ old('country')=='Bahamas' ? 'selected' : ''
                                                    }}>Bahamas</option>
                                                <option value="Bahrain" {{ old('country')=='Bahrain' ? 'selected' : ''
                                                    }}>Bahrain</option>
                                                <option value="Bangladesh" {{ old('country')=='Bangladesh' ? 'selected'
                                                    : '' }}>Bangladesh</option>
                                                <option value="Barbados" {{ old('country')=='Barbados' ? 'selected' : ''
                                                    }}>Barbados</option>
                                                <option value="Belarus" {{ old('country')=='Belarus' ? 'selected' : ''
                                                    }}>Belarus</option>
                                                <option value="Belgium" {{ old('country')=='Belgium' ? 'selected' : ''
                                                    }}>Belgium</option>
                                                <option value="Belize" {{ old('country')=='Belize' ? 'selected' : '' }}>
                                                    Belize</option>
                                                <option value="Benin" {{ old('country')=='Benin' ? 'selected' : '' }}>
                                                    Benin</option>
                                                <option value="Bhutan" {{ old('country')=='Bhutan' ? 'selected' : '' }}>
                                                    Bhutan</option>
                                                <option value="Bolivia" {{ old('country')=='Bolivia' ? 'selected' : ''
                                                    }}>Bolivia</option>
                                                <option value="Bosnia and Herzegovina" {{
                                                    old('country')=='Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia
                                                    and Herzegovina</option>
                                                <option value="Botswana" {{ old('country')=='Botswana' ? 'selected' : ''
                                                    }}>Botswana</option>
                                                <option value="Brazil" {{ old('country')=='Brazil' ? 'selected' : '' }}>
                                                    Brazil</option>
                                                <option value="Brunei" {{ old('country')=='Brunei' ? 'selected' : '' }}>
                                                    Brunei</option>
                                                <option value="Bulgaria" {{ old('country')=='Bulgaria' ? 'selected' : ''
                                                    }}>Bulgaria</option>
                                                <option value="Burkina Faso" {{ old('country')=='Burkina Faso'
                                                    ? 'selected' : '' }}>Burkina Faso</option>
                                                <option value="Burundi" {{ old('country')=='Burundi' ? 'selected' : ''
                                                    }}>Burundi</option>
                                                <option value="Cabo Verde" {{ old('country')=='Cabo Verde' ? 'selected'
                                                    : '' }}>Cabo Verde</option>
                                                <option value="Cambodia" {{ old('country')=='Cambodia' ? 'selected' : ''
                                                    }}>Cambodia</option>
                                                <option value="Cameroon" {{ old('country')=='Cameroon' ? 'selected' : ''
                                                    }}>Cameroon</option>
                                                <option value="Canada" {{ old('country')=='Canada' ? 'selected' : '' }}>
                                                    Canada</option>
                                                <option value="Central African Republic" {{
                                                    old('country')=='Central African Republic' ? 'selected' : '' }}>
                                                    Central African Republic</option>
                                                <option value="Chad" {{ old('country')=='Chad' ? 'selected' : '' }}>Chad
                                                </option>
                                                <option value="Chile" {{ old('country')=='Chile' ? 'selected' : '' }}>
                                                    Chile</option>
                                                <option value="China" {{ old('country')=='China' ? 'selected' : '' }}>
                                                    China</option>
                                                <option value="Colombia" {{ old('country')=='Colombia' ? 'selected' : ''
                                                    }}>Colombia</option>
                                                <option value="Comoros" {{ old('country')=='Comoros' ? 'selected' : ''
                                                    }}>Comoros</option>
                                                <option value="Congo (Congo-Brazzaville)" {{
                                                    old('country')=='Congo (Congo-Brazzaville)' ? 'selected' : '' }}>
                                                    Congo (Congo-Brazzaville)</option>
                                                <option value="Congo (Democratic Republic of the)" {{
                                                    old('country')=='Congo (Democratic Republic of the)' ? 'selected'
                                                    : '' }}>Congo (Democratic Republic of the)</option>
                                                <option value="Costa Rica" {{ old('country')=='Costa Rica' ? 'selected'
                                                    : '' }}>Costa Rica</option>
                                                <option value="Croatia" {{ old('country')=='Croatia' ? 'selected' : ''
                                                    }}>Croatia</option>
                                                <option value="Cuba" {{ old('country')=='Cuba' ? 'selected' : '' }}>Cuba
                                                </option>
                                                <option value="Cyprus" {{ old('country')=='Cyprus' ? 'selected' : '' }}>
                                                    Cyprus</option>
                                                <option value="Czechia (Czech Republic)" {{
                                                    old('country')=='Czechia (Czech Republic)' ? 'selected' : '' }}>
                                                    Czechia (Czech Republic)</option>
                                                <option value="Denmark" {{ old('country')=='Denmark' ? 'selected' : ''
                                                    }}>Denmark</option>
                                                <option value="Djibouti" {{ old('country')=='Djibouti' ? 'selected' : ''
                                                    }}>Djibouti</option>
                                                <option value="Dominica" {{ old('country')=='Dominica' ? 'selected' : ''
                                                    }}>Dominica</option>
                                                <option value="Dominican Republic" {{
                                                    old('country')=='Dominican Republic' ? 'selected' : '' }}>Dominican
                                                    Republic</option>
                                                <option value="Ecuador" {{ old('country')=='Ecuador' ? 'selected' : ''
                                                    }}>Ecuador</option>
                                                <option value="Egypt" {{ old('country')=='Egypt' ? 'selected' : '' }}>
                                                    Egypt</option>
                                                <option value="El Salvador" {{ old('country')=='El Salvador'
                                                    ? 'selected' : '' }}>El Salvador</option>
                                                <option value="Equatorial Guinea" {{ old('country')=='Equatorial Guinea'
                                                    ? 'selected' : '' }}>Equatorial Guinea</option>
                                                <option value="Eritrea" {{ old('country')=='Eritrea' ? 'selected' : ''
                                                    }}>Eritrea</option>
                                                <option value="Estonia" {{ old('country')=='Estonia' ? 'selected' : ''
                                                    }}>Estonia</option>
                                                <option value="Eswatini (fmr. Swaziland)" {{
                                                    old('country')=='Eswatini (fmr. Swaziland)' ? 'selected' : '' }}>
                                                    Eswatini (fmr. Swaziland)</option>
                                                <option value="Ethiopia" {{ old('country')=='Ethiopia' ? 'selected' : ''
                                                    }}>Ethiopia</option>
                                                <option value="Fiji" {{ old('country')=='Fiji' ? 'selected' : '' }}>Fiji
                                                </option>
                                                <option value="Finland" {{ old('country')=='Finland' ? 'selected' : ''
                                                    }}>Finland</option>
                                                <option value="France" {{ old('country')=='France' ? 'selected' : '' }}>
                                                    France</option>
                                                <option value="Gabon" {{ old('country')=='Gabon' ? 'selected' : '' }}>
                                                    Gabon</option>
                                                <option value="Gambia" {{ old('country')=='Gambia' ? 'selected' : '' }}>
                                                    Gambia</option>
                                                <option value="Georgia" {{ old('country')=='Georgia' ? 'selected' : ''
                                                    }}>Georgia</option>
                                                <option value="Germany" {{ old('country')=='Germany' ? 'selected' : ''
                                                    }}>Germany</option>
                                                <option value="Ghana" {{ old('country')=='Ghana' ? 'selected' : '' }}>
                                                    Ghana</option>
                                                <option value="Greece" {{ old('country')=='Greece' ? 'selected' : '' }}>
                                                    Greece</option>
                                                <option value="Grenada" {{ old('country')=='Grenada' ? 'selected' : ''
                                                    }}>Grenada</option>
                                                <option value="Guatemala" {{ old('country')=='Guatemala' ? 'selected'
                                                    : '' }}>Guatemala</option>
                                                <option value="Guinea" {{ old('country')=='Guinea' ? 'selected' : '' }}>
                                                    Guinea</option>
                                                <option value="Guinea-Bissau" {{ old('country')=='Guinea-Bissau'
                                                    ? 'selected' : '' }}>Guinea-Bissau</option>
                                                <option value="Guyana" {{ old('country')=='Guyana' ? 'selected' : '' }}>
                                                    Guyana</option>
                                                <option value="Haiti" {{ old('country')=='Haiti' ? 'selected' : '' }}>
                                                    Haiti</option>
                                                <option value="Holy See" {{ old('country')=='Holy See' ? 'selected' : ''
                                                    }}>Holy See</option>
                                                <option value="Honduras" {{ old('country')=='Honduras' ? 'selected' : ''
                                                    }}>Honduras</option>
                                                <option value="Hungary" {{ old('country')=='Hungary' ? 'selected' : ''
                                                    }}>Hungary</option>
                                                <option value="Iceland" {{ old('country')=='Iceland' ? 'selected' : ''
                                                    }}>Iceland</option>
                                                <option value="India" {{ old('country')=='India' ? 'selected' : '' }}>
                                                    India</option>
                                                <option value="Indonesia" {{ old('country')=='Indonesia' ? 'selected'
                                                    : '' }}>Indonesia</option>
                                                <option value="Iran" {{ old('country')=='Iran' ? 'selected' : '' }}>Iran
                                                </option>
                                                <option value="Iraq" {{ old('country')=='Iraq' ? 'selected' : '' }}>Iraq
                                                </option>
                                                <option value="Ireland" {{ old('country')=='Ireland' ? 'selected' : ''
                                                    }}>Ireland</option>
                                                <option value="Israel" {{ old('country')=='Israel' ? 'selected' : '' }}>
                                                    Israel</option>
                                                <option value="Italy" {{ old('country')=='Italy' ? 'selected' : '' }}>
                                                    Italy</option>
                                                <option value="Jamaica" {{ old('country')=='Jamaica' ? 'selected' : ''
                                                    }}>Jamaica</option>
                                                <option value="Japan" {{ old('country')=='Japan' ? 'selected' : '' }}>
                                                    Japan</option>
                                                <option value="Jordan" {{ old('country')=='Jordan' ? 'selected' : '' }}>
                                                    Jordan</option>
                                                <option value="Kazakhstan" {{ old('country')=='Kazakhstan' ? 'selected'
                                                    : '' }}>Kazakhstan</option>
                                                <option value="Kenya" {{ old('country')=='Kenya' ? 'selected' : '' }}>
                                                    Kenya</option>
                                                <option value="Kiribati" {{ old('country')=='Kiribati' ? 'selected' : ''
                                                    }}>Kiribati</option>
                                                <option value="Korea (North)" {{ old('country')=='Korea (North)'
                                                    ? 'selected' : '' }}>Korea (North)</option>
                                                <option value="Korea (South)" {{ old('country')=='Korea (South)'
                                                    ? 'selected' : '' }}>Korea (South)</option>
                                                <option value="Kuwait" {{ old('country')=='Kuwait' ? 'selected' : '' }}>
                                                    Kuwait</option>
                                                <option value="Kyrgyzstan" {{ old('country')=='Kyrgyzstan' ? 'selected'
                                                    : '' }}>Kyrgyzstan</option>
                                                <option value="Laos" {{ old('country')=='Laos' ? 'selected' : '' }}>Laos
                                                </option>
                                                <option value="Latvia" {{ old('country')=='Latvia' ? 'selected' : '' }}>
                                                    Latvia</option>
                                                <option value="Lebanon" {{ old('country')=='Lebanon' ? 'selected' : ''
                                                    }}>Lebanon</option>
                                                <option value="Lesotho" {{ old('country')=='Lesotho' ? 'selected' : ''
                                                    }}>Lesotho</option>
                                                <option value="Liberia" {{ old('country')=='Liberia' ? 'selected' : ''
                                                    }}>Liberia</option>
                                                <option value="Libya" {{ old('country')=='Libya' ? 'selected' : '' }}>
                                                    Libya</option>
                                                <option value="Liechtenstein" {{ old('country')=='Liechtenstein'
                                                    ? 'selected' : '' }}>Liechtenstein</option>
                                                <option value="Lithuania" {{ old('country')=='Lithuania' ? 'selected'
                                                    : '' }}>Lithuania</option>
                                                <option value="Luxembourg" {{ old('country')=='Luxembourg' ? 'selected'
                                                    : '' }}>Luxembourg</option>
                                                <option value="Madagascar" {{ old('country')=='Madagascar' ? 'selected'
                                                    : '' }}>Madagascar</option>
                                                <option value="Malawi" {{ old('country')=='Malawi' ? 'selected' : '' }}>
                                                    Malawi</option>
                                                <option value="Malaysia" {{ old('country')=='Malaysia' ? 'selected' : ''
                                                    }}>Malaysia</option>
                                                <option value="Maldives" {{ old('country')=='Maldives' ? 'selected' : ''
                                                    }}>Maldives</option>
                                                <option value="Mali" {{ old('country')=='Mali' ? 'selected' : '' }}>Mali
                                                </option>
                                                <option value="Malta" {{ old('country')=='Malta' ? 'selected' : '' }}>
                                                    Malta</option>
                                                <option value="Marshall Islands" {{ old('country')=='Marshall Islands'
                                                    ? 'selected' : '' }}>Marshall Islands</option>
                                                <option value="Mauritania" {{ old('country')=='Mauritania' ? 'selected'
                                                    : '' }}>Mauritania</option>
                                                <option value="Mauritius" {{ old('country')=='Mauritius' ? 'selected'
                                                    : '' }}>Mauritius</option>
                                                <option value="Mexico" {{ old('country')=='Mexico' ? 'selected' : '' }}>
                                                    Mexico</option>
                                                <option value="Micronesia" {{ old('country')=='Micronesia' ? 'selected'
                                                    : '' }}>Micronesia</option>
                                                <option value="Moldova" {{ old('country')=='Moldova' ? 'selected' : ''
                                                    }}>Moldova</option>
                                                <option value="Monaco" {{ old('country')=='Monaco' ? 'selected' : '' }}>
                                                    Monaco</option>
                                                <option value="Mongolia" {{ old('country')=='Mongolia' ? 'selected' : ''
                                                    }}>Mongolia</option>
                                                <option value="Montenegro" {{ old('country')=='Montenegro' ? 'selected'
                                                    : '' }}>Montenegro</option>
                                                <option value="Morocco" {{ old('country')=='Morocco' ? 'selected' : ''
                                                    }}>Morocco</option>
                                                <option value="Mozambique" {{ old('country')=='Mozambique' ? 'selected'
                                                    : '' }}>Mozambique</option>
                                                <option value="Myanmar (Burma)" {{ old('country')=='Myanmar (Burma)'
                                                    ? 'selected' : '' }}>Myanmar (Burma)</option>
                                                <option value="Namibia" {{ old('country')=='Namibia' ? 'selected' : ''
                                                    }}>Namibia</option>
                                                <option value="Nauru" {{ old('country')=='Nauru' ? 'selected' : '' }}>
                                                    Nauru</option>
                                                <option value="Nepal" {{ old('country')=='Nepal' ? 'selected' : '' }}>
                                                    Nepal</option>
                                                <option value="Netherlands" {{ old('country')=='Netherlands'
                                                    ? 'selected' : '' }}>Netherlands</option>
                                                <option value="New Zealand" {{ old('country')=='New Zealand'
                                                    ? 'selected' : '' }}>New Zealand</option>
                                                <option value="Nicaragua" {{ old('country')=='Nicaragua' ? 'selected'
                                                    : '' }}>Nicaragua</option>
                                                <option value="Niger" {{ old('country')=='Niger' ? 'selected' : '' }}>
                                                    Niger</option>
                                                <option value="Nigeria" {{ old('country')=='Nigeria' ? 'selected' : ''
                                                    }}>Nigeria</option>
                                                <option value="North Macedonia" {{ old('country')=='North Macedonia'
                                                    ? 'selected' : '' }}>North Macedonia</option>
                                                <option value="Norway" {{ old('country')=='Norway' ? 'selected' : '' }}>
                                                    Norway</option>
                                                <option value="Oman" {{ old('country')=='Oman' ? 'selected' : '' }}>Oman
                                                </option>
                                                <option value="Pakistan" {{ old('country')=='Pakistan' ? 'selected' : ''
                                                    }}>Pakistan</option>
                                                <option value="Palau" {{ old('country')=='Palau' ? 'selected' : '' }}>
                                                    Palau</option>
                                                <option value="Palestine State" {{ old('country')=='Palestine State'
                                                    ? 'selected' : '' }}>Palestine State</option>
                                                <option value="Panama" {{ old('country')=='Panama' ? 'selected' : '' }}>
                                                    Panama</option>
                                                <option value="Papua New Guinea" {{ old('country')=='Papua New Guinea'
                                                    ? 'selected' : '' }}>Papua New Guinea</option>
                                                <option value="Paraguay" {{ old('country')=='Paraguay' ? 'selected' : ''
                                                    }}>Paraguay</option>
                                                <option value="Peru" {{ old('country')=='Peru' ? 'selected' : '' }}>Peru
                                                </option>
                                                <option value="Philippines" {{ old('country')=='Philippines'
                                                    ? 'selected' : '' }}>Philippines</option>
                                                <option value="Poland" {{ old('country')=='Poland' ? 'selected' : '' }}>
                                                    Poland</option>
                                                <option value="Portugal" {{ old('country')=='Portugal' ? 'selected' : ''
                                                    }}>Portugal</option>
                                                <option value="Qatar" {{ old('country')=='Qatar' ? 'selected' : '' }}>
                                                    Qatar</option>
                                                <option value="Romania" {{ old('country')=='Romania' ? 'selected' : ''
                                                    }}>Romania</option>
                                                <option value="Russia" {{ old('country')=='Russia' ? 'selected' : '' }}>
                                                    Russia</option>
                                                <option value="Rwanda" {{ old('country')=='Rwanda' ? 'selected' : '' }}>
                                                    Rwanda</option>
                                                <option value="Saint Kitts and Nevis" {{
                                                    old('country')=='Saint Kitts and Nevis' ? 'selected' : '' }}>Saint
                                                    Kitts and Nevis</option>
                                                <option value="Saint Lucia" {{ old('country')=='Saint Lucia'
                                                    ? 'selected' : '' }}>Saint Lucia</option>
                                                <option value="Saint Vincent and the Grenadines" {{
                                                    old('country')=='Saint Vincent and the Grenadines' ? 'selected' : ''
                                                    }}>Saint Vincent and the Grenadines</option>
                                                <option value="Samoa" {{ old('country')=='Samoa' ? 'selected' : '' }}>
                                                    Samoa</option>
                                                <option value="San Marino" {{ old('country')=='San Marino' ? 'selected'
                                                    : '' }}>San Marino</option>
                                                <option value="Sao Tome and Principe" {{
                                                    old('country')=='Sao Tome and Principe' ? 'selected' : '' }}>Sao
                                                    Tome and Principe</option>
                                                <option value="Saudi Arabia" {{ old('country')=='Saudi Arabia'
                                                    ? 'selected' : '' }}>Saudi Arabia</option>
                                                <option value="Senegal" {{ old('country')=='Senegal' ? 'selected' : ''
                                                    }}>Senegal</option>
                                                <option value="Serbia" {{ old('country')=='Serbia' ? 'selected' : '' }}>
                                                    Serbia</option>
                                                <option value="Seychelles" {{ old('country')=='Seychelles' ? 'selected'
                                                    : '' }}>Seychelles</option>
                                                <option value="Sierra Leone" {{ old('country')=='Sierra Leone'
                                                    ? 'selected' : '' }}>Sierra Leone</option>
                                                <option value="Singapore" {{ old('country')=='Singapore' ? 'selected'
                                                    : '' }}>Singapore</option>
                                                <option value="Slovakia" {{ old('country')=='Slovakia' ? 'selected' : ''
                                                    }}>Slovakia</option>
                                                <option value="Slovenia" {{ old('country')=='Slovenia' ? 'selected' : ''
                                                    }}>Slovenia</option>
                                                <option value="Solomon Islands" {{ old('country')=='Solomon Islands'
                                                    ? 'selected' : '' }}>Solomon Islands</option>
                                                <option value="Somalia" {{ old('country')=='Somalia' ? 'selected' : ''
                                                    }}>Somalia</option>
                                                <option value="South Africa" {{ old('country')=='South Africa'
                                                    ? 'selected' : '' }}>South Africa</option>
                                                <option value="South Sudan" {{ old('country')=='South Sudan'
                                                    ? 'selected' : '' }}>South Sudan</option>
                                                <option value="Spain" {{ old('country')=='Spain' ? 'selected' : '' }}>
                                                    Spain</option>
                                                <option value="Sri Lanka" {{ old('country')=='Sri Lanka' ? 'selected'
                                                    : '' }}>Sri Lanka</option>
                                                <option value="Sudan" {{ old('country')=='Sudan' ? 'selected' : '' }}>
                                                    Sudan</option>
                                                <option value="Suriname" {{ old('country')=='Suriname' ? 'selected' : ''
                                                    }}>Suriname</option>
                                                <option value="Swaziland" {{ old('country')=='Swaziland' ? 'selected'
                                                    : '' }}>Swaziland</option>
                                                <option value="Sweden" {{ old('country')=='Sweden' ? 'selected' : '' }}>
                                                    Sweden</option>
                                                <option value="Switzerland" {{ old('country')=='Switzerland'
                                                    ? 'selected' : '' }}>Switzerland</option>
                                                <option value="Syria" {{ old('country')=='Syria' ? 'selected' : '' }}>
                                                    Syria</option>
                                                <option value="Taiwan" {{ old('country')=='Taiwan' ? 'selected' : '' }}>
                                                    Taiwan</option>
                                                <option value="Tajikistan" {{ old('country')=='Tajikistan' ? 'selected'
                                                    : '' }}>Tajikistan</option>
                                                <option value="Tanzania" {{ old('country')=='Tanzania' ? 'selected' : ''
                                                    }}>Tanzania</option>
                                                <option value="Thailand" {{ old('country')=='Thailand' ? 'selected' : ''
                                                    }}>Thailand</option>
                                                <option value="Timor-Leste" {{ old('country')=='Timor-Leste'
                                                    ? 'selected' : '' }}>Timor-Leste</option>
                                                <option value="Togo" {{ old('country')=='Togo' ? 'selected' : '' }}>Togo
                                                </option>
                                                <option value="Tonga" {{ old('country')=='Tonga' ? 'selected' : '' }}>
                                                    Tonga</option>
                                                <option value="Trinidad and Tobago" {{
                                                    old('country')=='Trinidad and Tobago' ? 'selected' : '' }}>Trinidad
                                                    and Tobago</option>
                                                <option value="Tunisia" {{ old('country')=='Tunisia' ? 'selected' : ''
                                                    }}>Tunisia</option>
                                                <option value="Turkey" {{ old('country')=='Turkey' ? 'selected' : '' }}>
                                                    Turkey</option>
                                                <option value="Turkmenistan" {{ old('country')=='Turkmenistan'
                                                    ? 'selected' : '' }}>Turkmenistan</option>
                                                <option value="Tuvalu" {{ old('country')=='Tuvalu' ? 'selected' : '' }}>
                                                    Tuvalu</option>
                                                <option value="Uganda" {{ old('country')=='Uganda' ? 'selected' : '' }}>
                                                    Uganda</option>
                                                <option value="Ukraine" {{ old('country')=='Ukraine' ? 'selected' : ''
                                                    }}>Ukraine</option>
                                                <option value="United Arab Emirates" {{
                                                    old('country')=='United Arab Emirates' ? 'selected' : '' }}>United
                                                    Arab Emirates</option>
                                                <option value="United Kingdom" {{ old('country')=='United Kingdom'
                                                    ? 'selected' : '' }}>United Kingdom</option>
                                                <option value="United States" {{ old('country')=='United States'
                                                    ? 'selected' : '' }}>United States</option>
                                                <option value="Uruguay" {{ old('country')=='Uruguay' ? 'selected' : ''
                                                    }}>Uruguay</option>
                                                <option value="Uzbekistan" {{ old('country')=='Uzbekistan' ? 'selected'
                                                    : '' }}>Uzbekistan</option>
                                                <option value="Vanuatu" {{ old('country')=='Vanuatu' ? 'selected' : ''
                                                    }}>Vanuatu</option>
                                                <option value="Vatican City" {{ old('country')=='Vatican City'
                                                    ? 'selected' : '' }}>Vatican City</option>
                                                <option value="Venezuela" {{ old('country')=='Venezuela' ? 'selected'
                                                    : '' }}>Venezuela</option>
                                                <option value="Vietnam" {{ old('country')=='Vietnam' ? 'selected' : ''
                                                    }}>Vietnam</option>
                                                <option value="Yemen" {{ old('country')=='Yemen' ? 'selected' : '' }}>
                                                    Yemen</option>
                                                <option value="Zambia" {{ old('country')=='Zambia' ? 'selected' : '' }}>
                                                    Zambia</option>
                                                <option value="Zimbabwe" {{ old('country')=='Zimbabwe' ? 'selected' : ''
                                                    }}>Zimbabwe</option>

                                            </select>
                                            @error('country')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Referral ID -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="ref_by">Referral ID</label>
                                            <input type="text" id="ref_by" name="ref_by" value="{{ old('ref_by') }}"
                                                class="form-control" placeholder="Optional Referral ID">
                                        </div>
                                    </div>

                                    <!-- Terms and Privacy -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" id="customCheck1" name="terms"
                                                    class="custom-control-input" required>
                                                <label class="custom-control-label" for="customCheck1">I Accept the <a
                                                        href="" class="text-primary">Terms
                                                        And Privacy Policy</a></label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mb-0 col-lg-12">
                                        <button class="btn btn-primary btn-block pad" type="submit">Register</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!---->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->




    <script src="account/temp/js/jquery-3.5.1.min.js"></script>
    <script src="account/temp/js/bootstrap.bundle.min.js"></script>

    <!-- SLIDER -->
    <script src="account/temp/js/owl.carousel.min.js"></script>
    <script src="account/temp/js/owl.init.js"></script>
    <!-- Icons -->
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