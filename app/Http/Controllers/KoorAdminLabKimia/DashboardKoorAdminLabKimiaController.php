<?php

namespace App\Http\Controllers\KoorAdminLabKimia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatServiceLabKimiaAnalisa;
use App\Models\RiwayatServiceLabKimiaFisika;
use App\Models\RiwayatServiceLabKimiaOrganik;
use App\Models\RiwayatServiceLabKimiaTerapan;
use App\Models\RiwayatServiceLabMikrobiologi;
use App\Models\RiwayatServiceLabOptekkim;
use App\Models\InventarisLabKimiaAnalisa;
use App\Models\InventarisLabKimiaFisika;
use App\Models\InventarisLabKimiaOrganik;
use App\Models\InventarisLabKimiaTerapan;
use App\Models\InventarisLabMikrobiologi;
use App\Models\InventarisLabOptekkim;
use App\Models\BarangMasukKimiaAnalisa;
use App\Models\BarangMasukKimiaFisika;
use App\Models\BarangMasukKimiaOrganik;
use App\Models\BarangMasukKimiaTerapan;
use App\Models\BarangMasukMikrobiologi;
use App\Models\BarangMasukOptekkim;
use App\Models\BarangKeluarKimiaAnalisa;
use App\Models\BarangKeluarKimiaFisika;
use App\Models\BarangKeluarKimiaOrganik;
use App\Models\BarangKeluarKimiaTerapan;
use App\Models\BarangKeluarMikrobiologi;
use App\Models\BarangKeluarOptekkim;
use App\Models\PengajuanBarangLabKimia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

class DashboardKoorAdminLabKimiaController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_hari_ini = Carbon::now();
        $tanggal_awal_bulan_ini = Carbon::now()->startOfMonth();
        $tanggal_akhir_hari_ini = $tanggal_hari_ini->endOfDay();
        
        $pengajuan = PengajuanBarangLabKimia::whereBetween('tanggal', [$tanggal_awal_bulan_ini, $tanggal_akhir_hari_ini])->count();

        $baranglabkimiaanalisa = InventarisLabKimiaAnalisa::count();
        $baranglabkimiafisika = InventarisLabKimiaFisika::count();
        $baranglabkimiaorganik = InventarisLabKimiaOrganik::count();
        $baranglabkimiaterapan = InventarisLabKimiaTerapan::count();
        $baranglabmikrobiologi = InventarisLabMikrobiologi::count();
        $baranglaboptekkim = InventarisLabOptekkim::count();

        $barangmasuklabkimiaanalisa = BarangMasukKimiaAnalisa::count();
        $barangmasuklabkimiafisika = BarangMasukKimiaFisika::count();
        $barangmasuklabkimiaorganik = BarangMasukKimiaOrganik::count();
        $barangmasuklabkimiaterapan = BarangMasukKimiaTerapan::count();
        $barangmasuklabmikrobiologi = BarangMasukMikrobiologi::count();
        $barangmasuklaboptekkim = BarangMasukOptekkim::count();

        $barangkeluarlabkimiaanalisa = BarangKeluarKimiaAnalisa::count();
        $barangkeluarlabkimiafisika = BarangKeluarKimiaFisika::count();
        $barangkeluarlabkimiaorganik = BarangKeluarKimiaOrganik::count();
        $barangkeluarlabkimiaterapan = BarangKeluarKimiaTerapan::count();
        $barangkeluarlabmikrobiologi = BarangKeluarMikrobiologi::count();
        $barangkeluarlaboptekkim = BarangKeluarOptekkim::count();
        
        $total_barang = $baranglabkimiaanalisa + $baranglabkimiafisika + $baranglabkimiaorganik + $baranglabkimiaterapan + $baranglabmikrobiologi + $baranglaboptekkim;
        $total_masuk = $barangmasuklabkimiaanalisa + $barangmasuklabkimiafisika+ $barangmasuklabkimiaorganik + $barangmasuklabkimiaterapan + $barangmasuklabmikrobiologi + $barangmasuklaboptekkim;
        $total_keluar = $barangkeluarlabkimiaanalisa + $barangkeluarlabkimiafisika + $barangkeluarlabkimiaorganik + $barangkeluarlabkimiaterapan + $barangkeluarlabmikrobiologi + $barangkeluarlaboptekkim;

        $kimiaanalisareminders = InventarisLabKimiaAnalisa::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $kimiaanalisareminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $kimiaanalisareminders = new LengthAwarePaginator($currentItems, count($kimiaanalisareminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $kimiafisikareminders = InventarisLabKimiaFisika::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $kimiafisikareminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $kimiafisikareminders = new LengthAwarePaginator($currentItems, count($kimiafisikareminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $kimiaorganikreminders = InventarisLabKimiaOrganik::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $kimiaorganikreminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $kimiaorganikreminders = new LengthAwarePaginator($currentItems, count($kimiaorganikreminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $kimiaterapanreminders = InventarisLabKimiaTerapan::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $kimiaterapanreminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $kimiaterapanreminders = new LengthAwarePaginator($currentItems, count($kimiaterapanreminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $mikrobiologireminders = InventarisLabMikrobiologi::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $mikrobiologireminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $mikrobiologireminders = new LengthAwarePaginator($currentItems, count($mikrobiologireminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $optekkimreminders = InventarisLabOptekkim::where('tanggal_service', '<=', now())->get();

        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $optekkimreminders->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $optekkimreminders = new LengthAwarePaginator($currentItems, count($optekkimreminders), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $barangHabis = collect();
        $inventarisModels = [
            'App\Models\InventarisLabKimiaAnalisa',
            'App\Models\InventarisLabKimiaFisika',
            'App\Models\InventarisLabKimiaOrganik',
            'App\Models\InventarisLabKimiaTerapan',
            'App\Models\InventarisLabMikrobiologi',
            'App\Models\InventarisLabOptekkim',
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
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.dashboard', compact('kimiaanalisareminders', 'kimiafisikareminders', 'kimiaorganikreminders', 'kimiaterapanreminders', 'mikrobiologireminders', 'optekkimreminders', 'barangHabis', 'pengajuan', 'total_barang', 'total_masuk', 'total_keluar'));
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return view('roleadminlabkimia.contentadminlab.dashboard', compact('kimiaanalisareminders', 'kimiafisikareminders', 'kimiaorganikreminders', 'kimiaterapanreminders', 'mikrobiologireminders', 'optekkimreminders', 'barangHabis', 'total_barang', 'total_masuk', 'total_keluar'));
            }
        }
    }

    public function updatekimiaanalisa(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangkimiaanalisa = InventarisLabKimiaAnalisa::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangkimiaanalisa->tanggal_service)
                ->addMonths($barangkimiaanalisa->periode);

            $barangkimiaanalisa->tanggal_service = $nextServiceDate;
            $barangkimiaanalisa->save();
    
            RiwayatServiceLabKimiaAnalisa::create([
                'inventaris_lab_kimia_analisas_id' => $barangkimiaanalisa->id,
                'tanggal_service' => $barangkimiaanalisa->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('dashboardkoorlabkimia');
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return redirect()->route('dashboardadminlabkimia');
            }
        }
    }

    public function updatekimiafisika(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangkimiafisika = InventarisLabKimiaFisika::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangkimiafisika->tanggal_service)
                ->addMonths($barangkimiafisika->periode);

            $barangkimiafisika->tanggal_service = $nextServiceDate;
            $barangkimiafisika->save();
    
            RiwayatServiceLabKimiaFisika::create([
                'inventaris_lab_kimia_fisikas_id' => $barangkimiafisika->id,
                'tanggal_service' => $barangkimiafisika->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('dashboardkoorlabkimia');
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return redirect()->route('dashboardadminlabkimia');
            }
        }
    }

    public function updatekimiaorganik(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangkimiaorganik = InventarisLabKimiaOrganik::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangkimiaorganik->tanggal_service)
                ->addMonths($barangkimiaorganik->periode);

            $barangkimiaorganik->tanggal_service = $nextServiceDate;
            $barangkimiaorganik->save();
    
            RiwayatServiceLabKimiaOrganik::create([
                'inventaris_lab_kimia_organiks_id' => $barangkimiaorganik->id,
                'tanggal_service' => $barangkimiaorganik->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('dashboardkoorlabkimia');
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return redirect()->route('dashboardadminlabkimia');
            }
        }
    }

    public function updatekimiaterapan(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangkimiaterapan = InventarisLabKimiaTerapan::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangkimiaterapan->tanggal_service)
                ->addMonths($barangkimiaterapan->periode);

            $barangkimiaterapan->tanggal_service = $nextServiceDate;
            $barangkimiaterapan->save();
    
            RiwayatServiceLabKimiaTerapan::create([
                'inventaris_lab_kimia_terapans_id' => $barangkimiaterapan->id,
                'tanggal_service' => $barangkimiaterapan->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('dashboardkoorlabkimia');
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return redirect()->route('dashboardadminlabkimia');
            }
        }
    }

    public function updatemikrobiologi(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangmikrobiologi = InventarisLabMikrobiologi::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangmikrobiologi->tanggal_service)
                ->addMonths($barangmikrobiologi->periode);

            $barangmikrobiologi->tanggal_service = $nextServiceDate;
            $barangmikrobiologi->save();
    
            RiwayatServiceLabMikrobiologi::create([
                'inventaris_lab_mikrobiologis_id' => $barangmikrobiologi->id,
                'tanggal_service' => $barangmikrobiologi->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('dashboardkoorlabkimia');
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return redirect()->route('dashboardadminlabkimia');
            }
        }
    }

    public function updateoptekkim(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barangoptekkim = InventarisLabOptekkim::findOrFail($reminder_id);
            
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barangoptekkim->tanggal_service)
                ->addMonths($barangoptekkim->periode);

            $barangoptekkim->tanggal_service = $nextServiceDate;
            $barangoptekkim->save();
    
            RiwayatServiceLabOptekkim::create([
                'inventaris_lab_optekkims_id' => $barangoptekkim->id,
                'tanggal_service' => $barangoptekkim->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('dashboardkoorlabkimia');
            } elseif(Auth::user()->role == 'adminlabprodkimia'){
                return redirect()->route('dashboardadminlabkimia');
            }
        }
    }

    public function historykimiaanalisa(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabKimiaAnalisa::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

        $riwayats = RiwayatServiceLabKimiaAnalisa::query()
            ->with('barangkimiaanalisa') // Load relasi Inventariskimia
            ->whereHas('barangkimiaanalisa', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.riwayatservicekimiaanalisa', compact('riwayats', 'data'));
            } elseif(Auth::user()->role == 'adminlabprodkimia') {
                return view('roleadminlabkimia.contentadminlab.riwayatservicekimiaanalisa', compact('riwayats', 'data'));
            }
        }
    }

    public function historykimiafisika(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabKimiaFisika::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabKimiaFisika::query()
            ->with('barangkimiafisika') // Load relasi Inventariskimia
            ->whereHas('barangkimiafisika', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.riwayatservicekimiafisika', compact('riwayats', 'data'));
            } else {
                return view('roleadminlabkimia.contentadminlab.riwayatservicekimiafisika', compact('riwayats', 'data'));
            }
        }
    }

    public function historykimiaorganik(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabKimiaOrganik::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabKimiaOrganik::query()
            ->with('barangkimiaorganik') // Load relasi Inventariskimia
            ->whereHas('barangkimiaorganik', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.riwayatservicekimiaorganik', compact('riwayats', 'data'));
            } else {
                return view('roleadminlabkimia.contentadminlab.riwayatservicekimiaorganik', compact('riwayats', 'data'));
            }
        }
    }

    public function historykimiaterapan(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabKimiaTerapan::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabKimiaTerapan::query()
            ->with('barangkimiaterapan') // Load relasi Inventariskimia
            ->whereHas('barangkimiaterapan', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.riwayatservicekimiaterapan', compact('riwayats', 'data'));
            } else {
                return view('roleadminlabkimia.contentadminlab.riwayatservicekimiaterapan', compact('riwayats', 'data'));
            }
        }
    }

    public function historymikrobiologi(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabMikrobiologi::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabMikrobiologi::query()
            ->with('barangmikrobiologi') // Load relasi Inventariskimia
            ->whereHas('barangmikrobiologi', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.riwayatservicemikrobiologi', compact('riwayats', 'data'));
            } else {
                return view('roleadminlabkimia.contentadminlab.riwayatservicemikrobiologi', compact('riwayats', 'data'));
            }
        }
    }

    public function historyoptekkim(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisLabOptekkim::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceLabOptekkim::query()
            ->with('barangoptekkim') // Load relasi Inventariskimia
            ->whereHas('barangoptekkim', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.riwayatserviceoptekkim', compact('riwayats', 'data'));
            } else {
                return view('roleadminlabkimia.contentadminlab.riwayatserviceoptekkim', compact('riwayats', 'data'));
            }
        }
    }

}
