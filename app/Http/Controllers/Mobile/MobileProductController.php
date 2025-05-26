<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MobileProductController extends Controller
{
    public function pulsaPrabayar()
    {
        return view("mobile.layouts.products.pulsa.index");
    }
    public function bpjsks()
    {
        return view("mobile.layouts.products.bpjs.index");
    }
    public function plnToken()
    {
        return view("mobile.layouts.products.pln_token.index");
    }
    
    public function getProduct(Request $request)
    {
        
        if($request->productReferenceCode==""||$request->productReferenceCode==null){
           $productReferenceCode=$this->getReferenceCode();
        }else{
           $productReferenceCode=$request->productReferenceCode;
        }
        $payload=[
            "productReferenceCode"=>$productReferenceCode,
        ];
        $response = Http::withBasicAuth('joe','secret')->post(ENV('HOST_VILLAGER').'/product/gets', $payload)->json();
        // dd($response);
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
    public function getReferenceCode(){
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
        return $response['result']['data']['productReferenceCode'];
    }
    public function inquiry(Request $request)
    {
        // dd($request->bearerToken());
       switch ($request->productCode) {
        case 'BPJSKS':
            $additionalField=[
                "subscriberNumber"=>$request->customerId,
                "periode"=>(int)$request->periode,
            ];
            break;
        
        default:
            $additionalField=[
                "subscriberNumber"=>$request->customerId,
            ];
            break;
       }
        $payload=[
            "productCode"=>$request->productCode,
            "additionalField"=>$additionalField,
        ];
        $response = Http::withToken($request->bearerToken())->post(ENV('HOST_VILLAGER').'/biller/inquiry', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            if($response['message']==="invalid or expired jwt"){
                // $mainData=[
                //     // 'token'=>$response['result']['token'],
                //     'endpoint'=>"login",
                // ];
                // return view('mobile.layouts.loading',compact('mainData'));
                return response()->json(['error' => $response['message']], 500);
            }
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        if($response['statusCode']!=="10"){//harus dikirim data failed
            // switch ($response['result']['statusMessage']) {
                // case 'NO PELANGGAN TIDAK DITEMUKAN':
                //     $payload=['error' => $response['result']['statusMessage']];
                //     break;
                // case 'TAGIHAN SUDAH LUNAS':
                //     $payload=['error' => $response['result']['statusMessage']];
                //     break;
                // case 'TIMEOUT':
                //     break;
                    // default:
                    // $payload=['error' => $response['result']['statusMessage']];
                    $payload=['error' => $response['statusDesc']];
                    // break;
            // }
            return response()->json($payload, 500);
        }
        // $response=[
        //     "statusCode"=>"10",
        //     "statusMessage"=>"INQUIRY SUCCESS",
        //     "statusDesc"=>"SUCCESS",
        //     "responseDatetime"=>"2025-05-08T21:47:48+07:00",
        //     "result"=>[
        //         "statusMessage"=>"SUCCESS",
        //         "createdAt"=>"20250508",
        //         "merchantOutletName"=>"TAWCI 01",
        //         "merchantOutletUsername"=>"taucikuenak",
        //         "referenceNumber"=>"DB-20250508-0000025",
        //         "productName"=>"PLN TOKEN 20.000",
        //         "productCode"=>"plntkn20",
        //         "subscriberNumber"=>"12345678901",
        //         "productPrice"=>22500,
        //         "productAdminFee"=>0,
        //         "productMerchantFee"=>0,
        //         "totalTrxAmount"=>0,
        //         "billInfo"=>[
        //         "billDesc"=>[
        //         "subscriberName"=>"Test PLN",
        //         "subscriberNumber"=>"12345678901",
        //         "meterNo"=>"548933889287",
        //         "lembarTagihan"=>0,
        //         "detail"=>[
        //         [
        //         "periode"=>"",
        //         "admin"=>0,
        //         "denda"=>0,
        //         "tagihan"=>0,
        //         "meterAwal"=>"",
        //         "meterAkhir"=>"",
        //         "tarif"=>"R1M",
        //         "daya"=>"/000000900"
        //         ]
        //         ]
        //         ]
        //         ]
        // ]
        // ];
        // $response = $response['result'];
        return $response;
    }

    public function payment(Request $request)
    {
        if (request()->bearerToken()) {
            $token=$request->bearerToken();
        }else{
            $token=$request->token;
        }
        $payload=[
            "referenceNumber"=>$request->referenceNumber,
        ];
        $response = Http::withToken($token)->post(ENV('HOST_VILLAGER').'/biller/payment', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            if(isset($response['message'])){
                if($response['message']==="invalid or expired jwt" || $response['message']==="missing or malformed jwt"){
                    $suggestData=[
                        'cmd'=>"destroy",
                    ];
                    return view('mobile.layouts.loading',compact('suggestData'));
                }
            }
            $suggestData=[
                'cmd'=>"home",
            ];
            return view('mobile.layouts.loading',compact('suggestData'));
            // return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        // $response=[
        //     "statusCode"=>"05",
        //     "statusMessage"=>"PAYMENT PENDING",
        //     "statusDesc"=>"PENDING",
        //     "responseDatetime"=>"2025-05-09T08:55:10+07:00",
        //     "result"=>[
        //     "createdAt"=>"2025-05-09T00:00:00Z",
        //     "merchantOutletName"=>"TAWCI 01",
        //     "merchantOutletUsername"=>"taucikuenak",
        //     "referenceNumber"=>"DB-20250509-0000001",
        //     "productName"=>"PLN TOKEN 20.000",
        //     "productCode"=>"plntkn20",
        //     "productCategoryId"=>4,
        //     "productCategoryName"=>"PLN",
        //     "subscriberNumber"=>"12345678901",
        //     "productPrice"=>22500,
        //     "productAdminFee"=>0,
        //     "productMerchantFee"=>0,
        //     "totalTrxAmount"=>22500,
        //     "billInfo"=>[
        //     "billDesc"=>[
        //     "customerId"=>"",
        //     "customerName"=>"",
        //     "detail"=>null],
        //     "sn"=>""]]];
        switch ($response['result']['productCategoryId']) {
            case 1:
                return view("mobile.layouts.products.pulsa.payment",compact('response'));
                break;
            
            case 11:
                return view("mobile.layouts.products.bpjs.payment",compact('response'));
                break;
            case 4:
                return view("mobile.layouts.products.pln_token.payment",compact('response'));
                break;
            
            default:
                return $response;
                break;
        }
    }
}
