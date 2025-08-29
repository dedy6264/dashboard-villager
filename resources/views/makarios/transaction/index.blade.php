@extends('makarios.app')
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Transaction</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Transaction \ Transaction</li>
        </ol>
        {{-- <div class="mb-4 card">
            <div class="card-body">
                <button type="button" class="btn btn-primary"  @click="createModal()">Add</button>
            </div>
        </div> --}}
        <div class="mb-4 card">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="dataTbl">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                             <th>reference_number</th>
                            <th>reference_number_provider</th>
                            <th>reference_number_merchant</th>
                             <th>Status_code</th>
                            <th>Status_message</th>
                            <th>Status_desc</th>
                            <th>Status_code_detail</th>
                            <th>Status_message_detail</th>
                            <th>product_category_name</th>
                            <th>product_type_name</th>
                             <th>product_name</th>
                            <th>product_code</th>
                            <th>product_price</th>
                            <th>product_admin_fee</th>
                            <th>product_merchant_fee</th>
                            <th>provider_name</th>
                            <th>product_provider_name</th>
                            <th>product_provider_code</th>
                            <th>product_provider_price</th>
                            <th>product_provider_admin_fee</th>
                            <th>product_provider_merchant_fee</th>
                            <th>transaction_total_amount</th>

                            <th>Segment_name</th>
                           
                            <th>client_name</th>
                            <th>group_name</th>
                            <th>merchant_name</th>
                            <th>merchant_outlet_name</th>
                            <th>username</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr >
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
@section('customeScript')
<script>
    // import axios from "axios";

    const{createApp, ref,onMounted,nextTick }=Vue;

    createApp({
        setup(){
            const mainData=ref();
            const form=ref({
                id:0,
                segment_id:0,
                segment_name:"",
                product_reference_id:0,
                product_reference_name:"",
                product_reference_code:"",
                product_category_id:0,
                product_category_name:"",
                provider_id:0,
                provider_name:"",
                product_provider_id:0,
                product_provider_name:"",
                product_provider_code:"",
                product_provider_price:0,
                product_provider_admin_fee:0,
                product_provider_merchant_fee:0,
                product_type_id:0,
                product_type_name:"",
                product_id:0,
                product_name:"",
                product_code:"",
                product_price:0,
                product_admin_fee:0,
                product_merchant_fee:0,
                product_availability:"",
            })
            const refreshData=()=>{
                // $('#dataTbl').DataTable().destroy();
                $('#dataTbl').DataTable({
                    destroy: true,
                    responsive: true,
                    autoWidth: true,
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    ajax: {
                        url: '{{route('makarios.getdatatransaction')}}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        dataSrc: function (json) {
                            mainData.value = json.data; // simpan ke Vue
                            return json.data;           // kembalikan ke DataTable
                        },
                    },
                    columns: [
                        { data: 'id' },
                        { data: 'created_at' },
                        { data: 'updated_at' },
                         {data: 'reference_number'},
                        {data: 'reference_number_provider'},
                        {data: 'reference_number_merchant'},
                         {data: 'status_code'},
                        {data: 'status_message'},
                        {data: 'status_desc'},
                        {data: 'status_code_detail'},
                        {data: 'status_message_detail'},
                        {data: 'product_category_name'},
                        {data: 'product_type_name'},
                         {data: 'product_name'},
                        {data: 'product_code'},
                        {data: 'product_price'},
                        {data: 'product_admin_fee'},
                        {data: 'product_merchant_fee'},
                        {data: 'provider_name'},
                        {data: 'product_provider_name'},
                        {data: 'product_provider_code'},
                        {data: 'product_provider_price'},
                        {data: 'product_provider_admin_fee'},
                        {data: 'product_provider_merchant_fee'},
                        {data: 'transaction_total_amount'},
                        { data: 'segment_name' },
                        {data: 'client_name'},
                        {data: 'group_name'},
                        {data: 'merchant_name'},
                        {data: 'merchant_outlet_name'},
                        {data: 'username'},
                        
                    ]
                });
            }
            onMounted(() => {
                refreshData();
                });

            return{
                mainData,
                form,
                refreshData,
            };
        }
    }).mount("#app");
</script>
@endsection