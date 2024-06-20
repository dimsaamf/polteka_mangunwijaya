<?php

namespace App\Http\Controllers\AdminProdiKimia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisKimia;
use App\Models\BarangMasukTekkimia;
use App\Models\BarangKeluarTekkimia;
use App\Models\RiwayatServiceProdiKimia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardKimiaController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_hari_ini = Carbon::now();
        $tanggal_awal_tahun_ini = Carbon::now()->startOfYear();
        $tanggal_akhir_hari_ini = $tanggal_hari_ini->endOfDay();

        $jumlah_barang = InventarisKimia::whereBetween('created_at', [$tanggal_awal_tahun_ini, $tanggal_akhir_hari_ini])->count();
        $jumlah_barang_masuk = BarangMasukTekkimia::whereBetween('created_at', [$tanggal_awal_tahun_ini, $tanggal_akhir_hari_ini])->count();
        $jumlah_barang_keluar = BarangKeluarTekkimia::whereBetween('created_at', [$tanggal_awal_tahun_ini, $tanggal_akhir_hari_ini])->count();

        $reminders = InventarisKimia::where('tanggal_service', '<=', now())->paginate(5);

        $barangHabis = InventarisKimia::whereColumn('jumlah', '<', DB::raw('jumlah_min'))->paginate(5);
        
        return view('roleadminprodikimia.contentadminprodi.dashboard', compact('reminders', 'barangHabis', 'jumlah_barang', 'jumlah_barang_masuk', 'jumlah_barang_keluar'));
    }

    

    public function update(Request $request)
    {
        $reminderIds = $request->input('reminder_ids');
        if (empty($reminderIds)) {
            alert()->info('Tidak Ada Perubahan', 'Tidak Ada Reminder yang Diperbarui.');
            return redirect()->route('dashboardadminprodikimia');
        }

        foreach ($request->reminder_ids as $reminder_id) {
            $barang = InventarisKimia::findOrFail($reminder_id);
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barang->tanggal_service)
                ->addMonths($barang->periode);

            $barang->tanggal_service = $nextServiceDate;
            $barang->save();

            RiwayatServiceProdiKimia::create([
                'inventaris_kimias_id' => $barang->id,
                'tanggal_service' => $barang->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        alert()->success('Berhasil', 'Reminder Berhasil Diperbarui.');
        return redirect()->route('dashboardadminprodikimia');
    }
    

    public function getRiwayatKimia(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisKimia::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceProdiKimia::query()
            ->with('barangkimia')
            ->whereHas('barangkimia', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);
            
        return view('roleadminprodikimia.contentadminprodi.riwayatservice', compact('riwayats','data'));
    }
    
}
