<?php

namespace App\Http\Controllers\Desabiller;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\HostService;
class TransactionController extends Controller
{
 protected $hostService;
    public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
    public function index()
    {

        // $filter=["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw,];
        // $payload=["id"=>0,"clientName"=>"","filter"=>$filter,];
        // $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/client/gets', $payload)->json();
        // if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {return response()->json(['error' => 'Invalid API response format or data type'], 500);}
        // $clients = $response['result']['data'];
        // $filter=["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw,];
        // $payload=[    "id"=>0,    "clientName"=>"",    "filter"=>$filter,];
        // $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/group/gets', $payload)->json();
        // if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {return response()->json(['error' => 'Invalid API response format or data type'], 500);}
        // $groups = $response['result']['data'];
        // $filter=["start"=>(int)request()->start,"length"=>(int)request()->length,"draw"=>(int)request()->draw,];
        // $payload=["id"=>0,"clientName"=>"","filter"=>$filter];
        // $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/merchant/gets', $payload)->json();
        // if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {return response()->json(['error' => 'Invalid API response format or data type'], 500);}
        // $merchants = $response['result']['data'];
        return view('desabiller.transaction.index');
    }


    public function getAll()
    {
        // dd(request()->all());
        $filter=[
            "id"=>0,
           
        ];
        $payload=[
             "start"=>(int)request()->start,
            "length"=>(int)request()->length,
            "draw"=>(int)request()->draw,
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/public/trx/getTrxs', $payload)->json();
        // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        // $response = $response['result'];
         $userData = $response['result'] ?? null;
        //  dd($userData);
                     return response()->json([
                        'draw' => intval(request()->input('draw')), // ambil dari request
                        'recordsTotal' => $userData['recordsTotal'],
                        'recordsFiltered' => $userData['recordsFiltered'],
                        'data' => $userData['data']
                    ]);
    }


}
