<div class="nk-sidebar nk-sidebar-fixed is-dark" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="#" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('assets/images/logo-dl-light.png') }}" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('assets/images/logo-dl-dark.png') }}" alt="logo-dark">
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Dashboard</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('dashboard') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('books.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-book"></em></span>
                            <span class="nk-menu-text">Buku Saya</span>
                        </a>
                    </li>
                    @can('admin-access')
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Admin</h6>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route('books.all') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-book"></em></span>
                                <span class="nk-menu-text">Semua Buku</span>
                            </a>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route('categories.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-folders"></em></span>
                                <span class="nk-menu-text">Kategori</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
    </div>
</div>
