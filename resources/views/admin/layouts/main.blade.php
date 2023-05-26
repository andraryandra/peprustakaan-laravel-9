<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Dashboard Petugas | @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- End fonts -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- core:css -->
    <link rel="stylesheet" href="/../../assets/admin/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/../../assets/admin/vendors/flatpickr/flatpickr.min.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="/../../assets/admin/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="/../../assets/admin/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="/../../assets/admin/css/dashboard/style.css">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="/../../assets/admin/images/favicon.png" />

    <link rel="stylesheet" href="/../../assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
</head>

<body>
    @stack('style')

    <div class="main-wrapper">
        <div class="page-wrapper">

            <!-- partial:partials/_sidebar.html -->
            @include('admin.partials.sidebar')


            <!-- partial -->
            @include('admin.partials.navbar')

            <div>
                @yield('content')
                @yield('mading')
                @yield('madingVerifikasi')
                @yield('anggota')
                @yield('petugas')
                @yield('category')
                @yield('subKategori')
                @yield('ebook')
                @yield('landingPage')
            </div>

            @include('admin.partials.footer')

        </div>


        <!-- core:js -->
        <script src="/../../assets/admin/vendors/core/core.js"></script>
        <!-- endinject -->

        <!-- Plugin js for this page -->
        <script src="/../../assets/admin/vendors/flatpickr/flatpickr.min.js"></script>
        <script src="/../../assets/admin/vendors/apexcharts/apexcharts.min.js"></script>
        <!-- End plugin js for this page -->

        <!-- inject:js -->
        <script src="/../../assets/admin/vendors/feather-icons/feather.min.js"></script>
        <script src="/../../assets/admin/js/template.js"></script>
        <!-- endinject -->

        <!-- Custom js for this page -->
        <script src="/../../assets/admin/js/dashboard-light.js"></script>
        <!-- End custom js for this page -->

        @yield('js')
        @stack('javascript')
</body>

</html>
