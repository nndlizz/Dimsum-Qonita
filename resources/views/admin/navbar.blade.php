
<header class="navbar-custom navbar-modern">

    {{-- KIRI: BRAND / TITLE --}}
    <div class="navbar-brand-admin">
        <div class="brand-icon">
            <i class="bi bi-grid-1x2-fill"></i>
        </div>
        <div class="brand-text">
            <span class="brand-title">Admin Panel</span>
            <small>Dimsum Qonita</small>
        </div>
    </div>

    {{-- KANAN: PROFILE --}}
    @php
        $adminNavbar = null;

        if (session()->has('admin_id')) {
            $adminNavbar = \Illuminate\Support\Facades\DB::table('admin')
                ->where('id_admin', session('admin_id'))
                ->first();
        }

        $namaAdmin = $adminNavbar->nama_admin
            ?? session('admin_name', 'Administrator');

        $fotoAdmin = $adminNavbar && $adminNavbar->gambar
            ? asset('storage/' . $adminNavbar->gambar)
            : asset('template_admin/assets/images/avatar.png');
    @endphp

    <div class="navbar-actions right d-flex align-items-center">

        {{-- LABEL ADMIN --}}
        <div class="admin-role me-3 d-none d-sm-flex">
            <i class="bi bi-shield-check"></i>
            <span>Administrator</span>
        </div>

        {{-- PROFILE DROPDOWN --}}
        <div class="dropdown">
            <button
                class="navbar-profile-btn"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                id="profile-dropdown"
            >
                <img src="{{ $fotoAdmin }}"
                     alt="Foto Profil Admin"
                     class="navbar-profile-img">

                <div class="profile-info d-none d-md-flex">
                    <span class="profile-name">{{ $namaAdmin }}</span>
                    <small>Administrator</small>
                </div>

                <i class="bi bi-chevron-down profile-caret"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile">

                {{-- HEADER PROFILE --}}
                <li class="profile-dropdown-header">
                    <img src="{{ $fotoAdmin }}" alt="Foto Admin">

                    <div>
                        <strong>{{ $namaAdmin }}</strong>
                        <small>Administrator</small>
                        <span class="profile-status">
                            <span></span> Aktif
                        </span>
                    </div>
                </li>

                <li><hr class="dropdown-divider"></li>

                {{-- PROFIL --}}
                <li>
                    <a class="dropdown-item profile-item"
                       href="{{ route('admin.profil') }}">
                        <i class="bi bi-person-circle"></i>
                        <span>Profil Saya</span>
                        <i class="bi bi-chevron-right ms-auto item-arrow"></i>
                    </a>
                </li>

                {{-- LOGOUT --}}
                <li>
                    <form id="logout-form"
                          action="{{ route('logout') }}"
                          method="POST">
                        @csrf

                        <button type="button"
                                class="dropdown-item profile-item logout-item"
                                onclick="confirmLogout()">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<style>
    /* NAVBAR */
    .navbar-modern {
        background: #fff;
        min-height: 78px;
        padding: 0 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eef0f4;
        box-shadow: 0 3px 15px rgba(30, 35, 90, .04);
        position: relative;
        z-index: 100;
    }

    /* BRAND */
    .navbar-brand-admin {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .brand-icon {
        width: 43px;
        height: 43px;
        border-radius: 12px;
        background: #435ebe;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 4px 10px rgba(67, 94, 190, .2);
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.3;
    }

    .brand-title {
        font-size: 16px;
        font-weight: 700;
        color: #25396f;
    }

    .brand-text small {
        color: #8a92a6;
        font-size: 12px;
    }

    /* ADMIN ROLE */
    .admin-role {
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        background: #f4f6ff;
        color: #435ebe;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    /* PROFILE BUTTON */
    .navbar-profile-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 7px 10px;
        border: 1px solid transparent;
        border-radius: 12px;
        background: transparent;
        transition: .2s;
    }

    .navbar-profile-btn:hover,
    .navbar-profile-btn[aria-expanded="true"] {
        background: #f7f8fc;
        border-color: #edf0f7;
    }

    .navbar-profile-img {
        width: 43px;
        height: 43px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #e8ecfa;
    }

    .profile-info {
        flex-direction: column;
        align-items: flex-start;
        line-height: 1.3;
    }

    .profile-name {
        font-size: 13px;
        font-weight: 700;
        color: #25396f;
    }

    .profile-info small {
        color: #98a0b5;
        font-size: 11px;
    }

    .profile-caret {
        font-size: 12px;
        color: #8a92a6;
        margin-left: 3px;
    }

    /* DROPDOWN */
    .dropdown-menu-profile {
        width: 255px;
        padding: 10px;
        margin-top: 12px !important;
        border: 1px solid #edf0f5;
        border-radius: 14px;
        box-shadow: 0 12px 35px rgba(30, 35, 90, .12);
    }

    .profile-dropdown-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 8px;
    }

    .profile-dropdown-header img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e8ecfa;
    }

    .profile-dropdown-header div {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .profile-dropdown-header strong {
        font-size: 13px;
        color: #25396f;
    }

    .profile-dropdown-header small {
        color: #8a92a6;
        font-size: 11px;
    }

    .profile-status {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        color: #198754;
    }

    .profile-status span {
        width: 6px;
        height: 6px;
        background: #198754;
        border-radius: 50%;
    }

    .profile-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 12px;
        border-radius: 9px;
        font-size: 13px;
        color: #5a6278;
        transition: .2s;
    }

    .profile-item > i:first-child {
        font-size: 17px;
        width: 20px;
    }

    .profile-item:hover {
        background: #f4f6ff;
        color: #435ebe;
    }

    .item-arrow {
        font-size: 11px !important;
        opacity: .5;
    }

    .logout-item {
        color: #dc3545;
        width: 100%;
        text-align: left;
        border: none;
        background: transparent;
    }

    .logout-item:hover {
        background: #fff1f2;
        color: #dc3545;
    }

    @media (max-width: 576px) {
        .navbar-modern {
            padding: 0 14px;
            min-height: 68px;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
        }

        .brand-title {
            font-size: 14px;
        }

        .brand-text small {
            font-size: 10px;
        }

        .navbar-profile-img {
            width: 38px;
            height: 38px;
        }
    }
</style>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin ingin logout?',
            text: 'Kamu harus login kembali untuk mengakses halaman admin.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            borderRadius: '14px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>