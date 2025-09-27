@include('dashboard.header')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            {{-- Success and Error Messages --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">
                <div class="col-12 text-center mb-4">
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle mb-3" type="button" id="buyCryptoButton"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="font-size: 14px; padding: 10px 20px;">
                            Buy Crypto
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="buyCryptoButton">
                            <li><a class="dropdown-item" href="https://www.binance.com/" target="_blank">Binance</a>
                            </li>
                            <li><a class="dropdown-item" href="https://www.coinbase.com/" target="_blank">Coinbase</a>
                            </li>
                            <li><a class="dropdown-item" href="https://www.kraken.com/" target="_blank">Kraken</a></li>
                            <li><a class="dropdown-item" href="https://www.crypto.com/" target="_blank">Crypto.com</a>
                            </li>
                            <li><a class="dropdown-item" href="https://www.bitfinex.com/" target="_blank">Bitfinex</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Deposit Form --}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"><a class="btn btn-primary"
                                href="{{ route('user.deposits.history') }}">Deposit History</a></h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Make a Deposit</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.store.deposit') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Deposit Amount and Information --}}
                                <div class="mt-5">
                                    <h4 class="text-dark">
                                        <span style="color:red">*</span> You are about to make a deposit of
                                        <strong>${{ number_format($amount, 2) }}</strong>.<br>
                                        <span style="color:red">*</span> Crypto Assets {{$payment->name}} coin

                                        Copy the wallet address below and complete your payment.
                                    </h4>
                                </div>

                                {{-- Wallet Address --}}
                                <div class="mb-3">
                                    <label for="wallet_address" class="form-label">Wallet Address</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="wallet_address"
                                            name="wallet_address" value="{{ $payment->wallet_address }}" readonly>
                                        <button class="btn btn-secondary" type="button"
                                            onclick="copyToClipboard()">Copy</button>
                                    </div>
                                </div>

                                {{-- Barcode --}}
                                <div class="mb-3 text-center">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $payment->wallet_address }}"
                                        style="width:200px;">
                                    <br>
                                    <small class="text-dark"><strong><span style="color:red">*</span> You Can Scan QR
                                            code When making deposit through ATM Machine</small>
                                </div>

                                {{-- Upload Proof --}}
                                <div class="mb-3">
                                    <label for="proof" class="form-label">Upload Payment Proof</label>
                                    <input type="file" class="form-control" id="proof" name="proof" required>
                                    <small class="form-text text-muted">Supported formats: jpg, jpeg, png, pdf. Max
                                        size: 20MB.</small>
                                </div>

                                <input type="hidden" name="amount" value="{{$amount}}">
                                <input type="hidden" name="type" value="{{$payment->type}}">
                                <input type="hidden" name="name" value="{{$payment->name}}">

                                {{-- Submit Button --}}
                                <button type="submit" class="btn btn-primary">Submit Deposit</button>
                                <a href="{{ route('user.deposit') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end container-fluid -->

    </div>
    <!-- end content -->

</div>
<!-- content-page -->

<script>
    function copyToClipboard() {
        const walletInput = document.getElementById('wallet_address');
        walletInput.select();
        walletInput.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand('copy');
        alert('Wallet address copied to clipboard!');
    }
</script>

@include('dashboard.footer')