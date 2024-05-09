<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceProdiKimia extends Model
{
    use HasFactory;

    protected $table = 'riwayat_service_prodi_kimia';

    protected $fillable = ['inventaris_kimias_id', 'tanggal_service', 'keterangan'];

    public $timestamps = true;

    public function barangkimia()
    {
        return $this->belongsTo(InventarisKimia::class,  'inventaris_kimias_id');
    }
}
