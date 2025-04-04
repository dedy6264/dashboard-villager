<div class="content-center bg-slate-200 multi-collapse payment-modal" style="width: 100%;z-index:100" v-show="pagePayment"
id="collapsePayment" >
    <div class="mt-4" style="height:75px" >
            <img  src="" class="img-icon" style="" alt="" sizes="" srcset="">
    </div>
    <h1 class="text-center header-payment">@{{}}</h1>
    <h2 class=" page-confirm" v-if="dataTrx.productName!==''">@{{dataTrx.productName}}</h2>
    <h4 class=" page-confirm" v-if="dataTrx.totalTrxAmount!==''">@{{dataTrx.totalTrxAmount}}</h4>
    <div class="m-3 row" v-if="dataTrx.referenceNumber!==''">
        <div class="text-left col-4 bg-slate-300">No Reff</div>
        <div class="bg-red-600 col-8 text-end">@{{dataTrx.referenceNumber}}</div>
    </div>
    <div class="m-3 row" v-if="dataTrx.createdAt!==''">
        <div class="text-left col-4 bg-slate-300">Datetime</div>
        <div class="bg-red-600 col-8 text-end">@{{dataTrx.createdAt}}</div>
    </div>
    <div class="m-3 row" v-if="dataTrx.customerId!==''">
        <div class="text-left col-4 bg-slate-300">No Cust</div>
        <div class="bg-red-600 col-8 text-end">@{{dataTrx.customerId}}</div>
    </div>
    <div class="m-3 row" v-if="dataTrx.productPrice!==''">
        <div class="text-left col-4 bg-slate-300">Harga</div>
        <div class="bg-red-600 col-8 text-end">@{{dataTrx.productPrice}}</div>
    </div>
    <div class="m-3 row" v-if="dataTrx.productAdminFee!==''">
        <div class="text-left col-4 bg-slate-300">Biaya Admin</div>
        <div class="bg-red-600 col-8 text-end">@{{dataTrx.productAdminFee}}</div>
    </div>
    <div class="m-3">
        <hr>
    </div>
    <div class="m-3 row" v-if="dataTrx.totalTrxAmount!==''">
        <div class="text-left col-4 bg-slate-300">Total</div>
        <div class="bg-red-600 col-8 text-end">@{{dataTrx.totalTrxAmount}}</div>
    </div>
    <div class=" bt-nav" style="margin-left: 50px;margin-right:50px;">
        <div class="">
            <button type="button"  class="btn btn-primary btn-lg justify" style="width: 100%">Bagikan</button>
        </div>
    </div>
    <H1>hhhhhhhhh</H1>
</div>