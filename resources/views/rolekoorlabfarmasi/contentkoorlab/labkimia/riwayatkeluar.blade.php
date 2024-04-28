@extends('rolekoorlabfarmasi.layoutkoorlab.labkimia.barangkeluar')
@section('content')
<div class="bg-abu-polteka font-polteka w-full min-h-[500px] px-8 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8 mb-0 overflow-x-auto">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2  mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
            <div class="text-hitam-polteka">Riwayat Barang Keluar</div>
        </div>
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-[13px] lg:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Koor Lab Kimia</div>
            <svg class="my-1.5 text-hitam-polteka md:w-[9px] md:h-[9px] lg:w-[12px] lg:h-[12px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
            <div class="ml-2  text-hitam-polteka">Riwayat Barang Keluar</div>
        </div> 
        <div class="hidden md:flex my-4 w-1/2 justify-end text-hitam-polteka">
            <button id="open-modal-btn2">
                <div class="icon-container-prof">
                    @if (Auth::user()->avatar)
                        <div class="w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                            <img alt="foto profil" src="{{ route('avatar', ['filename' => Auth::user()->avatar]) }}">
                        </div>
                    @else
                        <svg class="ml-2 mt-1 w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none"><path stroke="currentColor" stroke-width="1.5" d="M21 12a8.958 8.958 0 0 1-1.526 5.016A8.991 8.991 0 0 1 12 21a8.991 8.991 0 0 1-7.474-3.984A9 9 0 1 1 21 12Z"/><path fill="currentColor" d="M13.25 9c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 14.75 9zM12 10.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 12 11.75zM10.75 9c0-.69.56-1.25 1.25-1.25v-1.5A2.75 2.75 0 0 0 9.25 9zM12 7.75c.69 0 1.25.56 1.25 1.25h1.5A2.75 2.75 0 0 0 12 6.25zM5.166 17.856l-.719-.214l-.117.392l.267.31zm13.668 0l.57.489l.266-.31l-.117-.393zM9 15.75h6v-1.5H9zm0-1.5a4.752 4.752 0 0 0-4.553 3.392l1.438.428A3.252 3.252 0 0 1 9 15.75zm3 6a8.23 8.23 0 0 1-6.265-2.882l-1.138.977A9.73 9.73 0 0 0 12 21.75zm3-4.5c1.47 0 2.715.978 3.115 2.32l1.438-.428A4.752 4.752 0 0 0 15 14.25zm3.265 1.618A8.23 8.23 0 0 1 12 20.25v1.5a9.73 9.73 0 0 0 7.403-3.405z"/></g></svg>
                    @endif
                </div>
            </button>
        </div>
        </div>
    </section>
    <!-- END: Top Bar -->
    <section class="text-hitam-polteka">
        <h2 class="text-xl font-semibold">Riwayat Barang Keluar</h2>
        
        <!-- BEGIN: Data List --> 
        <div class="flex flex-col mt-8">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                <div class="flex">
                    <!-- <div class="flex w-full justify-end mb-3">
                                    <div class ="bg-merah180-polteka w-1/3 h-10 flex items-center rounded-l-full rounded-r-full">
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
                    </div> -->
                    <table class="min-w-full text-sm text-hitam-polteka">
                    <thead>
                        <tr >
                            <th scope="col" class="px-6 py-3 text-center">No</th>
                            <th scope="col" class="px-6 py-3 text-center">Nama Barang</th>
                            <th scope="col" class="px-6 py-3 text-center">ID Barang</th>
                            <th scope="col" class="px-6 py-3 text-center">Tanggal keluar</th>
                            <th scope="col" class="px-6 py-3 text-center">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($BarangKeluarKimia->isEmpty())
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center">Tidak ada data yang tersedia.</td>
                            </tr>
                        @else
                        @foreach($BarangKeluarKimia as $item)
                        <tr class="text-center bg-putih-polteka border-y-8 border-abu-polteka">
                            <td>{{ $loop->iteration }}</td>
                            <td class="px-6 py-2 whitespace-nowrap">@foreach($data as $barang)
                                @if($barang->id == $item->id_barang)
                                    {{ $barang->nama_barang }}
                                @endif
                            @endforeach</td>
                            <td class="px-6 py-2 whitespace-nowrap">@foreach($data as $barang)
                                @if($barang->id == $item->id_barang)
                                    {{ $barang->kode_barang }}
                                @endif
                            @endforeach</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $item->tanggal_keluar }}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $item->jumlah_keluar }}
                            @foreach($data as $barang)
                                @if($barang->id == $item->id_barang)
                                    {{ $barang->satuan }}
                                @endif
                            @endforeach</td>
                        </tr>
                        @endforeach
                        @endif
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
        <!-- Modal Profile -->
        <div id="modal2" class="fixed z-10 inset-0 hidden">
            <div class="flex mr-16 mt-40 md:mr-16 md:mt-24 justify-end">
                <div class="bg-merah200-polteka w-auto p-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
                    <div class="w-full flex items-center text-putih-polteka">
                        <!-- Avatar -->
                        <div class="w-1/12">
                            @if (Auth::user()->avatar)
                                <div class="w-10 h-10 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                                    <img alt="foto profil" src="{{ route('avatar', ['filename' => Auth::user()->avatar]) }}">
                                </div>
                            @else
                                <div class="w-11 h-11 rounded-full bg-abu-polteka overflow-hidden shadow-lg image-fit zoom-in">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-11 h-11 mt-2" viewBox="0 0 24 24"><path fill="black" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd"/></svg>
                                </div>
                            @endif
                        </div>
                        <!-- Nama dan Email -->
                        <div class="w-11/12 ml-7 flex justify-between items-center">
                            <div class="flex flex-col mr-5">
                                <h2 class="text-md font-semibold">{{ Auth::user()->name }}</h2>
                                <h2 class="text-sm">{{ Auth::user()->email }}</h2>
                            </div>
                            <!-- Tombol Close -->
                            <div>
                                <button class="w-8 h-5" id="close-modal-btn2" type="button">X</button>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-4 border-b-0 border-abu-polteka w-full" />
                    <div class="w-full flex mt-4 text-putih-polteka">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="flex">
                                <div class="flex justify-start mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em" viewBox="0 0 1024 1024"><path fill="white" d="M868 732h-70.3c-4.8 0-9.3 2.1-12.3 5.8c-7 8.5-14.5 16.7-22.4 24.5a353.8 353.8 0 0 1-112.7 75.9A352.8 352.8 0 0 1 512.4 866c-47.9 0-94.3-9.4-137.9-27.8a353.8 353.8 0 0 1-112.7-75.9a353.3 353.3 0 0 1-76-112.5C167.3 606.2 158 559.9 158 512s9.4-94.2 27.8-137.8c17.8-42.1 43.4-80 76-112.5s70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8s94.3 9.3 137.9 27.8c42.2 17.8 80.1 43.4 112.7 75.9c7.9 7.9 15.3 16.1 22.4 24.5c3 3.7 7.6 5.8 12.3 5.8H868c6.3 0 10.2-7 6.7-12.3C798 160.5 663.8 81.6 511.3 82C271.7 82.6 79.6 277.1 82 516.4C84.4 751.9 276.2 942 512.4 942c152.1 0 285.7-78.8 362.3-197.7c3.4-5.3-.4-12.3-6.7-12.3m88.9-226.3L815 393.7c-5.3-4.2-13-.4-13 6.3v76H488c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h314v76c0 6.7 7.8 10.5 13 6.3l141.9-112a8 8 0 0 0 0-12.6"/></svg>
                                </div>
                                <div>
                                    <div class="text-md font-semibold">{{ __('Logout') }}</div>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
</script>

<script>
    document.getElementById("open-modal-btn2").addEventListener("click", function() {
        document.getElementById("modal2").classList.remove("hidden");
        document.querySelector(".icon-container-prof").classList.add("active");
    });
    document.getElementById("close-modal-btn2").addEventListener("click", function() {
        document.getElementById("modal2").classList.add("hidden");
        document.querySelector(".icon-container-prof").classList.remove("active");
    });
    window.onload = function() {
        document.getElementById("modal2").classList.add("hidden");
        document.querySelector(".icon-container-prof").classList.remove("active");
    };
</script>
<!-- Script -->

@endsection