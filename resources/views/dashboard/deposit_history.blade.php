@include('dashboard.header')
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

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Deposit History</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Your Deposit Records</h5>
                        </div>
                        <div class="card-body">
                            @if($deposits->isEmpty())
                            <p class="text-center">No deposit records found.</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount</th>
                                            <th>Deposit Type</th>
                                            <th>Payment Mode</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deposits as $deposit)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>${{ number_format($deposit->amount, 2) }}</td>
                                            <td>{{ ucfirst($deposit->deposit_type) }}</td>
                                            <td>{{ ucfirst($deposit->payment_mode) }}</td>
                                            <td>
                                                @if($deposit->status === '0')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($deposit->status === '1')
                                                <span class="badge bg-success">Approved</span>
                                                @else
                                                <span class="badge bg-danger">Denied</span>
                                                @endif
                                            </td>
                                            <td>{{ $deposit->created_at->format('d M, Y H:i A') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- end container-fluid -->
    </div> <!-- end content -->
</div> <!-- end content-page -->

{{-- Script to Copy Wallet Address --}}
<script>
    function copyToClipboard(elementId) {
        var input = document.getElementById(elementId);
        input.select();
        input.setSelectionRange(0, 99999); // For mobile devices
        navigator.clipboard.writeText(input.value).then(() => {
            alert("Wallet address copied to clipboard!");
        }).catch(err => {
            alert("Failed to copy: " + err);
        });
    }
</script>
@include('dashboard.footer')