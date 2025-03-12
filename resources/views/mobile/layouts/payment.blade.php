<div class="content-center bg-slate-200 multi-collapse payment-modal" v-show="form.pagePayment"
id="collapsePayment">
    <div class="" style="height:100px">
            <img src="/assets/img/verified.gif" class="img-icon" style="" alt="" sizes="" srcset="">
    </div>
    <h1 class="text-center header-payment">SUCCESS</h1>
    <h2 class=" page-confirm">Pulsa Telkomsel 15K</h2>
    <h4 class=" page-confirm">Rp 15.000</h4>
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
    <div class=" bt-nav" style="margin-left: 50px;margin-right:50px;">
        <div class="">
            <button type="button"  class="btn btn-primary btn-lg justify" style="width: 100%">Bagikan</button>
        </div>
    </div>
    
</div>