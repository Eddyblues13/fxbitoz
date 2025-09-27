@include('dashboard.header')

<br />
<br />
<br />

<div class="content-page">
  <div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
      <div class="row">
        <!-- Stock History Cards -->
        @foreach($stockHistories as $stockHistory)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card shadow-lg widget-flat">
            <div class="card-body">
              <!-- Stock Image -->
              <div class="d-flex align-items-center mb-3">
                <div class="position-relative">
                </div>
                <h5 class="fw-bold ms-3 mb-0" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                  {{ $stockHistory->stock_name }}
                </h5>
              </div>

              <!-- Stock Details -->
              <div class="d-flex justify-content-between">
                <div>
                  <p class="mb-1 text-primary" style="font-family: 'Arial', sans-serif;">
                    <strong>Amount Purchased:</strong> ${{ number_format($stockHistory->amount, 2) }}
                  </p>
                  <p class="mb-1 text-success" style="font-family: 'Arial', sans-serif;">
                    <strong>ROI:</strong> {{ $stockHistory->roi }}%
                  </p>
                </div>
                <div class="text-end">
                  <p class="mb-1 text-warning" style="font-family: 'Arial', sans-serif;">
                    <strong>Duration:</strong> {{ $stockHistory->stock_duration }} days
                  </p>
                  <p class="mb-1 text-danger" style="font-family: 'Arial', sans-serif;">
                    <strong>Subscription Day:</strong> {{ $stockHistory->subscription_day }}
                  </p>
                  <p class="mb-1 text-info" style="font-family: 'Arial', sans-serif;">
                    <strong>Expiration:</strong> {{ \Carbon\Carbon::parse($stockHistory->expired_at)->format('d M Y
                    H:i') }}
                  </p>
                </div>
              </div>

              <!-- Status -->
              <div class="mt-3">
                <p class="mb-1 text-muted" style="font-family: 'Arial', sans-serif;">
                  <strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($stockHistory->status) }}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center mt-4">
        {{ $stockHistories->links() }}
      </div>
    </div>
  </div>
</div>

@include('dashboard.footer')