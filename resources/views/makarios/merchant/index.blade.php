@extends('makarios.app')
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Merchant</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Merchant \ Merchant</li>
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
                            <th>Merchant Name</th>
                            <th>Group Name</th>
                            <th>Client Name</th>
                            <th>Segment Name</th>
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
                            <td v-text="item.merchant_name"></td>
                            <td v-text="item.group_name"></td>
                            <td v-text="item.client_name"></td>
                            <td v-text="item.segment_name"></td>
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
                          <label for="exampleInputEmail1">Merchant Name</label>
                          <input type="text"  class="form-control" v-model="form.merchant_name" aria-describedby="emailHelp" placeholder="Nama.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Merchant Key</label>
                          <input type="text"  class="form-control" v-model="form.m_key" aria-describedby="emailHelp" placeholder="Nama.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">First Name</label>
                          <input type="text"  class="form-control" v-model="form.first_name" aria-describedby="emailHelp" placeholder="Nama.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Last Name</label>
                          <input type="text"  class="form-control" v-model="form.last_name" aria-describedby="emailHelp" placeholder="Nama.." autofocus>
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
                            <label for="exampleInputEmail1">Segment </label>
                            <select class="form-control" v-model="form.segment_id" @change="updateSegmentName">
                                <option disabled value="0">Pilih Segment</option>
                                <option v-for="item in segments" :key="item.id" :value="item.id">
                                    @{{ item.segment_name }}
                                </option>
                            </select>

                            <input type="text" name="segment_name" id="segment_name"
                                class="form-control" hidden
                                v-model="form.segment_name">
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
                client_id:"",
                client_name:"",
                group_id:"",
                group_name:"",
                segment_id:"",
                segment_name:"",
                merchant_name:"",
                m_key:"",
                first_name:"",
                last_name:"",
            })
            const editMode=ref(false);
            const clients=ref(@json($clients));
            const segments=ref(@json($segments));
            let groups=ref({});
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
            const updateSegmentName=()=>{
                            const selected = segments.value.find(t => t.id === form.value.segment_id);
                            form.value.segment_name = selected ? selected.segment_name : '';
                        }
            const updateGroupName=()=>{
                            const selected = groups.value.find(t => t.id === form.value.group_id);
                            form.value.group_name = selected ? selected.group_name : '';
                        }
            const createModal=()=>{
                form.value.client_id=0;
                form.value.client_name="";
                form.value.group_id=0;
                form.value.group_name="";
                form.value.segment_id=0;
                form.value.segment_name="";
                form.value.merchant_name="";
                form.value.m_key="";
                form.value.first_name="";
                form.value.last_name="";
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            form.value.client_id=data.client_id;
                            form.value.client_name=data.client_name;
                            form.value.group_id=data.group_id;
                            form.value.group_name=data.group_name;
                            form.value.segment_id=data.segment_id;
                            form.value.segment_name=data.segment_name;
                            form.value.merchant_name=data.merchant_name;
                            form.value.m_key=data.m_key;
                            form.value.first_name=data.first_name;
                            form.value.last_name=data.last_name;
                        }
                    });
                    $('#dataModal').modal('show')
            }
            const createData=()=>{
                console.log(";;", form.value);
                axios.post('{{route('makarios.adddatamerchant')}}', {
                    client_id:form.value.client_id,
                    client_name:form.value.client_name,
                    group_id:form.value.group_id,
                    group_name:form.value.group_name,
                    segment_id:form.value.segment_id,
                    segment_name:form.value.segment_name,
                    merchant_name:form.value.merchant_name,
                    m_key:form.value.m_key,
                    first_name:form.value.first_name,
                    last_name:form.value.last_name,
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
                axios.post('{{route('makarios.updatedatamerchant')}}',{
                    client_id:form.value.client_id,
                    client_name:form.value.client_name,
                    group_id:form.value.group_id,
                    group_name:form.value.group_name,
                    segment_id:form.value.segment_id,
                    segment_name:form.value.segment_name,
                    merchant_name:form.value.merchant_name,
                    m_key:form.value.m_key,
                    first_name:form.value.first_name,
                    last_name:form.value.last_name,
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
                $('#dataTbl').DataTable().destroy();
                axios.post('{{route('makarios.getdatamerchant')}}')
                .then(response => {
                    console.log(response.data);
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
                axios.get(`{{route('makarios.deletedatamerchant','')}}/${id}`)
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
                updateGroupName,
                segments,
                groups,
                updateSegmentName,
                clients,
                updateClientName,
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