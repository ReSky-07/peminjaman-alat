<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}"
                    href="{{ route('admin.user.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    User
                </a>
                <a class="nav-link {{ request()->routeIs('admin.alat.*') ? 'active' : '' }}"
                    href="{{ route('admin.alat.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    Alat
                </a>
                <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}"
                    href="{{ route('admin.kategori.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                    Kategori
                </a>
                <a class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}"
                    href="{{ route('admin.peminjaman.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                    Peminjaman
                </a>
                <a class="nav-link" href="{{ route('admin.activity.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    Log Aktivitas
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name }}
        </div>
    </nav>
</div>