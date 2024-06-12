<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabSitohisto;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabSitohistoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labsitohisto = InventarisLabSitohisto::query();
        
        if ($query) {
            $labsitohisto->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labsitohisto = $labsitohisto->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labsitohisto.databarang', compact('labsitohisto'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labsitohisto.databarang', compact('labsitohisto'));
            } else{
                return view('roleadminlabankes.contentadminlab.labsitohisto.databarang', compact('labsitohisto'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labsitohisto.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labsitohisto.tambahbarang');
            } else{
                return view('roleadminlabankes.contentadminlab.labsitohisto.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_lab_sitohistos',
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
    $var = 'A-SIT-';
    $bms = InventarisLabSitohisto::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabSitohisto::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labsitohisto = new InventarisLabSitohisto();
    $labsitohisto->nama_barang = $request->nama_barang;
    $labsitohisto->kode_barang = $kode_barang;
    $labsitohisto->jumlah = $request->jumlah;
    $labsitohisto->jumlah_min = $request->jumlah_min;
    $labsitohisto->satuan = $request->satuan;
    $labsitohisto->tanggal_service = $request->tanggal_service;
    $labsitohisto->periode = $request->periode;
    $labsitohisto->harga = $request->harga;
    $labsitohisto->keterangan = $request->keterangan;
    $labsitohisto->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labsitohisto->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labsitohisto->kode_barang;
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

        $labsitohisto->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlabsitohisto');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('databarangkoorlabsitohisto');
            } else{
                return redirect()->route('databarangadminlabsitohisto');
            }
        }
    }


    public function edit($id){
        $labsitohisto = InventarisLabSitohisto::findOrFail($id);
        // return view('rolekoorlabankes.contentkoorlab.labsitohisto.ubahbarang', compact('labsitohisto'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labsitohisto.ubahbarang', compact('labsitohisto'));
            } else{
                return view('roleadminlabankes.contentadminlab.labsitohisto.ubahbarang', compact('labsitohisto'));
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

        $labsitohisto = InventarisLabSitohisto::findOrFail($id);

        $isUpdated = false;
        if ($labsitohisto->nama_barang !== $request->nama_barang){
            $labsitohisto->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labsitohisto->jumlah !== $request->jumlah){
            $labsitohisto->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labsitohisto->jumlah_min !== $request->jumlah_min){
            $labsitohisto->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($labsitohisto->satuan !== $request->satuan){
            $labsitohisto->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labsitohisto->tanggal_service !== $request->tanggal_service){
            $labsitohisto->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labsitohisto->periode !== $request->periode){
            $labsitohisto->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labsitohisto->harga !== $request->harga){
            $labsitohisto->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labsitohisto->keterangan !== $request->keterangan){
            $labsitohisto->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labsitohisto->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlabsitohisto');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodankes'){
                    return redirect()->route('databarangkoorlabsitohisto');
                } else{
                    return redirect()->route('databarangadminlabsitohisto');
                }
            }
        }

        $labsitohisto->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlabsitohisto');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('databarangkoorlabsitohisto');
            } else{
                return redirect()->route('databarangadminlabsitohisto');
            }
        }
    }

    public function destroy($id)
    {
        $labsitohisto = InventarisLabSitohisto::findOrFail($id);
        $labsitohisto->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labsitohisto =  InventarisLabSitohisto::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labsitohisto->gambar);

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
