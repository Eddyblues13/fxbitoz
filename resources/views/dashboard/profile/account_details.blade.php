<div class="card">
    <div class="card-body">
        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-key me-1"></i> Account Details</h5>
        <form method="POST" action="{{ route('profile.update', 'account_details') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}"
                            class="form-control" placeholder="Enter Username">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="account_type" class="form-label">Account Type</label>
                        <input type="text" name="account_type" value="{{ old('account_type', $user->account_type) }}"
                            class="form-control" placeholder="Enter Account Type">
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success"><i class="mdi mdi-content-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>