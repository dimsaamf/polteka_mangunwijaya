<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabKimiaAnalisa extends Model
{
    use HasFactory;
    protected $table = 'riwayat_service_lab_kimia_analisas';

    protected $fillable = [
        'inventaris_lab_kimia_analisas_id',
        'tanggal_service', 
        'keterangan'
        ];
    
        public $timestamps = true;
    
        public function barangkimiaanalisa()
        {
            return $this->belongsTo(InventarisLabKimiaAnalisa::class,  'inventaris_lab_kimia_analisas_id');
        }
}
