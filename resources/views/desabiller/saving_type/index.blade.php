@extends('app')
@php
    $activePage = 'saving_type';
@endphp
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Saving</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Saving \ Saving Types</li>
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
                            <th>Saving Type Name</th>
                            <th>Saving Type Desc</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="mainData" v-for="item, index in mainData" :key="index">
                            <td v-text="item.savingTypeName"></td>
                            <td v-text="item.savingTypeDesc"></td>
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
            const refreshData=()=>{
                axios.post('{{route('savingType.getAll')}}')
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
                refreshData,
            };
        }
    }).mount("#app");
</script>
@endsection