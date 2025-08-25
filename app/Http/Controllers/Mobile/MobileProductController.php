<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Services\HostService;
class MobileProductController extends Controller
{
     protected $hostService;
    public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
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
        // $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/product/gets', $payload)->json();
        $response =[
            "responseCode"=> "00",
            "responseMessage"=> "SUCCESS",
            "responseDateTime"=> "2025-07-04T20:00:58+07:00",
            "result"=> [
                "records_total"=> 4,
                "records_filtered"=> 4,
                "data"=> [
                    [
                        "id"=> 1,
                        "segment_id"=> 1,
                        "segment_name"=> "SEGMENT B",
                        "product_reference_id"=> 1,
                        "product_reference_name"=> "TELKOMSEL",
                        "product_reference_code"=> "PRTSEL",
                        "product_category_id"=> 1,
                        "product_category_name"=> "PULSA",
                        "provider_id"=> 1,
                        "provider_name"=> "Provider A",
                        "product_provider_id"=> 1,
                        "product_provider_name"=> "Pulsa Telkomsel 10K",
                        "product_provider_code"=> "PTS10",
                        "product_provider_price"=> 10000,
                        "product_provider_admin_fee"=> 0,
                        "product_provider_merchant_fee"=> 0,
                        "product_type_id"=> 1,
                        "product_type_name"=> "PAYMENT",
                        "product_id"=> 1,
                        "product_name"=> "Pulsa 10K",
                        "product_code"=> "P10K",
                        "product_price"=> 11000,
                        "product_admin_fee"=> 0,
                        "product_merchant_fee"=> 0,
                        "product_availability"=> true,
                        "created_by"=> "sys",
                        "updated_by"=> "sys",
                        "created_at"=> "2025-07-03T23:24:44Z",
                        "updated_at"=> "2025-07-03T23:24:44Z"
                    ],
                [
                        "id"=> 2,
                        "segment_id"=> 1,
                        "segment_name"=> "SEGMENT B",
                        "product_reference_id"=> 8,
                        "product_reference_name"=> "BPJS KESEHATAN",
                        "product_reference_code"=> "BPJSKS",
                        "product_category_id"=> 2,
                        "product_category_name"=> "BPJS",
                        "provider_id"=> 1,
                        "provider_name"=> "Provider A",
                        "product_provider_id"=> 2,
                        "product_provider_name"=> "BPJS Kesehatan",
                        "product_provider_code"=> "BPJS",
                        "product_provider_price"=> 0,
                        "product_provider_admin_fee"=> 2500,
                        "product_provider_merchant_fee"=> 1000,
                        "product_type_id"=> 1,
                        "product_type_name"=> "PAYMENT",
                        "product_id"=> 2,
                        "product_name"=> "BPJS Kesehatan",
                        "product_code"=> "BPJSKS",
                        "product_price"=> 0,
                        "product_admin_fee"=> 2500,
                        "product_merchant_fee"=> 500,
                        "product_availability"=> true,
                        "created_by"=> "sys",
                        "updated_by"=> "sys",
                        "created_at"=> "2025-07-03T23:24:44Z",
                        "updated_at"=> "2025-07-03T23:24:44Z"
                    ],
                [
                        "id"=> 3,
                        "segment_id"=> 2,
                        "segment_name"=> "SEGMENT B",
                        "product_reference_id"=> 10,
                        "product_reference_name"=> "PLN PREPAID",
                        "product_reference_code"=> "PLNPRE",
                        "product_category_id"=> 6,
                        "product_category_name"=> "PLN",
                        "provider_id"=> 1,
                        "provider_name"=> "Provider A",
                        "product_provider_id"=> 3,
                        "product_provider_name"=> "Token PLN 20K",
                        "product_provider_code"=> "hpln20000",
                        "product_provider_price"=> 20950,
                        "product_provider_admin_fee"=> 0,
                        "product_provider_merchant_fee"=> 0,
                        "product_type_id"=> 2,
                        "product_type_name"=> "PURCHASING",
                        "product_id"=> 3,
                        "product_name"=> "PLN Token 20rb",
                        "product_code"=> "PLNPRE20K",
                        "product_price"=> 21500,
                        "product_admin_fee"=> 0,
                        "product_merchant_fee"=> 0,
                        "product_availability"=> true,
                        "created_by"=> "sys",
                        "updated_by"=> "sys",
                        "created_at"=> "2025-07-03T23:24:44Z",
                        "updated_at"=> "2025-07-03T23:24:44Z"
                ],
                [
                        "id"=> 4,
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
                        "product_availability"=> true,
                        "created_by"=> "sys",
                        "updated_by"=> "sys",
                        "created_at"=> "2025-07-03T23:24:44Z",
                        "updated_at"=> "2025-07-03T23:24:44Z"
                ]
                ]
            ]
        ];
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
        $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/helper/getReference', $payload)->json();
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
        $response = Http::withToken($request->bearerToken())->post($this->hostService->GetUrl('v').'/biller/inquiry', $payload)->json();
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
        //         "transactionTotalAmount"=>0,
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
        $response = Http::withToken($token)->post($this->hostService->GetUrl('v').'/biller/payment', $payload)->json();
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
        //     "transactionTotalAmount"=>22500,
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
