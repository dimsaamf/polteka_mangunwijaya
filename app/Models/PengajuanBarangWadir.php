<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBarangWadir extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_barang_labfarmasis_kode_pengajuan',
        'pengajuan_barang_lab_ankes_kode_pengajuan',
        'pengajuan_barang_lab_kimias_kode_pengajuan',
        'status',
        'keterangan',
    ];

    public $timestamps = true;

    public function pengajuanBarangLabFarmasi()
    {
        return $this->belongsTo(PengajuanBarangLabFarmasi::class);
    }

    public function pengajuanBarangLabAnkes()
    {
        return $this->belongsTo(PengajuanBarangLabAnkes::class);
    }

    public function pengajuanBarangLabKimia()
    {
        return $this->belongsTo(PengajuanBarangLabKimia::class);
    }
}