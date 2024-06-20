@extends('roleadminlabankes.layoutadminlab.labmikro.databarang')
@section('content')
@include('sweetalert::alert')

<div class="bg-abu-polteka font-polteka w-full min-h-[500px] px-8 md:rounded-xl rounded-[30px] md:mt-0 md:ml-0 md:mr-0 mt-6 ml-8 mr-8 mb-0 overflow-x-auto">
    <!-- BEGIN: Top Bar -->
    <section class="w-full mt-2  mb-5 h-14 border-b border-slate-300">
        <div class= "flex">
        <div class="flex md:hidden my-4 w-1/2 justify-start text-sm"> 
            <div class="text-hitam-polteka">Data Barang</div>
        </div> 
        <div class="hidden md:flex my-4 w-1/2 justify-start text-xs sm:text-md md:text-[13px] lg:text-lg">
            <div class="mr-2 text-merah180-polteka">Hai, Admin Lab Mikro</div>
            <svg class="my-1.5 text-hitam-polteka md:w-[9px] md:h-[9px] lg:w-[12px] lg:h-[12px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M7 1L5.6 2.5L13 10l-7.4 7.5L7 19l9-9z"/></svg>
            <div class="ml-2 text-hitam-polteka">Data Barang</div>
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
        <h2 class="text-xl font-semibold">Data Barang</h2>

        <!-- BEGIN: Data List --> 
        <div class="flex flex-col mt-8">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <div class="flex">
                        <div class="flex w-1/2 justify-start mb-3">
                            <a href="{{ route('tambahbarangadminlabmikro') }}" type="button" class="w-[130px] mb-3 rounded-md px-3 py-2 text-sm bg-merah200-polteka text-putih-polteka shadow-sm">
                                Tambah Barang
                            </a>
                        </div>
                        <div class="flex w-1/2 justify-end mt-2">
                            <div class ="bg-merah180-polteka w-2/3 h-10 flex items-center rounded-l-full rounded-r-full">
                                <form action="{{ route('databarangadminlabmikro') }}" method="GET" class="relative flex w-full">
                                    <div class ="bg-abu-polteka w-11/12 h-9 ml-0.5 rounded-l-full"> 
                                        <div class="relative flex">   
                                            <input
                                                type="text"
                                                name="search"
                                                class="relative m-0 block flex-auto rounded-l-full border border-none bg-transparent bg-clip-padding px-3 py-[0.25rem] text-md font-normal leading-[1.6] text-surface outline-none transition duration-200 ease-in-out placeholder:text-hitam-polteka placeholder:text-opacity-30 focus:z-[3] focus:border-none focus:shadow-inset focus:outline-none motion-reduce:transition-none"
                                                placeholder="Cari barang"/>
                                        </div>
                                    </div>
                                    <button type="submit" class="absolute right-0 top-0 bottom-0 flex items-center justify-center w-10 h-full rounded-r-full bg-merah180-polteka dark:bg-merah180-polteka dark:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="mt-8 min-w-full text-sm text-hitam-polteka">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">No</th>
                            <th scope="col" class="px-6 py-3 text-center">Barcode</th>
                            <th scope="col" class="px-6 py-3 text-center">Nama Barang</th>
                            <th scope="col" class="px-6 py-3 text-center">ID Barang</th>
                            <th scope="col" class="px-6 py-3 text-center">Jumlah</th>
                            <th scope="col" class="px-6 py-3 text-center">Harga</th>
                            <th scope="col" class="px-6 py-3 text-center">Gambar</th>
                            <th scope="col" class="px-6 py-3 text-center">Ubah</th>
                            <th scope="col" class="px-6 py-3 text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($labmikro->isEmpty())
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center">Tidak ada data yang tersedia.</td>
                            </tr>
                        @else
                        @foreach($labmikro as $data)
                        <tr class="text-center bg-putih-polteka border-y-8 border-abu-polteka">
                            <input type="hidden" class="delete_id" value="{{$data->id}}">
                            {{-- <td class="px-6 py-2 whitespace-nowrap text-center flex justify-center items-center rounded-l-xl">{!! DNS2D::getBarcodeHTML("$data->kode_barang", 'QRCODE', 2, 2) !!}</td> --}}
                            {{-- <td class="px-6 py-2 whitespace-nowrap text-center flex justify-center items-center rounded-l-xl">
                                <button data-modal-toggle="popup-modal">
                                    <img src="{{ asset($data->kode_barang . 'qrcode.png') }}" alt="Barcode">
                                </button> --}}
                                <!-- Di dalam loop foreach -->
                            <td class="px-6 py-2 whitespace-nowrap rounded-l-xl">{{ ($labmikro->currentPage() - 1) * $labmikro->perPage() + $loop->index + 1 }}</td>
                            <td class="px-6 py-2 whitespace-nowrap text-center flex justify-center items-center rounded-l-xl">
                                <button data-modal-toggle="popup-modal" data-src="{{ asset('storage/barcodes/' . $data->kode_barang . 'qrcode.png') }}">
                                    {{-- <img src="{{ asset($data->kode_barang . 'qrcode.png') }}" alt="Barcode"> --}}
                                    <img src="{{ asset('storage/barcodes/' . $data->kode_barang . 'qrcode.png') }}" alt="QR Code Barang">

                                </button>
                            </td>
                            {{-- </td> --}}
                            <td class="px-6 py-2 whitespace-nowrap">{{$data->nama_barang}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$data->kode_barang}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{$data->jumlah}} {{$data->satuan}}</td>
                            <td class="px-6 py-2 whitespace-nowrap">Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-2 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        @if($data->gambar)
                                            <a href="{{ route('get.gambar.invlabmikro.adminlab', ['id' => $data->id]) }}" target="_blank">
                                                <img src="{{ asset('storage/gambars/' . $data->gambar) }}" alt="Gambar Barang" class="w-10">
                                            </a>
                                        @else
                                            <span>Tidak ada gambar</span>
                                        @endif
                                    </div>
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl">
                                <a href="{{ route('ubahbarangadminlabmikro', $data->id) }}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><path fill="black" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z"/><path fill="black" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2z"/></svg>
                                </a>
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap rounded-r-xl">
                                    
                                    <form action="{{ route('hapusbarangmikro', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btndelete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mx-auto text-red-600" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/></svg>
                                        </button>
                                    </form>
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
        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="fixed inset-0 overflow-y-auto flex items-center justify-center z-50">
                <div class="fixed inset-0 bg-black opacity-25"></div>
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <div id="barcodeContainer"></div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="flex flex-col my-12 py-4 items-center space-y-5 overflow-x-auto">
            <ul class="inline-flex mx-autospace-x-2">
                @if ($labmikro->onFirstPage())
                    <li>
                        <span class="px-4 py-2 text-gray-400 text-sm">Sebelumnya</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $labmikro->previousPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold text-sm">Sebelumnya</a>
                    </li>
                @endif
        
                @foreach ($labmikro->getUrlRange($labmikro->currentPage() - 2, $labmikro->currentPage() + 2) as $page => $url)
                    @if ($page == $labmikro->currentPage())
                        <li>
                            <a href="{{ $url }}" class="px-4 py-2 text-putih-polteka bg-biru160-polteka hover:bg-biru100-polteka rounded-full text-sm">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
        
                @if ($labmikro->hasMorePages())
                    <li>
                        <a href="{{ $labmikro->nextPageUrl() }}" class="px-4 py-2 text-hitam-polteka hover:font-bold hover:text-hitam-polteka text-sm">Selanjutnya</a>
                    </li>
                @else
                    <li>
                        <span class="px-4 py-2 text-gray-400 text-sm">Selanjutnya</span>
                    </li>
                @endif
            </ul>
        </div>
        <!-- END: Pagination -->
        <!-- Add the modal code at the bottom of the blade file -->
        <div id="popup-modal" class="fixed inset-0 overflow-y-auto overflow-x-hidden z-50 justify-center items-center hidden">
            <div class="fixed inset-0 bg-black opacity-25"></div>
            <div class="relative bg-white rounded-lg shadow">
                <button @click="open = false" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <img id="barcodeImage" src="" alt="Barcode" class="mx-auto">
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
    <footer class="block mt-6 sm:mt-20 md:mt-44 lg:mt-56 mb-6 text-center">
      <div class="text-biru160-polteka text-xs md:text-sm">
        © 2024 Tim Capstone 07 Teknik Komputer Universitas Diponegoro
      </div>
    </footer>
</div>

<!-- Di dalam tag <script> -->
    <script>
        document.querySelectorAll('[data-modal-toggle]').forEach((toggle) => {
            toggle.addEventListener('click', () => {
                const modal = document.getElementById('popup-modal');
                modal.classList.remove('hidden');
                const src = toggle.getAttribute('data-src');
                modal.querySelector('#barcodeImage').src = src;
            });
        });
    
        document.querySelectorAll('[data-modal-hide]').forEach((hide) => {
            hide.addEventListener('click', () => {
                const modal = document.getElementById('popup-modal');
                modal.classList.add('hidden');
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

    <!-- Pastikan jQuery dimuat sebelum kode JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Pastikan SweetAlert dimuat sebelum kode JavaScript -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btndelete').click(function (e){
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_id').val();

            swal({
                title: "Apakah anda yakin?",
                text: "Setelah dihapus, Anda tidak dapat memulihkan Tag ini lagi!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var data = {
                        "_token": $('input[name=_token]').val(),
                        'id': deleteid,
                    };
                    $.ajax({
                        type: "DELETE",
                        url: '/adminlabankes/labmikro/databarang/' + deleteid,
                        data: data,
                        success: function(response) {
                            swal(response.status, {
                                icon: "success",
                            }).then((result) => {
                                if (result) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            swal("Oops!", "Terjadi kesalahan saat menghapus data.", "error");
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    });
</script>
@endsection