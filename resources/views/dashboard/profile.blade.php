@include('dashboard.header')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
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

                <!-- Display Success Message -->
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                <li class="breadcrumb-item active">Update Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Update Profile</h4>
                    </div>
                </div>
            </div>

            <!-- Profile Tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#personal-info">Personal Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#account-details">Account Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#bank-details">Bank Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#kyc-documents">KYC Documents</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Personal Info Section -->
                <div class="tab-pane fade show active" id="personal-info">
                    @include('dashboard.profile.personal_info', ['user' => $user])
                </div>

                <!-- Account Details Section -->
                <div class="tab-pane fade" id="account-details">
                    @include('dashboard.profile.account_details', ['user' => $user])
                </div>

                <!-- Bank Details Section -->
                <div class="tab-pane fade" id="bank-details">
                    @include('dashboard.profile.bank_details', ['user' => $user])
                </div>

                <!-- KYC Documents Section -->
                <div class="tab-pane fade" id="kyc-documents">
                    @include('dashboard.profile.kyc_documents', ['user' => $user])
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.footer')