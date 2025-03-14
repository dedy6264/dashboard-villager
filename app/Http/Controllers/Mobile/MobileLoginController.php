<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MobileLoginController extends Controller
{

    public function index()
    {
        return view('mobile.login');
    }

    public function mobileLogin()
    {
        $payload=[
            "merchantOutletUsername"=>request()->username,
            "merchantOutletPassword"=>request()->password,
        ];
        $response = Http::withBasicAuth('joe','secret')->post(ENV('HOST_VILLAGER').'/login/', $payload)->json();
        if($response['statusCode']!=="00"){
            return redirect()->back()->with('warning', 'wrong username or password!');
        }
        if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
            return response()->json(['error' => 'Invalid API response format or data type'], 500);
        }
        // $response = $response['result'];
        $mainData=[
            'token'=>$response['result']['token'],
            'endpoint'=>"home",
        ];
        // dd($mainData);
        return view('mobile.layouts.loading',compact('mainData'));
    }
    public function pulsaPrabayar()
    {
        return view('mobile.layouts.pulsa');
    }

    public function mobileLogout()
    {
        $mainData=[
            'endpoint'=>"login",
        ];
        return view('mobile.layouts.loading',compact('mainData'));
    }

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
