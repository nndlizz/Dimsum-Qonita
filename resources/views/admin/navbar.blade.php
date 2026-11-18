
<header class="navbar-custom navbar-modern">

    @php
        $adminNavbar = null;

        if (session()->has('admin_id')) {
            $adminNavbar = \Illuminate\Support\Facades\DB::table('admin')
                ->where('id_admin', session('admin_id'))
                ->first();
        }

        $namaNavbar = $adminNavbar->nama_admin
            ?? session('admin_name', 'Administrator');

        $fotoNavbar = ($adminNavbar && !empty($adminNavbar->gambar))
            ? asset('uploads/admin/' . $adminNavbar->gambar)
            : asset('template_admin/assets/images/avatar.png');
    @endphp

    {{-- SESSION ADMIN DI KANAN --}}
    <div class="dropdown navbar-admin-dropdown">

        <button class="navbar-profile-btn"
                type="button"
                id="profile-dropdown"
                data-bs-toggle="dropdown"
                data-bs-auto-close="true"
                aria-expanded="false">

            <img src="{{ $fotoNavbar }}"
                 alt="Foto Profil Admin"
                 class="navbar-profile-img">

            <div class="profile-info d-none d-md-flex">
                <span class="profile-name">{{ $namaNavbar }}</span>
                <small>Administrator</small>
            </div>

            <i class="bi bi-chevron-down profile-caret"></i>
        </button>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile">

            <li class="profile-dropdown-header">
                <img src="{{ $fotoNavbar }}" alt="Foto Admin">

                <div>
                    <strong>{{ $namaNavbar }}</strong>
                    <small>Administrator</small>
                </div>
            </li>

            <li><hr class="dropdown-divider"></li>

            {{-- PROFIL --}}
            <li>
                <a class="dropdown-item profile-item"
                   href="{{ route('admin.profil') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil Saya</span>
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
</header>

<style>
    
/* NAVBAR */
header.navbar-custom.navbar-modern {
    position: sticky;
    top: 0;
    z-index: 1050;

    /* Full area dashboard */
    width: auto;
    max-width: none;
    flex-shrink: 0;
    box-sizing: border-box;

    /* Mengimbangi padding main-wrapper */
    margin-top: -2rem;
    margin-left: -2.5rem;
    margin-right: -2.5rem;
    margin-bottom: 2rem;

    height: 70px;
    padding: 0 28px;

    background: #fff;
    border-bottom: 1px solid #eef0f4;
    box-shadow: 0 3px 15px rgba(30,35,90,.04);

    display: flex;
    align-items: center;
    justify-content: flex-end;
    overflow: visible;
}

/* SESSION ADMIN */
.navbar-admin-dropdown {
    margin-left: auto !important;
    position: relative;
    z-index: 1060;
    flex-shrink: 0;
}

/* BUTTON PROFILE */
.navbar-profile-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 7px 10px;
    border: 1px solid transparent;
    border-radius: 12px;
    background: transparent;
    cursor: pointer;
    transition: .2s;
}

.navbar-profile-btn:hover,
.navbar-profile-btn[aria-expanded="true"] {
    background: #f7f8fc;
    border-color: #edf0f7;
}

/* FOTO */
.navbar-profile-img {
    width: 42px;
    height: 42px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #e8ecfa;
}

/* NAMA */
.profile-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    line-height: 1.3;
    text-align: left;
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
}

/* DROPDOWN */
.dropdown-menu-profile {
    width: 240px;
    padding: 10px;
    margin-top: 10px !important;
    border: 1px solid #edf0f5;
    border-radius: 14px;
    box-shadow: 0 12px 35px rgba(30,35,90,.12);
    z-index: 1070;
}

/* HEADER DROPDOWN */
.profile-dropdown-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 8px;
}

.profile-dropdown-header img {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e8ecfa;
}

.profile-dropdown-header div {
    display: flex;
    flex-direction: column;
    gap: 2px;
    min-width: 0;
}

.profile-dropdown-header strong {
    font-size: 13px;
    color: #25396f;
}

.profile-dropdown-header small {
    color: #8a92a6;
    font-size: 11px;
}

/* MENU */
.profile-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    border-radius: 9px;
    font-size: 13px;
    color: #5a6278;
    transition: .2s;
}

.profile-item i {
    font-size: 17px;
    width: 20px;
}

.profile-item:hover {
    background: #f4f6ff;
    color: #435ebe;
}

/* LOGOUT */
.logout-item {
    color: #dc3545;
    width: 100%;
    text-align: left;
    border: none;
    background: transparent;
    cursor: pointer;
}

.logout-item:hover {
    background: #fff1f2;
    color: #dc3545;
}

/* MOBILE */
@media (max-width: 576px) {
    .navbar-modern {
        padding: 0 14px;
        min-height: 62px;
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
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
