@extends('rolekoorlabfarmasi.layoutkoorlab.labfarmakognosi.barangkeluar')
@section('content')
<div class="bg-abu-polteka font-polteka w-full min-h-[500px] px-8 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8 mb-0 overflow-x-auto">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2  mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
            <div class="text-hitam-polteka">Barang Keluar</div>
        </div>
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-[13px] lg:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Koor Lab Farmakognosi</div>
            <svg class="my-1.5 text-hitam-polteka md:w-[9px] md:h-[9px] lg:w-[12px] lg:h-[12px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
            <div class="ml-2  text-hitam-polteka">Barang Keluar</div>
        </div> 
        <div class="my-4 w-1/2 flex justify-end text-hitam-polteka">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 256 256"><path fill="currentColor" d="M221.8 175.94c-5.55-9.56-13.8-36.61-13.8-71.94a80 80 0 1 0-160 0c0 35.34-8.26 62.38-13.81 71.94A16 16 0 0 0 48 200h40.81a40 40 0 0 0 78.38 0H208a16 16 0 0 0 13.8-24.06M128 216a24 24 0 0 1-22.62-16h45.24A24 24 0 0 1 128 216m-80-32c7.7-13.24 16-43.92 16-80a64 64 0 1 1 128 0c0 36.05 8.28 66.73 16 80Z"/></svg>
            <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><g fill="none"><path stroke="currentColor" stroke-width="1.5" d="M21 12a8.958 8.958 0 0 1-1.526 5.016A8.991 8.991 0 0 1 12 21a8.991 8.991 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="currentColor" d="M13.25 9c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 14.75 9zM12 10.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 12 11.75zM10.75 9c0-.69.56-1.25 1.25-1.25v-1.5A2.75 2.75 0 0 0 9.25 9zM12 7.75c.69 0 1.25.56 1.25 1.25h1.5A2.75 2.75 0 0 0 12 6.25zM5.166 17.856l-.719-.214l-.117.392l.267.31zm13.668 0l.57.489l.266-.31l-.117-.393zM9 15.75h6v-1.5H9zm0-1.5a4.752 4.752 0 0 0-4.553 3.392l1.438.428A3.252 3.252 0 0 1 9 15.75zm3 6a8.23 8.23 0 0 1-6.265-2.882l-1.138.977A9.73 9.73 0 0 0 12 21.75zm3-4.5c1.47 0 2.715.978 3.115 2.32l1.438-.428A4.752 4.752 0 0 0 15 14.25zm3.265 1.618A8.23 8.23 0 0 1 12 20.25v1.5a9.73 9.73 0 0 0 7.403-3.405z"/></g></svg>
        </div>
        </div>
    </section>
    <!-- END: Top Bar -->
    <section class="text-hitam-polteka">
        <h2 class="text-xl font-semibold">Barang Keluar</h2>
        
        <!-- BEGIN: Data List --> 
        <div class="flex flex-col mt-8">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                <div class="flex">
                    <div class="flex w-1/2 justify-start mb-3">
                        <a href="{{ route('riwayatbarangkeluarkoorlabfarmakognosi') }}" type="button" class="w-[130px] mb-3 rounded-md px-3 py-2 text-sm bg-merah200-polteka text-putih-polteka shadow-sm">
                            Riwayat Barang
                        </a>
                    </div>
                    <div class="flex w-1/2 justify-end mb-3">
                                    <div class ="bg-merah180-polteka w-2/3 h-10 flex items-center rounded-l-full rounded-r-full">
                                        <div class ="bg-abu-polteka w-11/12 h-9 ml-0.5 rounded-l-full">
                                            <div class="relative flex">
                                                <input
                                                    type="search"
                                                    class="relative m-0 block flex-auto rounded border border-none bg-transparent bg-clip-padding px-3 py-[0.25rem] text-md font-normal leading-[1.6] text-surface outline-none transition duration-200 ease-in-out placeholder:text-hitam-polteka placeholder:text-opacity-30 focus:z-[3] focus:border-none focus:shadow-inset focus:outline-none motion-reduce:transition-none"
                                                    placeholder="Cari Barang"/>
                                            </div>
                                        </div>
                                        <span class="flex items-center whitespace-nowrap px-3 py-[0.25rem] text-surface dark:border-neutral-400 dark:text-white [&>svg]:h-5 [&>svg]:w-5" id="button-addon2">
                                            <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="2"
                                            stroke="white">
                                                <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                    </div>
                    <table class="min-w-full text-sm text-hitam-polteka">
                    <thead>
                        <tr >
                            <th scope="col" class="px-6 py-3 text-center">Nama Barang</th>
                            <th scope="col" class="px-6 py-3 text-center">ID Barang</th>
                            <th scope="col" class="px-6 py-3 text-center">Harga</th>
                            <th scope="col" class="px-6 py-3 text-center">Jumlah</th>
                            <th scope="col" class="px-6 py-3 text-center">Keterangan</th>
                            <th scope="col" class="px-6 py-3 text-center">Ubah Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->isEmpty())
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center">Tidak ada data yang tersedia.</td>
                            </tr>
                        @else
                        @foreach($data as $item)
                        <tr class="text-center bg-putih-polteka border-y-8 border-abu-polteka">
                            <td class="px-6 py-2 whitespace-nowrap">{{$item->nama_barang}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$item->kode_barang}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">Rp. {{$item->harga}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$item->jumlah}} {{$item->satuan}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$item->keterangan}}</td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl">
                                <a href="#" data-modal-target="default-modal" data-modal-toggle="default-modal" onclick="setIdBarang('{{ $item->id }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" width="1.4rem" height="1.4rem" viewBox="0 0 24 24">
                                        <path fill="black" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"/>
                                        <path fill="black" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-auto fixed inset-0">
            <!-- Lapisan latar belakang transparan -->
            <div class="fixed inset-0 overflow-y-auto flex items-center justify-center z-50">
                <!-- Lapisan latar belakang transparan -->
                <div class="fixed inset-0 bg-black opacity-25"></div>
                <div class="relative bg-white rounded-lg shadow w-[300px] sm:w-[450px] md:w-[500px]">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between py-2"></div>
                    <div class="flex items-center justify-between px-5 py-1">
                        <button type="button" class="text-hitam-polteka bg-transparent hover:bg-merah200-polteka hover:text-putih-polteka rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>                      
                    </div>
                    <div class="flex items-center justify-center">
                        <h3 class="text-xl font-semibold">
                            Kurangi Stok barang
                        </h3>                      
                    </div>
                    <!-- Modal body -->
                    <div class="px-8">
                    <form action="{{ route('barangkeluarkoorlabfarmakognosi.store') }}" method="POST" enctype="multipart/form-data">  
                    @csrf
                        <label class="block mt-4">
                            <span class="text-sm font-medium">Jumlah Barang Keluar</span>
                            <input type="text" name="jumlah_keluar" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Lorem ipsum" />
                        </label>
                    </div>
                    <div class="px-8">
                        <label class="block mt-4">
                            <span class="text-sm font-medium">Tanggal Barang Keluar</span>
                            <input type="date" name="tanggal_keluar" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Lorem ipsum" />
                        </label>
                    </div>
                    <input type="hidden" name="id_barang" id="id_barang" value="">
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 mt-4">
                        <button data-modal-hide="default-modal" type="submit" class="inline-flex w-20 justify-center rounded-md px-3 py-2 text-sm bg-merah200-polteka text-putih-polteka shadow-sm">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="flex flex-col my-12 py-4 items-center space-y-5 overflow-x-auto">
            <ul class="inline-flex mx-autospace-x-2">
                <li>
                <button class="hidden md:block px-4 py-2 text-hitam-polteka hover:font-bold text-sm">
                    Sebelumnya
                </button>
                </li>
                <li>
                <button class="px-4 py-2 text-hitam-polteka text-opacity-40 hover:font-bold hover:text-hitam-polteka text-sm">
                    1
                </button>
                </li>
                <li>
                <button
                    class="bg-biru160-polteka px-4 py-2 text-putih-polteka hover:bg-biru100-polteka rounded-full text-sm">
                    2
                </button>
                </li>
                <li>
                <button class="px-4 py-2 text-hitam-polteka text-opacity-40 hover:font-bold hover:text-hitam-polteka text-sm">
                    3
                </button>
                </li>
                <li>
                <button class="hidden md:block px-4 py-2 text-hitam-polteka hover:font-bold text-sm">
                    Selanjutnya
                </button>
                </li>
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

<!-- Script -->
<script>
    const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
    
    modalToggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalTarget = document.getElementById(button.dataset.modalTarget);
            if (modalTarget) {
                modalTarget.classList.toggle('hidden');
                modalTarget.setAttribute('aria-hidden', modalTarget.classList.contains('hidden') ? 'true' : 'false');
                if (!modalTarget.classList.contains('hidden')) {
                    modalTarget.focus();
                }
            }
        });
    });
    const modalHideButtons = document.querySelectorAll('[data-modal-hide]');
    modalHideButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalTarget = document.getElementById(button.dataset.modalHide);
            if (modalTarget) {
                modalTarget.classList.add('hidden');
                modalTarget.setAttribute('aria-hidden', 'true');
                button.focus();
            }
        });
    });
    function setIdBarang(id) {
       document.getElementById('id_barang').value = id;
   }
</script>
<!-- Script -->

@endsection