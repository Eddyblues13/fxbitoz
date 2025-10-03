@include('dashboard.header')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Withdrawals</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Withdraw/Transfer Funds</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 offset-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4 text-uppercase">
                                <i class="mdi mdi-cash-remove me-1"></i> Withdrawal Request
                            </h5>

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

                            <form method="POST" action="{{ route('user.withdrawal') }}" id="withdrawalForm">
                                @csrf
                                <!-- Withdrawal Amount -->
                                <div class="form-group mb-3">
                                    <label for="amount">Amount</label>
                                    <input type="number" id="amount" name="amount" class="form-control" min="1"
                                        step="0.01" required placeholder="Enter withdrawal amount">
                                </div>

                                <!-- Withdrawal Type -->
                                <div class="form-group mb-3">
                                    <label for="withdraw_from">Withdraw From</label>
                                    <select id="withdraw_from" name="withdraw_from" class="form-control" required>
                                        <option value="" disabled selected>Select Withdrawal Type</option>
                                        <option value="account_balance">Account Balance (${{ number_format($balance_sum,
                                            2) }})</option>
                                        <option value="deposit">Deposit (${{ number_format($successful_deposits_sum, 2)
                                            }})</option>
                                        <option value="profit">Profit (${{ number_format($profit_sum, 2) }})</option>
                                    </select>
                                </div>

                                <!-- Withdrawal Method -->
                                <div class="form-group mb-3">
                                    <label for="method">Withdrawal Method</label>
                                    <select id="method" name="method" class="form-control" required
                                        onchange="updateDetailsField()">
                                        <option value="" disabled selected>Select Method</option>
                                        <option value="Bank">Bank</option>
                                        <option value="Trade Account">Trade Account</option>
                                    </select>
                                </div>

                                <!-- Dynamic Details Section -->
                                <div id="details-section" class="form-group mb-3" style="display: none;">
                                    <div class="form-group mb-3">
                                        <label for="bank_name">Bank Name</label>
                                        <input type="text" id="bank_name" name="bank_name" class="form-control"
                                            placeholder="Enter your bank name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="account_number">Account Number</label>
                                        <input type="text" id="account_number" name="account_number"
                                            class="form-control" placeholder="Enter your account number">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="account_name">Account Name</label>
                                        <input type="text" id="account_name" name="account_name" class="form-control"
                                            placeholder="Enter account holder name">
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <span id="submitText">Submit Withdrawal Request</span>
                                        <span id="processingText" style="display: none;">
                                            Processing<span id="dots"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>

                            <script>
                                function updateDetailsField() {
                                    const method = document.getElementById('method').value;
                                    const detailsSection = document.getElementById('details-section');
                                    
                                    // Show details section for both Bank and Trade Account
                                    if (method === 'Bank' || method === 'Trade Account') {
                                        detailsSection.style.display = 'block';
                                    } else {
                                        detailsSection.style.display = 'none';
                                    }
                                }
                                
                                // Form submission handler
                                document.getElementById('withdrawalForm').addEventListener('submit', function(e) {
                                    const submitBtn = document.getElementById('submitBtn');
                                    const submitText = document.getElementById('submitText');
                                    const processingText = document.getElementById('processingText');
                                    const dots = document.getElementById('dots');
                                    
                                    // Disable button to prevent multiple submissions
                                    submitBtn.disabled = true;
                                    
                                    // Show processing text
                                    submitText.style.display = 'none';
                                    processingText.style.display = 'inline';
                                    
                                    // Animate dots
                                    let dotCount = 0;
                                    const dotInterval = setInterval(() => {
                                        dotCount = (dotCount + 1) % 4;
                                        dots.textContent = '.'.repeat(dotCount);
                                    }, 500);
                                    
                                    // Store interval reference to clear later (though page will reload)
                                    this.dotInterval = dotInterval;
                                });
                            </script>

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
</div>

@include('dashboard.footer')