<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Setting Pin</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(to bottom right, #ff6e7f, #bfe9ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
        }

        .otp-card {
            background: #fff;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        .otp-input-group input {
            width: 100%;
            height: 55px;
            text-align: center;
            font-size: 1.25rem;
            font-weight: bold;
            border-radius: 10px;
        }

        .otp-input-group .col {
            padding: 0 5px;
        }

        @media (max-width: 480px) {
            .otp-input-group input {
                height: 45px;
                font-size: 1rem;
            }
        }

        .otp-input-group input:focus {
            border-color: #ff6e7f;
            box-shadow: 0 0 0 0.25rem rgba(255, 110, 127, 0.25);
        }

        .resend-text a {
            color: #ff6e7f;
            text-decoration: none;
            font-weight: 500;
        }

        .resend-text a:hover {
            text-decoration: underline;
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
    </style>
</head>

<body>
    <div id="app" class="otp-card">
        <div class="mb-3 d-flex align-items-center">
            <i class="bi bi-arrow-left-circle-fill text-danger fs-4 me-2" role="button" onclick="history.back()"></i>
            <h4 class="mb-0">Setting PIN</h4>
        </div>

        <p class="mb-4 text-muted small">Masukkan 6 digit kode OTP yang telah kami kirim ke nomor Anda.@{{$phone}}</p>

        <form id="otpForm" action="{{ route('viller.setpin') }}" method="POST">
            @csrf
            <div class="mb-4 row otp-input-group gx-2">
                <div class="col-2"><input type="text" class="text-center form-control" maxlength="1" required /></div>
                <div class="col-2"><input type="text" class="text-center form-control" maxlength="1" required /></div>
                <div class="col-2"><input type="text" class="text-center form-control" maxlength="1" required /></div>
                <div class="col-2"><input type="text" class="text-center form-control" maxlength="1" required /></div>
                <div class="col-2"><input type="text" class="text-center form-control" maxlength="1" required /></div>
                <div class="col-2"><input type="text" class="text-center form-control" maxlength="1" required /></div>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100">Verifikasi</button>
        </form>

        <div class="mt-3 text-center resend-text">
            Tidak menerima kode? <a href="#">Kirim ulang</a>
        </div>
    </div>

    <!-- Bootstrap JS + Autofocus OTP -->
    <script>
    window.phone = @json($phone ?? []);
    // console.log("USER DATA:", window.phone);

    document.addEventListener('DOMContentLoaded', () => {
        const otpInputs = document.querySelectorAll('.otp-input-group input');

        let initialData = window.phone;
        if (!initialData || Object.keys(initialData).length === 0) {
            // console.log("GA ADA: ", initialData);
        }

        otpInputs.forEach((input, idx) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && idx < otpInputs.length - 1) {
                    otpInputs[idx + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === "Backspace" && input.value === "" && idx > 0) {
                    otpInputs[idx - 1].focus();
                }
            });
        });

        document.getElementById('otpForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const otp = Array.from(otpInputs).map(input => input.value).join('');
            if (otp.length === 6) {
                alert("OTP: " + otp);

                let otpInput = document.querySelector('input[name="otp"]');
                if (!otpInput) {
                    otpInput = document.createElement("input");
                    otpInput.type = "hidden";
                    otpInput.name = "otp";
                    this.appendChild(otpInput);
                }
                otpInput.value = otp;

                let phone ;
                if (!phone) {
                    phone = document.createElement("input");
                    phone.type = "hidden";
                    phone.name = "phone";
                    this.appendChild(phone);
                }
                phone.value = initialData.phone;

                this.submit();
            } else {
                alert("Harap masukkan 6 digit OTP.");
            }
        });
    });
</script>
</body>

</html>