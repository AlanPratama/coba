<?php

namespace Database\Seeders;

use App\Models\t_buku;
use App\Models\t_detailbuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buku = t_buku::create([
            'f_idkategori' => 1,
            'f_judul' => 'Belajar C++',
            'f_pengarang' => 'Lalala',
            'f_penerbit' => 'PT. A',
            'f_deskripsi' => 'Ini deskripsi',
        ]);

        t_detailbuku::create([
            'f_idbuku' => $buku->f_id,
            'f_status' => 'Tersedia',
        ]);
    }
}
