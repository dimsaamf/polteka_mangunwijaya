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
        'nama_barang',
        'harga',
        'total_harga', 
        'file', 
        'status',
        'keterangan'
    ];

    public function pengajuanWadir()
    {
        return $this->hasOne(PengajuanBarangWadir::class, 'pengajuan_barang_labfarmasi_id');
    }
}
