<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Go Dimsum - Admin Dashboard</title>
    <meta name="description" content="Go Dimsum Admin Dashboard">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('template_admin/assets/images/favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('template_admin/assets/libs/bootstrap/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('template_admin/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- ApexCharts CSS -->
    <link rel="stylesheet" href="{{ asset('template_admin/assets/libs/apexcharts/apexcharts.css') }}">

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="{{ asset('template_admin/assets/libs/flatpickr/flatpickr.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('template_admin/assets/css/main.css') }}">
</head>

<body>

    @include('admin.sidebar')

    <div class="main-wrapper">

        @include('admin.navbar')

        <main>
            @yield('content')
        </main>

        @include('admin.footer')

    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('template_admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- ApexCharts JS -->
    <script src="{{ asset('template_admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Flatpickr JS -->
    <script src="{{ asset('template_admin/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Dashboard JS -->
    <script src="{{ asset('template_admin/assets/js/dashboard.js') }}"></script>

</body>
</html>