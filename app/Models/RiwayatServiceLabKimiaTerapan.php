<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabKimiaTerapan extends Model
{
    use HasFactory;
    protected $table = 'riwayat_service_lab_kimia_terapans';

    protected $fillable = [
        'inventaris_lab_kimia_terapans_id',
        'tanggal_service', 
        'keterangan'
        ];
    
        public $timestamps = true;
    
        public function barangkimiaterapan()
        {
            return $this->belongsTo(InventarisLabKimiaTerapan::class,  'inventaris_lab_kimia_terapans_id');
        }
}
