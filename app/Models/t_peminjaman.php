<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_peminjaman extends Model
{
    use HasFactory;

    protected $table = 't_peminjaman';
    protected $primaryKey = 'f_id';
    protected $guarded = ['f_id'];
    public $timestamps = false;


    public function detailPeminjaman() {
        return $this->hasOne(t_detailpeminjaman::class, 'f_idpeminjaman', 'f_id');
    }

    public function anggota() {
        return $this->belongsTo(t_anggota::class, 'f_idanggota');
    }

    public function admin() {
        return $this->belongsTo(t_admin::class, 'f_idadmin');
    }
}
