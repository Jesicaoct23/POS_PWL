<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class barangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar barang',
            'list' => ['Home', 'barang']
        ];
        $page = (object)[
            'title' => 'Daftar barang yang Terdaftar dalam Sistem'
        ];
        $barang = BarangModel::all();
        $activeMenu = 'barang';
        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'kategori_id', 'barang_nama', 'barang_kode', 'harga_beli', 'harga_jual');

        return DataTables::of($barangs)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) {
                $btn = '<a href="' . route('barang.show', $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . route('barang.edit', $barang->barang_id) . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . route('barang.destroy', $barang->barang_id) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'tambah barang',
            'list' => ['Home', 'barang', 'Tambah']
        ];
        $page = (object)[
            'title' => 'tambah barang baru'
        ];
        $barang = BarangModel::all();
        $activeMenu = 'barang';
        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|string|max:100',
            'barang_nama' => 'required|string|max:100',
            'barang_kode' => 'required|string|max:100',
            'harga_beli' => 'required|string|max:100',
            'harga_jual' => 'required|string|max:100',

        ]);
        BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_nama' => $request->barang_nama,
            'barang_kode' => $request->barang_kode,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,

        ]);
        return redirect('/barang')->with('succes', 'data berhasil disimpan');
    }
    public function show($id)
    {
        $barang = BarangModel::find($id);
        $breadcrumb = (object)[
            'title' => 'Detail barang',
            'list' => ['Home', 'barang', 'Detail'],

        ];
        $page = (object)[
            'title' => 'Detail barang'
        ];
        $activeMenu = 'barang';
        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function edit($id)
    {
        $barang = BarangModel::find($id);
        $breadcrumb = (object)[
            'title' => 'Edit barang',
            'list' => ['Home', 'barang', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit barang'
        ];
        $activeMenu = 'barang';
        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|string|max:100',
            'barang_nama' => 'required|string|max:100',
            'barang_kode' => 'required|string|max:100',
            'harga_beli' => 'required|string|max:100',
            'harga_jual' => 'required|string|max:100',
        ]);

        // Temukan barang berdasarkan ID
        $barang = BarangModel::find($id);

        // Jika barang tidak ditemukan, kembalikan pesan kesalahan
        if (!$barang) {
            return redirect('/barang')->with('error', 'Barang tidak ditemukan');
        }

        // Perbarui data barang dengan data yang baru
        $updated = $barang->update([
            'kategori_id' => $request->kategori_id,
            'barang_nama' => $request->barang_nama,
            'barang_kode' => $request->barang_kode,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        // Jika data berhasil diperbarui, kembalikan pesan sukses. Jika tidak, kembalikan pesan kesalahan.
        if ($updated) {
            return redirect('/barang')->with('success', 'Data barang berhasil diubah');
        } else {
            return redirect('/barang')->with('error', 'Tidak ada perubahan yang dilakukan');
        }
    }

    public function destroy($id)
    {
        try {
            BarangModel::destroy($id);
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terkait dengan tabel lain');
        }
    }
}