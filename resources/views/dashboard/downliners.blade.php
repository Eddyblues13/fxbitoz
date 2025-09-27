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
                                <li class="breadcrumb-item active">Downliners</li>
                            </ol>
                        </div>
                        <h4 class="page-title">My Downliners</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4 text-uppercase">
                                <i class="mdi mdi-account-group-outline me-1"></i> Downliners
                            </h5>

                            <!-- Display Success Message -->
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <!-- Downliner Table -->
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Referred At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($downliners as $index => $downliner)
                                        <tr>
                                            <td>{{ $index + $downliners->firstItem() }}</td>
                                            <td>{{ $downliner->username }}</td>
                                            <td>{{ $downliner->email }}</td>
                                            <td>{{ $downliner->phone }}</td>
                                            <td>
                                                @if($downliner->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                                @else
                                                <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $downliner->created_at->format('d M Y, h:i A') }}</td>
                                            <td>
                                                <a href="{{ route('users.show', $downliner->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="mdi mdi-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No downliners found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between">
                                <div>
                                    Showing {{ $downliners->firstItem() ?? 0 }} to {{ $downliners->lastItem() ?? 0 }} of
                                    {{ $downliners->total() }} entries
                                </div>
                                <div>
                                    {{ $downliners->links() }}
                                </div>
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
</div>

@include('dashboard.footer')