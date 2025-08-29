@extends('makarios.app')
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Product Type</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Product Type \ Product Type</li>
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
                            <th>No</th>
                            <th>Action</th>
                            <th>Product Type Name</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated By</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
                          <label for="exampleInputEmail1">Type Name</label>
                          <input type="text"  class="form-control" v-model="form.product_type_name" aria-describedby="emailHelp" placeholder="Type Name.." autofocus>
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
                product_type_name:"",
            })
            const editMode=ref(false);
            const createModal=()=>{
                form.value.product_type_name='';
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            form.value.product_type_name=data.product_type_name;
                        }
                    });
                    $('#dataModal').modal('show')
            }
            const createData=()=>{
                axios.post('{{route('makarios.adddataproducttype')}}', {
                    product_type_name: form.value.product_type_name,
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
                axios.post('{{route('makarios.updatedataproducttype')}}',{
                    product_type_name:form.value.product_type_name,
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
                window.updateModal = updateModal;
                window.deleteData = deleteData;
                // $('#dataTbl').DataTable().destroy();
                $('#dataTbl').DataTable({
                    destroy: true,
                    responsive: true,
                    autoWidth: false,
                    processing: true,
                    serverSide: true,
                        scrollX: true,
                    ajax: {
                        url: '{{route('makarios.getdataproducttype')}}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        dataSrc: function (json) {
                            mainData.value = json.data; // simpan ke Vue
                            return json.data;           // kembalikan ke DataTable
                        },
                    },
                    columns: [
                        { data: 'id' },
                        {    data: 'id',
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                return `
                                    <div class="row">
                                        <div class="col-md-2">
                                            <button type="button" class="shadow-sm d-sm-inline-block btn btn-sm btn-success"
                                                    onclick="updateModal(${data})">
                                                <i class="fas fa-edit fa-sm text-white-50"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="shadow-sm d-sm-inline-block btn btn-sm btn-danger"
                                                    onclick="deleteData(${data})">
                                                <i class="fas fa-minus fa-sm text-white-50"></i>
                                            </button>
                                        </div>
                                    </div>
                                `;
                            }},
                        { data: 'product_type_name' },
                        { data: 'created_by' },
                        { data: 'updated_by' },
                        { data: 'created_at' },
                        { data: 'updated_at' }
                    ]
                });
            }
            const deleteData=(id)=>{
                axios.get(`{{route('makarios.deletedataproducttype','')}}/${id}`)
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