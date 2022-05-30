<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();

        return $this->success($kelas,200);
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
            'kode_kelas' => 'required|string|unique:kelas,kode_kelas',
            'nama_kelas' => 'required|string'
        ]);

        if ($validator->fails()) {
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $kelas = new kelas();
        $kelas->kode_kelas = $request->kode_kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        
        $saveKelas = $kelas->save();
        if ($saveKelas) {
            return $this->success($kelas,201);
        } else {
            return $this->failedResponse('Kelas gagal ditambahkan!', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        return $this->success($kelas,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        $validator = Validator::make($request->all(), [
            'kode_kelas' => 'required|string|unique:kelas,kode_kelas,'.$kelas->id,
            'nama_kelas' => 'required|string'
        ]);

        if ($validator->fails()) {
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $kelas->kode_kelas = $request->kode_kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        
        $saveKelas = $kelas->save();
        if ($saveKelas) {
            return $this->success($kelas,201);
        } else {
            return $this->failedResponse('Kelas gagal diupdate!', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        $deleteKelas = $kelas->delete();

        if ($deleteKelas) {
            return $this->success(null,200);
        } else {
            return $this->failedResponse('Kelas gagal dihapus!',500);
        }
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