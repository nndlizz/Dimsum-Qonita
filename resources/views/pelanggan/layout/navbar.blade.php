@php
    $idPelangganNav = session('pelanggan_id')
        ?? session('id_pelanggan')
        ?? \Illuminate\Support\Facades\Auth::guard('pelanggan')->id()
        ?? \Illuminate\Support\Facades\Auth::id();

    $sudahLoginNav = !empty($idPelangganNav);
    $jumlahNotifNav = 0;

    if ($sudahLoginNav) {
        $jumlahNotifNav = \Illuminate\Support\Facades\DB::table('notifikasi')
            ->where('id_pelanggan', $idPelangganNav)
            ->where('status_baca', false)
            ->count();
    }
@endphp



<nav class="navbar navbar-expand-xl nq-nav" id="navQonita">
    <div class="nq-bar">

        {{-- LOGO --}}
<a class="navbar-brand nq-brand" href="{{ url('/#hero') }}">
    <img src="{{ asset('template_admin/assets/images/logo.png') }}"
         alt="Logo Dimsum Qonita"
         class="nq-logo">
</a>

           

<button class="navbar-toggler nq-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navmenuQonita"
        aria-label="Buka menu">
    <i class="fas fa-bars"></i>
</button>

<div class="collapse navbar-collapse nq-collapse" id="navmenuQonita">

    <span class="nq-garis d-none d-xl-block"></span>

    {{-- MENU --}}
    <ul class="navbar-nav nq-menu">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#hero') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#category') }}">Galeri</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#menu') }}">Menu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#jam-operasional') }}">Jam Operasional</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#lokasi') }}">Lokasi</a>
        </li>
    </ul>

    {{-- KANAN --}}
    <div class="nq-kanan">

        @if ($sudahLoginNav)

            {{-- NOTIFIKASI --}}
            <a href="{{ route('pelanggan.notifikasi') }}"
               class="nq-bel"
               title="Notifikasi">

                <i class="fas fa-bell"></i>

                @if ($jumlahNotifNav > 0)
                    <span class="nq-badge">
                        {{ $jumlahNotifNav > 99 ? '99+' : $jumlahNotifNav }}
                    </span>
                @endif
            </a>

            {{-- DROPDOWN PROFIL --}}
            <div class="dropdown">

                <button class="nq-tombol nq-profil"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                    <i class="fas fa-user"></i>
                    <span>{{ session('nama_pelanggan', 'Pelanggan') }}</span>
                    <i class="fas fa-chevron-down nq-panah"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end nq-dropdown">

                    <li class="nq-dd-nama">
                        <strong>{{ session('nama_pelanggan', 'Pelanggan') }}</strong>
                        <small>Pelanggan</small>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a href="{{ route('pelanggan.profil') }}"
                           class="dropdown-item nq-dd-item">
                            <i class="bi bi-person-circle me-2"></i>
                            Profil Saya
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pelanggan.sponsor.create') }}"
                           class="dropdown-item nq-dd-item">
                            <i class="fas fa-heart me-2"></i>
                            Ajukan Sponsor
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pelanggan.riwayat') }}"
                           class="dropdown-item nq-dd-item">
                            <i class="fas fa-history me-2"></i>
                            Riwayat Sponsor
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item nq-dd-keluar">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Keluar
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

        @else

            {{-- LOGIN --}}
            <a href="{{ route('login') }}"
               class="nq-tombol nq-profil">
                <i class="fas fa-user"></i>
                <span>Login</span>
            </a>
                @if ($jumlahNotifNav > 0)
                    <span class="nq-badge">
                        {{ $jumlahNotifNav > 99 ? '99+' : $jumlahNotifNav }}
                    </span>
                @endif
            </a>

            {{-- DROPDOWN PROFIL --}}
            <div class="dropdown">
                <button class="nq-tombol nq-profil"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                    <i class="fas fa-user"></i>
                    <span>{{ session('nama_pelanggan', 'Pelanggan') }}</span>
                    <i class="fas fa-chevron-down nq-panah"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end nq-dropdown">

                    <li class="nq-dd-nama">
                        <strong>{{ session('nama_pelanggan', 'Pelanggan') }}</strong>
                        <small>Pelanggan</small>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a href="{{ route('pelanggan.profil') }}"
                           class="dropdown-item nq-dd-item">
                            <i class="bi bi-person-circle me-2"></i>
                            Profil Saya
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pelanggan.sponsor.create') }}"
                           class="dropdown-item nq-dd-item">
                            <i class="fas fa-heart me-2"></i>
                            Ajukan Sponsor
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('pelanggan.riwayat') }}"
                           class="dropdown-item nq-dd-item">
                            <i class="fas fa-history me-2"></i>
                            Riwayat Sponsor
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item nq-dd-keluar">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Keluar
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

        @else

            {{-- LOGIN --}}
            <a href="{{ route('login') }}" class="nq-tombol nq-profil">
                <i class="fas fa-user"></i>
                <span>Login</span>
            </a>

        @endif

    </div>
</div>
</div>
</nav>

<style>
    .nq-nav {
        --nq-utama: #800000;
        --nq-utama-gelap: #680000;
        --nq-emas: #E59A3C;

        position: sticky;
        top: 0;
        z-index: 1030;
        width: 100%;
        padding: 0;
        margin: 0;
        background: #fff;
    }

    /* NAVBAR FULL WIDTH */
    .nq-nav .nq-bar {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 12px 40px;

        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px 14px;

        background: #fff;
        border-radius: 0;
        box-shadow: 0 8px 30px rgba(60, 20, 20, .10);
    }

    /* LOGO */
    .nq-brand {
    display: flex;
    align-items: center;
    gap: 5px; /* Jarak logo dan tulisan */
    text-decoration: none;
    }

    .nq-logo {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
    }

    .nq-brand-teks {
        display: flex;
        flex-direction: column;
        line-height: 1.1;
        margin-left: 0;
    }

    .nq-nav .nq-brand-nama {
        font-size: 22px;
        font-weight: 800;
        color: var(--nq-utama);
    }

    .nq-nav .nq-brand-nama span {
        color: var(--nq-emas);
    }

    .nq-nav .nq-brand-sub {
        font-size: 11px;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: #8C7A63;
        margin-top: 4px;
    }

    /* COLLAPSE */
    .nq-nav .nq-collapse {
        align-items: center;
        gap: 12px 8px;
        flex: 1;
        min-width: 0;
    }

    .nq-nav .nq-garis {
        width: 1px;
        height: 42px;
        background: #eadada;
        margin: 0 10px 0 20px;
        flex-shrink: 0;
    }

    /* MENU */
    .nq-nav .nq-menu {
        gap: 4px;
        margin-right: auto;
        align-items: center;
    }

    .nq-nav .nq-menu .nav-link {
        padding: 9px 12px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 600;
        color: #3B2300;
        transition: .2s;
        white-space: nowrap;
    }

    .nq-nav .nq-menu .nav-link:hover {
        background: #fdf1f1;
        color: var(--nq-utama);
    }

    .nq-nav .nq-menu .nav-link.active {
        background: #fbe4e4;
        color: var(--nq-utama);
    }

    /* KANAN */
    .nq-nav .nq-kanan {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        flex-shrink: 0;
    }

    /* NOTIFIKASI */
    .nq-nav .nq-bel {
        position: relative;
        width: 44px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--nq-utama);
        background: #fff;
        border: 2px solid var(--nq-utama);
        border-radius: 50%;
        text-decoration: none;
        transition: .2s;
        flex-shrink: 0;
    }

    .nq-nav .nq-bel:hover {
        background: var(--nq-utama);
        color: #fff;
    }

    /* BADGE NOTIFIKASI */
    .nq-nav .nq-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        min-width: 20px;
        height: 20px;
        padding: 0 5px;
        border-radius: 999px;
        background: #e11d2e;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
    }

    /* TOMBOL PROFIL */
    .nq-nav .nq-profil {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
        border: 2px solid var(--nq-utama);
        background: #fff !important;
        color: var(--nq-utama) !important;
        transition: .2s;
        cursor: pointer;
    }

    .nq-nav .nq-profil:hover,
    .nq-nav .nq-profil:focus,
    .nq-nav .nq-profil.show {
        background: var(--nq-utama) !important;
        color: #fff !important;
        border-color: var(--nq-utama) !important;
    }

    .nq-nav .nq-profil:hover i,
    .nq-nav .nq-profil:focus i,
    .nq-nav .nq-profil.show i {
        color: #fff !important;
    }

    .nq-nav .nq-panah {
        font-size: 12px;
        margin-left: 2px;
    }

    /* DROPDOWN SESSION */
    .nq-nav .nq-dropdown {
        min-width: 230px;
        margin-top: 12px !important;
        padding: 8px;
        border: 0;
        border-radius: 16px;
        box-shadow: 0 12px 34px rgba(60, 20, 20, .16);
    }

    /* ITEM DROPDOWN */
    .nq-nav .nq-dd-item {
        padding: 10px 12px;
        border-radius: 10px;
        font-size: 14px;
        color: #3B2300;
        transition: .2s;
    }

    .nq-nav .nq-dd-item i {
        color: var(--nq-utama);
        width: 18px;
    }

    .nq-nav .nq-dd-item:hover {
        background: #fdf1f1;
        color: var(--nq-utama);
    }

    /* PEMBATAS DROPDOWN */
    .nq-nav .nq-dropdown .dropdown-divider {
        margin: 6px 0;
        border-color: #eadada;
    }

    /* PROFIL DROPDOWN */
    .nq-nav .nq-dd-nama {
        display: flex;
        flex-direction: column;
        padding: 8px 12px;
    }

    .nq-nav .nq-dd-nama strong {
        font-size: 14px;
        color: #3B2300;
    }

    .nq-nav .nq-dd-nama small {
        color: #8C7A63;
        font-size: 12px;
    }

    /* KELUAR */
    .nq-nav .nq-dd-keluar {
        color: #dc3545;
        border-radius: 10px;
        padding: 9px 12px;
        width: 100%;
        text-align: left;
    }

    .nq-nav .nq-dd-keluar:hover {
        background: #fff1f2;
        color: #dc3545;
    }

    /* TOGGLER HP */
    .nq-nav .nq-toggler {
        margin-left: auto;
        border: 0;
        font-size: 22px;
        color: var(--nq-utama);
        padding: 6px 10px;
    }

    .nq-nav .nq-toggler:focus {
        box-shadow: none;
    }

    /* RESPONSIVE */
    @media (max-width: 1199.98px) {
        .nq-nav .nq-bar {
            padding: 12px 24px;
        }

        .nq-nav .nq-collapse {
            flex-basis: 100%;
        }

        .nq-nav .nq-menu {
            width: 100%;
            margin: 8px 0 0;
            align-items: stretch;
        }

        .nq-nav .nq-kanan {
            width: 100%;
            padding-bottom: 6px;
        }

        .nq-nav .nq-menu .nav-link {
            padding: 10px 12px;
        }
    }

    @media (max-width: 575.98px) {
        .nq-nav .nq-bar {
            padding: 12px 16px;
        }

        .nq-nav .nq-kanan {
            gap: 8px;
        }

        .nq-nav .nq-profil {
            padding: 9px 12px;
            font-size: 13px;
        }
    }
</style>
