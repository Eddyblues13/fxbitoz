@include('admin.header')

<div class="main-panel">

    <div class="content bg-dark">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{session('message')}}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Edit Trader</h1>
            </div>
            <div>
            </div>
            <div>
            </div>
            <div class="mb-5 row">
                <div class="col-lg-12 ">
                    <div class="p-3 card bg-dark">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('traders.update', $trader->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Trader Name</h5>
                                    <input class="form-control text-light bg-dark" type="text" name="trader_name"
                                        value="{{ old('trader_name', $trader->trader_name) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Followers</h5>
                                    <input class="form-control text-light bg-dark" type="number" name="followers"
                                        value="{{ old('followers', $trader->followers) }}" min="0" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Copier ROI (%)</h5>
                                    <input class="form-control text-light bg-dark" type="number" step="0.01"
                                        name="copier_roi" value="{{ old('copier_roi', $trader->copier_roi) }}" min="0"
                                        required>
                                </div>



                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Risk Index</h5>
                                    <input class="form-control text-light bg-dark" type="number" name="risk_index"
                                        value="{{ old('risk_index', $trader->risk_index) }}" min="0" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Total Copied Trades</h5>
                                    <input class="form-control text-light bg-dark" type="number"
                                        name="total_copied_trade"
                                        value="{{ old('total_copied_trade', $trader->total_copied_trade) }}" min="0"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Verified Status</h5>
                                    <select class="form-control text-light bg-dark" name="verified_status" required>
                                        <option value="1" {{ old('verified_status', $trader->verified_status) == 1 ?
                                            'selected' : '' }}>Verified</option>
                                        <option value="0" {{ old('verified_status', $trader->verified_status) == 0 ?
                                            'selected' : '' }}>Not Verified</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Picture</h5>
                                    @if ($trader->picture)
                                    <img src="{{ asset($trader->picture) }}" alt="Trader Picture"
                                        class="img-thumbnail mb-2" style="max-width: 150px;">
                                    @endif
                                    <input class="form-control text-light bg-dark" type="file" name="picture">
                                </div>

                                <div class="form-group col-md-12">
                                    <input type="submit" class="btn btn-primary" value="Update Trader">
                                </div>
                            </div>
                        </form>







                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="durationModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body bg-dark">
                    <h5 class="text-light">FIRSTLY, Always preceed the time frame with a digit, that is do not write the
                        number in letters, <br> <br> SECONDLY, always add space after the number, <br> <br> LASTLY, the
                        first letter of the timeframe should be in CAPS and always add 's' to the timeframe even if your
                        duration is just a day, month or year.</h5>
                    <h2 class="text-light">Eg, 1 Days, 3 Weeks, 1 Hours, 48 Hours, 4 Months, 1 Years, 9 Months</h2>

                </div>
            </div>
        </div>
    </div>
    <div id="topupModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body bg-dark">

                </div>
            </div>
        </div>
    </div>

    <script>
        function getduration(id, event){
                    event.preventDefault();
                    document.getElementById('duridden').value = id;
                }
    </script>


    @include('admin.footer')