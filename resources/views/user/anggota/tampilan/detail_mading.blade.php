@extends('layouts_user.ebook_main')
@section('landingPageHomeMading')
    <section class="page-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-8">
                    <div class="title-block">
                        <h1>DETAIL MADING</h1>
                        <ul class="header-bradcrumb justify-content-center">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li class="active" aria-current="page">Detail Mading</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    <div class="post-single">
                        <div class="post-thumb">
                            <img src="{{ Storage::url($data_mading->image) }}" alt="{{ $data_mading->id }}"
                                class="img-fluid rounded shadow-md">
                        </div>
                        <a href="{{ route('landingPage.mading') }}" class="btn btn-primary my-3">Kembali</a>

                        <div class="single-post-content">
                            <div class="post-meta">
                                <span class="post-author">by {{ $data_mading->user->name }}</span>
                                <span class="post-date"><i
                                        class="fa fa-calendar-alt mr-2"></i>{{ $data_mading->created_at->format('d/m/Y') }}
                                </span>
                                <span class="post-comments"><i class="far fa-comments"></i>15 Comments</span>
                            </div>
                            <h3 class="post-title">
                                {{ $data_mading->judul }}
                            </h3>
                            <p class="text-justify">
                                {!! $data_mading->slug !!}
                            </p>

                        </div>

                        <!--  Share -->
                        <div class="blog-footer-meta d-md-flex justify-content-between align-items-center">
                            <div class="post-tags mb-4 mb-md-0">
                                @foreach (json_decode($data_mading->tags) as $tag)
                                    <a href="">{{ $tag->value }}</a>
                                @endforeach
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
                                @if (Auth::check() && Auth::user()->photo)
                                    <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="User Photo"
                                        class="wd-30 ht-30 rounded-circle img-thumbnail mx-auto d-block">
                                @else
                                    <img src="{{ asset('assets/admin/images/profile.png') }}" alt="Default Photo"
                                        class="wd-30 ht-30 rounded-circle img-thumbnail mx-auto d-block">
                                @endif
                            </div>

                            <div class="author-info">
                                <h4>{{ $data_mading->user->name }}</h4>
                                {{-- <span>{{ $data_mading->user->level }}</span> --}}
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
                            <form role="search" class="search-form">
                                <input type="text" class="form-control" placeholder="Search">
                                <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <div class="widget widget_latest_post">
                            <h4 class="widget-title">Latest Posts</h4>
                            <div class="recent-posts">
                                @php
                                    $postCount = 0;
                                @endphp
                                @foreach ($mading_latest as $mading)
                                    @if ($postCount < 5)
                                        <div class="single-latest-post">
                                            <div class="widget-thumb">
                                                <a href="{{ route('landingPage.showMading', $mading->id) }}"><img
                                                        src="{{ Storage::url($mading->image) }}" alt=""
                                                        class="img-fluid"></a>
                                            </div>
                                            <div class="widget-content">
                                                <h5><a
                                                        href="{{ route('landingPage.showMading', $mading->id) }}">{{ $mading->judul }}</a>
                                                </h5>
                                                <span><i
                                                        class="fa fa-calendar-times"></i>{{ $mading->created_at->format('d F Y') }}</span>
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $postCount++;
                                    @endphp
                                @endforeach
                            </div>

                            @if (count($mading_latest) > 5)
                                <div class="post-tags mb-4 mb-md-0">
                                    <a href="{{ route('landingPage.mading') }}" class="mt-5">Load More</a>
                                </div>
                            @endif
                        </div>





                        <div class="widget widget_categories">
                            <h4 class="widget-title">Categories</h4>
                            <ul>
                                <li class="cat-item"><a href="#">Web Design</a>(4)</li>
                                <li class="cat-item"><a href="#">Wordpress</a>(14)</li>
                                <li class="cat-item"><a href="#">Marketing</a>(24)</li>
                                <li class="cat-item"><a href="#">Design & dev</a>(6)</li>
                            </ul>
                        </div>

                        <div class="widget widget_tag_cloud">
                            <h4 class="widget-title">Tags</h4>
                            <a href="#">Design</a>
                            <a href="#">Development</a>
                            <a href="#">UX</a>
                            <a href="#">Marketing</a>
                            <a href="#">Tips</a>
                            <a href="#">Tricks</a>
                            <a href="#">Ui</a>
                            <a href="#">Free</a>
                            <a href="#">Wordpress</a>
                            <a href="#">bootstrap</a>
                            <a href="#">Tutorial</a>
                            <a href="#">Html</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
