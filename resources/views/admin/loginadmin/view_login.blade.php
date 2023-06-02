<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Edumel- Education Html Template by dreambuzz">
    <meta name="keywords"
        content="education,edumel,instructor,lms,online,instructor,dreambuzz,bootstrap,kindergarten,tutor,e learning">
    <meta name="author" content="dreambuzz">
    <title>Edumel- Login Petugas</title>
    <!-- Mobile Specific Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="/../../assets/user/vendors/bootstrap/bootstrap.css">
    <!-- Iconfont Css -->
    <link rel="stylesheet" href="/../../assets/user/vendors/awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/../../assets/user/vendors/flaticon/flaticon.css">
    <link rel="stylesheet" href="/../../assets/user/fonts/gilroy/font-gilroy.css">
    <link rel="stylesheet" href="/../../assets/user/vendors/magnific-popup/magnific-popup.css">
    <!-- animate.css -->
    <link rel="stylesheet" href="/../../assets/user/vendors/animate-css/animate.css">
    <link rel="stylesheet" href="/../../assets/user/vendors/animated-headline/animated-headline.css">
    <link rel="stylesheet" href="/../../assets/user/vendors/owl/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/../../assets/user/vendors/owl/assets/owl.theme.default.min.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="/../../assets/user/css/woocomerce.css">
    <link rel="stylesheet" href="/../../assets/user/css/style.css">
    <link rel="stylesheet" href="/../../assets/user/css/responsive.css">
</head>

<body id="top-header">
    @include('layouts_user.navbar')
    <!--====== Header End ======-->
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 pe-md-0">
                                    <div class="auth-side-wrapper">

                                    </div>
                                </div>
                                <div class="col-md-8 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo d-block mb-2">Noble<span>UI</span></a>
                                        <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form action="{{ route('login.admin.proses') }}" method="POST"
                                            class="forms-sample">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" name="email" class="form-control" id="email"
                                                    placeholder="email">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password" autocomplete="current-password"
                                                    placeholder="Password">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="authCheck">
                                                <label class="form-check-label" for="authCheck">
                                                    Remember me
                                                </label>
                                            </div>

                                            <div>
                                                <button type="submit"
                                                    class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Footer section start -->
    @include('layouts_user.footer')
    <!-- Footer section End -->

    <!-- Essential Scripts =====================================-->
    <!-- Main jQuery -->
    <script src="/../../assets/user/vendors/jquery/jquery.js"></script>
    <!-- Bootstrap 5:0 -->
    <script src="/../../assets/user/vendors/bootstrap/popper.min.js"></script>
    <script src="/../../assets/user/vendors/bootstrap/bootstrap.js"></script>
    <!-- Counterup -->
    <script src="/../../assets/user/vendors/counterup/waypoint.js"></script>
    <script src="/../../assets/user/vendors/counterup/jquery.counterup.min.js"></script>
    <!--  Owl Carousel -->
    <script src="/../../assets/user/vendors/owl/owl.carousel.min.js"></script>
    <!-- Isotope -->
    <script src="/../../assets/user/vendors/isotope/jquery.isotope.js"></script>
    <script src="/../../assets/user/vendors/isotope/imagelaoded.min.js"></script>
    <!-- Animated Headline -->
    <script src="/../../assets/user/vendors/animated-headline/animated-headline.js"></script>
    <!-- Magnific Popup -->
    <script src="/../../assets/user/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>

    <script src="/../../assets/user/js/script.js"></script>
</body>

</html>
