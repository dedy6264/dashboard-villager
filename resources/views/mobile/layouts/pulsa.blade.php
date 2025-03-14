@extends('mobile.app')
@section('style')
<style>
      .img-icon{
            display: block;
            margin: auto;
            width: 50%;
    
        }
        .header-payment{
            margin-top: 75px;
            margin-bottom: 20px;
        }
        .payment-modal{
            z-index: 100;
            position: absolute;
            top: 0;
            left: 0;
            background-color: white;
        }
</style>
@endsection
@section('home')
<div class="mt-3" >
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <input type="text" pattern="[0-9]*" v-model="form.customerId" @input="getProduct" name="customer_id" class="form-control" placeholder="Nomor hp" autofocus>
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
@include('mobile.layouts.inquiry')
@include('mobile.layouts.payment')
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
                    pagePayment:false,
                    btnInq:false,
                })
                const formInquiry=ref({
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
                const payment=()=>{
                  console.log("sdhgsjd");
                    form.value.pageInq=false;
                    form.value.btnInq=false;
                    axios.post('{{route('mobile.inquiry')}}',{
                        referenceNumber:formInquiry.value.referenceNumber,
                        },{
                            headers: {
                                Authorization: `Bearer ${JSON.parse(localStorage.getItem("user")).token}`,
                            }
                        })
                        .then(response => {
                            console.log(response.data);
                            formInquiry.value.createdAt=response.data.result.createdAt
                            formInquiry.value.referenceNumber=response.data.result.referenceNumber
                            formInquiry.value.customerId=response.data.result.subscriberNumber
                            formInquiry.value.productCode=response.data.result.productCode
                            formInquiry.value.productName=response.data.result.productName
                            formInquiry.value.productPrice=response.data.result.productPrice
                            formInquiry.value.productAdminFee=response.data.result.productAdminFee
                            formInquiry.value.productMerchantFee=response.data.result.productMerchantFee
                            formInquiry.value.totalTrxAmount=response.data.result.totalTrxAmount
                            form.value.pagePayment=true;

                        })
                        .catch(error => {
                            console.error("Error fetching data:", error);
                            if (error.response) {
                                this.errorMessage = error.response.data.message;
                                this.successMessage = '';  // Reset success jika ada
                            }
                        });
                }
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
                            formInquiry.value.createdAt=response.data.result.createdAt
                            formInquiry.value.referenceNumber=response.data.result.referenceNumber
                            formInquiry.value.customerId=response.data.result.subscriberNumber
                            formInquiry.value.productCode=response.data.result.productCode
                            formInquiry.value.productName=response.data.result.productName
                            formInquiry.value.productPrice=response.data.result.productPrice
                            formInquiry.value.productAdminFee=response.data.result.productAdminFee
                            formInquiry.value.productMerchantFee=response.data.result.productMerchantFee
                            formInquiry.value.totalTrxAmount=response.data.result.totalTrxAmount
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
                    payment,
                    formInquiry,
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