<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header border-end">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <b class="logo-icon">
                    <img src="{{ asset('assets/images/logos/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                    <img src="{{ asset('assets/images/logos/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                </b>
                <span class="logo-text">
                    <img src="{{ asset('assets/images/logos/logo.png') }}" alt="homepage" class="dark-logo" />
                    <img src="{{ asset('assets/images/logos/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                </span>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                        data-sidebartype="mini-sidebar"><i class="mdi mdi-menu fs-5"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('assets/images/users/1.jpg') }}"
                            alt="user" class="rounded-circle" width="36">
                        <span class="ms-2 font-weight-medium">{{ Auth::user()->prenom }}</span>
                        <span class="fas fa-angle-down ms-2"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                            <div class="">
                                <img src="{{ asset('assets/images/users/1.jpg') }}"
                                    alt="user" class="rounded-circle" width="60">
                            </div>
                            <div class="ms-2">
                                <h4 class="mb-0 text-white">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h4>
                                <p class="mb-0">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i data-feather="user" class="feather-sm text-info me-1 ms-1"></i> Mon Profil
                        </a>  
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i> Déconnexion
                            </button>
                        </form>
                        <div class="dropdown-divider"></div>
                        <div class="ps-4 p-2">
                            <a href="{{ route('profile.show') }}" class="btn d-block w-100 btn-info rounded-pill">Voir Profil</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
