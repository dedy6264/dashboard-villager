<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dedy & Kristi Intimate Wedding</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Georgia', serif;
      background-color: #fdfdfd;
      margin: 0;
      overflow: hidden; /* kunci scroll sebelum cover hilang */
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
      background: url('https://picsum.photos/1200/800?grayscale') center/cover no-repeat;
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

    /* HEAD */
    #head h1 {
      font-size: 48px;
      animation: fadeIn 50s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>

  <!-- COVER -->
  <section id="cover">
    <div class="text-center content">
      <h2 class="fw-light">You're Invited To</h2>
      <h1 class="fw-bold display-3">Dedy & Kristi’s Wedding</h1>
      <button id="openBtn" class="px-4 py-2 mt-4 btn btn-light rounded-pill fw-bold">
        Open Invitation
      </button>
    </div>
  </section>

  <!-- HEAD -->
  <section id="head" class="text-center bg-light">
    <h1 class="fw-bold">Dedy & Kristi</h1>
    <p class="lead">Saturday, 25 October 2025</p>
    <p class="text-muted">With the blessing of God, we joyfully invite you to our wedding celebration</p>
  </section>

  <!-- INFO -->
  <section id="info">
    <div class="container text-center">
      <h2>Couple Info</h2>
      <div class="mt-4 row g-4">
        <div class="col-md-6">
          <div class="border-0 shadow card">
            <img src="https://picsum.photos/400/400?random=1" class="card-img-top" alt="Dedy">
            <div class="card-body">
              <h5 class="card-title">Dedy Saputra</h5>
              <p class="card-text">Jl. Merpati No. 12, Jakarta</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="border-0 shadow card">
            <img src="https://picsum.photos/400/400?random=2" class="card-img-top" alt="Kristi">
            <div class="card-body">
              <h5 class="card-title">Kristi Lestari</h5>
              <p class="card-text">Jl. Kenanga No. 45, Bandung</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- GALLERY -->
  <section id="gallery" class="bg-light">
    <div class="container text-center">
      <h2 class="mb-4">Our Journey</h2>
      <div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">
        <div class="rounded shadow carousel-inner">
          <div class="carousel-item active">
            <img src="https://picsum.photos/1000/600?random=3" class="d-block w-100" alt="photo1">
          </div>
          <div class="carousel-item">
            <img src="https://picsum.photos/1000/600?random=4" class="d-block w-100" alt="photo2">
          </div>
          <div class="carousel-item">
            <img src="https://picsum.photos/1000/600?random=5" class="d-block w-100" alt="photo3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </section>

  <!-- LOCATION -->
  <section id="location">
    <div class="container text-center">
      <h2>Wedding Location</h2>
      <p>Gedung Serbaguna, Jakarta - 25 October 2025</p>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126769.703!2d106.6894!3d-6.2297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTMnNDcuMCJTIDEwNsKwNDEnMjUuMCJF!5e0!3m2!1sen!2sid!4v1625227087334!5m2!1sen!2sid"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="p-3 text-center text-white bg-dark">
    <p class="mb-0">© 2025 Dedy & Kristi Wedding Invitation | Powered by Digital Invitation</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const cover = document.getElementById('cover');
    const openBtn = document.getElementById('openBtn');

    openBtn.addEventListener('click', () => {
      cover.classList.add('hidden'); // animasi swipe up
      document.body.style.overflow = 'auto'; // aktifkan scroll
      setTimeout(() => cover.remove(), 1000); // hapus setelah animasi selesai
    });
  </script>
</body>

</html>
