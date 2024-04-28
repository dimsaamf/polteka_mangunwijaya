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

         // Mendapatkan semua data barang
         $dataBarang = InventarisFarmasi::all();
        
         // Inisialisasi array untuk menyimpan barang yang stoknya hampir habis
         $barangHampirHabis = [];
 
         // Loop melalui setiap data barang
         foreach ($dataBarang as $barang) {
            // Menghitung batas minimum stok hampir habis (20% dari stok saat ini)
            $batasMinimum = 0.2 * $barang->jumlah;
            
            // Menghitung stok saat ini (stok awal dikurangi jumlah barang keluar)
            $stokSaatIni = $barang->jumlah - $barang->jumlah_barang_keluar;
        
            // Jika stok saat ini kurang dari batas minimum, tambahkan barang ke array
            if ($stokSaatIni < $batasMinimum) {
                $barangHampirHabis[] = $barang;
            }
        }

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
}
