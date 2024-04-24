<?php

namespace App\Http\Controllers;
use App\Account;
use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Models\InventarisLabfarmakognosi;

class InventarisLabfarmakognosiController extends Controller
{
    public function index(){
        $labfarmakognosi = InventarisLabFarmakognosi::paginate(10);
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.databarang', compact('labfarmakognosi'));
    }

    public function create(){
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.tambahbarang');
    }

    public function store(Request $request){
        $messages = [
            'nama_barang.required' => 'Nama barang harus diisi.',
            'nama_barang.unique' => 'Nama barang sudah digunakan.',
            'jumlah.required' => 'Jumlah harus diisi.',
            'satuan.required' => 'Satuan harus diisi.',
            'harga.required' => 'Harga harus dipilih.',
            'Keterangan.required' => 'Keterangan harus diisi.',
            'gambar.image' => 'Gambar harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
        ];

        $request->validate([
            'nama_barang'=>'required|string|unique:inventaris_labfarmakognosis',
            'jumlah'=>'required|integer',
            'satuan'=>'required|string',
            'tanggal_service'=>'nullable|date',
            'periode'=>'nullable|integer',
            'harga'=>'required|integer',
            'keterangan'=>'required',
            'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
        ], $messages);

        $thn = Carbon::now()->year;
        $var = 'BF';
        $bms = InventarisLabFarmakognosi::count();
        if ($bms == 0) {
            $awal = 10001;
            $kode_barang = $var.$thn.$awal;
            // BM2021001
        } else {
            $last = InventarisLabFarmakognosi::latest()->first();
            $awal = (int)substr($last->kode_barang, -5) + 1;
            $kode_barang = $var.$thn.$awal;
        }

        $labfarmakognosi = new InventarisLabFarmakognosi();
        $labfarmakognosi->nama_barang = $request->nama_barang;
        $labfarmakognosi->kode_barang = $kode_barang;
        $labfarmakognosi->jumlah = $request->jumlah;
        $labfarmakognosi->satuan = $request->satuan;
        $labfarmakognosi->tanggal_service = $request->tanggal_service;
        $labfarmakognosi->periode = $request->periode;
        $labfarmakognosi->harga = $request->harga;
        $labfarmakognosi->keterangan = $request->keterangan;

        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labfarmakognosi->gambar = $gambarName;
        }

        if ($labfarmakognosi->gambar === null) {
            unset($labfarmakognosi->gambar);
        }

        $labfarmakognosi->save();
        alert()->success('Berhasil','Barang Baru Berhasil Ditambahkan.');
        return redirect()->route('databarangkoorlabfarmakognosi');
    }

    public function edit($id){
        $labfarmakognosi = InventarisLabfarmakognosi::findOrFail($id);
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.ubahbarang', compact('labfarmakognosi'));
    }

    public function update(Request $request, $id) {
        $messages = [
            'nama_barang.unique' => 'Nama barang sudah digunakan.',
            'gambar.image' => 'Gambar harus berupa gambar.',
            'gambar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
        ];

        $request->validate([
            'nama_barang'=>'required|string',
            'jumlah'=>'required|integer',
            'satuan'=>'required|string',
            'tanggal_service'=>'nullable|date',
            'periode'=>'nullable|integer',
            'harga'=>'required|integer',
            'keterangan'=>'required',
            'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
        ], $messages);

        $labfarmakognosi = Inventarislabfarmakognosi::findOrFail($id);

        $isUpdated = false;
        if ($labfarmakognosi->nama_barang !== $request->nama_barang){
            $labfarmakognosi->nama_barang = $request->nama_barang;
            $isUpdated = true;
        }
        if ($labfarmakognosi->jumlah !== $request->jumlah){
            $labfarmakognosi->jumlah = $request->jumlah;
            $isUpdated = true;
        }
        if ($labfarmakognosi->satuan !== $request->satuan){
            $labfarmakognosi->satuan = $request->satuan;
            $isUpdated = true;
        }
        if ($labfarmakognosi->tanggal_service !== $request->tanggal_service){
            $labfarmakognosi->tanggal_service = $request->tanggal_service;
            $isUpdated = true;
        }
        if ($labfarmakognosi->periode !== $request->periode){
            $labfarmakognosi->periode = $request->periode;
            $isUpdated = true;
        }
        if ($labfarmakognosi->harga !== $request->harga){
            $labfarmakognosi->harga = $request->harga;
            $isUpdated = true;
        }
        if ($labfarmakognosi->keterangan !== $request->keterangan){
            $labfarmakognosi->keterangan = $request->keterangan;
            $isUpdated = true;
        }
        if ($request->hasFile('gambar')) {
            $gambarName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/gambars', $gambarName);
            $labfarmakognosi->gambar = $gambarName;
            $isUpdated = true;
        }
        if (!$isUpdated){
            alert()->info('Tidak Ada Perubahan', 'Tidak ada yang diupdate.');
            return redirect()->route('databarangkoorlabfarmakognosi');
        }

        $labfarmakognosi->save();
        alert()->success('Berhasil', 'Data barang berhasil diperbarui');
        return redirect()->route('databarangkoorlabfarmakognosi');
    }

    public function destroy($id)
    {
        $labfarmakognosi = Inventarislabfarmakognosi::findOrFail($id);
        $labfarmakognosi->delete();
        alert()->success('Berhasil', 'Data barang berhasil dihapus.');
        return redirect()->route('databarangkoorlabfarmakognosi');
    }
}
