@extends ('pelanggan.layout.app')

@section('content')
    <!-- ============================================================
         FIX 1 � SEARCH OVERLAY POPUP
         ============================================================ -->
      <div id="searchOv">
         <button class="sovclose" id="searchClose"><i class="fas fa-times"></i></button>
         <div class="sovbox">
            <h4>What are you craving today?</h4>
            <div class="sovinput">
               <input type="text" id="searchInput" placeholder="Search burgers, pizza, chicken..." autocomplete="off"/>
               <button><i class="fas fa-search"></i></button>
            </div>
            <!-- Categories inside search box -->
            <div class="sovcats">
               <div class="sovcat active" data-cat="all">
                  <img src="img/menu/1.jpg" alt=""/>All Items
               </div>
               <div class="sovcat" data-cat="burgers">
                  <img src="img/menu/1.jpg" alt=""/>Burgers
               </div>
               <div class="sovcat" data-cat="pizza">
                  <img src="img/menu/2.jpg" alt=""/>Pizza
               </div>
               <div class="sovcat" data-cat="chicken">
                  <img src="img/menu/3.jpg" alt=""/>Chicken
               </div>
               <div class="sovcat" data-cat="wraps">
                  <img src="img/menu/4.jpg" alt=""/>Wraps
               </div>
               <div class="sovcat" data-cat="pasta">
                  <img src="img/menu/5.jpg" alt=""/>Pasta
               </div>
               <div class="sovcat" data-cat="desserts">
                  <img src="img/menu/6.jpg" alt=""/>Desserts
               </div>
            </div>
            <div class="sovtrend">
               <p><i class="fas fa-fire me-1" style="color:var(--secondary);"></i>Trending Searches</p>
               <span class="ttag">Smash Burger</span>
               <span class="ttag">Nashville Chicken</span>
               <span class="ttag">Truffle Pizza</span>
               <span class="ttag">Lava Cake</span>
               <span class="ttag">Loaded Fries</span>
               <span class="ttag">Mango Shake</span>
            </div>
         </div>
      </div>
      <!-- ============================================================
         HERO
         ============================================================ -->
      <section id="hero">
         <div class="hs hs1"></div>
         <div class="hs hs2"></div>
         <div class="hbgtxt">Qonita</div>
         <div class="container">
            <div class="row align-items-center g-5" style="min-height:88vh;">
               <div class="col-lg-6">
                  <div class="hbadge">
                     <div class="hbi"><i class="fas fa-star"></i></div>
                     <span>#1 Jajanan Terfavorit di Purwakarta</span>
                  </div>
                  <h1 class="htitle">Lezat <span class="hl">Terjangkau</span><br/>Untuk setiap momen terbaikmu!</h1>
                  <p class="hdesc">Rasakan cita rasa berani yang dibuat dari bahan-bahan premium. Mulai dari kelembutan tiap gigitan - setiap gigitan adalah petualangan yang layak dinikmati.</p>
                  <!-- <div class="d-flex flex-wrap gap-3 mb-2">
                     <a href="#menu" class="btn-red"><i class="fas fa-utensils"></i>Explore Menu</a> -->
                     <!-- FIX 2: Magnific popup video trigger -->
                  <!-- <a href="https://www.youtube.com/watch?v=RXv_uIN6e-Y" class="magnific_popup btn-play popup-youtube">
                     <div class="pico"><i class="fas fa-play"></i></div>
                     <span>Watch Our Story</span>
                  </a> -->

                  </div>
                  <div class="hstats d-flex gap-3 flex-wrap mt-4">
                     <div class="hstat"><span class="snum">100<em>+</em></span><small>Pelanggan Senang</small></div>
                     <div class="sdiv"></div>
                     <div class="hstat"><span class="snum">15<em>+</em></span><small>Pilihan Menu</small></div>
                     <div class="sdiv"></div>
                     <div class="hstat"><span class="snum">10<em>+</em></span><small>Ahli dalam Bidangnya</small></div>
                     <div class="sdiv"></div>
                     <div class="hstat"><span class="snum">2<em>th +</em></span><small>Pengalaman</small></div>
                  </div>
               </div>
               <!-- <div class="col-lg-6">
                  <div style="position:relative;text-align:center;">
                     <div class="hcircle">
                        <img src="img/banner-img.jpg" alt="Burger"/>
                     </div>
                     <div class="fcard fc1">
                        <div class="fcoi r"><i class="fas fa-fire"></i></div>
                        <div><span class="fcnum">Hot Deal</span><span class="fcsm">30% off today</span></div>
                     </div>
                     <div class="fcard fc2">
                        <div class="fcoi y"><i class="fas fa-star"></i></div>
                        <div><span class="fcnum">4.9/5</span><span class="fcsm">2k+ reviews</span></div>
                     </div>
                     <div class="fcard fc3">
                        <div class="fcoi g"><i class="fas fa-clock"></i></div>
                        <div><span class="fcnum">20 min</span><span class="fcsm">Fast delivery</span></div>
                     </div>
                  </div>
               </div> -->
            </div>
         </div>
      </section>
      <!-- MARQUEE -->
      <div class="mqsec">
         <div class="mqtrack">
            <div class="mqitem"><i class="fas fa-circle"></i>Dimsum Original</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Dimsum Kukus</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Dimsum Goreng</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Dimsum Goreng Keju</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Dimsum Mentai</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Dimsum Kuah</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Dimsum Cake</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Dimsum Platter</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Tahu Bakso</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Wonton Chili Oil</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Gyoza</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Cireng Chili Oil</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Hakau</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Berbagai Minuman</div>
         </div>
      </div>
     

<!-- GALLERY KEGIATAN -->
<section id="category" style="background-color: #FFF4E5; padding: 70px 0;">

    <style>
        #category .gallery-slider {
            position: relative;
        }

        #category .gallery-wrapper {
            display: flex;
            gap: 22px;
            overflow-x: auto;
            padding: 10px 5px 25px;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            scrollbar-width: thin;
            scrollbar-color: #820000 #eadfd2;
        }

        #category .gallery-wrapper::-webkit-scrollbar {
            height: 8px;
        }

        #category .gallery-wrapper::-webkit-scrollbar-thumb {
            background: #820000;
            border-radius: 10px;
        }

        #category .gallery-card {
            flex: 0 0 260px;
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,.07);
            scroll-snap-align: start;
            transition: .3s ease;
        }

        #category .gallery-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 22px rgba(130,0,0,.13);
        }

        #category .gallery-card img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            display: block;
        }

        #category .gallery-content {
            padding: 18px;
            min-height: 145px;
        }

        #category .gallery-content h5 {
            color: #820000;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        #category .gallery-content p {
            color: #777;
            font-size: 13px;
            line-height: 1.7;
            margin: 0;
        }

        #category .gallery-number {
            color: #b99a7b;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        #category .gallery-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
            width: 45px;
            height: 45px;
            border: none;
            border-radius: 50%;
            background: #820000;
            color: #fff;
            font-size: 28px;
            line-height: 1;
            cursor: pointer;
            box-shadow: 0 3px 12px rgba(0,0,0,.2);
            transition: .3s ease;
        }

        #category .gallery-arrow:hover {
            background: #a50000;
            transform: translateY(-50%) scale(1.1);
        }

        #category .gallery-arrow.prev {
            left: -18px;
        }

        #category .gallery-arrow.next {
            right: -18px;
        }

        @media (max-width: 576px) {
            #category .gallery-card {
                flex-basis: 240px;
            }

            #category .gallery-arrow.prev {
                left: 0;
            }

            #category .gallery-arrow.next {
                right: 0;
            }
        }
    </style>

   <!-- Gallery -->
    <div class="container">

        <div class="text-center mb-5">
            <span class="slbl">Dokumentasi Kegiatan</span>

            <h2 class="stitle">
                Gallery Kegiatan <span>Qonita Food Store</span>
            </h2>

            <div class="sline"></div>

            <p class="sdesc mx-auto" style="max-width: 550px;">
                Berbagai momen kegiatan, produksi, kolaborasi,
                dan perjalanan Qonita Food Store.
            </p>
        </div>

        <div class="gallery-slider">

            <!-- TOMBOL KIRI -->
            <button class="gallery-arrow prev"
                type="button"
                onclick="document.getElementById('galleryScroll').scrollBy({left: -282, behavior: 'smooth'})">
                ‹
            </button>

            <!-- DAFTAR FOTO -->
            <div class="gallery-wrapper" id="galleryScroll">

                <!-- FOTO 1 -->
                <div class="gallery-card">
                    <img src="{{ asset('uploads/gallery/collab1.jpeg') }}"
                         alt="Kegiatan bazar Dimsum Qonita">

                    <div class="gallery-content">
                        <div class="gallery-number">KEGIATAN 01</div>
                        <h5>Partisipasi Acara</h5>
                        <p>
                            Partisipasi Qonita Food Store dalam kegiatan
                            dengan menjadi sponsor dan membuka stan penjualan di Event Kampus UPI Purwakarta
                        </p>
                    </div>
                </div>

                <!-- FOTO 2 -->
                <div class="gallery-card">
                    <img src="{{ asset('uploads/gallery/collab2.jpeg') }}"
                         alt="Stan penjualan Dimsum Qonita">

                    <div class="gallery-content">
                        <div class="gallery-number">KEGIATAN 02</div>
                        <h5>Kegiatan Bazar</h5>
                        <p>
                           Keikutsertaan Qonita Food Store dalam kegiatan
                            bazar melalui pembukaan stan makanan disalah satu Sekolah di Purwakarta.
                    </div>
                </div>

                <!-- FOTO 3 -->
                <div class="gallery-card">
                    <img src="{{ asset('uploads/gallery/collab3.jpeg') }}"
                         alt="Partisipasi acara Dimsum Qonita">

                    <div class="gallery-content">
                        <div class="gallery-number">KEGIATAN 03</div>
                        <h5>Stan Penjualan</h5>
                        <p>
                            Kegiatan penjualan produk Qonita Food Store
                            di area acara indoor dengan berbagai pilihan menu.
                        </p>
                        </p>
                    </div>
                </div>

                <!-- FOTO 4 -->
                <div class="gallery-card">
                    <img src="{{ asset('uploads/gallery/collab4.jpeg') }}"
                         alt="Aktivitas penjualan Dimsum Qonita">

                    <div class="gallery-content">
                        <div class="gallery-number">KEGIATAN 04</div>
                        <h5>Aktivitas Penjualan</h5>
                        <p>
                            Aktivitas tim dalam melayani pelanggan
                            dan memperkenalkan produk Qonita Food Store.
                        </p>
                    </div>
                </div>
                <!-- FOTO 5 -->
                <div class="gallery-card">
                    <img src="{{ asset('uploads/gallery/produksi1.jpeg') }}"
                         alt="Partisipasi acara Dimsum Qonita">

                    <div class="gallery-content">
                        <div class="gallery-number">KEGIATAN 05</div>
                        <h5>Proses Pencetakan Dimsum</h5>
                        <p>
                            Proses pencetakan dimsum yang dilakukan oleh Tim atau Pekerja.
                        </p>
                    </div>
                </div>
                <!-- FOTO 6 -->
                <div class="gallery-card">
                    <img src="{{ asset('uploads/gallery/produksi2.jpeg') }}"
                         alt="Partisipasi acara Dimsum Qonita">

                    <div class="gallery-content">
                        <div class="gallery-number">KEGIATAN 06</div>
                        <h5>Pemotongan Toping</h5>
                        <p>
                            Proses pemotongan untuk toping dibagian atas dimsum yang dilakukan oleh Pekerja.
                        </p>
                    </div>
                </div>
                <!-- FOTO 7 -->
                <div class="gallery-card">
                    <img src="{{ asset('uploads/gallery/review1.jpeg') }}"
                         alt="Partisipasi acara Dimsum Qonita">

                    <div class="gallery-content">
                        <div class="gallery-number">KEGIATAN 07</div>
                        <h5>Review Menu</h5>
                        <p>
                            Review yang dilakukan oleh salah satu Selegram di Purwakarta "Mas Blangkon" yang mereview menu andalan dan semua jenis dimsum yang diproduksi oleh Qonita Food Store.
                        </p>
                    </div>
                </div>
                <!-- FOTO 8 -->
                <div class="gallery-card">
                    <img src="{{ asset('uploads/gallery/review2.jpeg') }}"
                         alt="Partisipasi acara Dimsum Qonita">

                    <div class="gallery-content">
                        <div class="gallery-number">KEGIATAN 08</div>
                        <h5>Review Menu</h5>
                        <p>
                            Review yang dilakukan oleh salah satu Selegram sekaligus Food Vlogger di Purwakarta "Mila" yang mereview menu andalan dan semua jenis dimsum yang diproduksi oleh Qonita Food Store.
                        </p>
                    </div>
                </div>
                <!-- FOTO 9 -->
                <div class="gallery-card">
                    <img src="{{ asset('uploads/gallery/bestproduk.jpeg') }}"
                         alt="Partisipasi acara Dimsum Qonita">

                    <div class="gallery-content">
                        <div class="gallery-number">KEGIATAN 09</div>
                        <h5>Best Produk</h5>
                        <p>
                            Menu andalan atau Menu favorit yang banyak diminati oleh konsumen Qonita Food Store.
                        </p>
                    </div>
                </div>
                <!-- FOTO 10 -->
                <div class="gallery-card">
                    <img src="{{ asset('uploads/gallery/berbagi.jpeg') }}"
                         alt="Partisipasi acara Dimsum Qonita">

                    <div class="gallery-content">
                        <div class="gallery-number">KEGIATAN 10</div>
                        <h5>Berbagi Dimsum Qonita</h5>
                        <p>
                            Kegiatan berbagi dimsum gratis yang dilakukan oleh Qonita Food Store pada Bulan Ramadhan. 
                        </p>
                    </div>
                </div>

            </div>

            <!-- TOMBOL KANAN -->
            <button class="gallery-arrow next"
                type="button"
                onclick="document.getElementById('galleryScroll').scrollBy({left: 282, behavior: 'smooth'})">
                ›
            </button>

        </div>

        <div class="text-center mt-3">
            <small style="color: #999;">
                <i class="fas fa-arrows-left-right me-1"></i>
                Klik tombol panah atau geser untuk melihat foto lainnya
            </small>
        </div>

    </div>
</section>



<section id="menu">
    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">
            <span class="slbl">What's Cooking</span>
            <h2 class="stitle">Our Delicious <span>Menu</span></h2>
            <div class="sline"></div>
        </div>

        {{-- Filter kategori otomatis --}}
        <div class="text-center mb-4" data-aos="fade-up">
            <button class="filtbtn active" data-f="all">All</button>

            @foreach ($produks->pluck('kategori')->filter()->unique('id_kategori') as $kategori)
                <button class="filtbtn"
                    data-f="kategori-{{ $kategori->id_kategori }}">
                    {{ $kategori->nama_kategori }}
                </button>
            @endforeach
        </div>

        {{-- Daftar produk --}}
        <div class="row g-4" id="mgrid">

            @forelse ($produks as $produk)
                <div class="col-sm-6 col-lg-4 mwrap"
                    data-c="kategori-{{ $produk->id_kategori }}"
                    data-aos="fade-up">

                    <div class="mcard"
                        data-img="{{ $produk->gambar ? asset('storage/' . $produk->gambar) : '' }}"
                        data-title="{{ $produk->nama_produk }}"
                        data-cat="{{ $produk->kategori->nama_kategori ?? 'Tanpa Kategori' }}"
                        data-desc="{{ $produk->deskripsi }}">

                        <div class="mimg">
                            @if ($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}"
                                    alt="{{ $produk->nama_produk }}">
                            @else
                                <img src="{{ asset('img/menu/default.jpg') }}"
                                    alt="Gambar produk">
                            @endif

                            <div class="mhrt">
                                <i class="far fa-heart"></i>
                            </div>
                        </div>

                        <div class="mbody">

                            <div class="mcat">
                                {{ $produk->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                            </div>

                            <div class="mtit">
                                {{ $produk->nama_produk }}
                            </div>

                            <div class="mdesc">
                                {{ $produk->deskripsi }}
                            </div>

                            {{-- Harga dan cabang --}}
                            <div class="mt-3">
                                <strong style="font-size: .85rem;">
                                    Tersedia di:
                                </strong>

                                @forelse ($produk->cabangs as $cabang)
                                    <div class="d-flex justify-content-between align-items-center mt-2"
                                        style="font-size: .85rem;">

                                        <span>{{ $cabang->nama_cabang }}</span>

                                        <strong style="color: #820000;">
                                            Rp {{ number_format($cabang->pivot->harga, 0, ',', '.') }}
                                        </strong>
                                    </div>
                                @empty
                                    <div class="text-muted mt-2"
                                        style="font-size: .8rem;">
                                        Belum tersedia di cabang mana pun.
                                    </div>
                                @endforelse
                            </div>

                           <div class="mfoot mt-3 d-flex justify-content-center">
                              <a href="https://wa.me/6283899889808?text={{ urlencode('Halo Go Dimsum, saya ingin memesan ' . $produk->nama_produk) }}"
                                 target="_blank"
                                 rel="noopener noreferrer"
                                 class="btn-red">
                                 <i class="fab fa-whatsapp"></i>
                                 Order via WhatsApp
                              </a>
                           </div>

                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 text-center py-5">
                    <h5>Belum ada produk tersedia.</h5>
                    <p class="text-muted">
                        Produk yang ditambahkan admin akan muncul di sini.
                    </p>
                </div>
            @endforelse

        </div>

        <div class="text-center mt-5">
            <a href="#" class="btn-red">
                <i class="fas fa-th-large"></i>
                View Full Menu
            </a>
        </div>

    </div>
</section>

      <!-- SPECIAL OFFER -->
      <section id="special">
         <div class="spbg"></div>
         <div class="container" style="position:relative;z-index:2;">
            <div class="row align-items-center g-5">
               <div class="col-lg-6" data-aos="fade-right">
                  <div class="sptag"><i class="fas fa-bolt me-1"></i>Limited Time Offer</div>
                  <h2 class="sptitle">Get 30% Off<br/>Our Signature<br/><span>Burger</span> Meal</h2>
                  <p class="spdesc">Don't miss our weekend special - grab our award-winning signature burger combo with loaded fries and a premium shake at an unbeatable price.</p>
                  <div class="cdwrap">
                     <div class="cditem"><span class="cdnum" id="cdH">08</span><span class="cdlbl">Hours</span></div>
                     <div class="cditem"><span class="cdnum" id="cdM">45</span><span class="cdlbl">Minutes</span></div>
                     <div class="cditem"><span class="cdnum" id="cdS">30</span><span class="cdlbl">Seconds</span></div>
                  </div>
                  <a href="#menu" class="btn-red"><i class="fas fa-shopping-cart"></i>Grab the Deal</a>
               </div>
               <div class="col-lg-6" data-aos="fade-left">
                  <div class="spimgw">
                     <div class="spglow"></div>
                     <div class="sppbdg"><span class="old">$24.99</span><span class="np">$17.49</span></div>
                     <img src="img/off-img.jpg" alt="Special Burger"/>
                  </div>
               </div>
            </div>
         </div>
      </section>
                     </div>
                  </div>
               </div>
               <!-- CARD 3: Chicken -->
               <div class="col-sm-6 col-lg-4 mwrap" data-c="chicken" data-aos="fade-up" data-aos-delay="160">
                  <div class="mcard"
                     data-img="img/menu/3.jpg"
                     data-title="Nashville Hot Chicken"
                     data-cat="Chicken"
                     data-price="$12.99" data-old="$16.99"
                     data-rating="5.0" data-reviews="210"
                     data-cal="710" data-time="15"
                     data-desc="Extra-crispy fried chicken tossed in our signature fiery Nashville spice blend, served with honey drizzle and house pickles on a toasted brioche bun."
                     data-tags="Spicy,Bestseller,Crispy">
                     <div class="mimg">
                        <img src="img/menu/3.jpg" alt="Chicken"/>
                        <div class="mbdg"><i class="fas fa-star"></i> Best Seller</div>
                        <div class="mhrt"><i class="far fa-heart"></i></div>
                     </div>
                     <div class="mbody">
                        <div class="mcat">Chicken</div>
                        <div class="mtit">Nashville Hot Chicken</div>
                        <div class="mdesc">Crispy fried chicken in fiery Nashville spice blend with honey drizzle</div>
                        <div class="mfoot">
                           <div>
                              <div class="mprice">$12.99 <small>$16.99</small></div>
                              <div class="mstars"><i class="fas fa-star"></i> <span style="color:#bbb;font-size:.7rem;">(210)</span></div>
                           </div>
                           <button class="madd" title="View Details"><i class="fas fa-plus"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- CARD 4: Wraps -->
               <div class="col-sm-6 col-lg-4 mwrap" data-c="wraps" data-aos="fade-up">
                  <div class="mcard"
                     data-img="img/menu/4.jpg"
                     data-title="Loaded Fajita Wrap"
                     data-cat="Wraps"
                     data-price="$10.99" data-old=""
                     data-rating="4.5" data-reviews="74"
                     data-cal="520" data-time="10"
                     data-desc="Grilled chicken strips, saut�ed bell peppers and onions, sour cream, fresh guacamole and salsa wrapped in a warm flour tortilla with melted cheddar."
                     data-tags="Grilled,Fresh,Mexican">
                     <div class="mimg">
                        <img src="img/menu/4.jpg" alt="Wrap"/>
                        <div class="mhrt"><i class="far fa-heart"></i></div>
                     </div>
                     <div class="mbody">
                        <div class="mcat">Wraps</div>
                        <div class="mtit">Loaded Fajita Wrap</div>
                        <div class="mdesc">Grilled chicken, peppers, sour cream &amp; guacamole in a warm tortilla</div>
                        <div class="mfoot">
                           <div>
                              <div class="mprice">$10.99</div>
                              <div class="mstars"><i class="fas fa-star"></i> <span style="color:#bbb;font-size:.7rem;">(74)</span></div>
                           </div>
                           <button class="madd" title="View Details"><i class="fas fa-plus"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- CARD 5: Desserts -->
               <div class="col-sm-6 col-lg-4 mwrap" data-c="desserts" data-aos="fade-up" data-aos-delay="80">
                  <div class="mcard"
                     data-img="img/menu/5.jpg"
                     data-title="Nutella Lava Cake"
                     data-cat="Desserts"
                     data-price="$8.99" data-old="$11.99"
                     data-rating="4.9" data-reviews="56"
                     data-cal="390" data-time="8"
                     data-desc="Warm molten chocolate cake with a gooey Nutella center, served alongside Madagascar vanilla bean ice cream with salted caramel drizzle and fresh berries."
                     data-tags="Sweet,New,Chocolate">
                     <div class="mimg">
                        <img src="img/menu/5.jpg" alt="Lava Cake"/>
                        <div class="mbdg new"><i class="fas fa-star"></i> New</div>
                        <div class="mhrt"><i class="far fa-heart"></i></div>
                     </div>
                     <div class="mbody">
                        <div class="mcat">Desserts</div>
                        <div class="mtit">Nutella Lava Cake</div>
                        <div class="mdesc">Molten chocolate cake with Nutella center, vanilla ice cream &amp; caramel</div>
                        <div class="mfoot">
                           <div>
                              <div class="mprice">$8.99 <small>$11.99</small></div>
                              <div class="mstars"><i class="fas fa-star"></i> <span style="color:#bbb;font-size:.7rem;">(56)</span></div>
                           </div>
                           <button class="madd" title="View Details"><i class="fas fa-plus"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- CARD 6: Pasta -->
               <div class="col-sm-6 col-lg-4 mwrap" data-c="pasta" data-aos="fade-up" data-aos-delay="160">
                  <div class="mcard"
                     data-img="img/menu/6.jpg"
                     data-title="Truffle Mushroom Pasta"
                     data-cat="Pasta"
                     data-price="$16.99" data-old=""
                     data-rating="4.9" data-reviews="88"
                     data-cal="560" data-time="20"
                     data-desc="Al dente tagliatelle tossed with mixed wild mushrooms, freshly shaved black truffle, aged parmesan, fresh thyme and a touch of cream in garlic butter."
                     data-tags="Vegetarian,Chef's Pick,Italian">
                     <div class="mimg">
                        <img src="img/menu/6.jpg" alt="Pasta"/>
                        <div class="mbdg hot">Chef's Pick</div>
                        <div class="mhrt"><i class="far fa-heart"></i></div>
                     </div>
                     <div class="mbody">
                        <div class="mcat">Pasta</div>
                        <div class="mtit">Truffle Mushroom Pasta</div>
                        <div class="mdesc">Al dente tagliatelle, wild mushrooms, black truffle, parmesan &amp; thyme</div>
                        <div class="mfoot">
                           <div>
                              <div class="mprice">$16.99</div>
                              <div class="mstars"><i class="fas fa-star"></i> <span style="color:#bbb;font-size:.7rem;">(88)</span></div>
                           </div>
                           <button class="madd" title="View Details"><i class="fas fa-plus"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end #mgrid -->
            <div class="text-center mt-5"><a href="#" class="btn-red"><i class="fas fa-th-large"></i>View Full Menu</a></div>
         </div>
      </section>
	  
	  
      <!-- ============================================================
         FIX 4 � MENU DETAIL POPUP MODAL
         ============================================================ -->
      <div id="menuPop">
         <div class="mpbox">
            <button class="mpclose" id="mpClose"><i class="fas fa-times"></i></button>
            <div class="mpimg"><img id="mpImg" src="" alt=""/></div>
            <div class="mpbody">
               <div id="mpCat"></div>
               <div id="mpTitle"></div>
               <div id="mpStars"></div>
               <div id="mpDesc"></div>
               <div id="mpPrice"></div>
               <div class="mpmeta" id="mpMeta"></div>
               <div class="mpqty">
                  <button class="mpqbtn" id="mpMinus">-</button>
                  <span class="mpqnum" id="mpQnum">1</span>
                  <button class="mpqbtn" id="mpPlus">+</button>
                  <span style="font-size:.82rem;color:#aaa;margin-left:9px;">portion</span>
               </div>
               <div class="mptags" id="mpTags"></div>
               <button class="mpaddcart" id="mpAddCart"><i class="fas fa-shopping-cart"></i>Add to Cart</button>
            </div>
         </div>
      </div>
      
	  
      <!-- ============================================================
         GALLERY � FIX 7 (click opens detail popup)
         ============================================================ -->
      <!-- <section id="gallery">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">Food Showcase</span>
               <h2 class="stitle">Let's See Our <span>Fast Food</span></h2>
               <div class="sline"></div>
            </div>
            <div class="ggrid" data-aos="fade-up">
               <div class="gitem"
                  data-gi="0"
                  data-gimg="img/portfolio/work1.jpg"
                  data-gtitle="Gourmet Burgers"
                  data-gdesc="Our award-winning smash burgers, hand-crafted with 100% premium beef, aged cheddar and house-made sauces.">
                  <img src="img/portfolio/work1.jpg" alt="Burgers"/>
                  <div class="gover"><span><i class="fas fa-expand-alt"></i> Gourmet Burgers</span></div>
               </div>
               <div class="gitem"
                  data-gi="1"
                  data-gimg="img/portfolio/work2.jpg"
                  data-gtitle="Wood-Fired Pizza"
                  data-gdesc="Authentic Neapolitan-style pizzas fired at 900deg F in our wood-burning stone oven for the perfect char.">
                  <img src="img/portfolio/work2.jpg" alt="Pizza"/>
                  <div class="gover"><span><i class="fas fa-expand-alt"></i> Wood-Fired Pizza</span></div>
               </div>
               <div class="gitem"
                  data-gi="2"
                  data-gimg="img/portfolio/work3.jpg"
                  data-gtitle="Crispy Fried Chicken"
                  data-gdesc="Double-brined, hand-battered chicken fried to golden perfection using our 15-spice secret blend.">
                  <img src="img/portfolio/work3.jpg" alt="Chicken"/>
                  <div class="gover"><span><i class="fas fa-expand-alt"></i> Crispy Fried Chicken</span></div>
               </div>
               <div class="gitem"
                  data-gi="3"
                  data-gimg="img/portfolio/work4.jpg"
                  data-gtitle="Sweet Desserts"
                  data-gdesc="Handcrafted desserts - from molten lava cakes to artisan ice cream sundaes and seasonal pastries.">
                  <img src="img/portfolio/work4.jpg" alt="Desserts"/>
                  <div class="gover"><span><i class="fas fa-expand-alt"></i> Sweet Desserts</span></div>
               </div>
               <div class="gitem"
                  data-gi="4"
                  data-gimg="img/portfolio/work5.jpg"
                  data-gtitle="Fresh Wraps &amp; Rolls"
                  data-gdesc="Loaded fresh wraps packed with grilled proteins, crunchy vegetables and our house-made sauces.">
                  <img src="img/portfolio/work5.jpg" alt="Wraps"/>
                  <div class="gover"><span><i class="fas fa-expand-alt"></i> Fresh Wraps &amp; Rolls</span></div>
               </div>
            </div>
         </div>
      </section> -->
      <!-- FIX 7 � GALLERY POPUP -->
      <!-- <div id="galPop">
         <div class="gpbox">
            <button class="gpclose" id="gpClose"><i class="fas fa-times"></i></button>
            <img id="gpImg" src="" alt=""/>
            <div class="gpcap">
               <h5 id="gpTitle"></h5>
               <p id="gpDesc"></p>
            </div>
            <div class="gpnav">
               <button id="gpPrev"><i class="fas fa-chevron-left me-1"></i>Prev</button>
               <button id="gpNext">Next <i class="fas fa-chevron-right ms-1"></i></button>
            </div>
         </div>
      </div> -->
	  
	  
      <!-- ============================================================
         HISTORY � FIX 8 (alternating left/right text)
         ============================================================ -->
      <section id="history">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">Our Journey</span>
               <h2 class="stitle">A History of <span>Restaurant</span></h2>
               <div class="sline"></div>
               <p class="sdesc mx-auto" style="max-width:480px;">From humble beginnings to the city's most beloved restaurant - every chapter written with passion.</p>
            </div>
            <div class="timeline" data-aos="fade-up">
               <!-- ODD ? text on LEFT -->
               <div class="tli">
                  <div class="tl-left">
                     <div class="tlyear">2012</div>
                     <h5>Evolution of Restaurants</h5>
                     <p>Sarab opens its first 20-seat diner on Flavor Street. Within 3 months, lines stretch around the block every evening as word of our food spreads.</p>
                  </div>
                  <div class="tl-center">
                     <div class="tldot"></div>
                  </div>
                  <div class="tl-right">
                     <div class="tlyear">2012</div>
                     <h5>Evolution of Restaurants</h5>
                     <p>Sarab opens its first 20-seat diner on Flavor Street. Within 3 months, lines stretch around the block every evening as word of our food spreads.</p>
                  </div>
               </div>
               <!-- EVEN ? text on RIGHT -->
               <div class="tli">
                  <div class="tl-left">
                     <div class="tlyear">2015</div>
                     <h5>Fine Dining &amp; The Concept</h5>
                     <p>Expanding the vision - we introduced our signature tasting menu and hired our first Michelin-trained chef, elevating our craft to remarkable new heights.</p>
                  </div>
                  <div class="tl-center">
                     <div class="tldot"></div>
                  </div>
                  <div class="tl-right">
                     <div class="tlyear">2015</div>
                     <h5>Fine Dining &amp; The Concept</h5>
                     <p>Expanding the vision - we introduced our signature tasting menu and hired our first Michelin-trained chef, elevating our craft to remarkable new heights.</p>
                  </div>
               </div>
               <!-- ODD ? text on LEFT -->
               <div class="tli">
                  <div class="tl-left">
                     <div class="tlyear">2019</div>
                     <h5>Modern Fast Food Origins</h5>
                     <p>Launched our signature fast-food line, merging gourmet quality with speed and convenience. Within 6 months we won 3 prestigious culinary awards nationally.</p>
                  </div>
                  <div class="tl-center">
                     <div class="tldot"></div>
                  </div>
                  <div class="tl-right">
                     <div class="tlyear">2019</div>
                     <h5>Modern Fast Food Origins</h5>
                     <p>Launched our signature fast-food line, merging gourmet quality with speed and convenience. Within 6 months we won 3 prestigious culinary awards nationally.</p>
                  </div>
               </div>
               <!-- EVEN ? text on RIGHT -->
               <div class="tli">
                  <div class="tl-left">
                     <div class="tlyear">2026</div>
                     <h5>National Expansion</h5>
                     <p>Now operating in 8 cities across the US with an online delivery platform handling 10,000+ orders weekly - and growing every single day.</p>
                  </div>
                  <div class="tl-center">
                     <div class="tldot"></div>
                  </div>
                  <div class="tl-right">
                     <div class="tlyear">2026</div>
                     <h5>National Expansion</h5>
                     <p>Now operating in 8 cities across the US with an online delivery platform handling 10,000+ orders weekly - and growing every single day.</p>
                  </div>
               </div>
            </div>
         </div>
      </section>
	  
	  
      <!-- CHEFS -->
      <!-- <section id="chefs">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">The Culinary Team</span>
               <h2 class="stitle">Meet Our Expert <span>Chefs</span></h2>
               <div class="sline"></div>
            </div>
            <div class="row g-4">
               <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                  <div class="chcard">
                     <div class="chimg">
                        <img src="img/chefs/1.jpg" alt=""/>
                        <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-twitter"></i></a></div>
                     </div>
                     <div class="chbody">
                        <div class="chnm">Alice Mortal</div>
                        <div class="chrole">Head Chef</div>
                        <div class="chexp">12 years experience</div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
                  <div class="chcard">
                     <div class="chimg">
                        <img src="img/chefs/2.jpg" alt=""/>
                        <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-twitter"></i></a></div>
                     </div>
                     <div class="chbody">
                        <div class="chnm">Michael Corn</div>
                        <div class="chrole">Grill Master</div>
                        <div class="chexp">8 years experience</div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
                  <div class="chcard">
                     <div class="chimg">
                        <img src="img/chefs/3.jpg" alt=""/>
                        <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-twitter"></i></a></div>
                     </div>
                     <div class="chbody">
                        <div class="chnm">Faz Chowdel</div>
                        <div class="chrole">Pastry Chef</div>
                        <div class="chexp">10 years experience</div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
                  <div class="chcard">
                     <div class="chimg">
                        <img src="img/chefs/4.jpg" alt=""/>
                        <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-twitter"></i></a></div>
                     </div>
                     <div class="chbody">
                        <div class="chnm">William Latnum</div>
                        <div class="chrole">Pizza Artisan</div>
                        <div class="chexp">9 years experience</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section> -->
	  
	  
      <!-- HOURS -->
      <!-- <section id="hours">
         <div class="hrsbg"></div>
         <div class="container" style="position:relative;z-index:2;">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl" style="color:#a5d6bc;">Opening Hours</span>
               <h2 class="stitle" style="color:#fff;">We're Open <span style="color:var(--secondary);">For You</span></h2>
               <div class="sline"></div>
            </div>
            <div class="row g-4 align-items-start">
               <div class="col-lg-5" data-aos="fade-right">
                  <div class="hrscard">
                     <div class="hrsrow">
                        <span class="hrsday"><i class="fas fa-calendar-day me-2" style="color:var(--secondary);"></i>Monday - Tuesday</span>
                        <div class="d-flex align-items-center gap-2">
                           <div class="hdot off"></div>
                           <span class="hrstime" style="color:#ff6b6b;">Closed</span>
                        </div>
                     </div>
                     <div class="hrsrow">
                        <span class="hrsday"><i class="fas fa-calendar-day me-2" style="color:var(--secondary);"></i>Wednesday - Thursday</span>
                        <div class="d-flex align-items-center gap-2">
                           <div class="hdot on"></div>
                           <span class="hrstime">09:00 AM - 10:00 PM</span>
                        </div>
                     </div>
                     <div class="hrsrow">
                        <span class="hrsday"><i class="fas fa-calendar-day me-2" style="color:var(--secondary);"></i>Friday</span>
                        <div class="d-flex align-items-center gap-2">
                           <div class="hdot on"></div>
                           <span class="hrstime">09:00 AM - 11:00 PM</span>
                        </div>
                     </div>
                     <div class="hrsrow">
                        <span class="hrsday"><i class="fas fa-calendar-day me-2" style="color:var(--secondary);"></i>Saturday</span>
                        <div class="d-flex align-items-center gap-2">
                           <div class="hdot on"></div>
                           <span class="hrstime">10:00 AM - 11:30 PM</span>
                        </div>
                     </div>
                     <div class="hrsrow">
                        <span class="hrsday"><i class="fas fa-calendar-day me-2" style="color:var(--secondary);"></i>Sunday</span>
                        <div class="d-flex align-items-center gap-2">
                           <div class="hdot on"></div>
                           <span class="hrstime">11:00 AM - 09:00 PM</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3" data-aos="zoom-in">
                  <div class="hrscta">
                     <i class="fas fa-truck-fast fa-2x mb-3" style="color:rgba(255,255,255,.8);"></i>
                     <h4>Order Online</h4>
                     <p>Get hot food delivered in 25 minutes</p>
                     <a href="#menu" class="btnw">Order Now ?</a>
                  </div>
               </div>
               <div class="col-lg-4" data-aos="fade-left">
                  <div class="hrscard">
                     <h5 style="color:#fff;margin-bottom:18px;font-family:'Poppins',sans-serif;font-size:.95rem;font-weight:700;"><i class="fas fa-map-marker-alt me-2" style="color:var(--secondary);"></i>Find Us</h5>
                     <div class="hrsrow"><span class="hrsday"><i class="fas fa-location-dot me-2" style="color:var(--secondary);"></i>Address</span><span class="hrstime" style="font-size:.8rem;">42 Flavor Street, NY</span></div>
                     <div class="hrsrow"><span class="hrsday"><i class="fas fa-phone me-2" style="color:var(--secondary);"></i>Phone</span><span class="hrstime" style="font-size:.8rem;">+1 (800) 123-4567</span></div>
                     <div class="hrsrow"><span class="hrsday"><i class="fas fa-envelope me-2" style="color:var(--secondary);"></i>Email</span><span class="hrstime" style="font-size:.8rem;">hello@sarabfood.com</span></div>
                  </div>
               </div>
            </div>
         </div>
      </section> -->
	  
	  
      <!-- TESTIMONIALS -->
      <!-- <section id="testimonials">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">What People Say</span>
               <h2 class="stitle">Our Customers <span>Feedback</span></h2>
               <div class="sline"></div>
            </div>
            <div class="swiper tesSwiper" data-aos="fade-up">
               <div class="swiper-wrapper">
                  <div class="swiper-slide">
                     <div class="tescard">
                        <div class="tesq">"</div>
                        <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="testxt">Honestly the best burgers I've ever had. The smash burger is incredible - perfectly crispy edges, juicy inside, and those pickles! We come every Friday now.</p>
                        <div class="tesauth">
                           <img src="img/testimonial/1.jpg" alt=""/>
                           <div>
                              <div class="tesnm">Monica Wilber</div>
                              <div class="tesrl">Regular Customer</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="tescard">
                        <div class="tesq">"</div>
                        <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="testxt">Ordered delivery and the food arrived hot and fresh in 22 minutes. Portions are generous. Sarab has become my go-to comfort food spot without question.</p>
                        <div class="tesauth">
                           <img src="img/testimonial/2.jpg" alt=""/>
                           <div>
                              <div class="tesnm">Cameron Fox</div>
                              <div class="tesrl">Food Blogger</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="tescard">
                        <div class="tesq">"</div>
                        <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="testxt">The truffle pasta blew my mind. I didn't expect that quality from a fast food place. Great ambiance, super friendly staff. Highly recommended!</p>
                        <div class="tesauth">
                           <img src="img/testimonial/3.jpg" alt=""/>
                           <div>
                              <div class="tesnm">Priya Sharma</div>
                              <div class="tesrl">Food Enthusiast</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="tescard">
                        <div class="tesq">"</div>
                        <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p class="testxt">Catered our office party of 50 people and everything was flawless. Fresh, delicious, on time and well presented. Nashville chicken was the absolute star!</p>
                        <div class="tesauth">
                           <img src="img/testimonial/4.jpg" alt=""/>
                           <div>
                              <div class="tesnm">David Park</div>
                              <div class="tesrl">Corporate Client</div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="swiper-pagination mt-4" style="position:static;"></div>
            </div>
         </div>
      </section> -->
	  
      <!-- BAGIAN LOKASI & OUTLET -->
      <section id="news" class="py-5" style="background-color: #FFF4E5;">
         <div class="container">
            
            <!-- Judul Section Mengikuti Gaya Template -->
             <!-- Pastikan ada id="lokasi" di sini -->
            <section id="lokasi" class="py-5" style="background-color: #FFF4E5;">
               <div class="container">
                  <!-- Judul & Kartu Peta Usman & Cipaisan -->
               </div>
            </section>
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">Lokasi & Outlet</span>
               <h2 class="stitle">Pusat produksi dan cabang resmi <span>Qonita Food Store</span></h2>
               <div class="sline"></div>
            </div>

            <div class="row">
               @foreach($cabangs as $cabang)
               <div class="col-md-6 mb-4">
                  <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
                        
                        <!-- TARUH DI SINI (UNTUK LANDING PAGE PELANGGAN) -->
                        @if(!empty($cabang->foto))
                           <img src="{{ asset('storage/' . $cabang->foto) }}" class="card-img-top" alt="{{ $cabang->nama_cabang }}" style="height: 220px; object-fit: cover;">
                        @else
                           <div style="height: 220px; background: #eee; display: flex; align-items: center; justify-content: center;" class="text-muted">
                              Tidak ada foto
                           </div>
                        @endif

                        <div class="card-body">
                           <!-- Keterangan Status: Pabrik atau Outlet -->
                                 <div class="mb-2">
                                    @if($cabang->id_cabang == 2) <!-- Sesuaikan angka ID pabrik di database kamu -->
                                       <span class="badge bg-warning text-dark" style="background-color: #886128 !important; color: white !important;">Pusat Produksi</span>
                                    @else
                                       <span class="badge bg-warning text-dark" style="background-color: #886128 !important; color: white !important;">Outlet Dimsum Qonita</span>
                                    @endif
                                 </div>
                           <h4 class="card-title fw-bold">{{ $cabang->nama_cabang }}</h4>
                           <p class="text-muted">📍 {{ $cabang->alamat }}</p>
                           
                           <!-- Embed Google Maps di bawahnya -->
                           <div style="height: 180px; border-radius: 10px; overflow: hidden;">
                              <iframe 
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    src="https://maps.google.com/maps?q={{ urlencode($cabang->alamat) }}&t=&z=15&ie=UTF8&iwloc=&output=embed">
                              </iframe>
                           </div>
                        </div>
                  </div>
               </div>
            @endforeach
            </div>
         </div>
      </section>
	  
      <!-- NEWSLETTER -->
      <!-- <section id="newsletter">
         <div class="nlbg"></div>
         <div class="container">
            <div class="nlw text-center" data-aos="zoom-in">
               <span class="slbl" style="color:rgba(255,255,255,.7);">Stay Connected</span>
               <h2 class="mb-3" style="color:#fff;">Subscribe &amp; Get Exclusive <span style="color:var(--secondary);">Deals</span></h2>
               <p class="mb-4" style="color:rgba(255,255,255,.78);">Get 15% off your first order plus early access to new menu items</p>
               <div class="nl-form-wrap">
                  <input class="nlinput" type="email" id="nlEmail" placeholder="Enter your email address..."/>
                  <button class="nlbtn" id="nlBtn"><i class="fas fa-paper-plane me-1"></i>Subscribe</button>
               </div>
               <p style="color:rgba(255,255,255,.45);font-size:.76rem;margin-top:11px;"><i class="fas fa-lock me-1"></i>No spam, unsubscribe anytime.</p>
            </div>
         </div>
      </section>
	   -->
      <!-- ============================================================
         FIX 6 � CONTACT FORM
         ============================================================ -->
      <!-- <section id="contact-section">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">Get In Touch</span>
               <h2 class="stitle">Contact <span>Us</span></h2>
               <div class="sline"></div>
               <p class="sdesc mx-auto" style="max-width:480px;">Have a question, feedback, or want to plan a special event? We'd love to hear from you.</p>
            </div>
            <div class="row g-4">
               <div class="col-lg-4" data-aos="fade-right">
                  <div class="ctdark">
                     <h4>Let's Talk</h4>
                     <p class="ctsub">We typically respond within 2 hours during business hours.</p>
                     <div class="ctitem">
                        <div class="cticon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="ctinfo"><strong>Address</strong><span>42 Flavor Street, Manhattan,<br/>New York, NY 10001</span></div>
                     </div>
                     <div class="ctitem">
                        <div class="cticon"><i class="fas fa-phone-alt"></i></div>
                        <div class="ctinfo"><strong>Phone</strong><span>+1 (800) 123-4567</span></div>
                     </div>
                     <div class="ctitem">
                        <div class="cticon"><i class="fas fa-envelope"></i></div>
                        <div class="ctinfo"><strong>Email</strong><span>hello@sarabfood.com</span></div>
                     </div>
                     <div class="ctitem">
                        <div class="cticon"><i class="fas fa-clock"></i></div>
                        <div class="ctinfo"><strong>Working Hours</strong><span>Wed - Sun: 9 AM - 11 PM</span></div>
                     </div>
                     <div class="ctsocrow">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-8" data-aos="fade-left">
                  <div class="fcard">
                     <div class="row g-3">
                        <div class="col-sm-6"><label class="flbl">Your Name *</label><input type="text" class="fctrl" placeholder="John Doe"/></div>
                        <div class="col-sm-6"><label class="flbl">Email Address *</label><input type="email" class="fctrl" placeholder="you@email.com"/></div>
                        <div class="col-sm-6"><label class="flbl">Phone Number</label><input type="tel" class="fctrl" placeholder="+1 (800) 000-0000"/></div>
                        <div class="col-sm-6">
                           <label class="flbl">Subject *</label>
                           <select class="fctrl">
                              <option>General Inquiry</option>
                              <option>Catering &amp; Events</option>
                              <option>Feedback</option>
                              <option>Partnership</option>
                              <option>Media &amp; Press</option>
                           </select>
                        </div>
                        <div class="col-12"><label class="flbl">Message *</label><textarea class="fctrl" rows="5" placeholder="Write your message here..."></textarea></div>
                        <div class="col-12"><button class="btn-red" id="ctcBtn"><i class="fas fa-paper-plane"></i>Send Message</button></div>
                     </div>
                     <div class="sucmsg" id="ctcOk">
                        <i class="fas fa-check-circle"></i>
                        <p>Message sent! We'll reply within 2 hours.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section> -->
@endsection