<?php

namespace App\Http\Controllers\KoorAdminLabFarmasi;
use App\Http\Controllers\Controller;
use App\Models\PengajuanBarangLabFarmasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PengajuanBarangLabFarmasiController extends Controller
{
    public function index()
    {
        $pengajuanBarangs = PengajuanBarangLabFarmasi::paginate(10);
        return view('rolekoorlabfarmasi.contentkoorlab.pengajuan', compact('pengajuanBarangs'));

    }

    public function show($id)
    {
        $pengajuanBarang = PengajuanBarangLabFarmasi::findOrFail($id);
        return view('rolekoorlabfarmasi.contentkoorlab.detailpengajuan', compact('pengajuanBarang'));
    }

    public function create()
    {
        return view('rolekoorlabfarmasi.contentkoorlab.tambahpengajuan');
    }

    public function store(Request $request)
{
    $messages = [
        'no_surat.required' => 'Nomor surat harus diisi.',
        'no_surat.string' => 'Nomor surat harus berupa teks.',
        'no_surat.max' => 'Nomor surat tidak boleh melebihi 255 karakter.',
        'file_surat.required' => 'File surat harus diunggah.',
        'file_surat.file' => 'File harus berupa file.',
        'file_surat.max' => 'Ukuran file tidak boleh melebihi 2MB.',
        'file_surat.mimes' => 'Format yang didukung hanya pdf,png,jpg,jpeg',
        'nama_barang.*.required' => 'Nama barang harus diisi.',
        'nama_barang.*.string' => 'Nama barang harus berupa teks.',
        'harga.*.required' => 'Harga barang harus diisi.',
        'harga.*.integer' => 'Harga barang harus berupa angka.',
    ];

    $request->validate([
        'no_surat' => 'required|string|max:255',
        'file_surat' => 'required|file|max:2048|mimes:pdf,png,jpg,jpeg',
        'nama_barang.*' => 'required|string',
        'harga.*' => 'required|integer',
    ], $messages);

    foreach ($request->nama_barang as $key => $namaBarang) {
        if (empty($namaBarang) || empty($request->harga[$key])) {
            return redirect()->back()->withInput()->with('error', 'Semua kolom nama barang dan harga harus diisi.');
        }
    }
    
    // Logika untuk menambahkan barang baru
    $tambahBarang = true;
    foreach ($request->nama_barang as $namaBarang) {
        if (empty($namaBarang)) {
            $tambahBarang = false;
            break;
        }
    }

    $file_surat = $request->file('file_surat');
    $file_surat_path = $file_surat->store('surat', 'public');
    $statusDefault = 'Menunggu Konfirmasi';
    $keteranganDefault = 'Belum Ada';

    $total_harga = 0; // Inisialisasi total harga
    if (!empty($request->harga)) { // Periksa apakah $request->harga tidak kosong
        $total_harga = array_sum($request->harga);
    }
        $nama_barang = json_encode($request->nama_barang);
        $harga = json_encode($request->harga);

        $pengajuan = PengajuanBarangLabFarmasi::create([
            'no_surat' => $request->no_surat,
            'tanggal' => Carbon::now('Asia/Jakarta'),
            'file' => $file_surat_path,
            'status' => $statusDefault,
            'keterangan' => $keteranganDefault,
            'total_harga' => $total_harga,
            'nama_barang' => $nama_barang,
            'harga' => $harga,
        ]);

    alert()->success('Berhasil', 'Pengajuan Barang berhasil ditambahkan.');
    return redirect()->route('pengajuanbarangkoorlabfarmasi');
}

public function edit($id)
{
    $pengajuanBarang = PengajuanBarangLabFarmasi::findOrFail($id);
    return view('rolekoorlabfarmasi.contentkoorlab.editpengajuan', compact('pengajuanBarang'));
}

public function update(Request $request, $id)
{
    $messages = [
        'no_surat.required' => 'Nomor surat harus diisi.',
        'no_surat.string' => 'Nomor surat harus berupa teks.',
        'no_surat.max' => 'Nomor surat tidak boleh melebihi 255 karakter.',
        'file_surat.file' => 'File harus berupa file.',
        'file_surat.max' => 'Ukuran file tidak boleh melebihi 2MB.',
        'file_surat.mimes' => 'Format yang didukung hanya pdf, png, jpg, jpeg',
        'nama_barang.*.required' => 'Nama barang harus diisi.',
        'harga.*.required' => 'Harga harus diisi.',
        'harga.*.integer' => 'Harga harus berupa angka.',
    ];

    $request->validate([
        'no_surat' => 'required|string|max:255',
        'file_surat' => 'sometimes|file|max:2048|mimes:pdf,png,jpg,jpeg',
        'nama_barang.*' => 'required|string',
        'harga.*' => 'required|integer',
    ], $messages);

    $pengajuanBarang = PengajuanBarangLabFarmasi::findOrFail($id);

    $pengajuanBarang->no_surat = $request->no_surat;

    if ($request->hasFile('file_surat')) {
        $file_surat = $request->file('file_surat');
        $file_surat_path = $file_surat->store('surat', 'public');
        $pengajuanBarang->file = $file_surat_path;
    }

    // Menghitung total harga
    $total_harga = 0;
    foreach ($request->harga as $harga) {
        $total_harga += $harga;
    }
    $pengajuanBarang->total_harga = $total_harga;

    // Menyimpan data nama barang dan harga dalam bentuk JSON
    $pengajuanBarang->nama_barang = json_encode($request->nama_barang);
    $pengajuanBarang->harga = json_encode($request->harga);

    $pengajuanBarang->save();

    alert()->success('Berhasil', 'Pengajuan Barang berhasil diperbarui.');
    return redirect()->route('pengajuanbarangkoorlabfarmasi');
}


    public function previewSurat($id)
    {
        $pengajuanBarang = PengajuanBarangLabFarmasi::findOrFail($id);

        $fileExtension = pathinfo($pengajuanBarang->file, PATHINFO_EXTENSION);

        $contentType = '';
        switch ($fileExtension) {
            case 'pdf':
                $contentType = 'application/pdf';
                break;
            case 'png':
                $contentType = 'image/png';
                break;
            case 'jpg':
            case 'jpeg':
                $contentType = 'image/jpeg';
                break;
            default:
                return response()->json(['error' => 'Tipe file tidak didukung'], 400);
        }

        $fileContent = Storage::get('public/' . $pengajuanBarang->file); // Misalkan file disimpan di storage

        $headers = [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; filename="' . $pengajuanBarang->file_name . '"',
        ];

        return response($fileContent, 200, $headers);
    }

    public function destroy($id)
    {
        $pengajuanBarang = PengajuanBarangLabFarmasi::findOrFail($id);
        $pengajuanBarang->delete();
        return response()->json(['status'=>'Pengajuan Berhasil Dihapus']);
    }

}
