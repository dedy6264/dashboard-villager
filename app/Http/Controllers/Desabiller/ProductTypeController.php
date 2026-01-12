<?php

namespace App\Http\Controllers\Desabiller;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\HostService;
class ProductTypeController extends Controller
{
 protected $hostService;
    public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
    public function index()
    {
        return view('desabiller.product_type.index');
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
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/product-type/get', $payload)->json();
        // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
        return $response;   
    }


    public function store(Request $request)
    {
        
        $filter=[
            "productTypeName"=>$request->product_type_name,
        ];
         $payload=[
            "id"=>0,
            "clientName"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/product-type/add', $payload)->json();
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }

    public function update(Request $request)
    {
        
        $filter=[
            "id"=>(int)$request->id,
            "productTypeName"=>$request->product_type_name,
        ];
         $payload=[
            "id"=>0,
            "clientName"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/product-type/update', $payload)->json();
        // dd($response);
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }


    public function destroy($id)
    {
        
        $filter=[
            "id"=>(int)$id,
        ];
         $payload=[
            "id"=>0,
            "clientName"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/product-type/drop', $payload)->json();
        // dd($response);
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }
}
