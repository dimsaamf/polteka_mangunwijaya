<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabMedis extends Model
{
    use HasFactory;

    protected $table = 'riwayat_service_lab_medis';

    protected $fillable = [
    'inventaris_lab_medis_id', 
    'tanggal_service', 
    'keterangan'
    ];

    public $timestamps = true;

    public function barangmedis()
    {
        return $this->belongsTo(InventarisLabMedis::class,  'inventaris_lab_medis_id');
    }
}
