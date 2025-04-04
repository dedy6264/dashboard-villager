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
    public function bpjsks()
    {
        return view("mobile.layouts.products.bpjs.index");
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
            switch ($response['result']['statusMessage']) {
                case 'NO PELANGGAN TIDAK DITEMUKAN':
                    $payload=['error' => $response['result']['statusMessage']];
                    break;
                case 'TAGIHAN SUDAH LUNAS':
                    $payload=['error' => $response['result']['statusMessage']];
                    break;
                case 'TIMEOUT':
                    $payload=['error' => $response['result']['statusMessage']];
                    break;
                default:
                    $payload=['error' => $response['message']];
                    break;
            }
            return response()->json($payload, 500);
        }
        // $response = $response['result'];
        return $response;
    }

    public function payment(Request $request)
    {
        $payload=[
            "referenceNumber"=>$request->referenceNumber,
        ];
        $response = Http::withToken($request->bearerToken())->post(ENV('HOST_VILLAGER').'/biller/payment', $payload)->json();
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        // $response = $response['result'];
        if($response['result']['productCode']==="BPJSKS"){
            return view("mobile.layouts.products.bpjs.paymentBpjs",compact('response'));
        }
        return $response;
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
