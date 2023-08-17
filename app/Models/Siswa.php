<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Siswa extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'siswa';

    protected $primaryKey = 'NIS';

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'NIS');
    }
}
