@extends('app')
@section('mainContent')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Client</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Corporate \ Client</li>
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
                  <h5 class="modal-title" id="dataModalLabel" >@{{ (editMode?'Edit Client':'Tambah Client')}}</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="editMode ? updateData() : createData()" >
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Client Name</label>
                          <input type="text"  class="form-control" v-model="form.client_name" aria-describedby="emailHelp" placeholder="Client Abc.." autofocus>
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
                        client_name:"",
                })
            const form=ref({
                id:0,
                client_name:"",
            })
            const editMode=ref(false);
            const createModal=()=>{
                form.value.client_name='';
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            form.value.client_name=data.clientName;
                        }
                    });
                    $('#dataModal').modal('show')
            }
            // const refreshData=()=>{
            //     $('#dataTbl').DataTable({}).destroy();
            //     $('#dataTbl').DataTable({
            //         destroy:true,
            //         processing:true,
            //         serverSide:true,
            //         ajax:{
            //             url: "{{ route('clients.getAll') }}",
            //             type:'POST',
            //             headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            //             data: function(d) {
            //                 d.client_name = filter.value.client_name; // Kirim filter ke server
            //             },
            //         },
            //         processing: true,
            //                     serverSide: true,
            //         columns:[
            //             {data:'id', name:'action', orderable:false, searchable:false, render:function(data,type,row){
            //                 return `
            //                 <div class="row">
            //                     <div class="col-md-2">
            //                         <button type="button" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" data-id="${data}" >
            //                         <i class="fas fa-edit fa-sm text-white-50"></i>                                 
            //                         </button> 
            //                     </div>
            //                     <div class="col-md-2">
            //                     <button type="button" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm" >
            //                     <i class="fas fa-minus fa-sm text-white-50"></i>
            //                     </button> 
            //                     </div>
            //                     </div>
            //                 `;
            //             }},
            //             {data:'clientName', name:'clientName'},
            //             {data:'createdAt', name:'createdAt'},
            //             {data:'updatedAt', name:'updatedAt'},
            //         ],
            //         drawCallback: function () {
            //             console.log("DataTables selesai di-refresh.");
            //             // addUpdateButtonListener();
            //         }
            //     });
            // };
            const createData=()=>{
                // console.log("createData",form.value.client_name);
                axios.post('{{route('clients.store')}}', {
                    client_name: form.value.client_name
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
                axios.post('{{route('clients.update')}}',{
                    client_name:form.value.client_name,
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
                axios.post('{{route('clients.getAll')}}')
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
                axios.get(`{{route('clients.destroy','')}}/${id}`)
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
                filter,
                form,
                refreshData,
            };
        }
    }).mount("#app");
</script>
@endsection