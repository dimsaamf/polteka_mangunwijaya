<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukFarmasetika extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_farmasetikas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];

    public function inventarislabfarmasetika()
    {
        return $this->belongsTo(InventarislabFarmasetika::class, 'id_barang');
    }
}
