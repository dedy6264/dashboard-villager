<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dedy & Kristi Intimate Wedding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('css/styledeel.css')}}">
    <link rel="stylesheet" href="{{url('simplycountdown/dist/themes/dark.css')}}" />
  <link rel="stylesheet" href="{{ url('lightbox/dist/css/lightbox.min.css') }}">

</head>

<body>
    <section id="hero"
        class="p-3 mx-auto text-center text-white hero w-100 h-100 d-flex justify-content-center align-items-center">
        <main>
            <h4>Wedding Invitation</h4>
            <h1>Agus & Joy</h1>
            <p>Dear Our Honored Guest<br> Antonius Sandy</p>
            {{-- <h5>Sabtu, 20 Desember 2025</h5> --}}
            {{-- <div id="countdown"></div> --}}
            <a href="#head" class="mt-4 btn btn-lg" onclick="enableScroll()">Lihat Undangan</a>
            {{-- <div class="mt-4 countdown simply-countdown-losange"></div> --}}
        </main>
    </section>
    <section id="head"
        class="p-3 mx-auto text-center text-white head w-100 h-100 d-flex justify-content-center align-items-center">
        <main class="heading">
                <h4>Wedding Invitation</h4>
                <h1>Dina & Salasa</h1>
                {{-- <p>Kepada<br> Antonius Sandy</p> --}}
                <h5>Sabtu, 20 Desember 2025</h5>
            {{-- <div id="countdown"></div> --}}
            {{-- <a href="#home" class="mt-4 btn btn-lg" onclick="enableScroll()">Lihat Undangan</a> --}}
        </main>
        <div class="mt-4 countdown simply-countdown-dark"></div>
    </section>
    <nav class="bg-transparent navbar navbar-expand-md sticky-top custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">Dina & Salasa</a>
            <button class="border-0 navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Dina & Salasa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#head">Cover</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#info">Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#story">Our Story</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#gallery">Gallery</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <section id="home" class="home">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center col-md-8">
                    <h2>
                        Acara Pemberkatan
                    </h2>
                    <h3>Diselenggarakan pada 20 Desember 2025, di GBI Gajahmada</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque expedita sequi a autem
                        praesentium iusto fugiat adipisci aspernatur consequatur! Eos, natus? Tempora quibusdam illo
                        eligendi repellat, laboriosam nemo! Consectetur, iure.</p>
                </div>
            </div>
            <div class="mt-5 row couple">
                <div class="col-lg-6">
                    <div class="row">
                        <div class=" col-8 text-end">
                            <h3>Dedy Kusworo</h3>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, non error a fuga assumenda
                                repudiandae voluptas praesentium omnis vel, rem delectus, nam blanditiis ipsam. Quae,
                                dicta! Ipsum magni nam eveniet!</p>
                            <p>Son of BlaBla</p>
                        </div>
                        <div class="col-4">
                            <img src="{{url('inv/img/cowok.png')}}" alt="Dedy" class="img-responsive rounded-circle ">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{url('inv/img/cowok.png')}}" alt="Dedy" class="img-responsive rounded-circle ">
                        </div>
                        <div class=" col-8 text-start">
                            <h3>Dedy Kusworo</h3>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, non error a fuga assumenda
                                repudiandae voluptas praesentium omnis vel, rem delectus, nam blanditiis ipsam. Quae,
                                dicta! Ipsum magni nam eveniet!</p>
                            <p>Son of BlaBla</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="info" class="info">
        <div class="container">
            <div class="row justify-content-center">

                <div class="text-center col-md-8 col10">
                    <h2>Informasi Alamat</h2>
                    <p class="alamat">Lokasi alamat: Gedung MKP Mobile</p>
                    <a href="#" target="_blank" class="btn btn-light btn-sm">Lokasi</a>
                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore distinctio
                        dolorum temporibus saepe, rem porro quibusdam error, incidunt ducimus a consequuntur voluptatem
                        exercitationem ad debitis cum ipsam ipsa totam quos.</p>
                </div>
            </div>
            <div class="mt-4 row justify-content-center">
                <div class="col-md-5 col-10">
                    <div class="text-center card text-bg-light">
                        <div class="card-header">
                            Acara
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-calendar" viewBox="0 0 16 16">
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                    </svg>
                                    <span>08.00-09.00</span>
                                    <!-- <i class="bi bi-calendar">
                                        <span>08.00-09.00</span>
                                    </i> -->
                                </div>
                                <div class="col-md-6">
                                    <i class="bi bi-clock display-block">
                                        <span>Minggu 23 Desember 2023</span>
                                    </i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint nisi magnam commodi dolor.
                            Doloremque
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-10">
                    <div class="text-center card text-bg-light">
                        <div class="card-header">
                            Acara
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-calendar" viewBox="0 0 16 16">
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                    </svg>
                                    <span>08.00-09.00</span>
                                    <!-- <i class="bi bi-calendar">
                                        <span>08.00-09.00</span>
                                    </i> -->
                                </div>
                                <div class="col-md-6">
                                    <i class="bi bi-clock display-block">
                                        <span>Minggu 23 Desember 2023</span>
                                    </i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint nisi magnam commodi dolor.
                            Doloremque
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="story" class="story">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center col-md-8 col-10">
                    <span>Bagaimana</span>
                    <h2>Cerita kami</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias quis similique modi in eum
                        voluptates, dolorem laudantium sit officia quod, minima tempora tenetur, veritatis temporibus
                        itaque? Illum, voluptas. Nulla, ex!</p>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image" style="background-image: url('inv/img/cowok.png');"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h3>First meet</h3>
                                    <span>1 June 2000</span>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores recusandae,
                                        reprehenderit natus, dicta nihil exercitationem error voluptates sapiente, iure
                                        consequatur aspernatur incidunt nam quas ipsum dolorem ad mollitia accusamus
                                        quam!</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="timeline">
                        <li class="timeline-inverted">
                            <div class="timeline-image" style="background-image: url('inv/img/cowok.png');"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h3>First meet</h3>
                                    <span>1 June 2000</span>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores recusandae,
                                        reprehenderit natus, dicta nihil exercitationem error voluptates sapiente, iure
                                        consequatur aspernatur incidunt nam quas ipsum dolorem ad mollitia accusamus
                                        quam!</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="gallery" class="gallery">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center col-md-8 col-10">
                    <span>Memory Perjalana</span>
                    <h2>galery Foto</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus minus ab eligendi excepturi
                        repellat odit cumque dolor esse tempora cupiditate, deserunt consectetur? Sapiente odio ipsam
                        tenetur sed ex consectetur voluptas!</p>
                </div>
            </div>
            <div class="row row-cols-md-3 row-cols-sm-2 row-cols-1 justify-content-center">
                <div class="mt-3 col">
                    <a href="{{url('inv/img/FPG2875-2-scaled.jpg')}}">
                        <img src="{{url('inv/img/FPG2875-2-scaled.jpg')}}" class="rounded img-fluid w-100" alt="">
                    </a>
                </div>
                <div class="mt-3 col">
                    <a href="{{url('inv/img/FPG2875-2-scaled.jpg')}}">
                        <img src="{{url('inv/img/FPG2875-2-scaled.jpg')}}" class="rounded img-fluid w-100" alt="">
                    </a>
                </div>
                <div class="mt-3 col">
                    <a href="{{url('inv/img/FPG2875-2-scaled.jpg')}}">
                        <img src="{{url('inv/img/FPG2875-2-scaled.jpg')}}" class="rounded img-fluid w-100" alt="">
                    </a>
                </div>
                <div class="mt-3 col">
                    <a href="https://unsplash.it/1200/768.jpg?image=250" data-toggle="lightbox"
                        data-caption="This describes the image">
                        <img src="https://unsplash.it/600.jpg?image=250" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="text-center col">
                    <small class="block">&copy; 2023 DeKa</small>
                    <small class="block">Design by <a href="http://localhost:8000">cbgsj</a></small>
                    <ul>
                        <li>
                            <a href="" class="text-decoration-none text-dark" target="_blank"><i class=""></i>
                                Instagram</a>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.5/dist/index.bundle.min.js"></script>
    <script src="{{url('simplycountdown/dist/simplyCountdown.umd.js')}}"></script>
    <script>
        simplyCountdown(".countdown", {
            year: 2025,
            month: 12,
            day: 25,
            hours: 9,
            words: {
                days: {
                    lambda: (root, count) => (count === 1 ? "Hari" : "Hari"),
                    root: "Hari",
                },
                hours: {
                    lambda: (root, count) => (count === 1 ? "Jam" : "Jam"),
                    root: "Jam",
                },
                minutes: {
                    lambda: (root, count) => (count === 1 ? "Menit" : "Menit"),
                    root: "Menit",
                },
                seconds: {
                    lambda: (root, count) => (count === 1 ? "Detik" : "Detik"),
                    root: "Detik",
                },
            },
        });
    </script>
  <script src="{{ url('lightbox/dist/js/lightbox-plus-jquery.min.js') }}"></script>

    <script>
        const stickyTop = document.querySelector('.sticky-top');
        const stickyClose = document.querySelector('.offcanvas');
        stickyClose.addEventListener('show.bs.offcanvas', function () {
            stickyTop.style.overflow = 'visible';
        });
        stickyClose.addEventListener('hidden.bs.offcanvas', function () {
            stickyTop.style.overflow = 'hidden';
        });


    </script>
    <script>
        const rootElement = document.querySelector(":root");
        function disableScroll() {
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
            window.onscroll = function () {
                window.scrollTo(scrollTop, scrollLeft);
            };
            rootElement.style.scrollBehavior = 'auto';
        }
        function enableScroll() {
            window.onscroll = function () { };
            rootElement.style.scrollBehavior = 'smooth';
        }
        disableScroll();
    </script>
</body>

</html>