<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatServiceLabFarmakognosi;
use App\Models\RiwayatServiceLabFarmasetika;
use App\Models\RiwayatServiceLabKimia;
use App\Models\RiwayatServiceLabTekfarmasi;
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

        $farmakognosireminders = InventarisLabFarmakognosi::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $farmakognosireminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $farmakognosireminders = new LengthAwarePaginator($currentItems, count($farmakognosireminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $farmasetikareminders = InventarisLabFarmasetika::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $farmasetikareminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $farmasetikareminders = new LengthAwarePaginator($currentItems, count($farmasetikareminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $kimiareminders = InventarisLabKimia::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $kimiareminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $kimiareminders = new LengthAwarePaginator($currentItems, count($kimiareminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $tekfarmasireminders = InventarisLabTekfarmasi::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $tekfarmasireminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $tekfarmasireminders = new LengthAwarePaginator($currentItems, count($tekfarmasireminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
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

        $perPage = 10;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $sliced = $barangHabis->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $barangHabis = new LengthAwarePaginator($sliced, $barangHabis->count(), $perPage, $currentPage, [
            'path' => Paginator::resolveCurrentPath(),
        ]);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.dashboard', compact('farmakognosireminders', 'farmasetikareminders', 'kimiareminders', 'tekfarmasireminders', 'barangHabis', 'pengajuan', 'total_barang', 'total_masuk', 'total_keluar'));
            } elseif(Auth::user()->role == 'adminlabprodfarmasi'){
                return view('roleadminlabfarmasi.contentadminlab.dashboard', compact('farmakognosireminders', 'farmasetikareminders', 'kimiareminders', 'tekfarmasireminders', 'barangHabis','pengajuan', 'total_barang', 'total_masuk', 'total_keluar'));
            }
        }
    }

    public function updatefarmakognosi(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangfarmakognosi = InventarisLabFarmakognosi::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangfarmakognosi->tanggal_service)
                ->addMonths($barangfarmakognosi->periode);

            $barangfarmakognosi->tanggal_service = $nextServiceDate;
            $barangfarmakognosi->save();
    
            RiwayatServiceLabFarmakognosi::create([
                'inventaris_labfarmakognosis_id' => $barangfarmakognosi->id,
                'tanggal_service' => $barangfarmakognosi->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('dashboardkoorlabfarmasi');
            } elseif(Auth::user()->role == 'adminlabprodfarmasi'){
                return redirect()->route('dashboardadminlabfarmasi');
            }
        }
    }

    public function updatefarmasetika(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangfarmasetika = InventarisLabFarmasetika::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangfarmasetika->tanggal_service)
                ->addMonths($barangfarmasetika->periode);

            $barangfarmasetika->tanggal_service = $nextServiceDate;
            $barangfarmasetika->save();
    
            RiwayatServiceLabFarmasetika::create([
                'inventaris_lab_farmasetikas_id' => $barangfarmasetika->id,
                'tanggal_service' => $barangfarmasetika->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('dashboardkoorlabfarmasi');
            } elseif(Auth::user()->role == 'adminlabprodfarmasi'){
                return redirect()->route('dashboardadminlabfarmasi');
            }
        }
    }

    public function updatekimia(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangkimia = InventarisLabKimia::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangkimia->tanggal_service)
                ->addMonths($barangkimia->periode);

            $barangkimia->tanggal_service = $nextServiceDate;
            $barangkimia->save();
    
            RiwayatServiceLabKimia::create([
                'inventaris_lab_kimias_id' => $barangkimia->id,
                'tanggal_service' => $barangkimia->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('dashboardkoorlabfarmasi');
            } elseif(Auth::user()->role == 'adminlabprodfarmasi'){
                return redirect()->route('dashboardadminlabfarmasi');
            }
        }
    }

    public function updatetekfarmasi(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangtekfarmasi = InventarisLabTekfarmasi::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangtekfarmasi->tanggal_service)
                ->addMonths($barangtekfarmasi->periode);

            $barangtekfarmasi->tanggal_service = $nextServiceDate;
            $barangtekfarmasi->save();
    
            RiwayatServiceLabTekfarmasi::create([
                'inventaris_lab_tekfarmasis_id' => $barangtekfarmasi->id,
                'tanggal_service' => $barangtekfarmasi->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('dashboardkoorlabfarmasi');
            } elseif(Auth::user()->role == 'adminlabprodfarmasi'){
                return redirect()->route('dashboardadminlabfarmasi');
            }
        }
    }

    public function historyfarmakognosi(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabFarmakognosi::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

        $riwayats = RiwayatServiceLabFarmakognosi::query()
            ->with('barangfarmakognosi') // Load relasi InventarisFarmasi
            ->whereHas('barangfarmakognosi', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.riwayatservicefarmakognosi', compact('riwayats', 'data'));
            } elseif(Auth::user()->role == 'adminlabprodfarmasi') {
                return view('roleadminlabfarmasi.contentadminlab.riwayatservicefarmakognosi', compact('riwayats', 'data'));
            }
        }
    }

    public function historyfarmasetika(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabFarmasetika::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabFarmasetika::query()
            ->with('barangfarmasetika') // Load relasi InventarisFarmasi
            ->whereHas('barangfarmasetika', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.riwayatservicefarmasetika', compact('riwayats', 'data'));
            } else {
                return view('roleadminlabfarmasi.contentadminlab.riwayatservicefarmasetika', compact('riwayats', 'data'));
            }
        }
    }

    public function historykimia(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabKimia::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabKimia::query()
            ->with('barangkimia') // Load relasi InventarisFarmasi
            ->whereHas('barangkimia', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.riwayatservicekimia', compact('riwayats', 'data'));
            } else {
                return view('roleadminlabfarmasi.contentadminlab.riwayatservicekimia', compact('riwayats', 'data'));
            }
        }
    }

    public function historytekfarmasi(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabTekfarmasi::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabTekfarmasi::query()
            ->with('barangtekfarmasi') // Load relasi InventarisFarmasi
            ->whereHas('barangtekfarmasi', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.riwayatservicetekfarmasi', compact('riwayats', 'data'));
            } else {
                return view('roleadminlabfarmasi.contentadminlab.riwayatservicetekfarmasi', compact('riwayats', 'data'));
            }
        }
    }

}
