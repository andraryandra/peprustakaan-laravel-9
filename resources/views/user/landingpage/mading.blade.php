@extends('layouts_user.main')

@section('container')
    <section class="page-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-8">
                    <div class="title-block">
                        <h1>MADING</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--course section start-->
    <section class="section-padding page">
        <div class="course-top-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <p>Showing 1-6 of 8 results</p>
                    </div>

                    <div class="col-lg-4">
                        <div class="topbar-search">
                            <form method="get" action="#">
                                <input type="text" placeholder="Search our courses" class="form-control">
                                <label><i class="fa fa-search"></i></label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row ">
                @forelse ($data_mading as $item)
                    @foreach ($item->mading_items as $item2)
                        @if ($item2->verifikasi_mading == 'ACTIVE')
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
                        @endif
                    @endforeach
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info" role="alert">
                            Tidak ada data mading yang tersedia.
                        </div>
                    </div>
                @endforelse

                <!-- COURSE END -->

            </div>
        </div>
        <!--course-->
    </section>
    <!--course section end-->
@endsection
