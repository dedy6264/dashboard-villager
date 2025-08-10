<?php

namespace App\Http\Controllers\Viller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class VillerController extends Controller
{
    public function signin(){
        try {
            $payload = [
                'username' => request()->input('username'),
                'password' => request()->input('password'),
            ];
            $response = Http::post(ENV('HOST_VILLAGER').'/login/', $payload)->json();
            // dd($response);
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['statusCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    $suggestData=[
                        'cmd'=>'set',
                        'token'=>$response['result']['token'],
                        // 'data' => $userData
                        // 'endpoint'=>"home",
                    ];
                    return view('viller.loading',compact('suggestData'));
                    // return response()->json([
                    //     'success' => true,
                    //     'message' => $response['statusMessage'],
                    //     'data' => $userData
                    // ]);

                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return back()->withErrors(['error' => 'Password atau username salah']);
                }
        } catch (\Exception $e) {
            // dd("ERRORNY",$e);
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses permintaan.']);
        }
    }
    public function signup(){
        // dd(request()->all());
        $payload=[
            "filter"=>[
            "username"=>request()->username,
            "name"=>request()->name,
            "phone"=>request()->phone,
            "identityNumber"=>request()->identityNumber,
            "password"=>request()->password,
            "identityType"=>"ktp",
            "email"=>request()->email,
            "gender"=>request()->gender,
            "province"=>"",
            "city"=>"",
            "address"=>"",
            ]
        ];
         try {
            $response = Http::withBasicAuth('joe', 'secret')
            ->post(ENV('HOST_VILLAGER').'/user-app/add',$payload)->json();
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['statusCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result'] ?? null;//data yg dibutuhkan 
                    return view('viller.onboarding.inputotp',compact('userData'));
                default://validation
                    // Kode lain yang tidak dikenali (error umum)
                    return back()->withErrors(['error' => $response['statusMessage'] ?? 'Terjadi kesalahan.']);
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
    public function verificationotp(){
        // dd(request()->all());
        $payload=[
            "cifID"=>(int)request()->cifID,
            "otp"=>request()->otp,
        ];
         try {
            $response = Http::withBasicAuth('joe', 'secret')
            ->post(ENV('HOST_VILLAGER').'/user-app/verivicationotp',$payload)->json();
            // dd($response);
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['statusCode']) {
                case '00':
                    // Berhasil
                    return redirect()
                    ->route('viller.login')
                    ->with('success', 'Registrasi berhasil, silahkan login!');
                case '82':
                    // Berhasil
                    // $cifId = request()->cifId;
                    // return view('viller.onboarding.setpin',compact('cifId'));
                    return back()->withErrors(['error' => $response['statusMessage'] ?? 'Terjadi kesalahan.']);
                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

                default://validation
                    // Kode lain yang tidak dikenali (error umum)
                    return back()->withErrors(['error' => $response['statusMessage'] ?? 'Terjadi kesalahan.']);
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
    public function setpin(){
        // dd("setpin::",request()->all());
        $payload=[
            "phone"=>request()->phone,
            "pin"=>request()->otp,
        ];
         try {
            $response = Http::withBasicAuth('joe', 'secret')
            ->post(ENV('HOST_VILLAGER').'/account/setpin',$payload)->json();
            // dd($response);
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        // 'token'=>$response['result']['token'],
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

            switch ($response['statusCode']) {
                case '00':
                   return redirect()
                    ->route('viller.login')
                    ->with('success', 'Registrasi berhasil, silahkan login!');

                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

                default://validation
                    // Kode lain yang tidak dikenali (error umum)
                    return back()->withErrors(['error' => $response['statusMessage'] ?? 'Terjadi kesalahan.']);
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





    public function index(){
        return view('viller.home.index');
    }
    public function trxdetail(){
        // dd(request()->all());
         try {
            $token=request()->bearerToken;
            $payload=[
                "start"=>0,
                "length"=>request()->limit ?? 1,
                "columns"=>"",
                "search"=>"",
                "order"=>"",
                "sort"=>"",
                "startDate"=>"",
                "endDate"=>"",
                "draw"=>0,
                "filter"=>[
                    "id"=>(int)request()->id,
                ],
            ];
            $response = Http::withToken(request()->bearerToken)->post(ENV('HOST_VILLAGER').'/trx/getTrx',$payload)->json();
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
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

            switch ($response['statusCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    // $suggestData=[
                    //     // 'cmd'=>'set',
                    //     // 'token'=>$response['result']['token'],
                    //     // 'endpoint'=>"home",
                    //     'data' => $userData
                    // ];
            // dd($userData['id']);
                    return view('viller.history.payment',compact('userData'));
                    // return response()->json([
                    //     'success' => true,
                    //     'message' => $response['statusMessage'],
                    //     'data' => $userData
                    // ]);

                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

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
    public function gettrx(){
         try {
            $token=request()->bearerToken();
            $payload=[
                "start"=>0,
                "length"=>request()->limit ?? 1,
                "columns"=>"",
                "search"=>"",
                "order"=>"",
                "sort"=>"desc",
                "startDate"=>"",
                "endDate"=>"",
                "draw"=>0,
                "filter"=>[
                    "statusCode"=>request()->statusCode ?? "",
                ],
            ];
            if(request()->statusCode==""){
                $response = Http::withToken($token)->post(ENV('HOST_VILLAGER').'/trx/getHistory',$payload)->json();
            }else{
                $response = Http::withToken($token)->post(ENV('HOST_VILLAGER').'/trx/getTrxs',$payload)->json();
            }
            // dd($response);
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['statusCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusMessage'],
                        'data' => $userData
                    ]);

                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

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
    public function getuser(){
         try {
            $token=request()->bearerToken();
            $response = Http::withToken($token)->post(ENV('HOST_VILLAGER').'/user/getuser')->json();
            // dd($response['message']);
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        // 'token'=>$response['result']['token'],
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

            switch ($response['statusCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    // $suggestData=[
                    //     'cmd'=>'set',
                    //     'token'=>$response['result']['token'],
                    //     // 'endpoint'=>"home",
                    // ];
                    // return view('viller.loading',compact('suggestData'));
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusMessage'],
                        'data' => $userData
                    ]);

                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

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
    public function history(){
        return view('viller.history.index');
    }
    public function getproductbyreference(){
         try {
            $token=request()->bearerToken();
            $payload=[
                "filter"=>[
                "productReferenceId"=> request()->productReferenceId ?? "",
                ],
            ];
            $response = Http::withToken($token)->post(ENV('HOST_VILLAGER').'/product/get',$payload)->json();
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['statusCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    // dd($userData);
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusMessage'],
                        'data' => $userData
                    ]);

                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

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
    public function getprefix(){
         try {
            $token=request()->bearerToken();
            $payload=[
                "subscriberId"=> request()->subscriberId ?? "",
            ];
            $response = Http::withToken($token)->post(ENV('HOST_VILLAGER').'/helper/getReference',$payload)->json();
            // dd($response);
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['statusCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    // dd($userData);
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusMessage'],
                        'data' => $userData
                    ]);

                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

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
    public function pulsa(){
        return view('viller.product.pulsa');
    }
    public function payment(){
        // dd(request()->all());
         try {
            $token=request()->bearerToken();
            $payload=[
                    "referenceNumber"=>request()->referenceNumber ?? "",
                    "accountPin"=>request()->accountPin ?? "",
            ];
            $response = Http::withToken($token)->post(ENV('HOST_VILLAGER').'/biller/payment',$payload)->json();
            // dd($response);
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['statusCode']) {
                case '00':
                    // payBerhasil
                    $userData = $response['result'] ?? null;
                    $userData = array_merge((array) ($response['result'] ?? []), [
                        'statusCode' => $response['statusCode'],
                        'statusDesc' => $response['statusDesc'],
                        'statusMessage' => $response['statusMessage'],
                    ]);
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusMessage'],
                        'data' => $userData
                    ]);
                case '02':
                    // pay failed
                    $userData = $response['result'] ?? null;
                     $userData = array_merge((array) ($response['result'] ?? []), [
                        'statusCode' => $response['statusCode'],
                        'statusDesc' => $response['statusDesc'],
                        'statusMessage' => $response['statusMessage'],
                    ]);
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusMessage'],
                        'data' => $userData
                    ]);
                case '03':
                    // pay pending
                    $userData = $response['result'] ?? null;
                     $userData = array_merge((array) ($response['result'] ?? []), [
                        'statusCode' => $response['statusCode'],
                        'statusDesc' => $response['statusDesc'],
                        'statusMessage' => $response['statusMessage'],
                    ]);
                    dd($userData);
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusMessage'],
                        'data' => $userData
                    ]);

                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

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
    public function inquiry(){
         try {
            $token=request()->bearerToken();
            $payload=[
                "productCode"=>request()->productCode,
                "additionalField"=>[
                    "periode"=>request()->periode ?? 0,
                    "subscriberNumber"=>request()->subscriberNumber ?? "",
                    "subscriberName"=>request()->subscriberName ?? "",
                    "amount"=> request()->amount ?? 0,
                ]
            ];
            $response = Http::withToken($token)->post(ENV('HOST_VILLAGER').'/biller/inquiry',$payload)->json();
            // dd($response);
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['statusCode']) {
                case '04':
                    // inqBerhasil
                    $userData = $response['result'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusMessage'],
                        'data' => $userData
                    ]);
                case '03':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusMessage'],
                        'data' => $userData
                    ]);

                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

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
    public function advice(){
         try {
            $token=request()->bearerToken();
            $payload=[
                "paymentMethodId"=>"",
                "paymentMethodName"=>"",
                "referenceNumber"=> request()->referenceNumber,
                "accountNumber"=>"",
                "accounrPin"=>"",
            ];
            $response = Http::withToken($token)->post(ENV('HOST_VILLAGER').'/biller/advice',$payload)->json();
            // dd($response);
            // Validasi struktur response
            if (!isset($response['statusCode'])) {
                // Struktur tidak sesuai harapan
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['statusCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusCode'],
                        'data' => $userData
                    ]);
                case '02':
                    // Pending
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusCode'],
                        'data' => $userData
                    ]);
                case '03':
                    // gagal
                    $userData = $response['result']['data'] ?? null;
                    return response()->json([
                        'success' => true,
                        'message' => $response['statusCode'],
                        'data' => $userData
                    ]);

                case '401':
                    // Unauthorized / JWT invalid
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Token tidak valid atau sudah kedaluwarsa.'
                    ], 401);

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
