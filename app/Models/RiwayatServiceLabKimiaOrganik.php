<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabKimiaOrganik extends Model
{
    use HasFactory;
    protected $table = 'riwayat_service_lab_kimia_organiks';

    protected $fillable = [
        'inventaris_lab_kimia_organiks_id',
        'tanggal_service', 
        'keterangan'
        ];
    
        public $timestamps = true;
    
        public function barangkimiaorganik()
        {
            return $this->belongsTo(InventarisLabKimiaOrganik::class,  'inventaris_lab_kimia_organiks_id');
        }
}
