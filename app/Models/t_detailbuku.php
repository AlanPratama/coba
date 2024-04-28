<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_detailbuku extends Model
{
    use HasFactory;

    protected $table = 't_detailbuku';
    protected $primaryKey = 'f_id';
    protected $guarded = ['f_id'];
    public $timestamps = false;

    public function buku() {
        return $this->belongsTo(t_buku::class, 'f_idbuku', 'f_id');
    }

    public function detailPeminjaman() {
        return $this->hasMany(t_detailpeminjaman::class, 'f_iddetailbuku', 'f_id');
    }
}
