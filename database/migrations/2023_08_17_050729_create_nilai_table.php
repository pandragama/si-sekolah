<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->foreignId('NIS')->constrained('siswa')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('mata_pelajaran');
            $table->json('latihan');
            $table->json('UH');
            $table->integer('UTS');
            $table->integer('UAS');
            $table->integer('nilai_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai');
    }
};
