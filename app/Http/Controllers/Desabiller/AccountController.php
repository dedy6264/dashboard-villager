<?php

namespace App\Http\Controllers\Desabiller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\HostService;
class AccountController extends Controller
{
    public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
    public function index()
    {
        return view('desabiller.account.index');
    }
     public function getAll()
    {
        $filter=[
          
            "id"=>0,
            "cifId"=>0,
            "accountNumber"=>"",
            "savingSegmentId"=>0,
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
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/account/gets', $payload)->json();
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
          
            "id"=>request()->filter->id,
            "cifId"=>request()->filter->cifId,
            "accountNumber"=>request()->filter->accountNumber,
        ];
        $payload=[
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/account/add', $payload)->json();
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }
}
