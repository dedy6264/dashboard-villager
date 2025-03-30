
{{-- modals inquiry --}}
<div v-show="form.pageInq" class=" bottom-nav multi-collapse" id="collapseInquiry" style="width:100%;border-radius:50px;background-color:#03a1fc">
    <div class="mt-4" v-if="gifTrx!==''">
        <img  :src="gifTrx" class="img-icon" style="" alt="" sizes="" srcset="">
    </div>
    <p class="mt-2 mb-5 page-confirm" v-if="statusTrx" >@{{statusTrx}}</h5>
    <h2 class="mt-2 mb-5 page-confirm" >@{{formInquiry.productName}}</h2>
    <div class="m-3 row" v-if="formInquiry.referenceNumber!==''">
        <div class="text-left col-4 bg-slate-300">No Reff</div>
        <div class="bg-red-600 col-8 text-end">@{{formInquiry.referenceNumber}}</div>
    </div>
    <div class="m-3 row" v-if="formInquiry.createdAt!==''">
        <div class="text-left col-4 bg-slate-300">Datetime</div>
        <div class="bg-red-600 col-8 text-end">@{{formInquiry.createdAt}}</div>
    </div>
    <div class="m-3 row" v-if="formInquiry.customerId!==''">
        <div class="text-left col-4 bg-slate-300">No Cust</div>
        <div class="bg-red-600 col-8 text-end">@{{formInquiry.customerId}}</div>
    </div>
    <div class="m-3 row" v-if="formInquiry.productPrice!==''">
        <div class="text-left col-4 bg-slate-300">Harga</div>
        <div class="bg-red-600 col-8 text-end">@{{formInquiry.productPrice}}</div>
    </div>
    <div class="m-3 row" v-if="formInquiry.productAdminFee!==''">
        <div class="text-left col-4 bg-slate-300">Biaya Admin</div>
        <div class="bg-red-600 col-8 text-end">@{{formInquiry.productAdminFee}}</div>
    </div>
    <div class="m-3">
        <hr>
    </div>
    <div class="m-3 row" v-if="formInquiry.totalTrxAmount!==''">
        <div class="text-left col-4 bg-slate-300">Total</div>
        <div class="bg-red-600 col-8 text-end">@{{formInquiry.totalTrxAmount}}</div>
    </div>
    <div class=" bt-nav" style="margin-left: 50px;margin-right:50px;margin-bottom:50px;margin-top:25px">
        <div class="row">
            <div class="col-6">
                <button type="button"  class="ml-4 mr-4 btn btn-lg justify btn-danger" style="width: 100%" @click="inqCancel">Batal</button>
            </div>
            <div class="col-6">
                <button type="button"  class="ml-4 mr-4 btn btn-primary btn-lg justify" style="width: 100%" @click="payment()">Lanjutkan</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal inquiry --}}