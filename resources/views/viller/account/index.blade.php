@extends('viller.app')
@section('content')
 <div class="container pb-5">
        <!-- Profile Card -->
        <div class="p-4 mb-4 profile-card d-flex align-items-center">
            <img src="https://img.icons8.com/color/96/000000/user-male-circle--v2.png" alt="User"
                class="rounded-circle me-3" style="width:64px;height:64px;">
            <div>
                <div class="mb-1 fw-bold fs-5">@{{useraccount.name}}</div>
                <div class="mb-1 text-muted small">Level: <span class="fw-semibold text-primary">Premium</span></div>
                <div class="text-muted small"><i class="bi bi-envelope"></i> @{{useraccount.email}}</div>
            </div>
        </div>

        <!-- Biodata Card -->
        <div class="p-3 mb-4 setting-card">
            <div class="mb-2 fw-semibold text-primary"><i class="bi bi-person-lines-fill me-2"></i>Biodata</div>
            <div class="mb-2 row">
                <div class="col-5 text-muted small">Nama Lengkap</div>
                <div class="col-7 fw-semibold">@{{useraccount.name}}</div>
            </div>
            <div class="mb-2 row">
                <div class="col-5 text-muted small">No. HP</div>
                <div class="col-7 fw-semibold">@{{useraccount.phone}}</div>
            </div>
            <div class="mb-2 row">
                <div class="col-5 text-muted small">Email</div>
                <div class="col-7 fw-semibold">@{{useraccount.email}}</div>
            </div>
            <div class="mb-2 row">
                <div class="col-5 text-muted small">Tanggal Lahir</div>
                <div class="col-7 fw-semibold">12 Mei 1995</div>
            </div>
            <div class="row">
                <div class="col-5 text-muted small">Alamat</div>
                <div class="col-7 fw-semibold">@{{useraccount.address || '-'}}</div>
            </div>
        </div>

        <!-- Pengaturan Akun -->
        <div class="p-0 setting-card">
            <div class="px-3 pt-3 mb-2 fw-semibold text-primary"><i class="bi bi-gear-fill me-2"></i>Pengaturan Akun
            </div>
            <a href="#"
                class="px-3 py-3 d-flex align-items-center border-bottom text-decoration-none text-dark setting-item">
                <i class="bi bi-shield-lock-fill fs-5 me-3 text-primary"></i>
                <span>Ubah Password</span>
            </a>
            <a href="#"
                class="px-3 py-3 d-flex align-items-center border-bottom text-decoration-none text-dark setting-item">
                <i class="bi bi-bell-fill fs-5 me-3 text-success"></i>
                <span>Notifikasi</span>
            </a>
            <a href="#"
                class="px-3 py-3 d-flex align-items-center border-bottom text-decoration-none text-dark setting-item">
                <i class="bi bi-credit-card-fill fs-5 me-3 text-info"></i>
                <span>Metode Pembayaran</span>
            </a>
            <a href="#"
                class="px-3 py-3 d-flex align-items-center border-bottom text-decoration-none text-dark setting-item">
                <i class="bi bi-shield-check fs-5 me-3 text-warning"></i>
                <span>Keamanan</span>
            </a>
            <a href="#"
                class="px-3 py-3 d-flex align-items-center border-bottom text-decoration-none text-dark setting-item">
                <i class="bi bi-question-circle-fill fs-5 me-3 text-danger"></i>
                <span>Bantuan</span>
            </a>
            <a href="#" @click="logout()" class="px-3 py-3 d-flex align-items-center text-decoration-none text-dark setting-item">
                <i class="bi bi-box-arrow-right fs-5 me-3 text-secondary"></i>
                <span>Keluar</span>
            </a>
        </div>
    </div>
@endsection
@section('customScript')
    <script>
        const{createApp, ref,onMounted,nextTick }=Vue;

        createApp({
            setup(){
                const useraccount=ref({});
                const getuseraccount=()=>{
                     if (!sessionStorage.getItem("userData")) {
                            localStorage.removeItem("user");
                            setTimeout(() => { window.location.href = "{{ route('viller.login') }}"; }, 1000);
                        }else{
                            useraccount.value = JSON.parse(sessionStorage.getItem("userData"));
                        } 
                };
                const logout=()=>{
                    localStorage.removeItem("user");
                    sessionStorage.removeItem("userData");
                    setTimeout(() => { window.location.href = "{{ route('viller.login') }}"; }, 1000);
                };
                const formatCurrency=(value)=> {
                  if (!value) return 'Rp 0';
                  return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                  }).format(value);
                };
                const formatDate=(dateStr)=> {
                    const date = new Date(dateStr);
                    const options = { day: '2-digit', month: 'long', year: 'numeric' };
                    return date.toLocaleDateString('id-ID', options);
                };
                onMounted(() => {
                    getuseraccount();
                }) // Memanggil fungsi getuser saat komponen dimuat);

                return{
                    logout,
                    formatDate,
                    formatCurrency,
                    useraccount,
                    getuseraccount,
                };
            }
        }).mount("#app");
    </script>
@endsection