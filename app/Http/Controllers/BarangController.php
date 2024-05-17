<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];
        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];
        $activeMenu = 'barang'; // set menu yang sedang aktif

        $kategori = KategoriModel::all();     //ambil data level untuk filter level
        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Ambil data barang dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'image')->with('kategori');

        //Filter data barang berdasarkan level_id
        if ($request->kategori_id) {
            $barangs->where('kategori_id', $request->kategori_id);
        }
        return DataTables::of($barangs)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah barang baru'
        ];
        $kategori = KategoriModel::all(); //ambil data kategori untuk ditampilkan di form
        $activeMenu = 'barang'; // set menu yang sedang aktif
        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
{
    // Validate the request inputs
    $request->validate([
        'barang_kode' => 'required|string|max:10',
        'barang_nama' => 'required|string|max:100|unique:m_barang,barang_nama',
        'harga_beli' => 'required|integer',
        'harga_jual' => 'required|integer',
        'kategori_id' => 'required|integer',
        'image' => 'required|image', // Validate image type and size
    ]);

    $extfile = $request->image->getClientOriginalName();
        $namaFile = 'web-' . time() . "." . $extfile;

        $path = $request->image->move('gbrStarterCode', $namaFile);
        $path = str_replace("\\", "//", $path);
        $pathBaru = asset('gbrStarterCode/' . $namaFile);

        BarangModel::create([
            'kategori_id'   => $request->kategori_id,
            'barang_kode'   => $request->barang_kode,
            'barang_nama'   => $request->barang_nama, 
            'harga_beli'    => $request->harga_beli,
            'harga_jual'    => $request->harga_jual,
            'image'         => $pathBaru
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil ditambahkan');
}


    public function show(String $id)
    {
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list'  => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $activeMenu = 'barang';       //set menu yang sedang aktif
        return view(
            'barang.show',
            [
                'breadcrumb' => $breadcrumb,
                'page'       => $page,
                'barang'       => $barang,
                'activeMenu' => $activeMenu
            ]
        );
    }

    public function edit(String $id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list'  => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit barang'
        ];

        $activeMenu = 'barang'; //set menu yang sedang aktif

        return view('barang.edit', [
            'barang' => $barang,
            'kategori' => $kategori,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|max:10',
            'barang_nama' => 'required|string|max:100|unique:m_barang,barang_nama',
            'harga_beli'     => 'required|integer',
            'harga_jual'     => 'required|integer',
            'kategori_id' => 'required|integer',
            'image' => 'required|file|image'
        ]);
        $extfile = $request->image->getClientOriginalName();
        $namaFile = 'web-' . time() . "." . $extfile;

        $path = $request->image->move('gbrStarterCode', $namaFile);
        $path = str_replace("\\", "//", $path);
        $pathBaru = asset('gbrStarterCode/' . $namaFile);

        BarangModel::find($id)->update([
            'kategori_id'   => $request->kategori_id,
            'barang_kode'   => $request->barang_kode,
            'barang_nama'   => $request->barang_nama, 
            'harga_beli'    => $request->harga_beli,
            'harga_jual'    => $request->harga_jual,
            'image'         => $pathBaru
        ]);
        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    //Menghapus data barang
    public function destroy(string $id)
    {
        $check = BarangModel::find($id);
        if (!$check) {      //untuk mengecek apakah data barang dengan id yang dimaksud ada atau tidak
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            BarangModel::destroy($id);    //Hapus data level

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
        }
    }

    public function fileUpload()
    {
        return view('barang.create');
    }

    public function prosesFileUpload(Request $request)
{
    $request->validate([
        'berkas' => 'required|file|image|max:500', // Validasi file gambar
        'image_name' => 'required|string', // Validasi inputan nama file
    ]);

    // Menyimpan file dengan nama yang sama seperti aslinya
    $path = $request->berkas->move('gambar');

    // Menampilkan informasi dan link file yang diunggah
    echo "Gambar berhasil diupload ke <a href='$path' target='_blank'>" . $request->berkas->getClientOriginalName() . "</a>"; // Menambahkan link ke gambar
    echo "<br> <br>";
    echo "Tampilkan gambar: <br> <img src='$path'>";
}

}