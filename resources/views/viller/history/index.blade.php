@extends('viller.app')
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
        <div v-if="showAlert" :class="['alert', 'alert-' + alertType, 'alert-dismissible', 'fade', 'show']" role="alert">
        @{{ alertMessage }}
        <button type="button" class="btn-close" @click="showAlert = false" aria-label="Close"></button>
        </div>
        <!-- List Transaksi -->
        <div>
            <!-- Transaksi 1 -->

            <div class="p-3 mb-3 bg-white border rounded shadow-sm transaction-card btn-trx" 
            v-if="listTrx" 
            v-for="(trx, index) in listTrx" 
            :key="index">

            <form v-if="trx"
                :action="getFormAction(trx.statusCode)"
                method="POST"
                @click.prevent="handleClick(trx)"
                class="gap-3 d-flex align-items-center w-100">

                @csrf
                <input type="hidden" name="id" :value="trx.id" />
                <input v-if="token" type="hidden" name="bearerToken" :value="token" />

                <!-- Icon -->
                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                    style="width: 48px; height: 48px;">
                    <i class="bi bi-phone-fill fs-4 text-primary"></i>
                </div>

                <!-- Info -->
                <div class="flex-grow-1">
                    <div class="fw-semibold">Pembelian Pulsa - <i class="text-sm"> @{{trx.referenceNumber}}</i></div>
                    <div class="text-muted small">
                        @{{ trx.customerId }} &middot; 10.000
                    </div>
                    <div class="small"
                        :class="{
                            'text-success': trx.statusCode === '00',
                            'text-warning': trx.statusCode === '02',
                            'text-danger':  trx.statusCode === '03'
                        }">
                        @{{ trx.statusDesc }}
                    </div>
                </div>

                <!-- Amount & Date -->
                <div class="text-end">
                    <div class="fw-bold text-primary">Rp 11.000</div>
                    <div class="text-muted small">@{{ formatDate(trx.updatedAt) }}</div>
                </div>
            </form>
        </div>

        </div>
    </div>
@endsection
@section('customScript')
    <script>
        const{createApp, ref,onMounted,nextTick }=Vue;

        createApp({
            setup(){
                const alertMessage = ref('');
                const alertType = ref(''); // 'success', 'danger', 'warning', etc.
                const showAlert = ref(false);
                const token=ref("");
                const listTrx=ref({});
                const getTrx=()=>{
                    if (!localStorage.getItem("user")) {
                        window.location.href = "{{ route('viller.login') }}";
                        return;
                    }
                    token.value=JSON.parse(localStorage.getItem("user")).token;
                    axios.post("{{route('viller.gettrx')}}",{
                        "limit": 10,
                    },{
                        headers: {
                            Authorization: `Bearer ${token.value}`,
                        }
                    })
                    .then(response => {
                        listTrx.value=response.data.data.filter(trx => ['00', '02','03'].includes(trx.statusCode));
                    })
                    .catch(error => {
                        console.error(" getTrx Error fetching data:", error.response.data.raw.message);
                        if (error.response.data.raw.message === "invalid or expired jwt") {
                            localStorage.removeItem("user");
                            window.location.href = "{{ route('viller.login') }}";
                        } else {
                            alert("Terjadi kesalahan saat mengambil data transaksi.");
                        }
                    });
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
                const getFormAction=(statusCode)=> {
                    if (statusCode === '00' || statusCode === '03') {
                    return '{{ route("viller.trxdetail") }}';
                    } else if (statusCode === '02') {
                    return '{{ route("viller.trxdetail") }}';
                    }
                    return '#';
                };
                const handleClick=(trx)=> {
                    if (trx.statusCode === '02') {
                    // Jalankan fungsi khusus untuk status 02
                    openComplainDialog(trx);
                    } else {
                    // Submit form manual
                    event.currentTarget.submit();
                    }
                };
                const openComplainDialog=(trx)=> {
                    // contoh fungsi: buka modal, redirect, dsb
                    // console.log('Status 03, buka form komplain untuk:', trx);
                     axios.post("{{route('viller.advice')}}",{
                        referenceNumber: trx.referenceNumber,
                     },{
                        headers: {
                            Authorization: `Bearer ${token.value}`,
                        }
                    })
                    .then(response => {
                        console.log(" response fetching data:", response.data.message);
                        if (response.data.message === "PAYMENT" || response.data.message === "FAILED") {
                            // window.location.reload();
                        getTrx();
                            console.log("trx ok");
                        } else {
                            // alert("Transaction Pending: " + trx.referenceNumber);
                            alertMessage.value = "Transaksi :"+ trx.referenceNumber + " sedang dalam proses, silakan tunggu beberapa saat.";
                            alertType.value = "warning";
                            showAlert.value = true;
                        }
                    })
                    .catch(error => {
                        console.error(" getTrx Error fetching data:", error.response.data.raw.message);
                        if (error.response.data.raw.message === "invalid or expired jwt") {
                            localStorage.removeItem("user");
                            window.location.href = "{{ route('viller.login') }}";
                        } else {
                            alert("Terjadi kesalahan saat mengambil data transaksi.");
                        }
                    });
                };
                onMounted(() => {
                    getTrx();
                }) // Memanggil fungsi getuser saat komponen dimuat);

                return{
                    alertMessage,
                    alertType,
                    showAlert,
                    getFormAction,
                    handleClick,
                    openComplainDialog,
                    token,
                    formatDate,
                    formatCurrency,
                    getTrx,
                    listTrx,
                };
            }
        }).mount("#app");
    </script>
@endsection