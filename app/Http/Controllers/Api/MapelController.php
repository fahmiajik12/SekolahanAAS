<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Mapel::all();

        return $this->success($mapel,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_mapel' => 'required|string|unique:mapel,kode_mapel',
            'nama_mapel' => 'required|string'
        ]);

        if($validator->fails()){
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $mapel = new Mapel();
        $mapel->kode_mapel = $request->kode_mapel;
        $mapel->nama_mapel = $request->nama_mapel;
        
        $saveMapel = $mapel->save();
        if ($saveMapel) {
            return $this->success($mapel,201);
        } else {
            return $this->failedResponse('Mapel gagal ditambahkan!', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        return $this->success($mapel,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        $validator = Validator::make($request->all(),[
            'kode_mapel' => 'required|string|unique:mapel,kode_mapel,'.$mapel->id,
            'nama_mapel' => 'required|string'
        ]);

        if($validator->fails()){
            $pesan = $validator->errors();

            return $this->failedResponse($pesan,422);
        }

        $mapel->kode_mapel = $request->kode_mapel;
        $mapel->nama_mapel = $request->nama_mapel;
        
        $saveMapel = $mapel->save();
        if ($saveMapel) {
            return $this->success($mapel,200);
        } else {
            return $this->failedResponse('Mapel gagal diupdate!', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        $deleteMapel = $mapel->delete();

        if ($deleteMapel) {
            return $this->success(null,200);
        } else {
            return $this->failedResponse('Mapel gagal dihapus!',500);
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
