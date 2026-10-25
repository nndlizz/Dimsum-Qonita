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
                        <li class="sidebar-menu-item">
                            <a
                                href="{{ url('/admin/dashboard')}}"
                                class="sidebar-menu-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}"
                                id="menu-overview"
                                title="Overview"
                            >
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a
                                href="{{ url('/admin/tables') }}"
                                class="sidebar-menu-link {{ request()->is('admin/tables*') ? 'active' : '' }}"
                                id="menu-basictables"
                                title="Basic Tables"
                            >
                                <i class="bi bi-table"></i>
                                <span>Basic Tables</span>
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
                        <li class="sidebar-menu-item">
                            <a href="{{ route('admin.akun.index') }}" class="sidebar-menu-link {{ request()->is('admin/akun*') ? 'active' : '' }}">
                                <i class="bi bi-person-lines-fill"></i> 
                                <span>Daftar Akun</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a
                                href="{{ url('/admin/forms&input') }}"
                                class="sidebar-menu-link {{ request()->is('admin/forms&input*') ? 'active' : '' }}"
                                id="menu-forms-input"
                                title="Forms and Input"
                            >
                                <i class="bi bi-input-cursor-text"></i>
                                <span>Forms & Input</span>
                            </a>
                        </li>
                         <li class="sidebar-menu-item">
                            <a
                                href="{{ url('/admin/blankpage') }}"
                                class="sidebar-menu-link {{ request()->is('admin/blankpage*') ? 'active' : '' }}"
                                id="menu-blankpage"
                                title="Blank Page"
                            >
                                <i class="bi bi-file-earmark"></i>
                                <span>Blank Page</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a
                                href="{{ url('/admin/login') }}"
                                class="sidebar-menu-link {{ request()->is('admin/login*') ? 'active' : '' }}"
                                id="menu-loginpage"
                                title="Login Page"
                            >
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Login Screen</span>
                            </a>
                        </li>
                    </ul>
                </div>

               
            </div>           
        </div>