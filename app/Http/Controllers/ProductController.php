<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\HostService;
class ProductController extends Controller
{
  protected $hostService;
    public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
    public function index()
    {
        
        $filter=[
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
        ];
        $payload=[
            "id"=>0,
            "clientName"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/provider/gets', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $providers = $response['result']['data'];
        $filter=[
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
        ];
        $payload=[
            "id"=>0,
            "clientName"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/type/gets', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $productTypes = $response['result']['data'];
        $filter=[
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
        ];
        $payload=[
            "id"=>0,
            "clientName"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/category/gets', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $productCategories = $response['result']['data'];
        return view('dashboard.product.index',compact('providers','productTypes','productCategories'));
    }


    public function getAll()
    {
        
        $filter=[
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
        ];
        $payload=[
            "id"=>0,
            "clientName"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/product/gets', $payload)->json();
        // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
        return $response;    
    }


    public function store(Request $request)
    {
        
        $payload=[
            "productName"=>$request->product_name,
            "productCode"=>$request->product_code,
            "productProviderId"=>(int)$request->product_provider_id,
            "productReferenceId"=>(int)$request->product_reference_id,
            "productReferenceCode"=>$request->product_reference_code,
            "productCategoryId"=>(int)$request->product_category_id,
            "productTypeId"=>(int)$request->product_type_id,
            "productAdminFee"=>(int)$request->product_admin_fee,
            "productPrice"=>(int)$request->product_price,
            "productMerchantFee"=>(int)$request->product_merchant_fee,

            "product_provider_name"=>$request->product_provider_name,
            "product_provider_code"=>$request->product_provider_code,
            "provider_name"=>$request->provider_name,
            "provider_id"=>$request->provider_id,
            "product_provider_price"=>$request->product_provider_price,
            "product_provider_admin_fee"=>$request->product_provider_admin_fee,
            "product_provider_merchant_fee"=>$request->product_provider_merchant_fee,
            "product_type_name"=>$request->product_type_name,
            "product_category_name"=>$request->product_category_name,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/product/add', $payload)->json();
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }

    public function update(Request $request, $id)
    {
        
        $payload=[
            "id"=>(int)$request->id,
            "productName"=>$request->product_name,
            "productCode"=>$request->product_code,
            "productProviderId"=>(int)$request->product_provider_id,
            "productReferenceId"=>(int)$request->product_reference_id,
            "productReferenceCode"=>$request->product_reference_code,
            "productCategoryId"=>(int)$request->product_category_id,
            "productTypeId"=>(int)$request->product_type_id,
            "productAdminFee"=>(int)$request->product_admin_fee,
            "productPrice"=>(int)$request->product_price,
            "productMerchantFee"=>(int)$request->product_merchant_fee,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/product/update', $payload)->json();
        // dd($response);
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }


    public function destroy($id)
    {
        
        $payload=[
            "id"=>(int)$id,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/product/drop', $payload)->json();
        // dd($response);
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }
}
