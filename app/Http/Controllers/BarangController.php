<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb =(object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang'],
        ];

        $page = (object) [
            'title' => 'Daftar Barang',
        ];

        $activeMenu = 'barang';

        $kategori= KategoriModel::all();

        return view('barang.index',[
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'kategori' => $kategori
        ]);
    }

    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')->with('kategori');

        if ($request->kategori_id) {
            $barangs->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barangs)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) {
                $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create(){
        $breadcrumb =(object)[
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Barang Baru',
        ];

        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'kategori' => $kategori
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'barang_kode'   => 'required|unique:m_barang,barang_kode',
            'barang_nama'   => 'required|max:100',
            'harga_beli'    => 'required|integer',
            'harga_jual'    => 'required|integer',
            'kategori_id'   => 'required|integer',
        ]);
        BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id
        ]);
        return redirect('/barang')->with('success', 'Barang Berhasil Ditambahkan');
    }

    public function show(string $id){
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb =(object)[
            'title' => 'Detail',
            'list' => ['Home', 'Barang', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail Barang',
        ];
        $activeMenu = 'barang';

        return view('barang.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'barang' => $barang
        ]);
    }

    public function edit($id){
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb =(object)[
            'title' => 'Edit',
            'list' => ['Home', 'Barang', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit Barang',
        ];
        $activeMenu = 'barang';

        return view('barang.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'barang' => $barang,
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'barang_kode'   => 'required|unique:m_barang,barang_kode,'.$id.',barang_id',
            'barang_nama'   => 'required|max:100',
            'harga_beli'    => 'required|integer',
            'harga_jual'    => 'required|integer',
            'kategori_id'   => 'required|integer',
        ]);
        BarangModel::find($id)->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id
        ]);
        return redirect('/barang')->with('success', 'Barang Berhasil Diupdate');
    }

    public function destroy($id){
        $check = BarangModel::find($id);
        if(!$check){
            return redirect('/barang')->with('error', 'Data Barang tidak ditemukan');
        }
        try {
            BarangModel::destroy($id);
            return redirect('/barang')->with('success', 'Data Barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data Barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}