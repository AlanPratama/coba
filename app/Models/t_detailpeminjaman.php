<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_detailpeminjaman extends Model
{
    use HasFactory;

    protected $table = 't_detailpeminjaman';
    protected $primaryKey = 'f_id';
    protected $guarded = ['f_id'];
    public $timestamps = false;

    public function detailBuku() {
        return $this->belongsTo(t_detailbuku::class, 'f_iddetailbuku', 'f_id');
    }

    public function peminjaman() {
        return $this->belongsTo(t_peminjaman::class, 'f_idpeminjaman', 'f_id');
    }
}
