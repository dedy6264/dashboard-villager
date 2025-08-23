@extends('makarios.app')
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Product Provider</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Product Provider \ Product Provider</li>
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
                            <th>Provider Name</th>
                            <th>Product Provider Name</th>
                            <th>Product Provider Code</th>
                            <th>Product Provider Price</th>
                            <th>Product Provider Admin Fee</th>
                            <th>Product Provider Merchant Fee</th>
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
                          <label for="exampleInputEmail1">Product Provider Name</label>
                          <input type="text"  class="form-control" v-model="form.product_provider_name" aria-describedby="emailHelp" placeholder="product Provider Name.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Provider Code</label>
                          <input type="text"  class="form-control" v-model="form.product_provider_code" aria-describedby="emailHelp" placeholder="product Provider Code.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Provider Price</label>
                          <input type="amount"  class="form-control" v-model="form.product_provider_price" aria-describedby="emailHelp" placeholder="product Provider Price.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Provider Admin Fee</label>
                          <input type="amount"  class="form-control" v-model="form.product_provider_admin_fee" aria-describedby="emailHelp" placeholder="product Provider Admin Fee.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Product Provider Merchant Fee</label>
                          <input type="amount"  class="form-control" v-model="form.product_provider_merchant_fee" aria-describedby="emailHelp" placeholder="product Provider Merchant Fee.." autofocus>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Provider </label>
                            <select class="form-control" v-model="form.provider_id" @change="updateProviderName">
                                <option disabled value="0">Pilih Provider</option>
                                <option v-for="item in providers" :key="item.id" :value="item.id">
                                    @{{ item.provider_name }}
                                </option>
                            </select>

                            <input type="text" name="provider_name" id="provider_name"
                                class="form-control" hidden
                                v-model="form.provider_name">
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
            const providers=ref(@json($providers));
            const form=ref({
                id:0,
                product_provider_name:"",
                provider_name:"",
                provider_id:0,
                product_provider_code:"",
                product_provider_price:0,
                product_provider_admin_fee:0,
                product_provider_merchant_fee:0,
            })
            const editMode=ref(false);
            const updateProviderName=()=>{
                const selected = providers.value.find(t => t.id === form.value.provider_id);
                form.value.provider_name = selected ? selected.provider_name : '';
            }
            const createModal=()=>{
                editMode.value=false;
                form.value.product_provider_name='';
                form.value.provider_name="";
                form.value.provider_id=0;
                form.value.product_provider_code="";
                form.value.product_provider_price=0;
                form.value.product_provider_admin_fee=0;
                form.value.product_provider_merchant_fee=0;
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            form.value.provider_id=data.provider_id;
                            form.value.provider_name=data.provider_name;
                            form.value.product_provider_name=data.product_provider_name;
                            form.value.product_provider_code=data.product_provider_code;
                            form.value.product_provider_price=data.product_provider_price;
                            form.value.product_provider_admin_fee=data.product_provider_admin_fee;
                            form.value.product_provider_merchant_fee=data.product_provider_merchant_fee;
                        }
                    });
                    $('#dataModal').modal('show')
            }
            const createData=()=>{
                axios.post('{{route('makarios.adddataproductprovider')}}', {
                    product_provider_name: form.value.product_provider_name,
                    provider_name: form.value.provider_name,
                    provider_id: form.value.provider_id,
                    product_provider_code: form.value.product_provider_code,
                    product_provider_price: form.value.product_provider_price,
                    product_provider_admin_fee: form.value.product_provider_admin_fee,
                    product_provider_merchant_fee: form.value.product_provider_merchant_fee,
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
                axios.post('{{route('makarios.updatedataproductprovider')}}',{
                    product_provider_name: form.value.product_provider_name,
                    provider_name: form.value.provider_name,
                    provider_id: form.value.provider_id,
                    product_provider_code: form.value.product_provider_code,
                    product_provider_price: form.value.product_provider_price,
                    product_provider_admin_fee: form.value.product_provider_admin_fee,
                    product_provider_merchant_fee: form.value.product_provider_merchant_fee,
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
                    ajax: {
                        url: '{{route('makarios.getdataproductprovider')}}',
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
                        { data: 'provider_name'},
                        { data: 'product_provider_name' },
                        { data: 'product_provider_code'},
                        { data: 'product_provider_price'},
                        { data: 'product_provider_admin_fee'},
                        { data: 'product_provider_merchant_fee'},
                        { data: 'created_by' },
                        { data: 'updated_by' },
                        { data: 'created_at' },
                        { data: 'updated_at' }
                    ]
                });

                // axios.post('{{route('makarios.getdataproductprovider')}}')
                // .then(response => {
                //     console.log(response.data);
                //     mainData.value=response.data.data;
                //     nextTick( () => {
                //         $('#dataTbl').DataTable({
                //        destroy: true,
                //         responsive: true,
                //         autoWidth: false
                //         });
                //     });
                // })
                // .catch(error => {
                //     console.error("Error fetching data:", error);
                //     if (error.response) {
                //         this.errorMessage = error.response.data.message;
                //         this.successMessage = '';  // Reset success jika ada
                //     }
                // });
            }
            const deleteData=(id)=>{
                axios.get(`{{route('makarios.deletedataproductprovider','')}}/${id}`)
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
                updateProviderName,
               providers,
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