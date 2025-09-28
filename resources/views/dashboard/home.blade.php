@include('dashboard.header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">


<style type="text/css">
  /* General Content Styling */
  #content {
    width: 100%;
    transition: all 0.3s;
    margin-top: 60px;
    margin-left: var(--sidebar-width);
  }

  #content.full-width {
    margin-left: 0;
  }

  /* Navigation Links */
  .nav-link {
    color: #8b949e;
    padding: 0.75rem 1rem;
    margin: 0.25rem 0;
    border-radius: 0.5rem;
  }

  .nav-link:hover,
  .nav-link.active {
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
  }

  /* Warning Bar Styling */
  .kyc-warning {
    /* Black text for readability */
    text-align: center;
    width: 90%;
    padding: 10px;
    font-size: 16px;
    font-weight: bold;
    border-bottom: 2px solid #d39e00;
  }

  .kyc-warning a {
    color: #0056b3;
    text-decoration: underline;
    font-weight: bold;
  }

  .kyc-warning a:hover {
    color: #004085;
  }

  /* Trading Card Styling */
  .trading-card {
    background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
    url('{{asset("assets/img/candle.jpg")}}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-color: #0d1117;
    border-radius: 10px;
  }

  .card {
    min-height: 100px;
    /* Ensuring all cards have a minimum height */
  }

  .card-body img {
    max-width: 80px;
    /* Consistent image size */
    margin-bottom: 15px;
  }

  .card-body h5,
  .card-body p {
    margin-bottom: 10px;
    /* Consistent spacing */
  }
</style>


<!-- Page Content -->
<div class="content-page">
  <div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

      <div class="small-card card widget-flat my-4">
        <!-- Marquee Notice -->
        <div class="marquee-container">
          <div class="marquee-text">
            🔵 You can only make transfer or withdraw from trade account to trade account. &nbsp;&nbsp;&nbsp;
            🔵 Before making transaction to your bank account make sure your bank account holder name and email ID are
            the same with your trade account holder name and email ID. &nbsp;&nbsp;&nbsp;
            🔵 Any other account you want to make transfer to must have the same account holder name or email ID with
            your trade account to enable you make a successful transaction except transactions between two trade
            accounts.
          </div>
        </div>
        <!-- End Marquee -->

        <!-- Account Details -->
        <h5 class="text-dark mt-3 text-center">
          <b>Account Number:</b> {{ Auth::user()->account_number }}
        </h5>

        <!-- Account Status -->
        <div class="mt-2 text-center">
          @if(Auth::user()->activation_status == 'Active')
          <span class="account-status text-success">
            <i class="fas fa-check-circle"></i> Active
          </span>
          @elseif(Auth::user()->activation_status == 'Suspended')
          <span class="account-status text-danger">
            <i class="fas fa-ban"></i> Suspended
          </span>
          @elseif(Auth::user()->activation_status == 'Pending')
          <span class="account-status text-warning">
            <i class="fas fa-clock"></i> Pending
          </span>
          @elseif(Auth::user()->activation_status == 'Processing')
          <span class="account-status text-primary">
            <i class="fas fa-spinner fa-spin"></i> Processing...
          </span>
          @elseif(Auth::user()->activation_status == 'Inactive')
          <a href="javascript:void(0);" id="inactiveToggle" class="account-status text-danger fw-bold"
            style="text-decoration: underline;">
            <i class="fas fa-exclamation-circle"></i> Inactive (Click to Activate)
          </a>

          <!-- Hidden Wallet Section -->
          <div class="mt-3 d-none" id="walletSection">
            <div class="p-2 bg-light border rounded d-flex justify-content-between align-items-center">
              <code id="cryptoAddress">{{ Auth::user()->crypto_address }}</code>
              <button class="btn btn-sm btn-outline-primary ms-2" id="copyWalletBtn">
                <i class="fas fa-copy"></i> Copy
              </button>
            </div>
            <small class="text-muted d-block mt-2">
              Make sure to activate your account first with the required one time activation bitcoin link that requires
              first and second activation process to keep your account active for successful transactions.
              You can withdraw your funds to your bank account or trade account immediately your account is active
              without any transaction fee or withdrawal fee.
            </small>
            <b>
              Buy the required bitcoin link from your bitcoin wallet now and send it to your bitcoin link address above
              to activate your account without delay to avoid withdrawal issues.
            </b>
          </div>
          @endif
        </div>
      </div>

      <!-- JS Toggle & Copy -->
      <script>
        document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("inactiveToggle");
        const walletSection = document.getElementById("walletSection");
        const copyBtn = document.getElementById("copyWalletBtn");
        const cryptoAddress = document.getElementById("cryptoAddress");

        // Toggle wallet section
        if (toggleBtn) {
            toggleBtn.addEventListener("click", function () {
                walletSection.classList.toggle("d-none");
            });
        }

        // Copy wallet address
        if (copyBtn) {
            copyBtn.addEventListener("click", function () {
                const text = cryptoAddress.textContent.trim();
                navigator.clipboard.writeText(text).then(() => {
                    copyBtn.innerHTML = '<i class="fas fa-check"></i> Copied';
                    setTimeout(() => {
                        copyBtn.innerHTML = '<i class="fas fa-copy"></i> Copy';
                    }, 2000);
                }).catch(err => {
                    alert("Failed to copy: " + err);
                });
            });
        }
    });
      </script>

      <!-- Marquee CSS -->
      <style>
        .marquee-container {
          overflow: hidden;
          position: relative;

          border-radius: 8px;
          padding: 10px 0;
          border: 1px solid #e0e0e0;
        }

        .marquee-text {
          display: inline-block;
          white-space: nowrap;
          color: #0d6efd;
          font-size: 15px;
          font-weight: 500;
          animation: marquee 80s linear infinite;
          padding-left: 100%;
        }

        @keyframes marquee {
          0% {
            transform: translateX(0);
          }

          100% {
            transform: translateX(-100%);
          }
        }

        @media (max-width: 768px) {
          .marquee-text {
            font-size: 13px;
          }
        }

        @media (max-width: 480px) {
          .marquee-text {
            font-size: 12px;
          }
        }
      </style>





      <!-- Trading Card -->
      <!-- Trading Card -->
      <div class="small-card card widget-flat my-4">
        <div class="trading-card p-3">
          <!-- Main Wallet & Profit Wallet -->
          <div class="row g-3 mb-3">
            <div class="col-6">
              <h1 class="text-center text-white display-6">${{ number_format($balance_sum, 2) }}</h1>
              <p class="text-center text-white h6">Account Balance</p>
            </div>
            <div class="col-6">
              <h1 class="text-center text-white display-6">${{ number_format($profit_sum, 2) }}</h1>
              <p class="text-center text-white h6">Total Profit </p>
            </div>
          </div>

          <!-- Additional Wallet Information -->
          <div class="row g-3 mb-3">
            <div class="col-6">
              <h3 class="text-center text-white display-6">${{ number_format($pending_deposits_sum, 2) }}</h3>
              <p class="text-center text-white h6">Pending Deposits</p>
            </div>

            <div class="col-6">
              <h3 class="text-center text-white display-6">${{ number_format($successful_deposits_sum, 2) }}</h3>
              <p class="text-center text-white h6">Approved Deposits</p>
            </div>



          </div>

          <!-- Withdrawals Information -->
          <div class="row g-3 mb-3">
            <div class="col-6">
              <h3 class="text-center text-white display-6">${{ number_format($pending_withdrawals_sum, 2) }}</h3>
              <p class="text-center text-white h6">Pending Withdrawals</p>
            </div>
            <div class="col-6">
              <h3 class="text-center text-white display-6">${{ number_format($successful_withdrawals_sum, 2) }}</h3>
              <p class="text-center text-white h6">Successful Withdrawals</p>
            </div>
          </div>

          <!-- Signal Strength -->
          <div class="progress mb-2">
            <div class="progress-bar" style="width: {{Auth::user()->signal_strength}}%;"></div>
          </div>
          <p class="text-center text-white h6 mb-3">SIGNAL STRENGTH</p>

          <!-- Action Buttons -->
          <div class="row g-2">
            <div class="col-6">
              <a href="{{ route('user.deposit') }}" class="btn btn-outline-primary w-100 h6">ADD FUNDS</a>
            </div>
            <div class="col-6">
              <a href="{{ route('user.copy.trader.page') }}" class="btn btn-outline-primary w-100 h6">MY TRADERS (0)</a>
            </div>
          </div>
        </div>
      </div>
      <!-- TradingView Widget -->
      <div class="small-card card widget-flat my-4">
        <script type="text/javascript"
          src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-overview.js" async>
          {
      "symbols": [
        [
          "Apple",
          "NASDAQ:AAPL|1D"
        ],
        [
          "Microsoft",
          "NASDAQ:MSFT|1D"
        ],
        [
          "Tesla",
          "NASDAQ:TSLA|1D"
        ]
      ],
      "chartOnly": false,
      "width": "100%",
      "height": 250,
      "locale": "en",
      "colorTheme": "dark",
      "autosize": false,
      "showVolume": false,
      "hideDateRanges": false,
      "hideMarketStatus": false,
      "hideSymbolLogo": false,
      "scalePosition": "right",
      "scaleMode": "Normal",
      "fontFamily": "-apple-system, BlinkMacSystemFont, Trebuchet MS, Roboto, Ubuntu, sans-serif",
      "fontSize": "10",
      "noTimeScale": false,
      "valuesTracking": "1",
      "changeMode": "price-and-percent",
      "chartType": "line"
    }
        </script>
      </div>


      <!-- Profile Tabs -->


      <!-- TradingView Widget -->
      <div class="small-card card widget-flat my-4">
        <ul class="nav nav-tabs d-flex flex-sm-row justify-content-between mt-3">
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#closed">
              <i class="bi bi-hourglass-top"></i> Closed
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#active">
              <i class="bi bi-hourglass"></i> Active
            </a>
          </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3">
          <!-- Active Trades -->
          <div class="tab-pane fade show active" id="active">
            @if ($open_trades->isEmpty())
            <div class="text-center py-4">
              <p>No open trades available.</p>
            </div>
            @else
            @foreach ($open_trades as $trade)
            @php
            // Capitalize company name
            // Convert company name to uppercase
            $companyName = strtoupper($trade->company);


            // Determine logo URL dynamically
            $logoBaseUrl = 'https://cryptologos.cc/logos/';
            $logoPath = '';

            // Check company type (crypto, stocks, or default)
            if (in_array($companyName, ['Bitcoin', 'Ethereum', 'Ripple', 'Litecoin', 'Cardano', 'Dogecoin'])) {
            // Replace spaces and lowercase for crypto logos
            $logoPath = $logoBaseUrl . strtolower(str_replace(' ', '-', $companyName)) . '-logo.png';
            } elseif (in_array($companyName, ['Amazon', 'Apple', 'Tesla', 'Microsoft', 'Google'])) {
            // Use stock logos from external resources (example URL)
            $logoPath = "https://logo.clearbit.com/" . strtolower($companyName) . ".com";
            } else {
            // Fallback placeholder
            $logoPath = 'https://placehold.co/50x50?text=' . urlencode($companyName);
            }
            @endphp

            <div class="trade-item d-flex justify-content-between align-items-center">
              <div>
                <img src="{{ $logoPath }}" alt="{{ $companyName }}" width="30"
                  onerror="this.src='https://placehold.co/50x50?text=NA'">
                <span>BUY {{ number_format($trade->amount, 4) }} {{ $companyName }}</span><br>
                <small>{{ $trade->asset }}</small>
              </div>
              <span class="text-success">${{ number_format($trade->take_profit, 2) }}</span>
            </div>
            @endforeach
            @endif
          </div>

          <!-- Closed Trades -->
          <div class="tab-pane fade" id="closed">
            @if ($closed_trades->isEmpty())
            <div class="text-center py-4">
              <p>No closed trades available.</p>
            </div>
            @else
            @foreach ($closed_trades as $trade)
            @php
            // Capitalize company name
            // Convert company name to uppercase
            $companyName = strtoupper($trade->company);

            // Determine logo URL dynamically
            $logoBaseUrl = 'https://cryptologos.cc/logos/';
            $logoPath = '';

            // Check company type (crypto, stocks, or default)
            if (in_array($companyName, ['Bitcoin', 'Ethereum', 'Ripple', 'Litecoin', 'Cardano', 'Dogecoin'])) {
            // Replace spaces and lowercase for crypto logos
            $logoPath = $logoBaseUrl . strtolower(str_replace(' ', '-', $companyName)) . '-logo.png';
            } elseif (in_array($companyName, ['Amazon', 'Apple', 'Tesla', 'Microsoft', 'Google'])) {
            // Use stock logos from external resources (example URL)
            $logoPath = "https://logo.clearbit.com/" . strtolower($companyName) . ".com";
            } else {
            // Fallback placeholder
            $logoPath = 'https://placehold.co/50x50?text=' . urlencode($companyName);
            }
            @endphp

            <div class="trade-item d-flex justify-content-between align-items-center">
              <div>
                <img src="{{ $logoPath }}" alt="{{ $companyName }}" width="30"
                  onerror="this.src='https://placehold.co/50x50?text=NA'">
                <span>BUY {{ number_format($trade->amount, 4) }} {{ $companyName }}</span><br>
                <small>{{ $trade->asset }}</small>
              </div>
              <span class="text-danger">${{ number_format($trade->take_profit, 2) }}</span>
            </div>
            @endforeach
            @endif
          </div>
        </div>
      </div>

      <!-- Custom CSS -->
      <style>
        .trade-item {
          border-bottom: 1px solid #ccc;
          padding: 10px 0;
        }

        .text-success {
          color: #00FF00;
          font-weight: bold;
        }

        .text-danger {
          color: #FF0000;
          font-weight: bold;
        }

        small {
          color: #999;
        }

        img {
          border-radius: 50%;
        }
      </style>




    </div>


  </div>
  <!-- end row -->

</div>
<!-- container -->

@include('dashboard.footer')
<script>
  function toggleTradeStatus(status) {
        if (status === 'open') {
            document.getElementById('openTrades').style.display = 'block';
            document.getElementById('closedTrades').style.display = 'none';
        } else if (status === 'closed') {
            document.getElementById('openTrades').style.display = 'none';
            document.getElementById('closedTrades').style.display = 'block';
        }
    }
</script>