
<header class="navbar-custom">
    <div class="navbar-left">
        <!-- Desktop sidebar toggle -->
        <button
            class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
            id="desktop-sidebar-toggle"
            aria-label="Minimize Sidebar"
        >
            <i class="bi bi-chevron-bar-left"></i>
        </button>

        <!-- Mobile sidebar toggle -->
        <button
            class="sidebar-toggle-btn me-2"
            id="sidebar-toggle"
            aria-label="Toggle Navigation"
        >
            <i class="bi bi-list"></i>
        </button>

        <!-- Quick Actions -->
        <div class="dropdown ms-2">
            <button
                class="btn-quick-action dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                id="quick-actions-dropdown"
            >
                <i class="bi bi-plus-lg"></i>
                <span>Create</span>
            </button>

            <ul class="dropdown-menu dropdown-menu-quick-action"
                aria-labelledby="quick-actions-dropdown">
                <li class="dropdown-header">Quick Action Shortcuts</li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-file-earmark-plus"></i> New Invoice
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person-plus"></i> New User
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-box-seam"></i> New Product
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-gear"></i> System Settings
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Search -->
    <div class="navbar-search-wrapper">
        <input
            type="text"
            class="navbar-search-input"
            placeholder="Search anything in Spark..."
            id="main-search"
        />
        <button class="navbar-search-btn" aria-label="Search">
            <i class="bi bi-search"></i>
        </button>
    </div>

    <!-- Right Actions -->
    <div class="navbar-actions">
        <!-- Fullscreen -->
        <button
            class="navbar-action-btn me-1"
            aria-label="Toggle Fullscreen"
            id="btn-fullscreen"
            type="button"
        >
            <i class="bi bi-arrows-fullscreen"></i>
        </button>

        <!-- Notifications -->
        <div class="dropdown">
            <button
                class="navbar-action-btn dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                id="btn-notifications"
                data-bs-auto-close="outside"
            >
                <i class="bi bi-bell"></i>
                <span class="navbar-action-badge"></span>
            </button>

            <div
                class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0"
                aria-labelledby="btn-notifications"
            >
                <div class="notification-header">
                    <h6 class="notification-title">Notifications</h6>
                    <button class="btn-clear-all" type="button">
                        Mark all read
                    </button>
                </div>

                <div class="notification-list">
                    <a href="#" class="notification-item">
                        <div class="notification-icon bg-success text-white">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <div class="notification-content">
                            <p class="notification-text">
                                New sale received: <strong>$150.00</strong>
                            </p>
                            <span class="notification-time">2 mins ago</span>
                        </div>
                        <span class="notification-unread-dot"></span>
                    </a>

                    <a href="#" class="notification-item">
                        <div class="notification-icon bg-primary text-white">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <div class="notification-content">
                            <p class="notification-text">
                                New user registered: <strong>John Doe</strong>
                            </p>
                            <span class="notification-time">1 hour ago</span>
                        </div>
                        <span class="notification-unread-dot"></span>
                    </a>

                    <a href="#" class="notification-item">
                        <div class="notification-icon bg-warning text-dark">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <div class="notification-content">
                            <p class="notification-text">
                                Stock running low: <strong>Hoodie</strong>
                            </p>
                            <span class="notification-time">3 hours ago</span>
                        </div>
                    </a>
                </div>

                <a href="#" class="notification-footer">
                    View All Notifications
                </a>
            </div>
        </div>

        <!-- Profile Dropdown -->
        @php
            $adminNavbar = null;

            if (session()->has('admin_id')) {
                $adminNavbar = \Illuminate\Support\Facades\DB::table('admin')
                    ->where('id_admin', session('admin_id'))
                    ->first();
            }
        @endphp

        <div class="dropdown ms-2">
            <button
                class="navbar-profile-btn dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                id="profile-dropdown"
            >
                <img
                    src="{{ $adminNavbar && $adminNavbar->gambar
                        ? asset('storage/' . $adminNavbar->gambar)
                        : asset('template_admin/assets/images/avatar.png') }}"
                    alt="Foto Profil Admin"
                    class="navbar-profile-img"
                />

                <span class="navbar-profile-name d-none d-md-inline">
                    {{ $adminNavbar->nama_admin ?? session('admin_name', 'Administrator') }}
                </span>

                <i class="bi bi-chevron-down navbar-profile-caret"></i>
            </button>

            <ul
                class="dropdown-menu dropdown-menu-end dropdown-menu-profile"
                aria-labelledby="profile-dropdown"
            >
                <li class="dropdown-header">
                    Welcome, {{ $adminNavbar->nama_admin ?? session('admin_name', 'Administrator') }}!
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('admin.profil') }}">
                        <i class="bi bi-person"></i> Profil Saya
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-lock"></i> Lock Screen
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form
                        id="logout-form"
                        action="{{ route('admin.logout') }}"
                        method="POST"
                    >
                        @csrf
                        <button
                            type="button"
                            class="dropdown-item text-danger"
                            style="width: 100%; text-align: left;"
                            onclick="confirmLogout()"
                        >
                            <i class="bi bi-box-arrow-right"></i>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin ingin logout?',
            text: 'Kamu harus login kembali untuk mengakses halaman admin.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
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
