<header class="header-style-1">
    <div class="header-navbar navbar-sticky">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="site-logo">
                    <a href="index.html">
                        <img src="/../../assets/user/images/logo.png" alt="" class="img-fluid" />
                    </a>
                </div>

                <div class="offcanvas-icon d-block d-lg-none">
                    <a href="#" class="nav-toggler"><i class="fal fa-bars"></i></a>
                </div>

                <nav class="site-navbar ms-auto">

                    <ul class="primary-menu">
                        <li class="current">
                            <a href="/landingpage">Home</a>
                        </li>
                        <li><a href="{{ url('/user/anggota/tampilan/about') }}">About</a></li>

                        <li>
                            <a href="{{ url('/user/anggota/tampilan/mading') }}">Mading</a>
                        </li>

                        <li>
                            <a href="{{ url('/user/anggota/tampilan/ebook') }}">Ebook</a>
                        </li>

                        <li>
                            <a href="{{ url('/user/anggota/tampilan/artikel') }}">Artikel</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <li><a class="dropdown-item" href="{{ url('/user/anggota/tampilan/riwayat') }}">Riwayat Ebook</a></li>
                              <li><a class="dropdown-item" href="/user/pemesanan/history/on_progress">Riwayat Download</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li>
                                <a class="dropdown-item" href="/logout" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                              </li>
                            </ul>
                        </li>
                    </ul>

                    <a href="#" class="nav-close"><i class="fal fa-times"></i></a>
                </nav>
            </div>
        </div>
    </div>
</header>
