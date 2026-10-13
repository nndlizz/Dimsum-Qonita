<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Blank Page - Go Dimsum</title>

        <!-- SEO Optimization -->
        <meta
            name="description"
            content="Blank Page - Spark Admin Premium Bootstrap 5 Admin Dashboard Template"
        />
        <meta name="author" content="Spark Admin Team" />

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="assets/images/favicon.ico" />

        <!-- Local Third-Party Libraries (100% Offline Compatible) -->
        <link
            rel="stylesheet"
            href="assets/libs/bootstrap/css/bootstrap.min.css"
        />
        <link
            rel="stylesheet"
            href="assets/libs/bootstrap-icons/bootstrap-icons.css"
        />
        <link rel="stylesheet" href="assets/libs/apexcharts/apexcharts.css" />
        <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css" />

        <!-- Main Design System & Custom Stylesheet -->
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>

    <body>
        <!-- ==========================================
         START: Sidebar Component
         Highly polished, dark-green navigation
         ========================================== -->
        @include('admin.sidebar')
        <!-- ==========================================
         END: Sidebar Component
         ========================================== -->

        <!-- ==========================================
         START: Main Content Area
         ========================================== -->
        <div class="main-wrapper">
            <!-- START: Top Navbar Component -->
            @include('admin.navbar')
            <!-- END: Top Navbar Component -->

            <!-- START: Page Header Banner -->
            <main>
                @yield('content')
            </main>
            <!-- END: Blank Page Content Area -->

            <!-- START: Footer Component -->
            @include('admin.footer')
            <!-- END: Footer Component -->
        </div>
        <!-- ==========================================
         END: Main Content Area
         ========================================== -->

        <!-- Local Third-Party Libraries Script dependencies -->
        <script src="{{asset('admin')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('admin')}}/assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="{{asset('admin')}}/assets/libs/flatpickr/flatpickr.min.js"></script>

        <!-- Local dashboard interactions controller -->
        <script src="{{asset('admin')}}/assets/js/dashboard.js"></script>
    </body>
</html>
