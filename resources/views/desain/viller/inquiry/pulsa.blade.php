<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Web Mobile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #e2eafc 100%);
            min-height: 100vh;

        }

        .app-header {
            background: #fff;
            border-bottom-left-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            padding: 1rem 1.5rem;
        }

        .logo-img {
            height: 40px;
        }

        .card-form {
            background: linear-gradient(90deg, #4f8cff 60%, #6dd5ed 100%);
            color: #fff;
            border-radius: 1.2rem;
        }

        .produk-card {
            border-radius: 1rem;
            transition: box-shadow 0.2s;
        }

        .produk-card.selected {
            border: 2px solid #4f8cff;
            box-shadow: 0 0 0 2px #4f8cff33;
        }

        .produk-radio {
            display: none;
        }

        .produk-label {
            cursor: pointer;
            width: 100%;
            height: 100%;
            display: block;
        }

        .telkomsel-icon {
            width: 40px;
            height: 40px;
            object-fit: contain;
            margin-bottom: 0.5rem;
        }

        .navbar {
            border-top-left-radius: 1.2rem;
            border-top-right-radius: 1.2rem;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.04);
        }
        .produk-card.selected {
  border: 2px solid #0d6efd;
  background: #eaf1ff;
}

    </style>
</head>

<body>
    <!-- Header -->
    <div class="mb-4 app-header d-flex align-items-center justify-content-between">
        <img src="https://img.icons8.com/color/48/000000/rocket--v2.png" alt="Logo" class="logo-img">
        <span class="fw-bold fs-5 text-primary">MyPayApp</span>
    </div>
<div id="app">
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
                <input type="radio" :id="'produk' + index" class="produk-radio" name="produk" :value="produk.nama" v-model="selectedProduk" required>
                <label :for="'produk' + index" class="produk-label">
                  <div class="p-3 text-center card produk-card" :class="{ selected: selectedProduk === produk.nama }">
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
    </div>

    <!-- Bottom Navbar -->
    <nav class="px-0 bg-white navbar navbar-light fixed-bottom">
        <div class="container d-flex justify-content-around">
            <a href="file:///Users/dedykusworo/mine/dashboard-villager/resources/views/desain/home.html"
                class="text-center text-decoration-none text-primary">
                <i class="bi bi-house-door-fill fs-4"></i>
                <div class="small">Home</div>
            </a>
            <a href="file:///Users/dedykusworo/mine/dashboard-villager/resources/views/desain/history.html"
                class="text-center text-decoration-none text-secondary">
                <i class="bi bi-clock-history fs-4"></i>
                <div class="small">History</div>
            </a>
            <a href="file:///Users/dedykusworo/mine/dashboard-villager/resources/views/desain/akun.html"
                class="text-center text-decoration-none text-secondary">
                <i class="bi bi-person-circle fs-4"></i>
                <div class="small">Akun</div>
            </a>
        </div>
    </nav>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
  const { createApp, ref, watch } = Vue;

  createApp({
    setup() {
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
          try {
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
                // if (error.response) {
                //       localStorage.removeItem("user");
                //     setTimeout(() => { window.location.href = "{{ route('viller.login') }}"; }, 1000);
                // }
            });
            // const response = await axios.get('/api/get-produk', {
            //   params: { id: idKonsumen.value }
            // });
          } catch (err) {
            alert('Gagal mengambil data produk');
            produkList.value = [];
          }
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
        //   const response = await axios.post('/api/inquiry', {
        //     idKonsumen: idKonsumen.value,
        //     produk: selectedProduk.value
        //   });

        //   // contoh hasil: response.data.message = "Transaksi berhasil"
        //   alert(response.data.message);
          alert("Transaksi berhasil");
        } catch (error) {
          alert('Gagal melakukan inquiry');
        } finally {
          loading.value = false;
        }
      };

      return {
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

</body>

</html>