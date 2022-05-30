<?php

use Illuminate\Database\Seeder;
use App\Model\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'kode_kelas' => 'A1',
            'nama_kelas' => 'Kelas A'
            ]);
    }
}
