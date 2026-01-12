<?php

namespace App\Http\Controllers\Desabiller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\HostService;
class SavingTypeController extends Controller
{
 protected $hostService;
    public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
    public function index()
    {
        return view('desabiller.saving_type.index');
    }
    public function getAll()
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
        $response = $response['result'];
        return $response;
    }

}
