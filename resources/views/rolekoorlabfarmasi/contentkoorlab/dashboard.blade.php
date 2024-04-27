@extends('rolekoorlabfarmasi.layoutkoorlab.dashboard')
@section('content')
<div class="bg-abu-polteka w-full min-h-[500px] px-9 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2  mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm">
            <div class="text-hitam-polteka">Dashboard</div>
        </div>
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-[13px] lg:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Koor Lab Prodi Farmasi</div>
            <svg class="my-1.5 text-hitam-polteka md:w-[9px] md:h-[9px] lg:w-[12px] lg:h-[12px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
            <div class="ml-2  text-hitam-polteka">Dashboard</div>
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
        <h2 class="text-xl font-medium">DASHBOARD</h2>
        <div class="flex">
            <div class="grid grid-cols-3 sm:grid-cols-6 md:grid-cols-9 sm:gap-8 mb-10 w-full">
                <div class="col-span-3 sm:col-span-2 md:col-span-12 md:col-start-1 md:col-end-4 bg-white mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
                    <div class=" gap-6 mt-3">
                        <div class="col-span-8 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="box p-6">
                                <div class="text-3xl font-medium">9999</div>
                                <div class="text-sm text-slate-500 mt-1 font-semibold">Barang Tersedia</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 sm:col-span-2 md:col-span-12 md:col-start-4 md:col-end-7 bg-white mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
                    <div class=" gap-6 mt-3">
                        <div class="col-span-8 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="box p-6">
                                <div class="text-3xl font-medium">9999</div>
                                <div class="text-sm text-slate-500 mt-1 font-semibold">Barang Hampir Habis</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 sm:col-span-2 md:col-span-12 md:col-start-7 md:col-end-10 bg-white mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
                    <div class=" gap-6 mt-3">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="box p-6">
                                <div class="text-3xl font-medium">9999</div>
                                <div class="text-sm text-slate-500 mt-1 font-semibold">Barang Rusak</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="flex">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10 w-full">
                    <div class="bg-white mt-2 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg w-full">
                    <div class=" p-6">
                            <div class="text-xl font-medium mb-1">Barang Hampir Habis</div>
                            @foreach($data['barangHabis'] as $barang)
                                <div class="w-full flex text-black border-b-2 py-3">
                                    <div class="w-1/8">
                                        <div class="flex bg-[#D0E5FF] rounded-full w-[1.8rem] h-[1.8rem] m-auto mx-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" class="my-auto mx-auto" viewBox="0 0 16 16"><path fill="#020320" d="M6.923 1.378a3 3 0 0 1 2.154 0l4.962 1.908a1.5 1.5 0 0 1 .961 1.4v6.626a1.5 1.5 0 0 1-.961 1.4l-4.962 1.909a3 3 0 0 1-2.154 0l-4.961-1.909a1.5 1.5 0 0 1-.962-1.4V4.686a1.5 1.5 0 0 1 .962-1.4zm1.795.933a2 2 0 0 0-1.436 0l-1.384.533l5.59 2.116l1.948-.834zM14 4.971L8.5 7.33v6.428c.074-.019.146-.042.218-.07l4.962-1.908a.5.5 0 0 0 .32-.467zm-6.5 8.786V7.33L2 4.972v6.34a.5.5 0 0 0 .32.467l4.962 1.908c.072.028.144.051.218.07M2.564 4.126L8 6.456l2.164-.928l-5.667-2.146z"/></svg>
                                        </div>
                                    </div>
                                    <div class="w-7/8 ml-2">
                                        <div class="text-sm">{{ $barang->nama_barang }}</div>
                                        <div class="text-xs text-slate-500">Stok saat ini {{ $barang->jumlah }}</div>
                                    </div>
                                </div>
                                @endforeach
                                @if ($data['barangHabis']->isEmpty())
                                    <div class="text-sm text-gray-500 mt-4">Tidak ada barang yang stoknya habis saat ini.</div>
                                @endif
                            </div>
                    </div>
                    <div class="bg-white mt-2 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg w-full">
                        <div class="p-6">
                            <div class="text-xl font-medium mb-1">Barang Perlu Diservice</div>
                            @foreach ($notifications as $notification)
                                <div class="w-full flex text-black border-b-2 py-3">
                                    <div class="w-1/8">
                                        <div class="flex bg-[#FFCDCD] rounded-full w-[1.8rem] h-[1.8rem] m-auto mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" class="my-auto mx-auto" viewBox="0 0 24 24">
                                                <path fill="#620000" d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98m-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4m0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-5/6 ml-2">
                                        <div class="text-sm">{{ $notification->nama_barang }}</div>
                                        <div class="text-xs text-slate-500">Service pada tanggal {{ $notification->tanggal_service }}</div>
                                    </div>
                                    <form action="{{ route('update.notification', $notification->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="w-full mt-3 flex justify-end">
                                            <input type="checkbox" name="sudah_dilayani[]" value="{{ $notification->id }}" onchange="this.form.submit()" {{ $notification->sudah_dilayani ? 'checked' : '' }}>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                    
                            @if ($notifications->isEmpty())
                                <div class="text-sm text-gray-500 mt-4">Tidak ada barang yang perlu diservice saat ini.</div>
                            @endif
                        </div>
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

@endsection
