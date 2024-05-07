<?php

namespace App\Http\Controllers\AdminProdiAnkes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisAnkes;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\DNS2D;

class InventarisAnkesController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $ankes = InventarisAnkes::query();
        
        if ($query) {
            $ankes->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $ankes = $ankes->paginate(10);
        return view('roleadminprodiankes.contentadminprodi.databarang', compact('ankes'));
    }

    public function create(){
        return view('roleadminprodiankes.contentadminprodi.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_ankes',
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
    $var = 'ANKE-';
    $bms = InventarisAnkes::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisAnkes::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $ankes = new InventarisAnkes();
    $ankes->nama_barang = $request->nama_barang;
    $ankes->kode_barang = $kode_barang;
    $ankes->jumlah = $request->jumlah;
    $ankes->jumlah_min = $request->jumlah_min;
    $ankes->satuan = $request->satuan;
    $ankes->tanggal_service = $request->tanggal_service;
    $ankes->periode = $request->periode;
    $ankes->harga = $request->harga;
    $ankes->keterangan = $request->keterangan;
    $ankes->reminder = $request->reminder;
    $ankes['reminder'] = $request->filled('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $ankes->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $ankes->kode_barang;
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

        $ankes->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        return redirect()->route('databarangadminprodiankes');
    }


    public function edit($id){
        $ankes = InventarisAnkes::findOrFail($id);
        return view('roleadminprodiankes.contentadminprodi.ubahbarang', compact('ankes'));
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

        $ankes = InventarisAnkes::findOrFail($id);

        $isUpdated = false;
        if ($ankes->nama_barang !== $request->nama_barang){
            $ankes->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($ankes->jumlah !== $request->jumlah){
            $ankes->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($ankes->satuan !== $request->satuan){
            $ankes->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($ankes->jumlah_min !== $request->jumlah_min){
            $ankes->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($ankes->tanggal_service !== $request->tanggal_service){
            $ankes->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($ankes->periode !== $request->periode){
            $ankes->periode = $request->periode;
            $isUpdated = true;
        }
        if ($ankes->harga !== $request->harga){
            $ankes->harga = $request->harga;
            $isUpdated = true;
        }
        if ($ankes->keterangan !== $request->keterangan){
            $ankes->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $ankes->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            return redirect()->route('databarangadminprodiankes');
        }

        $ankes->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        return redirect()->route('databarangadminprodiankes');
    }

    public function destroy($id)
    {
        $ankes = InventarisAnkes::findOrFail($id);
        $ankes->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $ankes =  InventarisAnkes::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $ankes->gambar);

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
