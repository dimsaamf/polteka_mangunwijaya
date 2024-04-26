@extends('rolewadir.layoutwadir.dashboard')
@section('content')
@include('sweetalert::alert')
    @if(session('status'))
        <div class="alert alert-success font-polteka text-hitam-polteka">
            {{ session('status') }}
        </div>
    @endif

<div class="bg-abu-polteka w-full min-h-[500px] px-9 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2  mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
            <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
                <div class="text-hitam-polteka">Dashboard</div>
            </div> 
            <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-lg">
                <div class="mr-2 text-merah180-polteka">Hai, Wadir</div>
                <svg class="my-1.5 text-hitam-polteka" xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
                <div class="ml-2  text-hitam-polteka">Dashboard</div>
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
            <h2 class="text-xl font-medium">DASHBOARD</h2>
            <div class=" bg-white mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
                <div class=" gap-6 mt-3">
                        <div class=" p-6">
                            <div class="text-xl font-medium">Selamat Datang, {{ Auth::user()->name }}!</div>
                            <div class="text-md text-slate-500 mt-1 font-semibold text-justify">Anda Login sebagai Wakil Direktur II Bidang Rumah Tangga Polteka Mangunwijaya</div>
                        </div>
                </div>
            </div>
            <div class="flex">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-8 w-full">
                    <div class="bg-white mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
                        <div class="box p-6">
                            <div class="text-3xl font-medium">9999</div>
                            <div class="text-sm text-slate-500 mt-1 font-semibold">Barang</div>
                        </div>
                    </div>
                    <div class="bg-white mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
                        <div class="box p-6">
                            <div class="text-3xl font-medium">9999</div>
                            <div class="text-sm text-slate-500 mt-1 font-semibold">Barang Masuk</div>
                        </div>
                    </div>
                    <div class="bg-white mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
                        <div class="box p-6">
                            <div class="text-3xl font-medium">9999</div>
                            <div class="text-sm text-slate-500 mt-1 font-semibold">Barang Keluar</div>
                        </div>
                    </div>
                    <div class="bg-white mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
                        <div class="box p-6">
                            <div class="text-3xl font-medium">9999</div>
                            <div class="text-sm text-slate-500 mt-1 font-semibold">Pengajuan Barang</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div id="popup-modal" tabindex="-1" class="flex w-full h-full ">
                <div class="relative py-4 pointer-events-auto">
                    <div class="relative rounded-lg shadow bg-kuning-polteka">
                        <div class="grid grid-cols-7 gap-1">
                            <div class="py-3 flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 xl:w-6 xl:h-6" viewBox="0 0 16 16"><path fill="white" fill-rule="evenodd" d="M6.285 1.975C7.06.68 8.939.68 9.715 1.975l5.993 9.997c.799 1.333-.161 3.028-1.716 3.028H2.008C.453 15-.507 13.305.292 11.972zM8 5a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 5m1 6.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0" clip-rule="evenodd"/></svg>
                            </div>
                            <div class="col-span-4 grid grid-rows-2 gap-[1px] py-3 flex justify-start text-[11px] xl:text-sm items-center text-putih-polteka">
                                    <p class="font-semibold mr-1">Perhatian!<span class="font-normal"> Stok alat hampir habis! </span></p> 
                                    Mohon segera diperbarui!
                            </div>
                            <div class="col-span-2 py-3 flex justify-center items-center">
                                <button data-modal-hide="popup-modal" type="button" class="text-putih-polteka inline-flex text-[9px] xl:text-sm font-semibold items-center px-5 py-2.5 text-center">
                                    LIHAT DETAIL
                                </button>
                                
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div id="popup-modal" tabindex="-1" class="flex w-full h-full ">
                <div class="relative py-4 pointer-events-auto">
                    <div class="relative rounded-lg shadow bg-kuning-polteka">
                        <div class="grid grid-cols-7 gap-1">
                            <div class="py-3 flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 xl:w-6 xl:h-6" viewBox="0 0 16 16"><path fill="white" fill-rule="evenodd" d="M6.285 1.975C7.06.68 8.939.68 9.715 1.975l5.993 9.997c.799 1.333-.161 3.028-1.716 3.028H2.008C.453 15-.507 13.305.292 11.972zM8 5a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 5m1 6.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0" clip-rule="evenodd"/></svg>
                            </div>
                            <div class="col-span-4 grid grid-rows-2 gap-[1px] py-3 flex justify-start text-[11px] xl:text-sm items-center text-putih-polteka">
                                    <p class="font-semibold mr-1">Perhatian!<span class="font-normal"> Stok bahan hampir habis! </span></p> 
                                    Mohon segera diperbarui!
                            </div>
                            <div class="col-span-2 py-3 flex justify-center items-center">
                                <button data-modal-hide="popup-modal1" type="button" class="text-putih-polteka inline-flex text-[9px] xl:text-sm font-semibold items-center px-5 py-2.5 text-center">
                                    LIHAT DETAIL
                                </button>
                                
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div id="popup-modal" tabindex="-1" class="flex w-full h-full ">
                <div class="relative py-4 pointer-events-auto">
                    <div class="relative rounded-lg shadow bg-kuning-polteka">
                        <div class="grid grid-cols-7 gap-1">
                            <div class="py-3 flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 xl:w-6 xl:h-6" viewBox="0 0 16 16"><path fill="white" fill-rule="evenodd" d="M6.285 1.975C7.06.68 8.939.68 9.715 1.975l5.993 9.997c.799 1.333-.161 3.028-1.716 3.028H2.008C.453 15-.507 13.305.292 11.972zM8 5a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 5m1 6.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0" clip-rule="evenodd"/></svg>
                            </div>
                            <div class="col-span-4 gap-[1px] py-3 flex justify-start text-[11px] xl:text-sm items-center text-putih-polteka">
                                    <p class="font-semibold mr-1">Perhatian!<span class="font-normal"> Stok alat hampir habis! </span></p> 
                            </div>
                            <div class="col-span-2 py-3 flex justify-center items-center">
                                <button data-modal-hide="popup-modal2" type="button" class="text-putih-polteka inline-flex text-[9px] xl:text-sm font-semibold items-center px-5 py-2.5 text-center">
                                    LIHAT DETAIL
                                </button>
                                
                            </div>
                        </div> 
                    </div>
                </div>
            </div> --}}
        
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
    <footer class="block mt-6 sm:mt-44 md:mt-[350px] mb-6 text-center">
        <div class="text-biru160-polteka text-xs md:text-sm">
            © 2024 Tim Capstone 07 Teknik Komputer Universitas Diponegoro
        </div>
    </footer>
</div>

<style>
    .icon-container.active {
        background-color:#D9D9D9;
        border-radius: 50%;
        padding: 0.2rem;
    }
</style>

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

@endsection