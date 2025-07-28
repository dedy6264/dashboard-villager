@extends('desain.viller.app')
@section('content')
<div class="container pb-5">
            <!-- Card: Saldo & User -->
            <div class="p-3 mb-4 shadow-sm card card-balance">
                <div class="row align-items-center">
                    <div class="col-7 d-flex flex-column justify-content-center">
                        <div class="fw-semibold fs-6">Halo, <span class="text-warning">Budi Santoso</span></div>
                        <div class="small">Level: <span class="badge bg-warning text-dark">Gold</span></div>
                    </div>
                    <div class="col-5 text-end">
                        <div class="small">Saldo</div>
                        <div class="fw-bold fs-4">Rp 1.250.000</div>
                    </div>
                </div>
            </div>

            <!-- Card: Kategori Produk -->
            <div class="p-3 mb-4 shadow-sm card">
                <div class="mb-3 fw-semibold">Kategori Produk</div>
                <div class="text-center row row-cols-4 g-2">
                    <div class="col">
                        <button type="button" class="py-3 btn `w-100" @click="handlePulsa()">
                            <div class="category-icon text-primary"><i class="bi bi-phone-fill"></i></div>
                        </button>
                        <div class="small">Pulsa</div>
                    </div>
                    <div class="col">
                        <button type="button" class="py-3 btn `w-100" @click="handlePulsa()">
                            <div class="category-icon text-success"><i class="bi bi-lightning-charge-fill"></i></div>
                        </button>
                        <div class="small">Listrik</div>
                    </div>
                    <div class="col">
                        <button type="button" class="py-3 btn `w-100" @click="handlePulsa()">
                            <div class="category-icon text-danger"><i class="bi bi-shield-shaded"></i></div>
                        </button>
                        <div class="small">Asuransi</div>
                    </div>
                    <div class="col">
                        <button type="button" class="py-3 btn `w-100" @click="handlePulsa()">
                            <div class="category-icon text-warning"><i class="bi bi-wifi"></i></div>
                        </button>
                        <div class="small">Paket Data</div>
                    </div>
                    <div class="col">
                        <button type="button" class="py-3 btn `w-100" @click="handlePulsa()">
                            <div class="category-icon text-info"><i class="bi bi-tv-fill"></i></div>
                        </button>
                        <div class="small">TV Kabel</div>
                    </div>
                    <div class="col">
                        <button type="button" class="py-3 btn `w-100" @click="handlePulsa()">
                            <div class="category-icon text-primary"><i class="bi bi-droplet-fill"></i></div>
                        </button>
                        <div class="small">PDAM</div>
                    </div>
                    <div class="col">
                        <button type="button" class="py-3 btn `w-100" @click="handlePulsa()">
                            <div class="category-icon text-success"><i class="bi bi-credit-card-2-front-fill"></i></div>
                        </button>
                        <div class="small">E-Money</div>
                    </div>
                    <div class="col">
                        <button type="button" class="py-3 btn `w-100" @click="handlePulsa()">
                            <div class="category-icon text-danger"><i class="bi bi-globe"></i></div>
                        </button>
                        <div class="small">Internet</div>
                    </div>
                    <div class="col">
                        <button type="button" class="py-3 btn `w-100" @click="handlePulsa()">
                            <div class="category-icon text-warning"><i class="bi bi-mortarboard-fill"></i></div>
                        </button>
                        <div class="small">Pendidikan</div>
                    </div>
                    <div class="col">
                        <button type="button" class="py-3 btn `w-100" @click="handlePulsa()">
                            <div class="category-icon text-info"><i class="bi bi-ticket-perforated-fill"></i></div>
                        </button>
                        <div class="small">Tiket</div>
                    </div>
                </div>
            </div>

            <!-- Carousel Promo -->
            <div id="promoCarousel" class="mb-4 carousel slide carousel-promo" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80"
                            class="d-block w-100" alt="Promo 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h6 class="px-2 py-1 bg-opacity-75 rounded bg-primary d-inline-block">Diskon 20% Pulsa</h6>
                            <p class="px-2 py-1 bg-opacity-75 rounded small bg-light d-inline-block text-dark">Berlaku
                                hingga 30 Juni 2024</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80"
                            class="d-block w-100" alt="Promo 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h6 class="px-2 py-1 bg-opacity-75 rounded bg-success d-inline-block">Cashback Listrik</h6>
                            <p class="px-2 py-1 bg-opacity-75 rounded small bg-light d-inline-block text-dark">Top up PLN
                                dapat cashback 10%</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=600&q=80"
                            class="d-block w-100" alt="Promo 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h6 class="px-2 py-1 bg-opacity-75 rounded bg-warning d-inline-block">Promo Asuransi</h6>
                            <p class="px-2 py-1 bg-opacity-75 rounded small bg-light d-inline-block text-dark">Gratis 1
                                bulan premi pertama</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            <!-- Card: History Transaksi Terakhir -->
            <div class="p-3 mb-4 shadow-sm card">
                <div class="mb-2 fw-semibold">Transaksi Terakhir</div>
                <div class="d-flex align-items-center">
                    <div class="p-3 bg-primary bg-opacity-10 rounded-circle me-3">
                        <i class="bi bi-phone-fill fs-3 text-primary"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">Pembelian Pulsa</div>
                        <div class="small text-muted">0812xxxx1234 &middot; 10.000</div>
                        <div class="small text-success">Berhasil</div>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold text-primary">Rp 11.000</div>
                        <div class="small text-muted">12 Jun 2024</div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('customScript')
    <script>
        const{createApp, ref,onMounted,nextTick }=Vue;

        createApp({
            setup(){
                const handlePulsa=()=>{//problem
                        setTimeout(() => { window.location.href = "{{ route('viller.inquiry') }}"; }, 1000);
                };
                // onMounted(() => {
                //     checkUser();
                //     });

                return{
                    handlePulsa,
                };
            }
        }).mount("#app");
    </script>
@endsection