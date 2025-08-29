@extends('makarios.app')
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Product</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Product \ Product</li>
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
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Product Reference Name</th>
                            <th>Product Reference Code</th>
                            <th>Product Category Name</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated By</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr >
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
                          <label for="exampleInputEmail1">Product Name</label>
                          <input type="text"  class="form-control" v-model="form.product_name" aria-describedby="emailHelp" placeholder="Nama.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Code</label>
                          <input type="text"  class="form-control" v-model="form.product_code" aria-describedby="emailHelp" placeholder="Nama.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category </label>
                            <select class="form-control" v-model="form.product_category_id" @change="updateCategoryName">
                                <option disabled value="0">Pilih Category Produk</option>
                                <option v-for="item in categories" :key="item.id" :value="item.id">
                                    @{{ item.product_category_name }}
                                </option>
                            </select>

                            <input type="text" name="product_category_name" id="product_category_name"
                                class="form-control" hidden
                                v-model="form.product_category_name">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Reference </label>
                            <select class="form-control" v-model="form.product_reference_id" @change="updateReferenceName">
                                <option disabled value="0">Pilih Category Produk</option>
                                <option v-for="item in references" :key="item.id" :value="item.id">
                                    @{{ item.product_reference_name }}|| @{{ item.product_reference_code }}
                                </option>
                            </select>

                            <input type="text" name="product_reference_name" id="product_reference_name"
                                class="form-control" hidden
                                v-model="form.product_reference_name">
                            <input type="text" name="product_reference_code" id="product_reference_code"
                                class="form-control" hidden
                                v-model="form.product_reference_code">
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
            const categories=ref(@json($categories));
            const references=ref(@json($references));
            const form=ref({
                id:0,
                product_reference_id:0,
                product_reference_name:"",
                product_reference_code:"",
                product_category_id:0,
                product_category_name:"",
                product_name:"",
                product_code:"",
            })
            const updateCategoryName=()=>{
                const selected = categories.value.find(t => t.id === form.value.product_category_id);
                form.value.product_category_name = selected ? selected.product_category_name : '';
            }
            const updateReferenceName=()=>{
                const selected = references.value.find(t => t.id === form.value.product_reference_id);
                form.value.product_reference_name = selected ? selected.product_reference_name : '';
                form.value.product_reference_code = selected ? selected.product_reference_code : '';
            }
            const editMode=ref(false);
            const createModal=()=>{
                form.value.product_reference_id=0;
                form.value.product_reference_name='';
                form.value.product_reference_code='';
                form.value.product_category_id=0;
                form.value.product_category_name='';
                form.value.product_name='';
                form.value.product_code='';
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                console.log("mm", mainData.value);
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                console.log("mm", data);
                        form.value.id=id;
                            form.value.product_reference_id=data.product_reference_id;
                            form.value.product_reference_name=data.product_reference_name;
                            form.value.product_reference_code=data.product_reference_code;
                            form.value.product_category_id=data.product_category_id;
                            form.value.product_category_name=data.product_category_name;
                            form.value.product_name=data.product_name;
                            form.value.product_code=data.product_code;
                        }
                    });
                    $('#dataModal').modal('show')
            }
            const createData=()=>{
                axios.post('{{route('makarios.adddataproduct')}}', {
                    product_reference_id:form.value.product_reference_id,
                    product_reference_name:form.value.product_reference_name,
                    product_reference_code:form.value.product_reference_code,
                    product_category_id:form.value.product_category_id,
                    product_category_name:form.value.product_category_name,
                    product_name:form.value.product_name,
                    product_code:form.value.product_code,
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
                console.log("form",form.value);
                axios.post('{{route('makarios.updatedataproduct')}}',{
                    product_reference_id:form.value.product_reference_id,
                    product_reference_name:form.value.product_reference_name,
                    product_reference_code:form.value.product_reference_code,
                    product_category_id:form.value.product_category_id,
                    product_category_name:form.value.product_category_name,
                    product_name:form.value.product_name,
                    product_code:form.value.product_code,
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
                $('#dataTbl').DataTable({
                    destroy: true,
                    responsive: true,
                    autoWidth: true,
                    processing: true,
                    serverSide: true,
                        scrollX: true,
                    ajax: {
                        url: '{{route('makarios.getdataproduct')}}',
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
                        { data: 'product_name' },
                        { data: 'product_code' },
                        { data: 'product_reference_name' },
                        { data: 'product_reference_code' },
                        { data: 'product_category_name' },
                        { data: 'created_by' },
                        { data: 'updated_by' },
                        { data: 'created_at' },
                        { data: 'updated_at' }
                    ]
                });
            }
            const deleteData=(id)=>{
                axios.get(`{{route('makarios.deletedataproduct','')}}/${id}`)
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
                references,
                updateReferenceName,
                categories,
                updateCategoryName,
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