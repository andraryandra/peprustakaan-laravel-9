@extends('layouts_user.ebook_main')

@section('container')
    <section class="page-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-8">
                    <div class="title-block">
                        <h1>DETAIL EBOOKS</h1>
                        <ul class="header-bradcrumb justify-content-center">
                            <li><a href="{{ route('landingPage.index') }}">Home</a></li>
                            <li class="active" aria-current="page">{{ $ebook->judul_buku }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="page-wrapper">
        <div class="container">
            <div class="my-3">
                <button type="button" onclick="window.location.href='{{ route('landingPage.ebook') }}'"
                    class="btn btn-info text-light">Kembali</button>
            </div>
            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    <div class="post-single">
                        <div class="post-thumb">
                            <img src="{{ Storage::url($ebook->cover) }}" alt="{{ $ebook->id }}"
                                class="img-fluid rounded shadow-sm">
                            <div class="text-center">
                                <a href="{{ Storage::url($ebook->file) }}" download="{{ $ebook->judul_buku }}"
                                    target="_blank" class="btn btn-primary mt-4">
                                    Download Ebook
                                </a>

                                @if ($isi_buku->isEmpty())
                                    <p>Tidak ada isi cerita untuk eBook ini.</p>
                                @else
                                    <a href="{{ $buttonLink }}" class="btn btn-primary mt-4">{{ $buttonText }}</a>
                                @endif
                            </div>
                        </div>

                        <div class="single-post-content">
                            <div class="post-meta">
                                <span class="post-author">Penulis: {{ $ebook->penulis }}</span>
                                <span class="post-date"><i
                                        class="fa fa-calendar-alt mr-2"></i>{{ \Carbon\Carbon::parse($ebook->tahun_terbit)->format('d/m/Y') }}</span>
                                <span class="post-comments"><i class="far fa-comments"></i>15 Comments</span>
                            </div>
                            <h3 class="post-title">
                                Sinopsis {{ $ebook->judul_buku }}:
                            </h3>
                            <p class="text-justify">
                                {!! $ebook->sinopsis !!}
                            </p>
                        </div>

                        <!--  Share -->

                        <div class="blog-footer-meta d-md-flex justify-content-between align-items-center">
                            <div class="post-tags mb-4 mb-md-0">
                                <a href="">{{ $ebook->kategori->nama_kategori }}</a>
                                <a href="">{{ $ebook->subkategori->subkategori }}</a>
                            </div>

                            <div class="article-share d-md-flex align-items-center">
                                <h6>Share: </h6>
                                <ul class="social-icon">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i> </a></li>
                                    <li><a href="#"> <i class="fab fa-twitter"></i> </a></li>
                                    <li><a href="#"> <i class="fab fa-instagram"></i> </a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-youtube"></i> </a></li>
                                </ul>
                            </div>
                        </div>


                        <!--  Author -->
                        <div class="post-single-author mb-5">
                            <div class="author-img">
                                @if ($ebook->user_id || $ebook->user->photo)
                                    <img src="{{ Storage::url($ebook->user->photo) }}" alt="User Photo"
                                        class="wd-30 ht-30 rounded-circle img-thumbnail mx-auto d-block">
                                @else
                                    <img src="{{ asset('assets/admin/images/profile.png') }}" alt="Default Photo"
                                        class="wd-30 ht-30 rounded-circle img-thumbnail mx-auto d-block">
                                @endif
                            </div>
                            <div class="author-info">
                                <h4>{{ $ebook->penulis }}</h4>
                                {{-- <span>Web Developer</span> --}}
                                <p>Lorem ipsum dolor sit amet Officia enim nihil accusamus error perspiciatis nam quas
                                    distinctio nobis, quibusdam mollitia totam ipsam obcaecati, iusto alias reprehenderit
                                    tempora placeat voluptates eligendi.</p>
                            </div>
                        </div>

                        <!--  Comment start -->
                        <div class="comments common-form">
                            <h3 class="title">2 Comments</h3>
                            <div class="comment-box">
                                <div class="comment-avatar">
                                    <img src="assets/user/images/blog/user.jpg" class="me-3" alt="...">
                                </div>
                                <div class="comment-info">
                                    <h5>Harish John</h5>
                                    <span>17 Feb 2021</span>
                                    <p> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                        sollicitudin. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
                                        congue felis in faucibus. </p>
                                    <a class="reply-link" href="#"><i class="fas fa-reply-all"></i>Reply</a>
                                </div>
                            </div>

                            <div class="has-children">
                                <div class="comment-box">
                                    <div class="comment-avatar">
                                        <img src="assets/user/images/blog/user.jpg" class="me-3" alt="...">
                                    </div>
                                    <div class="comment-info">
                                        <h5>Harish John</h5>
                                        <span>17 Feb 2021</span>
                                        <p> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                            sollicitudin. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
                                            congue felis in faucibus. </p>
                                        <a class="reply-link" href="#"><i class="fas fa-reply-all"></i>Reply</a>
                                    </div>
                                </div>
                            </div>

                            <div class="comment-box">
                                <div class="comment-avatar">
                                    <img src="assets/user/images/blog/user.jpg" class="me-3" alt="...">
                                </div>
                                <div class="comment-info">
                                    <h5>Harish John </h5>
                                    <span>17 Feb 2021</span>
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                        sollicitudin. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
                                        congue felis in faucibus. </p>
                                    <a class="reply-link" href="#"><i class="fas fa-reply-all"></i>Reply</a>
                                </div>
                            </div>
                        </div>


                        <!--  Comment Form -->
                        <div class="comments-form common-form mt-4 ">
                            <h3 class="titile">Write a Review </h3>
                            <p>Your email address will not be published. Required fields are marked *</p>
                            <form action="#" class="comment_form">
                                <div class="row form-row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Website">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea name="msg" id="msgt" cols="30" rows="6" placeholder="Comment" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <a href="#" class="btn btn-main rounded">Post Comment</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-xl-4">
                    <div class="blog-sidebar mt-5 mt-lg-0">
                        <div class="widget widget-search">
                            <form action="{{ route('landingPage.ebookSearch') }}" class="search-form" method="GET">
                                <input type="text" class="form-control"name="keyword" placeholder="Cari buku...">
                                <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <div class="widget widget_latest_post">
                            <h4 class="widget-title">Latest Ebooks</h4>
                            <div class="recent-posts">
                                @php
                                    $ebookCount = 0;
                                @endphp
                                @foreach ($ebook_latest as $ebok)
                                    @foreach ($ebok->ebook_item_verify as $item)
                                        @if ($item->verifikasi_ebook == 'ACTIVE')
                                            @if ($ebookCount < 5)
                                                <div class="single-latest-post">
                                                    <div class="widget-thumb">
                                                        <a href="{{ route('landingPage.showEbook', $ebok->id) }}"><img
                                                                src="{{ Storage::url($ebok->cover) }}" alt=""
                                                                class="img-fluid"></a>
                                                    </div>
                                                    <div class="widget-content">
                                                        <h5><a
                                                                href="{{ route('landingPage.showEbook', $ebok->slug) }}">{{ $ebok->judul_buku }}</a>
                                                        </h5>
                                                        <span><i
                                                                class="fa fa-calendar-times"></i>{{ $ebok->created_at->format('d F Y') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                            @php
                                                $ebookCount++;
                                            @endphp
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>

                            @if (count($ebook_latest) > 5)
                                <div class="post-tags mb-4 mb-md-0">
                                    <a href="{{ route('landingPage.ebook') }}" class="mt-5">Load More</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
