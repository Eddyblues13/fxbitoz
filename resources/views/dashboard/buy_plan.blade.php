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
                            <!-- Button to View Plan History -->
                            <div class="d-flex justify-content-end mb-4">
                                <a href="{{ route('user.show.plan.history') }}" class="btn btn-info text-white">View
                                    Plan History</a>
                            </div>

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

                            <!-- Trading Plans Section -->
                            <div class="row my-4">
                                <h2 class="text-center fw-bold text-primary mb-4">Available Trading Plans</h2>
                                @foreach($tradingPlans as $plan)
                                <div class="col-md-4">
                                    <div class="card mb-3 shadow border-0">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-dark fw-bold" style="font-size: 1.25rem;">
                                                {{ $plan->name }}
                                                @if($plan->is_featured)
                                                <span class="badge bg-success ms-2">Featured</span>
                                                @endif
                                            </h5>

                                            <div class="plan-details text-start mb-3">
                                                <p class="text-muted mb-2">
                                                    <strong>Title:</strong> {{ $plan->title }}
                                                </p>


                                                <p class="text-muted mb-2">
                                                    <strong>Duration:</strong> {{ $plan->duration_days }} days
                                                </p>
                                                <p class="text-muted mb-2">
                                                    <strong>Return Type:</strong> {{ $plan->return_type }}
                                                </p>
                                                <p class="text-muted mb-2">
                                                    <strong>Number of Periods:</strong> {{ $plan->number_of_periods }}
                                                </p>
                                                <p class="text-muted mb-2">
                                                    <strong>Capital Back:</strong> {{ $plan->capital_back ? 'Yes' : 'No'
                                                    }}
                                                </p>
                                                <p class="text-muted mb-2">
                                                    <strong>Profit Withdrawal:</strong> {{ $plan->profit_withdrawal }}
                                                </p>
                                                <p class="text-muted mb-2">
                                                    <strong>Cancellation Policy:</strong> {{ $plan->cancellation_policy
                                                    }}
                                                </p>

                                            </div>

                                            <form action="{{ route('user.store.plan.history') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                <input type="hidden" value="{{ $plan->name }}" name="plan">

                                                <div class="form-group mb-3">
                                                    <label for="amount_{{ $plan->id }}"
                                                        class="form-label text-dark fw-bold">
                                                        Investment Amount (${{ number_format($plan->min_investment, 2)
                                                        }} - ${{ number_format($plan->max_investment, 2) }}):
                                                    </label>
                                                    <input type="number" name="amount" id="amount_{{ $plan->id }}"
                                                        class="form-control text-dark bg-light"
                                                        min="{{ $plan->min_investment }}"
                                                        max="{{ $plan->max_investment }}" required
                                                        placeholder="Enter amount between ${{ number_format($plan->min_investment, 2) }} - ${{ number_format($plan->max_investment, 2) }}">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="withdraw_from_{{ $plan->id }}"
                                                        class="form-label text-dark fw-bold">
                                                        Withdraw From
                                                    </label>
                                                    <select id="withdraw_from_{{ $plan->id }}" name="withdraw_from"
                                                        class="form-control" required>
                                                        <option value="" disabled selected>Select Withdrawal Type
                                                        </option>
                                                        <option value="account_balance">Account Balance (${{
                                                            number_format($balance_sum, 2) }})</option>
                                                        <option value="deposit">Deposit (${{
                                                            number_format($successful_deposits_sum, 2) }})</option>
                                                        <option value="profit">Profit (${{ number_format($profit_sum, 2)
                                                            }})</option>
                                                    </select>
                                                </div>



                                                <button type="submit" class="btn btn-primary w-100">Buy Plan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Initialize profit calculators for each plan
    @foreach($tradingPlans as $plan)
    (function() {
        const amountInput = document.getElementById('amount_{{ $plan->id }}');
        const dailyDisplay = document.getElementById('daily_{{ $plan->id }}');
        const weeklyDisplay = document.getElementById('weekly_{{ $plan->id }}');
        const totalDisplay = document.getElementById('total_{{ $plan->id }}');
        const dailyPercent = parseFloat('{{ $plan->daily_profit }}');
        const durationDays = parseInt('{{ $plan->duration_days }}');
        
        amountInput.addEventListener('input', function() {
            const amount = parseFloat(this.value);
            const minAmount = parseFloat(this.min);
            const maxAmount = parseFloat(this.max);
            
            if (isNaN(amount) {
                dailyDisplay.textContent = '$0.00';
                weeklyDisplay.textContent = '$0.00';
                totalDisplay.textContent = '$0.00';
                return;
            }
            
            if (amount < minAmount || amount > maxAmount) {
                dailyDisplay.textContent = 'Invalid';
                weeklyDisplay.textContent = 'Amount';
                totalDisplay.textContent = 'Range';
                return;
            }
            
            const dailyProfit = (amount * dailyPercent / 100).toFixed(2);
            const weeklyProfit = (dailyProfit * 7).toFixed(2);
            const totalProfit = (dailyProfit * durationDays).toFixed(2);
            
            dailyDisplay.textContent = '$' + dailyProfit;
            weeklyDisplay.textContent = '$' + weeklyProfit;
            totalDisplay.textContent = '$' + totalProfit;
        });
    })();
    @endforeach
});
</script>