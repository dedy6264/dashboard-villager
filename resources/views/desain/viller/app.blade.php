<!DOCTYPE html>
<html lang="""id">


</html>

<head>
    <meta charset="""UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Web Mobile</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/viller.css')}}">
</head>

<body>
    <div id="app">
        <!-- Header -->
        @include('desain.viller.header')
        @yield('content')
        <!-- Bottom Navbar -->
        @include('desain.viller.navbar')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('js/scripts.js')}}"></script>
    @yield('customScript')
</body>

</htm>