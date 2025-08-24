<?php

namespace App\Http\Controllers\Makarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SavingController extends Controller
{
    public function account(){
        return view('makarios.account.index');
    }
    public function getdataaccount(){
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
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getAccount',$payload)->json();
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
    public function adddataaccount(){
        // dd(request()->all());
         try {
            $payload=[
                "account_name"=>request()->account_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addAccount',$payload)->json();
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
    public function updatedataaccount(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "account_name"=>request()->account_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateAccount',$payload)->json();
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
    public function deletedataaccount($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteAccount',$payload)->json();
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

    public function savingaccount(){
        $dataAccount=$this->getdataaccount();
        $accountJsonString = $dataAccount->getContent();
        // ubah jadi array PHP
        $accountJson = json_decode($accountJsonString, true);
        $accounts=$accountJson['data'];
        return view('makarios.savingaccount.index',compact('accounts'));
    }
    public function getdatasavingaccount(){
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
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getSavingAccount',$payload)->json();
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
    public function adddatasavingaccount(){
        // dd(request()->all());
         try {
            $payload=[
                "account_id"=>request()->account_id,
                "account_name"=>request()->account_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addSavingAccount',$payload)->json();
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
    public function updatedatasavingaccount(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "account_id"=>request()->account_id,
                "account_name"=>request()->account_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateSavingAccount',$payload)->json();
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
    public function deletedatasavingaccount($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteSavingAccount',$payload)->json();
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
}
