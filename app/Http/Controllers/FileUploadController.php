<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload(){
        return view('file-upload');
    }
    
    public function prosesFileUpload(Request $request){
        // dump($request->berkas);
        // return "Pemrosesan file upload di sini";

        $request->validate([
            'berkas'=>'required|file|image|max:5000',
        ]);
        // $path = $request->berkas->store('uploads');
        $extFile = $request->berkas->getClientOriginalExtension();
        $namaFile = 'web-'.time().".". $extFile;

        $path = $request->berkas->move('gambar',$namaFile);
        $path = str_replace("\\","//",$path);
        echo "Variabel path berisi: $path <br>";

        $pathBaru = asset('gambar/'. $namaFile);
        echo "Proses upload berhasil, file berada di: $path";
        echo "<br>";
        echo "Tampilan link: <a href='$pathBaru'>$pathBaru</a>";
        // echo $request->berkas->getClientOriginalName()." lolos validasi";

        // if($request->hasFile('berkas')){
        //     echo "path(): ". $request->berkas->path();
        //     echo "<br>";
        //     echo "extension(): ". $request->berkas->extension();
        //     echo "<br>";
        //     echo "getClientOriginalExtension(): ". $request->berkas->getClientOriginalExtension();
        //     echo "<br>";
        //     echo "getMimeType(): ". $request->berkas->getMimeType();
        //     echo "<br>";
        //     echo "getClientOriginalName(): ". $request->berkas->getClientOriginalName();
        //     echo "<br>";
        //     echo "getSize(): ". $request->berkas->getSize();
        // } else {
        //     echo "Tidak ada berkas yang diupload";
        // }
    }

    public function fileUploadTugas(){
        return view('file-upload-tugas');
    }

    public function prosesFileUploadTugas(Request $request){
        $request->validate([
            'nama'=>'required|string|max:255',
            'berkas'=>'required|file|image|max:5000',
        ]);
        $nama = $request->nama;
        $extFile = $request->berkas->getClientOriginalExtension();
        $namaFile = $nama.".".$extFile;

        $path = $request->berkas->move('gambar', $namaFile);
        $path = str_replace("\\","//",$path);
        
        $pathBaru = asset('gambar/'. $namaFile);
        echo "Gambar berhasil di upload ke <a href='$pathBaru'>$namaFile</a><br>";
        echo "<img src='$pathBaru' alt='$namaFile' width='150px'>";
    }
}
