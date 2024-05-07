<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabFarmakognosi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_service_lab_farmakognosi';

    protected $fillable = [
    'inventaris_labfarmakognosis_id', 
    'tanggal_service', 
    'keterangan'
    ];

    public $timestamps = true;

    public function barangfarmakognosi()
    {
        return $this->belongsTo(InventarisLabFarmakognosi::class,  'inventaris_labfarmakognosis_id');
    }
}