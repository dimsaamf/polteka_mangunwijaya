<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarAnkeskimia extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar_ankeskimias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislabankeskimia()
    {
        return $this->belongsTo(InventarisLabAnkeskimia::class);
    }
}
