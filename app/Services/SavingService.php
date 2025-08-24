<?php

namespace App\Services;

// use App\Models\Segment; // misalnya ambil dari model Segment
use Illuminate\Support\Facades\Http;

class SavingService
{
    public function getSavingAccount()
    {
  try {
             $payload=[
               "start"=>0,
                "length"=>0,
                "draw"=>0,
                "order"=>"id",
                "sort"=>"asc",
                "filter"=>[
                    "provider_id"=>(int)request()->provider_id,
                ],
            ];
            $response = Http::withBasicAuth('mocha','michi')->post(ENV('HOST_MAKARIOS').'/api/getSavingAccount',$payload)->json();
            // dd($response);
            if (!isset($response['responseCode'])) {
                if ($response['message']=="invalid or expired jwt"){
                    $data=[
                        'endpoint'=>"login",
                        'command'=>"destroy",
                        'desc'=>'Invalid token',
                    ];
                    return response()->json(['error' => $data], 401);
                }
                return response()->json([
                    'error' => 'Response format invalid.',
                    'raw' => $response
                ], 500);
            }

            switch ($response['responseCode']) {
                case '00':
                    // Berhasil
                    $userData = $response['result'] ?? null;
                    return response()->json([
                        'draw' => intval(request()->input('draw')), // ambil dari request
                        'recordsTotal' => $userData['records_total'],
                        'recordsFiltered' => $userData['records_filtered'],
                        'data' => $userData['data']
                    ]);
                default:
                    // Kode lain yang tidak dikenali (error umum)
                    return response()->json([
                        'success' => false,
                        'message' => $response['statusMessage'] ?? 'Terjadi kesalahan.',
                        'detail' => $response['statusDesc'] ?? 'Tidak ada keterangan tambahan.'
                    ], 400);
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
        return Segment::all();

        // atau bisa pakai query khusus
        // return Segment::where('status', 'active')->get();
    }
}
