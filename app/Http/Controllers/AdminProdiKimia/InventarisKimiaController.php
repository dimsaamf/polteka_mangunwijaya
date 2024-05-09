<?php

namespace App\Http\Controllers\AdminProdiKimia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisKimia;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\DNS2D;

class InventarisKimiaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $kimia = InventarisKimia::query();
        
        if ($query) {
            $kimia->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $kimia = $kimia->paginate(10);
        return view('roleadminprodikimia.contentadminprodi.databarang', compact('kimia'));
    }

    public function create(){
        return view('roleadminprodikimia.contentadminprodi.tambahbarang');
    }

public function store(Request $request)
{
    $messages = [
        'nama_barang.required' => 'Nama barang harus diisi.',
        'nama_barang.unique' => 'Nama barang sudah digunakan.',
        'jumlah.required' => 'Jumlah harus diisi.',
        'jumlah_min.required' => 'Minimal jumlah harus diisi.',
        'jumlah.min' => 'Jumlah tidak boleh bilangan negatif.',
        'jumlah_min.min' => 'Jumlah Minimal tidak boleh bilangan negatif.',
        'jumlah.numeric' => 'Jumlah harus berupa angka.',
        'jumlah.integer' => 'Jumlah harus berupa angka.',
        'jumlah_min.numeric' => 'Jumlah Minimal harus berupa angka.',
        'jumlah_min.integer' => 'Jumlah Minimal harus berupa angka.',
        'satuan.required' => 'Satuan harus diisi.',
        'harga.required' => 'Harga harus dipilih.',
        'gambar.image' => 'Gambar harus berupa gambar.',
        'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
    ];

    $request->validate([
        'nama_barang'=>'required|string|unique:inventaris_kimias',
        'jumlah' => [
            'required',
            'numeric',
            'min:0',
            function ($attribute, $value, $fail) use ($request) {
                if (in_array($request->satuan, ['pcs', 'lembar']) && !preg_match('/^\d+$/', $value)) {
                    $fail('Jumlah tidak boleh desimal jika satuan adalah "pcs" atau "lembar".');
                }
            },
        ],
        'jumlah_min' => [
            'required',
            'numeric',
            'min:0',
            function ($attribute, $value, $fail) use ($request) {
                if (in_array($request->satuan, ['pcs', 'lembar']) && !preg_match('/^\d+$/', $value)) {
                    $fail('Jumlah Minimal tidak boleh desimal jika satuan adalah "pcs" atau "lembar".');
                }
            },
        ],
        'satuan' => 'required|in:ml,gr,pcs,lembar',
        'tanggal_service'=>'nullable|date',
        'periode'=>'nullable|integer',
        'harga'=>'required|integer',
        'keterangan'=>'nullable',
        'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
    ], $messages);

    $thn = Carbon::now()->year;
    $var = 'KIM-';
    $bms = InventarisKimia::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisKimia::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $kimia = new InventarisKimia();
    $kimia->nama_barang = $request->nama_barang;
    $kimia->kode_barang = $kode_barang;
    $kimia->jumlah = $request->jumlah;
    $kimia->jumlah_min = $request->jumlah_min;
    $kimia->satuan = $request->satuan;
    $kimia->tanggal_service = $request->tanggal_service;
    $kimia->periode = $request->periode;
    $kimia->harga = $request->harga;
    $kimia->keterangan = $request->keterangan;
    $kimia->reminder = $request->reminder;
    $kimia['reminder'] = $request->filled('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $kimia->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $kimia->kode_barang;
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

        $kimia->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        return redirect()->route('databarangadminprodikimia');
    }


    public function edit($id){
        $kimia = InventarisKimia::findOrFail($id);
        return view('roleadminprodikimia.contentadminprodi.ubahbarang', compact('kimia'));
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

        $kimia = InventarisKimia::findOrFail($id);

        $isUpdated = false;
        if ($kimia->nama_barang !== $request->nama_barang){
            $kimia->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($kimia->jumlah !== $request->jumlah){
            $kimia->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($kimia->satuan !== $request->satuan){
            $kimia->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($kimia->jumlah_min !== $request->jumlah_min){
            $kimia->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($kimia->tanggal_service !== $request->tanggal_service){
            $kimia->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($kimia->periode !== $request->periode){
            $kimia->periode = $request->periode;
            $isUpdated = true;
        }
        if ($kimia->harga !== $request->harga){
            $kimia->harga = $request->harga;
            $isUpdated = true;
        }
        if ($kimia->keterangan !== $request->keterangan){
            $kimia->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $kimia->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            return redirect()->route('databarangadminprodikimia');
        } 

        $kimia->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        return redirect()->route('databarangadminprodikimia');
    }

    public function destroy($id)
    {
        $kimia = InventarisKimia::findOrFail($id);
        $kimia->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $kimia =  InventarisKimia::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $kimia->gambar);

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
