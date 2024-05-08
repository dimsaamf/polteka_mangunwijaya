<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabMikro extends Model
{
    use HasFactory;

    protected $table = 'riwayat_service_lab_mikro';

    protected $fillable = [
    'inventaris_lab_mikros_id', 
    'tanggal_service', 
    'keterangan'
    ];

    public $timestamps = true;

    public function barangmikro()
    {
        return $this->belongsTo(InventarisLabMikro::class,  'inventaris_lab_mikros_id');
    }
}
