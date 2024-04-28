<?php

namespace Database\Seeders;

use App\Models\t_anggota;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        t_anggota::create([
            'f_nama' => 'Alan Pratama',
            'f_username' => 'lalan',
            'f_password' => bcrypt('lalan'),
            'f_tempatlahir' => 'Jakarta',
            'f_tanggallahir' => Carbon::now()->toDateString(),
        ]);
    }
}
