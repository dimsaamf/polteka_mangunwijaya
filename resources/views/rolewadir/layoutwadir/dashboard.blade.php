<!DOCTYPE html>
<html>
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('logo.png') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Dashboard Wadir</title>
    </head>
    <!-- END: Head -->
    <body class="py-5 bg-merah200-polteka text-putih-polteka font-polteka">
        <!-- BEGIN: Mobile Menu -->
        <div class="block md:hidden bg-merah200-polteka text-putih-polteka">
            <div class="flex mr-auto">
                <a href="#" class="ml-8 flex-grow">
                    <img alt="Logo" class="w-10" src="{{ asset('logoputih.png') }}">
                </a>
                <a href="#" class="mr-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 buttonToogle" viewBox="0 0 24 24"><path fill="currentColor" d="M4 18h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1m0-5h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1M3 7c0 .55.45 1 1 1h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1"/></svg>
                </a>
            </div>
            <hr class="border-1 w-full mt-3 border-putih-polteka border-opacity-25">
            <ul class="py-5 mx-8 mobileMenu hidden">
                <li>
                    <a href="{{ route('dashboardwadir') }}" class="flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7" viewBox="0 0 1024 1024"><path fill="currentColor" d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 0 0-44.4 0L77.5 505a63.9 63.9 0 0 0-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0 0 18.7-45.3c0-17-6.7-33.1-18.8-45.2M568 868H456V664h112zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7l23.1 23.1L882 542.3z"/></svg>
                        </div>
                        <div class="ml-3 mt-1 font-semibold">
                            Dashboard
                        </div>
                    </a>
                </li>
                <li class="menu__devider my-6"></li>
                <li>
                    <a href="{{ route('pengajuanwadir') }}" class="flex hover:font-bold">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.55" d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm0 5h18M10 3v18"/></svg>
                        </div>
                        <div class="ml-3 mt-1">
                            Pengajuan Barang
                        </div>
                    </a>
                </li>
                <li class="menu__devider my-6"></li>
                <li>
                    <a href="{{ route('laporanlabwadir') }}" class="flex hover:font-bold">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7" viewBox="0 0 24 24"><path fill="currentColor" d="m16 11.78l4.24-7.33l1.73 1l-5.23 9.05l-6.51-3.75L5.46 19H22v2H2V3h2v14.54L9.5 8z"/></svg>
                        </div>
                        <div class="ml-3 mt-1">
                            Laporan Laboratorium
                        </div>
                    </a>
                </li>
                <li class="menu__devider my-6"></li>
                <li>
                    <a href="{{ route('laporanprodiwadir') }}" class="flex hover:font-bold">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7" viewBox="0 0 24 24"><path fill="currentColor" d="m16 11.78l4.24-7.33l1.73 1l-5.23 9.05l-6.51-3.75L5.46 19H22v2H2V3h2v14.54L9.5 8z"/></svg>
                        </div>
                        <div class="ml-3 mt-1">
                            Laporan Prodi
                        </div>
                    </a>
                </li> 
                <li class="menu__devider my-6"></li>   
                <li>
                    <a href="{{ route('ubahpasswadir') }}" class="flex hover:font-bold">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                        </div>
                        <div class="ml-3 mt-1">
                            Ubah Password
                        </div>
                    </a>
                </li>
                <li class="menu__devider my-6"></li>
                <li>
                    <a href="{{ route('ubahppwadir') }}" class="flex hover:font-bold">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                        </div>
                        <div class="ml-3 mt-1">
                            Ubah Gambar Profile
                        </div>
                    </a>
                </li>
                <li class="menu__devider my-10"></li>
                <li>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="flex">
                            <div class="flex justify-start mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-md font-semibold">{{ __('Logout') }}</div>
                            </div>
                        </button>
                    </form>
                </li>
            </ul> 
            <script>
                const buttonToogle = document.querySelector('.buttonToogle')
                const mobileMenu = document.querySelector('.mobileMenu')

                buttonToogle.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');
                })
            </script>
        </div>
        <!-- END: Mobile Menu -->
        <div class="flex mr-0 md:mr-8 bg-merah200-polteka text-putih-polteka">
            <!-- BEGIN: Side Menu -->
            <nav class="hidden md:block xl:w-[20%] lg:w-[12%] md:w-[12%]">
                <div href="" class="intro-x flex xl:justify-start md:justify-center lg:justify-center xl:pl-5 pt-4">
                    <img alt="Logo" class="xl:hidden lg:w-[50px] md:w-[50px] lg:mt-2" src="{{ asset('logoputih.png') }}">
                    <span class="xl:block hidden text-putih-polteka text-lg ml-3 font-semibold text-[20px]"> Polteka <br>Mangunwijaya</br> </span> 
                </div>
                <div class="my-7"></div>
                <ul>
                    <li>
                        <a href="{{ route('dashboardwadir') }}" class="hidden xl:justify-start xl:flex pt-2 text-hitam-polteka bg-abu-polteka rounded-full xl:ml-8 lg:ml-10 md:ml-6 w-full">
                            <div class="xl:ml-8 mb-3">
                                <svg href="{{ route('dashboardwadir') }}" xmlns="http://www.w3.org/2000/svg" class="xl:w-6 lg:w-8 lg:mr-10 xl:mr-0 md:w-8 md:mr-6" viewBox="0 0 1024 1024"><path fill="currentColor" d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 0 0-44.4 0L77.5 505a63.9 63.9 0 0 0-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0 0 18.7-45.3c0-17-6.7-33.1-18.8-45.2M568 868H456V664h112zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7l23.1 23.1L882 542.3z"/></svg>
                            </div>
                            <div class="ml-2 mb-3 font-semibold hidden xl:block">Dashboard</div>
                        </a>
                        <a href="{{ route('dashboardwadir') }}" class="xl:hidden justify-center flex pt-2 md:px-5 lg:px-7 text-hitam-polteka bg-abu-polteka rounded-full md:ml-6 lg:ml-10 w-full">
                            <div class="xl:ml-8 mb-3">
                                <svg href="{{ route('dashboardwadir') }}" xmlns="http://www.w3.org/2000/svg" class="xl:w-6 lg:w-8 lg:mr-10 xl:mr-0 md:w-8 md:mr-6" viewBox="0 0 1024 1024"><path fill="currentColor" d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 0 0-44.4 0L77.5 505a63.9 63.9 0 0 0-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0 0 18.7-45.3c0-17-6.7-33.1-18.8-45.2M568 868H456V664h112zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7l23.1 23.1L882 542.3z"/></svg>
                            </div>
                        </a>
                    </li>
                    <li class="my-6"></li>
                    <li>
                        <a class="md:justify-center lg:justify-center xl:justify-start flex">
                            <div class="xl:ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="xl:w-6 lg:w-8 md:w-8" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.55" d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm0 5h18M10 3v18"/></svg>
                            </div>
                            <div class="ml-2 mb-3 font-semibold hidden xl:block">Manajemen</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengajuanwadir') }}">
                            <div class="hidden xl:block ml-8 mb-3 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:ml-10 hover:w-full hover:py-2 hover:pl-5">
                                Pengajuan Barang
                            </div>
                        </a>
                        <a href="{{ route('pengajuanwadir') }}" class="xl:hidden justify-center hover:justify-start flex hover:pt-2 hover:md:px-5 hover:lg:px-7 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:md:ml-6 hover:lg:ml-10 hover:w-full">
                            <div class="xl:ml-8 mb-3">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="block xl:hidden md:w-8 " viewBox="0 0 256 256"><path fill="currentColor" d="M245 110.64a16 16 0 0 0-13-6.64h-16V88a16 16 0 0 0-16-16h-69.33l-27.73-20.8a16.14 16.14 0 0 0-9.6-3.2H40a16 16 0 0 0-16 16v144a8 8 0 0 0 8 8h179.1a8 8 0 0 0 7.59-5.47l28.49-85.47a16.05 16.05 0 0 0-2.18-14.42M93.34 64l27.73 20.8a16.12 16.12 0 0 0 9.6 3.2H200v16H69.77a16 16 0 0 0-15.18 10.94L40 158.7V64Z"/></svg>
                            </div>
                        </a>
                    </li>
                    <li class="my-6"></li>
                    <li>
                        <a class="md:justify-center lg:justify-center xl:justify-start flex">
                            <div class="xl:ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="xl:w-6 lg:w-8 md:w-8" viewBox="0 0 24 24"><path fill="currentColor" d="m16 11.78l4.24-7.33l1.73 1l-5.23 9.05l-6.51-3.75L5.46 19H22v2H2V3h2v14.54L9.5 8z"/></svg>
                            </div>
                            <div class="ml-2 mb-3 font-semibold hidden xl:block">Laporan</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('laporanlabwadir') }}">
                            <div class="hidden xl:block ml-8 mb-3 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:ml-10 hover:w-full hover:py-2 hover:pl-5">
                                Laporan Laboratorium
                            </div>
                        </a>
                        <a href="{{ route('laporanlabwadir') }}" class="xl:hidden justify-center hover:justify-start flex hover:pt-2 hover:md:px-5 hover:lg:px-7 hover:mb-2 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:md:ml-6 hover:lg:ml-10 hover:w-full">
                            <div class="xl:ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block xl:hidden xl:w-6 lg:w-8 md:w-8" viewBox="0 0 256 256"><path fill="currentColor" d="M245 110.64a16 16 0 0 0-13-6.64h-16V88a16 16 0 0 0-16-16h-69.33l-27.73-20.8a16.14 16.14 0 0 0-9.6-3.2H40a16 16 0 0 0-16 16v144a8 8 0 0 0 8 8h179.1a8 8 0 0 0 7.59-5.47l28.49-85.47a16.05 16.05 0 0 0-2.18-14.42M93.34 64l27.73 20.8a16.12 16.12 0 0 0 9.6 3.2H200v16H69.77a16 16 0 0 0-15.18 10.94L40 158.7V64Z"/></svg>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('laporanprodiwadir') }}">
                            <div class="hidden xl:block ml-8 mb-3 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:ml-10 hover:w-full hover:py-2 hover:pl-5"> 
                                Laporan Prodi 
                            </div>
                        </a>
                        <a href="{{ route('laporanprodiwadir') }}" class="xl:hidden justify-center hover:justify-start flex hover:pt-2 hover:md:px-5 hover:lg:px-7 hover:mb-2 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:md:ml-6 hover:lg:ml-10 hover:w-full">
                            <div class="xl:ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block xl:hidden xl:w-6 lg:w-8 md:w-8" viewBox="0 0 256 256"><path fill="currentColor" d="M245 110.64a16 16 0 0 0-13-6.64h-16V88a16 16 0 0 0-16-16h-69.33l-27.73-20.8a16.14 16.14 0 0 0-9.6-3.2H40a16 16 0 0 0-16 16v144a8 8 0 0 0 8 8h179.1a8 8 0 0 0 7.59-5.47l28.49-85.47a16.05 16.05 0 0 0-2.18-14.42M93.34 64l27.73 20.8a16.12 16.12 0 0 0 9.6 3.2H200v16H69.77a16 16 0 0 0-15.18 10.94L40 158.7V64Z"/></svg>
                            </div>
                        </a>
                    </li>
                    <li class="my-6"></li>
                    <li>
                        <a class="md:justify-center lg:justify-center xl:justify-start flex">
                            <div class="xl:ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="xl:w-6 xl:h-6 w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                                </svg>
                            </div>
                            <div class="ml-2 mb-3 font-semibold hidden xl:block">Pengaturan</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ubahpasswadir') }}">
                            <div class="hidden xl:block ml-8 mb-3 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:ml-10 hover:w-full hover:py-2 hover:pl-5">
                                Ubah Password
                            </div>
                        </a>
                        <a href="{{ route('ubahpasswadir') }}" class="xl:hidden justify-center hover:justify-start flex hover:pt-2 hover:md:px-5 hover:lg:px-7 hover:mb-2 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:md:ml-6 hover:lg:ml-10 hover:w-full">
                            <div class="xl:ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block xl:hidden xl:w-6 lg:w-8 md:w-8" viewBox="0 0 256 256"><path fill="currentColor" d="M245 110.64a16 16 0 0 0-13-6.64h-16V88a16 16 0 0 0-16-16h-69.33l-27.73-20.8a16.14 16.14 0 0 0-9.6-3.2H40a16 16 0 0 0-16 16v144a8 8 0 0 0 8 8h179.1a8 8 0 0 0 7.59-5.47l28.49-85.47a16.05 16.05 0 0 0-2.18-14.42M93.34 64l27.73 20.8a16.12 16.12 0 0 0 9.6 3.2H200v16H69.77a16 16 0 0 0-15.18 10.94L40 158.7V64Z"/></svg>
                            </div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('ubahppwadir') }}">
                                    <div class="hidden xl:block ml-8 mb-3 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:ml-10 hover:w-full hover:py-2 hover:pl-5"> 
                                    Ubah Gambar Profil 
                                    </div>
                                </a>
                                <a href="{{ route('ubahppwadir') }}" class="xl:hidden justify-center hover:justify-start flex hover:pt-2 hover:md:px-5 hover:lg:px-7 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:md:ml-6 hover:lg:ml-10 hover:w-full">
                                    <div class="xl:ml-8 mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="block xl:hidden xl:w-6 lg:w-8 md:w-8" viewBox="0 0 256 256"><path fill="currentColor" d="M245 110.64a16 16 0 0 0-13-6.64h-16V88a16 16 0 0 0-16-16h-69.33l-27.73-20.8a16.14 16.14 0 0 0-9.6-3.2H40a16 16 0 0 0-16 16v144a8 8 0 0 0 8 8h179.1a8 8 0 0 0 7.59-5.47l28.49-85.47a16.05 16.05 0 0 0-2.18-14.42M93.34 64l27.73 20.8a16.12 16.12 0 0 0 9.6 3.2H200v16H69.77a16 16 0 0 0-15.18 10.94L40 158.7V64Z"/></svg>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="my-8"></li>
                    <li>
                        <a href="#" class="md:justify-center lg:justify-center xl:justify-start flex">
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                            <button type="submit" class="xl:ml-8 mb-3 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="xl:w-6 xl:h-6 w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                                <div class="ml-2 mb-3 font-semibold hidden xl:block"> {{ __('Logout') }}</div>
                            </button>
                        </form>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            @yield('content')
            <!-- END: Content -->
        </div>
        <!-- Modal Notif -->
        <div id="modal" class="fixed z-10 inset-0 hidden">
            <div class="flex mr-24 mt-40 md:mr-24 md:mt-24 justify-end">
                <div class="bg-putih-polteka w-[285px] p-6 shadow-[rgba(0,0,15,0.5)_2px_2px_2px_0px] shadow-slate-300 rounded-lg">
                    <div class="w-full flex  text-black">
                        <div class="w-1/2 flex justify-start">
                            <h2 class="text-xl font-semibold" id="modal-title">Notifikasi</h2>
                        </div>
                        <div class="w-1/2 flex justify-end">
                            <button id="close-modal-btn" type="button">X</button>
                        </div>
                    </div>
                    <!-- notif -->
                    <div class="w-full flex mt-4 text-black border-b-2 py-3">
                        <div class="flex justify-start bg-[#FFCDCD] rounded-full w-[1.8rem] h-[1.8rem] m-auto mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" class="my-auto mx-auto" viewBox="0 0 24 24"><path fill="#620000" d="M19.9 12.66a1 1 0 0 1 0-1.32l1.28-1.44a1 1 0 0 0 .12-1.17l-2-3.46a1 1 0 0 0-1.07-.48l-1.88.38a1 1 0 0 1-1.15-.66l-.61-1.83a1 1 0 0 0-.95-.68h-4a1 1 0 0 0-1 .68l-.56 1.83a1 1 0 0 1-1.15.66L5 4.79a1 1 0 0 0-1 .48L2 8.73a1 1 0 0 0 .1 1.17l1.27 1.44a1 1 0 0 1 0 1.32L2.1 14.1a1 1 0 0 0-.1 1.17l2 3.46a1 1 0 0 0 1.07.48l1.88-.38a1 1 0 0 1 1.15.66l.61 1.83a1 1 0 0 0 1 .68h4a1 1 0 0 0 .95-.68l.61-1.83a1 1 0 0 1 1.15-.66l1.88.38a1 1 0 0 0 1.07-.48l2-3.46a1 1 0 0 0-.12-1.17ZM18.41 14l.8.9l-1.28 2.22l-1.18-.24a3 3 0 0 0-3.45 2L12.92 20h-2.56L10 18.86a3 3 0 0 0-3.45-2l-1.18.24l-1.3-2.21l.8-.9a3 3 0 0 0 0-4l-.8-.9l1.28-2.2l1.18.24a3 3 0 0 0 3.45-2L10.36 4h2.56l.38 1.14a3 3 0 0 0 3.45 2l1.18-.24l1.28 2.22l-.8.9a3 3 0 0 0 0 3.98m-6.77-6a4 4 0 1 0 4 4a4 4 0 0 0-4-4m0 6a2 2 0 1 1 2-2a2 2 0 0 1-2 2"/></svg>
                        </div>
                        <div class="w-2/3">
                            <div class="text-sm">Barang A perlu diservis</div>
                            <div class="text-xs text-slate-500">6 jam</div>
                        </div>
                        <div class="w-1/6 flex justify-end">
                            <button id="close-modal-btn" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" viewBox="0 0 24 24"><path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7L10 17l-5-5"/></svg>
                            </button>
                        </div>
                    </div>
                    <!-- notif lain -->
                    <div class="w-full flex text-black border-b-2 py-3">
                        <div class="flex justify-start bg-[#D0E5FF] rounded-full w-[1.8rem] h-[1.8rem] m-auto mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" class="my-auto mx-auto" viewBox="0 0 16 16"><path fill="#020320" d="M6.923 1.378a3 3 0 0 1 2.154 0l4.962 1.908a1.5 1.5 0 0 1 .961 1.4v6.626a1.5 1.5 0 0 1-.961 1.4l-4.962 1.909a3 3 0 0 1-2.154 0l-4.961-1.909a1.5 1.5 0 0 1-.962-1.4V4.686a1.5 1.5 0 0 1 .962-1.4zm1.795.933a2 2 0 0 0-1.436 0l-1.384.533l5.59 2.116l1.948-.834zM14 4.971L8.5 7.33v6.428c.074-.019.146-.042.218-.07l4.962-1.908a.5.5 0 0 0 .32-.467zm-6.5 8.786V7.33L2 4.972v6.34a.5.5 0 0 0 .32.467l4.962 1.908c.072.028.144.051.218.07M2.564 4.126L8 6.456l2.164-.928l-5.667-2.146z"/></svg>
                        </div>
                        <div class="w-2/3">
                            <div class="text-sm">Barang A hampir habis</div>
                            <div class="text-xs text-slate-500">6 jam</div>
                        </div>
                        <div class="w-1/6 flex justify-end">
                            <button id="close-modal-btn" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" viewBox="0 0 24 24"><path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7L10 17l-5-5"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="dist/js/app.js"></script>
        <script type="module" src="script.js"></script>
        <script>
            document.getElementById("open-modal-btn").addEventListener("click", function() {
                document.getElementById("modal").classList.remove("hidden");
                document.querySelector(".icon-container").classList.add("active");
            });
            document.getElementById("close-modal-btn").addEventListener("click", function() {
                document.getElementById("modal").classList.add("hidden");
                document.querySelector(".icon-container").classList.remove("active");
            });
            window.onload = function() {
                document.getElementById("modal").classList.add("hidden");
                document.querySelector(".icon-container").classList.remove("active");
            };
        </script>
        <!-- END: JS Assets-->
    </body>
</html>