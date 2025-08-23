@extends('makarios.app')
@section('mainContent')
<main>
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Product Segment</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item active">Product Segment \ Product Segment</li>
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
                            <th>Segment Name</th>
                            <th>Product Reference Name</th>
                            <th>Product Reference Code</th>
                            <th>Product Category Name</th>
                            <th>Provider Name</th>
                            <th>Product Provider Name</th>
                            <th>Product Provider Code</th>
                            <th>Product Provider Price</th>
                            <th>Product Provider Admin Fee</th>
                            <th>Product Provider Merchant Fee</th>
                            <th>Product Type Name</th>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Product Price</th>
                            <th>Product Admin Fee</th>
                            <th>Product Merchant Fee</th>
                            <th>Product Availability</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Created At</th>
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
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="dataModalLabel" >@{{ (editMode?'Edit User':'Tambah User')}}</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form @submit.prevent="editMode ? updateData() : createData()" >
                    <div class="row">
                        <div class="col-6">
                            {{-- Segment --}}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Segment </label>
                                    <select class="form-control" v-model="form.segment_id" @change="updateSegment">
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
                        </div>
                        <div class="col-6">
                            {{-- ptoductType --}}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Type </label>
                                    <select class="form-control" v-model="form.product_type_id" @change="updateProductType">
                                        <option disabled value="0">Pilih Product Type</option>
                                        <option v-for="item in productTypes" :key="item.id" :value="item.id">
                                            @{{ item.product_type_name }}
                                        </option>
                                    </select>

                                    <input type="text" name="product_type_name" id="product_type_name"
                                        class="form-control" hidden
                                        v-model="form.product_type_name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                             <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product</label>
                                    <select class="form-control" v-model="form.product_id" @change="updateProductName">
                                        <option disabled value="0">Pilih Product</option>
                                        <option v-for="item in products" :key="item.id" :value="item.id">
                                            @{{ item.product_name }}
                                        </option>
                                    </select>
                                    {{-- product_name --}}
                                    <input type="text" name="product_name" id="product_name"
                                        class="form-control" hidden
                                        v-model="form.product_name">
                                    {{-- product_reference_id --}}
                                    <input type="text" name="product_reference_id" id="product_reference_id"
                                        class="form-control" hidden
                                        v-model="form.product_reference_id">
                                    {{-- product_reference_name --}}
                                    <input type="text" name="product_reference_name" id="product_reference_name"
                                        class="form-control" hidden
                                        v-model="form.product_reference_name">
                                    {{-- product_reference_code --}}
                                    <input type="text" name="product_reference_code" id="product_reference_code"
                                        class="form-control" hidden
                                        v-model="form.product_reference_code">
                                    {{-- product_category_id --}}
                                    <input type="text" name="product_category_id" id="product_category_id"
                                        class="form-control" hidden
                                        v-model="form.product_category_id">
                                    {{-- product_category_name --}}
                                    <input type="text" name="product_category_name" id="product_category_name"
                                        class="form-control" hidden
                                        v-model="form.product_category_name">
                                    {{-- product_type_id --}}
                                    <input type="text" name="product_type_id" id="product_type_id"
                                        class="form-control" hidden
                                        v-model="form.product_type_id">
                                    {{-- product_type_name --}}
                                    <input type="text" name="product_type_name" id="product_type_name"
                                        class="form-control" hidden
                                        v-model="form.product_type_name">
                                </div>
                            </div>
                            {{-- product --}}
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Product Code</label>
                                <input type="amount"  class="form-control" v-model="form.product_code" aria-describedby="emailHelp" placeholder="product Price.." readonly>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Product Price</label>
                                <input type="amount"  class="form-control" v-model="form.product_price" aria-describedby="emailHelp" placeholder="product Price.." autofocus>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Product Admin Fee</label>
                                <input type="amount"  class="form-control" v-model="form.product_admin_fee" aria-describedby="emailHelp" placeholder="product Admin Fee.." autofocus>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Product Merchant Fee</label>
                                <input type="amount"  class="form-control" v-model="form.product_merchant_fee" aria-describedby="emailHelp" placeholder="product Merchant Fee.." autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                             {{-- provider --}}
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
                            {{-- product provider --}}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Provider </label>
                                    <select class="form-control" v-model="form.product_provider_id" @change="updateProductProviderName">
                                        <option disabled value="0">Pilih Provider</option>
                                        <option v-for="item in productProviders" :key="item.id" :value="item.id">
                                            @{{ item.product_provider_name }}
                                        </option>
                                    </select>

                                    <input type="text" name="product_provider_name" id="product_provider_name"
                                        class="form-control" hidden
                                        v-model="form.product_provider_name">
                                    <input type="text" name="product_provider_code" id="product_provider_code"
                                        class="form-control" hidden
                                        v-model="form.product_provider_code">
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Product Provider Price</label>
                                <input type="amount" id="product_provider_price"  class="form-control" v-model="form.product_provider_price" aria-describedby="emailHelp" placeholder="product Provider Price.." readonly>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Product Provider Admin Fee</label>
                                <input type="amount"  class="form-control" v-model="form.product_provider_admin_fee" aria-describedby="emailHelp" placeholder="product Provider Admin Fee.." readonly>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Product Provider Merchant Fee</label>
                                <input type="amount"  class="form-control" v-model="form.product_provider_merchant_fee" aria-describedby="emailHelp" placeholder="product Provider Merchant Fee.." readonly>
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
            const mainData=ref();
            let productProviders=ref({});
            const products=ref(@json($products));
            const segments=ref(@json($segments));
            const productTypes=ref(@json($productTypes));
            const providers=ref(@json($providers));
            const updateProviderName=()=>{
                            const selected = providers.value.find(t => t.id === form.value.provider_id);
                            form.value.provider_name = selected ? selected.provider_name : '';
                            axios.post('{{route('makarios.getdataproductproviderjson')}}',{
                                provider_id:form.value.provider_id,
                            })
                            .then(response => {
                                productProviders.value=response.data.data;
                            })
                            .catch(error => {
                                console.error("Error fetching data:", error);
                                if (error.response) {
                                    this.errorMessage = error.response.data.message;
                                    this.successMessage = '';  // Reset success jika ada
                                }
                            });
                        }
            const updateProductName=()=>{
                            const selected = products.value.find(t => t.id === form.value.product_id);
                            form.value.product_name = selected ? selected.product_name : '';
                            form.value.product_code = selected ? selected.product_code : '';
                            form.value.product_reference_id=selected?selected.product_reference_id:'';
                            form.value.product_reference_name=selected?selected.product_reference_name:'';
                            form.value.product_reference_code=selected?selected.product_reference_code:'';
                            form.value.product_category_id=selected?selected.product_category_id:'';
                            form.value.product_category_name=selected?selected.product_category_name:'';
                        }
            const updateProductType=()=>{
                            const selected = productTypes.value.find(t => t.id === form.value.product_type_id);
                            form.value.product_type_name = selected ? selected.product_type_name : '';
                        }
            const updateSegment=()=>{
                            const selected = segments.value.find(t => t.id === form.value.segment_id);
                            form.value.segment_name = selected ? selected.segment_name : '';
                        }
            const updateProductProviderName=()=>{
                            const selected = productProviders.value.find(t => t.id === form.value.product_provider_id);
                            form.value.product_provider_name = selected ? selected.product_provider_name : '';
                            form.value.product_provider_code = selected ? selected.product_provider_code : '';
                            form.value.product_provider_price=selected?selected.product_provider_price:'';
                            form.value.product_provider_admin_fee=selected?selected.product_provider_admin_fee:'';
                            form.value.product_provider_merchant_fee=selected?selected.product_provider_merchant_fee:'';
                        }
            const form=ref({
                id:0,
                segment_id:0,
                segment_name:"",
                product_reference_id:0,
                product_reference_name:"",
                product_reference_code:"",
                product_category_id:0,
                product_category_name:"",
                provider_id:0,
                provider_name:"",
                product_provider_id:0,
                product_provider_name:"",
                product_provider_code:"",
                product_provider_price:0,
                product_provider_admin_fee:0,
                product_provider_merchant_fee:0,
                product_type_id:0,
                product_type_name:"",
                product_id:0,
                product_name:"",
                product_code:"",
                product_price:0,
                product_admin_fee:0,
                product_merchant_fee:0,
                product_availability:"",
            })
            const editMode=ref(false);
            const createModal=()=>{
                form.value.segment_id=0;
                form.value.segment_name="";
                form.value.product_reference_id=0;
                form.value.product_reference_name="";
                form.value.product_reference_code="";
                form.value.product_category_id=0;
                form.value.product_category_name="";
                form.value.provider_id=0;
                form.value.provider_name="";
                form.value.product_provider_id=0;
                form.value.product_provider_name="";
                form.value.product_provider_code="";
                form.value.product_provider_price=0;
                form.value.product_provider_admin_fee=0;
                form.value.product_provider_merchant_fee=0;
                form.value.product_type_id=0;
                form.value.product_type_name="";
                form.value.product_id=0;
                form.value.product_name="";
                form.value.product_code="";
                form.value.product_price=0;
                form.value.product_admin_fee=0;
                form.value.product_merchant_fee=0;
                form.value.product_availability="";
                form.value.id=0;
                $('#dataModal').modal('show')
            }
            const updateModal=(id)=>{
                    editMode.value=true;
                    form.value.id=id;
                    mainData.value.forEach((data) => {
                        if(data.id==id){
                            form.value.segment_id=data.segment_id;
                            form.value.segment_name=data.segment_name;
                            form.value.product_reference_id=data.product_reference_id;
                            form.value.product_reference_name=data.product_reference_name;
                            form.value.product_reference_code=data.product_reference_code;
                            form.value.product_category_id=data.product_category_id;
                            form.value.product_category_name=data.product_category_name;
                            form.value.provider_id=data.provider_id;
                            form.value.provider_name=data.provider_name;
                            form.value.product_provider_id=data.product_provider_id;
                            form.value.product_provider_name=data.product_provider_name;
                            form.value.product_provider_code=data.product_provider_code;
                            form.value.product_provider_price=data.product_provider_price;
                            form.value.product_provider_admin_fee=data.product_provider_admin_fee;
                            form.value.product_provider_merchant_fee=data.product_provider_merchant_fee;
                            form.value.product_type_id=data.product_type_id;
                            form.value.product_type_name=data.product_type_name;
                            form.value.product_id=data.product_id;
                            form.value.product_name=data.product_name;
                            form.value.product_code=data.product_code;
                            form.value.product_price=data.product_price;
                            form.value.product_admin_fee=data.product_admin_fee;
                            form.value.product_merchant_fee=data.product_merchant_fee;
                            form.value.product_availability=data.product_availability;
                        }
                    });
                    $('#dataModal').modal('show')
            }
            const createData=()=>{
                console.log("req::", form.value);
                axios.post('{{route('makarios.adddataproductsegment')}}', {
                    segment_id:form.value.segment_id,
                    segment_name:form.value.segment_name,
                    product_reference_id:form.value.product_reference_id,
                    product_reference_name:form.value.product_reference_name,
                    product_reference_code:form.value.product_reference_code,
                    product_category_id:form.value.product_category_id,
                    product_category_name:form.value.product_category_name,
                    provider_id:form.value.provider_id,
                    provider_name:form.value.provider_name,
                    product_provider_id:form.value.product_provider_id,
                    product_provider_name:form.value.product_provider_name,
                    product_provider_code:form.value.product_provider_code,
                    product_provider_price:form.value.product_provider_price,
                    product_provider_admin_fee:form.value.product_provider_admin_fee,
                    product_provider_merchant_fee:form.value.product_provider_merchant_fee,
                    product_type_id:form.value.product_type_id,
                    product_type_name:form.value.product_type_name,
                    product_id:form.value.product_id,
                    product_name:form.value.product_name,
                    product_code:form.value.product_code,
                    product_price:form.value.product_price,
                    product_admin_fee:form.value.product_admin_fee,
                    product_merchant_fee:form.value.product_merchant_fee,
                    product_availability:form.value.product_availability,
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
                axios.post('{{route('makarios.updatedataproductsegment')}}',{
                    segment_id:form.value.segment_id,
                    segment_name:form.value.segment_name,
                    product_reference_id:form.value.product_reference_id,
                    product_reference_name:form.value.product_reference_name,
                    product_reference_code:form.value.product_reference_code,
                    product_category_id:form.value.product_category_id,
                    product_category_name:form.value.product_category_name,
                    provider_id:form.value.provider_id,
                    provider_name:form.value.provider_name,
                    product_provider_id:form.value.product_provider_id,
                    product_provider_name:form.value.product_provider_name,
                    product_provider_code:form.value.product_provider_code,
                    product_provider_price:form.value.product_provider_price,
                    product_provider_admin_fee:form.value.product_provider_admin_fee,
                    product_provider_merchant_fee:form.value.product_provider_merchant_fee,
                    product_type_id:form.value.product_type_id,
                    product_type_name:form.value.product_type_name,
                    product_id:form.value.product_id,
                    product_name:form.value.product_name,
                    product_code:form.value.product_code,
                    product_price:form.value.product_price,
                    product_admin_fee:form.value.product_admin_fee,
                    product_merchant_fee:form.value.product_merchant_fee,
                    product_availability:form.value.product_availability,
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
                console.log("::",products.value);
                console.log("::",productTypes.value);
                console.log("::",providers.value);
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
                        url: '{{route('makarios.getdataproductsegment')}}',
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
                        { data: 'segment_name' },
                        { data: 'product_reference_name' },
                        { data: 'product_reference_code' },
                        { data: 'product_category_name' },
                        { data: 'provider_name' },
                        { data: 'product_provider_name' },
                        { data: 'product_provider_code' },
                        { data: 'product_provider_price' },
                        { data: 'product_provider_admin_fee' },
                        { data: 'product_provider_merchant_fee' },
                        { data: 'product_type_name' },
                        { data: 'product_name' },
                        { data: 'product_code' },
                        { data: 'product_price' },
                        { data: 'product_admin_fee' },
                        { data: 'product_merchant_fee' },
                        { data: 'product_availability' },
                        { data: 'created_by' },
                        { data: 'updated_by' },
                        { data: 'created_at' },
                        { data: 'updated_at' }
                    ]
                });
            }
            const deleteData=(id)=>{
                axios.get(`{{route('makarios.deletedataproductsegment','')}}/${id}`)
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
                segments,
                updateSegment,
                productTypes,
                updateProductType,
                updateProductProviderName,
                productProviders,
                products,
                providers,
                updateProviderName,
                updateProductName,
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