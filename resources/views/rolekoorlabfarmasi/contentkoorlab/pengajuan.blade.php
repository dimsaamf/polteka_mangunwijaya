@extends('rolekoorlabfarmasi.layoutkoorlab.pengajuan')
@section('content')
@include('sweetalert::alert')

<div class="bg-abu-polteka font-polteka w-full min-h-[500px] px-8 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8 mb-0 overflow-x-auto">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2  mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
            <div class="text-hitam-polteka">Pengajuan Barang</div>
        </div> 
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-[13px] lg:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Koor Lab Prodi Farmasi</div>
            <svg class="my-1.5 text-hitam-polteka md:w-[9px] md:h-[9px] lg:w-[12px] lg:h-[12px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
            <div class="ml-2  text-hitam-polteka">Pengajuan Barang</div>
        </div>
        <div class="my-4 w-1/2 flex justify-end text-hitam-polteka">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 256 256"><path fill="currentColor" d="M221.8 175.94c-5.55-9.56-13.8-36.61-13.8-71.94a80 80 0 1 0-160 0c0 35.34-8.26 62.38-13.81 71.94A16 16 0 0 0 48 200h40.81a40 40 0 0 0 78.38 0H208a16 16 0 0 0 13.8-24.06M128 216a24 24 0 0 1-22.62-16h45.24A24 24 0 0 1 128 216m-80-32c7.7-13.24 16-43.92 16-80a64 64 0 1 1 128 0c0 36.05 8.28 66.73 16 80Z"/></svg>
            <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><g fill="none"><path stroke="currentColor" stroke-width="1.5" d="M21 12a8.958 8.958 0 0 1-1.526 5.016A8.991 8.991 0 0 1 12 21a8.991 8.991 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="currentColor" d="M13.25 9c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 14.75 9zM12 10.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 12 11.75zM10.75 9c0-.69.56-1.25 1.25-1.25v-1.5A2.75 2.75 0 0 0 9.25 9zM12 7.75c.69 0 1.25.56 1.25 1.25h1.5A2.75 2.75 0 0 0 12 6.25zM5.166 17.856l-.719-.214l-.117.392l.267.31zm13.668 0l.57.489l.266-.31l-.117-.393zM9 15.75h6v-1.5H9zm0-1.5a4.752 4.752 0 0 0-4.553 3.392l1.438.428A3.252 3.252 0 0 1 9 15.75zm3 6a8.23 8.23 0 0 1-6.265-2.882l-1.138.977A9.73 9.73 0 0 0 12 21.75zm3-4.5c1.47 0 2.715.978 3.115 2.32l1.438-.428A4.752 4.752 0 0 0 15 14.25zm3.265 1.618A8.23 8.23 0 0 1 12 20.25v1.5a9.73 9.73 0 0 0 7.403-3.405z"/></g></svg>
        </div>
        </div>
    </section>
    <!-- END: Top Bar -->
    <section class="text-hitam-polteka">
        <div>
        <h2 class="text-xl font-semibold">Pengajuan Barang</h2>
        <div class="justify-start mt-5">
            <a href="{{ route('tambahpengajuankoorlabfarmasi') }}" class="w-[170px] mb-3 rounded-md px-3 py-2 text-sm bg-merah200-polteka text-putih-polteka shadow-sm">
                Tambah Pengajuan
            </a>
        </div>

        <!-- BEGIN: Data List --> 
        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full text-sm text-hitam-polteka">
                    <thead>
                        <tr >
                            <th scope="col" class="px-6 py-3 text-center">No</th>
                            <th scope="col" class="px-6 py-3 text-center">No Surat</th>
                            <th scope="col" class="px-6 py-3 text-center">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-center">Detail Barang</th>
                            <th scope="col" class="px-6 py-3 text-center">Total Harga</th>
                            <th scope="col" class="px-6 py-3 text-center">File</th>
                            <th scope="col" class="px-6 py-3 text-center">Status</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajuanBarangs as $pengajuanbarang)
                            <tr class="text-center bg-putih-polteka border-y-8 border-abu-polteka">
                                <td class="px-6 py-2 whitespace-nowrap rounded-l-xl">{{ ($pengajuanBarangs->currentPage() - 1) * $pengajuanBarangs->perPage() + $loop->index + 1 }}</td>
                                <td class="px-6 py-2 whitespace-nowrap">{{$pengajuanbarang->no_surat}}</td>
                                <td class="px-6 py-2 whitespace-nowrap">{{ \Carbon\Carbon::parse($pengajuanbarang->tanggal)->translatedFormat('d F Y') }}</td>
                                <td class="px-6 py-2 whitespace-nowrap max-w-[200px]">{{ mb_substr(implode(' ', array_slice(explode(' ', $pengajuanbarang->detail_barang), 0, 5)), 0, 30) }} ...</td>
                                <td class="px-6 py-2 whitespace-nowrap">Rp {{ number_format($pengajuanbarang->total_harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    <a href="{{ route('preview.surat.koorlabfarmasi', ['id' => $pengajuanbarang->id]) }}" target="_blank">
                                        @if (in_array(pathinfo($pengajuanbarang->file, PATHINFO_EXTENSION), ['pdf']))
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" viewBox="0 0 15 15"><path fill="#e20808" d="M3.5 8H3V7h.5a.5.5 0 0 1 0 1M7 10V7h.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z"/><path fill="#e20808" fill-rule="evenodd" d="M1 1.5A1.5 1.5 0 0 1 2.5 0h8.207L14 3.293V13.5a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 1 13.5zM3.5 6H2v5h1V9h.5a1.5 1.5 0 1 0 0-3m4 0H6v5h1.5A1.5 1.5 0 0 0 9 9.5v-2A1.5 1.5 0 0 0 7.5 6m2.5 5V6h3v1h-2v1h1v1h-1v2z" clip-rule="evenodd"/></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" viewBox="0 0 1920 1536">
                                                <path fill="currentColor" d="M640 448q0 80-56 136t-136 56t-136-56t-56-136t56-136t136-56t136 56t56 136m1024 384v448H256v-192l320-320l160 160l512-512zm96-704H160q-13 0-22.5 9.5T128 160v1216q0 13 9.5 22.5t22.5 9.5h1600q13 0 22.5-9.5t9.5-22.5V160q0-13-9.5-22.5T1760 128m160 32v1216q0 66-47 113t-113 47H160q-66 0-113-47T0 1376V160Q0 94 47 47T160 0h1600q66 0 113 47t47 113"/>
                                            </svg>
                                        @endif
                                    </a>
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">{{ $pengajuanbarang->status }}</td>
                                <td class="px-6 py-2 whitespace-nowrap rounded-r-xl flex justify-center space-x-4">
                                    <a href="{{ route('detailpengajuankoorlabfarmasi', ['id' => $pengajuanbarang->id]) }}" data-modal-target="default-modal" data-modal-toggle="default-modal" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" width="1.4em" height="1.4em" viewBox="0 0 24 24"><path fill="black" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                                    </a>
                                    <a href="{{ route('editpengajuankoorlabfarmasi', ['id' => $pengajuanbarang->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><path fill="black" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"/><path fill="black" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2z"/></svg>
                                    </a>
                                    <form action="{{ route('hapuspengajuankoorlabfarmasi', ['id' => $pengajuanbarang->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto text-red-600" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="flex flex-col my-12 py-4 items-center space-y-5 overflow-x-auto">
            <ul class="inline-flex mx-autospace-x-2">
                @if ($pengajuanBarangs->onFirstPage())
                    <li>
                        <span class="px-4 py-2 text-gray-400 text-sm">Sebelumnya</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $pengajuanBarangs->previousPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold text-sm">Sebelumnya</a>
                    </li>
                @endif
        
                @foreach ($pengajuanBarangs->getUrlRange($pengajuanBarangs->currentPage() - 2, $pengajuanBarangs->currentPage() + 2) as $page => $url)
                    @if ($page == $pengajuanBarangs->currentPage())
                        <li>
                            <a href="{{ $url }}" class="px-4 py-2 text-putih-polteka bg-biru160-polteka hover:bg-biru100-polteka rounded-full text-sm">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
        
                @if ($pengajuanBarangs->hasMorePages())
                    <li>
                        <a href="{{ $pengajuanBarangs->nextPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold hover:text-hitam-polteka text-sm">Selanjutnya</a>
                    </li>
                @else
                    <li>
                        <span class="px-4 py-2 text-gray-400 text-sm">Selanjutnya</span>
                    </li>
                @endif
            </ul>
        </div>
        <!-- END: Pagination -->
    </section>  

    <!-- COPYRIGHT -->
    <footer class="block mt-6 sm:mt-20 md:mt-44 lg:mt-56 mb-6 text-center">
      <div class="text-biru160-polteka text-xs md:text-sm">
        © 2024 Tim Capstone 07 Teknik Komputer Universitas Diponegoro
      </div>
    </footer>
</div>

<script>
    function previewFile(url) {
        window.open(url, '_blank');
    }
</script>

@endsection