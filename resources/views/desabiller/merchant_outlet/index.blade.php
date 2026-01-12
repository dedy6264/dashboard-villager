@extends('app')
@section('mainContent')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Merchant Outlet</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Corporate \ Merchant Outlet</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <button type="button" class="btn btn-primary"  @click="createModal()">Add</button>
            </div>
        </div>
        {{-- <div class="card mb-4">
            <form @submit.prevent="refreshData()">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Client </label>
                              <select class="form-control" v-model='filter.client_id'>
                                <option v-for="item in clients" :key="item.id" :value="item.clientName">@{{ item.clientName }}</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Group </label>
                              <select class="form-control" v-model='filter.group_id'>
                                <option v-for="item in groups" :key="item.id" :value="item.groupName">@{{ item.groupName }}</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="modal-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Merchant </label>
                              <select class="form-control" v-model='filter.merchant_id'>
                                <option v-for="item in merchants" :key="item.id" :value="item.merchantName">@{{ item.merchantName }}</option>
                              </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save</button>
                    </div>
            </form>
        </div> --}}
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
                            <th>Outlet Username</th>
                            <th>Merchant Outlet Name</th>
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
                            <td v-text="item.merchantOutletUsername"></td>
                            <td v-text="item.merchantOutletName"></td>
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
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="dataModalLabel" >@{{ (editMode?'Edit Outlet':'Tambah Outlet')}}</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="editMode ? updateData() : createData()" >
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Client </label>
                                <select class="form-control" v-model='form.client_id'>
                                    <option v-for="item in clients" :key="item.id" :value="item.id">@{{ item.clientName }}</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Group </label>
                                <select class="form-control" v-model='form.group_id'>
                                    <option v-for="item in groups" :key="item.id" :value="item.id">@{{ item.groupName }}</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Merchant </label>
                                <select class="form-control" v-model='form.merchant_id'>
                                    <option v-for="item in merchants" :key="item.id" :value="item.id">@{{ item.merchantName }}</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Outlet Name</label>
                                <input type="text"  class="form-control" v-model="form.merchant_outlet_name" aria-describedby="emailHelp" placeholder="Outlet Abc.." autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">User Name</label>
                                <input type="text"  class="form-control" v-model="form.merchant_outlet_username" aria-describedby="emailHelp" placeholder="Username" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password"  class="form-control" v-model="form.merchant_outlet_password" aria-describedby="emailHelp" placeholder="Password" autofocus>
                                </div>
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
    const{createApp, ref,onMounted,nextTick }=Vue;

    createApp({
        setup(){
            const mainData=ref([]);
            const clients=ref(@json($clients));
            const groups=ref(@json($groups));
            const merchants=ref(@json($merchants));
            const filter=ref({
                        client_name:'',
                        group_name:'',
                        merchant_name:'',
                        merchant_outlet_name:'',
                });
            const form=ref({
                id:0,
                client_id:-1,
                client_name:'',
                group_name:"",
                group_id:-1,
                merchant_id:"",
                merchant_name:"",
                merchant_outlet_name:"",
                merchant_outlet_username:"",
                merchant_outlet_password:"",
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
                merchants.value.forEach((data) => {
                        if(data.id==form.value.merchant_id){
                            form.value.merchant_name=data.merchantName;
                        }
                    });
            }
            const editMode=ref(false);
            const createModal=()=>{
                form.value.client_name='';
                form.value.client_id=-1;
                form.value.group_name='';
                form.value.group_id=-1;
                form.value.merchant_id=-1;
                form.value.merchant_name='';
                form.value.merchant_outlet_name='';
                form.value.merchant_outlet_username='';
                form.value.merchant_outlet_password='';
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            form.value.merchant_outlet_password=data.merchantOutletPassword;
                            form.value.merchant_outlet_username=data.merchantOutletUsername;
                            form.value.merchant_outlet_name=data.merchantOutletName;
                            form.value.merchant_id=data.merchantId;
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
                axios.post('{{route('merchantOutlets.store')}}', {
                    client_name:form.value.client_name,
                    client_id: form.value.client_id,
                    group_name: form.value.group_name,
                    group_id: form.value.group_id,
                    merchant_id: form.value.merchant_id,
                    merchant_name: form.value.merchant_name,
                    merchant_outlet_name: form.value.merchant_outlet_name,
                    merchant_outlet_username: form.value.merchant_outlet_username,
                    merchant_outlet_password: form.value.merchant_outlet_password,
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
                axios.post('{{route('merchantOutlets.update')}}',{
                    client_id: form.value.client_id,
                    client_name:form.value.client_name,
                    group_name:form.value.group_name,
                    group_id:form.value.group_id,
                    merchant_id: form.value.merchant_id,
                    merchant_name: form.value.merchant_name,
                    merchant_outlet_name: form.value.merchant_outlet_name,
                    merchant_outlet_username: form.value.merchant_outlet_username,
                    merchant_outlet_password: form.value.merchant_outlet_password,
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
                axios.post('{{route('merchantOutlets.getAll')}}',{
                    // client_name:filter.value.client_name,
                    // group_name:filter.value.group_name,
                    // merchant_name:filter.value.merchant_name,
                    // merchant_outlet_name :filter.value.merchant_outlet_name,
                })
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
                axios.get(`{{route('merchantOutlets.destroy','')}}/${id}`)
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
                merchants,
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