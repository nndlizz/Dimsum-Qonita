
<nav class="navbar navbar-expand-lg" id="nav">
   <div class="container">
      <a class="navbar-brand" href="#">
         <div class="blogo">
            <div class="bico"><i class="fas fa-utensils"></i></div>
            <div>
               <div class="bname">Sar<span>ab</span></div>
               <div class="bsub">Fast Food & Restaurant</div>
            </div>
         </div>
      </a>

      <button class="navbar-toggler border-0" type="button"
         data-bs-toggle="collapse" data-bs-target="#navmenu">
         <i class="fas fa-bars" style="color:var(--primary);font-size:1.35rem;"></i>
      </button>

      <div class="collapse navbar-collapse" id="navmenu">
         <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link active" href="#hero">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="#reservation">Reservation</a></li>
            <li class="nav-item"><a class="nav-link" href="#testimonials">Reviews</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact-section">Contact</a></li>
         </ul>

         <div class="d-flex align-items-center gap-2">

            <!-- Search -->
            <button id="navSearchBtn" title="Search">
               <i class="fas fa-search"></i>
            </button>

            <!-- Notifikasi -->
            <a href="{{ route('pelanggan.notifikasi') }}"
               id="navNotificationBtn"
               title="Notifikasi"
               aria-label="Notifikasi"
               style="color:var(--primary); font-size:1.25rem; padding:8px 12px; text-decoration:none;">
               <i class="fas fa-bell"></i>
            </a>

            <!-- Ajukan Sponsor -->
            <a href="{{ route('pelanggan.sponsor.create') }}" class="nav-link nav-cta">
               <i class="fas fa-handshake me-1"></i>Ajukan Sponsor
            </a>

            <div class="d-flex align-items-center gap-2">
               @if(Auth::guard('pelanggan')->check())

                  <!-- Jika Pelanggan Sudah Login -->
                  <div class="dropdown">
                     <button class="btn text-white rounded-pill px-3 py-2 dropdown-toggle d-flex align-items-center gap-2"
                        type="button" data-bs-toggle="dropdown"
                        style="background-color: #800000;">
                        <i class="fas fa-user-circle fa-lg"></i>
                        <span>{{ Auth::guard('pelanggan')->user()->nama }}</span>
                     </button>

                     <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2">
                        <li>
                           <a class="dropdown-item py-2" href="{{ route('pelanggan.profil') }}">
                              <i class="fas fa-user me-2 text-muted"></i> Profil Saya
                           </a>
                        </li>
                        <li>
                           <a class="dropdown-item py-2" href="{{ route('pelanggan.riwayat') }}">
                              <i class="fas fa-history me-2 text-muted"></i> Riwayat Pesanan
                           </a>
                        </li>
                        <li>
                           <a class="dropdown-item py-2" href="{{ route('pelanggan.sponsor') }}">
                              <i class="fas fa-handshake me-2 text-muted"></i> Ajukan Sponsor
                           </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                           <form action="{{ route('logout') }}" method="POST">
                              @csrf
                              <button type="submit" class="dropdown-item py-2 text-danger">
                                 <i class="fas fa-sign-out-alt me-2"></i> Logout
                              </button>
                           </form>
                        </li>
                     </ul>
                  </div>

               @else

                  <!-- Jika Belum Login -->
                  <a href="{{ route('login') }}" class="btn btn-outline-danger rounded-pill px-4">
                     Login
                  </a>

               @endif
            </div>
         </div>
      </div>
   </div>
</nav>
