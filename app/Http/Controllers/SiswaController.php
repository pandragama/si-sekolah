<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function show($NIS)
    {
        if ($NIS == 'all')
        {
            $siswa = Siswa::all();
        }
        else
        {
            $siswa = Siswa::where('NIS', '=', intval($NIS))->with('nilai')->first();
        }
        
        return response()->json($siswa, 200);
    }

    public function store(Request $request)
    {
        $siswa = new Siswa;
        
        $siswa->NISN        = intval($request->NISN);
        $siswa->NIS         = intval($request->NIS);     
        $siswa->kode_kelas  = $request->kode_kelas;     
        $siswa->nama        = $request->nama;   
        
        $siswa->save();

        return response()->json(["result" => "data siswa berhasil disimpan."], 201);
    }

    public function destroy($NIS)
    {
        $siswa = Siswa::where('NIS', '=', intval($NIS))->first();
        $siswa->delete();
   
        return response()->json(["result" => "data siswa berhasil dihapus"], 200);       
    }

    public function update(Request $request, $NIS)
    {
        $siswa = Siswa::where('NIS', '=', intval($NIS))->first();

        if ($request->NISN != NULL)
            $siswa->NISN = intval($request->NISN);
        if ($request->NIS != NULL)
            $siswa->NIS = intval($request->NIS); 
        if ($request->kode_kelas != NULL)
            $siswa->kode_kelas = $request->kode_kelas;     
        if ($request->nama != NULL)
            $siswa->nama = $request->nama;  
  
        $siswa->save();
 
        return response()->json(["result" => "data siswa berhasil diubah"], 201);       
    }
}
