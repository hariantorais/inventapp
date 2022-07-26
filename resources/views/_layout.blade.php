<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
    
    <style>
        thead{ background: rgb(218, 242, 244); text-align: center;}
        a{text-decoration: none;}
        body{font-size: 12px; background: rgb(235, 235, 235);}
    </style>
    
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/fontawesome.js') }}"></script>
    <title>@yield('judul')</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">InventApp</a>
        </div>
    </nav>
    
    @yield('content')
    
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">&copy; 2022 HARIANTO (200401010151)</span>
        </div>
    </footer>
    
    {{-- INCLUDE MODALS --}}
    @include('modal-tambah')
    @include('modal-edit')
    @include('modal-barangkeluar')
    @include('modal-hapus')
    
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
    
    {{-- script --}}
    @include('script')
    
</body>
</html>