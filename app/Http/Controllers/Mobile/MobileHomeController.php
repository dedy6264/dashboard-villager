<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Carbon\Carbon;


class MobileHomeController extends Controller
{
    public function index()
    {
        return view('mobile.layouts.home');
    }
    public function userValidate()
    {
        $token=request()->bearerToken();
        
        // dd($token);
        try {
            // Secret Key yang digunakan untuk encode JWT
            $secretKey = "Des@Biller120824"; 
            // Decode token
            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
            // dd($decoded);
            $now = Carbon::now()->timestamp;
            // dd($decoded->outletName);
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
            // dd($e);
            return response()->json(['error' => 'Invalid token'], 401);
        }
    
    }
    public function lastTrx(Request $request)
    {
        $payload=[
            "productReferenceCode"=>$productReferenceCode,
        ];
        $response = Http::withBasicAuth('joe','secret')->post(ENV('HOST_VILLAGER').'/trx/getTrx', $payload)->json();
        if($response['statusCode']!=="00"){
            return redirect()->back()->with('warning', 'wrong username or password!');
        }
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
