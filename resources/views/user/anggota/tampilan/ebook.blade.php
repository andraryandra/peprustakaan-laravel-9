@extends('user.anggota.layouts.main')

@section('container')
<section class="page-header">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-8">
          <div class="title-block">
            <h1>EBOOK</h1>
          </div>
        </div>
      </div>
    </div>
</section>
    <!--course section start-->
    <section class="section-padding page" >
        <div class="course-top-wrap mb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                    </div>

                    <div class="col-lg-4">
                        <div class="topbar-search">
                            <form method="get" action="#">
                                <input type="text"  placeholder="Search our courses" class="form-control">
                                <label><i class="fa fa-search"></i></label>
                            </form>
                        </div>
                    </div>

                    <div class="widget widget_tag_cloud">
                        <h4 class="widget-title">Kategori Ebook</h4>
                        <br>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">APAPL</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">APHPi</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">Biografi / Autobiografi</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">Buku Islam</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">E-Library SIGARDA INDONESIA</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">FIKSI</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">IELTS</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">Bahasa Indonesia</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">PKK</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">Sejarah Indonesia</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">Reading Comprehension</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">Speaking</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">TAB</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">Tautan Buku Pelajaran</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">TKJ</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">TOEFL</a>
                        <a href="{{ url('/user/anggota/tampilan/detail_ebook') }}">TOEIC</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-item mb-5">
                        <div class="team-img">
                            <img src="/../../assets/user/images/ebook/jingga&senja.jpg" alt="" class="img-fluid">

                            <ul class="team-socials list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
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

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-item mb-5">
                        <div class="team-img">
                            <img src="/../../assets/user/images/ebook/jingga&senja.jpg" alt="" class="img-fluid">
                            <ul class="team-socials list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h4>Harish Ham</h4>
                                <p>CEO, Developer</p>
                            </div>
                            <div class="course-meta">
                                <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-item mb-5">
                        <div class="team-img">
                            <img src="/../../assets/user/images/ebook/jingga&senja.jpg" alt="" class="img-fluid">

                            <ul class="team-socials list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h4>Harish Ham</h4>
                                <p>Web eveloper</p>
                            </div>
                            <div class="course-meta">
                                <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-item mb-5">
                        <div class="team-img">
                            <img src="/../../assets/user/images/ebook/jingga&senja.jpg" alt="" class="img-fluid">

                            <ul class="team-socials list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h4>Harish Ham</h4>
                                <p>Marketer</p>
                            </div>

                            <div class="course-meta">
                                <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-item mb-5">
                        <div class="team-img">
                            <img src="/../../assets/user/images/ebook/jingga&senja.jpg" alt="" class="img-fluid">
                            <ul class="team-socials list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h4>Harish Ham</h4>
                                <p>CEO, Developer</p>
                            </div>
                            <div class="course-meta">
                                <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-item mb-5">
                        <div class="team-img">
                            <img src="/../../assets/user/images/ebook/jingga&senja.jpg" alt="" class="img-fluid">

                            <ul class="team-socials list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
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

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-item mb-5">
                        <div class="team-img">
                            <img src="/../../assets/user/images/ebook/jingga&senja.jpg" alt="" class="img-fluid">

                            <ul class="team-socials list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h4>Harish Ham</h4>
                                <p>Marketer</p>
                            </div>

                            <div class="course-meta">
                                <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team-item mb-5">
                        <div class="team-img">
                            <img src="/../../assets/user/images/ebook/jingga&senja.jpg" alt="" class="img-fluid">

                            <ul class="team-socials list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h4>Harish Ham</h4>
                                <p>Web eveloper</p>
                            </div>
                            <div class="course-meta">
                                <span class="duration"><i class="far fa-user-alt"></i>20 Students</span>
                                <span class="lessons"><i class="far fa-play-circle me-2"></i>2 Course</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!--course-->
        </section>
        <!--course-->

    </section>
    <!--course section end-->

@endsection
