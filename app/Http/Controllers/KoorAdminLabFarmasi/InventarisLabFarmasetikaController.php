<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabfarmasetika;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabFarmasetikaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labfarmasetika = InventarisLabFarmasetika::query();
        
        if ($query) {
            $labfarmasetika->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labfarmasetika = $labfarmasetika->paginate(10);
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.databarang', compact('labfarmasetika'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.databarang', compact('labfarmasetika'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.databarang', compact('labfarmasetika'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.tambahbarang');
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_lab_farmasetikas',
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
    $var = 'F-FARM-ST-';
    $bms = InventarisLabFarmasetika::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabFarmasetika::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labfarmasetika = new InventarisLabFarmasetika();
    $labfarmasetika->nama_barang = $request->nama_barang;
    $labfarmasetika->kode_barang = $kode_barang;
    $labfarmasetika->jumlah = $request->jumlah;
    $labfarmasetika->jumlah_min = $request->jumlah_min;
    $labfarmasetika->satuan = $request->satuan;
    $labfarmasetika->tanggal_service = $request->tanggal_service;
    $labfarmasetika->periode = $request->periode;
    $labfarmasetika->harga = $request->harga;
    $labfarmasetika->keterangan = $request->keterangan;
    $labfarmasetika->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labfarmasetika->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labfarmasetika->kode_barang;
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

        $labfarmasetika->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlabfarmasetika');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('databarangkoorlabfarmasetika');
            } else{
                return redirect()->route('databarangadminlabfarmasetika');
            }
        }
    }


    public function edit($id){
        $labfarmasetika = InventarisLabFarmasetika::findOrFail($id);
        // return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.ubahbarang', compact('labfarmasetika'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return view('rolekoorlabfarmasi.contentkoorlab.labfarmasetika.ubahbarang', compact('labfarmasetika'));
            } else{
                return view('roleadminlabfarmasi.contentadminlab.labfarmasetika.ubahbarang', compact('labfarmasetika'));
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

        $labfarmasetika = InventarisLabFarmasetika::findOrFail($id);

        $isUpdated = false;
        if ($labfarmasetika->nama_barang !== $request->nama_barang){
            $labfarmasetika->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labfarmasetika->jumlah !== $request->jumlah){
            $labfarmasetika->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labfarmasetika->jumlah_min !== $request->jumlah_min){
            $labfarmasetika->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($labfarmasetika->satuan !== $request->satuan){
            $labfarmasetika->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labfarmasetika->tanggal_service !== $request->tanggal_service){
            $labfarmasetika->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labfarmasetika->periode !== $request->periode){
            $labfarmasetika->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labfarmasetika->harga !== $request->harga){
            $labfarmasetika->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labfarmasetika->keterangan !== $request->keterangan){
            $labfarmasetika->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labfarmasetika->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlabfarmasetika');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodfarmasi'){
                    return redirect()->route('databarangkoorlabfarmasetika');
                } else{
                    return redirect()->route('databarangadminlabfarmasetika');
                }
            }
        }

        $labfarmasetika->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlabfarmasetika');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodfarmasi'){
                return redirect()->route('databarangkoorlabfarmasetika');
            } else{
                return redirect()->route('databarangadminlabfarmasetika');
            }
        }
    }

    public function destroy($id)
    {
        $labfarmasetika = InventarisLabFarmasetika::findOrFail($id);
        $labfarmasetika->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labfarmasetika =  InventarisLabFarmasetika::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labfarmasetika->gambar);

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
