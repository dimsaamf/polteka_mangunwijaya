<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use App\Models\InventarisLabAnkeskimia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardKoorAdminLabAnkesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('sudah_dilayani')) {
            foreach ($request->sudah_dilayani as $notificationId) {
                $notification = InventarisLabAnkeskimia::find($notificationId);
                $notification->sudah_dilayani = true;
                $notification->save();
            }
        }

        $notifications = InventarisLabAnkeskimia::where(function ($query) {
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
        // $data['barangHabis'] = InventarisLabAnkeskimia::where('jumlah', '<', 20)->get();
        // return view('rolekoorlabankes.contentkoorlab.dashboard', compact('notifications', 'data'));
        // $batasJumlah = 0.2 * InventarisLabAnkeskimia::avg('jumlah');
        // $data['barangHabis'] = InventarisLabAnkeskimia::where('jumlah', '<', 'jumlah_min')->get();
        // return view('rolekoorlabankes.contentkoorlab.dashboard', compact('notifications', 'data'));

        // $jumlah_min = InventarisLabAnkeskimia::value('jumlah_min');
        // $data['barangHabis'] = InventarisLabAnkeskimia::where('jumlah', '<', $jumlah_min)->get();

        // // Ankeskimia
        // $inventaris = InventarisLabAnkeskimia::all();
        // $barangHabis = [];
        // foreach ($inventaris as $barang) {
        //     if ($barang->jumlah < $barang->jumlah_min) {
        //         $barangHabis[] = $barang;
        //     }
        // }

        // // farmasetika
        // $inventaris1 = InventarisLabFarmasetika::all();
        // $barangHabis1 = [];
        // foreach ($inventaris1 as $barang1) {
        //     if ($barang1->jumlah < $barang1->jumlah_min) {
        //         $barangHabis1[] = $barang1;
        //     }
        // }

        $barangHabis = collect();
        $inventarisModels = [
            'App\Models\InventarisLabAnkeskimia',
            'App\Models\InventarisLabMedis',
            'App\Models\InventarisLabMikro',
            'App\Models\InventarisLabSitohisto',
        ];

        foreach ($inventarisModels as $model) {
            $inventaris = $model::all();
            foreach ($inventaris as $barang) {
                if ($barang->jumlah < $barang->jumlah_min) {
                    $barangHabis->push($barang);
                }
            }
        }

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.dashboard', compact('notifications', 'barangHabis'));
            } else{
                return view('roleadminlabankes.contentadminlab.dashboard', compact('notifications', 'barangHabis'));
            }
        }
    }

    public function updateNotification(Request $request)
    {
        if ($request->has('sudah_dilayani')) {
            foreach ($request->sudah_dilayani as $notificationId) {
                $notification = InventarisLabAnkeskimia::find($notificationId);

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
