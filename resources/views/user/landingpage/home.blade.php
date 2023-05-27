@extends('layouts_user.ebook_main')

@section('landingPageHome')
    {{-- <section class="banner-style-4 banner-padding">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-12 col-xl-6 col-lg-6">
                <div class="banner-content ">
                    <span class="subheading"></span>
                    <h1>Selamat Datang Di Perpustakaan SMK Negeri 2 Indramayu</h1>
                    <p class="mb-40">Aplikasi L-Ebook menyediakan berbagai buku fiksi dan non - fiksi populer</p>

                    <div class="btn-container">
                        <a href="/login" class="btn btn-white rounded ms-2">Dapatkan Disini</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-6 col-lg-6">
                <div class="banner-img-round mt-5 mt-lg-0 ps-5">
                    <img src="assets/user/images/banner/illustration.png" alt="" class="img-fluid">
                </div>
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</section> --}}
    <section class="banner banner-style-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 col-xl-6 col-lg-6">
                    <div class="banner-content">
                        @forelse ($home as $item)
                            <h1>{{ $item->teks1 }}</h1>
                            <p>{{ $item->teks2 }}</p>
                        @empty
                            <h1>Selamat Datang Di Perpustakaan SMK Negeri 2 Indramayu</h1>
                            <p>Aplikasi L-Ebook menyediakan berbagai buku fiksi dan non - fiksi populer</p>
                        @endforelse

                        <div class="btn-container">
                            <a href="{{ route('landingPage.ebook') }}" class="btn btn-white rounded ms-2">Dapatkan Disini</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xl-6 col-lg-6">
                    <div class="banner-img-round mt-5 mt-lg-0">
                        @forelse ($home as $item)
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->id }}"
                                class="img-fluid rounded shadow-lg">
                        @empty
                            <img src="assets/user/images/banner/banner_img.png" alt="" class="img-fluid">
                        @endforelse
                    </div>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    <section class="section-padding">
        <div class="container-fluid container-grid">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="heading mb-30 text-center">
                        <span class="subheading">Semua Kategori Buku</span>
                        <h2>Telusuri Kursus Menurut Kategori</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2 mb-20">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon1.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Ensiklopedia</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon6.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Web Development</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon3.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Kesenian dan Olahraga</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon2.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Ilmu Terapan</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2 ">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon3.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Kesusastraan</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon6.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Sejarah dan Geografi</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon1.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Ilmu Sosial</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon1.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Ilmu Murni</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon1.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Bahasa</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon6.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Karya Umum</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon6.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Filsafat</a>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="single-course-category style-2 ">
                        <div class="course-cat-icon">
                            <img src="assets/user/images/icon/icon3.png" alt="" class="img-fluid">
                        </div>
                        <div class="course-cat-content">
                            <h4 class="course-cat-title">
                                <a href="#">Novel</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding page">
        <div class="course-top-wrap">
            <div class="container">
                <div class="row mb-10 justify-content-center">
                    <div class="col-xl-8">
                        <div class="section-heading text-center">
                            <h2 class="font-lg">Mading</h2>
                            <p>Ayo baca mading dan temukan berita menarik hari ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                @php
                    $activeMadingCount = 0;
                @endphp

                @forelse ($data_mading as $item)
                    @php
                        $activeMadingItems = $item->mading_items->where('verifikasi_mading', 'ACTIVE')->take(4);
                    @endphp

                    @if ($activeMadingItems->count() > 0)
                        @php
                            $activeMadingCount++;
                        @endphp

                        @foreach ($activeMadingItems as $item2)
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="course-grid course-style-3">
                                    <div class="course-header">
                                        <div class="course-thumb">
                                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->id }}"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="course-content">
                                        <h3 class="course-title mb-20">
                                            <a href="#">
                                                {{ $item->judul }}
                                            </a>
                                        </h3>
                                        <div class="course-meta-info">
                                            <div class="d-flex align-items-center">
                                                <div class="author me-3">
                                                    <i class="far fa-user-alt me-2"></i>
                                                    By <a href="#">{{ $item->user->name }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="course-footer mt-20 d-flex align-items-center justify-content-between">
                                            <div class="course-name"></div>

                                            <a href="{{ route('landingPage.showMading', $item->id) }}"
                                                class="btn btn-main-outline btn-radius btn-sm">Selanjutnya <i
                                                    class="fa fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if ($activeMadingCount >= 4)
                    @break
                @endif
            @empty
                @if ($activeMadingCount === 0)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="course-grid course-style-3">
                            <div class="course-header">
                                <div class="course-thumb">
                                    <img src="assets/user/images/mading/madinglari.jpg" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="course-content">
                                <h3 class="course-title mb-20"> <a href="">Data Competitive Strategy law &
                                        Organization </a> </h3>

                                <div class="course-meta-info">
                                    <div class="d-flex align-items-center">
                                        <div class="author me-3">
                                            <i class="far fa-user-alt me-2"></i>
                                            By <a href="#">Josephin</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="course-footer mt-20 d-flex align-items-center justify-content-between">
                                    <div class="course-name"></div>
                                    <a href="" class="btn btn-main-outline btn-radius btn-sm">Selanjutnya <i
                                            class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforelse
        </div>
    </div>

    <!-- COURSE END -->

    </div>
    </div>
    <!--course-->
</section>
@endsection
