<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function biayas()
    {
        return $this->belongsToMany(Biaya::class, 'tagihan_biaya');
    }

    public function kelases()
    {
        return $this->belongsToMany(Kelas::class, 'tagihan_kelas');
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_tagihan');
    }
}
