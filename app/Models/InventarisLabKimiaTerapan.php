<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class InventarisLabKimiaTerapan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'inventaris_lab_kimia_terapans';
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

    public $timestamps = true;

    public function getTanggalServiceAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }
}
