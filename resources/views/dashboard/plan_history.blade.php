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
                            <!-- Page Title -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-bold">Plan History</h4>
                                <a href="{{ route('user.show.plans')}}" class="btn btn-primary">Back to Plans</a>
                            </div>

                            <!-- Display Success Message -->
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

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

                            <!-- Trading History Table -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Plan</th>
                                            <th>Amount ($)</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tradingHistory as $index => $history)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $history->plan }}</td>
                                            <td>${{ number_format($history->amount, 2) }}</td>
                                            <td>{{ ucfirst($history->type) }}</td>
                                            <td>
                                                @if($history->status === '1')
                                                <span class="badge bg-success">Completed</span>
                                                @elseif($history->status === '0')
                                                <span class="badge bg-warning">Pending</span>
                                                @else
                                                <span class="badge bg-success">Completed</span>
                                                @endif
                                            </td>
                                            <td>{{ $history->created_at->format('d M Y, h:i A') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No trading history available.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-3">
                                {{ $tradingHistory->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.footer')