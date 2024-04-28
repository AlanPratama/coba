<?php

namespace Database\Seeders;

use App\Models\t_detailpeminjaman;
use App\Models\t_peminjaman;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peminjaman = t_peminjaman::create([
            'f_idanggota' => 3,
            'f_idadmin' => 7,
            'f_tanggalpeminjaman' => Carbon::now()->toDateString(),
        ]);

        t_detailpeminjaman::create([
            'f_idpeminjaman' => $peminjaman->f_id,
            'f_iddetailbuku' => 3,
            'f_tanggalkembali' => null,
            'f_status' => 'Dipinjam',
        ]);
    }
}
