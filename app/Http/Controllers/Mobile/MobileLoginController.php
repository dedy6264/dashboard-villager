<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\HostService;
class MobileLoginController extends Controller
{
 protected $hostService;
    public function __construct(HostService $hostService){
        $this->hostService = $hostService;
    }
    public function index()
    {
        return view('mobile.login');
    }

    public function mobileLogin()
    {
        
        try {
                $payload=[
                    "username"=>request()->username,
                    "password"=>request()->password,
                ];
                // $response = Http::withBasicAuth('joe','secret')->post('https://google.com'.'/login/', $payload)->json();
                $response = Http::withBasicAuth('joe','secret')->post($this->hostService->GetUrl('v').'/login/', $payload)->json();
                if (!is_array($response) || !isset($response['result']) || !is_array($response['result'])) {
                    // return response()->json(['error' => 'Invalid API response format or data type'], 500);
                    $suggestData=[
                        'cmd'=>'destroy',
                    ];
                    return view('mobile.layouts.loading',compact('suggestData'));
                }
                if($response['statusCode']!=="00"){
                    return redirect()->back()->with('warning', 'wrong username or password!');
                }

                $suggestData=[
                    'cmd'=>'set',
                    'token'=>$response['result']['token'],
                    // 'endpoint'=>"home",
                ];
                return view('mobile.layouts.loading',compact('suggestData'));
        } catch (RequestException $e) {
            // Tangkap error jaringan

            return response()->json([
                'error' => true,
                'message' => 'Gagal menghubungi server login: ' . $e->getMessage()
            ], 500);
        }
    }
    public function pulsaPrabayar()
    {
        return view('mobile.layouts.pulsa');
    }

    public function mobileLogout()
    {
        $suggestData=[
            'cmd'=>'destroy',
        ];
        return view('mobile.layouts.loading',compact('suggestData'));
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
