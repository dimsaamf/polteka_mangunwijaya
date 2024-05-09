<?php

namespace App\Http\Controllers\Wakildirektur;
use App\Models\PengajuanBarangLabFarmasi;
use App\Models\PengajuanBarangLabAnkes;
use App\Models\PengajuanBarangLabKimia;
use App\Http\Controllers\Controller;
use App\Models\PengajuanBarangWadir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class PengajuanWadirController extends Controller
{
    public function getpengajuan()
    {
        $pengajuanBarangsFarmasi = PengajuanBarangLabFarmasi::with('pengajuanWadir')->get();
        $pengajuanBarangsAnkes = PengajuanBarangLabAnkes::with('pengajuanWadir')->get();
        $pengajuanBarangsKimia = PengajuanBarangLabKimia::with('pengajuanWadir')->get();
    
        // $pengajuanBarangs = $pengajuanBarangsFarmasi->merge($pengajuanBarangsAnkes);
        // $pengajuanBarangs = $pengajuanBarangs->merge($pengajuanBarangsFarmasi)
        //                                     ->merge($pengajuanBarangsAnkes)
        //                                     ->merge($pengajuanBarangsKimia);

        $pengajuanBarangs = $pengajuanBarangsFarmasi->merge($pengajuanBarangsAnkes)
                                                ->merge($pengajuanBarangsKimia);

        $sortedPengajuanBarangs = $pengajuanBarangs->sortByDesc('created_at');
    
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentPageItems = $sortedPengajuanBarangs->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedPengajuanBarangs = new LengthAwarePaginator($currentPageItems, count($sortedPengajuanBarangs), $perPage);
        $paginatedPengajuanBarangs->setPath(request()->url());

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'wakildirektur'){
                return view('rolewadir.contentwadir.pengajuanbarang', compact('paginatedPengajuanBarangs'));
            } elseif (Auth::user()->role == 'superadmin'){
                return view('rolesuperadmin.contentsuperadmin.pengajuanbarang', compact('paginatedPengajuanBarangs'));
            }
        }
    }

    public function updateStatus(Request $request, $kode_pengajuan)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditunda,Ditolak,Disetujui Sebagian,Menunggu Konfirmasi',
            'keterangan' => 'nullable|string',
        ]);
    
        if (!$request->has('status')) {
            return redirect()->back()->with('error', 'Pilih status untuk memperbarui');
        }
    
        // Cek apakah kode pengajuan terkait dengan pengajuan dari lab farmasi atau ankes
        $pengajuanFarmasi = PengajuanBarangLabFarmasi::where('kode_pengajuan', $kode_pengajuan)->first();
        $pengajuanAnkes = PengajuanBarangLabAnkes::where('kode_pengajuan', $kode_pengajuan)->first();
        $pengajuanKimia = PengajuanBarangLabKimia::where('kode_pengajuan', $kode_pengajuan)->first();
    
        if ($pengajuanFarmasi) {
            $pengajuanBarangWadir = PengajuanBarangWadir::firstOrNew(['pengajuan_barang_labfarmasis_kode_pengajuan' => $kode_pengajuan]);
        } elseif ($pengajuanAnkes) {
            $pengajuanBarangWadir = PengajuanBarangWadir::firstOrNew(['pengajuan_barang_lab_ankes_kode_pengajuan' => $kode_pengajuan]);
        } elseif ($pengajuanKimia) {
            $pengajuanBarangWadir = PengajuanBarangWadir::firstOrNew(['pengajuan_barang_lab_kimias_kode_pengajuan' => $kode_pengajuan]);
        } else {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan');
        }
    
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
        
    public function detailPengajuanKoorLabFarmasi($kode_pengajuan)
    {
        $pengajuanBarangFarmasi = PengajuanBarangLabFarmasi::where('kode_pengajuan', $kode_pengajuan)->first();
        $pengajuanBarangAnkes = PengajuanBarangLabAnkes::where('kode_pengajuan', $kode_pengajuan)->first();
        $pengajuanBarangKimia = PengajuanBarangLabKimia::where('kode_pengajuan', $kode_pengajuan)->first();
        
        // Pastikan kode_pengajuan ada di salah satu dari kedua jenis pengajuan
        if ($pengajuanBarangFarmasi) {
            $pengajuanBarang = $pengajuanBarangFarmasi;
        } elseif ($pengajuanBarangAnkes) {
            $pengajuanBarang = $pengajuanBarangAnkes;
        } elseif ($pengajuanBarangKimia) {
            $pengajuanBarang = $pengajuanBarangKimia;
        } else {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan');
        }

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'wakildirektur'){
                return view('rolewadir.contentwadir.detailpengajuan', compact('pengajuanBarang'));
            } elseif (Auth::user()->role == 'superadmin'){
                return view('rolesuperadmin.contentsuperadmin.detailpengajuan', compact('pengajuanBarang'));
            }
        }
    }

    public function previewSurat($kode_pengajuan)
    {
        $pengajuanBarangFarmasi = PengajuanBarangLabFarmasi::where('kode_pengajuan', $kode_pengajuan)->first();
        $pengajuanBarangAnkes = PengajuanBarangLabAnkes::where('kode_pengajuan', $kode_pengajuan)->first();
        $pengajuanBarangKimia = PengajuanBarangLabKimia::where('kode_pengajuan', $kode_pengajuan)->first();
        
        // Pastikan kode_pengajuan ada di salah satu dari kedua jenis pengajuan
        if ($pengajuanBarangFarmasi) {
            $pengajuanBarang = $pengajuanBarangFarmasi;
        } elseif ($pengajuanBarangAnkes) {
            $pengajuanBarang = $pengajuanBarangAnkes;
        } elseif ($pengajuanBarangKimia) {
            $pengajuanBarang = $pengajuanBarangKimia;
        } else {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan');
        }
    
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
