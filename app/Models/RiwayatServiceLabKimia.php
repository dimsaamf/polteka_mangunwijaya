<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabKimia extends Model
{
    protected $table = 'riwayat_service_lab_kimia';

    protected $fillable = [
        'inventaris_lab_kimias_id',
        'tanggal_service', 
        'keterangan'
        ];
    
        public $timestamps = true;
    
        public function barangkimia()
        {
            return $this->belongsTo(InventarisLabKimia::class,  'inventaris_lab_kimias_id');
        }
}
