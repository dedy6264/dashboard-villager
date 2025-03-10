<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MerchantController extends Controller
{
    public function index()
    {
        $payload=["id"=>0,"clientName"=>"","filter"=>["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw]];
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/client/gets', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $clients = $response['result']['data'];
        $payload=["id"=>0,"clientName"=>"","filter"=>["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw]];
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/group/gets', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $groups = $response['result']['data'];
        // dd($groups);
        return view('dashboard.merchant.index',compact('clients','groups'));
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
            "groupName"=>"",
            "merchantName"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/merchant/gets', $payload)->json();
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
            "clientName"=>$request->client_name,
            "clientId"=>$request->client_id,
            "groupName"=>$request->group_name,
            "groupId"=>$request->group_id,
            "merchantName"=>$request->merchant_name,
        ];
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/merchant/add', $payload)->json();
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }

    public function update(Request $request, Merchant $merchant)
    {
        $payload=[
            "id"=>(int)$request->id,
            "clientName"=>$request->client_name,
            "clientId"=>$request->client_id,
            "groupName"=>$request->group_name,
            "groupId"=>$request->group_id,
            "merchantName"=>$request->merchant_name,
        ];
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/merchant/update', $payload)->json();
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
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/merchant/drop', $payload)->json();
        // dd($response);
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }
}
