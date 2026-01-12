@extends('app')
@php
    $activePage = 'cifs';
@endphp
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Customer Identifier File</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">User Apps \ CIFs</li>
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
                            <th>CIF Name</th>
                            <th>ID NO</th>
                            <th>ID Type</th>
                            <th>Email</th>
                            <th>Address</th>
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
                            <td v-text="item.cifName"></td>
                            <td v-text="item.cifNoId"></td>
                            <td v-text="item.cifTypeId"></td>
                            <td v-text="item.cifEmail"></td>
                            <td v-text="item.cifAddress"></td>
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
                                  <label for="exampleInputEmail1">CIF Name</label>
                                  <input type="text"  class="form-control" v-model="form.cifName" aria-describedby="emailHelp" placeholder="Client Abc.." autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                             <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">CIF ID Number</label>
                                  <input type="text"  class="form-control" v-model="form.cifNoId" aria-describedby="emailHelp" placeholder="Client Abc.." autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                             <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">ID Type </label>
                                <select class="form-control" v-model="form.cifTypeId">
                                    <option v-for="item in idType" 
                                            :key="item.idTypeName" 
                                            :value="item.idTypeName">
                                        @{{ item.idTypeName }}
                                    </option>
                                </select>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="email"  class="form-control" v-model="form.cifEmail" aria-describedby="emailHelp" placeholder="Client Abc.." autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Address</label>
                                  <input type="text"  class="form-control" v-model="form.cifAddress" aria-describedby="emailHelp" placeholder="Client Abc.." autofocus>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save</button>
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
                        cifName:"",
                        cifNoId:"",
                        cifTypeId:"",
                        cifEmail:"",
                        cifAddress:"",
                })
            const idType=ref([
                {idTypeName:"KTP"},
                {idTypeName:"SIM"},
                {idTypeName:"PASSPORT"},
            ])
            const form=ref({
                id:0,
                cifName:"",
                cifNoId:"",
                cifTypeId:"",
                cifEmail:"",
                cifAddress:"",
            })
            const editMode=ref(false);
            const createModal=()=>{
                editMode.value=false;
                form.value.cifName='';
                form.value.cifNoId='';
                form.value.cifTypeId='';
                form.value.cifEmail='';
                form.value.cifAddress='';
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            form.value.cifName=data.cifName;
                            form.value.cifNoId=data.cifNoId;
                            form.value.cifTypeId=data.cifTypeId;
                            form.value.cifEmail=data.cifEmail;
                            form.value.cifAddress=data.cifAddress;
                        }
                    });
                    $('#dataModal').modal('show')
            }
           
            const createData=()=>{
                // console.log("createData",form.value.client_name);
                axios.post('{{route('cifs.store')}}', {
                    cifName: form.value.cifName,
                    cifNoId: form.value.cifNoId,
                    cifTypeId: form.value.cifTypeId,
                    cifEmail: form.value.cifEmail,
                    cifAddress: form.value.cifAddress,
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
                axios.post('{{route('cifs.update')}}',{
                    cifName:form.value.cifName,
                    cifNoId:form.value.cifNoId,
                    cifTypeId:form.value.cifTypeId,
                    cifEmail:form.value.cifEmail,
                    cifAddress:form.value.cifAddress,
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
                axios.post('{{route('cifs.getAll')}}')
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
                axios.get(`{{route('cifs.destroy','')}}/${id}`)
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
                idType,
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