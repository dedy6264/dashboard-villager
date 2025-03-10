<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{

    public function index()
    {
        // $filter=["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw,];
        // $payload=["id"=>0,"clientName"=>"","filter"=>$filter,];
        // $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/client/gets', $payload)->json();
        // if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {return response()->json(['error' => 'Invalid API response format or data type'], 500);}
        // $clients = $response['result']['data'];
        // $filter=["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw,];
        // $payload=[    "id"=>0,    "clientName"=>"",    "filter"=>$filter,];
        // $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/group/gets', $payload)->json();
        // if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {return response()->json(['error' => 'Invalid API response format or data type'], 500);}
        // $groups = $response['result']['data'];
        // $filter=["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw,];
        // $payload=["id"=>0,"clientName"=>"","filter"=>$filter];
        // $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/merchant/gets', $payload)->json();
        // if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {return response()->json(['error' => 'Invalid API response format or data type'], 500);}
        // $merchants = $response['result']['data'];
        return view('dashboard.transaction.index');
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
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/trx/getTrx', $payload)->json();
        // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
        return $response;    
    }


}
