<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Pulsa - MyPayApp</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #e2eafc 100%);
            min-height: 100vh;
        }

        .inquiry-card {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            padding: 2rem 1.5rem;
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="container pb-5">
            <!-- Inquiry Pulsa -->
            <div class="mx-auto inquiry-card" style="max-width: 420px;">
                <div class="mb-4 text-center">
                    <div class="p-3 bg-primary bg-opacity-10 rounded-circle d-inline-block">
                        <i class="bi bi-phone-fill fs-2 text-primary"></i>
                    </div>
                    <h5 class="mt-3 mb-1 fw-semibold">Pembelian Pulsa</h5>
                    <div class="text-muted small">Isi nomor HP dan pilih nominal pulsa</div>
                </div>
                <form>
                    <div class="mb-3">
                        <label for="nomorHp" class="form-label small">Nomor HP</label>
                        <input type="tel" class="form-control" id="nomorHp" placeholder="08xxxxxxxxxx" maxlength="13"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="nominalPulsa" class="form-label small">Nominal Pulsa</label>
                        <select class="form-select" id="nominalPulsa" required>
                            <option value="" selected disabled>Pilih nominal</option>
                            <option value="10000">Rp 10.000</option>
                            <option value="20000">Rp 20.000</option>
                            <option value="25000">Rp 25.000</option>
                            <option value="50000">Rp 50.000</option>
                            <option value="100000">Rp 100.000</option>
                        </select>
                    </div>
                    <button type="button" class="mt-2 w-100 btn btn-primary" @click="btnhandle()">
                        <i class="bi bi-search"></i> Inquiry
                    </button>
                </form>
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
                    setTimeout(() => { window.location.href = "{{ route('viller.inquirysuccess') }}"; }, 1000);
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

</html>