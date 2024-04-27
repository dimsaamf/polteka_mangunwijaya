<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabFarmakognosi;
use Carbon\Carbon;

class DashboardKoorAdminLabFarmasiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('sudah_dilayani')) {
            foreach ($request->sudah_dilayani as $notificationId) {
                $notification = InventarisLabFarmakognosi::find($notificationId);
                $notification->sudah_dilayani = true;
                $notification->save();
            }
        }

        $notifications = InventarisLabFarmakognosi::where(function ($query) {
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
        $data['barangHabis'] = InventarisLabFarmakognosi::where('jumlah', '<', 20)->get();
        return view('rolekoorlabfarmasi.contentkoorlab.dashboard', compact('notifications', 'data'));
    }

    public function updateNotification(Request $request)
    {
        if ($request->has('sudah_dilayani')) {
            foreach ($request->sudah_dilayani as $notificationId) {
                $notification = InventarisLabFarmakognosi::find($notificationId);

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
