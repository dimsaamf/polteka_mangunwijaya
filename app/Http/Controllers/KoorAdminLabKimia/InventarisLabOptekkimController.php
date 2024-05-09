<?php

namespace App\Http\Controllers\KoorAdminLabKimia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabOptekkim;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabOptekkimController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $laboptekkim = InventarisLabOptekkim::query();
        
        if ($query) {
            $laboptekkim->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $laboptekkim = $laboptekkim->paginate(10);
        // return view('rolekoorlabkimia.contentkoorlab.laboptekkim.databarang', compact('laboptekkim'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.laboptekkim.databarang', compact('laboptekkim'));
            } else{
                return view('roleadminlabkimia.contentadminlab.laboptekkim.databarang', compact('laboptekkim'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabkimia.contentkoorlab.laboptekkim.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.laboptekkim.tambahbarang');
            } else{
                return view('roleadminlabkimia.contentadminlab.laboptekkim.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_lab_optekkims',
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
    $var = 'K-OPT-KI-';
    $bms = InventarisLabOptekkim::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabOptekkim::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $laboptekkim = new InventarisLabOptekkim();
    $laboptekkim->nama_barang = $request->nama_barang;
    $laboptekkim->kode_barang = $kode_barang;
    $laboptekkim->jumlah = $request->jumlah;
    $laboptekkim->jumlah_min = $request->jumlah_min;
    $laboptekkim->satuan = $request->satuan;
    $laboptekkim->tanggal_service = $request->tanggal_service;
    $laboptekkim->periode = $request->periode;
    $laboptekkim->harga = $request->harga;
    $laboptekkim->keterangan = $request->keterangan;
    $laboptekkim->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $laboptekkim->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $laboptekkim->kode_barang;
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

        $laboptekkim->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlaboptekkim');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('databarangkoorlaboptekkim');
            } else{
                return redirect()->route('databarangadminlaboptekkim');
            }
        }
    }


    public function edit($id){
        $laboptekkim = InventarisLabOptekkim::findOrFail($id);
        // return view('rolekoorlabkimia.contentkoorlab.laboptekkim.ubahbarang', compact('laboptekkim'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.laboptekkim.ubahbarang', compact('laboptekkim'));
            } else{
                return view('roleadminlabkimia.contentadminlab.laboptekkim.ubahbarang', compact('laboptekkim'));
            }
        }
    }

    public function update(Request $request, $id) {
        $messages = [
            'nama_barang.unique' => 'Nama barang sudah digunakan.',
            'satuan.regex' => 'Satuan hanya boleh berisi huruf.',
            'jumlah.min' => 'Jumlah tidak boleh bilangan negatif.',
            'jumlah_min.min' => 'Jumlah Minimal tidak boleh bilangan negatif.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah_min.numeric' => 'Jumlah Minimal harus berupa angka.',
            'jumlah_min.integer' => 'Jumlah Minimal harus berupa angka.',
            'gambar.image' => 'Gambar harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
        ];

        $request->validate([
            'nama_barang'=>'required|string',
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
            'satuan'=>'required|in:ml,gr,pcs,lembar',
            'tanggal_service'=>'nullable|date',
            'periode'=>'nullable|integer',
            'harga'=>'required|integer',
            'keterangan'=>'nullable',
            'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
        ], $messages);

        $laboptekkim = InventarisLabOptekkim::findOrFail($id);

        $isUpdated = false;
        if ($laboptekkim->nama_barang !== $request->nama_barang){
            $laboptekkim->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($laboptekkim->jumlah !== $request->jumlah){
            $laboptekkim->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($laboptekkim->jumlah_min !== $request->jumlah_min){
            $laboptekkim->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($laboptekkim->satuan !== $request->satuan){
            $laboptekkim->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($laboptekkim->tanggal_service !== $request->tanggal_service){
            $laboptekkim->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($laboptekkim->periode !== $request->periode){
            $laboptekkim->periode = $request->periode;
            $isUpdated = true;
        }
        if ($laboptekkim->harga !== $request->harga){
            $laboptekkim->harga = $request->harga;
            $isUpdated = true;
        }
        if ($laboptekkim->keterangan !== $request->keterangan){
            $laboptekkim->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $laboptekkim->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlaboptekkim');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodkimia'){
                    return redirect()->route('databarangkoorlaboptekkim');
                } else{
                    return redirect()->route('databarangadminlaboptekkim');
                }
            }
        }

        $laboptekkim->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlaboptekkim');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('databarangkoorlaboptekkim');
            } else{
                return redirect()->route('databarangadminlaboptekkim');
            }
        }
    }

    public function destroy($id)
    {
        $laboptekkim = InventarisLabOptekkim::findOrFail($id);
        $laboptekkim->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $laboptekkim =  InventarisLabOptekkim::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $laboptekkim->gambar);

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
