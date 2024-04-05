<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanggal = Carbon::now();
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 3,
                'pembeli' => 'Arrya',
                'penjualan_kode' => 'pembeli1',
                'penjualan_tanggal' => $tanggal,
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 3,
                'pembeli' => 'Arrya',
                'penjualan_kode' => 'pembeli2',
                'penjualan_tanggal' => $tanggal,
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Arrya',
                'penjualan_kode' => 'pembeli3',
                'penjualan_tanggal' => $tanggal,
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 3,
                'pembeli' => 'Arrya',
                'penjualan_kode' => 'pembeli4',
                'penjualan_tanggal' => $tanggal,
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 3,
                'pembeli' => 'Arrya',
                'penjualan_kode' => 'pembeli5',
                'penjualan_tanggal' => $tanggal,
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Arrya',
                'penjualan_kode' => 'pembeli6',
                'penjualan_tanggal' => $tanggal,
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Arrya',
                'penjualan_kode' => 'pembeli7',
                'penjualan_tanggal' => $tanggal,
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Arrya',
                'penjualan_kode' => 'pembeli8',
                'penjualan_tanggal' => $tanggal,
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Arrya',
                'penjualan_kode' => 'pembeli9',
                'penjualan_tanggal' => $tanggal,
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Arrya',
                'penjualan_kode' => 'pembeli10',
                'penjualan_tanggal' => $tanggal,
            ],
            
        ];
        DB::table('t_penjualan') -> insert($data);
    
    }
}
