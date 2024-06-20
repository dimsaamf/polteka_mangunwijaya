<?php

namespace App\Http\Controllers\AdminProdiFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisFarmasi;
use App\Models\BarangMasukFarmasi;
use App\Models\BarangKeluarFarmasi;
use App\Models\RiwayatServiceProdiFarmasi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardFarmasiController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_hari_ini = Carbon::now();
        $tanggal_awal_tahun_ini = Carbon::now()->startOfYear();
        $tanggal_akhir_hari_ini = $tanggal_hari_ini->endOfDay();

        $jumlah_barang = InventarisFarmasi::whereBetween('created_at', [$tanggal_awal_tahun_ini, $tanggal_akhir_hari_ini])->count();
        $jumlah_barang_masuk = BarangMasukFarmasi::whereBetween('created_at', [$tanggal_awal_tahun_ini, $tanggal_akhir_hari_ini])->count();
        $jumlah_barang_keluar = BarangKeluarFarmasi::whereBetween('created_at', [$tanggal_awal_tahun_ini, $tanggal_akhir_hari_ini])->count();

        $reminders = InventarisFarmasi::where('tanggal_service', '<=', now())->paginate(5);

        $barangHabis = InventarisFarmasi::whereColumn('jumlah', '<', DB::raw('jumlah_min'))->paginate(5);
        
        return view('roleadminprodifarmasi.contentadminprodi.dashboard', compact('reminders', 'barangHabis', 'jumlah_barang', 'jumlah_barang_masuk', 'jumlah_barang_keluar'));
    }

    

    public function update(Request $request)
    {
        $reminderIds = $request->input('reminder_ids');
        if (empty($reminderIds)) {
            alert()->info('Tidak Ada Perubahan', 'Tidak Ada Reminder yang Diperbarui.');
            return redirect()->route('dashboardadminprodifarmasi');
        }

        foreach ($request->reminder_ids as $reminder_id) {
            $barang = InventarisFarmasi::findOrFail($reminder_id);
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barang->tanggal_service)
                ->addMonths($barang->periode);

            $barang->tanggal_service = $nextServiceDate;
            $barang->save();

            RiwayatServiceProdiFarmasi::create([
                'inventaris_farmasis_id' => $barang->id,
                'tanggal_service' => $barang->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        alert()->success('Berhasil', 'Reminder Berhasil Diperbarui.');
        return redirect()->route('dashboardadminprodifarmasi');
    }
    

    public function getRiwayatFarmasi(Request $request)
    {
        $query = $request->input('search');

        $data = InventarisFarmasi::query()
            ->where('nama_barang', 'like', '%' . $query . '%')
            ->paginate(10);

            $riwayats = RiwayatServiceProdiFarmasi::query()
            ->with('barangfarmasi') // Load relasi InventarisFarmasi
            ->whereHas('barangfarmasi', function ($q) use ($query) {
                $q->where('nama_barang', 'like', '%' . $query . '%');
            })
            ->paginate(10);
            
        return view('roleadminprodifarmasi.contentadminprodi.riwayatservice', compact('riwayats','data'));
    }
    
}
