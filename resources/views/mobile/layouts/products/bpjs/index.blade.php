@extends('mobile.app')
@section('style')
    <style>
        .img-icon{
                display: block;
                margin: auto;
                width: 50%;
        
            }
    </style>
@endsection
@section('content')
    <div class="mt-3" >
        <div class="container">
            <form @submit.prevent="inquiry()">
            <div class="row" :class="form.btnInq ? 'disabled-link':''" >
                    <div class="col-12">
                        <input type="text" class="form-control" placeholder="No BPJS" v-model="form.customerId">
                    </div>
                    <div >
                        <p  v-if="validate!==''">@{{validate}}</p>
                    </div>
                    <div class="col-12">
                        Pilih Periode
                        <select name="" class="form-control"  v-model="form.periode" id="" placeholder="Periode">
                            <option value="-">Pilih Periode</option>
                            <option value="1">1 Bulan</option>
                            <option value="2">2 Bulan</option>
                            <option value="3">3 Bulan</option>
                            <option value="4">4 Bulan</option>
                            <option value="5">5 Bulan</option>
                            <option value="6">6 Bulan</option>
                            <option value="7">7 Bulan</option>
                            <option value="8">8 Bulan</option>
                        </select>
                    </div>
                    <div class="col-6"> 
                    </div>
                    <div class="col-6">
                        <button type="submit"  class="mt-4 ml-4 mr-4 btn btn-primary btn-lg justify" style="width: 100%" >Lanjutkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div v-if="form.btnInq">
        <div  class="modal-backdrop fade show"></div>
    </div>
    @include('mobile.utils.loading')
    @include('mobile.layouts.products.bpjs.inquiry')
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
                const validate=ref();
                const details=ref();
                const fade=ref(false);
                const form=ref({
                    customerId:'',
                    productCode:'BPJSKS',
                    periode:'',
                    pageInq:false,
                    pagePayment:false,
                    btnInq:false,
                });
                const formInquiry=ref({
                    sn:'',
                    customerName:'',
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
                const loadingPayment=(event)=>{
                    form.value.pageInq=false;
                    fade.value=true;
                }
                const inqCancel=()=>{
                    form.value.pageInq=false;
                    form.value.btnInq=false;
                    gifTrx.value='';
                    statusTrx.value='';
                }
                const inquiry=()=>{
                    fade.value=true;
                    axios.post('{{route('mobile.inquiry')}}',{
                            customerId:form.value.customerId,
                            productCode:form.value.productCode,
                            periode:form.value.periode,
                        },{
                            headers: {
                                Authorization: `Bearer ${JSON.parse(localStorage.getItem("user")).token}`,
                            }
                        })
                        .then(response => {
                            formInquiry.value.customerName=response.data.result.billInfo.billDesc.customerName;
                            formInquiry.value.createdAt=response.data.result.createdAt;
                            formInquiry.value.referenceNumber=response.data.result.referenceNumber;
                            formInquiry.value.customerId=response.data.result.subscriberNumber;
                            formInquiry.value.productCode=response.data.result.productCode;
                            formInquiry.value.productName=response.data.result.productName;
                            formInquiry.value.productPrice=response.data.result.productPrice;
                            formInquiry.value.productAdminFee=response.data.result.productAdminFee;
                            formInquiry.value.productMerchantFee=response.data.result.productMerchantFee;
                            formInquiry.value.transactionTotalAmount=response.data.result.transactionTotalAmount;
                            details.value=response.data.result.billInfo.billDesc.detail;
                            statusCode.value=response.data.statusCode;
                            formInquiry.value.token=JSON.parse(localStorage.getItem("user")).token;
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
                onMounted(() => {
                    });

                return{
                    loadingPayment,
                    fade,
                    statusCode,
                    details,
                    validate,
                    statusTrx,
                    gifTrx,
                    formInquiry,
                    inqCancel,
                    inquiry,
                    form,
                    mainData,
                };
            }
        }).mount("#app");
    </script>
@endsection