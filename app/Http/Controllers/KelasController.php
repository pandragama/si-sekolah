<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function show($kode_kelas)
    {
        if ($kode_kelas == 'all')
        {
            $kelas = Kelas::all();
        }
        else
        {
            $kelas = Kelas::where('kode_kelas', '=', $kode_kelas)->with('siswa')->first();
        }
        
        return response()->json($kelas, 200);
    }

    public function store(Request $request)
    {
        $kelas = new Kelas;
        
        $kelas->kode_kelas = $request->kode_kelas;
        $kelas->pengajar = $request->pengajar;     
        $kelas->save();
        
        return response()->json(["result" => "data kelas berhasil disimpan."], 201);
    }

    public function destroy($kode_kelas)
    {
        $kelas = Kelas::find($kode_kelas);
        $kelas->delete();
   
        return response()->json(["result" => "data kelas berhasil dihapus"], 200);       
    }

    public function update(Request $request, $kode_kelas)
    {
        $kelas = Kelas::find($kode_kelas);

        if ($request->kode_kelas != NULL)
            $kelas->kode_kelas = $request->kode_kelas;
        if ($request->pengajar != NULL)
            $kelas->pengajar = $request->pengajar;     

        $kelas->save();
 
        return response()->json(["result" => "data kelas berhasil diubah"], 201);       
    }
}
