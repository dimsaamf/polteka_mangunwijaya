<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabKimia;
use Milon\Barcode\DNS2D;

class InventarisLabKimiaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labkimia = InventarisLabKimia::query();
        
        if ($query) {
            $labkimia->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labkimia = $labkimia->paginate(10);
        return view('rolekoorlabfarmasi.contentkoorlab.labkimia.databarang', compact('labkimia'));
    }

    public function create(){
        return view('rolekoorlabfarmasi.contentkoorlab.labkimia.tambahbarang');
    }

public function store(Request $request)
{
    $messages = [
        'nama_barang.required' => 'Nama barang harus diisi.',
        'nama_barang.unique' => 'Nama barang sudah digunakan.',
        'jumlah.required' => 'Jumlah harus diisi.',
        'satuan.required' => 'Satuan harus diisi.',
        'satuan.regex' => 'Satuan hanya boleh berisi huruf.',
        'harga.required' => 'Harga harus dipilih.',
        'keterangan.required' => 'Keterangan harus diisi.',
        'gambar.image' => 'Gambar harus berupa gambar.',
        'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
    ];

    $request->validate([
        'nama_barang'=>'required|string|unique:inventaris_lab_kimias',
        'jumlah'=>'required|integer',
        'satuan'=>'required|string|regex:/^[a-zA-Z\s]+$/',
        'tanggal_service'=>'nullable|date',
        'periode'=>'nullable|integer',
        'harga'=>'required|integer',
        'keterangan'=>'required',
        'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
    ], $messages);

    $thn = Carbon::now()->year;
    $var = 'F-FARM-ST-';
    $bms = InventarisLabKimia::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabKimia::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labkimia = new InventarisLabKimia();
    $labkimia->nama_barang = $request->nama_barang;
    $labkimia->kode_barang = $kode_barang;
    $labkimia->jumlah = $request->jumlah;
    $labkimia->satuan = $request->satuan;
    $labkimia->tanggal_service = $request->tanggal_service;
    $labkimia->periode = $request->periode;
    $labkimia->harga = $request->harga;
    $labkimia->keterangan = $request->keterangan;
    $labkimia->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labkimia->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labkimia->kode_barang;
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

        $labkimia->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        return redirect()->route('databarangkoorlabfarmasikimia');
    }


    public function edit($id){
        $labkimia = InventarisLabKimia::findOrFail($id);
        return view('rolekoorlabfarmasi.contentkoorlab.labkimia.ubahbarang', compact('labkimia'));
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
            'satuan'=>'required|string|regex:/^[a-zA-Z\s]+$/',
            'tanggal_service'=>'nullable|date',
            'periode'=>'nullable|integer',
            'harga'=>'required|integer',
            'keterangan'=>'required',
            'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
        ], $messages);

        $labkimia = InventarisLabKimia::findOrFail($id);

        $isUpdated = false;
        if ($labkimia->nama_barang !== $request->nama_barang){
            $labkimia->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labkimia->jumlah !== $request->jumlah){
            $labkimia->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labkimia->satuan !== $request->satuan){
            $labkimia->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labkimia->tanggal_service !== $request->tanggal_service){
            $labkimia->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labkimia->periode !== $request->periode){
            $labkimia->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labkimia->harga !== $request->harga){
            $labkimia->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labkimia->keterangan !== $request->keterangan){
            $labkimia->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labkimia->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            return redirect()->route('databarangkoorlabfarmasikimia');
        }

        $labkimia->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        return redirect()->route('databarangkoorlabfarmasikimia');
    }

    public function destroy($id)
    {
        $labkimia = InventarisLabKimia::findOrFail($id);
        $labkimia->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labkimia =  InventarisLabKimia::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labkimia->gambar);

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
