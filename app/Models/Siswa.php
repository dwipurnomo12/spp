<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Tagihan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Siswa extends Model
{
    use HasFactory;
    use Notifiable;

    protected $guard = 'siswa';
    protected $guarded = ['id'];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
