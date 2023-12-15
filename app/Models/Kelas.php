<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class);
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }
}
