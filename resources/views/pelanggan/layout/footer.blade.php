@php
    // Lokasi dari tabel `cabang`; kalau belum ada / kosong dipakai alamat bawaan ini.
    $lokasiUtamaFooter = 'Perum Usman, Purwakarta';
    $lokasiRestoFooter = ['Cipaisan, Purwakarta'];

    try {
        $dbUtama = \Illuminate\Support\Facades\DB::table('cabang')->where('jenis', 'utama')->value('alamat');
        $dbResto = \Illuminate\Support\Facades\DB::table('cabang')->where('jenis', 'resto')->pluck('alamat')->all();
        if ($dbUtama) { $lokasiUtamaFooter = $dbUtama; }
        if ($dbResto) { $lokasiRestoFooter = $dbResto; }
    } catch (\Throwable $e) {
        // pakai alamat bawaan
    }

    $petaFooter = fn ($alamat) => 'https://www.google.com/maps/search/?api=1&query=' . urlencode($alamat);
@endphp

<!-- FOOTER -->
<footer>
   <div class="container">
      <div class="row g-5">

         <div class="col-lg-4">
            <div class="fnm">Qonita <span>Food Store</span></div>
            <p class="fdesc">Qonita Food Store menyajikan dimsum dan aneka makanan yang dibuat segar setiap hari, dengan harga yang ramah di kantong.</p>
            <div class="fsoc">
               <a href="https://www.instagram.com/qonitafoodstore?obrf=MTk4dmhiOWo5M2Z3OA=="><i class="fab fa-instagram"></i></a>
               <a href="https://www.tiktok.com/@qonitafoodstore?_r=1&_t=ZS-9BRcbskIOzB"><i class="fab fa-tiktok"></i></a>
            </div>
         </div>

         <div class="col-sm-6 col-lg-3">
            <div class="ftit">Quick Links</div>
            <ul class="flinks ps-0">
               <li><a href="#hero"><i class="fas fa-chevron-right"></i>Home</a></li>
               <li><a href="#galeri"><i class="fas fa-chevron-right"></i>Galeri</a></li>
               <li><a href="#menu"><i class="fas fa-chevron-right"></i>Menu</a></li>
               <li><a href="#jam-operasional"><i class="fas fa-chevron-right"></i>Jam Operasional</a></li>
               <li><a href="#lokasi"><i class="fas fa-chevron-right"></i>Lokasi</a></li>
            </ul>
         </div>

         <div class="col-sm-6 col-lg-5">
            <div class="ftit">Lokasi</div>

            <div class="fci">
               <div class="fciico"><i class="fas fa-map-marker-alt"></i></div>
               <div class="fciinfo">
                  <strong>Lokasi Utama</strong>{{ $lokasiUtamaFooter }}
                  <br><a href="{{ $petaFooter($lokasiUtamaFooter) }}" target="_blank" rel="noopener">Lihat di peta</a>
               </div>
            </div>

            @foreach ($lokasiRestoFooter as $alamat)
               <div class="fci">
                  <div class="fciico"><i class="fas fa-utensils"></i></div>
                  <div class="fciinfo">
                     <strong>Lokasi Resto</strong>{{ $alamat }}
                     <br><a href="{{ $petaFooter($alamat) }}" target="_blank" rel="noopener">Lihat di peta</a>
                  </div>
               </div>
            @endforeach
         </div>

      </div>
   </div>

   <div class="fbot">
      <div class="container">
         <div class="d-flex justify-content-center align-items-center flex-wrap gap-2 text-center">
            <p class="mb-0">&copy; {{ date('Y') }} <span>Qonita Food Store</span>. Semua hak dilindungi. Template oleh <a target="_blank" class="mx-0 fw-bold text-success" href="https://bestwpware.com/">Bestwpware</a>, didistribusikan oleh <a target="_blank" class="mx-0 fw-bold text-success" href="https://themewagon.com">ThemeWagon</a>.</p>
         </div>
      </div>
   </div>
</footer>