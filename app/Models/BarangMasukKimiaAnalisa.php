<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukKimiaAnalisa extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_kimia_analisas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabkimiaanalisa()
    {
        return $this->belongsTo(InventarisLabKimiaAnalisa::class, 'id_barang')
        ->withTrashed();
    }
}
