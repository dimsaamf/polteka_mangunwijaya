<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\PengajuanBarangLabFarmasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PengajuanSuperadminController extends Controller
{
    public function getpengajuankoorlabfarmasi()
    {
        $pengajuanBarangs = PengajuanBarangLabFarmasi::paginate(10);
        return view('rolesuperadmin.contentsuperadmin.pengajuanbarang', compact('pengajuanBarangs'));

    }
    public function previewSurat($id)
    {
        $pengajuanBarang = PengajuanBarangLabFarmasi::findOrFail($id);

        $fileExtension = pathinfo($pengajuanBarang->file, PATHINFO_EXTENSION);

        $contentType = '';
        switch ($fileExtension) {
            case 'pdf':
                $contentType = 'application/pdf';
                break;
            case 'png':
                $contentType = 'image/png';
                break;
            case 'jpg':
            case 'jpeg':
                $contentType = 'image/jpeg';
                break;
            default:
                return response()->json(['error' => 'Tipe file tidak didukung'], 400);
        }

        $fileContent = Storage::get('public/' . $pengajuanBarang->file);

        $headers = [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; filename="' . $pengajuanBarang->file_name . '"',
        ];

        return response($fileContent, 200, $headers);
    }

    public function detailPengajuanKoorLabFarmasi($id)
        {
            $pengajuanBarang = PengajuanBarangLabFarmasi::findOrFail($id);
            return view('rolesuperadmin.contentsuperadmin.detailpengajuan', compact('pengajuanBarang'));
        }
}
