@extends('app')
@php
    $activePage = 'saving_segment';
@endphp
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Saving</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Saving \ Saving Segment</li>
        </ol>
        <div class="mb-4 card">
            <div class="card-body">
                <button type="button" class="btn btn-primary"  @click="createModal()">Add</button>
            </div>
        </div>
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
                            <th>Segment Type Name</th>
                            <th>Limit Amount</th>
                            <th>Saving Type</th>
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
                            <td v-text="item.savingSegmentName"></td>
                            <td v-text="item.limitAmount"></td>
                            <td v-text="item.savingTypeName"></td>
                            <td v-text="item.createdAt"></td>
                            <td v-text="item.updatedAt"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--modal-->
        <div class="modal fade" id="dataModal" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="dataModalLabel" >@{{ (editMode?'Edit Client':'Tambah Client')}}</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="editMode ? updateData() : createData()" >
                    <div class="row">
                        <div class="col-lg-6">
                             <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Saving Segment Name</label>
                                  <input type="text"  class="form-control" v-model="form.savingSegmentName" aria-describedby="emailHelp" placeholder="Client Abc.." autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                             <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Limit Amount</label>
                                  <input type="number"  class="form-control" v-model="form.limitAmount" aria-describedby="emailHelp" placeholder="Client Abc.." autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                             <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Saving Type </label>
                                <select class="form-control" v-model="form.savingTypeId">
                                    <option v-for="item in savingType" 
                                            :key="item.id" 
                                            :value="item.id">
                                        @{{ item.savingTypeName }}
                                    </option>
                                </select>
                                
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save</button>
                    </div>
                    </div>
                </form>
              </div>
            </div>
        </div>
        <!--endmodal-->
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
            const savingType=ref(@json($savingType));
            const form=ref({
                id:0,
                savingSegmentName:"",
                limitAmount:0,
                savingTypeName:"",
                savingTypeId:0,
            })
            const editMode=ref(false);
            const createModal=()=>{
                editMode.value=false;
                form.value.savingSegmentName='';
                form.value.limitAmount=0;
                form.value.savingTypeName='';
                form.value.savingTypeId=0;
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            form.value.savingSegmentName=data.savingSegmentName;
                            form.value.limitAmount=data.limitAmount;
                            form.value.savingTypeName=data.savingTypeName;
                            form.value.savingTypeId=data.savingTypeId;
                        }
                    });
                    $('#dataModal').modal('show')
            }
           
            const createData=()=>{
                // console.log("createData",form.value.client_name);
                axios.post('{{route('savingSegment.store')}}', {
                    savingSegmentName: form.value.savingSegmentName,
                    limitAmount: form.value.limitAmount,
                    savingTypeName: form.value.savingTypeName,
                    savingTypeId: form.value.savingTypeId,
                })
                .then(response => {
                    $('#dataModal').modal('hide');
                    refreshData();
                })
                .catch(error => {
                    if (error.response) {
                        this.errorMessage = error.response.data.message;
                        this.successMessage = '';  // Reset success jika ada
                    }
                });
            };
            const updateData=()=>{
                axios.post('{{route('savingSegment.update')}}',{
                    savingSegmentName:form.value.savingSegmentName,
                    limitAmount:form.value.limitAmount,
                    savingTypeName:form.value.savingTypeName,
                    savingTypeId:form.value.savingTypeId,
                    id:form.value.id,
                })
                .then(response => {
                    $('#dataModal').modal('hide');
                    refreshData();
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    if (error.response) {
                        this.errorMessage = error.response.data.message;
                        this.successMessage = '';  // Reset success jika ada
                    }
                });
            };
            const refreshData=()=>{
                axios.post('{{route('savingSegment.getAll')}}')
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
            const deleteData=(id)=>{
                axios.get(`{{route('savingSegment.destroy','')}}/${id}`)
                .then(response => {
                    refreshData();
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
                savingType,
                deleteData,
                updateModal,
                updateData,
                createData,
                createModal,
                editMode,
                mainData,
                filter,
                form,
                refreshData,
            };
        }
    }).mount("#app");
</script>
@endsection