<?php

namespace App\Http\Controllers;

use App\Models\MerchantOutlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MerchantOutletController extends Controller
{

    public function index()
    {
        $payload=["id"=>0,"clientName"=>"","filter"=>["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw]];
        $response = Http::withBasicAuth('joe','secret')->post('http://localhost:10010/client/gets', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $clients = $response['result']['data'];
        $payload=["id"=>0,"clientName"=>"","filter"=>["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw]];
        $response = Http::withBasicAuth('joe','secret')->post('http://localhost:10010/group/gets', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $groups = $response['result']['data'];
        $payload=["id"=>0,"clientName"=>"","filter"=>["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw]];
        $response = Http::withBasicAuth('joe','secret')->post('http://localhost:10010/merchant/gets', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $merchants = $response['result']['data'];
        // dd($groups);
        return view('dashboard.merchant_outlet.index',compact('clients','groups','merchants'));
    }
    public function getAll()
    {
        // dd(request()->all());
        $filter=[
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
        ];
        $payload=[
            "id"=>0,
            "clientName"=>request()->client_name,
            "groupName"=>request()->group_name,
            "merchantName"=>request()->merchant_name,
            "merchantOutletName"=>request()->merchant_outlet_name,
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post('http://localhost:10010/merchantOutlet/gets', $payload)->json();
        // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
        return $response;
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $payload=[
            "clientName"=>$request->client_name,
            "clientId"=>$request->client_id,
            "groupName"=>$request->group_name,
            "groupId"=>$request->group_id,
            "merchantId"=>$request->merchant_id,
            "merchantName"=>$request->merchant_name,
            "merchantName"=>$request->merchant_name,
            "merchantOutletName"=>$request->merchant_outlet_name,
            "merchantOutletUsername"=>$request->merchant_outlet_username,
            "merchantOutletPassword"=>$request->merchant_outlet_password,
        ];
        $response = Http::withBasicAuth('joe','secret')->post('http://localhost:10010/merchantOutlet/add', $payload)->json();
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
            "clientName"=>$request->client_name,
            "clientId"=>$request->client_id,
            "groupName"=>$request->group_name,
            "groupId"=>$request->group_id,
            "merchantId"=>$request->merchant_id,
            "merchantName"=>$request->merchant_name,
            "merchantOutletName"=>$request->merchant_outlet_name,
            "merchantOutletUsername"=>$request->merchant_outlet_username,
            "merchantOutletPassword"=>$request->merchant_outlet_password,
        ];
        $response = Http::withBasicAuth('joe','secret')->post('http://localhost:10010/merchantOutlet/update', $payload)->json();
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
        $response = Http::withBasicAuth('joe','secret')->post('http://localhost:10010/merchantOutlet/drop', $payload)->json();
        // dd($response);
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }
}
