
<div v-if="form.pageInq" class="modal fade show"  id="exampleModal" style="display: block;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('mobile.payment') }}" method="post">
            @csrf
        <div class="modal-body modal-dialog modal-dialog-scrollable">
                <input type="hidden" name="token" :value="formInquiry.token"> 
                <input type="hidden" name="referenceNumber" :value="formInquiry.referenceNumber"> 
                
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
                <div class="m-3 row" v-if="billDesc.subscriberName!==''">
                    <div class="text-left col-4 bg-slate-300">Nama Cust</div>
                    <div class="bg-red-600 col-8 text-end">@{{billDesc.subscriberName}}</div>
                </div>
                

                <div class="m-3 row" v-if="billDesc.meterNo!==''">
                    <div class="text-left col-4 bg-slate-300">No Meter</div>
                    <div class="bg-red-600 col-8 text-end">@{{billDesc.meterNo}}</div>
                </div>
                <div  v-if="billDesc.detail" v-for="item, index in billDesc.detail" :key="index">
                    <div class="m-3 row" v-if="item.tarif!==''">
                        <div class="text-left col-4 bg-slate-300">Tarif</div>
                        <div class="bg-red-600 col-8 text-end">@{{item.tarif}}</div>
                    </div>
                    <div class="m-3 row" v-if="item.daya!==''">
                        <div class="text-left col-4 bg-slate-300">Daya</div>
                        <div class="bg-red-600 col-8 text-end">@{{item.daya}} Va</div>
                    </div>
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
                {{-- <div class=" bt-nav" style="margin-left: 50px;margin-right:50px;margin-bottom:50px;margin-top:25px">
                    <div class="row" v-if="statusCode==='10'">
                        <div class="col-6">
                            <button type="button"  class="ml-4 mr-4 btn btn-lg justify btn-danger" style="width: 100%" @click="inqCancel">Batal</button>
                        </div>
                        <div class="col-6">
                            <button type="submit"  class="ml-4 mr-4 btn btn-primary btn-lg justify" style="width: 100%" >Lanjutkan</button>
                        </div>
                    </div>
                    <div v-else >
                        <div class="col-12">
                            <button type="button"  class="ml-4 mr-4 btn btn-lg justify btn-danger" style="width: 100%" @click="inqCancel">Kembali</button>
                        </div>
                    </div>
                </div> --}}
           
        </div>
        <div class="" style="justify-content:center;margin-left: 50px;margin-right:50px;margin-bottom:25px;margin-top:25px;border-top:1px">
            <div class="row" v-if="statusCode==='10'">
                <div class="col-6">
                    <button type="button"  class="ml-4 mr-4 btn btn-lg justify btn-danger" style="width: 100%" @click="inqCancel">Batal</button>
                    {{-- <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="closeBtn">Close</button> --}}
                </div>
                <div class="col-6">
                    <button type="submit"  class="ml-4 mr-4 btn btn-primary btn-lg justify" style="width: 100%" >Lanjutkan</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
            <div v-else >
                <div class="col-12">
                    <button type="button"  class="ml-4 mr-4 btn btn-lg justify btn-danger" style="width: 100%" @click="inqCancel">Kembali</button>
                </div>
            </div>
        </div>
    </form>
      </div>
    </div>
  </div>