@extends('rolewadir.layoutwadir.sidebarlaporanlab')
@section('content')
<div class="bg-abu-polteka w-full min-h-[500px] px-9 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2  mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
            <div class="ml-2  text-hitam-polteka">Laporan Lab</div>
        </div> 
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-lg">
            <div class="mr-2 text-merah180-polteka">Hei, Wadir</div>
            <svg class="my-1.5 text-hitam-polteka" xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
            <div class="ml-2  text-hitam-polteka">Laporan Laboratorium</div>
        </div> 
        <div class="my-4 w-1/2 flex justify-end text-hitam-polteka">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 256 256"><path fill="currentColor" d="M221.8 175.94c-5.55-9.56-13.8-36.61-13.8-71.94a80 80 0 1 0-160 0c0 35.34-8.26 62.38-13.81 71.94A16 16 0 0 0 48 200h40.81a40 40 0 0 0 78.38 0H208a16 16 0 0 0 13.8-24.06M128 216a24 24 0 0 1-22.62-16h45.24A24 24 0 0 1 128 216m-80-32c7.7-13.24 16-43.92 16-80a64 64 0 1 1 128 0c0 36.05 8.28 66.73 16 80Z"/></svg>
            <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><g fill="none"><path stroke="currentColor" stroke-width="1.5" d="M21 12a8.958 8.958 0 0 1-1.526 5.016A8.991 8.991 0 0 1 12 21a8.991 8.991 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="currentColor" d="M13.25 9c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 14.75 9zM12 10.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 12 11.75zM10.75 9c0-.69.56-1.25 1.25-1.25v-1.5A2.75 2.75 0 0 0 9.25 9zM12 7.75c.69 0 1.25.56 1.25 1.25h1.5A2.75 2.75 0 0 0 12 6.25zM5.166 17.856l-.719-.214l-.117.392l.267.31zm13.668 0l.57.489l.266-.31l-.117-.393zM9 15.75h6v-1.5H9zm0-1.5a4.752 4.752 0 0 0-4.553 3.392l1.438.428A3.252 3.252 0 0 1 9 15.75zm3 6a8.23 8.23 0 0 1-6.265-2.882l-1.138.977A9.73 9.73 0 0 0 12 21.75zm3-4.5c1.47 0 2.715.978 3.115 2.32l1.438-.428A4.752 4.752 0 0 0 15 14.25zm3.265 1.618A8.23 8.23 0 0 1 12 20.25v1.5a9.73 9.73 0 0 0 7.403-3.405z"/></g></svg>
        </div>
        </div>
    </section>
    <!-- END: Top Bar -->
    <!-- Filter laporan -->
    <section class="text-hitam-polteka my-8  bg-white rounded-lg p-6">
        <h2 class="text-xl font-medium">Filter Laporan Laboratorium</h2>
        <label class="block mt-4">
            <span class="text-sm font-medium">Mulai Tanggal</span>
            <input type="date" name="date" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="you@example.com" />
        </label>   
        <label class="block mt-4">
            <span class="text-sm font-medium">Sampai Tanggal</span>
            <input type="date" name="date" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="you@example.com" />
        </label>
        <label class="block mt-4">
            <span class="text-sm font-medium">Laporan</span>
            <div class="relative text-left">
                <div class="group">
                    <button type="button" class="inline-flex w-[150px] justify-center mt-2 rounded-md bg-white px-3 py-2 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Jenis Laporan
                        <!-- Dropdown arrow -->
                        <svg class="w-4 h-4 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 12l-5-5h10l-5 5z" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div
                        class="absolute left-0 w-40 mt-1 origin-top-left bg-white divide-y divide-gray-100 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-300">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Data Barang</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Barang Masuk</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Barang Keluar</a>
                        </div>
                    </div>
                </div>
            </div>
        </label>  
            <button type="button" class="inline-flex w-[100px] justify-center mt-5 mb-3 rounded-md px-3 py-2 text-sm bg-merah200-polteka text-putih-polteka shadow-sm">
                Tampilkan
            </button>  
    </section>  

    <!-- laporan yang sudah difilter  -->
    <section class="text-hitam-polteka mt-8 mb-12 bg-white rounded-lg p-6">
        <h2 class="text-xl font-medium">Laporan</h2>
        <div class="flex w-full mt-4">
            <span class="text-sm font-medium w-1/6">Mulai Tanggal</span>
            <span class="text-sm font-medium w-1/6 text-right pr-5">:</span>
            <span class="px-2 py-2 -mt-2 w-2/3 bg-white border shadow-sm border-slate-300 text-slate-400 focus:outline-none block rounded-md sm:text-sm focus:ring-1">11/11/2020</span>
        </div>    
        <div class="flex w-full mt-4">
            <span class="text-sm font-medium w-1/6">Sampai Tanggal</span>
            <span class="text-sm font-medium w-1/6 text-right pr-5">:</span>
            <span class="px-2 py-2 -mt-2 w-2/3 bg-white border shadow-sm border-slate-300 text-slate-400 focus:outline-none block rounded-md sm:text-sm focus:ring-1">11/11/2020</span>
        </div>  
        <div class="flex w-full mt-4">
            <span class="text-sm font-medium w-1/6">Jenis Laporan</span>
            <span class="text-sm font-medium w-1/6 text-right pr-5">:</span>
            <span class="px-2 py-2 -mt-2 w-2/3 bg-white border shadow-sm border-slate-300 text-slate-400 focus:outline-none block rounded-md sm:text-sm focus:ring-1">Barang Masuk</span>
        </div>  
            <button type="button" class="inline-flex w-[100px] justify-center mt-5 mb-3 rounded-md px-3 py-2 text-sm bg-merah200-polteka text-putih-polteka shadow-sm">
                Cetak
            </button>  
    </section>
    <!-- COPYRIGHT -->
    <footer class="block mt-6 sm:mt-20 md:mt-44 mb-6 text-center">
      <div class="text-biru160-polteka text-xs md:text-sm">
        © 2024 Tim Capstone 07 Teknik Komputer Universitas Diponegoro
      </div>
    </footer>
</div>

@endsection