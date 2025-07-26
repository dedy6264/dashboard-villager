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
                $token=request()->bearerToken();
                try {
                    // Secret Key yang digunakan untuk encode JWT
                    $secretKey = "Des@Biller120824"; 
                    // Decode token
                    $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
                    $now = Carbon::now('Asia/Jakarta')->timestamp;

                    if($now>$decoded->exp){
                        return redirect()->route('mobile.login');
                    }else{
                        $response=[
                            'userAppId'=>$decoded->userAppId,
                        ];
                        return response()->json((array) $response);
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
        // $response = Http::withToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3NDE4ODc2NzYsIm1lcmNoYW50SWQiOjEsIm91dGxldElkIjoxLCJvdXRsZXROYW1lIjoiVEFXQ0kgMDEifQ.IsgldjMYcubA5aN0x4SQf90QjAqY2vlf0ZYJfEB3M3c')->post(ENV('HOST_VILLAGER').'/trx/getTrx', $payload)->json();
        $response = [
            "responseCode"=> "00",
            "responseMessage"=> "SUCCESS",
            "responseDateTime"=> "2025-07-04T19:47:07+07:00",
            "result"=> [
                "records_total"=> 4,
                "records_filtered"=> 1,
                "data"=> [
                    [
                        "id" =>3,
                        "segment_id"=> 2,
                        "segment_name"=> "SEGMENT B",
                        "product_reference_id"=> 9,
                        "product_reference_name"=> "PLN POSTPAID",
                        "product_reference_code"=> "PLNPOST",
                        "product_category_id"=> 6,
                        "product_category_name"=> "PLN",
                        "provider_id"=> 1,
                        "provider_name"=> "Provider A",
                        "product_provider_id"=> 4,
                        "product_provider_name"=> "PLN POSTPAID",
                        "product_provider_code"=> "PLNPOSTPAID",
                        "product_provider_price"=> 0,
                        "product_provider_admin_fee"=> 2750,
                        "product_provider_merchant_fee"=> 1200,
                        "product_type_id"=> 1,
                        "product_type_name"=> "PAYMENT",
                        "product_id"=> 4,
                        "product_name"=> "PLN Tagihan",
                        "product_code"=> "PLNPOST",
                        "product_price"=> 0,
                        "product_admin_fee"=> 2750,
                        "product_merchant_fee"=> 500,
                        "transaction_total_amount"=> 0,
                        "reference_number"=> "DB-20250703-0000003",
                        "reference_number_provider"=> "0",
                        "reference_number_merchant"=> "",
                        "status_code"=> "11",
                        "status_message"=> "INQUIRY FAILED",
                        "status_desc"=> "INQUIRY FAILED",
                        "status_code_detail"=> "",
                        "status_message_detail"=> "",
                        "customer_id"=> "530000000999",
                        "other_customer_info"=> "",
                        "other_reff"=> "",
                        "client_id"=> 1,
                        "client_name"=> "Client A",
                        "group_id"=> 1,
                        "group_name"=> "Group A1",
                        "merchant_id"=> 1,
                        "merchant_name"=> "Makarios",
                        "merchant_outlet_id"=> 1,
                        "merchant_outlet_name"=> "Makarios Pleburan",
                        "username"=> "outletx",
                        "savingAccountID"=> 1,
                        "savingAccountName"=> "",
                        "created_by"=> "outletx",
                        "updated_by"=> "outletx",
                        "created_at"=> "2025-07-03T23:37:11+07:00",
                        "updated_at"=> "2025-07-03T23:37:11+07:00"
                ]
                ]
            ]
        ];
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
