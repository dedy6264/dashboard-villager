<?php

namespace App\Http\Controllers\Desabiller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\HostService;
class SavingTransactionController extends Controller
{
       public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
    public function index()
    {
        return view('desabiller.saving_transaction.index');
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
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/saving-transaction/gets', $payload)->json();
        // dd($response);

        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
        return $response;   
    }
}
