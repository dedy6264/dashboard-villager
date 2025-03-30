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
        {{-- <div class="row">
            <div class="col-12">
                    <input type="text" pattern="[0-9]*" v-model="form.customerId" @input="getProduct" name="customer_id" class="form-control" placeholder="Nomor hp" autofocus>
            </div>
        </div> --}}
        <form @submit.prevent="inquiry()">
        <div class="row" :class="form.btnInq ? 'disabled-link':''" >
                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Nomor hp" v-model="form.customerId">
                </div>
                <div >
                    <p  v-if="validate!==''">@{{validate}}</p>
                  </div>
                <div class="col-12">
                    Pilih Periode
                    <select name="" class="form-control"  v-model="form.periode" id="" placeholder="Nomor hp">
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
                    <button type="submit"  class="mt-4 ml-4 mr-4 btn btn-primary btn-lg justify" style="width: 100%">Lanjutkan</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- modals inquiry --}}
@include('mobile.layouts.inquiryBpjs')
@include('mobile.layouts.payment')
{{-- end modal inquiry --}}
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
                    totalTrxAmount:0,
                    pageInq:false,
                });
                const payment=()=>{
                    form.value.pageInq=false;
                    form.value.btnInq=false;
                    axios.post('{{route('mobile.payment')}}',{
                        referenceNumber:formInquiry.value.referenceNumber,
                        },{
                            headers: {
                                Authorization: `Bearer ${JSON.parse(localStorage.getItem("user")).token}`,
                            }
                        })
                        .then(response => {
                            console.log(response.data);
                            formInquiry.value.createdAt=response.data.result.createdAt;
                            formInquiry.value.referenceNumber=response.data.result.referenceNumber;
                            formInquiry.value.customerId=response.data.result.subscriberNumber;
                            formInquiry.value.productCode=response.data.result.productCode;
                            formInquiry.value.productName=response.data.result.productName;
                            formInquiry.value.productPrice=response.data.result.productPrice;
                            formInquiry.value.productAdminFee=response.data.result.productAdminFee;
                            formInquiry.value.productMerchantFee=response.data.result.productMerchantFee;
                            formInquiry.value.totalTrxAmount=response.data.result.totalTrxAmount;
                            formInquiry.value.customerName=response.data.result.billInfo.billDesc.customerName;
                            formInquiry.value.sn=response.data.result.billInfo.sn;
                            details.value=response.data.result.billInfo.billDesc.detail;
                            form.value.pagePayment=true;
                            switch (response.data.statusCode) {
                                case "00":
                                gifTrx.value="/assets/img/success.gif";
                                statusTrx.value=response.data.statusMessage;
                                    break;
                                case "09":
                                gifTrx.value="/assets/img/failed.gif";
                                statusTrx.value=response.data.statusMessage;
                                    break;
                                default:
                                gifTrx.value="/assets/img/pending.gif";
                                statusTrx.value=response.data.statusMessage;
                                    break;
                            }
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
                    gifTrx.value='';
                    statusTrx.value='';
                }
                const inquiry=()=>{
                    // console.log(form.value);
                    // console.log("jkjk",JSON.parse(localStorage.getItem("user")).token);
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
                            formInquiry.value.totalTrxAmount=response.data.result.totalTrxAmount;
                            details.value=response.data.result.billInfo.billDesc.detail;
                            statusCode.value=response.data.statusCode;
                            // mainData.value=response.data.data;
                            form.value.pageInq=true;
                            form.value.btnInq=true;
                        })
                        .catch(error => {
                            if (error.response.data.error=="invalid or expired jwt") {
                            setTimeout(() => { window.location.href = "{{ route('mobileLoading') }}"; }, 1000);
                            }else{
                                if (error.response.data.error=="NO PELANGGAN TIDAK DITEMUKAN"){
                                    gifTrx.value="/assets/img/failed.gif";
                                    statusTrx.value=error.response.data.error;
                                    form.value.pageInq=true;
                                    form.value.btnInq=true;
                                }
                                if (error.response.data.error=="TAGIHAN SUDAH LUNAS"){
                                    gifTrx.value="/assets/img/failed.gif";
                                    statusTrx.value=error.response.data.error;
                                    form.value.pageInq=true;
                                    form.value.btnInq=true;
                                }
                                if (error.response.data.error=="TIMEOUT"){
                                    gifTrx.value="/assets/img/failed.gif";
                                    statusTrx.value=error.response.data.error;
                                    form.value.pageInq=true;
                                    form.value.btnInq=true;
                                }
                            }
                        });
                }
                onMounted(() => {
                    });

                return{
                    statusCode,
                    details,
                    validate,
                    statusTrx,
                    gifTrx,
                    payment,
                    formInquiry,
                    inqCancel,
                    inquiry,
                    form,
                    mainData,
                    // form,
                    // bio,
                };
            }
        }).mount("#app");
    </script>
@endsection