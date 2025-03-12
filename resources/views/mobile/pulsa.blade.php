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
        .page-confirm {
            text-align: center;
            text-color:rgb(255, 255, 255) !important;
        }
        .img-icon{
            display: block;
            margin: auto;
            width: 50%;
    
        }
        .header-payment{
            margin-top: 75px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="">
    <div class="mt-3" >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Nomor hp">
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white">
        <!-- Produk -->
        {{-- <p>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseInquiry" role="button" aria-expanded="false" aria-controls="collapseInquiry">
              Link with href
            </a>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInquiry" aria-expanded="false" aria-controls="collapseInquiry">
              Button with data-bs-target
            </button>
          </p>
          <div class="collapse bottom-nav" id="collapseInquiry">
            <div class="card card-body">
              Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
            </div>
          </div> --}}

          
        <a class="p-2 btn btn-primary w-100 d-flex align-items-center" style="margin-top:30px" data-bs-toggle="collapse"  href="#collapseInquiry" role="button" aria-expanded="false" aria-controls="collapseInquiry">
            <img src="{{ asset('assets/img/error-404-monochrome.svg') }}" class="img-fluid" style="max-height: 40px;" alt="Produk">
            <div class="ms-2 flex-grow-1 text-start">
                <h6 class="m-0 fw-bold ">Pulsa Telkomsel 5.000</h6>
                <p class="m-0 ">Rp 5.200</p>
            </div>
        </a>
        <a class="p-2 btn btn-primary w-100 d-flex align-items-center" style="margin-top:30px" data-bs-toggle="collapse"  href="#collapsePayment" role="button" aria-expanded="false" aria-controls="collapsePayment">
            <img src="{{ asset('assets/img/error-404-monochrome.svg') }}" class="img-fluid" style="max-height: 40px;" alt="Produk">
            <div class="ms-2 flex-grow-1 text-start">
                <h6 class="m-0 fw-bold ">Pulsa Telkomsel 5.000</h6>
                <p class="m-0 ">Rp 5.200</p>
            </div>
        </a>
        
        <div class="mb-0 card" style="max-width: 540px;margin-top:30px">
            <div class="row g-0">
              <div class="m-2 col-4" style="max-width: 50px">
                <img src="{{url('/assets/img/error-404-monochrome.svg')}}" class="img-fluid rounded-start" alt="...">
              </div>
              <div class=" col-8">
                <div class="card-body">
                  <h6 class="card-title">Pulsa Telkomsel 5.000</h6>
                  {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                  <p class="card-text"><small class="text-muted">Rp 5.200</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class=" bottom-nav collapse multi-collapse" id="collapseInquiry" style="width:100%;border-radius:50px;background-color:#03a1fc">
        <h2 class="mt-2 mb-5 page-confirm">Pulsa Telkomsel 5.000</h2>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">No Reff</div>
            <div class="bg-red-600 col-8 text-end">DV-20250302-00002</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">Datetime</div>
            <div class="bg-red-600 col-8 text-end">2 Maret 2025 08:50:22</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">No Cust</div>
            <div class="bg-red-600 col-8 text-end">089678971119</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">Denom</div>
            <div class="bg-red-600 col-8 text-end">5.000</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">Harga</div>
            <div class="bg-red-600 col-8 text-end">6.500</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">Admin</div>
            <div class="bg-red-600 col-8 text-end">1.500</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">Biaya Layanan</div>
            <div class="bg-red-600 col-8 text-end">1.500</div>
        </div>
        <div class="m-3">
            <hr>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300"><b>Total</b></div>
            <div class="bg-red-600 col-8 text-end"><b>9.500</b></div>
        </div>
        <div class=" bt-nav" style="margin-left: 50px;margin-right:50px;margin-bottom:50px">
            <div class="row">
                <div class="col-6">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseInquiry" aria-expanded="false" aria-controls="collapseInquiry" class="ml-4 mr-4 btn btn-primary btn-lg justify" style="width: 100%">Batal</button>
                </div>
                <div class="col-6">
                    <button type="button"  class="ml-4 mr-4 btn btn-primary btn-lg justify" style="width: 100%">Lanjutkan</button>
                </div>
            </div>
        </div>
        
    </div>
    <div class="content-center bg-white multi-collapse collapse " id="collapsePayment" style="z-index: 100;position: absolute;top: 0;left: 0;">
        <div class="" style="height:100px">
                <img src="/assets/img/verified.gif" class="img-icon" style="" alt="" sizes="" srcset="">
        </div>
        <h1 class="text-center header-payment">SUCCESS</h1>
        <h2 class=" page-confirm">Pulsa Telkomsel 15K</h2>
        <h4 class=" page-confirm">Rp 15.000</h4>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">No Reff</div>
            <div class="bg-red-600 col-8 text-end">DV-20250302-00002</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">Datetime</div>
            <div class="bg-red-600 col-8 text-end">2 Maret 2025 08:50:22</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">No Cust</div>
            <div class="bg-red-600 col-8 text-end">089678971119</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">Denom</div>
            <div class="bg-red-600 col-8 text-end">5.000</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">Harga</div>
            <div class="bg-red-600 col-8 text-end">6.500</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">Admin</div>
            <div class="bg-red-600 col-8 text-end">1.500</div>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300">Biaya Layanan</div>
            <div class="bg-red-600 col-8 text-end">1.500</div>
        </div>
        <div class="m-3">
            <hr>
        </div>
        <div class="m-3 row">
            <div class="text-left col-4 bg-slate-300"><b>Total</b></div>
            <div class="bg-red-600 col-8 text-end"><b>9.500</b></div>
        </div>
        <div class=" bt-nav" style="margin-left: 50px;margin-right:50px;">
            <div class="">
                <button type="button"  class="btn btn-primary btn-lg justify" style="width: 100%">Bagikan</button>
            </div>
        </div>
        
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
