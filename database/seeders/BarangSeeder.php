<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'skintific',
                'barang_nama' => 'Skintific',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'wardah',
                'barang_nama' => 'Wardah',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 2,
                'barang_kode' => 'pampers',
                'barang_nama' => 'Pampers',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => 'telon',
                'barang_nama' => 'Telon',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'sarden',
                'barang_nama' => 'Sarden',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'roti',
                'barang_nama' => 'Roti',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => 'teh',
                'barang_nama' => 'Teh',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => 'juice',
                'barang_nama' => 'Juice',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => 'obeng',
                'barang_nama' => 'Obeng',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'bor',
                'barang_nama' => 'Bor',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],

        ];
        DB::table('m_barang') -> insert($data);
    }
}
