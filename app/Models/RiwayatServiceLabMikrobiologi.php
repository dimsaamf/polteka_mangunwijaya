<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabMikrobiologi extends Model
{
    use HasFactory;
    protected $table = 'riwayat_service_lab_mikrobiologis';

    protected $fillable = [
        'inventaris_lab_mikrobiologis_id',
        'tanggal_service', 
        'keterangan'
        ];
    
        public $timestamps = true;
    
        public function barangmikrobiologi()
        {
            return $this->belongsTo(InventarisLabMikrobiologi::class,  'inventaris_lab_mikrobiologis_id');
        }
}
