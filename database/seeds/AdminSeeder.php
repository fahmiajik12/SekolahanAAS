<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'type' => 'admin',
        'username' => 'admin',
        'password' => Hash::make('qwe123')
        ]);
    }
}
