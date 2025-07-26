<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading - MyPayApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #e2eafc 100%);
            min-height: 100vh;
            margin: 0;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.85);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .loading-rocket {
            width: 56px;
            height: 56px;
            animation: rocket-bounce 1.2s infinite cubic-bezier(.68, -0.55, .27, 1.55);
            margin-bottom: 1rem;
        }

        @keyframes rocket-bounce {
            0% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-18px);
            }

            60% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(0);
            }
        }

        .loading-text {
            margin-top: 1.2rem;
            font-weight: bold;
            color: #4f8cff;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <div class="loading-overlay">
        <img src="https://img.icons8.com/color/96/000000/rocket--v2.png" alt="Loading" class="loading-rocket">
        <div class="spinner-border text-primary" role="status" aria-hidden="true"></div>
        <div class="loading-text">Menghubungkan ke Home...</div>
    </div>
    <script>
        // Simulasi loading, redirect ke halaman home setelah 2 detik
        setTimeout(function () {
            window.location.href = "{{ route('viller.home') }}";
        }, 2000);
    </script>
</body>

</html>