<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


class MobileHomeController extends Controller
{
    public function index()
    {
        return view('mobile.layouts.home');
    }
    public function userValidate()
    {
        $command=request()->command;
                $token=request()->bearerToken();
                try {
                    // Secret Key yang digunakan untuk encode JWT
                    $secretKey = "Des@Biller120824"; 
                    // Decode token
                    $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
                    $now = Carbon::now('Asia/Jakarta')->timestamp;
                    // dd($now);

                    if($now-$decoded->exp>0){
                        return redirect()->route('mobile.login');
                    }else{
                        $response=[
                            'merchantId'=>$decoded->merchantId,
                            'outletName'=>$decoded->outletName,
                            'outletId'=>$decoded->outletId,
                        ];
                        return response()->json((array) $response);
                    }
                } catch (\Exception $e) {
                    $data=[
                        // 'token'=>$response['result']['token'],
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
        //         break;
        //     default:
        //         $data=[
        //         // 'token'=>$response['result']['token'],
        //             'endpoint'=>"login",
        //             'command'=>"destroy",
        //             'desc'=>'Invalid token',
        //         ];
        //         return response()->json((array) $data);
        //         break;
        // }
        
    
    }
    public function loading(){
        $suggestData=[
            'cmd'=>'destroy',
        ];
        return view('mobile.layouts.loading',compact('suggestData'));
    }
    public function getTrx(Request $request)
    {
        $filter=[
            "length"=>1,
        ];
        $payload=[
            "filter"=>$filter,
        ];
        $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3NDE4ODc2NzYsIm1lcmNoYW50SWQiOjEsIm91dGxldElkIjoxLCJvdXRsZXROYW1lIjoiVEFXQ0kgMDEifQ.IsgldjMYcubA5aN0x4SQf90QjAqY2vlf0ZYJfEB3M3c')->post(ENV('HOST_VILLAGER').'/trx/getTrx', $payload)->json();
        // if($response['statusCode']!=="00"){
        //     return redirect()->back()->with('warning', 'wrong username or password!');
        // }
        dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
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
