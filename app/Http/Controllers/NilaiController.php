<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;

use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function show($param)
    {
        if ($param == 'all')
        {
            $nilai = Nilai::get();
        }
        else if (strlen($param) <= 4)
        {
            $nilai = Nilai::where('NIS', '=', intval($param))->get();
        }
        else    // _id
        {
            $nilai = Nilai::where('_id', '=', $param)->with('siswa')->get();
        }
        
        return response()->json($nilai, 200);
    }

    public function store(Request $request)
    {
        $nilai = new Nilai;
        
        $nilai->NIS             = intval($request->NIS);     
        $nilai->mata_pelajaran  = $request->mata_pelajaran;

        if ($request->latihan != NULL)
            $nilai->latihan     = $request->latihan;   

        if ($request->UH != NULL)
            $nilai->UH          = $request->UH;   

        if ($request->UTS != NULL)
            $nilai->UTS         = $request->UTS;   

        if ($request->UAS != NULL)
            $nilai->UAS         = $request->UAS;

        $nilai->nilai_akhir = $this->finalScore($nilai);
        
        $nilai->save();

        return response()->json(["result" => "data nilai berhasil disimpan."], 201);
    }

    public function destroy($obj_id)
    {
        $nilai = Nilai::find($obj_id);
        $nilai->delete();
   
        return response()->json(["result" => "data nilai berhasil dihapus"], 200);       
    }

    public function update(Request $request, $obj_id)
    {
        // return $request->mata_pelajaran;
        $nilai = Nilai::find($obj_id);
        // return $nilai->latihan;

        if ($request->NIS != NULL) 
            $nilai->NIS         = intval($request->NIS);     

        if ($request->mata_pelajaran != NULL) 
            $nilai->mata_pelajaran  = $request->mata_pelajaran;

        if ($request->latihan != NULL)     
            $nilai->latihan     = $request->latihan;   

        if ($request->UH != NULL)
            $nilai->UH          = $request->UH;   

        if ($request->UTS != NULL)
            $nilai->UTS         = $request->UTS;   
        
        if ($request->UAS != NULL)
            $nilai->UAS         = $request->UAS;

        $nilai->nilai_akhir = $this->finalScore($nilai);
  
        $nilai->save();
 
        return response()->json(["result" => "data nilai berhasil diubah"], 201);       
    }

    public static function finalScore($nilai)
    {
        $final = 0;
        if (count($nilai->latihan) >= 1)    // 15% persentase nilai akhir
        {
            $len = count($nilai->latihan);
            $total = 0;
            for ($x = 0; $x < $len; $x++)
            {
                $total += $nilai->latihan[$x];
            }
            $rerata = $total / 4;           // min & max latihan 4x

            $final += (($rerata / 100) * 15);
        }

        if (count($nilai->UH) >= 1)         // 20% persentase nilai akhir
        {
            $len = count($nilai->UH);
            $total = 0;
            for ($x = 0; $x < $len; $x++)
            {
                $total += $nilai->UH[$x];
            }
            $rerata = $total / 2;           // min & max UH 2x

            $final += (($rerata / 100) * 20);
        }

        if ($nilai->UTS != NULL)            // 25% persentase nilai akhir
        {
            $final += (($nilai->UTS / 100) * 25);
        }
        
        if ($nilai->UAS != NULL)            // 40% persentase nilai akhir
        {
            $final += (($nilai->UAS / 100) * 40);
        }

        return round($final, 2);            // 2 angka belakang koma
    }
}
