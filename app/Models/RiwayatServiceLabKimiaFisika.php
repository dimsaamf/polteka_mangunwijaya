<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabKimiaFisika extends Model
{
    use HasFactory;
    protected $table = 'riwayat_service_lab_kimia_fisikas';

    protected $fillable = [
        'inventaris_lab_kimia_fisikas_id',
        'tanggal_service', 
        'keterangan'
        ];
    
        public $timestamps = true;
    
        public function barangkimiafisika()
        {
            return $this->belongsTo(InventarisLabKimiaFisika::class,  'inventaris_lab_kimia_fisikas_id');
        }
}
