<?php

namespace App\Http\Controllers\KoorAdminLabAnkes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabAnkeskimia;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabAnkeskimiaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labankeskimia = InventarisLabAnkeskimia::query();
        
        if ($query) {
            $labankeskimia->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labankeskimia = $labankeskimia->paginate(10);
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.databarang', compact('labankeskimia'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.databarang', compact('labankeskimia'));
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.databarang', compact('labankeskimia'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.tambahbarang');
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_labankeskimias',
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
    $var = 'A-KIM-';
    $bms = InventarisLabAnkeskimia::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabAnkeskimia::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labankeskimia = new InventarisLabAnkeskimia();
    $labankeskimia->nama_barang = $request->nama_barang;
    $labankeskimia->kode_barang = $kode_barang;
    $labankeskimia->jumlah = $request->jumlah;
    $labankeskimia->jumlah_min = $request->jumlah_min;
    $labankeskimia->satuan = $request->satuan;
    $labankeskimia->tanggal_service = $request->tanggal_service;
    $labankeskimia->periode = $request->periode;
    $labankeskimia->harga = $request->harga;
    $labankeskimia->keterangan = $request->keterangan;
    $labankeskimia->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labankeskimia->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labankeskimia->kode_barang;
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

        $labankeskimia->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlabankeskimia');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('databarangkoorlabankeskimia');
            } else{
                return redirect()->route('databarangadminlabankeskimia');
            }
        }
    }


    public function edit($id){
        $labankeskimia = InventarisLabAnkeskimia::findOrFail($id);
        // return view('rolekoorlabankes.contentkoorlab.labankeskimia.ubahbarang', compact('labankeskimia'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return view('rolekoorlabankes.contentkoorlab.labankeskimia.ubahbarang', compact('labankeskimia'));
            } else{
                return view('roleadminlabankes.contentadminlab.labankeskimia.ubahbarang', compact('labankeskimia'));
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

        $labankeskimia = InventarisLabAnkeskimia::findOrFail($id);

        $isUpdated = false;
        if ($labankeskimia->nama_barang !== $request->nama_barang){
            $labankeskimia->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labankeskimia->jumlah !== $request->jumlah){
            $labankeskimia->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labankeskimia->jumlah_min !== $request->jumlah_min){
            $labankeskimia->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($labankeskimia->satuan !== $request->satuan){
            $labankeskimia->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labankeskimia->tanggal_service !== $request->tanggal_service){
            $labankeskimia->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labankeskimia->periode !== $request->periode){
            $labankeskimia->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labankeskimia->harga !== $request->harga){
            $labankeskimia->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labankeskimia->keterangan !== $request->keterangan){
            $labankeskimia->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labankeskimia->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlabankeskimia');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodankes'){
                    return redirect()->route('databarangkoorlabankeskimia');
                } else{
                    return redirect()->route('databarangadminlabankeskimia');
                }
            }
        }

        $labankeskimia->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlabankeskimia');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodankes'){
                return redirect()->route('databarangkoorlabankeskimia');
            } else{
                return redirect()->route('databarangadminlabankeskimia');
            }
        }
    }

    public function destroy($id)
    {
        $labankeskimia = InventarisLabAnkeskimia::findOrFail($id);
        $labankeskimia->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labankeskimia =  InventarisLabAnkeskimia::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labankeskimia->gambar);

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
