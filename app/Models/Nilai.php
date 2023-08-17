<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Nilai extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'nilai';

    protected $casts = [    // *
        'latihan' => 'array',
        'UH' => 'array'
    ];    

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NIS');
    }
}
