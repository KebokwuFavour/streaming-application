<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Bunma') }}</title>

    {{-- favicon --}}
    <link rel="icon" type="image/x-icon" href="/logo.svg" />
    {{-- /favicon --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- bootstrap 5 css --}}
    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    --}}


    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="assets/css/core/libs.min.css" />

    <!-- font-awesome css -->
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/all.min.css" />

    <!-- Iconly css -->
    <link rel="stylesheet" href="assets/vendor/iconly/css/style.css" />

    <!-- Animate css -->
    <link rel="stylesheet" href="assets/vendor/animate.min.css" />

    <!-- SwiperSlider css -->
    <link rel="stylesheet" href="assets/vendor/swiperSlider/swiper.min.css">


    <!-- Sweetlaert2 css -->
    <link rel="stylesheet" href="assets/vendor/sweetalert2/sweetalert2.min.css" />

    <link href="assets/vendor/video/video-js.css" rel="stylesheet" />


    <!-- Streamit Design System Css -->
    <link rel="stylesheet" href="assets/css/streamit.min.css@v=5.3.0.css" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/custom.min.css@v=5.3.0.css" />

    {{-- <!-- Rtl Css -->
    <link rel="stylesheet" href="assets/css/rtl.min.css@v=5.3.0.css" /> --}}

    {{-- <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300&display=swap"
        rel="stylesheet"> --}}


    <!-- Phosphor icons  -->
    <link rel="stylesheet" href="assets/vendor/phosphor-icons/Fonts/regular/style.css">
    <link rel="stylesheet" href="assets/vendor/phosphor-icons/Fonts/duotone/style.css">

    <link rel="stylesheet" href="assets/vendor/phosphor-icons/Fonts/fill/style.css">


    <link rel="stylesheet" href="assets/vendor/streamit-font/iconly.css">
</head>


<!-- Paystack script -->
<script src="https://js.paystack.co/v1/inline.js"></script>

<!-- Scripts -->
@routes
@vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
@inertiaHead

</head>

{{--

<body class="font-sans antialiased"> --}}

    <body class="custom-header-relative">

        {{-- Inertia pages --}}
        @inertia

        {{-- bootstrap 5 js --}}
        {{--
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script> --}}


        <!-- Library Bundle Script -->
        <script src="assets/js/core/libs.min.js"></script>
        <!-- Plugin Scripts -->

        <!-- Sweet-alert Script -->
        <script src="assets/vendor/sweetalert2/sweetalert2.min.js" async></script>
        <script src="assets/js/plugins/sweet-alert.js" defer></script>

        <!-- SwiperSlider Script -->
        <script src="assets/vendor/swiperSlider/swiper.min.js"></script>

        <script src="assets/vendor/video/video.min.js"></script>
        <script src="assets/vendor/videojs-youtube-master/youtube.js"></script>

        <!-- Select2 Script -->
        <script src="assets/js/plugins/select2.js" defer></script>


        <!-- Lodash Utility -->
        <script src="assets/vendor/lodash/lodash.min.js"></script>
        <!-- External Library Bundle Script -->
        <script src="assets/js/core/external.min.js"></script>
        <!-- countdown Script -->
        <script src="assets/js/plugins/countdown.js"></script>
        <!-- utility Script -->
        <script src="assets/js/utility.js"></script>
        <!-- Setting Script -->
        <script src="assets/js/setting.js"></script>
        <script src="assets/js/setting-init.js" defer></script>
        <!-- Streamit Script -->
        <script src="assets/js/streamit.js" defer></script>
        <script src="assets/js/swiper.js" defer></script>
    </body>

</html>