<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabTekfarmasi;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabTekfarmasiController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labtekfarmasi = InventarisLabTekfarmasi::query();
        
        if ($query) {
            $labtekfarmasi->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labtekfarmasi = $labtekfarmasi->paginate(10);
        // return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.databarang', compact('labtekfarmasi'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.databarang', compact('labtekfarmasi'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.databarang', compact('labtekfarmasi'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.tambahbarang');
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.tambahbarang');
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
        'harga.required' => 'Harga harus diisi.',
        'gambar.image' => 'Gambar harus berupa gambar.',
        'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
    ];

    $request->validate([
        'nama_barang'=>'required|string|unique:inventaris_lab_tekfarmasis',
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
    $var = 'f-tek-fm-';
    $bms = InventarisLabTekfarmasi::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabTekfarmasi::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labtekfarmasi = new InventarisLabTekfarmasi();
    $labtekfarmasi->nama_barang = $request->nama_barang;
    $labtekfarmasi->kode_barang = $kode_barang;
    $labtekfarmasi->jumlah = $request->jumlah;
    $labtekfarmasi->jumlah_min = $request->jumlah_min;
    $labtekfarmasi->satuan = $request->satuan;
    $labtekfarmasi->tanggal_service = $request->tanggal_service;
    $labtekfarmasi->periode = $request->periode;
    $labtekfarmasi->harga = $request->harga;
    $labtekfarmasi->keterangan = $request->keterangan;
    $labtekfarmasi->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labtekfarmasi->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labtekfarmasi->kode_barang;
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

        $labtekfarmasi->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlabtekfarmasi');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('databarangkoorlabtekfarmasi');
            } else{
                return redirect()->route('databarangadminlabtekfarmasi');
            }
        }
    }


    public function edit($id){
        $labtekfarmasi = InventarisLabTekfarmasi::findOrFail($id);
        // return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.ubahbarang', compact('labtekfarmasi'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labtekfarmasi.ubahbarang', compact('labtekfarmasi'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labtekfarmasi.ubahbarang', compact('labtekfarmasi'));
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

        $labtekfarmasi = InventarisLabTekfarmasi::findOrFail($id);

        $isUpdated = false;
        if ($labtekfarmasi->nama_barang !== $request->nama_barang){
            $labtekfarmasi->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labtekfarmasi->jumlah !== $request->jumlah){
            $labtekfarmasi->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labtekfarmasi->jumlah_min !== $request->jumlah_min){
            $labtekfarmasi->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($labtekfarmasi->satuan !== $request->satuan){
            $labtekfarmasi->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labtekfarmasi->tanggal_service !== $request->tanggal_service){
            $labtekfarmasi->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labtekfarmasi->periode !== $request->periode){
            $labtekfarmasi->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labtekfarmasi->harga !== $request->harga){
            $labtekfarmasi->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labtekfarmasi->keterangan !== $request->keterangan){
            $labtekfarmasi->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labtekfarmasi->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlabtekfarmasi');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodfarmasi'){
                    return redirect()->route('databarangkoorlabtekfarmasi');
                } else{
                    return redirect()->route('databarangadminlabtekfarmasi');
                }
            }
        }

        $labtekfarmasi->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlabtekfarmasi');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('databarangkoorlabtekfarmasi');
            } else{
                return redirect()->route('databarangadminlabtekfarmasi');
            }
        }
    }

    public function destroy($id)
    {
        $labtekfarmasi = InventarisLabTekfarmasi::findOrFail($id);
        $labtekfarmasi->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labtekfarmasi =  InventarisLabTekfarmasi::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labtekfarmasi->gambar);

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
