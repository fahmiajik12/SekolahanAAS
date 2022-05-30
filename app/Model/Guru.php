<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = [
                            'user_id','nip','nama','tempat_lahir','tgl_lahir','gender','phone_number',
                            'email','alamat','pendidikan'
                            ];
    protected $dates = ['tgl_lahir']; //optional
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function jadwals()
    {
        return $this->hasMany('App\Model\Jadwal','guru_id'); 
    }
}
