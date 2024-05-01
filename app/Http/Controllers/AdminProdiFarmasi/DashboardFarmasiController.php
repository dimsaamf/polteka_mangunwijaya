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
    // public function index(Request $request)
    // {
    //      $jumlah_barang = InventarisFarmasi::count();
    //      $jumlah_barang_masuk = BarangMasukFarmasi::count();
    //      $jumlah_barang_keluar = BarangKeluarFarmasi::count();

    //     if ($request->has('sudah_dilayani')) {
    //         foreach ($request->sudah_dilayani as $notificationId) {
    //             $notification = InventarisFarmasi::find($notificationId);
    //             $notification->sudah_dilayani = true;
    //             $notification->save();
    //         }
    //     }

    //     $notifications = InventarisFarmasi::where(function ($query) {
    //         $query->whereDate('tanggal_service', Carbon::today())
    //             ->orWhere(function ($query) {
    //                 $query->whereRaw('DATE_ADD(tanggal_service, INTERVAL periode MONTH) >= ?', [Carbon::today()])
    //                     ->where('tanggal_service', '<', Carbon::today());
    //             });

    //         $query->where('reminder', true);
    //     })->where('sudah_dilayani', false)->get();

    //     foreach ($notifications as $notification) {
    //         if (!$notification->sudah_dilayani) {
    //             $tanggalService = Carbon::parse($notification->tanggal_service);
    //             $periode = $notification->periode;
    //             $tanggalServiceTerbaru = $tanggalService->addMonths($periode);
        
    //             $notification->tanggal_service = $tanggalServiceTerbaru;
    //             $notification->save();
    //         }
    //     }

    //     $barangHampirHabis = $this->stokHampirHabis();

    //     return view('roleadminprodifarmasi.contentadminprodi.dashboard', compact('barangHampirHabis', 'notifications', 'jumlah_barang', 'jumlah_barang_masuk', 'jumlah_barang_keluar'));
    // }

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
                if (!$notification->sudah_dilayani) {
                    $tanggalService = Carbon::parse($notification->tanggal_service);
                    $periode = $notification->periode;
                    $tanggalServiceTerbaru = $tanggalService->addMonths($periode);
            
                    $notification->tanggal_service = $tanggalServiceTerbaru;
                    $notification->save();
                }
            }

    $barangHabis = collect();
        $inventarisModels = [
            'App\Models\InventarisFarmasi',
        ];

        foreach ($inventarisModels as $model) {
            $inventaris = $model::all();
            foreach ($inventaris as $barang) {
                if ($barang->jumlah < $barang->jumlah_min) {
                    $barangHabis->push($barang);
                }
            }
        }
        
    return view('roleadminprodifarmasi.contentadminprodi.dashboard', compact('barangHabis', 'notifications', 'jumlah_barang', 'jumlah_barang_masuk', 'jumlah_barang_keluar'));
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
