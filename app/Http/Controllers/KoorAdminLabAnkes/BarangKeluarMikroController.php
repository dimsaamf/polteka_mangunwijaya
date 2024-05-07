<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabMikro;
use App\Models\BarangKeluarMikro;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BarangKeluarMikroController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabMikro::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labmikro.barangkeluar', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.barangkeluar', compact('data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.barangkeluar', compact('data'));
            }
        }
    }

    public function index(Request $request){
        // $BarangKeluarMikro = BarangKeluarMikro::paginate(10);
        // $data=InventarisLabMikro::all();
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

        $queryBuilder = BarangKeluarMikro::with('inventarislabmikro')
            ->whereHas('inventarislabmikro', function ($q) use ($query) {
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

        $BarangKeluarMikro = $queryBuilder->paginate(10);

        $data = InventarisLabMikro::all();
        // return view('rolekoorlabankes.contentkoorlab.labmikro.riwayatkeluar', compact('BarangKeluarMikro','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.riwayatkeluar', compact('BarangKeluarMikro','data'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.riwayatkeluar', compact('BarangKeluarMikro','data'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labmikro.barangkeluar');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.barangkeluar');
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.barangkeluar');
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
                    $inventaris = InventarisLabMikro::findOrFail($request->id_barang);
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
        $barang = InventarisLabMikro::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarMikro = new BarangKeluarMikro();
            $BarangKeluarMikro->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarMikro->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarMikro->keterangan_keluar = $request->keterangan_keluar;
            $BarangKeluarMikro->id_barang = $id_barang;
            $BarangKeluarMikro->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            // return redirect()->route('barangkeluarkoorlabMikro');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodankes'){
                    return redirect()->route('barangkeluarkoorlabmikro');
                } else{
                    return redirect()->route('barangkeluaradminlabmikro');
                }
            }
        }
    }
}
