@extends('rolesuperadmin.layoutsuperadmin.detailpengajuan')
@section('content')

<div class="bg-abu-polteka w-full min-h-[500px] px-9 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2 mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
            <div class="text-hitam-polteka">Detail Pengajuan Barang</div>
        </div> 
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-[13px] lg:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Superadmin</div>
            <svg class="my-1.5 text-hitam-polteka md:w-[9px] md:h-[9px] lg:w-[12px] lg:h-[12px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
            <div class="ml-2  text-hitam-polteka">Detail Pengajuan Barang</div>
        </div> 
        <div class="my-4 w-1/2 flex justify-end text-hitam-polteka">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 256 256"><path fill="currentColor" d="M221.8 175.94c-5.55-9.56-13.8-36.61-13.8-71.94a80 80 0 1 0-160 0c0 35.34-8.26 62.38-13.81 71.94A16 16 0 0 0 48 200h40.81a40 40 0 0 0 78.38 0H208a16 16 0 0 0 13.8-24.06M128 216a24 24 0 0 1-22.62-16h45.24A24 24 0 0 1 128 216m-80-32c7.7-13.24 16-43.92 16-80a64 64 0 1 1 128 0c0 36.05 8.28 66.73 16 80Z"/></svg>
            <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><g fill="none"><path stroke="currentColor" stroke-width="1.5" d="M21 12a8.958 8.958 0 0 1-1.526 5.016A8.991 8.991 0 0 1 12 21a8.991 8.991 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="currentColor" d="M13.25 9c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 14.75 9zM12 10.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 12 11.75zM10.75 9c0-.69.56-1.25 1.25-1.25v-1.5A2.75 2.75 0 0 0 9.25 9zM12 7.75c.69 0 1.25.56 1.25 1.25h1.5A2.75 2.75 0 0 0 12 6.25zM5.166 17.856l-.719-.214l-.117.392l.267.31zm13.668 0l.57.489l.266-.31l-.117-.393zM9 15.75h6v-1.5H9zm0-1.5a4.752 4.752 0 0 0-4.553 3.392l1.438.428A3.252 3.252 0 0 1 9 15.75zm3 6a8.23 8.23 0 0 1-6.265-2.882l-1.138.977A9.73 9.73 0 0 0 12 21.75zm3-4.5c1.47 0 2.715.978 3.115 2.32l1.438-.428A4.752 4.752 0 0 0 15 14.25zm3.265 1.618A8.23 8.23 0 0 1 12 20.25v1.5a9.73 9.73 0 0 0 7.403-3.405z"/></g></svg>
        </div>
        </div>
    </section>
    <!-- END: Top Bar -->
    <section class="text-hitam-polteka my-8  bg-white rounded-lg p-6">
        <div>
            <h2 class="text-xl font-semibold mb-5">Detail Pengajuan Barang</h2>
                    <div class="mb-5">
                        <p class="font-semibold">Nomor Surat:</p>
                        <p>{{ $pengajuanBarang->no_surat }}</p>
                    </div>
                    <div class="mb-5">
                        <p class="font-semibold">Unit:</p>
                        <p>{{ $pengajuanBarang->prodi }}</p>
                    </div>
                    <div class="mb-5">
                        <p class="font-semibold">Tanggal:</p>
                        <p>{{ \Carbon\Carbon::parse($pengajuanBarang->tanggal)->translatedFormat('d F Y') }}</p>
                    </div>
                    <div class="mb-5">
                        <p class="font-semibold mb-5">Detail Barang:</p>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-hitam-polteka">
                                <thead class="bg-abu-polteka border-b border-hitam-polteka ">
                                    <tr>
                                        <th scope="col" class="border-e border-hitam-polteka w-10 px-6 py-2 text-center font-semibold font-polteka text-hitam-polteka">No</th>
                                        <th scope="col" class="border-e border-hitam-polteka px-6 py-2 text-center font-semibold font-polteka text-hitam-polteka">Nama Barang</th>
                                        <th scope="col" class="border-e border-hitam-polteka px-6 py-2 text-center font-semibold font-polteka text-hitam-polteka">Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y border-b border-hitam-polteka">
                                    @foreach(json_decode($pengajuanBarang->nama_barang) as $index => $namaBarang)
                                    <tr class="border-b border-hitam-polteka ">
                                        <td class="border-e border-hitam-polteka w-10 px-6 py-2 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="border-e border-hitam-polteka px-6 py-2 text-center whitespace-nowrap">{{ $namaBarang }}</td>
                                        <td class="border-e border-hitam-polteka px-6 py-2 text-center whitespace-nowrap">Rp {{ number_format(json_decode($pengajuanBarang->harga)[$index], 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mb-5">
                        <p class="font-semibold">Total Harga:</p>
                        <p>Rp {{ number_format($pengajuanBarang->total_harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="mb-5">
                        <p class="font-semibold">Keterangan:</p>
                        <p>
                            @if ($pengajuanBarang->pengajuanWadir)
                                @if (!empty($pengajuanBarang->pengajuanWadir->keterangan))
                                    {!! nl2br($pengajuanBarang->pengajuanWadir->keterangan) !!}
                                @else
                                    Belum Ada
                                @endif
                            @else
                                Belum Ada
                            @endif
                        </p>                         
                    </div>     
                    <form method="POST" action="{{ route('updatestatuskoorlabfarmasisuperadmin', $pengajuanBarang->kode_pengajuan) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-5">
                            <p class="font-semibold">Status:</p>
                                <div class="form-group flex">
                                    <select name="status" class="form-control inline-flex w-auto mr-2 rounded-md bg-merah180-polteka px-1 py-1 text-sm font-semibold text-putih-polteka" >
                                        @php
                                        $status = $pengajuanBarang->pengajuanWadir ? $pengajuanBarang->pengajuanWadir->status : '';
                                        @endphp
                                        <option value="Menunggu Konfirmasi" {{ $status ? 'selected' : '' }}>Menunggu konfirmasi</option>
                                    </select>
                                </div>
                        </div>
                        <button type="submit" class="inline-flex w-20 justify-center mt-2 mb-5 rounded-md px-3 py-2 text-sm bg-merah200-polteka text-putih-polteka shadow-sm">
                            Update
                        </button> 
                    </form>
                    <div>
                        <p class="font-semibold">File:</p>
                        @if (pathinfo($pengajuanBarang->file, PATHINFO_EXTENSION) == 'pdf')
                            <embed src="{{ route('preview.suratsuperadmin', ['id' => $pengajuanBarang->kode_pengajuan]) }}" type="application/pdf" width="100%" height="600px">
                        @else
                            <img src="{{ route('preview.suratsuperadmin', ['id' => $pengajuanBarang->kode_pengajuan]) }}" alt="Gambar Pengajuan" class="w-full h-auto">
                        @endif
                    </div>
        </div>
    </section>
    <!-- COPYRIGHT -->
    <footer class="block mt-6 sm:mt-20 lg:mt-28 xl:mt-20 mb-6 text-center">
        <div class="text-biru160-polteka text-xs md:text-sm">
            © 2024 Tim Capstone 07 Teknik Komputer Universitas Diponegoro
        </div>
    </footer> 
</div>


@endsection