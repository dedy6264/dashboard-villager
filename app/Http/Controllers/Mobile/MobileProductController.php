<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MobileProductController extends Controller
{
    public function pulsaPrabayar()
    {
        return view("mobile.layouts.pulsa");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProduct()
    {
        $payload=[
            "subscriberId"=>request()->customerId,
        ];
        $response = Http::withBasicAuth('joe','secret')->post(ENV('HOST_VILLAGER').'/helper/getReference', $payload)->json();
        if($response['statusCode']!=="00"){
            return redirect()->back()->with('warning', 'wrong username or password!');
        }
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $productReferenceCode = $response['result']['data']['productReferenceCode'];

        $payload=[
            "productReferenceCode"=>$productReferenceCode,
        ];
        $response = Http::withBasicAuth('joe','secret')->post(ENV('HOST_VILLAGER').'/product/gets', $payload)->json();
        if($response['statusCode']!=="00"){
            return redirect()->back()->with('warning', 'wrong username or password!');
        }
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        $response = $response['result'];
        // dd($response);
        return $response;
    }

    public function inquiry(Request $request)
    {
        // dd($request->bearerToken());
        // $additionalField=[
        //     "subscriberNumber"=>$request->customerId,
        // ];
        // $payload=[
        //     "productCode"=>$request->productCode,
        //     "additionalField"=>$additionalField,
        // ];
        // $response = Http::withToken($request->bearerToken())->post(ENV('HOST_VILLAGER').'/biller/inquiry', $payload)->json();
        // if($response['statusCode']!=="00"){
        //     return redirect()->back()->with('warning', 'Failed Inquiry!');
        // }
        $response=[
            "statusCode"=>"10",
            "statusMessage"=>"INQUIRY SUCCESS",
            "responseDatetime"=>"2025-03-10T19:15:13+07:00",
            "result"=>[
                "createdAt"=>"2025-03-10 19:15:13",
                "merchantOutletName"=>"TAWCI 01",
                "merchantOutletUsername"=>"taucikuenak",
                "referenceNumber"=>"DB-20250310-0000001",
                "productName"=>"PULSA TELKOMSEL 10K",
                "productCode"=>"htelkomsel10000",
                "subscriberNumber"=>"082137789378",
                "productPrice"=>11000,
                "productAdminFee"=>0,
                "productMerchantFee"=>0,
                "totalTrxAmount"=>11000,
                "billInfo"=>null,
            ],  
        ];
        
        // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        // $response = $response['result'];
        return $response;
    }

    public function payment(Request $request)
    {
        $response=[
            "statusCode"=> "05",
            "statusMessage"=> "PAYMENT PENDING",
            "responseDatetime"=> "2024-12-06T23:06:49+07:00",
            "result"=> [
                "createdAt"=> "2024-12-06T23:01:38Z",
                "merchantOutletName"=> "TAWCI 02",
                "merchantOutletUsername"=> "taucikuenak",
                "referenceNumber"=> "DB-20241206-0000003",
                "productName"=> "PULSA TELKOMSEL 10K",
                "productCode"=> "htelkomsel10000",
                "subscriberNumber"=> "082137789378",
                "productPrice"=> 11000,
                "productAdminFee"=> 0,
                "productMerchantFee"=> 0,
                "totalTrxAmount"=> 11000,
                "billInfo"=> [
                    "billDesc"=> [
                        "customerId"=> "",
                        "customerName"=> "",
                        "detail"=> null,
                    ],
                    "sn"=> "",
                ],
            ],
        ];
        
        // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        // $response = $response['result'];
        return view("mobile.layouts.payment");
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
