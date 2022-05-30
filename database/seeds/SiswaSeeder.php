<?php

use Illuminate\Database\Seeder;
use App\Model\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::create([
            'nis' => '2005040063',
            'nama' => 'Elsa Dwi Nur Iffaty',
            'gender' => 'Perempuan',
            'tempat_lahir' => 'Magelang',
            'tgl_lahir' => '27 Juli 2002',
            'email' => 'elsadniffaty27@gmail.com',
            'nama_ortu' => 'Tri Joko',
            'alamat' => 'Turus, Tempuran',
            'phone_number' => '081234556789',
            'kelas_id' => '303'
            ]);
    }
}
