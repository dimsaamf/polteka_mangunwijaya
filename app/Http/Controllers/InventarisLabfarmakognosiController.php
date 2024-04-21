<?php

namespace App\Http\Controllers;
use App\Account;


use Illuminate\Http\Request;
use App\Models\InventarisLabfarmakognosi;

class InventarisLabfarmakognosiController extends Controller
{
    public function index(){
        $labfarmakognosi = InventarislabFarmakognosi::paginate(10);
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.databarang', compact('labfarmakognosi'));
    }

    public function create(){
        return view('rolekoorlabfarmasi.contentkoorlab.labfarmakognosi.tambahbarang');
    }

    public function store(Request $request){
        $request->validate([
            'nama_barang'=>'required|string',
            'jumlah'=>'required|integer',
            'satuan'=>'required|string',
            'tanggal_service'=>'nullable|date',
            'periode'=>'nullable|integer',
            'harga'=>'required|integer',
            'keterangan'=>'required',
            'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $labfarmakognosi = new InventarisLabFarmakognosi();
        $labfarmakognosi->nama_barang = $request->nama_barang;
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
        $request->validate([
            'nama_barang'=>'string',
            'jumlah'=>'integer',
            'satuan'=>'string',
            'tanggal_service'=>'date',
            'periode'=>'integer',
            'harga'=>'integer',
            'keterangan'=>'required',
            'gambar'=>'nullable|image|mimes:jpg,jpeg,png',
        ]);

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
            $user->gambar = $gambarName;
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
