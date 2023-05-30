@extends('layouts_user.ebook_main')

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
                        {{-- <p>Showing 1-6 of 8 results</p> --}}
                        {{-- <p>Menampilkan {{ $data_mading->count() }} dari {{ $data_mading->total() }} ebook</p> --}}
                    </div>

                    <div class="col-lg-4">
                        <div class="topbar-search">
                            <form action="{{ route('landingPage.madingSearch') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="Cari buku..."
                                        value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- Tombol Kembali -->
            <a href="{{ route('landingPage.mading') }}" class="btn btn-secondary mb-3">Kembali</a>
            <div class="">
                <p>Menampilkan {{ $data_mading->count() }} dari {{ $data_mading->total() }} ebook</p>
            </div>
            <div class="row">
                @if ($data_mading->isEmpty())
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            Tidak ada halaman ebook yang ditemukan.
                        </div>
                    </div>
                @else
                    <!-- Tampilkan data mading yang ditemukan -->
                    @foreach ($data_mading as $item)
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

                                            <div
                                                class="course-footer mt-20 d-flex align-items-center justify-content-between">
                                                <div class="course-name"></div>

                                                <a href="{{ route('landingPage.showMading', $item->slug) }}"
                                                    class="btn btn-main-outline btn-radius btn-sm">Selanjutnya <i
                                                        class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    <!-- Tombol Kembali -->
                    <a href="{{ route('landingPage.mading') }}" class="btn btn-secondary mb-3">Kembali</a>
                @endif
                <!-- COURSE END -->
            </div>
        </div>
        <!-- Pagination -->
        <div class="pagination justify-content-center">
            {{ $data_mading->links() }}
        </div>
        <!--course-->
    </section>
    <!--course section end-->
@endsection
