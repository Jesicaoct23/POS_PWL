<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokModel;
use App\Models\UserModel;
use App\Models\BarangModel;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb =(object)[
            'title' => 'Stok',
            'list' => ['Home', 'Stok'],
        ];

        $page = (object)[
            'title' => 'Daftar stok barang '
        ];

        $activeMenu = 'stok';

        $user = UserModel::all();
        $barang = BarangModel::all();

        return view('stok.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'user' => $user,
            'barang' => $barang
        ]);
    }

    public function list(Request $request){
        $stoks = StokModel::select('stok_id', 'user_id', 'barang_id', 'stok_tanggal', 'stok_jumlah')
            ->with('user', 'barang');

        if ($request->user_id) {
            $stoks->where('user_id', $request->user_id);
        }
        if ($request->barang_id) {
            $stoks->where('barang_id', $request->barang_id);
        }

        return DataTables::of($stoks)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) {
                $btn = '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $stok->stok_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;

            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Stok',
            'list' => ['Home', 'Stok'],
        ];
        $page = (object)[
            'title' => 'Form Tambah Stok'
        ];
        $activeMenu = 'stok';
        $user = UserModel::all();
        $barang = BarangModel::all();
        return view('stok.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'user' => $user,
            'barang' => $barang
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|numeric|min:0',
        ]);
        StokModel::create([
            'user_id' => $request->user_id,
            'barang_id' => $request->barang_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah
        ]);
        return redirect('/stok')->with('success', 'Stok Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        $stok = StokModel::with('user', 'barang')->find($id);
        $breadcrumb = (object)[
            'title' => 'Stok',
            'list' => ['Home', 'Stok','Detail'],
        ];
        $page = (object)[
            'title' => 'Detail Stok'
        ];
        $activeMenu = 'stok';
        return view('stok.show', [
            'stok' => $stok,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $stok = StokModel::with('user', 'barang')->find($id);
        $breadcrumb = (object)[
            'title' => 'Stok',
            'list' => ['Home', 'Stok','Edit'],
        ];
        $page = (object)[
            'title' => 'Edit Stok'
        ];
        $activeMenu = 'stok';
        $user = UserModel::all();
        $barang = BarangModel::all();
        return view('stok.edit', [
            'stok' => $stok,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'user' => $user,
            'barang' => $barang
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|numeric|min:0',
        ]);
        StokModel::find($id)->update([
            'user_id' => $request->user_id,
            'barang_id' => $request->barang_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah
        ]);
        return redirect('/stok')->with('success', 'Stok Berhasil Diubah');
    }

    public function destroy(string $id)
    {
        $check = StokModel::find($id);
        if (!$check) {
            return redirect('/stok')->with('error', 'Stok tidak ditemukan');
        }
        try {
            StokModel::destroy($id);
            return redirect('/stok')->with('success', 'Stok Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Stok gagal dihapus');
        }
    }
}