<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukKimia extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_kimias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabkimia()
    {
        return $this->belongsTo(InventarisLabKimia::class, 'id_barang')
        ->withTrashed();
    }
}
