<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::all();

        return $this->success($jadwal,200);
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
            'kelas_id' => 'required|string',
            'mapel_id' => 'required|string',
            'guru_id' => 'required|string',
            'hari' => 'required|string',
            'jam_pelajaran' => 'required|string'
        ]);

        if ($validator->fails()) {
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $jadwal = new jadwal();
        $jadwal->kelas_id = $request->kelas_id;
        $jadwal->mapel_id = $request->mapel_id;
        $jadwal->guru_id = $request->guru_id;
        $jadwal->hari = $request->hari;
        $jadwal->jam_pelajaran = $request->jam_pelajaran;
        
        $saveJadwal = $jadwal->save();
        if ($saveJadwal) {
            return $this->success($jadwal,201);
        } else {
            return $this->failedResponse('Jadwal gagal ditambahkan!', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        return $this->success($jadwal,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $validator = Validator::make($request->all(), [
            'kelas_id' => 'required|string',
            'mapel_id' => 'required|string',
            'guru_id' => 'required|string',
            'hari' => 'required|string',
            'jam_pelajaran' => 'required|string'
        ]);

        if ($validator->fails()) {
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $jadwal->kelas_id = $request->kelas_id;
        $jadwal->mapel_id = $request->mapel_id;
        $jadwal->guru_id = $request->guru_id;
        $jadwal->hari = $request->hari;
        $jadwal->jam_pelajaran = $request->jam_pelajaran;
        
        $saveJadwal = $jadwal->save();
        if ($saveJadwal) {
            return $this->success($jadwal,201);
        } else {
            return $this->failedResponse('Jadwal gagal ditambahkan!', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        $deleteJadwal = $jadwal->delete();

        if ($deleteJadwal) {
            return $this->success(null,200);
        } else {
            return $this->failedResponse('Jadwal gagal dihapus!',500);
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
