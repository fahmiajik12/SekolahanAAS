<?php

use App\Model\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guru::create([
            'user_id' => '01',
            'nip' => '30270996',
            'nama' => 'Dwi Nur',
            'tempat_lahir' => 'Berlin',
            'tgl_lahir' => '1996-07-27',
            'gender' => 'Perempuan',
            'phone_number' => '0854678992',
            'email' => 'dwinuriffty@gmail.com',
            'alamat' => 'salaman',
            'pendidikan' => 'S2 Bachelor of Informatics'
            ]);
    }
}