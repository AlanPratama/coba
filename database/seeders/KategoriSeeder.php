<?php

namespace Database\Seeders;

use App\Models\t_kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Romance', 
            'Comedy', 
            'Action', 
            'Drama', 
            'Thriller', 
            'Mystery', 
            'Sci-Fi', 
            'Fantasy', 
            'Adventure', 
        ];

        foreach ($data as $value) {
            t_kategori::create([
                'f_kategori' => $value
            ]);
        }
    }
}
