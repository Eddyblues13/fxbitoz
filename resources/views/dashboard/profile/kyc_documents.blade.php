<div class="card">
    <div class="card-body">
        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-file-document me-1"></i> KYC Documents</h5>
        <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update', 'kyc_documents') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_card" class="form-label">ID Card</label>
                        <input type="file" name="id_card" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="passport" class="form-label">Passport</label>
                        <input type="file" name="passport" class="form-control">
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-success"><i class="mdi mdi-content-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>