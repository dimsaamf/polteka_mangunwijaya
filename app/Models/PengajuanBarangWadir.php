<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBarangWadir extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_barang_labfarmasi_id',
        'status',
        'keterangan',
    ];

    public $timestamps = true;

    public function pengajuanBarangLabFarmasi()
    {
        return $this->belongsTo(PengajuanBarangLabFarmasi::class);
    }
}