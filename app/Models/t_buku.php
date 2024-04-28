<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_buku extends Model
{
    use HasFactory;

    protected $table = 't_buku';
    protected $primaryKey = 'f_id';
    protected $guarded = ['f_id'];
    public $timestamps = false;

    public function kategori() {
        return $this->belongsTo(t_kategori::class, 'f_idkategori');
    }

    public function detailBuku() {
        return $this->hasOne(t_detailbuku::class, 'f_idbuku', 'f_id');
    }
}
