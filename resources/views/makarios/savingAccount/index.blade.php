@extends('makarios.app')
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Saving Account</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Saving Account \ Saving Account</li>
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
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Balance</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="mainData" v-for="item, index in mainData" :key="index">
                            <td>
                                <div class="row">
                                    {{-- <div class="col-md-2">
                                        <button type="button" class="shadow-sm d-sm-inline-block btn btn-sm btn-success" @click="updateModal(item.id)"><i class="fas fa-edit fa-sm text-white-50"></i></button>
                                    </div> --}}
                                    <div class="col-md-2">
                                        <button type="button" class="shadow-sm d-sm-inline-block btn btn-sm btn-danger" @click="deleteData(item.id)"><i class="fas fa-minus fa-sm text-white-50"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td v-text="item.account_name"></td>
                            <td v-text="item.account_number"></td>
                            <td v-text="item.balance"></td>
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
                            <label for="exampleInputEmail1">Account </label>
                            <select class="form-control" v-model="form.account_id" @change="updateAccountName">
                                <option disabled value="0">Pilih Account</option>
                                <option v-for="item in accounts" :key="item.id" :value="item.id">
                                    @{{ item.account_name }}
                                </option>
                            </select>

                            <input type="text" name="account_name" id="account_name"
                                class="form-control" hidden
                                v-model="form.account_name">
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
                account_name:"",
                account_id:0,
            })
            const accounts=ref(@json($accounts));
            const updateAccountName=()=>{
                            const selected = accounts.value.find(t => t.id === form.value.account_id);
                            form.value.account_name = selected ? selected.account_name : '';
                        }
            const editMode=ref(false);
            const createModal=()=>{
                form.value.account_name='';
                form.value.account_id=0;
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            form.value.account_name=data.account_name;
                            form.value.account_id=data.account_id;
                        }
                    });
                    $('#dataModal').modal('show')
            }
            const createData=()=>{
                axios.post('{{route('makarios.adddatasavingaccount')}}', {
                    account_name: form.value.account_name,
                    account_id: form.value.account_id,
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
                axios.post('{{route('makarios.updatedatasavingaccount')}}',{
                    account_name:form.value.account_name,
                    account_id:form.value.account_id,
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
                axios.post('{{route('makarios.getdatasavingaccount')}}')
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
                axios.get(`{{route('makarios.deletedatasavingaccount','')}}/${id}`)
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
                accounts,
                updateAccountName,
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