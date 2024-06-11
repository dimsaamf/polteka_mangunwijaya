<?php

namespace App\Http\Controllers\KoorAdminLabkimia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabKimiaAnalisa;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabKimiaAnalisaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labkimiaanalisa = InventarisLabKimiaAnalisa::query();
        
        if ($query) {
            $labkimiaanalisa->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labkimiaanalisa = $labkimiaanalisa->paginate(10);
        // return view('rolekoorlabkimia.contentkoorlab.labkimiaanalisa.databarang', compact('labkimiaanalisa'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labkimiaanalisa.databarang', compact('labkimiaanalisa'));
            } else{
                return view('roleadminlabkimia.contentadminlab.labkimiaanalisa.databarang', compact('labkimiaanalisa'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabkimia.contentkoorlab.labkimiaanalisa.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labkimiaanalisa.tambahbarang');
            } else{
                return view('roleadminlabkimia.contentadminlab.labkimiaanalisa.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_lab_kimia_analisas',
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
    $var = 'k-kim-an-';
    $bms = InventarisLabKimiaAnalisa::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabKimiaAnalisa::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labkimiaanalisa = new InventarisLabKimiaAnalisa();
    $labkimiaanalisa->nama_barang = $request->nama_barang;
    $labkimiaanalisa->kode_barang = $kode_barang;
    $labkimiaanalisa->jumlah = $request->jumlah;
    $labkimiaanalisa->jumlah_min = $request->jumlah_min;
    $labkimiaanalisa->satuan = $request->satuan;
    $labkimiaanalisa->tanggal_service = $request->tanggal_service;
    $labkimiaanalisa->periode = $request->periode;
    $labkimiaanalisa->harga = $request->harga;
    $labkimiaanalisa->keterangan = $request->keterangan;
    $labkimiaanalisa->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labkimiaanalisa->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labkimiaanalisa->kode_barang;
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

        $labkimiaanalisa->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlabkimiaanalisa');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('databarangkoorlabkimiaanalisa');
            } else{
                return redirect()->route('databarangadminlabkimiaanalisa');
            }
        }
    }


    public function edit($id){
        $labkimiaanalisa = InventarisLabKimiaAnalisa::findOrFail($id);
        // return view('rolekoorlabkimia.contentkoorlab.labkimiaanalisa.ubahbarang', compact('labkimiaanalisa'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labkimiaanalisa.ubahbarang', compact('labkimiaanalisa'));
            } else{
                return view('roleadminlabkimia.contentadminlab.labkimiaanalisa.ubahbarang', compact('labkimiaanalisa'));
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

        $labkimiaanalisa = InventarisLabKimiaAnalisa::findOrFail($id);

        $isUpdated = false;
        if ($labkimiaanalisa->nama_barang !== $request->nama_barang){
            $labkimiaanalisa->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labkimiaanalisa->jumlah !== $request->jumlah){
            $labkimiaanalisa->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labkimiaanalisa->jumlah_min !== $request->jumlah_min){
            $labkimiaanalisa->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($labkimiaanalisa->satuan !== $request->satuan){
            $labkimiaanalisa->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labkimiaanalisa->tanggal_service !== $request->tanggal_service){
            $labkimiaanalisa->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labkimiaanalisa->periode !== $request->periode){
            $labkimiaanalisa->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labkimiaanalisa->harga !== $request->harga){
            $labkimiaanalisa->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labkimiaanalisa->keterangan !== $request->keterangan){
            $labkimiaanalisa->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labkimiaanalisa->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlabkimiaanalisa');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodkimia'){
                    return redirect()->route('databarangkoorlabkimiaanalisa');
                } else{
                    return redirect()->route('databarangadminlabkimiaanalisa');
                }
            }
        }

        $labkimiaanalisa->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlabkimiaanalisa');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('databarangkoorlabkimiaanalisa');
            } else{
                return redirect()->route('databarangadminlabkimiaanalisa');
            }
        }
    }

    public function destroy($id)
    {
        $labkimiaanalisa = InventarisLabKimiaAnalisa::findOrFail($id);
        $labkimiaanalisa->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labkimiaanalisa =  InventarisLabKimiaAnalisa::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labkimiaanalisa->gambar);

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
