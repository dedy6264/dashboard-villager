<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\HostService;
class ProductProviderController extends Controller
{
 protected $hostService;
    public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
    public function index()
    {
         
        $payload=["id"=>0,"clientName"=>"","filter"=>["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw]];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/provider/gets', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $providers = $response['result']['data'];
        return view('dashboard.product_provider.index',compact('providers'));
    }


    public function getAll()
    {
         
        $filter=[
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
        ];
        $payload=[
            "id"=>(int)request()->id,
            "providerId"=>(int)request()->provider_id,
            "clientName"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/product-provider/gets', $payload)->json();
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
            "providerName"=>$request->provider_name,
            "productProviderName"=>$request->product_provider_name,
            "productProviderCode"=>$request->product_provider_code,
            "providerId"=>(int)$request->provider_id,
            "productProviderAdminFee"=>(int)$request->product_provider_admin_fee,
            "productProviderPrice"=>(int)$request->product_provider_price,
            "productProviderMerchantFee"=>(int)$request->product_provider_merchant_fee,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/product-provider/add', $payload)->json();
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }

    public function update(Request $request)
    {
         
        $payload=[
            "id"=>(int)$request->id,
            "providerName"=>$request->provider_name,
            "productProviderName"=>$request->product_provider_name,
            "productProviderCode"=>$request->product_provider_code,
            "providerId"=>(int)$request->provider_id,
            "productProviderAdminFee"=>(int)$request->product_provider_admin_fee,
            "productProviderPrice"=>(int)$request->product_provider_price,
            "productProviderMerchantFee"=>(int)$request->product_provider_merchant_fee,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/product-provider/update', $payload)->json();
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
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/product-provider/drop', $payload)->json();
        // dd($response);
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }
}
