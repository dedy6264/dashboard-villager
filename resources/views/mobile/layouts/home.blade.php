@extends('mobile.app')
@section('home')
<div class=" sb-topnav navbar-expand navbar-dark fixed-top" style="z-index: -1;margin-top:4rem" >
    <div class="container card-name" >
        <div class="row">
            <div class="col-2">
                <div class="media">
                    <img src="/assets/img/dev.png" class="mr-3 " style="width: 50px;border-radius:30px" alt="...">
                </div>
            </div>
            <div class="col-5">
                <p class="text-mobile" id="namaUser">Selamat Sore</p>
                <h6 class="text-mobile">@{{outletName}}</h6>
            </div>
            <div class=" col-5">
                <p class=" text-mobile" style="text-align: right;padding-right:10px">Saldo</p>
                <h6 class=" text-mobile" style="text-align: right;padding-right:10px">Rp 20.000.000</h6>
            </div>
        </div>
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
<!-- Carousel -->
<div id="promoCarousel" class=" carousel slide content-section promo-carousel" data-bs-ride="carousel" >
    <div class="carousel-inner ">
        <div class="carousel-item active">
            <img src="{{url('/assets/img/1.png')}}" class="d-block w-100" alt="Promo 1">
        </div>
        <div class="carousel-item">
            <img src="{{url('/assets/img/2.png')}}" class="d-block w-100" alt="Promo 2">
        </div>
        <div class="carousel-item">
            <img src="{{url('/assets/img/3.png')}}" class="d-block w-100" alt="Promo 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>
<div class="container bg-white">
    <!-- Produk -->
    <div class="py-4 mt-0 mb-0 content-section" >
        <div class="text-center row g-2">
            <div class="col-4 ">
                <div class="">
                    <button class="btn service-card " style="background-color: #81d0fd" type="submit">
                        {{-- <img src="https://via.placeholder.com/50" alt="Icon" class="img-fluid"> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                        </svg>
                    </button>
                    <div>Pln Token</div>  
                </div>
            </div>
            <div class="col-4">
                <div class="">
                    <a href="{{route('mobile.pulsa-pra')}}" class="btn service-card " style="background-color: #81d0fd" type="submit">
                        {{-- <img src="https://via.placeholder.com/50" alt="Icon" class="img-fluid"> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                        </svg>
                    </a>
                    <div>Pulsa</div>
                </div>
            </div>
            <div class="col-4">
                <div class="">
                    <button class="btn service-card " style="background-color: #81d0fd" type="submit">
                    {{-- <img src="https://via.placeholder.com/50" alt="Icon" class="img-fluid"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-dpad" viewBox="0 0 16 16">
                        <path d="m7.788 2.34-.799 1.278A.25.25 0 0 0 7.201 4h1.598a.25.25 0 0 0 .212-.382l-.799-1.279a.25.25 0 0 0-.424 0Zm0 11.32-.799-1.277A.25.25 0 0 1 7.201 12h1.598a.25.25 0 0 1 .212.383l-.799 1.278a.25.25 0 0 1-.424 0ZM3.617 9.01 2.34 8.213a.25.25 0 0 1 0-.424l1.278-.799A.25.25 0 0 1 4 7.201V8.8a.25.25 0 0 1-.383.212Zm10.043-.798-1.277.799A.25.25 0 0 1 12 8.799V7.2a.25.25 0 0 1 .383-.212l1.278.799a.25.25 0 0 1 0 .424Z"/>
                        <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v3a.5.5 0 0 1-.5.5h-3A1.5 1.5 0 0 0 0 6.5v3A1.5 1.5 0 0 0 1.5 11h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 6.5 16h3a1.5 1.5 0 0 0 1.5-1.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 16 9.5v-3A1.5 1.5 0 0 0 14.5 5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 9.5 0zM6 1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 11.5 6h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a1.5 1.5 0 0 0-1.5 1.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 4.5 10h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 6 4.5z"/>
                    </svg>
                    </button>
                </div>
                <div>ABCD</div>
            </div>
            <div class="col-4">
                <div class="">
                    <button class="btn service-card " style="background-color: #81d0fd" type="submit">
                    {{-- <img src="https://via.placeholder.com/50" alt="Icon" class="img-fluid"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-dpad" viewBox="0 0 16 16">
                        <path d="m7.788 2.34-.799 1.278A.25.25 0 0 0 7.201 4h1.598a.25.25 0 0 0 .212-.382l-.799-1.279a.25.25 0 0 0-.424 0Zm0 11.32-.799-1.277A.25.25 0 0 1 7.201 12h1.598a.25.25 0 0 1 .212.383l-.799 1.278a.25.25 0 0 1-.424 0ZM3.617 9.01 2.34 8.213a.25.25 0 0 1 0-.424l1.278-.799A.25.25 0 0 1 4 7.201V8.8a.25.25 0 0 1-.383.212Zm10.043-.798-1.277.799A.25.25 0 0 1 12 8.799V7.2a.25.25 0 0 1 .383-.212l1.278.799a.25.25 0 0 1 0 .424Z"/>
                        <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v3a.5.5 0 0 1-.5.5h-3A1.5 1.5 0 0 0 0 6.5v3A1.5 1.5 0 0 0 1.5 11h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 6.5 16h3a1.5 1.5 0 0 0 1.5-1.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 16 9.5v-3A1.5 1.5 0 0 0 14.5 5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 9.5 0zM6 1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 11.5 6h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a1.5 1.5 0 0 0-1.5 1.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 4.5 10h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 6 4.5z"/>
                    </svg>
                    </button>
                    <div>ABCD</div>
                </div>
            </div>
            <div class="col-4">
                <div class="">
                    <button class="btn service-card " style="background-color: #81d0fd" type="submit">
                    {{-- <img src="https://via.placeholder.com/50" alt="Icon" class="img-fluid"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-dpad" viewBox="0 0 16 16">
                        <path d="m7.788 2.34-.799 1.278A.25.25 0 0 0 7.201 4h1.598a.25.25 0 0 0 .212-.382l-.799-1.279a.25.25 0 0 0-.424 0Zm0 11.32-.799-1.277A.25.25 0 0 1 7.201 12h1.598a.25.25 0 0 1 .212.383l-.799 1.278a.25.25 0 0 1-.424 0ZM3.617 9.01 2.34 8.213a.25.25 0 0 1 0-.424l1.278-.799A.25.25 0 0 1 4 7.201V8.8a.25.25 0 0 1-.383.212Zm10.043-.798-1.277.799A.25.25 0 0 1 12 8.799V7.2a.25.25 0 0 1 .383-.212l1.278.799a.25.25 0 0 1 0 .424Z"/>
                        <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v3a.5.5 0 0 1-.5.5h-3A1.5 1.5 0 0 0 0 6.5v3A1.5 1.5 0 0 0 1.5 11h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 6.5 16h3a1.5 1.5 0 0 0 1.5-1.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 16 9.5v-3A1.5 1.5 0 0 0 14.5 5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 9.5 0zM6 1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 11.5 6h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a1.5 1.5 0 0 0-1.5 1.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 4.5 10h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 6 4.5z"/>
                    </svg>
                    </button>
                    <div>ABCD</div>
                </div>
            </div>
            <div class="col-4">
                <div class="">
                    <button class="btn service-card " style="background-color: #81d0fd" type="submit">
                    {{-- <img src="https://via.placeholder.com/50" alt="Icon" class="img-fluid"> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" class="bi bi-dpad" viewBox="0 0 16 16">
                        <path d="m7.788 2.34-.799 1.278A.25.25 0 0 0 7.201 4h1.598a.25.25 0 0 0 .212-.382l-.799-1.279a.25.25 0 0 0-.424 0Zm0 11.32-.799-1.277A.25.25 0 0 1 7.201 12h1.598a.25.25 0 0 1 .212.383l-.799 1.278a.25.25 0 0 1-.424 0ZM3.617 9.01 2.34 8.213a.25.25 0 0 1 0-.424l1.278-.799A.25.25 0 0 1 4 7.201V8.8a.25.25 0 0 1-.383.212Zm10.043-.798-1.277.799A.25.25 0 0 1 12 8.799V7.2a.25.25 0 0 1 .383-.212l1.278.799a.25.25 0 0 1 0 .424Z"/>
                        <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v3a.5.5 0 0 1-.5.5h-3A1.5 1.5 0 0 0 0 6.5v3A1.5 1.5 0 0 0 1.5 11h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 6.5 16h3a1.5 1.5 0 0 0 1.5-1.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 16 9.5v-3A1.5 1.5 0 0 0 14.5 5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 9.5 0zM6 1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3A1.5 1.5 0 0 0 11.5 6h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a1.5 1.5 0 0 0-1.5 1.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3A1.5 1.5 0 0 0 4.5 10h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 0 6 4.5z"/>
                    </svg>
                    </button>
                    <div>ABCD</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Last Transaction -->
    <div class="py-4 mt-0 content-section" style="margin-bottom: 50px">
        <div class="card">
            <h6 class="card-header">Last Transaction</h6>
            <div class="card-body">
            <p class="card-text">Pulsa Telkomsel 10.000 / 082137789378</p>
            {{-- <small>082137789378</small> --}}
            <footer class="blockquote-footer">14-02-2025 11:10:20 <cite title="Source Title">WIB</cite></footer>
            <button disabled="disabled" class="btn btn-success btn-sm">Success</button>
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
                const outletName=ref();
                const outletId=ref();
                const merchantId=ref();
                const refreshData=()=>{
                    axios.post('{{route('mobile.validate')}}',{},{
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
                        // setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 1000);
                        }
                    });
                };
                const checkUser=()=>{
                    if(localStorage.getItem("user")==null){
                        setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 1000);
                    }
                }
                onMounted(() => {
                    checkUser();
                    refreshData();
                    });

                return{
                    checkUser,
                    outletName,
                    refreshData,
                };
            }
        }).mount("#app");
    </script>
@endsection