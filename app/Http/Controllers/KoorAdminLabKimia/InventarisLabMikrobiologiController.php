<?php

namespace App\Http\Controllers\KoorAdminLabKimia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\InventarisLabMikrobiologi;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;

class InventarisLabMikrobiologiController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $labmikrobiologi = InventarisLabMikrobiologi::query();
        
        if ($query) {
            $labmikrobiologi->where('nama_barang', 'like', '%' . $query . '%');
        }
        
        $labmikrobiologi = $labmikrobiologi->paginate(10);
        // return view('rolekoorlabkimia.contentkoorlab.labmikrobiologi.databarang', compact('labmikrobiologi'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labmikrobiologi.databarang', compact('labmikrobiologi'));
            } else{
                return view('roleadminlabkimia.contentadminlab.labmikrobiologi.databarang', compact('labmikrobiologi'));
            }
        }
    }

    public function create(){
        // return view('rolekoorlabkimia.contentkoorlab.labmikrobiologi.tambahbarang');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labmikrobiologi.tambahbarang');
            } else{
                return view('roleadminlabkimia.contentadminlab.labmikrobiologi.tambahbarang');
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
        'nama_barang'=>'required|string|unique:inventaris_lab_mikrobiologis',
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
    $var = 'k-mkr-bi-';
    $bms = InventarisLabMikrobiologi::count();
    if ($bms == 0) {
        $awal = 10001;
        $kode_barang = $var.$thn.$awal;
        // BM2021001
    } else {
        $last = InventarisLabMikrobiologi::latest()->first();
        $awal = (int)substr($last->kode_barang, -5) + 1;
        $kode_barang = $var.$thn.$awal;
    }

    $labmikrobiologi = new InventarisLabMikrobiologi();
    $labmikrobiologi->nama_barang = $request->nama_barang;
    $labmikrobiologi->kode_barang = $kode_barang;
    $labmikrobiologi->jumlah = $request->jumlah;
    $labmikrobiologi->jumlah_min = $request->jumlah_min;
    $labmikrobiologi->satuan = $request->satuan;
    $labmikrobiologi->tanggal_service = $request->tanggal_service;
    $labmikrobiologi->periode = $request->periode;
    $labmikrobiologi->harga = $request->harga;
    $labmikrobiologi->keterangan = $request->keterangan;
    $labmikrobiologi->reminder = $request->has('reminder');

    if ($request->hasFile('gambar')) {
        $gambarName = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->storeAs('public/gambars', $gambarName);
        $labmikrobiologi->gambar = $gambarName;
    }

    // Generate QR Code
    $barcodeContent = $labmikrobiologi->kode_barang;
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

        $labmikrobiologi->save();
        alert()->success('Berhasil', 'Barang Baru Berhasil Ditambahkan.');
        // return redirect()->route('databarangkoorlabmikrobiologi');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('databarangkoorlabmikrobiologi');
            } else{
                return redirect()->route('databarangadminlabmikrobiologi');
            }
        }
    }


    public function edit($id){
        $labmikrobiologi = InventarisLabMikrobiologi::findOrFail($id);
        // return view('rolekoorlabkimia.contentkoorlab.labmikrobiologi.ubahbarang', compact('labmikrobiologi'));
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return view('rolekoorlabkimia.contentkoorlab.labmikrobiologi.ubahbarang', compact('labmikrobiologi'));
            } else{
                return view('roleadminlabkimia.contentadminlab.labmikrobiologi.ubahbarang', compact('labmikrobiologi'));
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

        $labmikrobiologi = InventarisLabMikrobiologi::findOrFail($id);

        $isUpdated = false;
        if ($labmikrobiologi->nama_barang !== $request->nama_barang){
            $labmikrobiologi->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labmikrobiologi->jumlah !== $request->jumlah){
            $labmikrobiologi->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labmikrobiologi->jumlah_min !== $request->jumlah_min){
            $labmikrobiologi->jumlah_min = $request->jumlah_min;
            $isUpdated = true;
        }
        if ($labmikrobiologi->satuan !== $request->satuan){
            $labmikrobiologi->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labmikrobiologi->tanggal_service !== $request->tanggal_service){
            $labmikrobiologi->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labmikrobiologi->periode !== $request->periode){
            $labmikrobiologi->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labmikrobiologi->harga !== $request->harga){
            $labmikrobiologi->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labmikrobiologi->keterangan !== $request->keterangan){
            $labmikrobiologi->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labmikrobiologi->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            // return redirect()->route('databarangkoorlabmikrobiologi');
            if(session('is_logged_in')) {
                if(Auth::user()->role == 'koorlabprodkimia'){
                    return redirect()->route('databarangkoorlabmikrobiologi');
                } else{
                    return redirect()->route('databarangadminlabmikrobiologi');
                }
            }
        }

        $labmikrobiologi->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        // return redirect()->route('databarangkoorlabmikrobiologi');
        if(session('is_logged_in')) {
            if(Auth::user()->role == 'koorlabprodkimia'){
                return redirect()->route('databarangkoorlabmikrobiologi');
            } else{
                return redirect()->route('databarangadminlabmikrobiologi');
            }
        }
    }

    public function destroy($id)
    {
        $labmikrobiologi = InventarisLabMikrobiologi::findOrFail($id);
        $labmikrobiologi->delete();
        return response()->json(['status'=>'Data Barang Berhasil Dihapus']);
    }


    public function getGambar($id)
{
    $labmikrobiologi =  InventarisLabMikrobiologi::findOrFail($id);

    $gambarPath = storage_path('app/public/gambars/' . $labmikrobiologi->gambar);

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
