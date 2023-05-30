@extends('layouts_user.ebook_main')

@section('ebook')
    <section class="page-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-8">
                    <div class="title-block">
                        <img src="{{ Storage::url($isi_buku->ebook->cover) }}" alt="{{ $isi_buku->id }}"
                            class="rounded shadow-lg" width="300" style="background-color: white;">

                        <h1>{{ $isi_buku->ebook->judul_buku }}</h1>
                        <ul class="header-bradcrumb justify-content-center">
                            @foreach ($buku as $item)
                                @if ($item->id == $isi_buku->ebook_id)
                                    <li><a href="{{ route('landingPage.showEbook', $item->id) }}">Home</a></li>
                                @endif
                            @endforeach
                            <li class="active" aria-current="page" style="text-transform: capitalize;">{{ $isi_buku->slug }}
                            </li>
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
                            @if ($previousSlug)
                                <button class="btn btn-primary" style="font-size: 13px;"
                                    onclick="window.location.href='{{ route('landingPage.ebookStory', $previousSlug) }}'">Kembali</button>
                            @endif
                        </div>
                        <div>
                            @foreach ($buku as $item)
                                @if ($item->id == $isi_buku->ebook_id)
                                    <button class="btn btn-info text-light mx-2" style="font-size: 11px;"
                                        onclick="window.location.href='{{ route('landingPage.showEbook', $item->slug) }}'">Daftar
                                        Isi</button>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            @if ($nextSlug)
                                <button class="btn btn-primary" style="font-size: 13px;"
                                    onclick="window.location.href='{{ route('landingPage.ebookStory', $nextSlug) }}'">Selanjutnya</button>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="single-post-content">
                        <h3 class="post-title">
                            {{ $isi_buku->judul_part }}
                        </h3>
                        @if ($isi_buku->file)
                            <div>
                                @if (Str::endsWith($isi_buku->file, ['.pdf']))
                                    <object id="pdfObject" data="{{ asset('storage/' . $isi_buku->file) }}"
                                        type="application/pdf" width="100%" height="600">
                                        <p>Maaf, browser Anda tidak mendukung untuk menampilkan file PDF.</p>
                                    </object>
                                @else
                                    <img src="{{ asset('storage/' . $isi_buku->file) }}" alt="File Gambar" width="100%">
                                @endif
                            </div>
                        @endif
                        <div class="">
                            {!! $isi_buku->content_part !!}
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <div>
                            @if ($previousSlug)
                                <button class="btn btn-primary" style="font-size: 13px;"
                                    onclick="window.location.href='{{ route('landingPage.ebookStory', $previousSlug) }}'">Kembali</button>
                            @endif
                        </div>
                        <div>
                            @foreach ($buku as $item)
                                @if ($item->id == $isi_buku->ebook_id)
                                    <button class="btn btn-info text-light mx-2" style="font-size: 11px;"
                                        onclick="window.location.href='{{ route('landingPage.showEbook', $item->slug) }}'">Daftar
                                        Isi</button>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            @if ($nextSlug)
                                <button class="btn btn-primary" style="font-size: 13px;"
                                    onclick="window.location.href='{{ route('landingPage.ebookStory', $nextSlug) }}'">Selanjutnya</button>
                            @endif
                        </div>
                    </div>

                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
    @if (Str::endsWith($isi_buku->file, ['.pdf']))
        <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.0/turn.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                const flipbook = $('#flipbook');
                flipbook.turn({
                    width: '100%',
                    height: 600,
                    autoCenter: true
                });
            });
        </script>
    @endif

    <script>
        // Fungsi untuk menyimpan halaman terakhir yang dibaca
        function saveLastReadPage(pageNumber) {
            localStorage.setItem('lastReadPage', pageNumber);
            console.log('Halaman terakhir disimpan:', pageNumber);
        }

        // Fungsi untuk mendapatkan halaman terakhir yang dibaca
        function getLastReadPage() {
            const lastReadPage = localStorage.getItem('lastReadPage');
            console.log('Halaman terakhir diambil:', lastReadPage);
            return lastReadPage;
        }

        // Event listener saat halaman PDF berubah
        const pdfObject = document.getElementById('pdfObject');
        pdfObject.addEventListener('pagechange', function(event) {
            const pageNumber = event.pageNumber;
            saveLastReadPage(pageNumber);
        });

        // Fungsi untuk mengatur halaman terakhir yang dibaca saat PDF dimuat
        function setLastReadPage() {
            const lastReadPage = getLastReadPage();
            if (lastReadPage) {
                pdfObject.page = lastReadPage;
            }
        }

        // Panggil fungsi untuk mengatur halaman terakhir yang dibaca saat halaman dimuat
        pdfObject.onload = setLastReadPage;
    </script>
@endpush
