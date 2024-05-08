<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabSitohisto extends Model
{
    use HasFactory;

    protected $table = 'riwayat_service_lab_sitohisto';

    protected $fillable = [
    'inventaris_lab_sitohistos_id', 
    'tanggal_service', 
    'keterangan'
    ];

    public $timestamps = true;

    public function barangsitohisto()
    {
        return $this->belongsTo(InventarisLabSitohisto::class,  'inventaris_lab_sitohistos_id');
    }
}
