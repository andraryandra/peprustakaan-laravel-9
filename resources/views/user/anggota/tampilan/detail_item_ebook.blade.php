@extends('layouts_user.ebook_main')

@section('ebook')
    <section class="page-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-8">
                    <div class="title-block">
                        <h1>{{ $isi_buku->ebook->judul_buku }}</h1>
                        <ul class="header-bradcrumb justify-content-center">
                            @foreach ($buku as $item)
                                @if ($item->id == $isi_buku->ebook_id)
                                    <li><a href="{{ route('landingPage.showEbook', $item->id) }}">Home</a></li>
                                @endif
                            @endforeach
                            <li class="active" aria-current="page">{{ $isi_buku->judul_part }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-8 mx-auto">
                <!-- Menggunakan mx-auto untuk mengatur margin horizontal otomatis -->
                <div class="post-single">
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            @if ($previousId)
                                <button class="btn btn-primary"
                                    onclick="window.location.href='{{ route('landingPage.ebookStory', $previousId) }}'">Kembali</button>
                            @endif
                        </div>
                        <div>
                            @foreach ($buku as $item)
                                @if ($item->id == $isi_buku->ebook_id)
                                    <button class="btn btn-info text-light"
                                        onclick="window.location.href='{{ route('landingPage.showEbook', $item->id) }}'">Daftar
                                        Isi</button>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            @if ($nextId)
                                <button class="btn btn-primary"
                                    onclick="window.location.href='{{ route('landingPage.ebookStory', $nextId) }}'">Selanjutnya</button>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="single-post-content">
                        <h3 class="post-title">
                            {{ $isi_buku->judul_part }}
                        </h3>
                        <p class="text-md-start">
                            {!! $isi_buku->content_part !!}
                        </p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            @if ($previousId)
                                <button class="btn btn-primary"
                                    onclick="window.location.href='{{ route('landingPage.ebookStory', $previousId) }}'">Kembali</button>
                            @endif
                        </div>
                        <div>
                            @foreach ($buku as $item)
                                @if ($item->id == $isi_buku->ebook_id)
                                    <button class="btn btn-info text-light"
                                        onclick="window.location.href='{{ route('landingPage.showEbook', $item->id) }}'">Daftar
                                        Isi</button>
                                @endif
                            @endforeach
                        </div>

                        <div>
                            @if ($nextId)
                                <button class="btn btn-primary"
                                    onclick="window.location.href='{{ route('landingPage.ebookStory', $nextId) }}'">Selanjutnya</button>
                            @endif
                        </div>
                    </div>

                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
