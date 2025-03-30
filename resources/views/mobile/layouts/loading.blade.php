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
@section('content')
<div class="content-center m-4 bg-white" style="margin-bottom: 50%; margin-top:50%;display: flex;justify-content: center;  align-items: center;  height: calc(100vh - 50px); ">
    <img class="d-flex justify-content-center align-items-center img-icon"  src="/assets/img/protection.gif" alt="" sizes="" srcset="" >
</div>
@endsection
@section('customScript')
    <script>
        const{createApp, ref,onMounted,nextTick }=Vue;
        createApp({
            setup(){
                const suggestData=ref(@json($suggestData));
                const refreshData=()=>{
                    switch (suggestData.value.cmd) {
                        case 'destroy':
                            localStorage.removeItem("user");
                            setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 2000);
                            break;
                        case 'set':
                            localStorage.removeItem("user");
                            const userData = { token: suggestData.value.token };
                            localStorage.setItem("user", JSON.stringify(userData));
                            setTimeout(() => { window.location.href = "{{ route('mobile.home') }}"; }, 2000);
                            break;
                        default:
                            localStorage.removeItem("user");
                            setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 2000);
                            break;
                    }


                    // const userData = { token: suggestData.value.token };
                    // if(suggestData.value.endpoint==="home"){
                    //     if(localStorage.getItem("user")===null){
                    //         localStorage.setItem("user", JSON.stringify(userData));
                    //     }else{
                    //         localStorage.removeItem("user");
                    //         localStorage.setItem("user", JSON.stringify(userData));
                    //     }
                    //     setTimeout(() => { window.location.href = "{{ route('mobile.home') }}"; }, 2000);
                    // }else{
                    //     localStorage.removeItem("user");
                    //     setTimeout(() => { window.location.href = "{{ route('mobile.login') }}"; }, 2000);
                    // }
                    // console.log(suggestData.value);
                    // axios.post('{{route('clients.store')}}');
                }
                onMounted(() => {
                    refreshData();
                    });

                return{
                    suggestData,
                    refreshData,
                };
            }
        }).mount("#app");
    </script>
@endsection