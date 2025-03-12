@extends('mobile.app')
@section('style')
<style>
     .img-icon{
            display: block;
            margin: auto;
            width: 50%;
    
        }
    .loading{
        visibility: hidden;
    }
</style>
@endsection
@section('home')
<div class="content-center m-4 bg-white" style="margin-bottom: 50%; margin-top:50%;display: flex;justify-content: center;  align-items: center;  height: calc(100vh - 50px); ">
    <img class="d-flex justify-content-center align-items-center img-icon"  src="/assets/img/protection.gif" alt="" sizes="" srcset="" >
</div>
@endsection
@section('customScript')
    <script>
        const{createApp, ref,onMounted,nextTick }=Vue;
        createApp({
            setup(){
                const mainData=ref(@json($mainData));
                const refreshData=()=>{
                    const userData = { token: mainData.value.token };
                    if(mainData.value.endpoint==="home"){
                        if(localStorage.getItem("user")===null){
                            localStorage.setItem("user", JSON.stringify(userData));
                        }else{
                            localStorage.removeItem("user");
                            localStorage.setItem("user", JSON.stringify(userData));
                        }
                        setTimeout(() => { window.location.href = "{{ route('mobile.home') }}"; }, 2000);
                    }else{
                        localStorage.removeItem("user");
                        setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 2000);
                    }
                    // console.log(mainData.value);
                    // axios.post('{{route('clients.store')}}');
                }
                onMounted(() => {
                    refreshData();
                    });

                return{
                    mainData,
                    refreshData,
                };
            }
        }).mount("#app");
    </script>
@endsection