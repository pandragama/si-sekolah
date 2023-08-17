<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NilaiController;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('nilai')->delete();

        $total_siswa = 20;
        $mapel = ['Matematika', 'Biologi', 'Fisika', 'Bahasa Indonesia'];
        $curr_NIS = 8001;

        for ($x = 0; $x < $total_siswa; $x++)
        {
            for ($y = 0; $y < count($mapel); $y++)
            {
                
                $nilai = (object) [
                    "latihan" => [rand(50, 100), rand(50, 100), rand(50, 100), rand(50, 100)],
                    "UH" => [rand(50, 100), rand(50, 100)],
                    "UTS" => rand(50, 100),
                    "UAS" => rand(50, 100)
                ];

                $UH_str = sprintf("[%s]", implode(", ", $nilai->latihan));
                $latihan_str = sprintf("[%s]", implode(", ", $nilai->UH));

                $final = NilaiController::finalScore($nilai);
                
                DB::collection('nilai')->insert([
                    'NIS'               => $curr_NIS, 
                    'mata_pelajaran'    => $mapel[$y],
                    'latihan'           => $UH_str,
                    'UH'                => $latihan_str,
                    'UTS'               => $nilai->UTS,
                    'UAS'               => $nilai->UAS,
                    'nilai_akhir'       => $final,
                    'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
            $curr_NIS++;
        }
    }

}
