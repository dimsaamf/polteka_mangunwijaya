<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukTekkimia extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk_tekkimias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masuk',
        'tanggal_masuk',
        'id_barang',
        'keterangan_masuk',
    ];
    
    public function inventariskimia()
    {
        return $this->belongsTo(InventarisKimia::class, 'id_barang')
        ->withTrashed();
    } 
}
