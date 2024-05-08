@extends('rolekoorlabankes.layoutkoorlab.dashboard')
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
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-[13px] lg:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Koor Lab Prodi Analisis Kesehatan</div>
            <svg class="my-1.5 text-hitam-polteka md:w-[9px] md:h-[9px] lg:w-[12px] lg:h-[12px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
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
        <div>
        <h2 class="text-xl font-medium">DASHBOARD</h2>
        <div class=" bg-white mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
            <div class=" gap-6 mt-3">
                    <div class=" p-6">
                        <div class="text-xl font-medium">Selamat Datang, {{ Auth::user()->name }}!</div>
                        <div class="text-md text-slate-500 mt-1 font-normal text-justify">Anda Login sebagai Koor Laboratorium Prodi Analisis Kesehatan Polteka Mangunwijaya</div>
                    </div>
            </div>
        </div>
        <div class="flex">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3 md:gap-8 w-full mb-5">
                <div class="bg-white flex mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg justify-center items-center">
                    <div class="box py-6 px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16" viewBox="0 0 24 24"><path fill="black" d="M22 3H2v6h1v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9h1zM4 5h16v2H4zm15 15H5V9h14zM9 11h6a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2"/></svg>
                    </div>
                    <div class="box p-6">
                        <div class="text-3xl font-medium">{{ $total_barang }}</div>
                        <div class="text-sm text-slate-500 mt-1 font-semibold">Barang</div>
                    </div>
                </div>
                <div class="bg-white flex mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg justify-center items-center">
                    <div class="box py-6 px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16" viewBox="0 0 24 24"><path fill="black" d="m21.706 5.292l-2.999-2.999A.996.996 0 0 0 18 2H6a.997.997 0 0 0-.707.293L2.294 5.292A.996.996 0 0 0 2 6v13c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6a.994.994 0 0 0-.294-.708M6.414 4h11.172l1 1H5.414zM12 18l-5-5h3v-3h4v3h3z"/></svg>
                    </div>
                    <div class="box p-6">
                        <div class="text-3xl font-medium">{{ $total_masuk }}</div>
                        <div class="text-sm text-slate-500 mt-1 font-semibold">Barang Masuk</div>
                    </div>
                </div>
                <div class="bg-white flex mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg justify-center items-center">
                    <div class="box py-6 px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16" viewBox="0 0 24 24"><path fill="black" d="m21.706 5.292l-2.999-2.999A.996.996 0 0 0 18 2H6a.996.996 0 0 0-.707.293L2.294 5.292A.994.994 0 0 0 2 6v13c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6a.994.994 0 0 0-.294-.708M6.414 4h11.172l1 1H5.414zM14 14v3h-4v-3H7l5-5l5 5z"/></svg>
                    </div>
                    <div class="box p-6">
                        <div class="text-3xl font-medium">{{ $total_keluar }}</div>
                        <div class="text-sm text-slate-500 mt-1 font-semibold">Barang Keluar</div>
                    </div>
                </div>
                <div class="bg-white flex mt-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg justify-center items-center">
                    <div class="box py-6 px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16" viewBox="0 0 24 24"><path fill="black" d="m15.5 17.125l4.95-4.95q.275-.275.7-.275t.7.275t.275.7t-.275.7l-5.65 5.65q-.3.3-.7.3t-.7-.3l-2.85-2.85q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h4.175q.275-.875 1.075-1.437T12 1q1 0 1.788.563T14.85 3H19q.825 0 1.413.588T21 5v4q0 .425-.288.713T20 10t-.712-.288T19 9V5h-2v2q0 .425-.288.713T16 8H8q-.425 0-.712-.288T7 7V5H5v14h5q.425 0 .713.288T11 20t-.288.713T10 21zm7-16q.425 0 .713-.288T13 4t-.288-.712T12 3t-.712.288T11 4t.288.713T12 5"/></svg>
                    </div>
                    <div class="box p-6">
                        <div class="text-3xl font-medium">{{ $pengajuan }}</div>
                        <div class="text-sm text-slate-500 mt-1 font-semibold">Pengajuan Barang</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-10 w-full">
                    <div class="bg-white col-span-1 mt-2 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg w-full">
                    <div class=" p-6">
                            <div class="text-xl font-medium mb-1">Barang Hampir Habis</div>
                            @foreach($barangHabis as $barang)
                                <div class="w-full flex text-black border-b-2 py-3">
                                    <div class="w-1/8">
                                        <div class="flex bg-[#D0E5FF] rounded-full w-[1.8rem] h-[1.8rem] m-auto mx-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" class="my-auto mx-auto" viewBox="0 0 16 16"><path fill="#020320" d="M6.923 1.378a3 3 0 0 1 2.154 0l4.962 1.908a1.5 1.5 0 0 1 .961 1.4v6.626a1.5 1.5 0 0 1-.961 1.4l-4.962 1.909a3 3 0 0 1-2.154 0l-4.961-1.909a1.5 1.5 0 0 1-.962-1.4V4.686a1.5 1.5 0 0 1 .962-1.4zm1.795.933a2 2 0 0 0-1.436 0l-1.384.533l5.59 2.116l1.948-.834zM14 4.971L8.5 7.33v6.428c.074-.019.146-.042.218-.07l4.962-1.908a.5.5 0 0 0 .32-.467zm-6.5 8.786V7.33L2 4.972v6.34a.5.5 0 0 0 .32.467l4.962 1.908c.072.028.144.051.218.07M2.564 4.126L8 6.456l2.164-.928l-5.667-2.146z"/></svg>
                                        </div>
                                    </div>
                                    <div class="w-7/8 ml-2">
                                        <div class="text-sm">{{ $barang->nama_barang }}  (Lab {{ str_replace('App\Models\InventarisLab', '', get_class($barang)) }})</div>
                                        <div class="text-xs text-slate-500">Stok saat ini {{ $barang->jumlah }}</div>
                                    </div>
                                </div>
                                @endforeach
                                @if (count($barangHabis) === 0)
                                    <div class="text-sm text-gray-500 mt-4">Tidak ada barang yang stoknya habis saat ini.</div>
                                @endif
                            </div>
                            <!-- BEGIN: Pagination -->
                            <div class="flex flex-col my-2 py-3 items-center space-y-5 overflow-x-auto mb-4">
                                <ul class="inline-flex mx-autospace-x-2">
                                    @if ($barangHabis->onFirstPage())
                                        <li>
                                            <span class="px-4 py-2 text-gray-400 text-sm">Sebelumnya</span>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ $barangHabis->previousPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold text-sm">Sebelumnya</a>
                                        </li>
                                    @endif
                            
                                    @foreach ($barangHabis->getUrlRange($barangHabis->currentPage() - 2, $barangHabis->currentPage() + 2) as $page => $url)
                                        @if ($page == $barangHabis->currentPage())
                                            <li>
                                                <a href="{{ $url }}" class="px-4 py-2 text-putih-polteka bg-biru160-polteka hover:bg-biru100-polteka rounded-full text-sm">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                            
                                    @if ($barangHabis->hasMorePages())
                                        <li>
                                            <a href="{{ $barangHabis->nextPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold hover:text-hitam-polteka text-sm">Selanjutnya</a>
                                        </li>
                                    @else
                                        <li>
                                            <span class="px-4 py-2 text-gray-400 text-sm">Selanjutnya</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        <!-- END: Pagination -->
                    </div>
                    <div class="bg-white col-span-1 lg:col-span-2 mt-2 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg w-full">
                        <div class="p-6">
                            <div class="flex w-full">
                                <div class="flex w-1/2 justify-start text-xl font-medium mb-3">Barang Perlu Diservice</div>
                            </div>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-10 w-full">
                                <div class="bg-abu-polteka shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg w-full">
                                    <div class="p-6">
                                        <div class="flex w-full">
                                            <div class="flex w-1/2 justify-start text-lg font-medium mb-3">Lab Mikro</div>
                                            <div class="flex w-1/2 justify-end text-xl font-medium mb-1">
                                                <a href="{{ route('riwayat.mikro') }}" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24"><path fill="black" d="M13 3a9 9 0 0 0-9 9H1l3.89 3.89l.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7s-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42A8.954 8.954 0 0 0 13 21a9 9 0 0 0 0-18m-1 5v5l4.28 2.54l.72-1.21l-3.5-2.08V8z"/></svg>
                                                </a>
                                            </div>
                                        </div>
                                        <form action="{{ route('reminder.updatemikro') }}" method="post" id="reminderForm">
                                            @csrf
                                            @foreach ($mikroreminders as $reminder)
                                                <div class="w-full flex text-black border-b-2 py-3">
                                                    <div class="w-1/6">
                                                        <div class="flex bg-[#FFCDCD] rounded-full w-[1.8rem] h-[1.8rem] m-auto mr-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" class="my-auto mx-auto" viewBox="0 0 24 24">
                                                                <path fill="#620000" d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98m-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4m0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="w-4/6 ml-2">
                                                        <div class="text-sm">{{ $reminder->nama_barang }}</div>
                                                        <div class="text-xs text-slate-500">Service pada tanggal {{ $reminder->tanggal_service }}</div>
                                                    </div>
                                                    <div class="w-1/6 mt-3 flex justify-end">
                                                        <input type="checkbox" name="reminder_ids[]" value="{{ $reminder->id }}|{{ get_class($reminder) }}" class="reminderCheckbox">
                                                    </div>
                                                </div>
                                            @endforeach
                                    
                                            @if ($mikroreminders->isEmpty())
                                                <div class="text-sm text-gray-500 mt-4">Tidak ada barang yang perlu diservice saat ini.</div>
                                            @endif
                                            
                                            <button type="submit" class="inline-flex w-32 justify-center mt-8 mb-3 rounded-md px-1 py-2 text-xs bg-merah200-polteka text-putih-polteka shadow-sm">
                                                Update Reminder
                                            </button> 
                                        </form>
                                        <!-- BEGIN: Pagination -->
                                        <div class="flex flex-col my-2 py-3 items-center space-y-5 overflow-x-auto mb-4">
                                            <ul class="inline-flex mx-autospace-x-2">
                                                @if ($mikroreminders->onFirstPage())
                                                    <li>
                                                        <span class="px-4 py-2 text-gray-400 text-sm">Sebelumnya</span>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ $mikroreminders->previousPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold text-sm">Sebelumnya</a>
                                                    </li>
                                                @endif
                                        
                                                @foreach ($mikroreminders->getUrlRange($mikroreminders->currentPage() - 2, $mikroreminders->currentPage() + 2) as $page => $url)
                                                    @if ($page == $mikroreminders->currentPage())
                                                        <li>
                                                            <a href="{{ $url }}" class="px-4 py-2 text-putih-polteka bg-biru160-polteka hover:bg-biru100-polteka rounded-full text-sm">{{ $page }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                        
                                                @if ($mikroreminders->hasMorePages())
                                                    <li>
                                                        <a href="{{ $mikroreminders->nextPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold hover:text-hitam-polteka text-sm">Selanjutnya</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <span class="px-4 py-2 text-gray-400 text-sm">Selanjutnya</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- END: Pagination -->
                                    </div>
                                </div>
                                <div class="bg-abu-polteka shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg w-full">
                                    <div class="p-6">
                                        <div class="flex w-full">
                                            <div class="flex w-1/2 justify-start text-lg font-medium mb-3">Lab Medis</div>
                                            <div class="flex w-1/2 justify-end text-xl font-medium mb-1">
                                                <a href="{{ route('riwayat.medis') }}" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24"><path fill="black" d="M13 3a9 9 0 0 0-9 9H1l3.89 3.89l.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7s-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42A8.954 8.954 0 0 0 13 21a9 9 0 0 0 0-18m-1 5v5l4.28 2.54l.72-1.21l-3.5-2.08V8z"/></svg>
                                                </a>
                                            </div>
                                        </div>
                                        <form action="{{ route('reminder.updatemedis') }}" method="post" id="reminderForm">
                                            @csrf
                                            @foreach ($medisreminders as $reminder)
                                                <div class="w-full flex text-black border-b-2 py-3">
                                                    <div class="w-1/6">
                                                        <div class="flex bg-[#FFCDCD] rounded-full w-[1.8rem] h-[1.8rem] m-auto mr-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" class="my-auto mx-auto" viewBox="0 0 24 24">
                                                                <path fill="#620000" d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98m-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4m0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="w-4/6 ml-2">
                                                        <div class="text-sm">{{ $reminder->nama_barang }}</div>
                                                        <div class="text-xs text-slate-500">Service pada tanggal {{ $reminder->tanggal_service }}</div>
                                                    </div>
                                                    <div class="w-1/6 mt-3 flex justify-end">
                                                        <input type="checkbox" name="reminder_ids[]" value="{{ $reminder->id }}|{{ get_class($reminder) }}" class="reminderCheckbox">
                                                    </div>
                                                </div>
                                            @endforeach
                                    
                                            @if ($medisreminders->isEmpty())
                                                <div class="text-sm text-gray-500 mt-4">Tidak ada barang yang perlu diservice saat ini.</div>
                                            @endif
                                            
                                            <button type="submit" class="inline-flex w-32 justify-center mt-8 mb-3 rounded-md px-1 py-2 text-xs bg-merah200-polteka text-putih-polteka shadow-sm">
                                                Update Reminder
                                            </button> 
                                        </form>
                                        <!-- BEGIN: Pagination -->
                                        <div class="flex flex-col my-2 py-3 items-center space-y-5 overflow-x-auto mb-4">
                                            <ul class="inline-flex mx-autospace-x-2">
                                                @if ($medisreminders->onFirstPage())
                                                    <li>
                                                        <span class="px-4 py-2 text-gray-400 text-sm">Sebelumnya</span>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ $medisreminders->previousPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold text-sm">Sebelumnya</a>
                                                    </li>
                                                @endif
                                        
                                                @foreach ($medisreminders->getUrlRange($medisreminders->currentPage() - 2, $medisreminders->currentPage() + 2) as $page => $url)
                                                    @if ($page == $medisreminders->currentPage())
                                                        <li>
                                                            <a href="{{ $url }}" class="px-4 py-2 text-putih-polteka bg-biru160-polteka hover:bg-biru100-polteka rounded-full text-sm">{{ $page }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                        
                                                @if ($medisreminders->hasMorePages())
                                                    <li>
                                                        <a href="{{ $medisreminders->nextPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold hover:text-hitam-polteka text-sm">Selanjutnya</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <span class="px-4 py-2 text-gray-400 text-sm">Selanjutnya</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- END: Pagination -->
                                    </div>
                                </div>
                                <div class="bg-abu-polteka shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg w-full">
                                    <div class="p-6">
                                        <div class="flex w-full">
                                            <div class="flex w-1/2 justify-start text-lg font-medium mb-3">Lab Kimia</div>
                                            <div class="flex w-1/2 justify-end text-xl font-medium mb-1">
                                                <a href="{{ route('riwayat.ankeskimia') }}" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24"><path fill="black" d="M13 3a9 9 0 0 0-9 9H1l3.89 3.89l.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7s-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42A8.954 8.954 0 0 0 13 21a9 9 0 0 0 0-18m-1 5v5l4.28 2.54l.72-1.21l-3.5-2.08V8z"/></svg>
                                                </a>
                                            </div>
                                        </div>
                                        <form action="{{ route('reminder.updateankeskimia') }}" method="post" id="reminderForm">
                                            @csrf
                                            @foreach ($ankeskimiareminders as $reminder)
                                                <div class="w-full flex text-black border-b-2 py-3">
                                                    <div class="w-1/6">
                                                        <div class="flex bg-[#FFCDCD] rounded-full w-[1.8rem] h-[1.8rem] m-auto mr-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" class="my-auto mx-auto" viewBox="0 0 24 24">
                                                                <path fill="#620000" d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98m-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4m0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="w-4/6 ml-2">
                                                        <div class="text-sm">{{ $reminder->nama_barang }}</div>
                                                        <div class="text-xs text-slate-500">Service pada tanggal {{ $reminder->tanggal_service }}</div>
                                                    </div>
                                                    <div class="w-1/6 mt-3 flex justify-end">
                                                        <input type="checkbox" name="reminder_ids[]" value="{{ $reminder->id }}|{{ get_class($reminder) }}" class="reminderCheckbox">
                                                    </div>
                                                </div>
                                            @endforeach
                                    
                                            @if ($ankeskimiareminders->isEmpty())
                                                <div class="text-sm text-gray-500 mt-4">Tidak ada barang yang perlu diservice saat ini.</div>
                                            @endif
                                            
                                            <button type="submit" class="inline-flex w-32 justify-center mt-8 mb-3 rounded-md px-1 py-2 text-xs bg-merah200-polteka text-putih-polteka shadow-sm">
                                                Update Reminder
                                            </button> 
                                        </form>
                                        <!-- BEGIN: Pagination -->
                                        <div class="flex flex-col my-2 py-3 items-center space-y-5 overflow-x-auto mb-4">
                                            <ul class="inline-flex mx-autospace-x-2">
                                                @if ($ankeskimiareminders->onFirstPage())
                                                    <li>
                                                        <span class="px-4 py-2 text-gray-400 text-sm">Sebelumnya</span>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ $ankeskimiareminders->previousPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold text-sm">Sebelumnya</a>
                                                    </li>
                                                @endif
                                        
                                                @foreach ($ankeskimiareminders->getUrlRange($ankeskimiareminders->currentPage() - 2, $ankeskimiareminders->currentPage() + 2) as $page => $url)
                                                    @if ($page == $ankeskimiareminders->currentPage())
                                                        <li>
                                                            <a href="{{ $url }}" class="px-4 py-2 text-putih-polteka bg-biru160-polteka hover:bg-biru100-polteka rounded-full text-sm">{{ $page }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                        
                                                @if ($ankeskimiareminders->hasMorePages())
                                                    <li>
                                                        <a href="{{ $ankeskimiareminders->nextPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold hover:text-hitam-polteka text-sm">Selanjutnya</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <span class="px-4 py-2 text-gray-400 text-sm">Selanjutnya</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- END: Pagination -->
                                    </div>
                                </div>
                                <div class="bg-abu-polteka shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg w-full">
                                    <div class="p-6">
                                        <div class="flex w-full">
                                            <div class="flex w-2/3 justify-start text-lg font-medium mb-3">Lab Sitohisto</div>
                                            <div class="flex w-1/3 justify-end text-xl font-medium mb-1">
                                                <a href="{{ route('riwayat.sitohisto') }}" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem" viewBox="0 0 24 24"><path fill="black" d="M13 3a9 9 0 0 0-9 9H1l3.89 3.89l.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7s-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42A8.954 8.954 0 0 0 13 21a9 9 0 0 0 0-18m-1 5v5l4.28 2.54l.72-1.21l-3.5-2.08V8z"/></svg>
                                                </a>
                                            </div>
                                        </div>
                                        <form action="{{ route('reminder.updatesitohisto') }}" method="post" id="reminderForm">
                                            @csrf
                                            @foreach ($sitohistoreminders as $reminder)
                                                <div class="w-full flex text-black border-b-2 py-3">
                                                    <div class="w-1/6">
                                                        <div class="flex bg-[#FFCDCD] rounded-full w-[1.8rem] h-[1.8rem] m-auto mr-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" class="my-auto mx-auto" viewBox="0 0 24 24">
                                                                <path fill="#620000" d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98m-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4m0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="w-4/6 ml-2">
                                                        <div class="text-sm">{{ $reminder->nama_barang }}</div>
                                                        <div class="text-xs text-slate-500">Service pada tanggal {{ $reminder->tanggal_service }}</div>
                                                    </div>
                                                    <div class="w-1/6 mt-3 flex justify-end">
                                                        <input type="checkbox" name="reminder_ids[]" value="{{ $reminder->id }}|{{ get_class($reminder) }}" class="reminderCheckbox">
                                                    </div>
                                                </div>
                                            @endforeach
                                    
                                            @if ($sitohistoreminders->isEmpty())
                                                <div class="text-sm text-gray-500 mt-4">Tidak ada barang yang perlu diservice saat ini.</div>
                                            @endif
                                            
                                            <button type="submit" class="inline-flex w-32 justify-center mt-8 mb-3 rounded-md px-1 py-2 text-xs bg-merah200-polteka text-putih-polteka shadow-sm">
                                                Update Reminder
                                            </button> 
                                        </form>
                                        <!-- BEGIN: Pagination -->
                                        <div class="flex flex-col my-2 py-3 items-center space-y-5 overflow-x-auto mb-4">
                                            <ul class="inline-flex mx-autospace-x-2">
                                                @if ($sitohistoreminders->onFirstPage())
                                                    <li>
                                                        <span class="px-4 py-2 text-gray-400 text-sm">Sebelumnya</span>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ $sitohistoreminders->previousPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold text-sm">Sebelumnya</a>
                                                    </li>
                                                @endif
                                        
                                                @foreach ($sitohistoreminders->getUrlRange($sitohistoreminders->currentPage() - 2, $sitohistoreminders->currentPage() + 2) as $page => $url)
                                                    @if ($page == $sitohistoreminders->currentPage())
                                                        <li>
                                                            <a href="{{ $url }}" class="px-4 py-2 text-putih-polteka bg-biru160-polteka hover:bg-biru100-polteka rounded-full text-sm">{{ $page }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                        
                                                @if ($sitohistoreminders->hasMorePages())
                                                    <li>
                                                        <a href="{{ $sitohistoreminders->nextPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold hover:text-hitam-polteka text-sm">Selanjutnya</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <span class="px-4 py-2 text-gray-400 text-sm">Selanjutnya</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- END: Pagination -->
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>               
                </div>
            </div>
        </div>
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
