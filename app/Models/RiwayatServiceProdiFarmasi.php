<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceProdiFarmasi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_service_prodi_farmasi';

    protected $fillable = ['inventaris_farmasis_id', 'tanggal_service', 'keterangan'];

    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo(InventarisFarmasi::class,  'inventaris_farmasis_id');
    }
}
