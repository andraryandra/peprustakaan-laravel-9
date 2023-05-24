<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Edumel- Education Html Template by dreambuzz">
  <meta name="keywords" content="education,edumel,instructor,lms,online,instructor,dreambuzz,bootstrap,kindergarten,tutor,e learning">
  <meta name="author" content="dreambuzz">

  <title>Edumel- Login Pengunjung</title>

  <!-- Mobile Specific Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="assets/user/vendors/bootstrap/bootstrap.css">
  <!-- Iconfont Css -->
  <link rel="stylesheet" href="assets/user/vendors/awesome/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/user/vendors/flaticon/flaticon.css">
  <link rel="stylesheet" href="assets/user/fonts/gilroy/font-gilroy.css">
  <link rel="stylesheet" href="assets/user/vendors/magnific-popup/magnific-popup.css">
  <!-- animate.css -->
  <link rel="stylesheet" href="assets/user/vendors/animate-css/animate.css">
  <link rel="stylesheet" href="assets/user/vendors/animated-headline/animated-headline.css">
  <link rel="stylesheet" href="assets/user/vendors/owl/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/user/vendors/owl/assets/owl.theme.default.min.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="assets/user/css/woocomerce.css">
  <link rel="stylesheet" href="assets/user/css/style.css">
  <link rel="stylesheet" href="assets/user/css/responsive.css">

</head>

<body id="top-header">

@include('layouts_user.navbar')
<!--====== Header End ======-->


<section class="page-wrapper woocommerce single">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="woocommerce-notices-wrapper"></div>
                <div class="login-form">
                    <div class="form-header">
                        <h2 class="font-weight-bold mb-3" style="color: #ffffff;">Login</h2>
                        <p>
                            Anggota Perpustakaan SMKN 2 Indramayu
                        </p>
                    </div>
                    <form action="{{ url('login/proses') }}" method="POST" class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Nomor Induk Siswa</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Nomor Induk Siswa">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Instansi Sekolah</label>
                            <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Masukkan Instansi Sekolah">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--shop category end-->

<!-- Footer section start -->
@include('layouts_user.footer')
<!-- Footer section End -->




    <!--
    Essential Scripts
    =====================================-->

    <!-- Main jQuery -->
    <script src="assets/user/vendors/jquery/jquery.js"></script>
    <!-- Bootstrap 5:0 -->
    <script src="assets/user/vendors/bootstrap/popper.min.js"></script>
    <script src="assets/user/vendors/bootstrap/bootstrap.js"></script>
    <!-- Counterup -->
    <script src="assets/user/vendors/counterup/waypoint.js"></script>
    <script src="assets/user/vendors/counterup/jquery.counterup.min.js"></script>
    <!--  Owl Carousel -->
    <script src="assets/user/vendors/owl/owl.carousel.min.js"></script>
    <!-- Isotope -->
    <script src="assets/user/vendors/isotope/jquery.isotope.js"></script>
    <script src="assets/user/vendors/isotope/imagelaoded.min.js"></script>
    <!-- Animated Headline -->
    <script src="assets/user/vendors/animated-headline/animated-headline.js"></script>
    <!-- Magnific Popup -->
    <script src="assets/user/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>

    <script src="assets/user/js/script.js"></script>


  </body>
  </html>


