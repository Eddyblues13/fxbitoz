<div class="card">
    <div class="card-body">
        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
        <form method="POST" action="{{ route('profile.update', 'personal_info') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control"
                            placeholder="Enter Full Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control"
                            placeholder="Enter Phone Number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->dob) }}"
                            class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" name="country" value="{{ old('country', $user->country) }}"
                            class="form-control" placeholder="Enter Country">
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success"><i class="mdi mdi-content-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>