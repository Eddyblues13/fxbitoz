{{-- resources/views/advertiser/edit_ad.blade.php --}}

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
                <!-- Buy Crypto Dropdown -->
                <div class="col-md-6">
                    <div class="dropdown">
                        {{-- <button class="btn btn-success dropdown-toggle mb-3" type="button" id="buyCryptoButton"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="font-size: 8px; padding: 10px 20px; margin:10px;">
                            Buy Crypto
                        </button> --}}

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

                <!-- Deposit History Button -->
                <div class="col-md-6">
                    <div class="page-title-box">
                        <h4 class="page-title">
                            <a class="btn btn-primary" href="{{ route('user.deposits.history') }}">
                                Deposit History
                            </a>
                        </h4>
                    </div>
                </div>
            </div>


            {{-- Edit Ad Form --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Update Ad Information</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('user.payment')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Choose Deposit Method</label>
                                        <select class="form-control" id="position" name="payment_id">
                                            <option value="">Select Deposit Method</option>


                                            @foreach($payment as $payment)
                                            <option value="{{$payment->id}}">{{$payment->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                {{-- Title
                                <div class="mb-3">
                                    <p style="color:red;font-size:9pt">
                                        <b>Important</b> <br>
                                        * Send only the above selected currency to this address. Sending any other
                                        currency to this address may result to the loss of your deposit.

                                    </p>
                                </div> --}}

                                {{-- Cost --}}
                                <div class="mb-3">
                                    <label for="cost" class="form-label">Amount ($)</label>
                                    <input type="number" class="form-control" id="cost" name="amount" value=""
                                        min="1000" required>
                                </div>


                                {{-- Status --}}


                                {{-- Submit Button --}}
                                <button type="submit" class="btn btn-primary">Copy Account Details</button>
                            </form>
                            {{-- Title --}}
                            <div class="mb-3 mt-4">
                                <p style="color:red; font-size:9pt">
                                    <b>Tips</b> <br>
                                    * Notice: Fund will be deposited immediately after network confirmations.<br>
                                    * You can track your deposit progress on the <a
                                        href="{{route('user.deposits.history')}}" style="color:skyblue">
                                        Deposit
                                        History</a> page
                                </p>
                            </div>

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

<style>
    /* Custom styles can be added here */
</style>

@include('dashboard.footer')

{{-- Optional: Auto-Dismiss Alerts --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Automatically dismiss alerts after 5 seconds
        setTimeout(function () {
            var alert = document.querySelector('.alert');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    });
</script>