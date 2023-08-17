<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Kelas extends Eloquent
{
    protected $connection = 'mongodb';

    // Primary Key: kode kelas (non-autoincrement, string type)
    protected $primaryKey = 'kode_kelas';
    public $incrementing = false;
    protected $keyType = 'string';

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kode_kelas');
    }
}
