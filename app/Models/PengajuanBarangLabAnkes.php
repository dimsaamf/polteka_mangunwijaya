<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBarangLabAnkes extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_barang_lab_ankes';
    protected $fillable = [
        'no_surat', 
        'tanggal', 
        'detail_barang', 
        'total_harga', 
        'file', 
        'status'
    ];

    // public function pengajuanWadir()
    // {
    //     return $this->hasOne(PengajuanBarangWadir::class, 'pengajuan_barang_labankes_id');
    // }
}
