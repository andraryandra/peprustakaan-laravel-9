@extends('layouts_user.ebook_main')

@section('container')
    <section class="about-3 section-padding">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-5 col-lg-6">
                    <div class="about-img">
                        @forelse ($about as $item)
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->id }}"
                                class="img-fluid rounded shadow-sm">
                        @empty
                            <img src="assets/user/images/banner/img_9.png" alt="" class="img-fluid">
                        @endforelse
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content mt-3 mt-lg-0">
                        @forelse ($about as $item)
                            <div class="heading mb-50">
                                <h2 class="font-lg">{{ $item->teks1 }}</h2>
                            </div>
                            <p style="text-align: justify;">{{ $item->teks2 }}</p>
                        @empty
                            <div class="heading mb-50">
                                <h2 class="font-lg">Profil Perpustakaan</h2>
                            </div>
                            <p style="text-align: justify;">Perpustakaan didirikan sejak awal pembangunan Gedung SMKN 2
                                Indramayu . Setelah berpindah beberapa kali maka gedung kami yang terakhir adalah yang resmi
                                digunakan pada tahun 2017 bertempat di Pusat belajar. Pendidikan gedung baru ini diharapkan
                                mampu menambah minat baca warga sekolah.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="instructors section-padding-btm">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 pe-5">
                    <div class="about-features">
                        <div class="feature-text">
                            <h4>Visi :</h4>
                            <p>“ Terwujud Perpustakaan Sekolah sebagai media pengembangan minat baca dan kegemaran mambaca
                                serta pusat layanan informasi bagi Taruna/Taruni maupun warga sekolah”.</p>
                        </div>

                        <div class="feature-item feature-style-left">
                            <div class="feature-text">
                                <h4>Misi :</h4>
                                <p style="text-align: justify;"> 1. Memberikan pelayanan yang ramah, tegas, dan tertib</p>
                                <p style="text-align: justify;"> 2. Menyediakan berbagai koleksi bacaan untuk mengembangkan
                                    pengetahuan Taruna/Taruni</p>
                                <p style="text-align: justify;"> 3. Menjadi Perpustakaan sebagai jantung pendidikan</p>
                                <p style="text-align: justify;"> 4. Mengembangkan perpustakaan berbasis teknologi informasi
                                </p>
                                <p style="text-align: justify;"> 5. Meningkatkan minat baca (melalui mading perpustakaan,
                                    memberikan reward untuk taruna/taruni yang banyak berkunjung dan sering meminjam, reward
                                    untuk guru yang sering menggunakan perpustakaan)</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-xl-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="team-item team-item-2 mt-5">
                                <div class="team-img">
                                    <img src="assets/user/images/about/about-1.png" alt="" class="img-fluid">

                                    <ul class="team-socials list-inline">
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                                <div class="team-content">
                                    <div class="team-info">
                                        <h4>Ruangan Perpustakaan</h4>
                                        <p>SMK Negeri 2 Indramayu</p>
                                    </div>

                                    <div class="course-meta">
                                        <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                        <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                                    </div>
                                </div>
                            </div>

                            <div class="team-item team-item-2">
                                <div class="team-img">
                                    <img src="assets/user/images/about/about-2.jpg" alt="" class="img-fluid">
                                    <ul class="team-socials list-inline">
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                                <div class="team-content">
                                    <div class="team-info">
                                        <h4>Tempat Duduk</h4>
                                        <p>SMK Negeri 2 Indramayu</p>
                                    </div>
                                    <div class="course-meta">
                                        <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                        <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="team-item team-item-2">
                                <div class="team-img">
                                    <img src="assets/user/images/about/about-3.png" alt="" class="img-fluid">

                                    <ul class="team-socials list-inline">
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                                <div class="team-content">
                                    <div class="team-info">
                                        <h4>Absensi Anggota</h4>
                                        <p>SMK Negeri 2 Indramayu</p>
                                    </div>
                                    <div class="course-meta">
                                        <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                        <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                                    </div>
                                </div>
                            </div>

                            <div class="team-item team-item-2">
                                <div class="team-img">
                                    <img src="assets/user/images/about/about-4.png" alt="" class="img-fluid">

                                    <ul class="team-socials list-inline">
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                                <div class="team-content">
                                    <div class="team-info">
                                        <h4>Koleksi Buku</h4>
                                        <p>SMK Negeri 2 Indramayu</p>
                                    </div>

                                    <div class="course-meta">
                                        <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                        <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col-xl-5 col-lg-6">
                    <div class="about-img">
                        <img src="assets/user/images/banner/img_9.png" alt="" class="img-fluid">
                    </div>
                </div>

                <div class="mt-3">
                    <div class="row justify-content-center mt-5">
                        <div class="col-xl-6">
                            <div class="section-heading text-center">
                                <h2 class="font-lg">Our Students Says</h2>
                                <p>Discover Your Perfect Program In Our Courses.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="section-instructors section-padding">
                    <div class="container">
                        <div class="row">
                            @forelse ($footer as $item)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="team-item mb-5">
                                        <div class="team-img">
                                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->id }}"
                                                class="img-fluid">

                                            <ul class="team-socials list-inline">
                                                <li class="list-inline-item"><a href="#"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i
                                                            class="fab fa-twitter"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i
                                                            class="fab fa-linkedin-in"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="team-content">
                                            <div class="team-info">
                                                <h4>{{ $item->teks1 }}</h4>
                                                <p>{{ $item->teks2 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @empty
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="team-item mb-5">
                                        <div class="team-img">
                                            <img src="assets/user/images/about/about-3.png" alt=""
                                                class="img-fluid">

                                            <ul class="team-socials list-inline">
                                                <li class="list-inline-item"><a href="#"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i
                                                            class="fab fa-twitter"></i></a></li>
                                                <li class="list-inline-item"><a href="#"><i
                                                            class="fab fa-linkedin-in"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="team-content">
                                            <div class="team-info">
                                                <h4>Harish Ham</h4>
                                                <p>SEO Expert</p>
                                            </div>

                                            <div class="course-meta">
                                                <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                                <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
