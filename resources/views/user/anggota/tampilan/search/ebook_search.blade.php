@extends('layouts_user.ebook_main')

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
    <section class="section-padding page">
        <div class="course-top-wrap mb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                    </div>
                    <div class="col-lg-4">
                        <div class="topbar-search">
                            <form action="{{ route('landingPage.ebookSearch') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="keyword" placeholder="Cari buku..."
                                        value="{{ request('keyword') }}">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="widget widget_tag_cloud">
                        <h4 class="widget-title">Kategori Ebook</h4>
                        <br>
                        @forelse ($kategori as $item)
                            <a href="">{{ $item->nama_kategori }}</a>
                        @empty
                            <a href="#">APAPL</a>
                            <a href="#">APHPi</a>
                            <a href="#">Biografi / Autobiografi</a>
                            <a href="#">Buku Islam</a>
                            <a href="#">E-Library SIGARDA INDONESIA</a>
                            <a href="#">FIKSI</a>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Tombol Kembali -->
            <a href="{{ route('landingPage.ebook') }}" class="btn btn-secondary mb-3">Kembali</a>
            <div class="">
                <p>Menampilkan {{ $buku->count() }} dari {{ $buku->total() }} ebook</p>
            </div>
            <div class="row">
                @if ($buku->isEmpty())
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            Tidak ada halaman ebook yang ditemukan.
                        </div>
                    </div>
                @else
                    <!-- Tampilkan data ebook yang ditemukan -->
                    @foreach ($buku as $item)
                        @foreach ($item->ebook_item_verify as $item2)
                            @if ($item2->verifikasi_ebook == 'ACTIVE')
                                <div class="course-item col-lg-6 col-md-6">
                                    <div class="single-course style-2 bg-shade border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-xl-5">
                                                <div class="course-thumb"
                                                    style="background:url({{ asset('storage/' . $item->cover) }})">
                                                    <span class="category">Ebook</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-7">
                                                <div class="course-content py-4 pt-xl-0">
                                                    <h3 class="course-title"> <a
                                                            href="{{ route('landingPage.showEbook', $item->slug) }}">{{ $item->judul_buku }}</a>
                                                    </h3>
                                                    <div class="course-meta d-flex align-items-center">
                                                        <div class="author">
                                                            @if ($item->user->photo)
                                                                <img src="{{ asset('storage/' . $item->user->photo) }}"
                                                                    alt="User Photo" class="img-fluid">
                                                            @else
                                                                <img src="{{ asset('assets/admin/images/profile.png') }}"
                                                                    alt="" class="img-fluid">
                                                            @endif
                                                            <a href="#">{{ $item->penulis }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    <!-- Tombol Kembali -->
                    <a href="{{ route('landingPage.ebook') }}" class="btn btn-secondary mb-3">Kembali</a>
                @endif
            </div>
        </div>
        <!-- Pagination -->
        <div class="pagination justify-content-center">
            {{ $buku->links() }}
        </div>
    </section>
@endsection
