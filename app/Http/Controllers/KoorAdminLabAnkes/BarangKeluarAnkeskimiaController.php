<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabAnkeskimia;
use App\Models\BarangKeluarAnkeskimia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BarangKeluarAnkeskimiaController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabAnkeskimia::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangkeluar', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangkeluar', compact('data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.barangkeluar', compact('data'));
            }
        }
    }

    public function index(Request $request){
        // $BarangKeluarAnkeskimia = BarangKeluarAnkeskimia::paginate(10);
        // $data=InventarisLabAnkeskimia::all();
        $query = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $cek = Carbon::today();
        $hari_ini = $cek->toDateString();

        if ($start_date > $end_date) {
            alert()->error('Data Gagal Dicetak','Tanggal Akhir Melebihi Tanggal Awal.');
            return back();
        }

        if ($start_date > $hari_ini) {
            alert()->error('Data Gagal Dicetak.','Tanggal Awal Melebihi Hari Ini.');
            return back();
        }

        if ( $end_date > $hari_ini) {
            alert()->error('Data Gagal Dicetak.','Tanggal Akhir Melebihi Hari Ini.');
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

        $queryBuilder = BarangKeluarAnkeskimia::with('inventarislabankeskimia')
            ->whereHas('inventarislabankeskimia', function ($q) use ($query) {
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

        $BarangKeluarAnkeskimia = $queryBuilder->paginate(10);

        $data = InventarisLabAnkeskimia::all();
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.riwayatkeluar', compact('BarangKeluarAnkeskimia','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.riwayatkeluar', compact('BarangKeluarAnkeskimia','data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.riwayatkeluar', compact('BarangKeluarAnkeskimia','data'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangkeluar');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.barangkeluar');
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.barangkeluar');
            }
        }
    }

    public function store(Request $request)
    {
        $messages = [
            'jumlah_keluar.min' => 'Jumlah tidak boleh bilangan negatif.',
            'jumlah_keluar.numeric' => 'Jumlah harus berupa angka.',
            'jumlah_keluar.integer' => 'Jumlah harus berupa angka.',
        ];

        $request->validate([
            'jumlah_keluar' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $inventaris = InventarisLabAnkeskimia::findOrFail($request->id_barang);
                    $satuan = $inventaris->satuan;

                    if (in_array($satuan, ['pcs', 'lembar'])) {
                        if (strpos($value, '.') !== false) {
                            $fail('Jumlah keluar tidak boleh mengandung angka desimal untuk satuan "' . $satuan . '".');
                        }
                    }
                },
            ],
            'tanggal_keluar' => 'required|date',
            'keterangan_keluar' => 'required',
        ], $messages);

        $id_barang = $request->id_barang;
        $barang = InventarisLabAnkeskimia::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarAnkeskimia = new BarangKeluarAnkeskimia();
            $BarangKeluarAnkeskimia->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarAnkeskimia->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarAnkeskimia->keterangan_keluar = $request->keterangan_keluar;
            $BarangKeluarAnkeskimia->id_barang = $id_barang;
            $BarangKeluarAnkeskimia->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            // return redirect()->route('barangkeluarkoorlabAnkeskimia');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodankes'){
                    return redirect()->route('barangkeluarkoorlabankeskimia');
                } else{
                    return redirect()->route('barangkeluaradminlabankeskimia');
                }
            }
        }
    }
}
