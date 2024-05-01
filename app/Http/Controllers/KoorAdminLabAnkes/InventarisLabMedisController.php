<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabMedis;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabMedisController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labmedis = InventarisLabMedis::query();
        
        if ($query) {
            $labmedis->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labmedis = $labmedis->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labmedis.databarang', compact('labmedis'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmedis.databarang', compact('labmedis'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmedis.databarang', compact('labmedis'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labmedis.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmedis.tambahbarang');
            } else{
                return view('roleadminlabankes.contentadminlab.labmedis.tambahbarang');
            }
        }
    }

public function store(Request $request)
{
    $messages = [
        'nama_barang.required' => 'Nama barang harus diisi.',
        'nama_barang.unique' => 'Nama barang sudah digunakan.',
        'jumlah.required' => 'Jumlah harus diisi.',
        'jumlah_min.required' => 'Minimal jumlah harus diisi.',
        'satuan.required' => 'Satuan harus diisi.',
        'satuan.regex' => 'Satuan hanya boleh berisi huruf.',
        'harga.required' => 'Harga harus dipilih.',
        'gambar.image' => 'Gambar harus berupa gambar.',
        'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
    ];

    $request->validate([
        'nama_barang'=>'required|string|unique:inventaris_lab_medis',
        'jumlah'=>'required|integer',
        'jumlah_min'=>'required|integer',
        'satuan'=>'required|string|regex:/^[a-zA-Z\s]+$/',
        'tanggal_service'=>'nullable|date',
        'periode'=>'nullable|integer',
        'harga'=>'required|integer',
        'keterangan'=>'nullable',
        'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
    ], $messages);

    $thn = Carbon::now()->year;
    $var = 'A-MED-';
    $bms = InventarisLabMedis::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabMedis::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labmedis = new InventarisLabMedis();
    $labmedis->nama_barang = $request->nama_barang;
    $labmedis->kode_barang = $kode_barang;
    $labmedis->jumlah = $request->jumlah;
    $labmedis->jumlah_min = $request->jumlah_min;
    $labmedis->satuan = $request->satuan;
    $labmedis->tanggal_service = $request->tanggal_service;
    $labmedis->periode = $request->periode;
    $labmedis->harga = $request->harga;
    $labmedis->keterangan = $request->keterangan;
    $labmedis->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labmedis->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labmedis->kode_barang;
    $barcodeStorageDirectory = storage_path('app/public/barcodes');
    $barcodePublicDirectory = 'public/barcodes';
    $barcodePath = $barcodePublicDirectory . '/' . $barcodeContent . '.png';

    if (!Storage::exists($barcodePath)) {
        if (!Storage::exists($barcodeStorageDirectory)) {
            Storage::makeDirectory($barcodeStorageDirectory, 0777, true);
        }
        $barcode = new DNS2D();
        $barcode->setStorPath($barcodeStorageDirectory);
        $barcode->getBarcodePNGPath($barcodeContent, 'QRCODE', 3, 3, array(0, 0, 0), true, $barcodeContent);
    }

        $labmedis->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlabmedis');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('databarangkoorlabmedis');
            } else{
                return redirect()->route('databarangadminlabmedis');
            }
        }
    }


    public function edit($id){
        $labmedis = InventarisLabMedis::findOrFail($id);
        // return view('rolekoorlabankes.contentkoorlab.labmedis.ubahbarang', compact('labmedis'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmedis.ubahbarang', compact('labmedis'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmedis.ubahbarang', compact('labmedis'));
            }
        }
    }

    public function update(Request $request, $id) {
        $messages = [
            'nama_barang.unique' => 'Nama barang sudah digunakan.',
            'satuan.regex' => 'Satuan hanya boleh berisi huruf.',
            'gambar.image' => 'Gambar harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
        ];

        $request->validate([
            'nama_barang'=>'required|string',
            'jumlah'=>'required|integer',
            'jumlah_min'=>'required|integer',
            'satuan'=>'required|string|regex:/^[a-zA-Z\s]+$/',
            'tanggal_service'=>'nullable|date',
            'periode'=>'nullable|integer',
            'harga'=>'required|integer',
            'keterangan'=>'nullable',
            'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
        ], $messages);

        $labmedis = InventarisLabMedis::findOrFail($id);

        $isUpdated = false;
        if ($labmedis->nama_barang !== $request->nama_barang){
            $labmedis->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labmedis->jumlah !== $request->jumlah){
            $labmedis->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labmedis->jumlah_min !== $request->jumlah_min){
            $labmedis->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($labmedis->satuan !== $request->satuan){
            $labmedis->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labmedis->tanggal_service !== $request->tanggal_service){
            $labmedis->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labmedis->periode !== $request->periode){
            $labmedis->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labmedis->harga !== $request->harga){
            $labmedis->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labmedis->keterangan !== $request->keterangan){
            $labmedis->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labmedis->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlabmedis');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodankes'){
                    return redirect()->route('databarangkoorlabmedis');
                } else{
                    return redirect()->route('databarangadminlabmedis');
                }
            }
        }

        $labmedis->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlabmedis');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('databarangkoorlabmedis');
            } else{
                return redirect()->route('databarangadminlabmedis');
            }
        }
    }

    public function destroy($id)
    {
        $labmedis = InventarisLabMedis::findOrFail($id);
        $labmedis->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labmedis =  InventarisLabMedis::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labmedis->gambar);

    if (file_exists($gambarPath)) {
        $extension = pathinfo($gambarPath, PATHINFO_EXTENSION);
        $contentType = '';
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $contentType = 'image/jpeg';
                break;
            case 'png':
                $contentType = 'image/png';
                break;
            default:
                return response()->json(['error' => 'Tipe file tidak didukung'], 404);
        }

        $gambarContent = file_get_contents($gambarPath);

        $headers = [
            'Content-Type' => $contentType,
        ];

        return response($gambarContent, 200, $headers);
    } else {
        return response()->json(['error' => 'File gambar tidak ditemukan'], 404);
    }
}
}