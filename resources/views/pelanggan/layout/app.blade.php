<!DOCTYPE html>
<html lang="en">
   <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Sarab">
        <meta name="description" content="Sarab - Fast Food & Restaurant HTML Template">
        <title>Sarab - Fast Food & Restaurant HTML Template</title>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet"/>
        <!-- Bootstrap 5.3 -->
        <link href="{{ asset('template_pelanggan/sarab/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- AOS -->
        <link href="{{ asset('template_pelanggan/sarab/css/aos.css') }}" rel="stylesheet">

        <!-- Swiper -->
        <link href="{{ asset('template_pelanggan/sarab/css/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="{{ asset('template_pelanggan/sarab/css/all.min.css') }}" rel="stylesheet">

        <!-- Magnific Popup -->
        <link href="{{ asset('template_pelanggan/sarab/css/magnific-popup.css') }}" rel="stylesheet">

        <!-- Style -->
        <link href="{{ asset('template_pelanggan/sarab/css/style.css') }}" rel="stylesheet">
   </head>
   <body>
      <!-- ============================================================
         TOP BAR
         ============================================================ -->
      <!-- <div id="topbar">
         <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
               <div class="top-contact d-flex flex-wrap">
                  <span><i class="fas fa-phone-alt"></i>+1 (800) 123-4567</span>
                  <span><i class="fas fa-envelope"></i>hello@sarabfood.com</span>
                  <span><i class="fas fa-map-marker-alt"></i>42 Flavor Street, NY</span>
               </div>
               <div class="d-flex align-items-center gap-3">
                  <span class="ttag"><i class="fas fa-fire me-1"></i>Free Delivery Today!</span>
                  <div class="tsoc">
                     <a href="#"><i class="fab fa-facebook-f"></i></a>
                     <a href="#"><i class="fab fa-instagram"></i></a>
                     <a href="#"><i class="fab fa-tiktok"></i></a>
                     <a href="#"><i class="fab fa-youtube"></i></a>
                  </div>
               </div>
            </div>
         </div>
      </div> -->
      <!-- ============================================================
         NAVBAR
         ============================================================ -->
        <div class="main-wrapper">

            @include('pelanggan.layout.navbar')

            <main class="flex-fill mt-4">
                @yield('content')
            </main>

            @include('pelanggan.layout.footer')

        </div>
	  
      <!-- Floating cart -->
      <!-- <div class="cartfl"><i class="fas fa-shopping-cart"></i><span>My Cart</span><div class="ccount" id="cartCount">0</div></div> -->
      <!-- Back to top -->
      <button id="btt" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="fas fa-chevron-up"></i></button>
    
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
	<!-- jQuery -->
    <script src="{{ asset('template_pelanggan/sarab/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('template_pelanggan/sarab/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AOS -->
    <script src="{{ asset('template_pelanggan/sarab/js/aos.js') }}"></script>

    <!-- Swiper -->
    <script src="{{ asset('template_pelanggan/sarab/js/swiper-bundle.min.js') }}"></script>

    <!-- Magnific Popup -->
    <script src="{{ asset('template_pelanggan/sarab/js/jquery.magnific-popup.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('template_pelanggan/sarab/js/main.js') }}"></script>
   </body>
</html>
