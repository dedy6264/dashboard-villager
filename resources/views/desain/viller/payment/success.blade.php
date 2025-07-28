<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Berhasil - MyPayApp</title>
       <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
            min-height: 100vh;
        }

        .inquiry-card {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            padding: 2.5rem 2rem;
            margin-top: 3rem;
        }

        .success-icon {
            background: linear-gradient(45deg, #4fd1c5 0%, #38a169 100%);
            color: #fff;
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto;
            font-size: 2.5rem;
        }

        .option-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #2d3748;
            text-decoration: none;
            transition: background 0.2s, border 0.2s;
            margin-bottom: 0.5rem;
        }

        .option-link:hover {
            background: #e6fffa;
            border-color: #38a169;
            color: #22543d;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="container pb-5">
            <div class="mx-auto inquiry-card" style="max-width: 440px;">
                <div class="mb-4 text-center">
                    <div class="mb-2 success-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h4 class="mt-2 mb-1 fw-bold">Pembayaran Berhasil</h4>
                    <div class="text-muted small">Transaksi pembayaran Anda telah berhasil.</div>
                </div>
                <div class="mb-4">
                    <table class="table mb-0 table-borderless">
                        <tbody>
                            <tr>
                                <td>Nomor HP</td>
                                <td class="text-end fw-semibold">08xxxxxxxxxx</td>
                            </tr>
                            <tr>
                                <td>Nominal</td>
                                <td class="text-end fw-semibold">Rp 50.000</td>
                            </tr>
                            <tr>
                                <td>Biaya Admin</td>
                                <td class="text-end fw-semibold">Rp 1.500</td>
                            </tr>
                            <tr>
                                <td>Total Bayar</td>
                                <td class="text-end fw-bold text-success">Rp 51.500</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td class="text-end fw-semibold">12 Juni 2024, 14:30</td>
                            </tr>
                            <tr>
                                <td>ID Transaksi</td>
                                <td class="text-end fw-semibold">TRX123456789</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="gap-2 mb-3 d-grid">
                    <a href="#" class="btn btn-outline-success">
                        <i class="bi bi-receipt"></i> Lihat Bukti Pembayaran
                    </a>
                    <a href="#" @click="btnhandle()" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>
                <div class="mb-2 text-center text-muted small">Atau pilih opsi lain:</div>
                <div>
                    <a href="#" class="option-link">
                        <i class="bi bi-share"></i> Bagikan Bukti Pembayaran
                    </a>
                    <a href="#" class="option-link">
                        <i class="bi bi-phone"></i> Beli Pulsa Lagi
                    </a>
                    <a href="#" class="option-link">
                        <i class="bi bi-clock-history"></i> Lihat Riwayat Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('js/scripts.js')}}"></script>
      <script>
        const { createApp, ref, onMounted, nextTick } = Vue;

        createApp({
            setup() {
                const btnhandle = () => {//problem
                    setTimeout(() => { window.location.href = "{{ route('viller.home') }}"; }, 1000);
                };
                // onMounted(() => {
                //     checkUser();
                //     });

                return {
                    btnhandle,
                };
            }
        }).mount("#app");
    </script>
</body>