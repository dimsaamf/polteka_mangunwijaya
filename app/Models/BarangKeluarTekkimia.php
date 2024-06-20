<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarTekkimia extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_tekkimias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventariskimia()
    {
        return $this->belongsTo(InventarisKimia::class, 'id_barang')
        ->withTrashed();
    }
}
