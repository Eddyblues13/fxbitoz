@include('dashboard.header')
<br />
<br />
<br />

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Error Messages -->
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">Verify Your Account</h4>
                            <p class="text-center">
                                Please upload the required KYC documents to verify your account.
                            </p>

                            <!-- KYC Form -->
                            <form action="{{ route('user.kyc.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="id_card">ID Card</label>
                                    <input type="file" class="form-control" id="id_card" name="id_card" required>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="passport_photo">Passport Photograph</label>
                                    <input type="file" class="form-control" id="passport_photo" name="passport_photo"
                                        required>
                                </div>

                                <div class="form-group mt-4 text-center">
                                    <button type="submit" class="btn btn-success">Submit Documents</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{--
                    <!-- Display Uploaded Documents if Any -->
                    @if($document)
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="text-center">Uploaded Documents</h5>

                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <h6>ID Card</h6>
                                    <img src="{{ asset($document->id_card_path) }}" alt="ID Card" class="img-fluid"
                                        style="max-height: 200px;">
                                </div>
                                <div class="col-md-6 text-center">
                                    <h6>Passport Photograph</h6>
                                    <img src="{{ asset($document->passport_photo_path) }}" alt="Passport Photograph"
                                        class="img-fluid" style="max-height: 200px;">
                                </div>
                            </div>

                            <p class="text-center mt-3">
                                Status:
                                <span
                                    class="badge {{ $document->status === 'approved' ? 'badge-success' : ($document->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                    {{ ucfirst($document->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.footer')