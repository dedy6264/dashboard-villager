<?php

namespace App\Http\Controllers\Makarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ProductController;
use App\Services\SegmentService;


class MakariosController extends Controller
{
    protected $segmentService;

    // otomatis Laravel resolve dependency
    public function __construct(SegmentService $segmentService)
    {
        $this->segmentService = $segmentService;
    }

    public function index()
    {
        return view('makarios.dashboard.index');
    }
    public function client()
    {
        return view('makarios.client.index');
    }
    public function getdataclient(){
         try {
           $payload=[
                "start"=>(int)request()->start,
                "length"=>(int)request()->length,
                "columns"=>"",
                "search"=>"",
                "order"=>"id",
                "sort"=>"asc",
                "startDate"=>"",
                "endDate"=>"",
                "draw"=>(int)request()->draw,
                "filter"=>[
                    "id"=>0,
                ],
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getClient',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                 case '00':
                    // Berhasil
                    $userData = $response['result'] ?? null;
                     return response()->json([
                        'draw' => intval(request()->input('draw')), // ambil dari request
                        'recordsTotal' => $userData['records_total'],
                        'recordsFiltered' => $userData['records_filtered'],
                        'data' => $userData['data']
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }
    public function adddataclient(){
        // dd(request()->all());
         try {
            $payload=[
                    "client_name"=>request()->client_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addClient',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    // return view('viller.history.payment',compact('userData'));
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
    }
    public function updatedataclient(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "client_name"=>request()->client_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateClient',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }
    public function deletedataclient($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteClient',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }






    public function group()
    {
        $dataClient=$this->getdataclient();
        $clientJsonString = $dataClient->getContent();
        // ubah jadi array PHP
        $clientJson = json_decode($clientJsonString, true);
        $clients=$clientJson['data'];
        return view('makarios.group.index',compact('clients'));
    }
     public function getdatagroup()
    {
         try {
             $payload=[
                "start"=>(int)request()->start,
                "length"=>(int)request()->length,
                "columns"=>"",
                "search"=>"",
                "order"=>"id",
                "sort"=>"asc",
                "startDate"=>"",
                "endDate"=>"",
                "draw"=>(int)request()->draw,
                "filter"=>[
                    "id"=>0,
                ],
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getGroup',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result'] ?? null;
                     return response()->json([
                        'draw' => intval(request()->input('draw')), // ambil dari request
                        'recordsTotal' => $userData['records_total'],
                        'recordsFiltered' => $userData['records_filtered'],
                        'data' => $userData['data']
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }
    public function adddatagroup(){
        // dd(request()->all());
         try {
            $payload=[
                    "client_id"=>(int)request()->client_id,
                    "client_name"=>request()->client_name,
                    "group_name"=>request()->group_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addGroup',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    // return view('viller.history.payment',compact('userData'));
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
    }
    public function updatedatagroup(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "client_id"=>(int)request()->client_id,
                "client_name"=>request()->client_name,
                "group_name"=>request()->group_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateGroup',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }
    public function deletedatagroup($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteGroup',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }


    public function merchant(){
        $dataClient=$this->getdataclient();
        $clientJsonString = $dataClient->getContent();
        // ubah jadi array PHP
        $clientJson = json_decode($clientJsonString, true);
        $clients=$clientJson['data'];

        //pakai service, bukan 
        $dataSegment = $this->segmentService->getSegment();
        $segmentJsonString = $dataSegment->getContent();
        $segmentJson = json_decode($segmentJsonString, true);
        $segments=$segmentJson['data'];
        // dd($segments);
        return view('makarios.merchant.index',compact('clients','segments'));
    }
    public function getdatamerchant(){
         try {
           $payload=[
                "start"=>(int)request()->start,
                "length"=>(int)request()->length,
                "columns"=>"",
                "search"=>"",
                "order"=>"id",
                "sort"=>"asc",
                "startDate"=>"",
                "endDate"=>"",
                "draw"=>(int)request()->draw,
                "filter"=>[
                    "id"=>0,
                ],
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getMerchant',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    // return view('viller.history.payment',compact('userData'));
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }
     public function adddatamerchant(){
        // dd(request()->all());
         try {
            $payload=[
                    "client_id"=>(int)request()->client_id,
                    "client_name"=>request()->client_name,
                    "group_id"=>(int)request()->group_id,
                    "group_name"=>request()->group_name,
                    "segment_id"=>(int)request()->segment_id,
                    "segment_name"=>request()->segment_name,
                    "merchant_name"=>request()->merchant_name,
                    "m_key"=>request()->m_key,
                    "first_name"=>request()->first_name,
                    "last_name"=>request()->last_name,
                    "merchant_name"=>request()->merchant_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addMerchant',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    // return view('viller.history.payment',compact('userData'));
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
    }
    public function updatedatamerchant(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "client_id"=>(int)request()->client_id,
                    "client_name"=>request()->client_name,
                    "group_id"=>(int)request()->group_id,
                    "group_name"=>request()->group_name,
                    "segment_id"=>(int)request()->segment_id,
                    "segment_name"=>request()->segment_name,
                    "merchant_name"=>request()->merchant_name,
                    "m_key"=>request()->m_key,
                    "first_name"=>request()->first_name,
                    "last_name"=>request()->last_name,
                    "merchant_name"=>request()->merchant_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateMerchant',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }
    public function deletedatamerchant($id){
         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteMerchant',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }
    public function merchantOutlet()
    {
        $dataClient=$this->getdataclient();
        $clientJsonString = $dataClient->getContent();
        // ubah jadi array PHP
        $clientJson = json_decode($clientJsonString, true);
        $clients=$clientJson['data'];
        return view('makarios.merchantOutlet.index',compact('clients'));
    }
    public function getdatamerchantoutlet()
    {
         try {
            $payload=[
                "start"=>(int)request()->start,
                "length"=>(int)request()->length,
                "columns"=>"",
                "search"=>"",
                "order"=>"id",
                "sort"=>"asc",
                "startDate"=>"",
                "endDate"=>"",
                "draw"=>(int)request()->draw,
                "filter"=>[
                    "id"=>0,
                ],
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getMerchantOutlet',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    // return view('viller.history.payment',compact('userData'));
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }
     public function adddatamerchantoutlet(){
        // dd(request()->all());
         try {
            $payload=[
                    "merchant_outlet_name"=>request()->merchant_outlet_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addMerchantOutlet',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    // return view('viller.history.payment',compact('userData'));
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
    }
    public function updatedatamerchantoutlet(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "merchant_outlet_name"=>request()->merchant_outlet_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateMerchantOutlet',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }
    public function deletedatamerchantoutlet($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteMerchantOutlet',$payload)->json();
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['responseCode'],
                        'data' => $userData
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
        return view('makarios.dashboard.index');
    }
    



    public function getdatamerchantjson(){
          try {
             $payload=[
               "start"=>0,
                "length"=>0,
                "draw"=>0,
                "order"=>"id",
                "sort"=>"asc",
                "filter"=>[
                    "group_id"=>(int)request()->group_id,
                ],
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getMerchant',$payload)->json();
            // dd($response);
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result'] ?? null;
                    return response()->json([
                        'draw' => intval(request()->input('draw')), // ambil dari request
                        'recordsTotal' => $userData['records_total'],
                        'recordsFiltered' => $userData['records_filtered'],
                        'data' => $userData['data']
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
    }
    public function getdatagroupjson(){
          try {
             $payload=[
               "start"=>0,
                "length"=>0,
                "draw"=>0,
                "order"=>"id",
                "sort"=>"asc",
                "filter"=>[
                    "client_id"=>(int)request()->client_id,
                ],
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getGroup',$payload)->json();
            // dd($response);
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result'] ?? null;
                    return response()->json([
                        'draw' => intval(request()->input('draw')), // ambil dari request
                        'recordsTotal' => $userData['records_total'],
                        'recordsFiltered' => $userData['records_filtered'],
                        'data' => $userData['data']
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
                }
        } catch (\Exception $e) {
            dd("ERRORNY",$e);
            $data=[
                // 'token'=>$response['result']['token'],
                'endpoint'=>"login",
                'command'=>"destroy",
                'desc'=>'Invalid token',
            ];
            return response()->json(['error' => $data], 401);
        }
    }
}
