<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ app_name(true) }}</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.ico') }}">

        @isset($meta)
            {{ $meta }}
        @endisset

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@400;600;700&family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
        <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/notyf/notyf.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote.min.css') }}">
        <link rel="stylesheet" href="{{ asset('stisla/css/modules/dropzone.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/stisla/litepress.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}" media="all">

        {{-- <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
        <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all">
        <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"> --}}

        <livewire:styles />
        @stack('css')
        <!-- Scripts -->
        <script defer src="{{ asset('vendor/alpine.js') }}"></script>
    </head>
    <body class="antialiased">
        <div id="app">
            <div class="main-wrapper">
                @include('components.navbar')
                @include('components.sidebar')

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                      <div class="section-header">
                        @isset($header_content)
                            {{ $header_content }}
                        @else
                            {{ __('Halaman') }}
                        @endisset
                      </div>

                      <div class="section-body">
                        {{ $slot }}
                      </div>
                    </section>
                  </div>
            </div>
        </div>

        @stack('modals')

        <!-- General JS Scripts -->
        <script src="{{ asset('stisla/js/modules/jquery.min.js') }}"></script>
        <script src="{{ asset('stisla/js/modules/popper.js') }}"></script>
        <script defer async src="{{ asset('stisla/js/modules/tooltip.js') }}"></script>
        <script src="{{ asset('stisla/js/modules/bootstrap.min.js') }}"></script>
        <script defer src="{{ asset('stisla/js/modules/jquery.nicescroll.min.js') }}"></script>
        <script defer src="{{ asset('stisla/js/modules/moment.min.js') }}"></script>
        <script defer src="{{ asset('stisla/js/modules/marked.min.js') }}"></script>
        <script defer src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
        <script defer src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
        <script defer src="{{ asset('stisla/js/modules/chart.min.js') }}"></script>
        <script defer src="{{ asset('stisla/js/modules/dropzone.min.js') }}"></script>
        <script defer src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('stisla/js/stisla.js') }}"></script>
        <script defer src="{{ asset('vendor/select2/select2.min.js') }}"></script>
        <script defer src="{{ asset('vendor/summernote/summernote.min.js') }}"></script>
        <script src="{{ asset('stisla/js/scripts.js') }}"></script>
        <livewire:scripts />
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ asset('js/stisla/slugex.js') }}"></script>
        <script src="{{ asset('js/stisla/copyLink.js') }}"></script>
        @isset($script)
            {{ $script }}
        @endisset
        @stack('script')
    </body>
</html>
