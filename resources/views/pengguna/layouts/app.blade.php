<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dashboard PED - Aplikasi Manajemen Paket Proyek TR-7">
    <meta name="keyword" content="Dashboard PED - Aplikasi Manajemen Paket Proyek TR-7">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('img/avatar.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/avio-style.css') }}">
    <title>Dashboard PED - Aplikasi Manajemen Paket Proyek TR-7</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}

    

    <script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">    
    @stack('styles')
    
</head>


<body data-avio="theme-indigo">
    <div class="avio">
        @include('pengguna.layouts.partials.nav.' . activeGuard() . '')


        @yield('page_header')

        @yield('contents')
        {{-- <div style="padding-bottom: 50px;"></div> --}}
        @include('pengguna.layouts.partials.footer')
    </div>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/theme.js') }}"></script>
    <script src="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js"></script>
    <script src="{{ asset('js/bundle/sweetalert2.bundle.js') }}"></script>
    <!-- Plugin Js -->
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    
    @stack('scripts')
   
</body>

</html>
