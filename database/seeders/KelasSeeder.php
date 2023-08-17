<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('kelas')->delete();

        $kelas = ["10A", "10B"];
        $faker = Faker::create('id_ID');

        for ($x = 0; $x < count($kelas); $x++)
        {
            DB::collection('kelas')->insert([
                'kode_kelas'        => $kelas[$x],
                'pengajar'          => $faker->name(),
                'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')                    
            ]);                
        }
    }
}
