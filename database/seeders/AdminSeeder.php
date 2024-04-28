<?php

namespace Database\Seeders;

use App\Models\t_admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        t_admin::create([
            'f_nama' => 'Awan Dwi',
            'f_username' => 'awan',
            'f_password' => bcrypt('awan'),
            'f_level' => 'Admin',
            'f_status' => 'Aktif'
        ]);

        t_admin::create([
            'f_nama' => 'Arif',
            'f_username' => 'arif',
            'f_password' => bcrypt('arif'),
            'f_level' => 'Pustakawan',
            'f_status' => 'Tidak Aktif'
        ]);
    }
}
