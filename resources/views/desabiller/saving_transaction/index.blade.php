@extends('app')
@php
    $activePage = 'saving_transaction';
@endphp
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Saving</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Saving \ Saving Transaction</li>
        </ol>
       
        <div class="mb-4 card">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="dataTbl">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>No Reff</th>
                            <th>Account Number</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Transaction Type</th>
                            <th>Transaction Code</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="mainData" v-for="item, index in mainData" :key="index">
                            <td>
                                <div class="row">
                                    <div class="col-md-2">
                                        <button type="button" class="shadow-sm d-sm-inline-block btn btn-sm btn-success" @click="updateModal(item.id)"><i class="fas fa-edit fa-sm text-white-50"></i></button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="shadow-sm d-sm-inline-block btn btn-sm btn-danger" @click="deleteData(item.id)"><i class="fas fa-minus fa-sm text-white-50"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td v-text="item.referenceNumber"></td>
                            <td v-text="item.accountNumber"></td>
                            <td v-text="item.transactionAmount"></td>
                            <td v-text="item.lastBalance"></td>
                            <td v-text="item.dcType"></td>
                            <td v-text="item.transactionCode"></td>
                            <td v-text="item.createdAt"></td>
                            <td v-text="item.updatedAt"></td>
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
            const mainData=ref([])
            const filter=ref({
                        id:0,
                        savingSegmentName:"",
                        limitAmount:0,
                        savingTypeName:"",
                        savingTypeId:0,
                })
           
            const refreshData=()=>{
                axios.post('{{route('savingTransaction.getAll')}}')
                .then(response => {
                    $('#dataTbl').DataTable().destroy();
                    mainData.value=response.data.data;
                    nextTick( () => {
                        $('#dataTbl').DataTable({
                            responsive: true,
                            autoWidth: false
                        });
                     });
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    if (error.response) {
                        this.errorMessage = error.response.data.message;
                        this.successMessage = '';  // Reset success jika ada
                    }
                });
            }
          
            onMounted(() => {
                refreshData();
                });

            return{
              
                mainData,
                filter,
                
                refreshData,
            };
        }
    }).mount("#app");
</script>
@endsection