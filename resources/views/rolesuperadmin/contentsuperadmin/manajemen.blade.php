@extends('rolesuperadmin.layoutsuperadmin.manajemen')
@section('content')
<div class="bg-abu-polteka font-polteka w-full min-h-[500px] px-8 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8 mb-0 overflow-x-auto">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2  mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
            <div class="text-hitam-polteka">Manajemen Pengguna</div>
        </div> 
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-[13px] lg:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Superadmin</div>
            <svg class="my-1.5 text-hitam-polteka md:w-[9px] md:h-[9px] lg:w-[12px] lg:h-[12px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
            <div class="ml-2  text-hitam-polteka">Manajemen Pengguna</div>
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
        <h2 class="text-xl font-semibold">Pengguna</h2>

        <!-- BEGIN: Data List --> 
        <div class="flex flex-col mt-3">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                <div class="flex w-1/2 justify-start mt-2">
                        <a href="{{ route('tambahpenggunasuperadmin') }}" type="button" class="w-[150px] mb-3 rounded-md px-3 py-2 text-sm bg-merah200-polteka text-putih-polteka shadow-sm">
                            Tambah Pengguna
                        </a>
                    </div>
                    <table class="mt-4 min-w-full text-sm text-hitam-polteka">
                    <thead>
                    <tr >
                            <th scope="col" class="px-6 py-3 text-center">No</th>
                            <th scope="col" class="px-6 py-3 text-center">Nama Pengguna</th>
                            <th scope="col" class="px-6 py-3 text-center">Username</th>
                            <th scope="col" class="px-6 py-3 text-center">Email</th>
                            <th scope="col" class="px-6 py-3 text-center">Password</th>
                            <th scope="col" class="px-6 py-3 text-center">Role</th>
                            <th scope="col" class="px-6 py-3 text-center">Edit</th>
                            <th scope="col" class="px-6 py-3 text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center bg-putih-polteka border-y-8 border-abu-polteka">
                            <td class="px-6 py-2 whitespace-nowrap rounded-l-xl">1</td>
                            <td class="px-6 py-2 whitespace-nowrap">Lorem-ipsum-dolor</td>
                            <td class="px-6 py-2 whitespace-nowrap">Loremipsum</td>
                            <td class="px-6 py-2 whitespace-nowrap">admin@gmail.com</td>
                            <td class="px-6 py-2 whitespace-nowrap">KACDSCSICJCK</td>
                            <td class="px-6 py-2 whitespace-nowrap">admin</td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl">
                                <a href="{{ route('editpenggunasuperadmin') }}" data-modal-target="default-modal" data-modal-toggle="default-modal" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><path fill="black" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"/><path fill="black" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2z"/></svg>
                                </a>
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl"><svg xmlns="http://www.w3.org/2000/svg" class="mx-auto" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.55" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/></svg></td>
                        </tr>

                        <tr class="text-center bg-putih-polteka border-y-8 border-abu-polteka">
                            <td class="px-6 py-2 whitespace-nowrap rounded-l-xl">2</td>
                            <td class="px-6 py-2 whitespace-nowrap">Lorem-ipsum-dolor</td>
                            <td class="px-6 py-2 whitespace-nowrap">Loremipsum</td>
                            <td class="px-6 py-2 whitespace-nowrap">admin@gmail.com</td>
                            <td class="px-6 py-2 whitespace-nowrap">KACDSCSICJCK</td>
                            <td class="px-6 py-2 whitespace-nowrap">admin</td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl">
                                <a href="{{ route('editpenggunasuperadmin') }}" data-modal-target="default-modal" data-modal-toggle="default-modal" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><path fill="black" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"/><path fill="black" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2z"/></svg>
                                </a>
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl"><svg xmlns="http://www.w3.org/2000/svg" class="mx-auto" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.55" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/></svg></td>
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