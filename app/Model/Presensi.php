<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';
    protected $fillable = [ 'siswa_id','status' ];
    public function siswa()
    {
        return $this->belongsTo('App\Model\Siswa','siswa_id');
    }
}