<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\TabunganHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tabungan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tabunganHistories()
    {
        return $this->hasMany(TabunganHistory::class);
    }
}
