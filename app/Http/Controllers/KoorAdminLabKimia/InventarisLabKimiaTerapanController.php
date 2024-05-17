<?php

namespace App\Http\Controllers\KoorAdminLabkimia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabKimiaTerapan;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabKimiaTerapanController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labkimiaterapan = InventarisLabKimiaTerapan::query();
        
        if ($query) {
            $labkimiaterapan->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labkimiaterapan = $labkimiaterapan->paginate(10);
        // return view('rolekoorlabkimia.contentkoorlab.labkimiaterapan.databarang', compact('labkimiaterapan'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labkimiaterapan.databarang', compact('labkimiaterapan'));
            } else{
                return view('roleadminlabkimia.contentadminlab.labkimiaterapan.databarang', compact('labkimiaterapan'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabkimia.contentkoorlab.labkimiaterapan.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labkimiaterapan.tambahbarang');
            } else{
                return view('roleadminlabkimia.contentadminlab.labkimiaterapan.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_lab_kimia_terapans',
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
    $var = 'K-KIM-TR-';
    $bms = InventarisLabKimiaTerapan::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabKimiaTerapan::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labkimiaterapan = new InventarisLabKimiaTerapan();
    $labkimiaterapan->nama_barang = $request->nama_barang;
    $labkimiaterapan->kode_barang = $kode_barang;
    $labkimiaterapan->jumlah = $request->jumlah;
    $labkimiaterapan->jumlah_min = $request->jumlah_min;
    $labkimiaterapan->satuan = $request->satuan;
    $labkimiaterapan->tanggal_service = $request->tanggal_service;
    $labkimiaterapan->periode = $request->periode;
    $labkimiaterapan->harga = $request->harga;
    $labkimiaterapan->keterangan = $request->keterangan;
    $labkimiaterapan->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labkimiaterapan->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labkimiaterapan->kode_barang;
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

        $labkimiaterapan->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlabkimiaterapan');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('databarangkoorlabkimiaterapan');
            } else{
                return redirect()->route('databarangadminlabkimiaterapan');
            }
        }
    }


    public function edit($id){
        $labkimiaterapan = InventarisLabKimiaTerapan::findOrFail($id);
        // return view('rolekoorlabkimia.contentkoorlab.labkimiaterapan.ubahbarang', compact('labkimiaterapan'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labkimiaterapan.ubahbarang', compact('labkimiaterapan'));
            } else{
                return view('roleadminlabkimia.contentadminlab.labkimiaterapan.ubahbarang', compact('labkimiaterapan'));
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

        $labkimiaterapan = InventarisLabKimiaTerapan::findOrFail($id);

        $isUpdated = false;
        if ($labkimiaterapan->nama_barang !== $request->nama_barang){
            $labkimiaterapan->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labkimiaterapan->jumlah !== $request->jumlah){
            $labkimiaterapan->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labkimiaterapan->jumlah_min !== $request->jumlah_min){
            $labkimiaterapan->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($labkimiaterapan->satuan !== $request->satuan){
            $labkimiaterapan->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labkimiaterapan->tanggal_service !== $request->tanggal_service){
            $labkimiaterapan->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labkimiaterapan->periode !== $request->periode){
            $labkimiaterapan->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labkimiaterapan->harga !== $request->harga){
            $labkimiaterapan->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labkimiaterapan->keterangan !== $request->keterangan){
            $labkimiaterapan->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labkimiaterapan->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlabkimiaterapan');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodkimia'){
                    return redirect()->route('databarangkoorlabkimiaterapan');
                } else{
                    return redirect()->route('databarangadminlabkimiaterapan');
                }
            }
        }

        $labkimiaterapan->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlabkimiaterapan');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('databarangkoorlabkimiaterapan');
            } else{
                return redirect()->route('databarangadminlabkimiaterapan');
            }
        }
    }

    public function destroy($id)
    {
        $labkimiaterapan = InventarisLabKimiaTerapan::findOrFail($id);
        $labkimiaterapan->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labkimiaterapan =  InventarisLabKimiaTerapan::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labkimiaterapan->gambar);

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
