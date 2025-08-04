@extends('viller.app')
@section('content')
<div class="container pb-5">
        <!-- Card: Form Input Konsumen & Produk -->
      <div  class="p-3 mb-4 shadow-sm card card-form">
        <form @submit.prevent="submitInquiry">
          <div class="mb-3">
            <label class="text-white form-label fw-semibold">ID Konsumen / Nomor HP</label>
            <input v-model="idKonsumen" @input="onInput" type="text" class="form-control" placeholder="Masukkan ID Konsumen" required>
          </div>

          <div class="mb-3" v-if="produkList.length">
            <label class="text-white form-label fw-semibold">Pilih Produk</label>
            <div class="row g-2">
              <div class="col-6 col-md-4" v-for="(produk, index) in produkList" :key="index">
                <input type="radio" :id="'produk' + index" class="produk-radio" name="produk" :value="produk.productCode" v-model="selectedProduk" required>
                <label :for="'produk' + index" class="produk-label">
                  <div class="p-3 text-center card produk-card" :class="{ selected: selectedProduk === produk.productCode }">
                      <div class="row">
                          {{-- <div class="col-2">
                              <img src="https://upload.wikimedia.org/wikipedia/commons/b/bc/Telkomsel_2021_icon.svg"
                                  alt="Telkomsel" class="telkomsel-icon">
                          </div> --}}
                          {{-- <div class=" col-10"> --}}
                              {{-- <div class="mt-2 fw-semibold">Pulsa Telkomsel</div> --}}
                              <div class="fw-semibold">@{{ produk.productName }}</div>
                              {{-- <div class="small">Rp 5.000</div> --}}
                              <div class="small">Rp @{{ produk.productPrice }}</div>
                          {{-- </div> --}}
                      </div>
                  </div>
                </label>
              </div>
            </div>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-light fw-bold text-primary" :disabled="loading">
              @{{ loading ? 'Memproses...' : 'Beli Sekarang' }}
            </button>
          </div>
        </form>
      </div>
      <!-- Modal Inquiry Sukses -->
        <div class="modal fade" id="inquirySuccessModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content inquiry-card">
                <div class="mb-4 text-center">
                    <div class="mb-2 success-icon">
                    <i class="bi bi-check2"></i>
                    </div>
                    <h4 class="mt-2 mb-1 fw-bold">Inquiry Berhasil</h4>
                    {{-- <div class="text-muted small">Pembelian pulsa berhasil diproses.</div> --}}
                </div>
                <div class="mb-4">
                    <table class="table mb-0 table-borderless">
                    <tbody>
                        <tr>
                        <td>Nomor HP</td>
                        <td class="text-end fw-semibold">@{{ detail.productName }}</td>
                        </tr>
                        <tr>
                        <td>Nominal</td>
                        <td class="text-end fw-semibold">Rp @{{ detail.productPrice }}</td>
                        </tr>
                        <tr>
                        <td>No Customer</td>
                        <td class="text-end fw-semibold">Rp @{{ detail.subscriberNumber }}</td>
                        </tr>
                        <tr>
                        <td v-if="detail.productAdminFee">Biaya Admin</td>
                        <td class="text-end fw-semibold" v-if="detail.productAdminFee">Rp @{{ detail.productAdminFee }}</td>
                        </tr>
                        <tr>
                        <td>Total Bayar</td>
                        <td class="text-end fw-bold text-success">Rp @{{ detail.transactionTotalAmount }}</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="gap-2 d-grid">
                    <button @click="lanjutBayar" class="btn btn-success">
                    <i class="bi bi-cash-coin"></i> Lanjut Bayar
                    </button>
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left"></i> Kembali
                    </button>
                </div>
            </div>
        </div>
        </div>
        {{-- end Modal Inquiry Sukses --}}
        <!-- Modal Input PIN -->
        <div class="modal fade" id="pinInputModal" tabindex="-1" aria-labelledby="pinModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="p-4 modal-content">
            <h5 class="mb-3 text-center">Masukkan PIN Anda</h5>
            <input
                type="password"
                maxlength="6"
                class="text-center form-control fs-3"
                v-model="pin"
                placeholder="••••••"
                @keyup.enter="submitPin"
                autofocus
            >
            {{-- <div class="mt-3 d-grid">
                <button @click="submitPin" :disabled="pin.length !== 6 || pinLoading" class="btn btn-primary">
                @{{ pinLoading ? 'Memproses...' : 'Bayar' }}
                </button>
            </div> --}}
             <div class="gap-2 mt-3 d-grid">
                    <button @click="submitPin" :disabled="pin.length !== 6 || pinLoading"  class="btn btn-success">
                    <i class="bi bi-cash-coin"></i> 
                     @{{ pinLoading ? 'Memproses...' : 'Bayar' }}
                    </button>
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left"></i> Kembali
                    </button>
                </div>
            </div>
        </div>
        </div>
        {{-- endmodalpin --}}

@endsection
@section('customScript')
  <script>
        const{createApp, ref,onMounted,nextTick }=Vue;

        createApp({
            setup() {
                const detail = ref({
                    nomor: '',
                    nominal: '',
                    admin: '',
                    total: ''
                });
                const pin = ref('');
                const pinLoading = ref(false);
                const idKonsumen = ref('');
                const token = ref('');
                const productReferenceId = ref('');
                const produkList = ref([]);
                const selectedProduk = ref('');
                const loading = ref(false);
                const getProducts=()=>{
                        axios.post("{{route('viller.getproductbyreference')}}",{
                            productReferenceId: productReferenceId.value,
                            },{
                                headers: {
                                    Authorization: `Bearer ${token.value}`,
                                }
                            })
                        .then(response => {
                            console.log("Data fetched successfully:", response.data.data);
                            produkList.value = response.data.data;
                        })
                        .catch(error => {
                        });
                    };
                const onInput =  () => {
                    if (idKonsumen.value.length >10 ) {
                        token.value=JSON.parse(localStorage.getItem("user")).token;
                        axios.post("{{route('viller.getprefix')}}",{
                            subscriberId: idKonsumen.value,
                            },{
                                headers: {
                                    Authorization: `Bearer ${token.value}`,
                                }
                            })
                        .then(response => {
                            productReferenceId.value = response.data.data.productReferenceId;
                            getProducts();
                        })
                        .catch(error => {
                            console.error("Error fetching data:", error.response.data.error);
                        });
                    } else {
                    produkList.value = [];
                    selectedProduk.value = '';
                    }
                };
                const submitInquiry = async () => {
                    if (!selectedProduk.value) {
                        alert('Pilih produk terlebih dahulu');
                        return;
                    }
                    loading.value = true;
                    try {
                        const response = await axios.post("{{ route('viller.inquiry') }}", {
                            productCode: selectedProduk.value,
                            subscriberNumber: idKonsumen.value,
                        }, {
                            headers: {
                                Authorization: `Bearer ${token.value}`,
                            }
                        });

                        const data = response.data.data;
                        console.log("Inquiry response:", response.data.data);
                        detail.value = data;

                        // Tampilkan modal
                        nextTick(() => {
                            const modal = new bootstrap.Modal(document.getElementById('inquirySuccessModal'),
                                {
                                    backdrop: 'static',
                                    keyboard: false,
                                });
                            modal.show();
                        });
                    } catch (error) {
                        alert('Gagal melakukan inquiry');
                        console.error(error);
                    } finally {
                        loading.value = false;
                    }
                };
                const lanjutBayar = () => {
                    pin.value = '';
                    const pinModal = new bootstrap.Modal(document.getElementById('pinInputModal'),{
                        backdrop: 'static',
                        keyboard: false,
                    });
                    pinModal.show();

                    // Hide inquiry success modal
                    const inquiryModalEl = document.getElementById('inquirySuccessModal');
                    const inquiryModal = bootstrap.Modal.getInstance(inquiryModalEl);
                    if (inquiryModal) inquiryModal.hide();
                };

                const submitPin = async () => {
                    if (pin.value.length !== 6) return;

                    pinLoading.value = true;

                    try {
                        const response = await axios.post("{{ route('viller.payment') }}", {
                        referenceNumber: detail.value.referenceNumber,
                        accountPin: pin.value,
                        }, {
                        headers: {
                            Authorization: `Bearer ${token.value}`,
                        }
                        });
                         const userData = response.data.data;
                        // Simpan ke sessionStorage
                        sessionStorage.removeItem("paymentData");
                        sessionStorage.setItem('paymentData', JSON.stringify(userData));
                        // Misal berhasil, redirect ke halaman lain (contoh: halaman pembayaran sukses)
                            setTimeout(() => { window.location.href = "{{ route('viller.successpaymentpage') }}"; }, 2000);
                        alert('sukksess');
                    } catch (error) {
                        alert('PIN salah atau gagal melakukan pembayaran');
                        console.error(error);
                    } finally {
                        pinLoading.value = false;
                    }
                };



            return {
                pin,
                pinLoading,
                submitPin,
                lanjutBayar,
                detail,
                productReferenceId,
                getProducts,
                idKonsumen,
                produkList,
                selectedProduk,
                loading,
                onInput,
                submitInquiry
            };
            }
        }).mount("#app");
    </script>
@endsection