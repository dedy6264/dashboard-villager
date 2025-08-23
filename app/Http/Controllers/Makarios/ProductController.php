<?php

namespace App\Http\Controllers\Makarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function producttype(){
        return view('makarios.productType.index');
    }
    public function getdataproducttype(){
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
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getProductType',$payload)->json();
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
    public function adddataproducttype(){
        // dd(request()->all());
         try {
            $payload=[
                    "product_type_name"=>request()->product_type_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addProductType',$payload)->json();
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
    public function updatedataproducttype(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "product_type_name"=>request()->product_type_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateProductType',$payload)->json();
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
    public function deletedataproducttype($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteProductType',$payload)->json();
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
    //
    public function productcategory(){
        return view('makarios.productCategory.index');
    }
    public function getdataproductcategory(){
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
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getProductCategory',$payload)->json();
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
    public function adddataproductcategory(){
        // dd(request()->all());
         try {
            $payload=[
                    "product_category_name"=>request()->product_category_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addProductCategory',$payload)->json();
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
    public function updatedataproductcategory(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "product_category_name"=>request()->product_category_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateProductCategory',$payload)->json();
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
    public function deletedataproductcategory($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteProductCategory',$payload)->json();
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
    //
    public function product(){
        $dataCategory=$this->getdataproductcategory();
        $categoryJsonString = $dataCategory->getContent();
        // ubah jadi array PHP
        $categoryJson = json_decode($categoryJsonString, true);
        $categories=$categoryJson['data'];

        $dataReference=$this->getdataproductreference();
        $referenceJsonString = $dataReference->getContent();
        // ubah jadi array PHP
        $referenceJson = json_decode($referenceJsonString, true);
        // dd($referenceJson);
        $references=$referenceJson['data'];
        return view('makarios.product.index', compact( 'categories','references'));
    }
    public function getdataproduct(){
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
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getProduct',$payload)->json();
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
    public function adddataproduct(){
        // dd(request()->all());
         try {
            $payload=[
                "product_reference_id"=>request()->product_reference_id,
                "product_reference_name"=>request()->product_reference_name,
                "product_reference_code"=>request()->product_reference_code,
                "product_category_id"=>request()->product_category_id,
                "product_category_name"=>request()->product_category_name,
                "product_name"=>request()->product_name,
                "product_code"=>request()->product_code,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addProduct',$payload)->json();
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
    public function updatedataproduct(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "product_reference_id"=>request()->product_reference_id,
                "product_reference_name"=>request()->product_reference_name,
                "product_reference_code"=>request()->product_reference_code,
                "product_category_id"=>request()->product_category_id,
                "product_category_name"=>request()->product_category_name,
                "product_name"=>request()->product_name,
                "product_code"=>request()->product_code,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateProduct',$payload)->json();
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
    public function deletedataproduct($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteProduct',$payload)->json();
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
    //
    public function provider(){
        return view('makarios.provider.index');
    }
    public function getdataprovider(){
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
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getProvider',$payload)->json();
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
    public function adddataprovider(){
         try {
            $payload=[
                "provider_name"=>request()->provider_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addProvider',$payload)->json();
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
    public function updatedataprovider(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "provider_name"=>request()->provider_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateProvider',$payload)->json();
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
    public function deletedataprovider($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteProvider',$payload)->json();
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
    //
    public function productprovider(){
        $dataProvider=$this->getdataprovider();
        $providerJsonString = $dataProvider->getContent();
        // ubah jadi array PHP
        $providerJson = json_decode($providerJsonString, true);
        $providers=$providerJson['data'];
        return view('makarios.productProvider.index',compact('providers'));
    }
    public function getdataproductprovider(){
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
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getProductProvider',$payload)->json();
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
    public function adddataproductprovider(){
        // dd(request()->all());
         try {
            $payload=[
                "product_provider_name"=>request()->product_provider_name,
                "provider_id"=>(int)request()->provider_id,
                "provider_name"=>request()->provider_name,
                "product_provider_name"=>request()->product_provider_name,
                "product_provider_code"=>request()->product_provider_code,
                "product_provider_price"=>(double)request()->product_provider_price,
                "product_provider_admin_fee"=>(double)request()->product_provider_admin_fee,
                "product_provider_merchant_fee"=>(double)request()->product_provider_merchant_fee,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addProductProvider',$payload)->json();
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
    public function updatedataproductprovider(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "product_provider_name"=>request()->product_provider_name,
                "provider_id"=>(int)request()->provider_id,
                "provider_name"=>request()->provider_name,
                "product_provider_name"=>request()->product_provider_name,
                "product_provider_code"=>request()->product_provider_code,
                "product_provider_price"=>(double)request()->product_provider_price,
                "product_provider_admin_fee"=>(double)request()->product_provider_admin_fee,
                "product_provider_merchant_fee"=>(double)request()->product_provider_merchant_fee,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateProductProvider',$payload)->json();
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
    public function deletedataproductprovider($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteProductProvider',$payload)->json();
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
    //
    public function segment(){
        return view('makarios.segment.index');
    }
    public function Getdatasegment(){
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
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getSegment',$payload)->json();
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
    public function adddatasegment(){
        // dd(request()->all());
         try {
            $payload=[
                "segment_name"=>request()->segment_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addSegment',$payload)->json();
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
    public function updatedatasegment(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "segment_name"=>request()->segment_name,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateSegment',$payload)->json();
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
    public function deletedatasegment($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteSegment',$payload)->json();
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
    //
    public function productsegment(){
        $dataProduct=$this->getdataproduct();
        $productJsonString = $dataProduct->getContent();
        $productJson = json_decode($productJsonString, true);
        $products=$productJson['data'];
        
        $dataSegment=$this->getdatasegment();
        $segmentJsonString = $dataSegment->getContent();
        $segmentJson = json_decode($segmentJsonString, true);
        $segments=$segmentJson['data'];
        
        $dataProvider=$this->getdataprovider();
        $providerJsonString = $dataProvider->getContent();
        $providerJson = json_decode($providerJsonString, true);
        $providers=$providerJson['data'];
       
        $dataProductType=$this->getdataproducttype();
        $productTypeJsonString = $dataProductType->getContent();
        $productTypeJson = json_decode($productTypeJsonString, true);
        $productTypes=$productTypeJson['data'];

        return view('makarios.productSegment.index',compact('products','providers','productTypes','segments'));
    }
    public function getdataproductproviderjson(){
          try {
             $payload=[
               "start"=>0,
                "length"=>0,
                "draw"=>0,
                "order"=>"id",
                "sort"=>"asc",
                "filter"=>[
                    "provider_id"=>(int)request()->provider_id,
                ],
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getProductProvider',$payload)->json();
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
    public function getdataproductsegment(){
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
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getProductSegment',$payload)->json();
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
    public function adddataproductsegment(){
        // dd(request()->all());
         try {
            $payload=[
                "segment_id"=>(int)request()->segment_id,
                "segment_name"=>request()->segment_name,
                "product_reference_id"=>(int)request()->product_reference_id,
                "product_reference_name"=>request()->product_reference_name,
                "product_reference_code"=>request()->product_reference_code,
                "product_category_id"=>(int)request()->product_category_id,
                "product_category_name"=>request()->product_category_name,
                "provider_id"=>(int)request()->provider_id,
                "provider_name"=>request()->provider_name,
                "product_provider_id"=>(int)request()->product_provider_id,
                "product_provider_name"=>request()->product_provider_name,
                "product_provider_code"=>request()->product_provider_code,
                "product_provider_price"=>(double)request()->product_provider_price,
                "product_provider_admin_fee"=>(double)request()->product_provider_admin_fee,
                "product_provider_merchant_fee"=>(double)request()->product_provider_merchant_fee,
                "product_type_id"=>(int)request()->product_type_id,
                "product_type_name"=>request()->product_type_name,
                "product_id"=>(int)request()->product_id,
                "product_name"=>request()->product_name,
                "product_code"=>request()->product_code,
                "product_price"=>(double)request()->product_price,
                "product_admin_fee"=>(double)request()->product_admin_fee,
                "product_merchant_fee"=>(double)request()->product_merchant_fee,
                "product_availability"=>request()->product_availability,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/addProductSegment',$payload)->json();
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
    public function updatedataproductsegment(){
        // dd(request()->all());
         try {
            $payload=[
                "id"=>request()->id,
                "segment_id"=>(int)request()->segment_id,
                "segment_name"=>request()->segment_name,
                "product_reference_id"=>(int)request()->product_reference_id,
                "product_reference_name"=>request()->product_reference_name,
                "product_reference_code"=>request()->product_reference_code,
                "product_category_id"=>(int)request()->product_category_id,
                "product_category_name"=>request()->product_category_name,
                "provider_id"=>(int)request()->provider_id,
                "provider_name"=>request()->provider_name,
                "product_provider_id"=>(int)request()->product_provider_id,
                "product_provider_name"=>request()->product_provider_name,
                "product_provider_code"=>request()->product_provider_code,
                "product_provider_price"=>(double)request()->product_provider_price,
                "product_provider_admin_fee"=>(double)request()->product_provider_admin_fee,
                "product_provider_merchant_fee"=>(double)request()->product_provider_merchant_fee,
                "product_type_id"=>(int)request()->product_type_id,
                "product_type_name"=>request()->product_type_name,
                "product_id"=>(int)request()->product_id,
                "product_name"=>request()->product_name,
                "product_code"=>request()->product_code,
                "product_price"=>(double)request()->product_price,
                "product_admin_fee"=>(double)request()->product_admin_fee,
                "product_merchant_fee"=>(double)request()->product_merchant_fee,
                "product_availability"=>request()->product_availability,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/updateProductSegment',$payload)->json();
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
    public function deletedataproductsegment($id){

         try {
            $payload=[
                "id"=>(int)$id,
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/deleteProductSegment',$payload)->json();
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
    //
    public function productreference(){
        return view('makarios.productReference.index');
    }
    public function getdataproductreference(){
         try {
            $payload=[
                "start"=>0,
                "length"=>0,
                "columns"=>"",
                "search"=>"",
                "order"=>"id",
                "sort"=>"asc",
                "startDate"=>"",
                "endDate"=>"",
                "draw"=>0,
                "filter"=>[
                    "id"=>0,
                ],
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getProductReference',$payload)->json();
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
}
