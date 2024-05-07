<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabFarmakognosi;
use App\Models\InventarisLabFarmasetika;
use App\Models\InventarisLabKimia;
use App\Models\InventarisLabTekfarmasi;
use App\Models\BarangMasukFarmakognosi;
use App\Models\BarangMasukFarmasetika;
use App\Models\BarangMasukKimia;
use App\Models\BarangMasukTekfarmasi;
use App\Models\BarangKeluarFarmakognosi;
use App\Models\BarangKeluarFarmasetika;
use App\Models\BarangKeluarKimia;
use App\Models\BarangKeluarTekfarmasi;
use App\Models\PengajuanBarangLabFarmasi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class DashboardKoorAdminLabFarmasiController extends Controller
{
    public function index(Request $request)
    {
        $pengajuan = PengajuanBarangLabFarmasi::count();

        $baranglabfarmakognosi = InventarisLabFarmakognosi::count();
        $baranglabfarmasetika = InventarisLabFarmasetika::count();
        $baranglabkimia = InventarisLabKimia::count();
        $baranglabtekfarmasi = InventarisLabTekfarmasi::count();

        $barangmasuklabfarmakognosi = BarangMasukFarmakognosi::count();
        $barangmasuklabfarmasetika = BarangMasukFarmasetika::count();
        $barangmasuklabkimia = BarangMasukKimia::count();
        $barangmasuklabtekfarmasi = BarangMasukTekfarmasi::count();

        $barangkeluarlabfarmakognosi = BarangKeluarFarmakognosi::count();
        $barangkeluarlabfarmasetika = BarangKeluarFarmasetika::count();
        $barangkeluarlabkimia = BarangKeluarKimia::count();
        $barangkeluarlabtekfarmasi = BarangKeluarTekfarmasi::count();

        
        $total_barang = $baranglabfarmakognosi +  $baranglabfarmasetika + $baranglabkimia + $baranglabtekfarmasi;
        $total_masuk = $barangmasuklabfarmakognosi + $barangmasuklabfarmasetika + $barangmasuklabkimia + $barangmasuklabtekfarmasi;
        $total_keluar = $barangkeluarlabfarmakognosi + $barangkeluarlabfarmasetika + $barangkeluarlabkimia + $barangkeluarlabtekfarmasi;

        $notifications = collect();

        // Daftar model yang ingin Anda periksa notifikasinya
        $labModels = [
            'App\Models\InventarisLabFarmakognosi',
                    'App\Models\InventarisLabFarmasetika',
                    'App\Models\InventarisLabKimia',
                    'App\Models\InventarisLabTekfarmasi',
        ];

        // Loop melalui setiap model
        foreach ($labModels as $labModel) {
            // Ambil semua notifikasi yang sesuai dengan logika Anda dari model saat ini
            $notificationsForLab = $labModel::where(function ($query) {
                $query->whereDate('tanggal_service', Carbon::today())
                    ->orWhere(function ($query) {
                        $query->whereRaw('DATE_ADD(tanggal_service, INTERVAL periode MONTH) >= ?', [Carbon::today()])
                            ->where('tanggal_service', '<', Carbon::today());
                    });
                $query->where('reminder', true);
            })->where('sudah_dilayani', false)->get();

            // Gabungkan notifikasi ke dalam koleksi utama
            $notifications = $notifications->merge($notificationsForLab);
        }

        $perPage = 5;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $sliced = $notifications->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $notifications = new LengthAwarePaginator($sliced, $notifications->count(), $perPage, $currentPage, [
            'path' => Paginator::resolveCurrentPath(),
        ]);


        $barangHabis = collect();
        $inventarisModels = [
            'App\Models\InventarisLabFarmakognosi',
            'App\Models\InventarisLabFarmasetika',
            'App\Models\InventarisLabKimia',
            'App\Models\InventarisLabTekfarmasi',
        ];

        foreach ($inventarisModels as $model) {
            $inventaris = $model::all();
            foreach ($inventaris as $barang) {
                if ($barang->jumlah < $barang->jumlah_min) {
                    $barangHabis->push($barang);
                }
            }
        }

        $perPage = 5;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $sliced = $barangHabis->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $barangHabis = new LengthAwarePaginator($sliced, $barangHabis->count(), $perPage, $currentPage, [
            'path' => Paginator::resolveCurrentPath(),
        ]);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.dashboard', compact('notifications', 'barangHabis', 'pengajuan', 'total_barang', 'total_masuk', 'total_keluar'));
            } elseif(Auth::user()->role == 'adminlabprodfarmasi'){
                return view('roleadminlabfarmasi.contentadminlab.dashboard', compact('notifications', 'barangHabis','pengajuan', 'total_barang', 'total_masuk', 'total_keluar'));
            }
        }
    }

    public function history(Request $request)
    {
        $query = $request->input('search');
        $labfarmakognosi = InventarisLabFarmakognosi::query();
        
        if ($query) {
            $labfarmakognosi->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labfarmakognosi = $labfarmakognosi->paginate(10);
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.riwayatservice', compact('labfarmakognosi'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.riwayatservice', compact('labfarmakognosi'));
            }
        }
    }

    public function updateNotification(Request $request)
    {
        if ($request->has('sudah_dilayani')) {
            foreach ($request->sudah_dilayani as $notificationId) {
                $notification = InventarisLabFarmakognosi::find($notificationId);
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
