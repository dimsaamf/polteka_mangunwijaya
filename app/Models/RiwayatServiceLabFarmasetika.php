<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabFarmasetika extends Model
{
    protected $table = 'riwayat_service_lab_farmasetika';

    protected $fillable = [
        'inventaris_lab_farmasetikas_id',
        'tanggal_service', 
        'keterangan'
        ];
    
        public $timestamps = true;
    
        public function barangfarmasetika()
        {
            return $this->belongsTo(InventarisLabFarmasetika::class,  'inventaris_lab_farmasetikas_id');
        }
}
