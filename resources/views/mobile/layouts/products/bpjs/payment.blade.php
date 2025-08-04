@extends('mobile.app')
@section('content')
<div v-if="pagePayment" class="modal fade show"  id="exampleModal" style="display: block;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header" style="border-bottom:0">
                <h5 class="modal-title" id="exampleModalLabel"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="backHome"></button>
            </div> 
        <div class="modal-body modal-dialog modal-dialog-scrollable">
            <div class="" style="margin-left: 25%;margin-right: 25%;" >
                <img  :src="additionalData.gifTrx" class="img-icon" style="" alt="" sizes="" srcset="">
            </div>
        <h1 class="text-center header-payment">@{{additionalData.statusTrx}}</h1>
        <h2 class=" page-confirm" v-if="resData.productName!==''">@{{resData.productName}}</h2>
        <h4 class=" page-confirm" v-if="resData.transactionTotalAmount!==''">@{{resData.transactionTotalAmount}}</h4>
        <div class="m-3 row" v-if="resData.referenceNumber!==''">
            <div class="text-left col-4 bg-slate-300">No Reff</div>
            <div class="bg-red-600 col-8 text-end">@{{resData.referenceNumber}}</div>
        </div>
        <div class="m-3 row" v-if="resData.createdAt!==''">
            <div class="text-left col-4 bg-slate-300">Datetime</div>
            <div class="bg-red-600 col-8 text-end">@{{resData.createdAt}}</div>
        </div>
        <div class="m-3 row" v-if="infoDescData.customerId!==''">
            <div class="text-left col-4 bg-slate-300">No Cust</div>
            <div class="bg-red-600 col-8 text-end">@{{infoDescData.customerId}}</div>
        </div>
        <div class="m-3 row" v-if="infoDescData.customerName!==''">
            <div class="text-left col-4 bg-slate-300">Name Cust ww</div>
            <div class="bg-red-600 col-8 text-end">@{{infoDescData.customerName}}</div>
        </div>
        <div  v-if="details" v-for="item, index in details" :key="index">
            <div class="m-3 row" v-if="item.periode!==''">
                <div class="text-left col-4 bg-slate-300">Periode</div>
                <div class="bg-red-600 col-8 text-end">@{{item.periode}}</div>
            </div>
            <div class="m-3 row" v-if="item.jmlPeserta!==''">
                <div class="text-left col-4 bg-slate-300">Jumlah Peserta</div>
                <div class="bg-red-600 col-8 text-end">@{{item.jmlPeserta}}</div>
            </div>
        </div>
        <div class="m-3 row" v-if="infoData.sn!==''">
            <div class="text-left col-4 bg-slate-300">SN</div>
            <div class="bg-red-600 col-8 text-end">@{{infoData.sn}}</div>
        </div>
        <div class="m-3 row" v-if="resData.productPrice!==''">
            <div class="text-left col-4 bg-slate-300">Harga</div>
            <div class="bg-red-600 col-8 text-end">@{{resData.productPrice}}</div>
        </div>
        <div class="m-3 row" v-if="resData.productAdminFee!==''">
            <div class="text-left col-4 bg-slate-300">Biaya Admin</div>
            <div class="bg-red-600 col-8 text-end">@{{resData.productAdminFee}}</div>
        </div>
        <div class="m-3">
            <hr>
        </div>
        <div class="m-3 row" v-if="resData.transactionTotalAmount!==''">
            <div class="text-left col-4 bg-slate-300">Total</div>
            <div class="bg-red-600 col-8 text-end">@{{resData.transactionTotalAmount}}</div>
        </div>
        </div>
        <div class="" style="justify-content:center;margin-left: 50px;margin-right:50px;margin-bottom:50px;margin-top:25px;border-top:1px">
            {{-- @if (mainData.statusCode=="00") --}}
            <button type="button"  class="btn btn-primary btn-lg justify" style="width: 100%">Bagikan</button>
            {{-- @else
            <button type="button"  class="btn btn-success btn-lg justify" style="width: 100%" click="backHome">Home</button>
            @endif --}}
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('customScript')

    <script>
        const{createApp, ref,onMounted,nextTick }=Vue;

        createApp({
            setup(){
                const pagePayment=ref(false);
                const mainData=ref(@json($response));
                const resData=ref({});
                const infoData=ref({});
                const infoDescData=ref({});
                const details=ref({});
                const additionalData=ref({
                    gifTrx:'',
                    statusTrx:'',
                })
                const backHome=()=>{
                    setTimeout(() => { window.location.href = "{{ route('mobile.home') }}"; }, 100);
                }
                const dataPayment=()=>{
                    pagePayment.value=true;
                    console.log(mainData.value.result);
                    resData.value=mainData.value.result;
                    infoData.value=resData.value.billInfo;
                    infoDescData.value=infoData.value.billDesc;
                    details.value=infoDescData.value.detail;
                    switch (mainData.value.statusCode) {
                        case "00":
                        additionalData.value.gifTrx="/assets/img/success.gif";
                        additionalData.value.statusTrx=mainData.value.statusMessage;
                            break;
                        case "09":
                        additionalData.value.gifTrx="/assets/img/failed.gif";
                        additionalData.value.statusTrx=mainData.value.statusMessage;
                            break;
                        default:
                        additionalData.value.gifTrx="/assets/img/pending.gif";
                        additionalData.value.statusTrx=mainData.value.statusMessage;
                            break;
                    }
                }
                onMounted(() => {
                    dataPayment();
                    });

                return{
                    resData,
                    infoData,
                    infoDescData,
                    details,
                    backHome,
                    additionalData,
                    pagePayment,
                    dataPayment,
                    mainData,
                };
            }
        }).mount("#app");
    </script>
@endsection