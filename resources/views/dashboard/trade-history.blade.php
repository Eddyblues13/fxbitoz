@include('dashboard.header')
<br />
<br />
<br />

<div class="content-page">
    <div class="content">
        <!-- Start Content -->
        <div class="container-fluid">
            <div class="row">
                @foreach($tradeHistories as $history)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-lg widget-flat" style="border-radius: 10px;">
                        <div class="card-body">
                            <!-- Trader Details -->
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset($history->trader_image) }}" alt="{{ $history->trader_name }} Image"
                                    class="img-fluid"
                                    style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid darkgreen;">
                                <div class="ms-3">
                                    <h5 class="mb-1" style="font-family: 'Poppins', sans-serif; font-weight: 600;">
                                        {{ $history->trader_name }}
                                    </h5>
                                    <p class="text-muted mb-0" style="font-size: 14px; color:aquamarine">
                                        <strong>Status:</strong>
                                        <span class="badge 
                                            {{ $history->status == 'active' ? 'badge-success' : 'badge-danger' }} p-2"
                                            style="font-size: 12px; color:aquamarine">
                                            {{ ucfirst($history->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <!-- Trade Details -->
                            <div class="text-start" style="font-family: 'Roboto', sans-serif;">
                                <p class="mb-1" style="color: darkblue; font-size: 16px; font-weight: 700;">
                                    <strong>Asset:</strong> {{ $history->asset }}
                                </p>
                                <p class="mb-1" style="color: darkred; font-size: 15px; font-weight: 600;">
                                    <strong>Amount:</strong>
                                    <span>${{ number_format($history->amount, 2) }}</span>
                                </p>
                                <p class="mb-1" style="color: darkgreen; font-size: 14px; font-weight: 500;">
                                    <strong>ROI:</strong> {{ $history->roi }}%
                                </p>
                                <p class="mb-1" style="color: darkblue; font-size: 16px; font-weight: 700;">
                                    <strong>Trade Duration:</strong> {{ $history->trade_duration }} days
                                </p>
                                <p class="mb-1" style="color: darkred; font-size: 15px; font-weight: 600;">
                                    <strong>Top-up Interval:</strong> {{ $history->top_up_interval }}
                                </p>
                                <p class="mb-1" style="color: darkgreen; font-size: 14px; font-weight: 500;">
                                    <strong>Subscription Day:</strong> {{ $history->subscription_day }}
                                </p>
                                <p class="mb-1" style="color: darkblue; font-size: 16px; font-weight: 700;">
                                    <strong>Subscription Hour:</strong> {{ $history->subscription_hour }}
                                </p>
                                <p class="mb-1" style="color: darkred; font-size: 15px; font-weight: 600;">
                                    <strong>Expires At:</strong>
                                    {{ \Carbon\Carbon::parse($history->expired_at)->translatedFormat('F j, Y') }}
                                </p>
                            </div>

                            <!-- User Details -->
                            <hr>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('dashboard.footer')