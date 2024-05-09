<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatServiceProdiAnkes extends Model
{
    use HasFactory;

    protected $table = 'riwayat_service_prodi_ankes';

    protected $fillable = ['inventaris_ankes_id', 'tanggal_service', 'keterangan'];

    public $timestamps = true;

    public function barangankes()
    {
        return $this->belongsTo(InventarisAnkes::class,  'inventaris_ankes_id');
    }
}
