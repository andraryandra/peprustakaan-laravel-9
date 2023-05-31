<div class="main-wrapper">
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="" class="sidebar-brand">
                <img src="{{ asset('assets/admin/images/logo.png') }}" alt="logo" width="150">
            </a>
            <div class="sidebar-toggler not-active">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        @if (Auth::user()->level == 'petugas' || Auth::user()->level == '0')
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item nav-category">Main</li>
                    <li class="nav-item {{ Request::routeIs('dashboard.index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">
                        Menu
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button"
                            aria-expanded="false" aria-controls="emails">
                            <i class="link-icon" data-feather="home">
                            </i>
                            <span class="link-title">
                                Landing Page
                            </span>
                            <i class="link-arrow" data-feather="chevron-down">
                            </i>
                        </a>
                        <div class="collapse" id="emails">
                            <ul class="nav sub-menu">
                                <li class="nav-item {{ Request::routeIs('home.index') ? 'active' : '' }}">
                                    <a href="{{ route('home.index') }}"
                                        class="nav-link {{ Request::routeIs('home.index') ? 'active' : '' }}">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('about.index') ? 'active' : '' }}">
                                    <a href="{{ route('about.index') }}"
                                        class="nav-link {{ Request::routeIs('about.index') ? 'active' : '' }}">
                                        About
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('footer.index') ? 'active' : '' }}">
                                    <a href="{{ route('footer.index') }}"
                                        class="nav-link {{ Request::routeIs('footer.index') ? 'active' : '' }}">
                                        Footer
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ebooks" role="button"
                            aria-expanded="false" aria-controls="ebooks">
                            <i class="link-icon" data-feather="book">
                            </i>
                            <span class="link-title">
                                Ebook
                            </span>
                            <i class="link-arrow" data-feather="chevron-down">
                            </i>
                        </a>
                        <div class="collapse" id="ebooks">
                            <ul class="nav sub-menu">
                                <li class="nav-item {{ Request::routeIs('categori.index') ? 'active' : '' }}">
                                    <a href="{{ route('categori.index') }}"
                                        class="nav-link {{ Request::routeIs('categori.index') ? 'active' : '' }}">
                                        Kategori
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('sub-kategori.index') ? 'active' : '' }}">
                                    <a href="{{ route('sub-kategori.index') }}"
                                        class="nav-link {{ Request::routeIs('sub-kategori.index') ? 'active' : '' }}">
                                        Sub Kategori
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('buku.index') ? 'active' : '' }}">
                                    <a href="{{ route('buku.index') }}"
                                        class="nav-link {{ Request::routeIs('buku.index') ? 'active' : '' }}">
                                        Buku
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item {{ Request::routeIs('madjing.index') ? 'active' : '' }}">
                        <a href="{{ route('madjing.index') }}"
                            class="nav-link {{ Request::routeIs('madjing.index') ? 'active' : '' }}">
                            <i class="link-icon" data-feather="image"></i>
                            <span class="link-title">Mading</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#verifikasi" role="button"
                            aria-expanded="false" aria-controls="verifikasi">
                            <i class="link-icon" data-feather="check-circle">
                            </i>
                            <span class="link-title">
                                Verifikasi
                            </span>
                            <i class="link-arrow" data-feather="chevron-down">
                            </i>
                        </a>
                        <div class="collapse" id="verifikasi">
                            <ul class="nav sub-menu">
                                <li class="nav-item {{ Request::routeIs('verifikasiEbook.index') ? 'active' : '' }}">
                                    <a href="{{ route('verifikasiEbook.index') }}"
                                        class="nav-link {{ Request::routeIs('verifikasiEbook.index') ? 'active' : '' }}">
                                        Buku
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('verifikasiMading.index') ? 'active' : '' }}">
                                    <a href="{{ route('verifikasiMading.index') }}"
                                        class="nav-link {{ Request::routeIs('verifikasiMading.index') ? 'active' : '' }}">
                                        Mading
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#folders" role="button"
                            aria-expanded="false" aria-controls="folders">
                            <i class="link-icon" data-feather="folder">
                            </i>
                            <span class="link-title">
                                Laporan
                            </span>
                            <i class="link-arrow" data-feather="chevron-down">
                            </i>
                        </a>
                        <div class="collapse" id="folders">
                            <ul class="nav sub-menu">
                                <li class="nav-item {{ Request::routeIs('data-user.index') ? 'active' : '' }}">
                                    <a href="{{ route('data-user.index') }}"
                                        class="nav-link {{ Request::routeIs('data-user.index') ? 'active' : '' }}">
                                        Data Anggota
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('data-ebook.index') ? 'active' : '' }}">
                                    <a href="{{ route('data-ebook.index') }}"
                                        class="nav-link {{ Request::routeIs('data-ebook.index') ? 'active' : '' }}">
                                        Data Ebook
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('data-mading.index') ? 'active' : '' }}">
                                    <a href="{{ route('data-mading.index') }}"
                                        class="nav-link {{ Request::routeIs('data-mading.index') ? 'active' : '' }}">
                                        Data Mading
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item nav-category">Master</li>
                    <li class="nav-item {{ Request::routeIs('petugas.index') ? 'active' : '' }}">
                        <a href="{{ route('petugas.index') }}"
                            class="nav-link {{ Request::routeIs('petugas.index') ? 'active' : '' }}">
                            <i class="link-icon" data-feather="user-plus"></i>
                            <span class="link-title">Petugas</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::routeIs('anggota.index') ? 'active' : '' }}">
                        <a href="{{ route('anggota.index') }}"
                            class="nav-link {{ Request::routeIs('anggota.index') ? 'active' : '' }}">
                            <i class="link-icon" data-feather="users"></i>
                            <span class="link-title">Anggota</span>
                        </a>
                    </li>
                </ul>
            </div>
        @elseif (Auth::user()->level == 'anggota' || Auth::user()->level == '1')
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item nav-category">Main</li>
                    <li class="nav-item {{ Request::routeIs('dashboard.anggota.home') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.anggota.home') }}"
                            class="nav-link {{ Request::routeIs('dashboard.anggota.home') ? 'active' : '' }}">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">
                        Menu
                    </li>
                    <li class="nav-item {{ Request::routeIs('anggota-mading.index') ? 'active' : '' }}">
                        <a href="{{ route('anggota-mading.index') }}"
                            class="nav-link {{ Request::routeIs('anggota-mading.index') ? 'active' : '' }}">
                            <i class="link-icon" data-feather="image"></i>
                            <span class="link-title">Mading</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('anggota-ebook.index') ? 'active' : '' }}">
                        <a href="{{ route('anggota-ebook.index') }}"
                            class="nav-link {{ Request::routeIs('anggota-ebook.index') ? 'active' : '' }}">
                            <i class="link-icon" data-feather="file"></i>
                            <span class="link-title">Ebook</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif


    </nav>

    <nav class="settings-sidebar">
        <div class="sidebar-body">
            <a href="#" class="settings-sidebar-toggler">
                <i data-feather="settings"></i>
            </a>
            <h6 class="text-muted mb-2">Sidebar:</h6>
            <div class="mb-3 pb-3 border-bottom">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                        value="sidebar-light" checked>
                    <label class="form-check-label" for="sidebarLight">
                        Light
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                        value="sidebar-dark">
                    <label class="form-check-label" for="sidebarDark">
                        Dark
                    </label>
                </div>
            </div>
        </div>
    </nav>
</div>
