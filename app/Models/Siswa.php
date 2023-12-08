<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


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
