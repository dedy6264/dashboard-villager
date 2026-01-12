<?php

namespace App\Http\Controllers\Desabiller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\HostService;
class SavingSegmentController extends Controller
{
     public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
    public function index()
    {
          $filter=[
            "id"=>0,
            "savingTypeName"=>"",
            "savingTypeDesc"=>""
        ];
       $payload=[
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
            "columns"=>"",
            "search"=>"",
            "order"=>"",
            "sort"=>"",
            "startDate"=>"",
            "endDate"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/saving-type/gets', $payload)->json();
        // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $savingType = $response['result']['data'];
        return view('desabiller.saving_segment.index', compact('savingType'));
    }

    public function getAll()
    {
        $filter=[
            "id"=>0,
            "savingSegmentName"=>"",
            "limitAmount"=>0,
            "savingTypeId"=>0,
            "savingTypeName"=>""
        ];
       $payload=[
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
            "columns"=>"",
            "search"=>"",
            "order"=>"",
            "sort"=>"",
            "startDate"=>"",
            "endDate"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/saving-segment/gets', $payload)->json();
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
            "savingSegmentName"=>$request->savingSegmentName,
            "limitAmount"=>(int)$request->limitAmount,
            "savingTypeId"=>(int)$request->savingTypeId,
            "savingTypeName"=>$request->savingTypeName,
        ];
       $payload=[
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
            "columns"=>"",
            "search"=>"",
            "order"=>"",
            "sort"=>"",
            "startDate"=>"",
            "endDate"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/saving-segment/add', $payload)->json();
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
            "savingSegmentName"=>$request->savingSegmentName,
            "limitAmount"=>(int)$request->limitAmount,
            "savingTypeId"=>(int)$request->savingTypeId,
            "savingTypeName"=>$request->savingTypeName,
        ];
       $payload=[
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
            "columns"=>"",
            "search"=>"",
            "order"=>"",
            "sort"=>"",
            "startDate"=>"",
            "endDate"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/saving-segment/update', $payload)->json();
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
            "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
            "columns"=>"",
            "search"=>"",
            "order"=>"",
            "sort"=>"",
            "startDate"=>"",
            "endDate"=>"",
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/saving-segment/drop', $payload)->json();
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }
}
