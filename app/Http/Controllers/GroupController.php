<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Services\HostService;
class GroupController extends Controller
{
     protected $hostService;
    public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
    public function index()
    {
       
        $payload=[
            "id"=>0,
            "clientName"=>"",
            "filter"=>[
                "start"=>(int)request()->start,
                "length"=>(int)request()->length,
                "draw"=>(int)request()->draw,
            ],
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/client/gets', $payload)->json();
        // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $clients = $response['result']['data'];
        return view('dashboard.group.index',compact('clients'));
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
            "filter"=>$filter,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/group/gets', $payload)->json();
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
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/group/add', $payload)->json();
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        // dd($response);
        return true;
    }
    public function update(Request $request, Group $group)
    {
       
        $payload=[
            "id"=>(int)$request->id,
            "clientName"=>$request->client_name,
            "clientId"=>$request->client_id,
            "groupName"=>$request->group_name,
        ];
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/group/update', $payload)->json();
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
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/group/drop', $payload)->json();
        // dd($response);
        if ($response['statusCode'] !=="00" ) {
            return response()->json(['error' => 'Failed'], 500);
        }
        $response = $response['result'];
        return true;
    }
}