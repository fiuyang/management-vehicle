
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/third-party/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/@fortawesome/fontawesome-free/css/all.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/izitoast/dist/css/iziToast.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets') }}/third-party/jquery-ui/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-treetable/3.2.0/css/jquery.treetable.min.css" integrity="sha512-rzpvh46q/W37FDIdBxK79gy/fWoZWQiwUUQOCGm58XKsdVAjtYK1TZ4nSbLZWbqiS3hxsw3Dg/E67BOQbaEs5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/node_modules/chart.js/dist/Chart.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/swal/dist/sweetalert2.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-datepicker/css/bootstrap-datepicker.css')}} ">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    @yield('styles')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/assets/css/style.css')}} ">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/components.css')}} ">
    <style>
        #map { height: 300px; }
    </style>
    
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
       
        <!-- NAVBAR -->
        @include('layouts.navbar')
        <!-- END NAVBAR -->

        <!-- SIDEBAR -->
        @include('layouts.sidebar')
        <!-- ENDSIDEBAR -->

        <!-- START CONTENT -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>@yield('title')</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="#">@yield('title')</a></div>
                    </div>
                </div>
                @yield('content')
            </section>
        </div>
        <!-- END CONTENT -->

        <!-- FOOTER -->
        @include('layouts.footer')
        <!-- ENDFOOTER -->

        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{asset('assets/third-party/jquery.js')}}"></script>
    <script src="{{asset('assets/third-party/popper.js')}}"></script>
    <script src="{{asset('assets/third-party/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/third-party/nicescroll.js')}}"></script>
    <script src="{{asset('assets/third-party/moment.js')}}"></script>
    <script src="{{asset('assets/assets/js/stisla.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('assets') }}/third-party/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{asset('assets/node_modules/chart.js/dist/Chart.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-treetable/3.2.0/jquery.treetable.min.js" integrity="sha512-2pYVakljd2zLnVvVC264Ib+XGvOvu3iFyKCIwLzn77mfbjuVi1dGJUxGjDAI8MjgPgTfSIM/vZirW04LCQmY2Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('assets/node_modules/izitoast/dist/js/iziToast.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/bootbox/bootbox.all.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/numeric/jquery.number.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/swal/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>

    <!-- Template JS File -->
    <script src="{{asset('assets/assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/assets/js/custom.js')}}"></script>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Page Specific JS File -->
    @yield('script')
</body>
</html>
