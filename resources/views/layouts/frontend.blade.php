<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ app_name(true) }} - @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.ico') }}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/frontend.css') }}" rel="stylesheet">
  @yield('css')
</head>

<body>
@php
    $settings = \App\Models\Setting\Setting::get();
    $sections = \App\Models\Setting\Section::get();
@endphp
@include('layouts.includes.frontend.header')

    <main id="main">
        @yield('content')
    </main>

    @include('layouts.includes.frontend.footer', compact('settings','sections'))

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('stisla/js/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @yield('js')
</body>

</html>
