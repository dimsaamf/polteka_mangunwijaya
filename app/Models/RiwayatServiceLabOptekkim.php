<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabOptekkim extends Model
{
    use HasFactory;
    protected $table = 'riwayat_service_lab_optekkims';

    protected $fillable = [
        'inventaris_lab_optekkims_id',
        'tanggal_service', 
        'keterangan'
        ];
    
        public $timestamps = true;
    
        public function barangoptekkim()
        {
            return $this->belongsTo(InventarisLabOptekkim::class,  'inventaris_lab_optekkims_id');
        }
}
