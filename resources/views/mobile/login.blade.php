<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPOB Mobile App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body{
            background-color: #03a1fc
        }
        .service-card {
            /* background-color: #1E90FF; Warna biru */
            border-radius: 10px;
            padding: 15px;
            margin-left: 30px;
            margin-right: 30px;
            color: white;
            text-align: center;
        }
        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #4682B4;
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
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 ">
    <div class="p-4 shadow card" style="width: 350px;">
        <img class="d-flex justify-content-center align-items-center" src="/assets/img/undraw_mobile-site_qjby.svg" alt="" sizes="" srcset="" style="width: 100%;margin-bottom:50px">
        <h2 class="text-center">Login</h2>
        <form class="mt-3">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="mt-3 text-center">Don't have an account? <a href="#" class="text-primary">Sign up</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
