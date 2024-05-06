<?php

namespace App\Http\Controllers\Wakildirektur;
use App\Models\PengajuanBarangLabFarmasi;
use App\Http\Controllers\Controller;
use App\Models\PengajuanBarangWadir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PengajuanWadirController extends Controller
{
    public function getpengajuan()
    {
        $pengajuanBarangs = PengajuanBarangLabFarmasi::with('pengajuanWadir')->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'wakildirektur'){
                return view('rolewadir.contentwadir.pengajuanbarang', compact('pengajuanBarangs'));
            } elseif (Auth::user()->role == 'superadmin'){
                return view('rolesuperadmin.contentsuperadmin.pengajuanbarang', compact('pengajuanBarangs'));
            }
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditunda,Ditolak,Disetujui Sebagian,Menunggu Konfirmasi',
            'keterangan' => 'nullable|string',
        ]);

        if (!$request->has('status')) {
            return redirect()->back()->with('error', 'Pilih status untuk memperbarui');
        }

        $pengajuanBarangWadir = PengajuanBarangWadir::firstOrNew(['pengajuan_barang_labfarmasi_id' => $id]);
        $pengajuanBarangWadir->status = $request->status;
        $pengajuanBarangWadir->keterangan = $request->keterangan;
        $pengajuanBarangWadir->save();

        alert()->success('Berhasil', 'Status Pengajuan Barang Berhasil Diubah.');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'wakildirektur'){
                return redirect()->route('pengajuanwadir');
            } elseif (Auth::user()->role == 'superadmin'){
                return redirect()->route('pengajuanbarangsuperadmin');
            }
        }
        }
        
        public function detailPengajuanKoorLabFarmasi($id)
        {
            $pengajuanBarang = PengajuanBarangLabFarmasi::findOrFail($id);
        
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'wakildirektur'){
                    return view('rolewadir.contentwadir.detailpengajuan', compact('pengajuanBarang'));
                } elseif (Auth::user()->role == 'superadmin'){
                    return view('rolesuperadmin.contentsuperadmin.detailpengajuan', compact('pengajuanBarang'));
                }
            }
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
