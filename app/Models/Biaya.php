<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tagihans()
    {
        return $this->belongsToMany(Tagihan::class, 'tagihan_biaya');
    }
}
