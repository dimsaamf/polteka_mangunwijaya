<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukAnkeskimia extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk_ankeskimias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabankeskimia()
    {
        return $this->belongsTo(InventarisLabAnkeskimia::class, 'id_barang')
        ->withTrashed();
    }
}
