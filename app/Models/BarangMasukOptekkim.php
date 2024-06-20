<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukOptekkim extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_optekkims';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislaboptekkim()
    {
        return $this->belongsTo(InventarisLabOptekkim::class, 'id_barang')
        ->withTrashed();
    }
}
