@extends('app')
@section('mainContent')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Merchant</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Corporate \ Merchant</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <button type="button" class="btn btn-primary"  @click="createModal()">Add</button>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="dataTbl">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Merchant Name</th>
                            <th>Group Name</th>
                            <th>Client Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="mainData" v-for="item, index in mainData" :key="index">
                            <td>
                                <div class="row">
                                    <div class="col-md-2">
                                        <button type="button" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" @click="updateModal(item.id)"><i class="fas fa-edit fa-sm text-white-50"></i></button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm" @click="deleteData(item.id)"><i class="fas fa-minus fa-sm text-white-50"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td v-text="item.merchantName"></td>
                            <td v-text="item.groupName"></td>
                            <td v-text="item.clientName"></td>
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
                  <h5 class="modal-title" id="dataModalLabel" >@{{ (editMode?'Edit Merchant':'Tambah Merchant')}}</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="editMode ? updateData() : createData()" >
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Client </label>
                          <select class="form-control" v-model='form.client_id'>
                            <option v-for="item in clients" :key="item.id" :value="item.id">@{{ item.clientName }}</option>
                          </select>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Group </label>
                          <select class="form-control" v-model='form.group_id'>
                            <option v-for="item in groups" :key="item.id" :value="item.id">@{{ item.groupName }}</option>
                          </select>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Merchant Name</label>
                          <input type="text"  class="form-control" v-model="form.merchant_name" aria-describedby="emailHelp" placeholder="Merchant Abc.." autofocus>
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
            const mainData=ref([]);
            const clients=ref(@json($clients));
            const groups=ref(@json($groups));
            const filter=ref({
                        id:0,
                        client_name:"",
                });
            const form=ref({
                id:0,
                client_id:-1,
                client_name:'',
                group_name:"",
                group_id:-1,
                merchant_name:"",
            })
            const formSelector=()=>{
                clients.value.forEach((data) => {
                        if(data.id==form.value.client_id){
                            form.value.client_name=data.clientName;
                        }
                    });
                groups.value.forEach((data) => {
                        if(data.id==form.value.group_id){
                            form.value.group_name=data.groupName;
                        }
                    });
            }
            const editMode=ref(false);
            const createModal=()=>{
                form.value.client_name='';
                form.value.client_id=-1;
                form.value.group_name='';
                form.value.group_id=-1;
                form.value.merchant_name='';
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            form.value.merchant_name=data.merchantName;
                            form.value.group_name=data.groupName;
                            form.value.group_id=data.groupId;
                            form.value.client_name=data.clientName;
                            form.value.client_id=data.clientId;
                        }
                    });
                    $('#dataModal').modal('show')
            }
            const createData=()=>{
                formSelector();
                axios.post('{{route('merchants.store')}}', {
                    client_name:form.value.client_name,
                    client_id: form.value.client_id,
                    group_name: form.value.group_name,
                    group_id: form.value.group_id,
                    merchant_name: form.value.merchant_name,
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
                formSelector();
                axios.post('{{route('merchants.update')}}',{
                    client_id: form.value.client_id,
                    client_name:form.value.client_name,
                    group_name:form.value.group_name,
                    group_id:form.value.group_id,
                    merchant_name:form.value.merchant_name,
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
                axios.post('{{route('merchants.getAll')}}')
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
                axios.get(`{{route('merchants.destroy','')}}/${id}`)
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
                // groups.value.forEach((data) => {
                //     console.log("groups",data);
                //         // if(data.id==id){
                //         //     form.value.client_name=data.groupName;
                //         // }
                //     });
                refreshData();
                });

            return{
                groups,
                clients,
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
                formSelector,
            };
        }
    }).mount("#app");
</script>
@endsection