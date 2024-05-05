<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventarisLabfarmakognosi;
use App\Models\BarangKeluarFarmakognosi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BarangKeluarFarmakognosiController extends Controller
{
    public function tabel(Request $request){
        $query = $request->input('search');
        $data = InventarisLabFarmakognosi::query();
        
        if ($query) {
            $data->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $data = $data->paginate(10);
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangkeluar', compact('data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangkeluar', compact('data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.barangkeluar', compact('data'));
            }
        }
    }

    public function index(Request $request){
        // $BarangKeluarFarmakognosi = BarangKeluarFarmakognosi::paginate(10);
        // $data=InventarisLabFarmakognosi::all();
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

        $queryBuilder = BarangKeluarFarmakognosi::with('inventarislabfarmakognosi')
            ->whereHas('inventarislabfarmakognosi', function ($q) use ($query) {
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

        $BarangKeluarFarmakognosi = $queryBuilder->paginate(10);

        $data = InventarisLabFarmakognosi::all();

        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.riwayatkeluar', compact('barangkeluarfarmakognosi','data'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.riwayatkeluar', compact('BarangKeluarFarmakognosi','data'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.riwayatkeluar', compact('BarangKeluarFarmakognosi','data'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangkeluar');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.barangkeluar');
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmakognosi.barangkeluar');
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
                    $inventaris = InventarisLabFarmakognosi::findOrFail($request->id_barang);
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
        $barang = InventarisLabFarmakognosi::findOrFail($id_barang);

        $jumlah_awal = $barang->jumlah;
        $jumlah_keluar_baru = $request->jumlah_keluar;
        if( $jumlah_awal < $jumlah_keluar_baru ){
            alert()->error('Gagal','Jumlah Barang Melebihi Stok Barang.');
            return back();
            
        } else {
            $jumlah_akhir = $jumlah_awal - $jumlah_keluar_baru;
        
            $barang->jumlah = $jumlah_akhir;
            $barang->save();
            
            $BarangKeluarFarmakognosi = new BarangKeluarFarmakognosi();
            $BarangKeluarFarmakognosi->jumlah_keluar = $jumlah_keluar_baru;
            $BarangKeluarFarmakognosi->tanggal_keluar = $request->tanggal_keluar;
            $BarangKeluarFarmakognosi->keterangan_keluar = $request->keterangan_keluar;
            $BarangKeluarFarmakognosi->id_barang = $id_barang;
            $BarangKeluarFarmakognosi->save();

            alert()->success('Berhasil','Stok Barang Berhasil Dikurangi.');
            // return redirect()->route('barangkeluarkoorlabfarmakognosi');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodfarmasi'){
                    return redirect()->route('barangkeluarkoorlabfarmakognosi');
                } else{
                    return redirect()->route('barangkeluaradminlabfarmakognosi');
                }
            }
        }
    }
}
