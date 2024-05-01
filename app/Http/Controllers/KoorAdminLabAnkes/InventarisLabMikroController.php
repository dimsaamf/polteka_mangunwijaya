<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabMikro;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabMikroController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labmikro = InventarisLabMikro::query();
        
        if ($query) {
            $labmikro->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labmikro = $labmikro->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labmikro.databarang', compact('labmikro'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.databarang', compact('labmikro'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.databarang', compact('labmikro'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labmikro.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.tambahbarang');
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_lab_mikros',
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
    $var = 'A-KIM-';
    $bms = InventarisLabMikro::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabMikro::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labmikro = new InventarisLabMikro();
    $labmikro->nama_barang = $request->nama_barang;
    $labmikro->kode_barang = $kode_barang;
    $labmikro->jumlah = $request->jumlah;
    $labmikro->jumlah_min = $request->jumlah_min;
    $labmikro->satuan = $request->satuan;
    $labmikro->tanggal_service = $request->tanggal_service;
    $labmikro->periode = $request->periode;
    $labmikro->harga = $request->harga;
    $labmikro->keterangan = $request->keterangan;
    $labmikro->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labmikro->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labmikro->kode_barang;
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

        $labmikro->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlabmikro');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('databarangkoorlabmikro');
            } else{
                return redirect()->route('databarangadminlabmikro');
            }
        }
    }


    public function edit($id){
        $labmikro = InventarisLabMikro::findOrFail($id);
        // return view('rolekoorlabankes.contentkoorlab.labmikro.ubahbarang', compact('labmikro'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labmikro.ubahbarang', compact('labmikro'));
            } else{
                return view('roleadminlabankes.contentadminlab.labmikro.ubahbarang', compact('labmikro'));
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

        $labmikro = InventarisLabMikro::findOrFail($id);

        $isUpdated = false;
        if ($labmikro->nama_barang !== $request->nama_barang){
            $labmikro->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labmikro->jumlah !== $request->jumlah){
            $labmikro->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labmikro->jumlah_min !== $request->jumlah_min){
            $labmikro->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($labmikro->satuan !== $request->satuan){
            $labmikro->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labmikro->tanggal_service !== $request->tanggal_service){
            $labmikro->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labmikro->periode !== $request->periode){
            $labmikro->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labmikro->harga !== $request->harga){
            $labmikro->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labmikro->keterangan !== $request->keterangan){
            $labmikro->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labmikro->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlabmikro');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodankes'){
                    return redirect()->route('databarangkoorlabmikro');
                } else{
                    return redirect()->route('databarangadminlabmikro');
                }
            }
        }

        $labmikro->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlabmikro');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('databarangkoorlabmikro');
            } else{
                return redirect()->route('databarangadminlabmikro');
            }
        }
    }

    public function destroy($id)
    {
        $labmikro = InventarisLabMikro::findOrFail($id);
        $labmikro->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labmikro =  InventarisLabMikro::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labmikro->gambar);

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
