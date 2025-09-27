<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-md-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © fxbitozglobal.com
            </div> --}}
            <div class="col-md-6">
                <div class="text-md-end footer-links d-none d-md-block">
                    <a href="javascript: void(0);">About</a>
                    <a href="javascript: void(0);">Support</a>
                    <a href="javascript: void(0);">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

<!-- Bottom Navigation Bar -->
{{-- <div class="bottom-navigation bg-light shadow-lg py-1">
    <div class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
            <i class="mdi mdi-home-outline"></i>
            <span class="nav-text">Home</span>
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
            <i class="mdi mdi-account-circle-outline"></i>
            <span class="nav-text">Profile</span>
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
            <i class="mdi mdi-wallet-outline"></i>
            <span class="nav-text">Withdraw</span>
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
            <i class="mdi mdi-account-multiple-outline"></i>
            <span class="nav-text">Referrals</span>
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
            <i class="mdi mdi-cog-outline"></i>
            <span class="nav-text">Settings</span>
        </a>
    </div>
</div> --}}
<!-- End Bottom Navigation Bar -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Vendor js -->
<script src="{{ asset('asset/js/vendor.min.js') }}"></script>

<!-- Daterangepicker js -->
<script src="{{ asset('asset/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('asset/vendor/daterangepicker/daterangepicker.js') }}"></script>

<!-- Apex Charts js -->
<script src="{{ asset('asset/vendor/apexcharts/apexcharts.min.js') }}"></script>

<!-- Vector Map js -->
<script src="{{ asset('asset/vendor/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('asset/vendor/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ asset('asset/vendor/jsvectormap/maps/world.js') }}"></script>

<!-- Dashboard App js -->
<script src="{{ asset('asset/js/pages/demo.dashboard.js') }}"></script>

<!-- App js -->
<script src="{{ asset('asset/js/app.min.js') }}"></script>

<!-- Styles for Bottom Navigation Bar -->
<style>
    .bottom-navigation {
        position: fixed;
        bottom: 0;
        right: 0;
        width: 100%;
        display: flex;
        justify-content: space-around;
        background-color: transparent;
        /* Make the background transparent */
        padding: 5px 0;
        /* Reduce padding for smaller height */
        z-index: 1000;
    }

    .bottom-navigation .nav-item {
        flex: 1;
        text-align: center;
    }

    .bottom-navigation .nav-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: #6c757d;
        font-size: 12px;
        /* Smaller font size */
    }

    .bottom-navigation .nav-link .mdi {
        font-size: 18px;
        /* Reduce icon size */
    }

    .bottom-navigation .nav-link.active,
    .bottom-navigation .nav-link:hover {
        color: #28a745;
    }
</style>


</body>

<!-- Mirrored from coderthemes.com/hyper_2/modern/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 May 2024 09:35:40 GMT -->

</html>