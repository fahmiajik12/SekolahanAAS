<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = [ 'kode_kelas','nama_kelas' ];
    public function siswas()
    {
        return $this->hasMany('App\Model\Siswa','kelas_id');
    }
    public function jadwals()
    {
        return $this->hasMany('App\Model\Jadwal','kelas_id');
    }
}
