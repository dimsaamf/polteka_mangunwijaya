<?php

namespace App\Http\Controllers\Wakildirektur;

use App\Models\PengajuanBarangLabFarmasi;
use App\Http\Controllers\Controller;
use App\Models\PengajuanBarangWadir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengajuanWadirController extends Controller
{
    public function getpengajuan()
    {
        $pengajuanBarangs = PengajuanBarangLabFarmasi::with('pengajuanWadir')->paginate(10);
        return view('rolewadir.contentwadir.pengajuanbarang', compact('pengajuanBarangs'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditunda,Ditolak',
        ]);

        if (!$request->has('status')) {
            return redirect()->back()->with('error', 'Pilih status untuk memperbarui');
        }

        $pengajuanBarangWadir = PengajuanBarangWadir::firstOrNew(['pengajuan_barang_labfarmasi_id' => $id]);
        $pengajuanBarangWadir->status = $request->status;
        $pengajuanBarangWadir->save();

        return redirect()->route('pengajuanwadir');
        }
        
        public function detailPengajuanKoorLabFarmasi($id)
        {
            $pengajuanBarang = PengajuanBarangLabFarmasi::findOrFail($id);
            return view('rolewadir.contentwadir.detailpengajuan', compact('pengajuanBarang'));
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
}
