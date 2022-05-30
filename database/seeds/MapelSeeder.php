<?php

use App\Model\Mapel;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mapel::create([
            'kode_mapel' => 'km-1',
            'nama_mapel' => 'Kalkulus'
            ]);
    }
}