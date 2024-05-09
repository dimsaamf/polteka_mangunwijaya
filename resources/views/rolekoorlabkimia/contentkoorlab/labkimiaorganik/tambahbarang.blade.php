@extends('rolekoorlabkimia.layoutkoorlab.labkimiaorganik.tambahbarang')
@section('content')

<div class="bg-abu-polteka w-full min-h-[500px] px-9 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2 mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
            <div class="text-hitam-polteka">Tambah Barang</div>
        </div> 
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-[13px] lg:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Koor Lab Kimia Organik</div>
            <svg class="my-1.5 text-hitam-polteka md:w-[9px] md:h-[9px] lg:w-[12px] lg:h-[12px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
            <div class="ml-2  text-hitam-polteka">Tambah Barang</div>
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
    <!-- Filter laporan -->
    <section class="text-hitam-polteka my-8  bg-white rounded-lg p-6">
        <h2 class="text-xl font-medium">Tambah Barang</h2>
        <form action="{{ route('tambahbarangkoorlabkimiaorganik.store') }}" method="POST" enctype="multipart/form-data">  
        @csrf
        <label class="block mt-4">
            <span class="text-sm font-medium">Nama*</span>
            <input type="text" name="nama_barang" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Nama Barang" />
            @error('nama_barang')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </label>   
        <!-- <label class="block mt-4">
            <span class="text-sm font-medium">ID Barang</span>
            <input type="text" name="id" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Lorem ipsum" />
        </label> -->
        <div class="grid grid-cols-1 md:grid-cols-4 md:gap-7 gap-4 mt-4">
            <label class="block md:col-span-2">
                <span class="text-sm font-medium">Jumlah*</span>
                <input name="jumlah" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Jumlah Barang" />
                @error('jumlah')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </label>
            <label class="block md:col-span-1">
                <span class="text-sm font-medium">Satuan*</span>
                <div class="relative text-left">
                    <div class="group">
                        <div class="inline-flex w-full justify-start mt-2 rounded-md bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <select  name="satuan" id="satuan" class="form-control @error('satuan') is-invalid @enderror w-full" required>
                                <option value="">Pilih Satuan</option>
                                <option value="ml">ml</option>
                                <option value="gr">gr</option>
                                <option value="pcs">pcs</option>
                                <option value="lembar">lembar</option>
                            </select>
                        </div>
                    </div>
                </div>
            </label>
            <label class="block md:col-span-1">
                <span class="text-sm font-medium">Jumlah Minimal*</span>
                <input name="jumlah_min" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Jumlah Minimal" />
                @error('jumlah_min')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </label>
        </div>
        <label class="block mt-4">
            <span class="text-sm font-medium">Apakah perlu pengingat tanggal service?</span>
            <select name="reminder" id="reminder" class="form-control">
                <option value="1">Ya</option>
                <option value="0" selected>Tidak</option>
            </select>
        </label>
        
        <div id="tanggal_service_input" style="display: none;" class="grid grid-cols-1 md:grid-cols-3 md:gap-7 gap-4 mt-4">
            <label class="block md:col-span-2">
                <span class="text-sm font-medium">Tanggal Service</span>
                <input id="tanggal_service" type="date" name="tanggal_service" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"/>
            </label>
            <label id="periode_input" class="block md:col-span-1">
                <span class="text-sm font-medium">Periode Service</span>
                <div class="flex mt-2">
                    <input id="periode" type="number" name="periode" class="px-3 py-[9px] bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Periode Service" />
                    <span class="ml-2 mt-2 font-bold">bulan</span>
                </div>
            </label>
        </div>     
        <label class="block mt-4">
            <span class="text-sm font-medium">Harga*</span>
            <input type="number" name="harga" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Harga Barang" />
            @error('harga')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </label>
        <label class="block mt-4">
            <span class="text-sm font-medium">Keterangan</span>
            <input type="text" name="keterangan" class="mt-2 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Keterangan" />
            @error('keterangan')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </label>
        <label class="block mt-4">
            <span class="text-sm font-medium">Gambar</span>
            <input type="file" name="gambar" class="mt-2 mr-4 block w-full sm:text-sm"/>
            @error('gambar')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </label>        
            <button type="submit" class="inline-flex w-20 justify-center mt-8 mb-3 rounded-md px-3 py-2 text-sm bg-merah200-polteka text-putih-polteka shadow-sm">
                Submit
            </button> 
        </form>
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
    <footer class="block mt-6 sm:mt-20 lg:mt-28 xl:mt-20 mb-6 text-center">
        <div class="text-biru160-polteka text-xs md:text-sm">
            © 2024 Tim Capstone 07 Teknik Komputer Universitas Diponegoro
        </div>
    </footer> 
</div>

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

<script>
    document.getElementById('reminder').addEventListener('change', function() {
        var isServiceNeeded = this.value;
        var tanggalServiceInput = document.getElementById('tanggal_service_input');
        
        if (isServiceNeeded === '1') {
            tanggalServiceInput.style.display = 'grid';
            document.getElementById('tanggal_service').setAttribute('required', 'required');
        } else {
            tanggalServiceInput.style.display = 'none';
            document.getElementById('tanggal_service').removeAttribute('required');
        }
    });

    document.getElementById('reminder').addEventListener('change', function() {
        var isServiceNeeded = this.value;
        var tanggalServiceInput = document.getElementById('periode_input');
        
        if (isServiceNeeded === '1') {
            tanggalServiceInput.style.display = 'grid';
            document.getElementById('periode').setAttribute('required', 'required');
        } else {
            tanggalServiceInput.style.display = 'none';
            document.getElementById('periode').removeAttribute('required');
        }
    });
    
    // Set default value for tanggal service if needed
    window.onload = function() {
        var isServiceNeeded = document.getElementById('reminder').value;
        var tanggalServiceInput = document.getElementById('tanggal_service_input');
    
        if (isServiceNeeded === '1') {
            tanggalServiceInput.style.display = 'grid';
        } else {
            tanggalServiceInput.style.display = 'none';
        }
    };

    window.onload = function() {
        var isServiceNeeded = document.getElementById('reminder').value;
        var tanggalServiceInput = document.getElementById('periode_input');
    
        if (isServiceNeeded === '1') {
            tanggalServiceInput.style.display = 'grid';
        } else {
            tanggalServiceInput.style.display = 'none';
        }
    };
    </script>

@endsection