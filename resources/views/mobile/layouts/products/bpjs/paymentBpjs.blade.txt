<div class="content-center bg-slate-200 multi-collapse payment-modal " style="width: 100%;padding-bottom:50px" v-show="form.pagePayment"
id="collapsePayment" >
    <div class="mt-4" style="height:75px" >
            <img  :src="gifTrx" class="img-icon" style="" alt="" sizes="" srcset="">
    </div>
    <h1 class="text-center header-payment">@{{statusTrx}}</h1>
    <h2 class=" page-confirm" v-if="formInquiry.productName!==''">@{{formInquiry.productName}}</h2>
    <h4 class=" page-confirm" v-if="formInquiry.transactionTotalAmount!==''">@{{formInquiry.transactionTotalAmount}}</h4>
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
    <div class="m-3 row" v-if="formInquiry.customerName!==''">
        <div class="text-left col-4 bg-slate-300">Name Cust ww</div>
        <div class="bg-red-600 col-8 text-end">@{{formInquiry.customerName}}</div>
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
    <div class="m-3 row" v-if="formInquiry.sn!==''">
        <div class="text-left col-4 bg-slate-300">SN</div>
        <div class="bg-red-600 col-8 text-end">@{{formInquiry.sn}}</div>
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
    <div class="m-3 row" v-if="formInquiry.transactionTotalAmount!==''">
        <div class="text-left col-4 bg-slate-300">Total</div>
        <div class="bg-red-600 col-8 text-end">@{{formInquiry.transactionTotalAmount}}</div>
    </div>
    <div class=" bt-nav" style="margin-left: 50px;margin-right:50px;">
        <div class="">
            <button type="button"  class="btn btn-primary btn-lg justify" style="width: 100%">Bagikan</button>
        </div>
    </div>
</div>