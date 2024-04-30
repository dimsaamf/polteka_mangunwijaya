<?php

namespace App\Http\Controllers\AdminProdiFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisFarmasi;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\DNS2D;

class InventarisFarmasiController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $farmasi = InventarisFarmasi::query();
        
        if ($query) {
            $farmasi->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $farmasi = $farmasi->paginate(10);
        return view('roleadminprodifarmasi.contentadminprodi.databarang', compact('farmasi'));
    }

    public function create(){
        return view('roleadminprodifarmasi.contentadminprodi.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_farmasis',
        'jumlah'=>'required|integer',
        'satuan'=>'required|string|regex:/^[a-zA-Z\s]+$/',
        'is_alat' => 'nullable|boolean',
        'tanggal_service' => $request->filled('is_alat') && $request->input('is_alat') ? 'required|date' : '',
        'periode'=>'nullable|integer',
        'harga'=>'required|integer',
        'keterangan'=>'required',
        'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
    ], $messages);

    $thn = Carbon::now()->year;
    $var = 'F-FARM-KN-';
    $bms = InventarisFarmasi::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisFarmasi::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $farmasi = new InventarisFarmasi();
    $farmasi->nama_barang = $request->nama_barang;
    $farmasi->kode_barang = $kode_barang;
    $farmasi->jumlah = $request->jumlah;
    $farmasi->satuan = $request->satuan;
    $farmasi->tanggal_service = $request->tanggal_service;
    $farmasi->periode = $request->periode;
    $farmasi->harga = $request->harga;
    $farmasi->keterangan = $request->keterangan;
    $farmasi->reminder = $request->reminder;
    $farmasi['reminder'] = $request->filled('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $farmasi->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $farmasi->kode_barang;
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

        $farmasi->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        return redirect()->route('databarangadminprodifarmasi');
    }


    public function edit($id){
        $farmasi = InventarisFarmasi::findOrFail($id);
        return view('roleadminprodifarmasi.contentadminprodi.ubahbarang', compact('farmasi'));
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

        $farmasi = InventarisFarmasi::findOrFail($id);

        $isUpdated = false;
        if ($farmasi->nama_barang !== $request->nama_barang){
            $farmasi->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($farmasi->jumlah !== $request->jumlah){
            $farmasi->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($farmasi->satuan !== $request->satuan){
            $farmasi->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($farmasi->tanggal_service !== $request->tanggal_service){
            $farmasi->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($farmasi->periode !== $request->periode){
            $farmasi->periode = $request->periode;
            $isUpdated = true;
        }
        if ($farmasi->harga !== $request->harga){
            $farmasi->harga = $request->harga;
            $isUpdated = true;
        }
        if ($farmasi->keterangan !== $request->keterangan){
            $farmasi->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $farmasi->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            return redirect()->route('databarangadminprodifarmasi');
        }

        $farmasi->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        return redirect()->route('databarangadminprodifarmasi');
    }

    public function destroy($id)
    {
        $farmasi = InventarisFarmasi::findOrFail($id);
        $farmasi->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $farmasi =  InventarisFarmasi::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $farmasi->gambar);

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
public static function stokHampirHabis()
    {
        // Mengambil daftar barang yang stoknya kurang dari 20% dari jumlah awal atau jumlah terupdate
        $barangHampirHabis = InventarisFarmasi::select('id', 'nama_barang', 'jumlah')
            ->whereRaw('jumlah < jumlah_awal * 0.2') // Mengecek apakah stok kurang dari 20% dari jumlah awal
            ->orWhereRaw('jumlah < jumlah_masuk + (SELECT COALESCE(SUM(jumlah_keluar), 0) FROM barang_keluar_farmasis WHERE id_barang = inventaris_farmasis.id) * 0.2') // Mengecek apakah stok kurang dari 20% dari jumlah terupdate
            ->get();

        return $barangHampirHabis;
    }
}
