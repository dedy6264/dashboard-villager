<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agus & Joy Intimate Wedding</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
    --pink: #f14e95;
    --bg: #0a0a0a;
    --shadow: 0 2px 2px rgb(0, 0, 0, 0.5);
    }
    body {
      font-family: 'Georgia', serif;
      background-color: #fdfdfd;
      margin: 0;
      overflow: hidden; /* kunci scroll sebelum cover hilang */
    }
    h4{
      font-size: 2rem;
    }
    section {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 60px 20px;
    }

    /* COVER */
    #cover {
      position: fixed;
      inset: 0;
      z-index: 9999;
      background: url(../inv/img/gpt.png) 50% 20% /cover no-repeat; /*40% 20% atau center untuk mengatur posisi gambar*/
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-align: center;
      transition: transform 1s ease, opacity 1s ease;
    }

    #cover::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
    }

    #cover .content {
      position: relative;
      z-index: 2;
    }

    #cover.hidden {
      transform: translateY(-100%);
      opacity: 0;
      pointer-events: none;
    }

    #cover h1,
    #cover h4 {
        text-shadow: var(--shadow);
    }

    #cover h1 {/*headline*/
        font-family: "Lavishly Yours", cursive;
        font-size: 4rem;
    }

    #cover h4 {/*judul*/
        font-size: 2rem;
    }

    #cover a {
        color: white;
        background-color: var(--bg);
    }
    #cover button:hover {
        background-color: var(--pink);
        color: white;
    }
    /* General Section Style */
    section {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 4rem 2rem;
    }

    /*HEAD*/
    #head { 
    /* background: #2b7ed0;  */
        /* position: relative; */
        min-height: 100vh;          /* selalu penuh 1 layar */
        width: 100%;      
        display: flex;
        justify-content: space-between; /* atur atas & bawah */
        padding: 80px 20px; /* beri jarak biar tidak mepet layar */
        align-items: center;
        /* justify-content: center; */
        text-align: center;
        color: white;
        background: url('../inv/img/gpt1.png')  center / cover no-repeat;
        background-attachment: fixed; /* 🎯 ini yang bikin statik */
        background-position: center;
    }
    #head h1 {
        font-family: "Lavishly Yours", cursive;
        font-size: 4rem;
    }
    #head .head-top {
      margin-top: 10vh; /* geser sedikit dari atas */
    }

    #head .head-bottom {
      margin-bottom: 10vh; /* geser sedikit dari bawah */
    }

    /*INFO*/
    #info { 
        /* background: #000000; */
        position: relative;
        min-height: 100vh;          /* selalu penuh 1 layar */
        width: 100%;      
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        background: url('../inv/img/tushar-ranjan-GqpGd6NtUoI-unsplash.jpg')  center / cover no-repeat;
        background-attachment: fixed; /* 🎯 ini yang bikin statik */
        background-position: center;
        opacity: 0.8;
    }
    #info .couple {
        margin-top: 20px !important;
        margin-bottom: 20px !important;
    }
    #info .couple h3 {
        font-family: "Lavishly Yours", cursive;
        font-size: 2rem;
        color: var(--pink);
    }
    #info .couple img {
        max-width: 100%;
    }

    /*GALLERY*/
    /* #gallery { background: #24be61; } */
    #gallery {
      max-width: 1200px;   /* batasi lebar galeri */
      margin: 0 auto;      /* posisikan ke tengah */
      padding: 50px;
      border-radius: 20px;
    }
    #gallery h2 {
        font-size: 3rem;
        font-family: "Lavishly Yours", cursive;
    }
    #gallery .gallery-item {
      position: relative;
      overflow: hidden;
      border-radius: 15px;
      cursor: pointer;
      margin-bottom: 15px; /* biar ada jarak antar row */
    }

    #gallery .gallery-item img {
      width: 100%;
    /*height: 250px;       /* atur tinggi seragam */
      object-fit: cover;   /* crop rapi */
      transition: transform .4s ease;
    }

    #gallery .gallery-item:hover img {
      transform: scale(1.2);
      filter: brightness(0.8);
    }
    #gallery .overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0,0,0,0.5);
      color: #fff;
      padding: 10px;
      text-align: center;
      transform: translateY(100%);
      transition: transform .3s ease;
    }

    #gallery .gallery-item:hover .overlay {
      transform: translateY(0);
    }

    #location { 
        position: relative;
        min-height: 100vh;          /* selalu penuh 1 layar */
        width: 100%;      
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        background: url('../inv/img/gpt.png')  center / cover no-repeat;
        background-attachment: fixed; /* 🎯 ini yang bikin statik */
        background-position: center;
     }
    #location h2 {
        font-size: 3rem;
        font-family: "Lavishly Yours", cursive;
    }
    /* Fade-in base */
    .fade-content {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 1s ease, transform 1s ease;
    }

    .visible.fade-content {
      opacity: 1;
      transform: translateY(0);
    }

    /* Delay untuk animasi berurutan */
    .fade-content:nth-child(1) { transition-delay: 0.5s; }
    .fade-content:nth-child(2) { transition-delay: 0.2s; }
    .fade-content:nth-child(3) { transition-delay: 0.2s; }
    .fade-content:nth-child(4) { transition-delay: 0.2s; }
    .fade-content:nth-child(5) { transition-delay: 0.2s; }
    .fade-content:nth-child(6) { transition-delay: 0.2s; }
    .fade-content:nth-child(7) { transition-delay: 0.2s; }
    .fade-content:nth-child(8) { transition-delay: 0.2s; }
    .fade-content:nth-child(9) { transition-delay: 0.2s; }
    .fade-content:nth-child(10) { transition-delay: 0.2s; }
    .fade-content:nth-child(11) { transition-delay: 0.2s; }
    .fade-content:nth-child(12) { transition-delay: 0.2s; }
    .fade-content:nth-child(13) { transition-delay: 0.2s; }
    .fade-content:nth-child(14) { transition-delay: 0.2s; }
    .fade-content:nth-child(15) { transition-delay: 0.2s; }
    .fade-content:nth-child(16) { transition-delay: 0.2s; }
    .fade-content:nth-child(17) { transition-delay: 0.2s; }

    
    
   
    @media(max-width: 1024px) {
        .profile-card {
            background: rgba(255, 255, 255, 0.2); /* transparan */
            backdrop-filter: blur(10px);          /* efek blur */
                -webkit-backdrop-filter: blur(10px); 
            border-radius: 12px;
            padding: 2rem;
            max-width: 100vh;
            margin: auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-card img {
            width: 100%;
            height: 100%;            /* isi penuh sesuai col */
            object-fit: cover;
            border-radius: 12px;
        }
        #gallery {
            max-width: 900px;
        }
    }
    @media(max-width: 768px) {
        .profile-card {
            background: rgba(255, 255, 255, 0.2); /* transparan */
            backdrop-filter: blur(10px);          /* efek blur */
                -webkit-backdrop-filter: blur(10px);  /* safari */
            border-radius: 12px;
            padding: 2rem;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-card img {
            width: 100%;
            height: 100%;            /* isi penuh sesuai col */
            object-fit: cover;
            border-radius: 12px;
        }
    }
    @media(max-width: 576px) {
        .profile-card {
            background: rgba(255, 255, 255, 0.2); /* transparan */
            backdrop-filter: blur(10px);          /* efek blur */
              -webkit-backdrop-filter: blur(10px);  /* safari */
            border-radius: 12px;
            padding: 2rem;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-card img {
            width: 100%;
            height: 100%;            /* isi penuh sesuai col */
            object-fit: cover;
            border-radius: 12px;
        }
    }
  </style>
</head>

<body>

  <!-- COVER -->
  <section id="cover">
    <div class="text-center content">
      <h2 class="fw-light">Wedding Invitation</h2>
      <h1 class="fw-bold display-3">Agus & Joy</h1>
      <h2 class="fw-light ">Dear Our Honored Guest <br> Antonius Birawa</h2>
      <button id="openBtn" class="px-4 py-2 mt-4 openbtn btn btn-light rounded-pill fw-bold">
        Open Invitation
      </button>
    </div>
  </section>

  <!-- HEAD -->
  <section id="head" class="text-center bg-light fade-section">
    {{-- <div class="fade-content"> --}}
        <div class="head-top fade-content">
            <h2 class="fw-light">Wedding Invitation</h2>
            <h1 class="fw-bold display-3">Agus & Joy’s</h1>
            <p class="fw-bold">Saturday, 25 October 2025</p>
        </div>
        <div class="head-bottom fade-content">
            <p class="fs-4 ">With the blessing of God, we joyfully invite you to our wedding celebration</p>
        </div>
    {{-- </div> --}}
  </section>

  <!-- INFO -->
  <section id="info" class="fade-section">
    <div class="container profile-card ">
        <div class="mt-5 row couple fade-content">
                <div class="col-lg-6 fade-content" style="margin-top: 12px !important; margin-bottom: 12px !important;">
                    <div class="row">
                        <div class=" col-6 text-end">
                            <h3>Agus Kurniawan</h3>
                            <p>Son of Mr. Ishak (Gan Dwan Hien) (♰)
                                & Mrs. Endang Sriwati (♰)</p>
                            <p>Son of BlaBla</p>
                        </div>
                        <div class="col-6">
                            <img src="{{url('inv/img/gpt2.png')}}" alt="Dedy" class="rounded img-responsive " style="object-position: 70% center; ">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 fade-content" style="margin-top: 12px !important; margin-bottom: 12px !important;">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{url('inv/img/gpt3.png')}}" alt="Dedy" class="rounded img-responsive " style="object-position: 20% center;  ">
                        </div>
                        <div class=" col-6 text-start">
                            <h3>Joy Adia Prajogo</h3>
                            <p>Son of Mr. Ishak (Gan Dwan Hien) (♰)
                              & Mrs. Endang Sriwati (♰)</p>
                            <p>Son of BlaBla</p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
  </section>

  <!-- GALLERY -->
  <section id="gallery" class=" fade-section">
    <div class=" text-center mb-5 fade-content">
      <h2 class="fw-bold">Captured Intimacy</h2>
      <p class="text-muted">Setiap bingkai menyimpan kisah penuh kehangatan dan kedekatan</p>
    </div>
        <div class="row fade-content">
            <a href="{{url('inv/img/FPG2708-scaled.jpg')}}" data-toggle="lightbox" data-gallery="example-gallery" data-size="lg"  class="col-sm-4 gallery-item">
                <img src="{{url('inv/img/FPG2708-scaled.jpg')}}" class="img-fluid" style="border-radius:15px">
            </a>
            <a href="{{url('inv/img/FPG2708-scaled.jpg')}}" data-toggle="lightbox" data-gallery="example-gallery" data-size="lg"  class="col-sm-4 gallery-item">
                <img src="{{url('inv/img/FPG2708-scaled.jpg')}}" class="img-fluid" style="border-radius:15px">
                 <div class="overlay"><p>Foto 2 - Deskripsi</p></div>
            </a>
            <a href="{{url('inv/img/FPG2708-scaled.jpg')}}" data-toggle="lightbox" data-gallery="example-gallery" data-size="lg"  class="col-sm-4 gallery-item">
                <img src="{{url('inv/img/FPG2708-scaled.jpg')}}" class="img-fluid" style="border-radius:15px">
            </a>
        </div>
        <div class="row fade-content">
            <a href="https://unsplash.it/1200/768.jpg?image=251" data-toggle="lightbox" data-gallery="example-gallery" data-size="lg"  class="col-sm-4 gallery-item">
                <img src="https://unsplash.it/600.jpg?image=251" class="img-fluid" style="border-radius:15px">
            </a>
            <a href="https://unsplash.it/1200/768.jpg?image=252" data-toggle="lightbox" data-gallery="example-gallery" data-size="lg"  class="col-sm-4 gallery-item">
                <img src="https://unsplash.it/600.jpg?image=252" class="img-fluid" style="border-radius:15px">
            </a>
            <a href="https://unsplash.it/1200/768.jpg?image=253" data-toggle="lightbox" data-gallery="example-gallery" data-size="lg"  class="col-sm-4 gallery-item">
                <img src="https://unsplash.it/600.jpg?image=253" class="img-fluid" style="border-radius:15px">
            </a>
        </div>
    {{-- </div> --}}
  </section>

  <!-- LOCATION -->
  <section id="location" class="fade-section">
    <div class="container text-center fade-content">
      <div class="container profile-card ">
        <h2>Wedding Celebration</h2>
        <div class="mt-5 row couple fade-content">
                <div class="col-lg-6 fade-content" style="margin-top: 12px !important; margin-bottom: 12px !important;">
                  <h3>Saturday, August 9th 2025</h3>
                  <p>17:00 - End</p>
                  <h3>GBI Gajah Mada Semarang Jl. </h3>
                  <h3>Gajah Mada 78-86</h3>
                  <h3>Semarang</h3>
                </div>
                <div class="col-lg-6 fade-content" style="margin-top: 12px !important; margin-bottom: 12px !important;">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126769.703!2d106.6894!3d-6.2297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTMnNDcuMCJTIDEwNsKwNDEnMjUuMCJF!5e0!3m2!1sen!2sid!4v1625227087334!5m2!1sen!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
      </div>
    </div>
  </section>

  <!-- Reservation -->
  <section id="reservation" class="fade-section">
    <div class="fade-content">
      <h2 class="mb-4">Your Invitation</h2>
    </div>
    <div class="p-4 shadow fade-content card" style="max-width: 450px;">
      <div class="text-center">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=INV123456" alt="Invitation QR" class="mb-3">
        <h5 class="fw-bold">John Doe</h5>
        <p class="text-muted">You are invited to celebrate our wedding</p>
        <p><strong>15 November 2025</strong><br>Jakarta Convention Center</p>
      </div>
    </div>
  </section>

  <!-- Story -->
  <section id="story" class="fade-section">
    <div class="fade-content">
      <h2 class="mb-4">Our Journey</h2>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-4 fade-content">
        <div class="border-0 shadow card">
          <img src="https://picsum.photos/400/250?random=1" class="card-img-top" alt="story">
          <div class="card-body">
            <h5 class="card-title">First Meet</h5>
            <p class="card-text">We met for the first time in 2019, and it was a wonderful beginning.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 fade-content">
        <div class="border-0 shadow card">
          <img src="https://picsum.photos/400/250?random=2" class="card-img-top" alt="story">
          <div class="card-body">
            <h5 class="card-title">Engagement</h5>
            <p class="card-text">On 2024, we decided to take the next step with love and blessing.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 fade-content">
        <div class="border-0 shadow card">
          <img src="https://picsum.photos/400/250?random=3" class="card-img-top" alt="story">
          <div class="card-body">
            <h5 class="card-title">Wedding Day</h5>
            <p class="card-text">Now, in 2025, we invite you to witness the happiest day of our life.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gift -->
  <section id="gift" class="fade-section">
    <div class="fade-content">
      <h2 class="mb-4">Wedding Gift</h2>
    </div>
    <div class="p-4 shadow fade-content card" style="max-width: 500px;">
      <div class="text-center">
        <p class="mb-3">Your presence is the best gift for us.<br>But if you wish to send us a gift, you may send it via:</p>
        <div class="mb-3">
          <h5 class="mb-1 fw-bold">Bank Transfer</h5>
          <p class="mb-0">BCA - 1234567890<br>a.n Agus & Joy</p>
        </div>
        <div>
          <h5 class="mb-1 fw-bold">Digital Wallet</h5>
          <p class="mb-0">OVO / GoPay / Dana: 081234567890</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="p-3 text-center text-white bg-dark">
    <p class="mb-0">© 2025 Agus & Joy Wedding Invitation | Powered by Digital Invitation</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const cover = document.getElementById('cover');
    const openBtn = document.getElementById('openBtn');

    openBtn.addEventListener('click', () => {
      cover.classList.add('hidden');
      document.body.style.overflow = 'auto'; // unlock scroll

      // Trigger fade-in pertama untuk head setelah cover hilang
      setTimeout(() => {
        document.querySelectorAll('#head .fade-content').forEach(el => {
          el.classList.add('visible');
        });
      }, 600);
    });

    // Observer untuk semua section setelah head
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.querySelectorAll('.fade-content').forEach(el => {
            el.classList.add('visible');
          });
        }
      });
    }, { threshold: 0.2 });

    // observe semua section (kecuali cover)
    document.querySelectorAll('.fade-section').forEach(section => {
      if (section.id !== 'head') observer.observe(section);
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.5/dist/index.bundle.min.js"></script>
  
</body>

</html>
