<!DOCTYPE html>
<html>
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('logo.png') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <title>Ubah Gambar Profil Superadmin</title>
    </head>
    <!-- END: Head -->
    <body class="py-5 bg-merah200-polteka text-putih-polteka font-polteka">
        <!-- BEGIN: Mobile Menu -->
        <div class="block md:hidden bg-merah200-polteka text-putih-polteka">
            <div class="flex mr-auto">
                <a class="ml-8 flex-grow">
                    <img alt="Logo" class="w-10" src="{{ asset('logoputih.png') }}">
                </a>
                <a href="#" class="mr-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 buttonToogle" viewBox="0 0 24 24"><path fill="currentColor" d="M4 18h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1m0-5h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1M3 7c0 .55.45 1 1 1h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1"/></svg>
                </a>
            </div>
            <hr class="border-1 w-full mt-3 border-putih-polteka border-opacity-25">
            <ul class="py-5 mx-8 mobileMenu hidden">
                <li>
                    <a href="{{ route('manajemensuperadmin') }}" class="flex hover:font-bold">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.55" d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm0 5h18M10 3v18"/></svg>
                        </div>
                        <div class="ml-3 mt-1">
                            Pengguna
                        </div>
                    </a>
                </li>
                <li class="menu__devider my-6"></li>
                <li>
                    <a href="{{ route('pengajuanbarangsuperadmin') }}" class="flex hover:font-bold">
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
                    <a href="{{ route('ubahpwsuperadmin') }}" class="flex hover:font-bold">
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
                    <a href="{{ route('ubahppsuperadmin') }}" class="flex font-semibold">
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
                        <a class="md:justify-center lg:justify-center xl:justify-start flex">
                            <div class="xl:ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="xl:w-6 lg:w-8 md:w-8" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.55" d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm0 5h18M10 3v18"/></svg>
                            </div>
                            <div class="ml-2 mb-3 font-semibold hidden xl:block">Manajemen</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manajemensuperadmin') }}">
                            <div class="hidden xl:block ml-8 mb-3 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:ml-10 hover:w-full hover:py-2 hover:pl-5">
                                Pengguna
                            </div>
                        </a>
                        <a href="{{ route('manajemensuperadmin') }}" class="xl:hidden justify-center hover:justify-start flex hover:mb-2 hover:pt-2 hover:md:px-5 hover:lg:px-7 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:md:ml-6 hover:lg:ml-10 hover:w-full">
                            <div class="xl:ml-8 mb-3">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="block xl:hidden md:w-8 " viewBox="0 0 256 256"><path fill="currentColor" d="M245 110.64a16 16 0 0 0-13-6.64h-16V88a16 16 0 0 0-16-16h-69.33l-27.73-20.8a16.14 16.14 0 0 0-9.6-3.2H40a16 16 0 0 0-16 16v144a8 8 0 0 0 8 8h179.1a8 8 0 0 0 7.59-5.47l28.49-85.47a16.05 16.05 0 0 0-2.18-14.42M93.34 64l27.73 20.8a16.12 16.12 0 0 0 9.6 3.2H200v16H69.77a16 16 0 0 0-15.18 10.94L40 158.7V64Z"/></svg>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengajuanbarangsuperadmin') }}">
                            <div class="hidden xl:block ml-8 mb-3 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:ml-10 hover:w-full hover:py-2 hover:pl-5">
                                Pengajuan Barang
                            </div>
                        </a>
                        <a href="{{ route('pengajuanbarangsuperadmin') }}" class="xl:hidden justify-center hover:justify-start flex hover:mb-2 hover:pt-2 hover:md:px-5 hover:lg:px-7 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:md:ml-6 hover:lg:ml-10 hover:w-full">
                            <div class="xl:ml-8 mb-3">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="block xl:hidden md:w-8 " viewBox="0 0 256 256"><path fill="currentColor" d="M245 110.64a16 16 0 0 0-13-6.64h-16V88a16 16 0 0 0-16-16h-69.33l-27.73-20.8a16.14 16.14 0 0 0-9.6-3.2H40a16 16 0 0 0-16 16v144a8 8 0 0 0 8 8h179.1a8 8 0 0 0 7.59-5.47l28.49-85.47a16.05 16.05 0 0 0-2.18-14.42M93.34 64l27.73 20.8a16.12 16.12 0 0 0 9.6 3.2H200v16H69.77a16 16 0 0 0-15.18 10.94L40 158.7V64Z"/></svg>
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
                        <a href="{{ route('ubahpwsuperadmin') }}">
                            <div class="hidden xl:block ml-8 mb-3 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:ml-10 hover:w-full hover:py-2 hover:pl-5">
                                Ubah Password
                            </div>
                        </a>
                        <a href="{{ route('ubahpwsuperadmin') }}" class="xl:hidden justify-center hover:justify-start flex hover:pt-2 hover:md:px-5 hover:lg:px-7 hover:mb-2 hover:text-hitam-polteka hover:bg-abu-polteka hover:rounded-full hover:md:ml-6 hover:lg:ml-10 hover:w-full">
                            <div class="xl:ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block xl:hidden xl:w-6 lg:w-8 md:w-8" viewBox="0 0 256 256"><path fill="currentColor" d="M245 110.64a16 16 0 0 0-13-6.64h-16V88a16 16 0 0 0-16-16h-69.33l-27.73-20.8a16.14 16.14 0 0 0-9.6-3.2H40a16 16 0 0 0-16 16v144a8 8 0 0 0 8 8h179.1a8 8 0 0 0 7.59-5.47l28.49-85.47a16.05 16.05 0 0 0-2.18-14.42M93.34 64l27.73 20.8a16.12 16.12 0 0 0 9.6 3.2H200v16H69.77a16 16 0 0 0-15.18 10.94L40 158.7V64Z"/></svg>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ubahppsuperadmin') }}">
                            <div class="hidden xl:block ml-8 mb-3 text-hitam-polteka bg-abu-polteka rounded-full w-full py-2 pl-5 font-semibold">
                                Ubah Gambar Profil
                            </div>
                        </a>
                        <a href="{{ route('ubahppsuperadmin') }}" class="xl:hidden justify-start flex pt-2 md:px-5 lg:px-7 text-hitam-polteka bg-abu-polteka rounded-full md:ml-6 lg:ml-10 w-full">
                            <div class="xl:ml-8 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="block xl:hidden xl:w-6 lg:w-8 md:w-8 md:mr-6 lg:mr-10 xl:mr-0" viewBox="0 0 256 256"><path fill="currentColor" d="M245 110.64a16 16 0 0 0-13-6.64h-16V88a16 16 0 0 0-16-16h-69.33l-27.73-20.8a16.14 16.14 0 0 0-9.6-3.2H40a16 16 0 0 0-16 16v144a8 8 0 0 0 8 8h179.1a8 8 0 0 0 7.59-5.47l28.49-85.47a16.05 16.05 0 0 0-2.18-14.42M93.34 64l27.73 20.8a16.12 16.12 0 0 0 9.6 3.2H200v16H69.77a16 16 0 0 0-15.18 10.94L40 158.7V64Z"/></svg>
                            </div>
                        </a>
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
    </body>
</html>