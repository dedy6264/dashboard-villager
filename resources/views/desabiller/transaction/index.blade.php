@extends('app')
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
                            <th>Reference Number</th>
                            <th>Provider Reference Number</th>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Product Provider Name</th>
                            <th>Product Provider Code</th>
                            <th>Status Code</th>
                            <th>Status Message</th>
                            <th>Status Desc</th>
                            <th>Status Code Detail</th>
                            <th>Status Message Detail</th>
                            <th>Status Desc Detail</th>
                            <th>Product Provider Price</th>
                            <th>Product Provider Admin Fee</th>
                            <th>Product Provider Merchant Fee</th>
                            <th>Product Price</th>
                            <th>Product Admin Fee</th>
                            <th>Product Merchant Fee</th>
                            <th>Product Category Id</th>
                            <th>Product Category Name</th>
                            <th>Product Type Id</th>
                            <th>Product Type Name</th>
                            <th>Product Reference Id</th>
                            <th>Product Reference Code</th>
                            <th>Customer Id</th>
                            <th>Other Reff</th>
                            <th>Other Customer Info</th>
                            <th>Saving Account Name</th>
                            <th>Saving Account Id</th>
                            <th>Saving Account Number</th>
                            <th>Transaction Total Amount</th>
                            <th>Username</th>
                            <th>Created By</th>
                            <th>Updated By</th> 
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
                        url: '{{route('trxs.getAll')}}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        dataSrc: function (json) {
                            mainData.value = json.data; // simpan ke Vue
                            // console.log(json.data);
                            return json.data;           // kembalikan ke DataTable
                        },
                    },
                    columns: [
                        {data:'index'},
                        {data:'createdAt'},
                        {data:'updatedAt'},
                        {data:'referenceNumber'},
                        {data:'providerReferenceNumber'},
                        {data:'productName'},
                        {data:'productCode'},
                        {data:'productProviderName'},
                        {data:'productProviderCode'},
                        {data:'statusCode'},
                        {data:'statusMessage'},
                        {data:'statusDesc'},
                        {data:'statusCodeDetail'},
                        {data:'statusMessageDetail'},
                        {data:'statusDescDetail'},
                        {data:'productProviderPrice'},
                        {data:'productProviderAdminFee'},
                        {data:'productProviderMerchantFee'},
                        {data:'productPrice'},
                        {data:'productAdminFee'},
                        {data:'productMerchantFee'},
                        {data:'productCategoryId'},
                        {data:'productCategoryName'},
                        {data:'productTypeId'},
                        {data:'productTypeName'},
                        {data:'productReferenceId'},
                        {data:'productReferenceCode'},
                        {data:'customerId'},
                        {data:'otherReff'},
                        {data:'otherCustomerInfo'},
                        {data:'savingAccountName'},
                        {data:'savingAccountId'},
                        {data:'savingAccountNumber'},
                        {data:'transactionTotalAmount'},
                        {data:'username'},
                        {data:'createdBy'},
                        {data:'updatedBy'},
                        
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