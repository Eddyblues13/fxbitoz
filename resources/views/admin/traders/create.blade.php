@include('admin.header')

<div class="main-panel">

    <div class="content bg-dark">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{session('message')}}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-light">Add Trader</h1>
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
                        <form action="{{ route('traders.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Trader Name</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter trader name"
                                        type="text" name="trader_name" value="{{ old('trader_name') }}" required>
                                </div>
                                <!-- Followers Field -->
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Followers</h5>
                                    <input class="form-control text-light bg-dark"
                                        placeholder="Enter number of followers" type="text" name="followers"
                                        value="{{ old('followers') }}" required>
                                </div>

                                <!-- Copier ROI Field -->
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Copier ROI</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter ROI" type="text"
                                        name="copier_roi" value="{{ old('copier_roi') }}" required>
                                </div>



                                <!-- Risk Index Field -->
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Risk Index</h5>
                                    <input class="form-control text-light bg-dark" placeholder="Enter risk index"
                                        type="text" name="risk_index" value="{{ old('risk_index') }}" required>
                                </div>

                                <!-- Total Copied Trades Field -->
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Total Copied Trades</h5>
                                    <input class="form-control text-light bg-dark"
                                        placeholder="Enter total copied trades" type="text" name="total_copied_trade"
                                        value="{{ old('total_copied_trade') }}" required>
                                </div>

                                <!-- Verified Status Field -->
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Verified Status</h5>
                                    <select class="form-control text-light bg-dark" name="verified_status">
                                        <option value="1" {{ old('verified_status')=='1' ? 'selected' : '' }}>Verified
                                        </option>
                                        <option value="0" {{ old('verified_status')=='0' ? 'selected' : '' }}>Not
                                            Verified</option>
                                    </select>
                                </div>

                                <!-- Picture Field -->
                                <div class="form-group col-md-6">
                                    <h5 class="text-light">Picture</h5>
                                    <input class="form-control text-light bg-dark" type="file" name="picture" required>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group col-md-12">
                                    <input type="submit" class="btn btn-primary" value="Add Trader">
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