<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Mobile App</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        
        .service-card {
            /* background-color: #1E90FF; Warna biru */
            border-radius: 10px;
            padding: 15px;
            margin-left: 30px;
            margin-right: 30px;
            color: white;
            text-align: center;
        }
        .bt-nav {
            background-color: #03a1fc;
            color: rgba(255, 255, 255, 0.7) !important;

        }
        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            /* background-color: #4682B4; */
            padding: 10px 0;
        }
        .bottom-nav a {
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            font-size: 14px;
        }
        .bottom-nav a:hover {
            color: white;
        }
        .jumbotron-fixed {
            position: absolute; /* Bisa juga pakai fixed */
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://via.placeholder.com/800x500') center/cover;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            z-index: -1; /* Supaya tertutup saat scroll */
        }
        /* Section Konten */
        .content-section {
            position: relative;
            background: white;
            /* padding: 100px 20px; */
        }
        .text-mobile {
            margin-top: 3px;
            margin-bottom: 3px;
        }
        .card-name {
            margin-top: 10px;
            margin-bottom: 100px;
            padding-top:10px;
            background-color: #81d0fd !important;
            height: 300px;
            border-radius: 30px 30px 0px 0px ;
        }
        .promo-carousel {
            margin-top: 150px;
        }
        .disabled-link {
          pointer-events: none;
          color: white; /* Opsional: Ubah warna agar terlihat nonaktif */
          text-decoration: none;
        }
        .page-confirm {
            text-align: center;
            text-color:rgb(255, 255, 255) !important;
        }
    </style>
    @yield('style')
</head>
<body class="">
    <div id="app">

        <!-- Search Bar -->
        {{-- <div class="container mt-3 navbar fixed-top bg-slate-300"> --}}
            {{-- info saldo --}}
            
            @yield('home')
            
            <!-- Bottom Navigation -->
            @include('mobile.bottomNavigation')
    </div>
<script src="{{url('js/scripts.js')}}"></script>

@yield('customScript')
</body>
</html>
