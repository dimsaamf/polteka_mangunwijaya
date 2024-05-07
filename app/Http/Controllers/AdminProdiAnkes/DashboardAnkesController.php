<?php

namespace App\Http\Controllers\AdminProdiAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisAnkes;
use App\Models\BarangMasukAnkes;
use App\Models\BarangKeluarAnkes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardAnkesController extends Controller
{
    // public function index(Request $request)
    // {
    //      $jumlah_barang = InventarisAnkes::count();
    //      $jumlah_barang_masuk = BarangMasukAnkes::count();
    //      $jumlah_barang_keluar = BarangKeluarAnkes::count();

    //     if ($request->has('sudah_dilayani')) {
    //         foreach ($request->sudah_dilayani as $notificationId) {
    //             $notification = InventarisAnkes::find($notificationId);
    //             $notification->sudah_dilayani = true;
    //             $notification->save();
    //         }
    //     }

    //     $notifications = InventarisAnkes::where(function ($query) {
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

    //     return view('roleadminprodiAnkes.contentadminprodi.dashboard', compact('barangHampirHabis', 'notifications', 'jumlah_barang', 'jumlah_barang_masuk', 'jumlah_barang_keluar'));
    // }

    public function index(Request $request)
    {
        $jumlah_barang = InventarisAnkes::count();
        $jumlah_barang_masuk = BarangMasukAnkes::count();
        $jumlah_barang_keluar = BarangKeluarAnkes::count();
        
        $notifications = InventarisAnkes::where(function ($query) {
            $query->whereDate('tanggal_service', Carbon::today())
                ->orWhere(function ($query) {
                    $query->whereRaw('DATE_ADD(tanggal_service, INTERVAL periode MONTH) >= ?', [Carbon::today()])
                        ->where('tanggal_service', '<', Carbon::today());
                });

            $query->where('reminder', true);
        })->where('sudah_dilayani', false)->paginate(5);

        // $barangHabis = collect();
        // $inventarisModels = ['App\Models\InventarisAnkes'];

        // foreach ($inventarisModels as $model) {
        //     $inventaris = $model::all();
        //     foreach ($inventaris as $barang) {
        //         if ($barang->jumlah < $barang->jumlah_min) {
        //             $barangHabis->push($barang);
        //         }
        //     }
        // }

        $barangHabis = InventarisAnkes::whereColumn('jumlah', '<', DB::raw('jumlah_min'))->paginate(5);
        
        return view('roleadminprodiankes.contentadminprodi.dashboard', compact('barangHabis', 'notifications', 'jumlah_barang', 'jumlah_barang_masuk', 'jumlah_barang_keluar'));
    }


    public function updateNotification(Request $request)
    {
        if ($request->has('sudah_dilayani')) {
            foreach ($request->sudah_dilayani as $notificationId) {
                $notification = InventarisAnkes::find($notificationId);
                if ($notification) {
                    $notification->sudah_dilayani = true;
                    // Perbarui tanggal notifikasi hanya jika sudah dilayani
                    $tanggalService = Carbon::parse($notification->tanggal_service);
                    $periode = $notification->periode;
                    $tanggalServiceTerbaru = $tanggalService->addMonths($periode);
                    $notification->tanggal_service = $tanggalServiceTerbaru;
                    $notification->save();
                }
            }
            return redirect()->back()->with('success', 'Notifikasi berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada notifikasi yang dipilih.');
        }
    }
    
}
