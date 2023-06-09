<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fuji Fruit </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}">

    <link rel="stylesheet" href="{{asset('/datatable_js/jquery.dataTables.min.css')}}">

    @livewireStyles
</head>

<body>
    <div class="container-scroller">
        @include('layouts.includes.admin.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.includes.admin.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('layouts.includes.admin.footer')
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <!-- plugins:js -->
    <script src="{{ asset('admin/assets/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('admin/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/assets/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('admin/assets/js/data-table.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.bootstrap4.js') }}"></script>
    <!-- End custom js for this page-->
    <script src="{{ asset('admin/assets/js/jquery.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('/datatable_js/jquery.dataTables.min.js')}}"></script>
    @yield('js')
</body>

</html>