{{-- Tema warna Dimsum Qonita (maroon + krem), hanya berlaku di dalam .tema-qonita --}}
<style>
    .tema-qonita {
        --qn-maroon: #820000;
        --qn-maroon-gelap: #680000;
        --qn-krem: #FFF3E5;
        --qn-krem-tua: #F8E7CF;
        --qn-coklat: #3B2300;
        --qn-coklat-label: #5C3D0E;
        --qn-garis: #EBD9B4;
        --qn-aksen: #DDA45D;

        --bs-body-color: var(--qn-coklat);
        --bs-border-color: var(--qn-garis);
        --bs-link-color: var(--qn-maroon);
        --bs-link-hover-color: var(--qn-maroon-gelap);
        color: var(--qn-coklat);
    }

    /* Latar halaman: ikut layout admin (putih). Mau krem? tambahkan:
       body:has(.tema-qonita) { background-color: #FFF3E5 !important; } */

    /* Warna link (Bootstrap 5.3 memakai variabel -rgb) */
    .tema-qonita {
        --bs-link-color-rgb: 130, 0, 0;
        --bs-link-hover-color-rgb: 104, 0, 0;
    }

    .tema-qonita h4,
    .tema-qonita h5,
    .tema-qonita h6 { color: var(--qn-coklat); font-weight: 700; }

    .tema-qonita .form-label,
    .tema-qonita dt { color: var(--qn-coklat-label); font-weight: 600; }

    .tema-qonita .text-muted { color: #8C7A63 !important; }

    /* Kartu */
    .tema-qonita .card {
        border: 1px solid var(--qn-garis);
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(130, 0, 0, .06);
        overflow: hidden;
    }
    .tema-qonita .card-header {
        background: var(--qn-maroon);
        color: #fff;
        font-weight: 600;
        border-bottom: 0;
    }
    .tema-qonita .card.border-primary { border-color: var(--qn-maroon) !important; border-width: 2px; }

    /* Tombol utama = maroon */
    .tema-qonita .btn-primary {
        --bs-btn-bg: var(--qn-maroon);
        --bs-btn-border-color: var(--qn-maroon);
        --bs-btn-hover-bg: var(--qn-maroon-gelap);
        --bs-btn-hover-border-color: var(--qn-maroon-gelap);
        --bs-btn-active-bg: var(--qn-maroon-gelap);
        --bs-btn-active-border-color: var(--qn-maroon-gelap);
        --bs-btn-disabled-bg: var(--qn-maroon);
        --bs-btn-disabled-border-color: var(--qn-maroon);
        --bs-btn-color: #fff;
        --bs-btn-hover-color: #fff;
        --bs-btn-active-color: #fff;
        background-image: none;
        border-radius: 12px;
        font-weight: 600;
    }
    .tema-qonita .btn-outline-primary {
        --bs-btn-color: var(--qn-maroon);
        --bs-btn-border-color: var(--qn-maroon);
        --bs-btn-hover-bg: var(--qn-maroon);
        --bs-btn-hover-border-color: var(--qn-maroon);
        --bs-btn-active-bg: var(--qn-maroon);
        --bs-btn-active-border-color: var(--qn-maroon);
        border-radius: 10px;
    }
    .tema-qonita .btn-dark {
        --bs-btn-bg: var(--qn-coklat);
        --bs-btn-border-color: var(--qn-coklat);
        --bs-btn-hover-bg: #2A1900;
        --bs-btn-hover-border-color: #2A1900;
        --bs-btn-color: #fff;
        --bs-btn-hover-color: #fff;
        background-image: none;
        border-radius: 12px;
    }
    .tema-qonita .btn-link { color: var(--qn-maroon); }

    /* Input */
    .tema-qonita .form-control,
    .tema-qonita .form-select {
        border: 1px solid var(--qn-garis);
        border-radius: 12px;
        padding: .6rem .85rem;
    }
    .tema-qonita .form-control:focus,
    .tema-qonita .form-select:focus {
        border-color: var(--qn-maroon);
        box-shadow: 0 0 0 .2rem rgba(130, 0, 0, .15);
    }

    /* Kolom cari dengan ikon */
    .tema-qonita .input-group > .input-group-text {
        background: #fff;
        color: var(--qn-maroon);
        border: 1px solid var(--qn-garis);
        border-right: 0;
        border-radius: 12px 0 0 12px;
        padding-left: .9rem;
    }
    .tema-qonita .input-group > .form-control {
        border-left: 0;
        border-radius: 0 12px 12px 0;
        padding-left: .4rem;
    }
    .tema-qonita .input-group:focus-within > .input-group-text {
        border-color: var(--qn-maroon);
    }
    .tema-qonita .input-group:focus-within > .form-control {
        box-shadow: none;
        border-color: var(--qn-maroon);
    }
    .tema-qonita .input-group:focus-within {
        box-shadow: 0 0 0 .2rem rgba(130, 0, 0, .15);
        border-radius: 12px;
    }

    /* Tabel */
    .tema-qonita .table { --bs-table-hover-bg: var(--qn-krem); }
    .tema-qonita .table thead th {
        background: var(--qn-krem-tua);
        color: var(--qn-coklat-label);
        border-bottom: 1px solid var(--qn-garis);
        font-weight: 700;
    }
    .tema-qonita .table > :not(caption) > * > * { border-bottom-color: var(--qn-garis); }

    /* Badge */
    .tema-qonita .badge.text-bg-primary { background-color: var(--qn-maroon) !important; }
    .tema-qonita .badge.text-bg-secondary { background-color: #8C7A63 !important; color: #fff !important; }
    .tema-qonita .badge.text-bg-warning { background-color: var(--qn-aksen) !important; color: var(--qn-coklat) !important; }
    .tema-qonita .badge.text-bg-light { background-color: var(--qn-krem-tua) !important; color: var(--qn-coklat-label) !important; }
    .tema-qonita .badge { border-radius: 999px; padding: .45em .8em; font-weight: 600; }

    /* Kartu ringkasan */
    .tema-qonita .ringkasan .fs-3 { color: var(--qn-maroon) !important; }

    /* Pill filter status */
    .tema-qonita .nav-pills .nav-link { color: var(--qn-maroon); border-radius: 999px; font-weight: 600; }
    .tema-qonita .nav-pills .nav-link.active { background-color: var(--qn-maroon); color: #fff; }

    /* Daftar riwayat */
    .tema-qonita .list-group-item { border-color: var(--qn-garis); background: transparent; }

    /* Alert */
    .tema-qonita .alert-danger { background: #FBE9E7; border-color: #E8B4AD; color: #8A1C12; }
    .tema-qonita .alert-success { border-radius: 12px; }
</style>
