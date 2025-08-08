<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyPayApp</title>
     <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
         :root{
            --bg:linear-gradient(to bottom right, #ff6e7f, #bfe9ff);
        }
        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #e2eafc 100%);
            /* background: var(--bg); */
            min-height: 100vh;
        }
        
        .card-login {
            background: var(--bg);
            /* background: linear-gradient(90deg, #4f8cff 60%, #6dd5ed 100%); */
            color: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .form-control,
        .form-label {
            border-radius: .7rem;
        }

        .btn-login {
            border-radius: .7rem;
            font-weight: bold;
        }

        .logo-img {
            height: 56px;
            display: block;
            margin: 0 auto 1.5rem auto;
        }

        .alert-login {
            display: none;
            border-radius: .7rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div id="app">
    <div class="container pb-5">
        <!-- Card: Login Form -->
        <div class="p-4 mx-auto mt-5 shadow-sm card card-login" style="max-width: 400px;">
            <img src="https://img.icons8.com/color/48/000000/rocket--v2.png" alt="Logo" class="logo-img">
            <h4 class="mb-4 text-center fw-bold">Login</h4>
            <div id="alertLoginSuccess" class="text-center alert alert-success alert-login" role="alert">
                Login berhasil!
            </div>
            <div id="alertLoginFailed" class="text-center alert alert-danger alert-login" role="alert">
                Username atau password salah!
            </div>
            {{-- @if(session('success'))
                <div class="text-center alert alert-success alert-login" style="display:block;" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="text-center alert alert-danger alert-login" style="display:block;" role="alert">
                   ssss {{ session('error') }}
                </div>
            @endif --}}
            @if($errors->any())
             <!-- Toast Container -->
                <div class="top-0 p-3 position-fixed end-0" style="z-index: 1055">
                <div id="myToast" class="border-0 toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                    <div class="toast-body">
                        {{ $errors->first() }}
                    </div>
                    <button type="button" class="m-auto btn-close btn-close-white me-2" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                </div>
            @endif
            <form method="POST" action="{{ route('viller.signin') }}">
                @csrf
            {{-- <form id="formLogin"> --}}
                <div class="mb-3">
                    <label for="username" class="text-white form-label fw-semibold">Username / Email</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Masukkan username atau email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="text-white form-label fw-semibold">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Masukkan password" required>
                </div>
                <div class="mb-2 d-grid">
                    <button type="submit" class="btn btn-light text-primary btn-login">Login</button>
                </div>
                <div class="text-center">
                    <a href="#" class="text-white text-decoration-underline small">Lupa password?</a>
                </div>
                <div class="text-center">
                    <a href="{{ route('viller.onboarding') }}" class="text-white text-decoration-underline small ">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('js/scripts.js')}}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('myToast');
        if (!toastEl) return;
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
    </script>

    <script>
        const{createApp, ref,onMounted,nextTick }=Vue;
        createApp({
            setup(){
            onMounted(() => {
                if (!localStorage.getItem("user")) {
                    sessionStorage.removeItem("userData");
                }else{
                    setTimeout(() => { window.location.href = "{{ route('viller.home') }}"; }, 5);
                }
            }) // Memanggil fungsi getuser saat komponen dimuat);
            }
        }).mount("#app");
    </script>
</body>

</html>
 