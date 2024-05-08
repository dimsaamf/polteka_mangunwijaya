<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBarangLabAnkes extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_barang_lab_ankes';
    protected $primaryKey = 'kode_pengajuan'; // Set primary key to 'kode_pengajuan'
    public $incrementing = false; // Indicate that primary key is not auto-incrementing
    protected $fillable = [
        'kode_pengajuan', // Change 'id' to 'kode_pengajuan'
        'no_surat', 
        'tanggal',  
        'nama_barang',
        'harga',
        'total_harga', 
        'file', 
        'status',
        'keterangan',
        'prodi'
    ];

    public function pengajuanWadir()
    {
        // Define the relationship using 'kode_pengajuan' as foreign key
        return $this->hasOne(PengajuanBarangWadir::class, 'pengajuan_barang_lab_ankes_kode_pengajuan', 'kode_pengajuan');
    }
}
