<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kirim OTP</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #ff6e7f, #bfe9ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .otp-card {
            background: #fff;
            border-radius: 20px;
            padding: 2rem;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .otp-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }

        .otp-header h4 {
            margin: 0;
            font-weight: 600;
            color: #333;
        }

        .otp-header i {
            font-size: 1.2rem;
            color: #ff6e7f;
            cursor: pointer;
        }

        .info-text {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 1.5rem;
        }

        .btn-primary-custom {
            background-color: #ff6e7f;
            border: none;
            font-weight: 600;
            padding: 12px;
            border-radius: 12px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #ff4e63;
        }

        @media (max-width: 576px) {
            .otp-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="otp-card">
        <div class="otp-header">
            <i class="bi bi-arrow-left" onclick="history.back()" role="button" aria-label="Kembali"></i>
            <h4>Verifikasi Nomor</h4>
        </div>

        <p class="info-text">
            Kami telah mengirimkan kode OTP ke nomor <strong>08xxxxxxxxxx</strong>. Silakan lanjutkan untuk memasukkan
            kode OTP.
        </p>

        <a href="otp-input.html" class="btn btn-primary-custom">LANJUTKAN</a>
    </div>

    <!-- Optional JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>