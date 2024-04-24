<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        // ambil data user dan simpan pada variabel user
        $user = Auth::user();

        // kondisi jika usernya ada
        if ($user) {
            // Jika usernya memiliki level admin
            if ($user->level_id == '1') {
                return redirect()->intended('admin');
            }
            // jika usernya memiliki level manager
            else if ($user->level_id == '2') {
                return redirect()->intended('manager');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        // validasi saat tombol di klik
        // validasnya username & password wajib diisi
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        // ambil data request username & password
        $credentials = $request->only('username', 'password');
        // cek jika data username dan passwordnya valid atau sesuai dengan data
        if (Auth::attempt($credentials)) {
            // kalau berhasil simpan datanya pada variabel user
            $user = Auth::user();

            // cek lagi jika level user admin maka arahkan ke halaman admin
            if ($user->level_id == '1') {
                return redirect()->intended('admin');   
            }
            // tapi jika level nya user biasa maka arahkan ke halaman user
            elseif ($user->level_id == '2') {
                return redirect()->intended('manager');
            }
            // jika belum ada rolenya maka ke halaman /
            return redirect()->intended('/');
        }
        // jika tidak ada data user yang valid maka kembalikan ke halaman login
        // pastikan kirim pesan error juga kalau login gagal
        return redirect('login')
            ->withInput()
            ->withErrors([
                'Login_gagal' => 'Pastikan username dan password anda benar!'
            ]);
    }

    public function register()
    {
        return view('register');
    }

    // aksi form register
    public function proses_register(Request $request)
    {
        // validasi saat tombol di klik
        // validasnya semua field wajib diisi
        // validasi username harus unik
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:m_user',
            'nama' => 'required',
            'password' => 'required',
        ]);

        // kalau gagal kembali ke halaman register dengan memuncilkan pesan error
        if ($validator->fails()) {
            return redirect('register')
                ->withInput()
                ->withErrors($validator);
        }
        // kalau berhasil isi level & hash password
        $request['level_id'] = '2';
        $request['password'] = Hash::make($request->password);

        // masukkan semua data pada request ke tabel user
        UserModel::create($request->all());

        // kalau berhasil kembali ke halaman login
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        // logout itu harus menghapus session nya
        $request->session()->flush();

        // Jalankan juga fungsi logout pada Auth
        Auth::logout();

        // kembali ke halaman login
        return redirect('login');
    }
}