<?php

use Illuminate\Database\Seeder;
use App\Model\Jadwal;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jadwal::create([
            'kelas_id' => '1',
            'mapel_id' => '1',
            'guru_id' => '1',
            'hari' => 'Senin',
            'jam_pelajaran' => '07.30 - 10.20 WIB',
            ]);
    }
}
