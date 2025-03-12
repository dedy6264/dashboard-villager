<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Mobile App</title>
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
        .img-icon{
            display: block;
            margin: auto;
            width: 50%;
    
        }
    </style>
</head>
<body class="">
    <div class="content-center m-4 bg-white" style="margin-bottom: 50%; margin-top:50%;display: flex;justify-content: center;  align-items: center;  height: calc(100vh - 50px); ">
        <img class="d-flex justify-content-center align-items-center img-icon"  src="/assets/img/protection.gif" alt="" sizes="" srcset="" >
    </div>
<!-- Bottom Navigation -->
    <div class="navbar navbar-dark navbar-expand d-md-none d-lg-none d-xl-none bottom-nav d-flex justify-content-around bt-nav" >
        <a href="{{route('m')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
            </svg>
        </a>
        <a href="{{route('h')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
            </svg>
        </a>
        <a href="{{route('u')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
            </svg>
        </a>
    </div>

</body>
</html>
