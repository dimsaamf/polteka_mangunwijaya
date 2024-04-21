<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisLabFarmakognosi extends Model
{
    use HasFactory;

    protected $table = 'inventaris_labfarmakognosis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_barang',
        'jumlah',
        'satuan',
        'tanggal_service',
        'periode',
        'harga',
        'keterangan',
        'gambar',
    ];
}
