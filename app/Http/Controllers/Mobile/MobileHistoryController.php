<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


class MobileHistoryController extends Controller
{
    public function index()
    {
        return view('mobile.layouts.history.index');
    }
    public function getTrx(Request $request){
        if (request()->bearerToken()) {
            $token=$request->bearerToken();
        }else{
            $token=$request->token;
        }
        // dump($token);
        $payload=[
            "referenceNumber"=>$request->referenceNumber,
        ];
        $response = Http::withToken($token)->post(ENV('HOST_VILLAGER').'/trx/getTrx', $payload)->json();
        // if($response['statusCode']!=="00"){
            //     return redirect()->back()->with('warning', 'wrong username or password!');
            // }
            // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        // if((int)$request->size===1){
        //     $response = $response['result'];
        //     return $response;
        // }
        return view("mobile.layouts.history.payment",compact('response'));

    }
    public function getTrxs(Request $request){
        $filter=[
            "length"=>$request->size,
        ];
        $payload=[
            "filter"=>$filter,
            "referenceNumber"=>$request->referenceNumber,
        ];
        $response = Http::withToken(request()->bearerToken())->post(ENV('HOST_VILLAGER').'/trx/getTrxs', $payload)->json();
        // if($response['statusCode']!=="00"){
        //     return redirect()->back()->with('warning', 'wrong username or password!');
        // }
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        // if((int)$request->size===1){
            $response = $response['result'];
            // dd(is_array($response));
            return $response;
        // }
        // return view("mobile.layouts.history.payment",compact('response'));

    }
    public function cekcek(){
        // dump(Carbon::createFromTimestamp('1742846007')->toDateTimeString()->setTimezone('Asia/Jakarta'));
        $dateNow = Carbon::now('Asia/Jakarta');
        $convertedDate = Carbon::createFromTimestamp('1742846007', 'Asia/Jakarta');
        dd($convertedDate->greaterThan($dateNow));
    }
    public function advice(Request $request){
        $payload=[
            "referenceNumber"=>$request->referenceNumber,
        ];
        $response = Http::withToken(request()->bearerToken())->post(ENV('HOST_VILLAGER').'/biller/advice', $payload)->json();
        // if($response['statusCode']!=="00"){
        //     return redirect()->back()->with('warning', 'wrong username or password!');
        // }
        // dd($response);
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        // $response = $response['result'];
        return $response;
    }
}
