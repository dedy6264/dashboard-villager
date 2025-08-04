@extends('mobile.app')
@section('style')
<style>
      .img-icon{
            display: block;
            margin: auto;
            width: 50%;
    
        }
        .header-payment{
            margin-top: 150px;
            margin-bottom: 20px;
        }
        .payment-modal{
            z-index: 10;
            position: absolute;
            top: 0;
            left: 0;
            background-color: white;
        }
</style>
@endsection
@section('content')
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
    <div v-if="mainData" v-for="item, index in mainData" :key="index">
        <a   data-bs-toggle="collapse"  href="#"  class="p-2 btn btn-primary w-100 d-flex align-items-center" :class="form.btnInq ? 'disabled-link':''"  style="margin-top:30px" @click="inquiry(item.productCode)" >
            <img src="{{ asset('assets/img/error-404-monochrome.svg') }}" class="img-fluid" style="max-height: 40px;" alt="Produk">
            <div class="ms-2 flex-grow-1 text-start">
                <h6 class="m-0 fw-bold " v-text="item.productName"></h6>
                <p class="m-0 ">Rp @{{item.productPrice}}</p>
            </div>
        </a>
    </div>
</div>
{{-- modals inquiry --}}
<div v-if="form.btnInq">
    <div  class="modal-backdrop fade show"></div>
</div>
@include('mobile.utils.loading')
@include('mobile.layouts.products.pln_token.inquiry')
@endsection
@section('customScript')
    <script>
        const{createApp, ref,onMounted,nextTick }=Vue;

        createApp({
            setup(){
                const mainData=ref({});
                const gifTrx=ref();
                const statusTrx=ref();
                const statusCode=ref();
                const billDesc=ref();

                const details=ref();
                const fade=ref(false);
                const form=ref({
                    customerId:'',
                    productCode:'',
                    pageInq:false,
                    pagePayment:false,
                    btnInq:false,
                });
                const formInquiry=ref({
                    sn:'',
                    createdAt:'',
                    referenceNumber:'',
                    customerId:'',
                    productCode:'',
                    productName:'',
                    productPrice:0,
                    productAdminFee:0,
                    productMerchantFee:0,
                    transactionTotalAmount:0,
                    pageInq:false,
                    token:'',
                });
                const inqCancel=()=>{
                    form.value.pageInq=false;
                    form.value.btnInq=false;
                };
                const clearAll=()=>{
                    mainData.value=ref({});
                    gifTrx.value=ref();
                    statusTrx.value=ref();
                    statusCode.value=ref();
                    billDesc.value=ref();
                    details.value=ref();
                };
                const inquiry=(productCode)=>{
                    fade.value=true;
                    axios.post('{{route('mobile.inquiry')}}',{
                            customerId:form.value.customerId,
                            productCode:productCode,
                        },{
                            headers: {
                                Authorization: `Bearer ${JSON.parse(localStorage.getItem("user")).token}`,
                            }
                        })
                        .then(response => {
                            // console.log(response.data.result.billInfo);
                            formInquiry.value.createdAt=response.data.result.createdAt;
                            formInquiry.value.referenceNumber=response.data.result.referenceNumber;
                            formInquiry.value.customerId=response.data.result.subscriberNumber;
                            formInquiry.value.productCode=response.data.result.productCode;
                            formInquiry.value.productName=response.data.result.productName;
                            formInquiry.value.productPrice=response.data.result.productPrice;
                            formInquiry.value.productAdminFee=response.data.result.productAdminFee;
                            formInquiry.value.productMerchantFee=response.data.result.productMerchantFee;
                            formInquiry.value.transactionTotalAmount=response.data.result.transactionTotalAmount;
                            statusCode.value=response.data.statusCode;
                            formInquiry.value.token=JSON.parse(localStorage.getItem("user")).token;
                            billDesc.value=response.data.result.billInfo.billDesc;
                            console.log(billDesc.value);
                            // mainData.value=response.data.data;
                            form.value.pageInq=true;
                            form.value.btnInq=true;
                            fade.value=false;
                        })
                        .catch(error => {
                            if (error.response.data.error=="invalid or expired jwt") {
                            setTimeout(() => { window.location.href = "{{ route('mobileLoading') }}"; }, 1000);
                            }else{
                                gifTrx.value="/assets/img/failed.gif";
                                        statusTrx.value=error.response.data.error;
                                        form.value.pageInq=true;
                                        form.value.btnInq=true;
                                        fade.value=false;
                            }
                        });
                }
                const getProduct=(event)=>{
                    clearAll();
                    form.value.customerId = event.target.value.replace(/\D/g, ""); // Hanya angka
                    if(form.value.customerId.length>10){
                        axios.post('{{route('mobile.product.getproduct')}}',{
                            productReferenceCode:'PLNPRE',
                        })
                        .then(response => {
                            console.log(response.data);
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
                    clearAll,
                    billDesc,
                    fade,
                    details,
                    statusCode,
                    statusTrx,
                    gifTrx,
                    formInquiry,
                    inqCancel,
                    inquiry,
                    form,
                    getProduct,
                    refreshData,
                    mainData,
                };
            }
        }).mount("#app");
    </script>
@endsection