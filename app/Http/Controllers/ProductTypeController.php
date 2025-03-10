<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductTypeController extends Controller
{

    public function index()
    {
        return view('dashboard.product_type.index');
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
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/type/gets', $payload)->json();
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
            "productTypeName"=>$request->product_type_name,
        ];
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/type/add', $payload)->json();
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
            "productTypeName"=>$request->product_type_name,
        ];
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/type/update', $payload)->json();
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
        $response = Http::withBasicAuth('joe','secret')->post(env('HOST_VILLAGER').'/type/drop', $payload)->json();
        // dd($response);
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }
}
