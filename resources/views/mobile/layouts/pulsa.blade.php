@extends('mobile.app')
@section('home')
<div class="mt-3" >
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <input type="text" pattern="[0-9]*" v-model="form.customerId" @input="getProduct" name="customer_id" class="form-control" placeholder="Nomor hp" >
            </div>
        </div>
    </div>
</div>
<div class="container bg-white" >
    <!-- Produk -->
    {{-- <p>
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseInq" role="button" aria-expanded="false" aria-controls="collapseInq">
          Link with href
        </a>
        
      </p>
      <div class="collapse bottom-nav" id="collapseInq">
        <div class="card card-body">
          Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
      </div> --}}
      
    <div v-if="mainData" v-for="item, index in mainData" :key="index">
        <a   data-bs-toggle="collapse"  href="#"  class="p-2 btn btn-primary w-100 d-flex align-items-center" :class="form.btnInq ? 'disabled-link':''"  style="margin-top:30px" @click="inquiry(item.productCode)" >
            <img src="{{ asset('assets/img/error-404-monochrome.svg') }}" class="img-fluid" style="max-height: 40px;" alt="Produk">
            <div class="ms-2 flex-grow-1 text-start">
                <h6 class="m-0 fw-bold " v-text="item.productName"></h6>
                <p class="m-0 ">Rp @{{item.productPrice}}</p>
            </div>
        </a>
    </div>

    <div class="mb-0 card" style="max-width: 540px;margin-top:30px">
        <div class="row g-0">
          <div class="m-2 col-4" style="max-width: 50px">
            <img src="{{url('/assets/img/error-404-monochrome.svg')}}" class="img-fluid rounded-start" alt="...">
          </div>
          <div class=" col-8">
            <div class="card-body">
              <h6 class="card-title">Pulsa Telkomsel 5.000</h6>
              {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
              <p class="card-text"><small class="text-muted">Rp 5.200</small></p>
            </div>
          </div>
        </div>
    </div>
</div>
{{-- modals inquiry --}}
<div v-show="form.pageInq" class=" bottom-nav" id="collapseInquiry" style="width:100%;border-radius:50px;background-color:#03a1fc">
    <h2 class="mt-2 mb-5 page-confirm" >@{{formPayment.productName}}</h2>
    <div class="m-3 row" v-if="formPayment.referenceNumber!==''">
        <div class="text-left col-4 bg-slate-300">No Reff</div>
        <div class="bg-red-600 col-8 text-end">@{{formPayment.referenceNumber}}</div>
    </div>
    <div class="m-3 row" v-if="formPayment.createdAt!==''">
        <div class="text-left col-4 bg-slate-300">Datetime</div>
        <div class="bg-red-600 col-8 text-end">@{{formPayment.createdAt}}</div>
    </div>
    <div class="m-3 row" v-if="formPayment.customerId!==''">
        <div class="text-left col-4 bg-slate-300">No Cust</div>
        <div class="bg-red-600 col-8 text-end">@{{formPayment.customerId}}</div>
    </div>
    <div class="m-3 row" v-if="formPayment.productPrice!==''">
        <div class="text-left col-4 bg-slate-300">Harga</div>
        <div class="bg-red-600 col-8 text-end">@{{formPayment.productPrice}}</div>
    </div>
    <div class="m-3 row" v-if="formPayment.productAdminFee!==''">
        <div class="text-left col-4 bg-slate-300">Biaya Admin</div>
        <div class="bg-red-600 col-8 text-end">@{{formPayment.productAdminFee}}</div>
    </div>
    <div class="m-3">
        <hr>
    </div>
    <div class="m-3 row" v-if="formPayment.totalTrxAmount!==''">
        <div class="text-left col-4 bg-slate-300">Total</div>
        <div class="bg-red-600 col-8 text-end">@{{formPayment.totalTrxAmount}}</div>
    </div>
    <div class=" bt-nav" style="margin-left: 50px;margin-right:50px;margin-bottom:50px;margin-top:25px">
        <div class="row">
            <div class="col-6">
                <button type="button"  class="ml-4 mr-4 btn btn-lg justify btn-danger" style="width: 100%" @click="inqCancel">Batal</button>
            </div>
            <div class="col-6">
                <button type="button"  class="ml-4 mr-4 btn btn-primary btn-lg justify" style="width: 100%">Lanjutkan</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal inquiry --}}
@endsection
@section('customScript')
    <script>
        const{createApp, ref,onMounted,nextTick }=Vue;

        createApp({
            setup(){
                const mainData=ref({})
                const form=ref({
                    customerId:'',
                    productCode:'',
                    pageInq:false,
                    btnInq:false,
                })
                const formPayment=ref({
                    createdAt:'',
                    referenceNumber:'',
                    customerId:'',
                    productCode:'',
                    productName:'',
                    productPrice:0,
                    productAdminFee:0,
                    productMerchantFee:0,
                    totalTrxAmount:0,
                    pageInq:false,
                })

                const inqCancel=()=>{
                    form.value.pageInq=false;
                    form.value.btnInq=false;
                }
                const inquiry=(productCode)=>{
                    console.log(form.value.customerId);
                    // console.log("jkjk",JSON.parse(localStorage.getItem("user")).token);
                    axios.post('{{route('mobile.inquiry')}}',{
                            customerId:form.value.customerId,
                            productCode:productCode,
                        },{
                            headers: {
                                Authorization: `Bearer ${JSON.parse(localStorage.getItem("user")).token}`,
                            }
                        })
                        .then(response => {
                            console.log(response.data);
                            formPayment.value.createdAt=response.data.result.createdAt
                            formPayment.value.referenceNumber=response.data.result.referenceNumber
                            formPayment.value.customerId=response.data.result.subscriberNumber
                            formPayment.value.productCode=response.data.result.productCode
                            formPayment.value.productName=response.data.result.productName
                            formPayment.value.productPrice=response.data.result.productPrice
                            formPayment.value.productAdminFee=response.data.result.productAdminFee
                            formPayment.value.productMerchantFee=response.data.result.productMerchantFee
                            formPayment.value.totalTrxAmount=response.data.result.totalTrxAmount
                            // mainData.value=response.data.data;
                            form.value.pageInq=true;
                            form.value.btnInq=true;
                        })
                        .catch(error => {
                            console.error("Error fetching data:", error);
                            if (error.response) {
                                this.errorMessage = error.response.data.message;
                                this.successMessage = '';  // Reset success jika ada
                            }
                        });
                }
                const getProduct=(event)=>{
                    form.value.customerId = event.target.value.replace(/\D/g, ""); // Hanya angka
                    // console.log(customerId.value);
                    if(form.value.customerId.length>10){
                        axios.post('{{route('mobile.pulsa-pra.getproduct')}}',{
                            customerId:form.value.customerId,
                            productCode:form.value.productCode,
                        })
                        .then(response => {
                            mainData.value=response.data.data;
                        })
                        .catch(error => {
                            console.error("Error fetching data:", error);
                            if (error.response) {
                                this.errorMessage = error.response.data.message;
                                this.successMessage = '';  // Reset success jika ada
                            }
                        });
                    }
                };
                const refreshData=()=>{
                    form.value.pageInq=false;
                    // console.log(mainData.value); 
                    // bio.value.outletName=mainData.value.merchantOutletName
                    
                    const userData = { token: mainData.value.token };
                    if(localStorage.getItem("user")===null){
                        localStorage.setItem("user", JSON.stringify(userData));
                    }else{
                        localStorage.removeItem("user");
                        localStorage.setItem("user", JSON.stringify(userData));
                    }
                }
                onMounted(() => {
                    // refreshData();
                    });

                return{
                    formPayment,
                    inqCancel,
                    inquiry,
                    form,
                    getProduct,
                    refreshData,
                    mainData,
                    // form,
                    // bio,
                };
            }
        }).mount("#app");
    </script>
@endsection