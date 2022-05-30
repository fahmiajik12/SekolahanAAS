<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = [ 'nis','gender','nama','tempat_lahir','tgl_lahir',
                            'nama_ortu','phone_number','email','alamat','kelas_id'
                            ];
    protected $dates = ['tgl_lahir'];
    public function kelas()
    {
        return $this->belongsTo('App\Model\Kelas','kelas_id');
    }
}
