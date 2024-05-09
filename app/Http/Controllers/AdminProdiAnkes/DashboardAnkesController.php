<?php

namespace App\Http\Controllers\AdminProdiAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisAnkes;
use App\Models\BarangMasukAnkes;
use App\Models\BarangKeluarAnkes;
use App\Models\RiwayatServiceProdiAnkes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardAnkesController extends Controller
{
    public function index(Request $request)
    {
        $jumlah_barang = InventarisAnkes::count();
        $jumlah_barang_masuk = BarangMasukAnkes::count();
        $jumlah_barang_keluar = BarangKeluarAnkes::count();

        $reminders = InventarisAnkes::where('tanggal_service', '<=', now())->paginate(5);

        $barangHabis = InventarisAnkes::whereColumn('jumlah', '<', DB::raw('jumlah_min'))->paginate(5);
        
        return view('roleadminprodiankes.contentadminprodi.dashboard', compact('reminders', 'barangHabis', 'jumlah_barang', 'jumlah_barang_masuk', 'jumlah_barang_keluar'));
    }


    public function update(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barang = InventarisAnkes::findOrFail($reminder_id);
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barang->tanggal_service)
                ->addMonths($barang->periode);

            $barang->tanggal_service = $nextServiceDate;
            $barang->save();

            RiwayatServiceProdiAnkes::create([
                'inventaris_ankes_id' => $barang->id,
                'tanggal_service' => $barang->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        return redirect()->route('dashboardadminprodiankes');
    }

    public function getRiwayatAnkes(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisAnkes::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceProdiAnkes::query()
            ->with('barangankes')
            ->whereHas('barangankes', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);
            
        return view('roleadminprodiankes.contentadminprodi.riwayatservice', compact('riwayats','data'));
    }
    
}
