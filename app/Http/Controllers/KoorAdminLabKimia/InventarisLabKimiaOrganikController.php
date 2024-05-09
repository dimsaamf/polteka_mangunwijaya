<?php

namespace App\Http\Controllers\KoorAdminLabkimia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabKimiaOrganik;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabKimiaOrganikController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labkimiaorganik = InventarisLabKimiaOrganik::query();
        
        if ($query) {
            $labkimiaorganik->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labkimiaorganik = $labkimiaorganik->paginate(10);
        // return view('rolekoorlabkimia.contentkoorlab.labkimiaorganik.databarang', compact('labkimiaorganik'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labkimiaorganik.databarang', compact('labkimiaorganik'));
            } else{
                return view('roleadminlabkimia.contentadminlab.labkimiaorganik.databarang', compact('labkimiaorganik'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabkimia.contentkoorlab.labkimiaorganik.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labkimiaorganik.tambahbarang');
            } else{
                return view('roleadminlabkimia.contentadminlab.labkimiaorganik.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_lab_kimia_organiks',
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
    $var = 'K-KIM-OR-';
    $bms = InventarisLabKimiaOrganik::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabKimiaOrganik::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labkimiaorganik = new InventarisLabKimiaOrganik();
    $labkimiaorganik->nama_barang = $request->nama_barang;
    $labkimiaorganik->kode_barang = $kode_barang;
    $labkimiaorganik->jumlah = $request->jumlah;
    $labkimiaorganik->jumlah_min = $request->jumlah_min;
    $labkimiaorganik->satuan = $request->satuan;
    $labkimiaorganik->tanggal_service = $request->tanggal_service;
    $labkimiaorganik->periode = $request->periode;
    $labkimiaorganik->harga = $request->harga;
    $labkimiaorganik->keterangan = $request->keterangan;
    $labkimiaorganik->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labkimiaorganik->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labkimiaorganik->kode_barang;
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

        $labkimiaorganik->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlabkimiaorganik');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('databarangkoorlabkimiaorganik');
            } else{
                return redirect()->route('databarangadminlabkimiaorganik');
            }
        }
    }


    public function edit($id){
        $labkimiaorganik = InventarisLabKimiaOrganik::findOrFail($id);
        // return view('rolekoorlabkimia.contentkoorlab.labkimiaorganik.ubahbarang', compact('labkimiaorganik'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labkimiaorganik.ubahbarang', compact('labkimiaorganik'));
            } else{
                return view('roleadminlabkimia.contentadminlab.labkimiaorganik.ubahbarang', compact('labkimiaorganik'));
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

        $labkimiaorganik = InventarisLabKimiaOrganik::findOrFail($id);

        $isUpdated = false;
        if ($labkimiaorganik->nama_barang !== $request->nama_barang){
            $labkimiaorganik->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labkimiaorganik->jumlah !== $request->jumlah){
            $labkimiaorganik->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labkimiaorganik->jumlah_min !== $request->jumlah_min){
            $labkimiaorganik->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($labkimiaorganik->satuan !== $request->satuan){
            $labkimiaorganik->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labkimiaorganik->tanggal_service !== $request->tanggal_service){
            $labkimiaorganik->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labkimiaorganik->periode !== $request->periode){
            $labkimiaorganik->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labkimiaorganik->harga !== $request->harga){
            $labkimiaorganik->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labkimiaorganik->keterangan !== $request->keterangan){
            $labkimiaorganik->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labkimiaorganik->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlabkimiaorganik');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodkimia'){
                    return redirect()->route('databarangkoorlabkimiaorganik');
                } else{
                    return redirect()->route('databarangadminlabkimiaorganik');
                }
            }
        }

        $labkimiaorganik->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlabkimiaorganik');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('databarangkoorlabkimiaorganik');
            } else{
                return redirect()->route('databarangadminlabkimiaorganik');
            }
        }
    }

    public function destroy($id)
    {
        $labkimiaorganik = InventarisLabKimiaOrganik::findOrFail($id);
        $labkimiaorganik->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labkimiaorganik =  InventarisLabKimiaOrganik::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labkimiaorganik->gambar);

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
