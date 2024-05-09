<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisLabKimiaOrganik extends Model
{
    use HasFactory;

    protected $table = 'inventaris_lab_kimia_organiks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'jumlah',
        'jumlah_min',
        'satuan',
        'tanggal_service',
        'periode',
        'harga',
        'keterangan',
        'gambar',
        'reminder',
        'sudah_dilayani',
    ];

    public function getTanggalServiceAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }
}
