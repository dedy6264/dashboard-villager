@extends('makarios.app')
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Merchant Outlet</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Merchant Outlet \ Merchant Outlet</li>
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
                            <th>Merchant Outlet Name</th>
                            <th>Merchant Name</th>
                            <th>Merchant Name</th>
                            <th>Client Name</th>
                            <th>Saving Account Name</th>
                            <th>Username</th>
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
                            <td v-text="item.merchant_outlet_name"></td>
                            <td v-text="item.merchant_name"></td>
                            <td v-text="item.group_name"></td>
                            <td v-text="item.client_name"></td>
                            <td v-text="item.saving_account_name"></td>
                            <td v-text="item.username"></td>
                            <td v-text="item.created_at"></td>
                            <td v-text="item.updated_at"></td>
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
                  <h5 class="modal-title" id="dataModalLabel" >@{{ (editMode?'Edit User':'Tambah User')}}</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="editMode ? updateData() : createData()" >
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Merchant Outlet Name</label>
                          <input type="text"  class="form-control" v-model="form.merchant_outlet_name" aria-describedby="emailHelp" placeholder="Nama.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Username</label>
                          <input type="text"  class="form-control" v-model="form.username" aria-describedby="emailHelp" placeholder="Nama.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Password</label>
                          <input type="password"  class="form-control" v-model="form.password" aria-describedby="emailHelp" placeholder="Nama.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Client </label>
                            <select class="form-control" v-model="form.client_id" @change="updateClientName">
                                <option disabled value="0">Pilih Client</option>
                                <option v-for="item in clients" :key="item.id" :value="item.id">
                                    @{{ item.client_name }}
                                </option>
                            </select>

                            <input type="text" name="client_name" id="client_name"
                                class="form-control" hidden
                                v-model="form.client_name">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Group </label>
                            <select class="form-control" v-model="form.group_id" @change="updateGroupName">
                                <option disabled value="0">Pilih Group</option>
                                <option v-for="item in groups" :key="item.id" :value="item.id">
                                    @{{ item.group_name }}
                                </option>
                            </select>

                            <input type="text" name="group_name" id="group_name"
                                class="form-control" hidden
                                v-model="form.group_name">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Merchant </label>
                            <select class="form-control" v-model="form.merchant_id" @change="updateMerchantName">
                                <option disabled value="0">Pilih Merchant</option>
                                <option v-for="item in merchants" :key="item.id" :value="item.id">
                                    @{{ item.merchant_name }}
                                </option>
                            </select>

                            <input type="text" name="merchant_name" id="merchant_name"
                                class="form-control" hidden
                                v-model="form.merchant_name">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Saving Account </label>
                            <select class="form-control" v-model="form.saving_account_id" @change="updateSavingAccount">
                                <option disabled value="0">Pilih Saving Account</option>
                                <option v-for="item in savings" :key="item.id" :value="item.id">
                                    @{{ item.account_name }} | @{{ item.account_number }}
                                </option>
                            </select>

                            <input type="text" name="saving_account_name" id="saving_account_name"
                                class="form-control" hidden
                                v-model="form.saving_account_name">
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
            const mainData=ref();
            const form=ref({
                id:0,
                client_id:0,
                client_name:"",
                group_id:0,
                group_name:"",
                merchant_id:0,
                merchant_name:"",
                saving_account_id:0,
                saving_account_name:"",
                merchant_outlet_name:"",
                username:"",
                password:"",
            })
            const editMode=ref(false);
            const clients=ref(@json($clients));
            const savings=ref(@json($savings));
            let groups=ref({});
            let merchants=ref({});
            const updateClientName=()=>{
                const selected = clients.value.find(t => t.id === form.value.client_id);
                form.value.client_name = selected ? selected.client_name : '';
                axios.post('{{route('makarios.getdatagroupjson')}}',{
                    client_id:form.value.client_id,
                })
                .then(response => {
                    groups.value=response.data.data;
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    if (error.response) {
                        this.errorMessage = error.response.data.message;
                        this.successMessage = '';  // Reset success jika ada
                    }
                });
            }
            const updateMerchantName=()=>{
                const selected = merchants.value.find(t => t.id === form.value.merchant_id);
                form.value.merchant_name = selected ? selected.merchant_name : '';
            }
            const updateSavingAccount=()=>{
                const selected = savings.value.find(t => t.id === form.value.saving_account_id);
                form.value.saving_account_name = selected ? selected.account_name : '';
            }
            const updateGroupName=()=>{
                const selected = groups.value.find(t => t.id === form.value.group_id);
                form.value.group_name = selected ? selected.group_name : '';
                axios.post('{{route('makarios.getdatamerchantjson')}}',{
                    group_id:form.value.group_id,
                })
                .then(response => {
                    merchants.value=response.data.data;
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    if (error.response) {
                        this.errorMessage = error.response.data.message;
                        this.successMessage = '';  // Reset success jika ada
                    }
                });
            }
            const createModal=()=>{
                form.value.client_id=0,
                form.value.client_name="",
                form.value.group_id=0,
                form.value.group_name="",
                form.value.merchant_id=0,
                form.value.merchant_name="",
                form.value.saving_account_id=0,
                form.value.saving_account_name="",
                form.value.merchant_outlet_name="",
                form.value.username="",
                form.value.password="",
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;

                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            axios.post('{{route('makarios.getdatagroupjson')}}',{
                                client_id:data.client_id,
                            })
                            .then(response => {
                                groups.value=response.data.data;
                            })
                            .catch(error => {
                                console.error("Error fetching data:", error);
                                if (error.response) {
                                    this.errorMessage = error.response.data.message;
                                    this.successMessage = '';  // Reset success jika ada
                                }
                            });
                            axios.post('{{route('makarios.getdatamerchantjson')}}',{
                                group_id:data.group_id,
                            })
                            .then(response => {
                                merchants.value=response.data.data;
                            })
                            .catch(error => {
                                console.error("Error fetching data:", error);
                                if (error.response) {
                                    this.errorMessage = error.response.data.message;
                                    this.successMessage = '';  // Reset success jika ada
                                }
                            });
                            form.value.client_id=data.client_id;
                            form.value.client_name=data.client_name;
                            form.value.group_id=data.group_id;
                            form.value.group_name=data.group_name;
                            form.value.merchant_id=data.merchant_id;
                            form.value.merchant_name=data.merchant_name;
                            form.value.saving_account_id=data.saving_account_id;
                            form.value.saving_account_name=data.saving_account_name;
                            form.value.merchant_outlet_name=data.merchant_outlet_name;
                            form.value.username=data.username;
                            form.value.password=data.password;
                        }
                    });
                    $('#dataModal').modal('show')
            }
            const createData=()=>{
                console.log(form.value);
                axios.post('{{route('makarios.adddatamerchantoutlet')}}', {
                    client_id:form.value.client_id,
                    client_name:form.value.client_name,
                    group_id:form.value.group_id,
                    group_name:form.value.group_name,
                    merchant_id:form.value.merchant_id,
                    merchant_name:form.value.merchant_name,
                    saving_account_id:form.value.saving_account_id,
                    saving_account_name:form.value.saving_account_name,
                    merchant_outlet_name:form.value.merchant_outlet_name,
                    username:form.value.username,
                    password: form.value.password,
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
                axios.post('{{route('makarios.updatedatamerchantoutlet')}}',{
                     client_id:form.value.client_id,
                    client_name:form.value.client_name,
                    group_id:form.value.group_id,
                    group_name:form.value.group_name,
                    merchant_id:form.value.merchant_id,
                    merchant_name:form.value.merchant_name,
                    saving_account_id:form.value.saving_account_id,
                    saving_account_name:form.value.saving_account_name,
                    merchant_outlet_name:form.value.merchant_outlet_name,
                    username:form.value.username,
                    password: form.value.password,
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
                console.log(savings);
                groups.value=[];
                merchants.value=[];
                $('#dataTbl').DataTable().destroy();
                axios.post('{{route('makarios.getdatamerchantoutlet')}}')
                .then(response => {
                    console.log(response.data);
                    mainData.value=response.data.data;
                    nextTick( () => {
                        $('#dataTbl').DataTable({
                        responsive: true,
                        autoWidth: false,
                         scrollX: true,
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
                axios.get(`{{route('makarios.deletedatamerchantoutlet','')}}/${id}`)
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
                savings,
                updateSavingAccount,
                clients,
                groups,
                merchants,
                updateClientName,
                updateMerchantName,
                updateGroupName,
                deleteData,
                updateModal,
                updateData,
                createData,
                createModal,
                editMode,
                mainData,
                form,
                refreshData,
            };
        }
    }).mount("#app");
</script>
@endsection