@include('dashboard.header')

<br />
<br />
<br />

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
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

                <!-- Stock Cards -->
                @foreach($stocks as $stock)
                <div class="col-md-6 col-lg-6 mb-4">
                    <div class="card shadow-lg widget-flat">
                        <div class="card-body position-relative">
                            <!-- Stock Name -->
                            <div class="d-flex align-items-center mb-3">
                                <h5 class="fw-bold mb-0 ms-3"
                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                    {{ $stock->stock_name }}
                                </h5>
                            </div>

                            <!-- Stock Graph -->
                            <div class="mt-3">
                                {!! $stock->stock_js !!}
                            </div>

                            <!-- Stock Details -->
                            <div class="mt-3">
                                <p class="mb-1 text-primary" style="font-family: 'Arial', sans-serif;">
                                    <strong>Max Amount:</strong> ${{ number_format($stock->stock_max_amount, 2) }}
                                </p>
                                <p class="mb-1 text-success" style="font-family: 'Arial', sans-serif;">
                                    <strong>Min Amount:</strong> ${{ number_format($stock->stock_min_amount, 2) }}
                                </p>
                                <p class="mb-1 text-warning" style="font-family: 'Arial', sans-serif;">
                                    <strong>Top-Up Amount:</strong> {{ $stock->top_up_amount }}
                                </p>
                                <p class="mb-1 text-danger" style="font-family: 'Arial', sans-serif;">
                                    <strong>Performance:</strong> {{ $stock->performance }}%
                                </p>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <button class="btn btn-success btn-sm buy-stock-btn" data-bs-toggle="modal"
                                    data-bs-target="#buyStockModal" data-id="{{ $stock->id }}"
                                    data-name="{{ $stock->stock_name }}" data-image="{{ $stock->picture }}"
                                    data-min="{{ $stock->stock_min_amount }}">
                                    Buy
                                </button>
                                <button class="btn btn-info btn-sm">
                                    {{ $stock->top_up_status }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal for Buying Stock -->
<div class="modal fade" id="buyStockModal" tabindex="-1" aria-labelledby="buyStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="buyStockForm" method="POST" action="{{ route('user.buy.stock') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="buyStockModalLabel">Buy Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="stock_id" id="stockId">
                    <input type="hidden" name="stock_image" id="stockImage">
                    <div class="mb-3">
                        <label for="stockName" class="form-label">Stock Name</label>
                        <input type="text" class="form-control" id="stockName" name="stock_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount ($)</label>
                        <input type="number" class="form-control" id="amount" name="amount" min="" required>
                    </div>
                    <div class="form-group">
                        <label for="withdraw_from">Withdraw From</label>
                        <select id="withdraw_from" name="withdraw_from" class="form-control" required>
                            <option value="" disabled selected>Select Withdrawal Type</option>
                            <option value="account_balance">Account Balance (${{ number_format($balance_sum, 2) }})
                            </option>
                            <option value="deposit">Deposit(${{ number_format($successful_deposits_sum, 2) }})</option>
                            <option value="profit">Profit(${{ number_format($profit_sum, 2) }})</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Buy Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('dashboard.footer')

<script>
    document.querySelectorAll('.buy-stock-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const stockId = this.getAttribute('data-id');
            const stockName = this.getAttribute('data-name');
            const stockImage = this.getAttribute('data-image');
            const minAmount = this.getAttribute('data-min');

            document.getElementById('stockId').value = stockId;
            document.getElementById('stockName').value = stockName;
            document.getElementById('stockImage').value = stockImage;
            document.getElementById('amount').setAttribute('min', minAmount);
        });
    });
</script>