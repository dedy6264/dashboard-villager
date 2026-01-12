@extends('app')
@php
    $activePage = 'product';
@endphp
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
                            <th>Action</th>
                            <th>Product Type Name</th>
                            <th>Product Category Name</th>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Product Reference Code</th>
                            <th>Product Price</th>
                            <th>Product Admin Fee</th>
                            <th>Product Merchant Fee</th>
                            <th>Product Provider Name</th>
                            <th>Product Provider Code</th>
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
                                        <button type="button" class="shadow-sm d-sm-inline-block btn btn-sm btn-success" @click="updateModal(item.id)"><i class="fas fa-edit fa-sm text-white-50"></i></button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="shadow-sm d-sm-inline-block btn btn-sm btn-danger" @click="deleteData(item.id)"><i class="fas fa-minus fa-sm text-white-50"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td v-text="item.productTypeName"></td>
                            <td v-text="item.productCategoryName"></td>
                            <td v-text="item.productName"></td>
                            <td v-text="item.productCode"></td>
                            <td v-text="item.productReferenceCode"></td>
                            <td v-text="item.productPrice"></td>
                            <td v-text="item.productAdminFee"></td>
                            <td v-text="item.productMerchantFee"></td>
                            <td v-text="item.productProviderName"></td>
                            <td v-text="item.productProviderCode"></td>
                            <td v-text="item.productProviderPrice"></td>
                            <td v-text="item.productProviderAdminFee"></td>
                            <td v-text="item.productProviderMerchantFee"></td>
                            <td v-text="item.updatedAt"></td>
                            <td v-text="item.updatedBy"></td>
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
                                <label for="exampleInputEmail1">Product Type</label>
                                <select class="form-control" v-model='form.product_type_id' >
                                    <option value="-1"></option>
                                    <option v-for="item in productTypes" :key="item.id" :value="item.id" >@{{ item.productTypeName }}</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Product Category</label>
                                <select class="form-control" v-model='form.product_category_id' >
                                    <option value="-1"></option>
                                    <option v-for="item in productCategories" :key="item.id" :value="item.id" >@{{ item.productCategoryName }}</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Product Name</label>
                                  <input type="text"  class="form-control" v-model="form.product_name" aria-describedby="emailHelp" placeholder="Product Name" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Product Code</label>
                                  <input type="text"  class="form-control" v-model="form.product_code" aria-describedby="emailHelp" placeholder="Product Code" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Product Price</label>
                                  <input type="number"  class="form-control" v-model="form.product_price" aria-describedby="emailHelp" placeholder="Product Price" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Product Admin Fee</label>
                                  <input type="number"  class="form-control" v-model="form.product_admin_fee" aria-describedby="emailHelp" placeholder="Product Admin Fee" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Product Merchant Fee</label>
                                  <input type="number"  class="form-control" v-model="form.product_merchant_fee" aria-describedby="emailHelp" placeholder="Product Merchant Fee" autofocus>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Provider Product Name</label>
                                  <input type="text"  class="form-control" v-model="form.product_provider_name" aria-describedby="emailHelp" placeholder="Product Name" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Provider Product Code</label>
                                  <input type="text"  class="form-control" v-model="form.product_provider_code" aria-describedby="emailHelp" placeholder="Product Code" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Provider Product Price</label>
                                  <input type="number"  class="form-control" v-model="form.product_provider_price" aria-describedby="emailHelp" placeholder="Product Price" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Provider Product Admin Fee</label>
                                  <input type="number"  class="form-control" v-model="form.product_provider_admin_fee" aria-describedby="emailHelp" placeholder="Product Admin Fee" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Provider Product Merchant Fee</label>
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
            const productTypes=ref(@json($productTypes));
            const productCategories=ref(@json($productCategories));
            const form=ref({
                id:0,
                product_provider_name:"",
                product_provider_code:"",
                product_provider_price:0,
                product_provider_admin_fee:0,
                product_provider_merchant_fee:0,

                product_type_id:0,
                product_type_name:"",
                product_category_id:0,
                product_category_name:"",
                product_name:"",
                product_code:"",
                product_reference_id:0,
                product_reference_code:"",
                product_price:0,
                product_admin_fee:0,
                product_merchant_fee:0,
            });
            const editMode=ref(false);
            const providerProductSelector=(id)=>{
                axios.post('{{route('productProviders.getAll')}}',{
                    provider_id:id,
                })
                .then(response => {
                    productProviders.value=response.data.data
                    console.log(productProviders.value);
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    if (error.response) {
                        this.errorMessage = error.response.data.message;
                        this.successMessage = '';  // Reset success jika ada
                    }
                });
            }
            const formSelector=()=>{
                productTypes.value.forEach((data) => {
                    if(data.id==form.value.product_type_id){
                        form.value.product_type_name=data.productTypeName;
                    }
                });

                productCategories.value.forEach((data) => {
                    if(data.id==form.value.product_category_id){
                        form.value.product_category_name=data.productCategoryName;
                    }
                });
                
            };
            const createModal=()=>{
                form.value.product_provider_name='';
                form.value.product_provider_code='';
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
                            form.value.product_provider_price=data.productProviderPrice;
                            form.value.product_provider_admin_fee=data.productProviderAdminFee;
                            form.value.product_provider_merchant_fee=data.productProviderMerchantFee;
                        }
                    });
                    $('#dataModal').modal('show')
            }

            const createData=()=>{
                formSelector();
                axios.post('{{route('products.store')}}', {
                    product_provider_name: form.value.product_provider_name,
                    product_provider_code: form.value.product_provider_code,
                    product_provider_price: form.value.product_provider_price,
                    product_provider_admin_fee: form.value.product_provider_admin_fee,
                    product_provider_merchant_fee: form.value.product_provider_merchant_fee,
                    product_type_id:form.value.product_type_id,
                    product_type_name:form.value.product_type_name,
                    product_category_id:form.value.product_category_id,
                    product_category_name:form.value.product_category_name,
                    product_name:form.value.product_name,
                    product_code:form.value.product_code,
                    product_reference_id:form.value.product_reference_id,
                    product_reference_code:form.value.product_reference_code,
                    product_price:form.value.product_price,
                    product_admin_fee:form.value.product_admin_fee,
                    product_merchant_fee:form.value.product_merchant_fee,
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
                axios.post('{{route('products.update')}}',{
                    product_provider_name: form.value.product_provider_name,
                    product_provider_code: form.value.product_provider_code,
                    product_provider_price: form.value.product_provider_price,
                    product_provider_admin_fee: form.value.product_provider_admin_fee,
                    product_provider_merchant_fee: form.value.product_provider_merchant_fee,
                    product_type_id:form.value.product_type_id,
                    product_type_name:form.value.product_type_name,
                    product_category_id:form.value.product_category_id,
                    product_category_name:form.value.product_category_name,
                    product_name:form.value.product_name,
                    product_code:form.value.product_code,
                    product_reference_id:form.value.product_reference_id,
                    product_reference_code:form.value.product_reference_code,
                    product_price:form.value.product_price,
                    product_admin_fee:form.value.product_admin_fee,
                    product_merchant_fee:form.value.product_merchant_fee,
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
                axios.post('{{route('products.getAll')}}')
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
                axios.get(`{{route('products.destroy','')}}/${id}`)
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
                productCategories,
                productTypes,
                providerProductSelector,
                formSelector,
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