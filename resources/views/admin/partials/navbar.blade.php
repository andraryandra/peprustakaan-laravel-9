<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>

    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-text">
                    <i data-feather="search"></i>
                </div>
                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
        </form>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::check() && Auth::user()->photo)
                        <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="User Photo"
                            class="wd-30 ht-30 rounded-circle img-thumbnail mx-auto d-block">
                    @else
                        <img src="{{ asset('assets/admin/images/profile.png') }}" alt="Default Photo"
                            class="wd-30 ht-30 rounded-circle img-thumbnail mx-auto d-block">
                    @endif
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            @if (Auth::check() && Auth::user()->photo)
                                <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="User Photo"
                                    class="wd-30 ht-30 rounded-circle img-thumbnail mx-auto d-block">
                            @else
                                <img src="{{ asset('assets/admin/images/profile.png') }}" alt="Default Photo"
                                    class="wd-30 ht-30 rounded-circle img-thumbnail mx-auto d-block">
                            @endif
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                            <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{ url('/admin/pengaturan/profile') }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="user"></i>
                                <span>Profile</span>
                            </a>
                        </li>


                        <li class="dropdown-item py-2">
                            <a href="{{ url('/admin/pengaturan/ubahpassword') }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="lock"></i>
                                <span>Ubah Password</span>
                            </a>
                        </li>

                        <li class="dropdown-item py-2">
                            <a href="/logout" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
