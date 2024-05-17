<?php

namespace App\Http\Controllers\AdminProdiAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisAnkes;
use App\Models\BarangKeluarAnkes;
use Carbon\Carbon;

class BarangKeluarAnkesController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisAnkes::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        return view('roleadminprodiankes.contentadminprodi.barangkeluar', compact('data'));
    }

    public function index(Request $request){
        $query = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $cek = Carbon::today();
        $hari_ini = $cek->toDateString();

        if ($start_date > $end_date) {
            alert()->error('Data Gagal Ditampilkan','Tanggal Akhir Melebihi Tanggal Awal.');
            return back();
        }

        if ($start_date > $hari_ini) {
            alert()->error('Data Gagal Ditampilkan.','Tanggal Awal Melebihi Hari Ini.');
            return back();
        }

        if ( $end_date > $hari_ini) {
            alert()->error('Data Gagal Ditampilkan.','Tanggal Akhir Melebihi Hari Ini.');
            return back();
        }

        if ($start_date && $end_date) {
            session()->put('filter_start_date', $start_date);
            session()->put('filter_end_date', $end_date);
        } else {
            // Jika tidak ada nilai filter yang diberikan, hapus nilai filter dari session
            session()->forget('filter_start_date');
            session()->forget('filter_end_date');
        }

        $queryBuilder = BarangKeluarAnkes::with('InventarisAnkes')
            ->whereHas('InventarisAnkes', function ($q) use ($query) {
                $q->where('nama_barang', 'LIKE', '%' . $query . '%');
            });

        if ($start_date && $end_date) {
            $queryBuilder->whereBetween('tanggal_keluar', [$start_date, $end_date]);
        }

        // Cek apakah tombol "Batal Filter" diklik
        if ($request->has('cancel_filter')) {
            // Hapus nilai filter dari session
            session()->forget('filter_start_date');
            session()->forget('filter_end_date');
        }

        $BarangKeluarAnkes = $queryBuilder->paginate(10);

        $data = InventarisAnkes::all();
        return view('roleadminprodiankes.contentadminprodi.riwayatkeluar', compact('BarangKeluarAnkes','data'));
    }

    public function create(){
        return view('roleadminprodiankes.contentadminprodi.barangkeluar');
    }

    public function store(Request $request)
    {
        $messages = [
            'jumlah_keluar.min' => 'Jumlah tidak boleh bilangan negatif.',
            'jumlah_keluar.numeric' => 'Jumlah harus berupa angka.',
            'jumlah_keluar.integer' => 'Jumlah harus berupa angka.',
            'keterangan_keluar' => 'Keterangan harus diisi (contoh: barang rusak)',
        ];

        $request->validate([
            'jumlah_keluar' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $inventaris = InventarisAnkes::findOrFail($request->id_barang);
                    $satuan = $inventaris->satuan;

                    if (in_array($satuan, ['pcs', 'lembar'])) {
                        if (strpos($value, '.') !== false) {
                            $fail('Jumlah masuk tidak boleh mengandung angka desimal untuk satuan pcs dan lembar');
                        }
                    }
                },
            ],
            'tanggal_keluar' => 'required|date',
            'keterangan_keluar' => 'required',
        ], $messages);

        $id_barang = $request->id_barang;
        $barang = InventarisAnkes::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarAnkes = new BarangKeluarAnkes();
            $BarangKeluarAnkes->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarAnkes->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarAnkes->keterangan_keluar = $request->keterangan_keluar;
            $BarangKeluarAnkes->id_barang = $id_barang;
            $BarangKeluarAnkes->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            return redirect()->route('barangkeluaradminprodiankes');
        }
    }
}
