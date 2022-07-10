<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presensi = Presensi::join('siswa','siswa.id','=','presensi.siswa_id')
                            ->join('kelas','kelas.id','=','siswa.kelas_id')
                            ->select([
                                'presensi.id',
                                'siswa.nama',
                                'kelas.nama_kelas',
                                'presensi.status'
                            ])->get();

        return $this->success($presensi,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|string',
            'status' => 'required|string'
        ]);

        if ($validator->fails()) {
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $presensi = new presensi();
        $presensi->siswa_id = $request->siswa_id;
        $presensi->status = $request->status;
        
        $savePresensi = $presensi->save();
        if ($savePresensi) {
            return $this->success($presensi,201);
        } else {
            return $this->failedResponse('presensi gagal ditambahkan!', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function show(Presensi $presensi)
    {
        return $this->success($presensi,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presensi $presensi)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|string',
            'status' => 'required|string'
        ]);

        if ($validator->fails()) {
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $presensi->siswa_id = $request->siswa_id;
        $presensi->status = $request->status;
        
        $savePresensi = $presensi->save();
        if ($savePresensi) {
            return $this->success($presensi,201);
        } else {
            return $this->failedResponse('Presensi berhasil!', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presensi $presensi)
    {
        $deletePresensi = $presensi->delete();

        if ($deletePresensi) {
            return $this->success(null,200);
        } else {
            return $this->failedResponse('Presensi gagal dihapus!',500);
        }
    }

    public function presensi($status){
        $data = Presensi::join('siswa','siswa.id','=','presensi.siswa_id')
                        ->select([
                            'siswa.nama',
                            'presensi.status'
                        ])
                        ->where('status','=',$status)->get();

        return $this->success($data, 200);
    }

    private function success($data,$statusCode,$message='success')
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'status_code' => $statusCode
        ],$statusCode);
    }

     private function failedResponse($message,$statusCode)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => null,
            'status_code' => $statusCode
        ],$statusCode);
    }
}