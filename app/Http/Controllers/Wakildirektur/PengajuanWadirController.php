<?php

namespace App\Http\Controllers\Wakildirektur;

use App\Models\PengajuanBarangLabFarmasi;
use App\Http\Controllers\Controller;
use App\Models\PengajuanBarangWadir;
use Illuminate\Http\Request;

class PengajuanWadirController extends Controller
{
    public function getpengajuan()
    {
        $pengajuanBarangs = PengajuanBarangLabFarmasi::paginate(10);
        return view('rolewadir.contentwadir.pengajuanbarang', compact('pengajuanBarangs'));
    }
 
    public function createStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditunda,Ditolak',
        ]);

        $pengajuanwadir = new PengajuanBarangWadir();
        $pengajuanwadir->status = $request->status;

        $pengajuanBarangLabFarmasi = PengajuanBarangLabFarmasi::first(); // Ganti ini dengan logika sesuai dengan kebutuhan Anda
        $pengajuanwadir->pengajuanBarangLabFarmasi()->associate($pengajuanBarangLabFarmasi);
        $pengajuanwadir->save();

        return redirect()->route('pengajuanwadir');
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
}
