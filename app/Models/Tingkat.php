<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kelases()
    {
        return $this->hasMany(Kelas::class);
    }
}
