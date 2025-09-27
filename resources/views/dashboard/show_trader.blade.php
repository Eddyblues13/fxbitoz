@include('dashboard.header')
<br />
<br />
<br />

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg widget-flat">
                        <div class="card-body">
                            <!-- Display Errors -->
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- Display Success Message -->
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <!-- Trader Information -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="position-relative">
                                    <img src="{{ asset($trader->picture) }}" alt="{{ $trader->trader_name }} Image"
                                        class="img-fluid"
                                        style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover;">

                                    <!-- Verified Icon -->
                                    <img src="{{ asset('asset/images/blue.png') }}" alt="Verified Icon"
                                        class="position-absolute"
                                        style="width: 24px; height: 24px; bottom: 0; right: 0; border-radius: 50%; background: #fff;">
                                </div>
                                <h5 class="fw-bold ms-3 mb-0"
                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                    {{ $trader->trader_name }}
                                </h5>
                            </div>

                            <!-- Trader Details -->
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Year of Experience:</strong> {{ $trader->trader_year_of_experience }}</p>
                                    <p><strong>Performance:</strong> {{ $trader->performance }}</p>
                                    <p><strong>Followers:</strong> {{ $trader->followers }}</p>
                                </div>
                                <div class="col-md-6">

                                    <p><strong>Top-up Interval:</strong> {{ $trader->top_up_interval }}</p>
                                    <p><strong>Top-up Type:</strong> {{ $trader->top_up_type }}</p>

                                </div>
                            </div>

                            <!-- Trader Performance and Risk -->
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="mb-1 text-primary" style="font-family: 'Arial', sans-serif;">
                                        <strong>Copier ROI:</strong> <strong>{{ $trader->copier_roi }}%</strong>
                                    </p>
                                    <p class="mb-1 text-warning" style="font-family: 'Arial', sans-serif;">
                                        <strong>Total Copied Trades:</strong> <strong>{{ $trader->total_copied_trade
                                            }}</strong>
                                    </p>
                                </div>
                                <div class="text-end">
                                    <p class="mb-1 text-success" style="font-family: 'Arial', sans-serif;">
                                        <strong>Profit Share:</strong> <strong>{{ $trader->risk_index }}</strong>
                                    </p>
                                    <p class="mb-1 text-success" style="font-family: 'Arial', sans-serif;">
                                        <strong>Active Traders:</strong> <strong>{{ $trader->active_traders }}</strong>
                                    </p>
                                </div>
                            </div>


                            <!-- Copy Trade Form -->
                            <form action="{{ route('user.start.trade') }}" method="POST" class="mt-4">
                                @csrf
                                <div class="form-group">
                                    <label for="amount">Investment Amount:</label>
                                    <input type="number" name="amount" id="amount"
                                        class="form-control text-dark bg-light" min="{{ $trader->trading_min_amount }}"
                                        max="{{ $trader->trading_max_amount }}" required>
                                </div>
                                <br>

                                {{-- <div class="form-group">
                                    <label for="withdraw_from">Withdraw From</label>
                                    <select id="withdraw_from" name="withdraw_from" class="form-control" required>
                                        <option value="" disabled selected>Select Withdrawal Type</option>

                                        <option value="deposit">Deposit((${{ number_format($successful_deposits_sum,
                                            2) }}))</option>

                                    </select>
                                </div> --}}
                                <div class="form-group" style="display: none;">
                                    <label for="withdraw_from">Withdraw From</label>
                                    <select id="withdraw_from" name="withdraw_from" class="form-control" required>
                                        <option value="" disabled>Select Withdrawal Type</option>
                                        <option value="deposit" selected>
                                            Deposit (${{ number_format($successful_deposits_sum, 2) }})
                                        </option>
                                    </select>
                                </div>

                                <br>

                                <input type="hidden" name="trade_duration" value="{{ $trader->investment_duration }}">
                                <input type="hidden" name="trader_name" value="{{ $trader->trader_name }}">
                                <input type="hidden" name="trader_image" value="{{ $trader->picture }}">
                                <input type="hidden" name="roi" value="{{ $trader->top_up_amount }}">
                                <input type="hidden" name="top_up_type" value="{{ $trader->top_up_type }}">
                                <input type="hidden" name="top_up_interval" value="{{ $trader->top_up_interval }}">
                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                <button type="submit" class="btn btn-block pricing-action btn-primary">Copy Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.footer')