<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('siswa')->delete();

        $siswa_perkelas = 10;
        $curr_NISN = 1203220001;
        $curr_NIS = 8001;
        $kelas = ["10A", "10B"];

        $faker = Faker::create('id_ID');

        for ($x = 0; $x < count($kelas); $x++)
        {
            for ($y = 0; $y < $siswa_perkelas; $y++)
            {
                DB::collection('siswa')->insert([
                    'NISN'              => $curr_NISN, 
                    'NIS'               => $curr_NIS, 
                    'kode_kelas'        => $kelas[$x],
                    'nama'              => $faker->name(),
                    'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')                    
                ]);                
                $curr_NISN++;
                $curr_NIS++;
            }
        }
    }

}
