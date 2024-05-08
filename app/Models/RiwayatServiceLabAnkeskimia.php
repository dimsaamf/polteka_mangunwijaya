<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceLabAnkeskimia extends Model
{
    use HasFactory;

    protected $table = 'riwayat_service_lab_ankeskimia';

    protected $fillable = [
    'inventaris_lab_ankeskimias_id', 
    'tanggal_service', 
    'keterangan'
    ];

    public $timestamps = true;

    public function barangankeskimia()
    {
        return $this->belongsTo(InventarisLabAnkeskimia::class,  'inventaris_lab_ankeskimias_id');
    }
}
