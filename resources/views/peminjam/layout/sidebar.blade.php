<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ request()->routeIs('peminjam.index') ? 'active' : '' }}" href="{{ route('peminjam.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link {{ request()->routeIs('peminjam.alat.*') ? 'active' : '' }}" href="{{ route('peminjam.alat.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-toolbox"></i></div>
                    Daftar Alat
                </a>
                <a class="nav-link {{ request()->routeIs('peminjam.peminjaman.*') ? 'active' : '' }}"
                    href="{{ route('peminjam.peminjaman.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    Peminjaman
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>