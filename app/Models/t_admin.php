<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class t_admin extends Authenticatable
{
    use HasFactory;

    protected $table = 't_admin';
    protected $primaryKey = 'f_id';
    protected $guarded = ['f_id'];

    public function getAuthPassword()
    {
        return $this->f_password;
    }

    public function peminjaman() {
        return $this->hasMany(t_peminjaman::class, 'f_idadmin');
    }
}
