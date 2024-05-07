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

class DashboardFarmasiController extends Controller
{
    public function index(Request $request)
    {
        $jumlah_barang = InventarisFarmasi::count();
        $jumlah_barang_masuk = BarangMasukFarmasi::count();
        $jumlah_barang_keluar = BarangKeluarFarmasi::count();

        $reminders = InventarisFarmasi::where('tanggal_service', '<=', now())->get();

        $barangHabis = InventarisFarmasi::whereColumn('jumlah', '<', DB::raw('jumlah_min'))->paginate(5);
        
        return view('roleadminprodifarmasi.contentadminprodi.dashboard', compact('reminders', 'barangHabis', 'jumlah_barang', 'jumlah_barang_masuk', 'jumlah_barang_keluar'));
    }

    

    public function update(Request $request)
    {
        foreach ($request->reminder_ids as $reminder_id) {
            $barang = InventarisFarmasi::findOrFail($reminder_id);
            
            // Calculate the next service date based on the current tanggal_service and periode
            $nextServiceDate = Carbon::createFromFormat('Y-m-d', $barang->tanggal_service)
                ->addDays($barang->periode);
            
            // Update the tanggal_service to the next service date
            $barang->tanggal_service = $nextServiceDate;
            $barang->save();
    
            // Create history record
            RiwayatServiceProdiFarmasi::create([
                'inventaris_farmasis_id' => $barang->id,
                'tanggal_service' => $barang->tanggal_service,
                'keterangan' => 'Barang telah diservis pada ',
            ]);
        }
    
        return redirect()->route('dashboardadminprodifarmasi');
    }
    

public function getRiwayat()
{
    $data = InventarisFarmasi::all();

    $riwayats = RiwayatServiceProdiFarmasi::all();
    return view('roleadminprodifarmasi.contentadminprodi.riwayatservice', compact('riwayats','data'));
}
    
}
