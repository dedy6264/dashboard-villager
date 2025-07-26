@extends('desain.viller.app')
@section('content')
  <div class="container pb-5">
        <!-- Filter Tanggal -->
        <div class="p-3 mb-4 filter-card">
            <form class="row g-2 align-items-end">
                <div class="col">
                    <label for="fromDate" class="mb-1 form-label small">Dari Tanggal</label>
                    <input type="date" class="form-control" id="fromDate">
                </div>
                <div class="col">
                    <label for="toDate" class="mb-1 form-label small">Sampai Tanggal</label>
                    <input type="date" class="form-control" id="toDate">
                </div>
                <div class="col-auto">
                    <button type="submit" class="px-4 btn btn-primary"><i class="bi bi-funnel"></i> Filter</button>
                </div>
            </form>
        </div>

        <!-- List Transaksi -->
        <div>
            <!-- Transaksi 1 -->
            <div class="p-3 transaction-card d-flex align-items-center">
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
            <!-- Transaksi 2 -->
            <div class="p-3 transaction-card d-flex align-items-center">
                <div class="p-3 bg-success bg-opacity-10 rounded-circle me-3">
                    <i class="bi bi-lightning-charge-fill fs-3 text-success"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Token Listrik</div>
                    <div class="small text-muted">ID: 1234567890 &middot; 50.000</div>
                    <div class="small text-success">Berhasil</div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-success">Rp 51.500</div>
                    <div class="small text-muted">11 Jun 2024</div>
                </div>
            </div>
            <!-- Transaksi 3 -->
            <div class="p-3 transaction-card d-flex align-items-center">
                <div class="p-3 bg-danger bg-opacity-10 rounded-circle me-3">
                    <i class="bi bi-shield-shaded fs-3 text-danger"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Asuransi Kesehatan</div>
                    <div class="small text-muted">Premi Bulanan</div>
                    <div class="small text-success">Berhasil</div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-danger">Rp 120.000</div>
                    <div class="small text-muted">10 Jun 2024</div>
                </div>
            </div>
            <!-- Transaksi 4 -->
            <div class="p-3 transaction-card d-flex align-items-center">
                <div class="p-3 bg-warning bg-opacity-10 rounded-circle me-3">
                    <i class="bi bi-wifi fs-3 text-warning"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Paket Data</div>
                    <div class="small text-muted">XL &middot; 20GB</div>
                    <div class="small text-success">Berhasil</div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-warning">Rp 60.000</div>
                    <div class="small text-muted">09 Jun 2024</div>
                </div>
            </div>
            <!-- Transaksi 5 -->
            <div class="p-3 transaction-card d-flex align-items-center">
                <div class="p-3 bg-info bg-opacity-10 rounded-circle me-3">
                    <i class="bi bi-tv-fill fs-3 text-info"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">TV Kabel</div>
                    <div class="small text-muted">Indovision</div>
                    <div class="small text-success">Berhasil</div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-info">Rp 150.000</div>
                    <div class="small text-muted">08 Jun 2024</div>
                </div>
            </div>
            <!-- Transaksi 6 -->
            <div class="p-3 transaction-card d-flex align-items-center">
                <div class="p-3 bg-primary bg-opacity-10 rounded-circle me-3">
                    <i class="bi bi-droplet-fill fs-3 text-primary"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">PDAM</div>
                    <div class="small text-muted">ID: 9876543210</div>
                    <div class="small text-success">Berhasil</div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-primary">Rp 80.000</div>
                    <div class="small text-muted">07 Jun 2024</div>
                </div>
            </div>
            <!-- Transaksi 7 -->
            <div class="p-3 transaction-card d-flex align-items-center">
                <div class="p-3 bg-success bg-opacity-10 rounded-circle me-3">
                    <i class="bi bi-credit-card-2-front-fill fs-3 text-success"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Top Up E-Money</div>
                    <div class="small text-muted">Mandiri e-Money</div>
                    <div class="small text-success">Berhasil</div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-success">Rp 100.000</div>
                    <div class="small text-muted">06 Jun 2024</div>
                </div>
            </div>
            <!-- Transaksi 8 -->
            <div class="p-3 transaction-card d-flex align-items-center">
                <div class="p-3 bg-danger bg-opacity-10 rounded-circle me-3">
                    <i class="bi bi-globe fs-3 text-danger"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Internet Rumah</div>
                    <div class="small text-muted">IndiHome</div>
                    <div class="small text-success">Berhasil</div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-danger">Rp 350.000</div>
                    <div class="small text-muted">05 Jun 2024</div>
                </div>
            </div>
            <!-- Transaksi 9 -->
            <div class="p-3 transaction-card d-flex align-items-center">
                <div class="p-3 bg-warning bg-opacity-10 rounded-circle me-3">
                    <i class="bi bi-mortarboard-fill fs-3 text-warning"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Pembayaran Pendidikan</div>
                    <div class="small text-muted">SPP Sekolah</div>
                    <div class="small text-success">Berhasil</div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-warning">Rp 500.000</div>
                    <div class="small text-muted">04 Jun 2024</div>
                </div>
            </div>
            <!-- Transaksi 10 -->
            <div class="p-3 transaction-card d-flex align-items-center">
                <div class="p-3 bg-info bg-opacity-10 rounded-circle me-3">
                    <i class="bi bi-ticket-perforated-fill fs-3 text-info"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Pembelian Tiket</div>
                    <div class="small text-muted">Bioskop XXI</div>
                    <div class="small text-success">Berhasil</div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-info">Rp 75.000</div>
                    <div class="small text-muted">03 Jun 2024</div>
                </div>
            </div>
        </div>
    </div>
@endsection