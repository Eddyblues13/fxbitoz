<div class="card">
    <div class="card-body">
        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-bank me-1"></i> Bank Details</h5>
        <form method="POST" action="{{ route('profile.update', 'bank_details') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name', $user->bank_name) }}"
                            class="form-control" placeholder="Enter Bank Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" name="account_number"
                            value="{{ old('account_number', $user->account_number) }}" class="form-control"
                            placeholder="Enter Account Number">
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success"><i class="mdi mdi-content-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>