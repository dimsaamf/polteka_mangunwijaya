<?php

namespace App\Http\Controllers;
use App\Models\PengajuanBarangLabFarmasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

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
            'detail_barang.required' => 'Detail barang harus diisi.',
            'detail_barang.string' => 'Detail barang harus berupa teks.',
            'total_harga.required' => 'Total harga harus diisi.',
            'total_harga.numeric' => 'Total harga harus berupa angka.',
            'file_surat.required' => 'File surat harus diunggah.',
            'file_surat.file' => 'File harus berupa file.',
            'file_surat.max' => 'Ukuran file tidak boleh melebihi 2MB.',
            'file_surat.mimes' => 'Format yang didukung hanya pdf,png,jpg,jpeg',
        ];
        

        $request->validate([
            'no_surat' => 'required|string|max:255',
            'detail_barang' => 'required|string',
            'total_harga' => 'required|numeric',
            'file_surat' => 'required|file|max:2048|mimes:pdf,png,jpg,jpeg',
        ], $messages);

        $file_surat = $request->file('file_surat');
        $file_surat_path = $file_surat->store('surat', 'public');
        $statusDefault = 'Menunggu Konfirmasi';

        PengajuanBarangLabFarmasi::create([
            'no_surat' => $request->no_surat,
            'tanggal' => now(),
            'detail_barang' => $request->detail_barang,
            'total_harga' => $request->total_harga,
            'file' => $file_surat_path,
            'status' => $statusDefault,
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
            'detail_barang.required' => 'Detail barang harus diisi.',
            'detail_barang.string' => 'Detail barang harus berupa teks.',
            'total_harga.required' => 'Total harga harus diisi.',
            'total_harga.numeric' => 'Total harga harus berupa angka.',
            'file_surat.file' => 'File harus berupa file.',
            'file_surat.max' => 'Ukuran file tidak boleh melebihi 2MB.',
            'file_surat.mimes' => 'Format yang didukung hanya pdf, png, jpg, jpeg',
        ];

        $request->validate([
            'no_surat' => 'required|string|max:255',
            'detail_barang' => 'required|string',
            'total_harga' => 'required|numeric',
            'file_surat' => 'sometimes|file|max:2048|mimes:pdf,png,jpg,jpeg',
        ], $messages);

        $pengajuanBarang = PengajuanBarangLabFarmasi::findOrFail($id);

        $pengajuanBarang->no_surat = $request->no_surat;
        $pengajuanBarang->detail_barang = $request->detail_barang;
        $pengajuanBarang->total_harga = $request->total_harga;

        if ($request->hasFile('file_surat')) {
            $file_surat = $request->file('file_surat');
            $file_surat_path = $file_surat->store('surat', 'public');
            $pengajuanBarang->file = $file_surat_path;
        }

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
        alert()->success('Berhasil', 'Pengajuan berhasil dihapus.');
        return redirect()->route('pengajuanbarangkoorlabfarmasi');
    }

}
