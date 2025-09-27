@include('dashboard.header')
<br />
<br />
<br />

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- Trader Card -->
                @foreach($traders as $trader)
                <div class="col-md-6 col-lg-6 mb-4">
                    <div class="card shadow-lg widget-flat">
                        <div class="card-body position-relative">
                            <!-- Copy Trade Button -->
                            <a href="{{ route('user.show.trader.page', ['id' => $trader->id]) }}"
                                class="btn btn-success btn-sm position-absolute top-0 end-0 m-2"
                                style="border-radius: 30%; width: 50px; height: 50px; padding: 5px; margin:5px">Copy+</a>

                            <!-- Trader Image and Name -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="position-relative">
                                    <img src="{{ asset($trader->picture) }}" alt="{{ $trader->trader_name }} Image"
                                        class="img-fluid"
                                        style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">

                                    <!-- Verified Icon -->
                                    @if ($trader->verified_status)
                                    <img src="{{ asset('asset/images/blue.png') }}" alt="Verified Icon"
                                        class="position-absolute"
                                        style="width: 24px; height: 24px; bottom: 0; right: 0; border-radius: 50%;">
                                    @endif
                                </div>
                                <h5 class="fw-bold ms-3 mb-0"
                                    style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                    {{ $trader->trader_name }}
                                    @if ($trader->verified_status)
                                    <img src="{{ asset('asset/images/blue.png') }}"
                                        style="width: 24px; height: 24px; bottom: 0; right: 0; border-radius: 50%;">
                                    @endif
                                </h5>
                            </div>

                            <!-- Trader Details -->
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="mb-1 text-primary" style="font-family: 'Arial', sans-serif;">
                                        <strong>Followers:</strong> <strong>{{ $trader->followers }}</strong>
                                    </p>
                                    <p class="mb-1 text-success" style="font-family: 'Arial', sans-serif;">
                                        <strong>Return Rate:</strong> <strong>{{ $trader->copier_roi }}%</strong>
                                    </p>

                                </div>
                                <div class="text-end">

                                    <p class="mb-1 text-warning" style="font-family: 'Arial', sans-serif;">
                                        <strong>Total Copied Trades:</strong> <strong>{{ $trader->total_copied_trade
                                            }}</strong> 
                                    </p>
                                    <p class="mb-1 text-success" style="font-family: 'Arial', sans-serif;">
                                        <strong>Profit Share:</strong> <strong>{{ $trader->risk_index }}%</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('dashboard.footer')