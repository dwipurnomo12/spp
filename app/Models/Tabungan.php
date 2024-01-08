<?php

namespace App\Models;

use App\Models\User;
use App\Models\Siswa;
use App\Models\TabunganHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tabungan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    public function tabunganHistories()
    {
        return $this->hasMany(TabunganHistory::class);
    }
}
