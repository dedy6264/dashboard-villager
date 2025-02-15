@extends('app')
@section('mainContent')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Product Provider</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Provider \ Product Provider</li>
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
                            <th>Product Provider Name</th>
                            <th>Product Provider Code</th>
                            <th>Provider Name</th>
                            <th>Product Provider Price</th>
                            <th>Product Provider Admin Fee</th>
                            <th>Product Provider Merchant Fee</th>
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
                            <td v-text="item.productProviderName"></td>
                            <td v-text="item.productProviderCode"></td>
                            <td v-text="item.providerName"></td>
                            <td v-text="item.productProviderPrice"></td>
                            <td v-text="item.productProviderAdminFee"></td>
                            <td v-text="item.productProviderMerchantFee"></td>
                            <td v-text="item.createdAt"></td>
                            <td v-text="item.updatedAt"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--modal-->
        <div class="modal fade" id="dataModal" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="dataModalLabel" >@{{ (editMode?'Edit Product Provider':'Tambah Product Provider')}}</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="editMode ? updateData() : createData()" >
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Provider</label>
                                <select class="form-control" v-model='form.provider_id'>
                                    <option value="-1"></option>
                                    <option v-for="item in providers" :key="item.id" :value="item.id">@{{ item.providerName }}</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Product Name</label>
                                  <input type="text"  class="form-control" v-model="form.product_provider_name" aria-describedby="emailHelp" placeholder="Product Name" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Product Code</label>
                                  <input type="text"  class="form-control" v-model="form.product_provider_code" aria-describedby="emailHelp" placeholder="Product Code" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Product Price</label>
                                  <input type="number"  class="form-control" v-model="form.product_provider_price" aria-describedby="emailHelp" placeholder="Product Price" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Product Admin Fee</label>
                                  <input type="number"  class="form-control" v-model="form.product_provider_admin_fee" aria-describedby="emailHelp" placeholder="Product Admin Fee" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Product Merchant Fee</label>
                                  <input type="number"  class="form-control" v-model="form.product_provider_merchant_fee" aria-describedby="emailHelp" placeholder="Product Merchant Fee" autofocus>
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
    // import axios from "axios";

    const{createApp, ref,onMounted,nextTick }=Vue;

    createApp({
        setup(){
            const mainData=ref([]);
            const providers=ref(@json($providers));
            const filter=ref({
                        id:0,
                        provider_name:"",
                });
            const form=ref({
                id:0,
                product_provider_name:"",
                product_provider_code:"",
                provider_name:"",
                provider_id:"",
                product_provider_price:0,
                product_provider_admin_fee:0,
                product_provider_merchant_fee:0,
            });
            const editMode=ref(false);
            const formSelector=()=>{
                providers.value.forEach((data) => {
                        if(data.id==form.value.provider_id){
                            form.value.provider_name=data.providerName;
                        }
                    });
            };
            const createModal=()=>{
                form.value.product_provider_name='';
                form.value.product_provider_code='';
                form.value.provider_name='';
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
                            form.value.product_provider_name=data.productProviderName;
                            form.value.product_provider_code=data.productProviderCode;
                            form.value.provider_name=data.providerName;
                            form.value.product_provider_price=data.productProviderPrice;
                            form.value.product_provider_admin_fee=data.productProviderAdminFee;
                            form.value.product_provider_merchant_fee=data.productProviderMerchantFee;
                        }
                    });
                    $('#dataModal').modal('show')
            }

            const createData=()=>{
                formSelector();
                axios.post('{{route('productProviders.store')}}', {
                    product_provider_name: form.value.product_provider_name,
                    product_provider_code: form.value.product_provider_code,
                    provider_name: form.value.provider_name,
                    provider_id: form.value.provider_id,
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
                formSelector();
                axios.post('{{route('productProviders.update')}}',{
                    product_provider_name:form.value.product_provider_name,
                    product_provider_code:form.value.product_provider_code,
                    provider_name:form.value.provider_name,
                    provider_id:form.value.provider_id,
                    product_provider_price:form.value.product_provider_price,
                    product_provider_admin_fee:form.value.product_provider_admin_fee,
                    product_provider_merchant_fee:form.value.product_provider_merchant_fee,
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
                axios.post('{{route('productProviders.getAll')}}')
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
                axios.get(`{{route('productProviders.destroy','')}}/${id}`)
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
                formSelector,
                providers,
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