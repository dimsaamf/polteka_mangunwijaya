@extends('rolewadir.layoutwadir.laporanlab')
@section('content')
<div class="bg-abu-polteka w-full min-h-[500px] px-9 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8 overflow-x-auto">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2  mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
            <div class="text-hitam-polteka">Laporan Lab</div>
        </div> 
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-[13px] lg:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Wadir</div>
            <svg class="my-1.5 text-hitam-polteka md:w-[9px] md:h-[9px] lg:w-[12px] lg:h-[12px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
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
            Cetak PDF
        </button>
        <!-- BEGIN: Data List -->
        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <div class="flex w-full mt-4 justify-end">
                        <div class ="bg-merah180-polteka w-2/5 h-10 flex justify-start items-center rounded-l-full rounded-r-full">
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
                                stroke="currentColor">
                                    <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <table class="min-w-full text-sm text-hitam-polteka mt-10">
                    <thead>
                        <tr >
                            <th scope="col" class="px-6 py-3 text-center">No</th>
                            <th scope="col" class="px-6 py-3 text-center">Nama Barang</th>
                            <th scope="col" class="px-6 py-3 text-center">ID Barang</th>
                            <th scope="col" class="px-6 py-3 text-center">Tanggal Masuk</th>
                            <th scope="col" class="px-6 py-3 text-center">Jumlah</th>
                            <th scope="col" class="px-6 py-3 text-center">Keterangan</th>
                            <th scope="col" class="px-6 py-3 text-center">Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center bg-abu-polteka ">
                            <td class="px-6 py-2 whitespace-nowrap rounded-l-xl">1</td>
                            <td class="px-6 py-2 whitespace-nowrap">Lorem ipsum dolor</td>
                            <td class="px-6 py-2 whitespace-nowrap">ID6373</td>
                            <td class="px-6 py-2 whitespace-nowrap">00-00-0000</td>
                            <td class="px-6 py-2 whitespace-nowrap">9999</td>
                            <td class="px-6 py-2 whitespace-nowrap">Lorem ipsum dolor</td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" viewBox="0 0 1920 1536"><path fill="currentColor" d="M640 448q0 80-56 136t-136 56t-136-56t-56-136t56-136t136-56t136 56t56 136m1024 384v448H256v-192l320-320l160 160l512-512zm96-704H160q-13 0-22.5 9.5T128 160v1216q0 13 9.5 22.5t22.5 9.5h1600q13 0 22.5-9.5t9.5-22.5V160q0-13-9.5-22.5T1760 128m160 32v1216q0 66-47 113t-113 47H160q-66 0-113-47T0 1376V160Q0 94 47 47T160 0h1600q66 0 113 47t47 113"/></svg></td>
                        </tr>

                        <tr class="text-center bg-putih-polteka">
                            <td class="px-6 py-1 whitespace-nowrap"></td>
                            <td class="px-6 py-1 whitespace-nowrap"></td>
                            <td class="px-6 py-1 whitespace-nowrap"></td>
                            <td class="px-6 py-1 whitespace-nowrap"></td>
                            <td class="px-6 py-1 whitespace-nowrap"></td>
                            <td class="px-6 py-1 whitespace-nowrap"></td>
                            <td class="px-6 py-1 whitespace-nowrap"></td>
                        </tr>

                        <tr class="text-center bg-abu-polteka ">
                            <td class="px-6 py-2 whitespace-nowrap rounded-l-xl">1</td>
                            <td class="px-6 py-2 whitespace-nowrap">Lorem ipsum dolor</td>
                            <td class="px-6 py-2 whitespace-nowrap">ID6373</td>
                            <td class="px-6 py-2 whitespace-nowrap">00-00-0000</td>
                            <td class="px-6 py-2 whitespace-nowrap">9999</td>
                            <td class="px-6 py-2 whitespace-nowrap">Lorem ipsum dolor</td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" viewBox="0 0 1920 1536"><path fill="currentColor" d="M640 448q0 80-56 136t-136 56t-136-56t-56-136t56-136t136-56t136 56t56 136m1024 384v448H256v-192l320-320l160 160l512-512zm96-704H160q-13 0-22.5 9.5T128 160v1216q0 13 9.5 22.5t22.5 9.5h1600q13 0 22.5-9.5t9.5-22.5V160q0-13-9.5-22.5T1760 128m160 32v1216q0 66-47 113t-113 47H160q-66 0-113-47T0 1376V160Q0 94 47 47T160 0h1600q66 0 113 47t47 113"/></svg></td>
                        </tr>
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
    <footer class="block mt-6 sm:mt-20 md:mt-44 mb-6 text-center">
      <div class="text-biru160-polteka text-xs md:text-sm">
        © 2024 Tim Capstone 07 Teknik Komputer Universitas Diponegoro
      </div>
    </footer>
</div>

@endsection