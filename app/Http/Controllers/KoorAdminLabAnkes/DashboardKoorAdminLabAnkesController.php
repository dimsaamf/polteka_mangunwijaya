<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatServiceLabAnkeskimia;
use App\Models\RiwayatServiceLabMedis;
use App\Models\RiwayatServiceLabMikro;
use App\Models\RiwayatServiceLabSitohisto;
use App\Models\InventarisLabAnkeskimia;
use App\Models\InventarisLabMedis;
use App\Models\InventarisLabMikro;
use App\Models\InventarisLabSitohisto;
use App\Models\BarangMasukAnkeskimia;
use App\Models\BarangMasukMedis;
use App\Models\BarangMasukMikro;
use App\Models\BarangMasukSitohisto;
use App\Models\BarangKeluarAnkeskimia;
use App\Models\BarangKeluarMedis;
use App\Models\BarangKeluarMikro;
use App\Models\BarangKeluarSitohisto;
use App\Models\PengajuanBarangLabAnkes;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class DashboardKoorAdminLabAnkesController extends Controller
{
    public function index(Request $request)
    {
        $pengajuan = PengajuanBarangLabAnkes::count();

        $baranglabankeskimia = InventarisLabAnkeskimia::count();
        $baranglabmedia = InventarisLabMedis::count();
        $baranglabmikro = InventarisLabMikro::count();
        $baranglabsitohisto = InventarisLabSitohisto::count();

        $barangmasuklabankeskimia = BarangMasukAnkeskimia::count();
        $barangmasuklabmedia = BarangMasukMedis::count();
        $barangmasuklabmikro = BarangMasukMikro::count();
        $barangmasuklabsitohisto = BarangMasukSitohisto::count();

        $barangkeluarlabankeskimia = BarangKeluarAnkeskimia::count();
        $barangkeluarlabmedia = BarangKeluarMedis::count();
        $barangkeluarlabmikro = BarangKeluarMikro::count();
        $barangkeluarlabsitohisto = BarangKeluarSitohisto::count();

        
        $total_barang = $baranglabankeskimia + $baranglabmedia + $baranglabmikro + $baranglabsitohisto;
        $total_masuk = $barangmasuklabankeskimia + $barangmasuklabmedia + $barangmasuklabmikro + $barangmasuklabsitohisto;
        $total_keluar =  $barangkeluarlabankeskimia + $barangkeluarlabmedia + $barangkeluarlabmikro + $barangkeluarlabsitohisto;

        $ankeskimiareminders = InventarisLabAnkeskimia::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $ankeskimiareminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $ankeskimiareminders = new LengthAwarePaginator($currentItems, count($ankeskimiareminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $medisreminders = InventarisLabMedis::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $medisreminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $medisreminders = new LengthAwarePaginator($currentItems, count($medisreminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $mikroreminders = InventarisLabMikro::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $mikroreminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $mikroreminders = new LengthAwarePaginator($currentItems, count($mikroreminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $sitohistoreminders = InventarisLabSitohisto::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $sitohistoreminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $sitohistoreminders = new LengthAwarePaginator($currentItems, count($sitohistoreminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

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

        $perPage = 10;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $sliced = $barangHabis->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $barangHabis = new LengthAwarePaginator($sliced, $barangHabis->count(), $perPage, $currentPage, [
            'path' => Paginator::resolveCurrentPath(),
        ]);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.dashboard', compact('ankeskimiareminders', 'medisreminders', 'mikroreminders', 'sitohistoreminders', 'barangHabis', 'pengajuan', 'total_barang', 'total_masuk', 'total_keluar'));
            } else{
                return view('roleadminlabankes.contentadminlab.dashboard', compact('ankeskimiareminders', 'medisreminders', 'mikroreminders', 'sitohistoreminders', 'barangHabis', 'pengajuan', 'total_barang', 'total_masuk', 'total_keluar'));
            }
        }
    }

    public function updateankeskimia(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangankeskimia = InventarisLabAnkeskimia::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangankeskimia->tanggal_service)
                ->addMonths($barangankeskimia->periode);

            $barangankeskimia->tanggal_service = $nextServiceDate;
            $barangankeskimia->save();
    
            RiwayatServiceLabAnkeskimia::create([
                'inventaris_lab_ankeskimias_id' => $barangankeskimia->id,
                'tanggal_service' => $barangankeskimia->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('dashboardkoorlabankes');
            } else{
                return redirect()->route('dashboardadminlabankes');
            }
        }
    }

    public function updatemedis(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangmedis = InventarisLabMedis::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangmedis->tanggal_service)
                ->addMonths($barangmedis->periode);

            $barangmedis->tanggal_service = $nextServiceDate;
            $barangmedis->save();
    
            RiwayatServiceLabMedis::create([
                'inventaris_lab_medis_id' => $barangmedis->id,
                'tanggal_service' => $barangmedis->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('dashboardkoorlabankes');
            } else{
                return redirect()->route('dashboardadminlabankes');
            }
        }
    }

    public function updatemikro(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangmikro = InventarisLabMikro::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangmikro->tanggal_service)
                ->addMonths($barangmikro->periode);

            $barangmikro->tanggal_service = $nextServiceDate;
            $barangmikro->save();
    
            RiwayatServiceLabMikro::create([
                'inventaris_lab_mikros_id' => $barangmikro->id,
                'tanggal_service' => $barangmikro->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('dashboardkoorlabankes');
            } else{
                return redirect()->route('dashboardadminlabankes');
            }
        }
    }

    public function updatesitohisto(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangsitohisto = InventarisLabSitohisto::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangsitohisto->tanggal_service)
                ->addMonths($barangsitohisto->periode);

            $barangsitohisto->tanggal_service = $nextServiceDate;
            $barangsitohisto->save();
    
            RiwayatServiceLabSitohisto::create([
                'inventaris_lab_sitohistos_id' => $barangsitohisto->id,
                'tanggal_service' => $barangsitohisto->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('dashboardkoorlabankes');
            } else{
                return redirect()->route('dashboardadminlabankes');
            }
        }
    }

    public function historyankeskimia(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabAnkeskimia::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabAnkeskimia::query()
            ->with('barangankes') // Load relasi InventarisFarmasi
            ->whereHas('barangankes', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.riwayatserviceankeskimia', compact('riwayats', 'data'));
            } elseif(Auth::user()->role == 'adminlabprodankes') {
                return view('roleadminlabankes.contentadminlab.riwayatserviceankeskimia', compact('riwayats', 'data'));
            }
        }
    }

    public function historymedis(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabMedis::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabMedis::query()
            ->with('barangmedis') // Load relasi InventarisFarmasi
            ->whereHas('barangmedis', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.riwayatservicemedis', compact('riwayats', 'data'));
            } elseif(Auth::user()->role == 'adminlabprodankes') {
                return view('roleadminlabankes.contentadminlab.riwayatservicemedis', compact('riwayats', 'data'));
            }
        }
    }

    public function historymikro(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabMikro::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabMikro::query()
            ->with('barangmikro') // Load relasi InventarisFarmasi
            ->whereHas('barangmikro', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.riwayatservicemikro', compact('riwayats', 'data'));
            } elseif(Auth::user()->role == 'adminlabprodankes') {
                return view('roleadminlabankes.contentadminlab.riwayatservicemikro', compact('riwayats', 'data'));
            }
        }
    }
    
    public function historysitohisto(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabSitohisto::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabSitohisto::query()
            ->with('barangsitohisto') // Load relasi InventarisFarmasi
            ->whereHas('barangsitohisto', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.riwayatservicesitohisto', compact('riwayats', 'data'));
            } elseif(Auth::user()->role == 'adminlabprodankes') {
                return view('roleadminlabankes.contentadminlab.riwayatservicesitohisto', compact('riwayats', 'data'));
            }
        }
    }
}
