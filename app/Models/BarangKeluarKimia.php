<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarKimia extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar_kimias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_keluar',
        'tanggal_keluar',
        'id_barang',
        'keterangan_keluar',
    ];

    public function inventarislabkimia()
    {
        return $this->belongsTo(InventarisLabKimia::class);
    }
}
