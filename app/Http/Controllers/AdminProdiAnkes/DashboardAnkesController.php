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
        $tanggal_hari_ini = Carbon::now();
        $tanggal_awal_tahun_ini = Carbon::now()->startOfYear();
        $tanggal_akhir_hari_ini = $tanggal_hari_ini->endOfDay();

        $jumlah_barang = InventarisAnkes::whereBetween('created_at', [$tanggal_awal_tahun_ini, $tanggal_akhir_hari_ini])->count();
        $jumlah_barang_masuk = BarangMasukAnkes::whereBetween('created_at', [$tanggal_awal_tahun_ini, $tanggal_akhir_hari_ini])->count();
        $jumlah_barang_keluar = BarangKeluarAnkes::whereBetween('created_at', [$tanggal_awal_tahun_ini, $tanggal_akhir_hari_ini])->count();

        $reminders = InventarisAnkes::where('tanggal_service', '<=', now())->paginate(5);

        $barangHabis = InventarisAnkes::whereColumn('jumlah', '<', DB::raw('jumlah_min'))->paginate(5);
        
        return view('roleadminprodiankes.contentadminprodi.dashboard', compact('reminders', 'barangHabis', 'jumlah_barang', 'jumlah_barang_masuk', 'jumlah_barang_keluar'));
    }


    public function update(Request $request)
    {
        $reminderIds = $request->input('reminder_ids');
        if (empty($reminderIds)) {
            alert()->info('Tidak Ada Perubahan', 'Tidak Ada Reminder yang Diperbarui.');
            return redirect()->route('dashboardadminprodiankes');
        }

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
    
        alert()->success('Berhasil', 'Reminder Berhasil Diperbarui.');
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
