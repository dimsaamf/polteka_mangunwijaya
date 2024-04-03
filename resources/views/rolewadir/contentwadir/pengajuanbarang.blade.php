@extends('rolewadir.layoutwadir.pengajuan')
@section('content')
<div class="bg-abu-polteka font-polteka w-full min-h-[500px] px-8 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8 mb-0 overflow-x-auto">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2  mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
            <div class="text-hitam-polteka">Pengajuan Barang</div>
        </div> 
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Wadir</div>
            <svg class="my-1.5 text-hitam-polteka" xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center bg-putih-polteka border-y-8 border-abu-polteka">
                            <td class="px-6 py-2 whitespace-nowrap rounded-l-xl">1</td>
                            <td class="px-6 py-2 whitespace-nowrap">Lorem-ipsum-dolor</td>
                            <td class="px-6 py-2 whitespace-nowrap">00-00-0000</td>
                            <td class="px-6 py-2 whitespace-nowrap">Lorem ipsum dolor</td>
                            <td class="px-6 py-2 whitespace-nowrap">Rp 000.000</td>
                            <td class="px-6 py-2 whitespace-nowrap"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" viewBox="0 0 1920 1536"><path fill="currentColor" d="M640 448q0 80-56 136t-136 56t-136-56t-56-136t56-136t136-56t136 56t56 136m1024 384v448H256v-192l320-320l160 160l512-512zm96-704H160q-13 0-22.5 9.5T128 160v1216q0 13 9.5 22.5t22.5 9.5h1600q13 0 22.5-9.5t9.5-22.5V160q0-13-9.5-22.5T1760 128m160 32v1216q0 66-47 113t-113 47H160q-66 0-113-47T0 1376V160Q0 94 47 47T160 0h1600q66 0 113 47t47 113"/></svg></td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl">
                                <div class="group">
                                    <button type="button" class="inline-flex w-[98px] justify-center rounded-md bg-merah180-polteka px-1 py-1 text-sm font-semibold text-putih-polteka hover:bg-merah180-polteka">
                                        Status
                                        <!-- Dropdown arrow -->
                                            <svg class="h-5 ml-[2px] -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 12l-5-5h10l-5 5z" />
                                            </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div class="absolute lg:right-16 xl:right-20 mt-4 w-36 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-300">
                                        <div class="py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Disetujui</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ditunda</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ditolak</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr class="text-center bg-putih-polteka border-y-8 border-abu-polteka">
                            <td class="px-6 py-2 whitespace-nowrap rounded-l-xl">1</td>
                            <td class="px-6 py-2 whitespace-nowrap">Lorem-ipsum-dolor</td>
                            <td class="px-6 py-2 whitespace-nowrap">00-00-0000</td>
                            <td class="px-6 py-2 whitespace-nowrap">Lorem ipsum dolor</td>
                            <td class="px-6 py-2 whitespace-nowrap">Rp 000.000</td>
                            <td class="px-6 py-2 whitespace-nowrap"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" viewBox="0 0 1920 1536"><path fill="currentColor" d="M640 448q0 80-56 136t-136 56t-136-56t-56-136t56-136t136-56t136 56t56 136m1024 384v448H256v-192l320-320l160 160l512-512zm96-704H160q-13 0-22.5 9.5T128 160v1216q0 13 9.5 22.5t22.5 9.5h1600q13 0 22.5-9.5t9.5-22.5V160q0-13-9.5-22.5T1760 128m160 32v1216q0 66-47 113t-113 47H160q-66 0-113-47T0 1376V160Q0 94 47 47T160 0h1600q66 0 113 47t47 113"/></svg></td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl">
                                <div class="group">
                                    <button type="button" class="inline-flex w-[98px] justify-center rounded-md bg-merah180-polteka px-1 py-1 text-sm font-semibold text-putih-polteka hover:bg-merah180-polteka">
                                        Status
                                        <!-- Dropdown arrow -->
                                            <svg class="h-5 ml-[2px] -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 12l-5-5h10l-5 5z" />
                                            </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div class="absolute right-14 lg:right-16 xl:right-20 mt-4 w-36 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-300">
                                        <div class="py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Disetujui</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ditunda</a>
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ditolak</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
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
    <footer class="block mt-6 sm:mt-20 md:mt-44 lg:mt-56 mb-6 text-center">
      <div class="text-biru160-polteka text-xs md:text-sm">
        © 2024 Tim Capstone 07 Teknik Komputer Universitas Diponegoro
      </div>
    </footer>
</div>

@endsection