<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    //
    public function fileUpload()
    {
        return view('file-upload');
    }

    public function prosesFileUpload(Request $request)
    {
        $request->validate([
            'berkas' => 'required|file|image|max:500'
        ]);
        $extfile=$request->berkas->getClientOriginalName();
        $namaFile='web-'.time().".".$extfile;

        $path = $request->berkas->storeAs('public', $namaFile);
        $path =str_replace("\\","//",$path);
        echo"variabel path berisi:$path <br>";

        $pathBaru=asset('gambar/'.$namaFile);
         echo "Proses upload berhasil, file berada di: $path";
         echo "<br>";
         echo "Tampilkan link:<a href='$pathBaru'>$pathBaru</a>";
    }
}
