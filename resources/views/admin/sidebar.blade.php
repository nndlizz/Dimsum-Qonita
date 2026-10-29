<div class="sidebar-wrapper" id="sidebar">
            <!-- Brand Logo / Identity -->
            <a href="index.html" class="sidebar-brand">
                <i class="bi bi-asterisk"></i>
                <span>Dimsum Qonita - Admin</span>
            </a>

            <!-- Navigation Menu -->
            <div class="flex-grow-1 overflow-y-auto">
                <!-- Group: Menu -->
                <div class="sidebar-menu-section">
                    <div class="sidebar-menu-title">Menu</div>
                    <ul class="sidebar-menu-list">
      <ul class="sidebar-menu-list">
            <li class="sidebar-menu-item">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="sidebar-menu-link {{ request()->is('admin') ? 'active' : '' }}"
                    id="menu-overview"
                    title="Dashboard"
                >
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
</ul>
                        <li class="sidebar-menu-item">
                            <a href="{{ route('admin.akun.index') }}" class="sidebar-menu-link {{ request()->is('admin/akun*') ? 'active' : '' }}">
                                <i class="bi bi-person-lines-fill"></i> 
                                <span>Daftar Akun</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a href="{{ route('admin.akun.index') }}" class="sidebar-menu-link {{ request()->is('admin/akun*') ? 'active' : '' }}">
                                <i class="bi bi-person-lines-fill"></i> 
                                <span>Daftar Akun</span>
                            <a
                                href="{{ route('admin.kategori.index') }}"
                                class="sidebar-menu-link {{ request()->is('admin/kategori*') ? 'active' : '' }}"
                                id="menu-kelola-kategori"
                                title="Kelola Kategori"
                            >
                                <i class="bi bi-tags"></i>
                                <span>Kelola Kategori</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a
                                href="{{ route('admin.kategori.index') }}"
                                class="sidebar-menu-link {{ request()->is('admin/kategori*') ? 'active' : '' }}"
                                id="menu-kelola-kategori"
                                title="Kelola Kategori"
                            >
                                <i class="bi bi-tags"></i>
                                <span>Kelola Kategori</span>
                                href="{{ route('admin.cabang.index') }}"
                                class="sidebar-menu-link {{ request()->is('admin/cabang*') ? 'active' : '' }}"
                                id="menu-kelola-cabang"
                                title="Kelola Cabang"
                            >
                                <i class="bi bi-shop"></i>
                                <span>Kelola Cabang</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a
                                href="{{ route('admin.cabang.index') }}"
                                class="sidebar-menu-link {{ request()->is('admin/cabang*') ? 'active' : '' }}"
                                id="menu-kelola-cabang"
                                title="Kelola Cabang"
                            >
                                <i class="bi bi-shop"></i>
                                <span>Kelola Cabang</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a
                                href="{{ route('admin.produk.index') }}"
                                class="sidebar-menu-link {{ request()->is('admin/produk/tambah') ? 'active' : '' }}"
                                id="menu-tambah-produk"
                                title="Tambah Produk"
                            >
                                href="{{ route('admin.produk.index') }}"
                                class="sidebar-menu-link {{ request()->is('admin/produk/tambah') ? 'active' : '' }}"
                                id="menu-tambah-produk"
                                title="Tambah Produk"
                            >
                                <i class="bi bi-plus-square"></i>
                                <span>Kelola Produk</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a
                                href="{{ url('/admin/kelolasponsor') }}"
                                class="sidebar-menu-link {{ request()->is('admin/kelolasponsor') ? 'active' : '' }}"
                                id="menu-kelola-sponsor"
                                title="Kelola Sponsor"
                            >
                                <i class="bi bi-file-earmark-bar-graph"></i>
                                <span>Kelola Sponsor</span>
                            </a>
                        </li>
                        
                        {{-- Tombol Logout --}}
                        <!-- <div class="mt-auto pt-3">
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="sidebar-menu-link w-100 border-0 text-start"
                                    style="background: transparent; color: white;">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div> -->

                    </ul>
                </div>              
            </div>           
        </div>