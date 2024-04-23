<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBarangLabFarmasi extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_barang_labfarmasis';
    protected $fillable = [
        'no_surat', 
        'tanggal', 
        'detail_barang', 
        'total_harga', 
        'file', 
        'status'
    ];
}
