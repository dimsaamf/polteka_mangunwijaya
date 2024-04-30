<?php

namespace App\Http\Controllers\AdminProdiFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisFarmasi;
use App\Models\BarangMasukFarmasi;
use App\Models\BarangKeluarFarmasi;
use Carbon\Carbon;

class DashboardFarmasiController extends Controller
{
    public function index(Request $request)
    {
         $jumlah_barang = InventarisFarmasi::count();
         $jumlah_barang_masuk = BarangMasukFarmasi::count();
         $jumlah_barang_keluar = BarangKeluarFarmasi::count();

        if ($request->has('sudah_dilayani')) {
            foreach ($request->sudah_dilayani as $notificationId) {
                $notification = InventarisFarmasi::find($notificationId);
                $notification->sudah_dilayani = true;
                $notification->save();
            }
        }

        $notifications = InventarisFarmasi::where(function ($query) {
            $query->whereDate('tanggal_service', Carbon::today())
                ->orWhere(function ($query) {
                    $query->whereRaw('DATE_ADD(tanggal_service, INTERVAL periode MONTH) >= ?', [Carbon::today()])
                        ->where('tanggal_service', '<', Carbon::today());
                });

            $query->where('reminder', true);
        })->where('sudah_dilayani', false)->get();

        foreach ($notifications as $notification) {
            $tanggalService = Carbon::parse($notification->tanggal_service);

            if ($tanggalService->isValid()) {
                $periode = $notification->periode;
                $tanggalServiceTerbaru = $tanggalService->addMonths($periode);

                $notification->tanggal_service = $tanggalServiceTerbaru;
                $notification->save();
            } else {
                Log::error('Tanggal layanan tidak valid untuk notifikasi dengan ID: ' . $notification->id);
            }
        }
        $barangHampirHabis = $this->stokHampirHabis();

        return view('roleadminprodifarmasi.contentadminprodi.dashboard', compact('barangHampirHabis', 'notifications', 'jumlah_barang', 'jumlah_barang_masuk', 'jumlah_barang_keluar'));
    }

    public function updateNotification(Request $request)
    {
        if ($request->has('sudah_dilayani')) {
            foreach ($request->sudah_dilayani as $notificationId) {
                $notification = InventarisFarmasi::find($notificationId);

                if ($notification) {
                    $notification->sudah_dilayani = true;
                    $notification->save();
                }
            }
            return redirect()->back()->with('success', 'Notifikasi berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada notifikasi yang dipilih.');
        }
    }

    public static function stokHampirHabis()
{
    // Mengambil daftar barang yang stoknya kurang dari 20% dari jumlah awal atau jumlah terupdate
    $barangHampirHabis = InventarisFarmasi::select('id', 'nama_barang', 'jumlah', 'jumlah_awal')
        ->whereRaw('jumlah < jumlah_awal * 0.2') // Mengecek apakah stok kurang dari 20% dari jumlah awal
        ->orWhereRaw('jumlah < jumlah_awal + (SELECT COALESCE(SUM(jumlah_masuk), 0) FROM barang_masuk_farmasis WHERE id_barang = inventaris_farmasis.id) * 0.2') // Mengecek apakah stok kurang dari 20% dari jumlah terupdate
        ->get();

    return $barangHampirHabis;
}
}
