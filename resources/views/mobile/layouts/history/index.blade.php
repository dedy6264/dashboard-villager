@extends('mobile.app')
@section('content')
<!-- Last Transaction -->
<div class="" style="margin-bottom:10px;margin-top:100px;border-radius:30px 30px 0px 0px; background-color:cadetblue">
    <div class="container py-4 mt-0 " style="margin-bottom: 50px">
        <div class="mb-4 card" v-if="mainData" v-for="item, index in mainData" :key="index">
            {{-- <h6 class="card-header">Last Transaction</h6> --}}
            <div class=" card-body" @click="checkTrx(item.statusCode, item.referenceNumber)">
            <p class="card-text">@{{ item.productName }} / @{{item.customerId}}</p>
            {{-- <small>082137789378</small> --}}
            <footer class="blockquote-footer">@{{ item.referenceNumber }} | <cite title="Source Title">@{{ item.createdAt }} </cite></footer>
            <button :disabled="item.statusCode!='00'?'disabled':''" class="btn btn-sm" :class="item.statusCode=='00'?'btn-success':'btn-warning'">@{{item.statusMessage}}</button>
            </div>
        </div>
        <button @click="getTrx()" class="btn btn-sm btn-primary">Next</button>
    </div>
</div>
{{-- top navigation --}}
<div class=" sb-topnav navbar navbar-expand navbar-dark fixed-top bt-nav" >
    <div class="container">
        <div class="row">
            <div class="col-12">
                <input type="text" class="form-control" placeholder="Search">
            </div>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
            </svg>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-airplane" viewBox="0 0 16 16">
                <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849m.894.448C7.111 2.02 7 2.569 7 3v4a.5.5 0 0 1-.276.447l-5.448 2.724a.5.5 0 0 0-.276.447v.792l5.418-.903a.5.5 0 0 1 .575.41l.5 3a.5.5 0 0 1-.14.437L6.708 15h2.586l-.647-.646a.5.5 0 0 1-.14-.436l.5-3a.5.5 0 0 1 .576-.411L15 11.41v-.792a.5.5 0 0 0-.276-.447L9.276 7.447A.5.5 0 0 1 9 7V3c0-.432-.11-.979-.322-1.401C8.458 1.159 8.213 1 8 1s-.458.158-.678.599"/>
            </svg>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
            </svg>
        </div>
    </div>
</div>
@include('mobile.layouts.history.payment')
@endsection
@section('customScript')
    <script>
        const{createApp, ref,onMounted,nextTick }=Vue;

        createApp({
            setup(){
                const mainData=ref({});
                const dataTrx=ref({});
                const outletName=ref();
                const outletId=ref();
                const merchantId=ref();
                const size=ref(0);
                const pagePayment=ref(false);
                const checkTrx=(statusCode,referenceNumber)=>{
                    console.log(statusCode, referenceNumber);
                    switch (statusCode) {
                        case "00"://get trx
                            axios.post("{{route('mobile.history.get-trx')}}",{
                                    referenceNumber:referenceNumber,
                                },{
                                        headers: {
                                            Authorization: `Bearer ${JSON.parse(localStorage.getItem("user")).token}`,
                                        }
                                    })
                                .then(response => {
                                    console.log(response.data);
                                    dataTrx.value=response.data.data;
                                    pagePayment.value=true;
                                })
                                .catch(error => {
                                    console.error("Error fetching data:", error);
                                    if (error.response) {
                                        this.errorMessage = error.response.data.message;
                                        this.successMessage = '';  // Reset success jika ada
                                    // setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 1000);
                                    }
                                });
                            break;
                        case "05"://advice
                            axios.post("{{route('mobile.history.advice')}}",{
                                    referenceNumber:referenceNumber,
                                },{
                                        headers: {
                                            Authorization: `Bearer ${JSON.parse(localStorage.getItem("user")).token}`,
                                        }
                                    })
                                .then(response => {
                                    console.log(response.data);
                                    dataTrx.value=response.data.data;
                                    pagePayment.value=true;
                                })
                                .catch(error => {
                                    console.error("Error fetching data:", error);
                                    if (error.response) {
                                        this.errorMessage = error.response.data.message;
                                        this.successMessage = '';  // Reset success jika ada
                                    // setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 1000);
                                    }
                                });
                            break;
                        default:
                            break;
                    }
                };
                const refreshData=()=>{
                    console.log(JSON.parse(localStorage.getItem("user")).token);
                    axios.post("{{route('mobile.validate')}}",{},{
                            headers: {
                                Authorization: `Bearer ${JSON.parse(localStorage.getItem("user")).token}`,
                            }
                        })
                    .then(response => {
                        outletName.value=response.data.outletName;
                        outletId.value=response.data.outletId;
                        merchantId.value=response.data.merchantId;
                    })
                    .catch(error => {
                        console.error("Error fetching data:", error);
                        if (error.response) {
                            this.errorMessage = error.response.data.message;
                            this.successMessage = '';  // Reset success jika ada
                        setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 1000);
                        }
                    });
                };
                const checkUser=()=>{
                    if(localStorage.getItem("user")==null){
                        setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 1000);
                    }
                }
                const getTrx=(status)=>{
                    
                    console.log(size.value);
                    size.value=size.value+5;
                    console.log(size.value);
                    axios.post("{{route('mobile.history.get-trx')}}",{
                        size:size.value,
                    },{
                            headers: {
                                Authorization: `Bearer ${JSON.parse(localStorage.getItem("user")).token}`,
                            }
                        })
                    .then(response => {
                        if(status!==""){
                        
                        }
                        console.log(pagePayment.value);
                        mainData.value=response.data.data;
                        pagePayment.value=true;
                        console.log(pagePayment.value);
                    })
                    .catch(error => {
                        console.error("Error fetching data:", error);
                        if (error.response) {
                            this.errorMessage = error.response.data.message;
                            this.successMessage = '';  // Reset success jika ada
                        // setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 1000);
                        setTimeout(() => { window.location.href = "{{ route('mobileLoading') }}"; }, 1000);
                        }
                    });
                }
                onMounted(() => {
                    checkUser();
                    refreshData();
                    getTrx();
                    });

                return{
                    dataTrx,
                    pagePayment,
                    checkTrx,
                    mainData,
                    outletName,
                    outletId,
                    merchantId,
                    getTrx,
                    checkUser,
                    refreshData,
                };
            }
        }).mount("#app");
    </script>
@endsection