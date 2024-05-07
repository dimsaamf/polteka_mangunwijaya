<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabTekfarmasi extends Model
{
    protected $table = 'riwayat_service_lab_tekfarmasis';

    protected $fillable = [
        'inventaris_lab_tekfarmasis_id',
        'tanggal_service', 
        'keterangan'
        ];
    
        public $timestamps = true;
    
        public function barangtekfarmasi()
        {
            return $this->belongsTo(InventarisLabTekfarmasi::class,  'inventaris_lab_tekfarmasis_id');
        }
}
