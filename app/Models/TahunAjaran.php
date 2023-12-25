<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tahunAjarans()
    {
        return $this->hasMany(Kelas::class);
    }
}
