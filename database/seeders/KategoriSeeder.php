<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'beauty',
                'kategori_nama' => 'Skincare',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'baby',
                'kategori_nama' => 'Baby-kit',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'food',
                'kategori_nama' => 'Food',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'drink',
                'kategori_nama' => 'Drink',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'tools',
                'kategori_nama' => 'Tools',
            ],
            
        ];
        DB::table('m_kategori') -> insert($data);
    }
}
