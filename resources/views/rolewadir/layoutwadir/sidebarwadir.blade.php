<!DOCTYPE html>
<html>
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <title>Dashboard Wadir</title>
        <link rel="stylesheet" href="dist/css/app.css" />
    </head>
    <!-- END: Head -->
    <body class="py-5 bg-merah200-polteka text-putih-polteka font-polteka">
        <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden bg-merah200-polteka text-putih-polteka">
            <div class="mobile-menu-bar">
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-white/[0.08] py-5 hidden">
                <li>
                    <a class="menu menu--active">
                        <div class="menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="menu__title">Dashboard</div>
                    </a>
                <li class="menu__devider my-6"></li>
                <li>
                            <div class="menu__title ml-5 mb-3" style="font-size: 16px; color:white;">
                            <b>PROFILE</b>
                            </div>
                    </li>
                </li>
                <li>
                        <a href="javascript:;" class="menu">
                            <div class="menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="menu__title">
                                Setting Profile 
                                <div class="menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a class="menu">
                                    <div class="menu__icon"></div>
                                    <div class="menu__title"> Ubah Password </div>
                                </a>
                            </li>
                            <li>
                                <a class="menu">
                                    <div class="menu__icon"></div>
                                    <div class="menu__title"> Ubah Profile Picture </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__devider my-6"></li>
                    <li>
                            <div class="menu__title ml-5 mb-3" style="font-size: 16px; color:white;">
                            <b>MANAJEMEN</b>
                            </div>
                    </li>
                    <li>
                        <a class="menu">
                            <div class="menu__icon"> <i data-lucide="sidebar"></i> </div>
                            <div class="menu__title"> Manajemen Sistem </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-inbox.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="menu__title"> Konfigurasi Email </div>
                        </a>
                    </li>
                    <li class="menu__devider my-6"></li>
                    <li>
                            <div class="menu__title ml-5 mb-3" style="font-size: 16px; color:white;">
                            <b>ADMIN</b>
                            </div>
                    </li>
                    <li>
                        <a href="javascript:;" class="menu">
                            <div class="menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="menu__title">
                                Manajemen User
                                <div class="menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a class="menu">
                                    <div class="menu__icon"></div>
                                    <div class="menu__title"> Data User </div>
                                </a>
                            </li>
                            <li>
                                <a href="simple-menu-light-dashboard-overview-1.html" class="menu">
                                    <div class="menu__icon"></div>
                                    <div class="menu__title"> Tambah Walisiswa </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__devider my-6"></li>
                    <li>
                        <a class="menu" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> 
                            <div class="menu__icon"> <i data-lucide="log-out"></i> </div>
                            <div class="menu__title"> {{ __('Logout') }} </div>
                        </a>
                        <form id="logout-form" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </li>
            </ul>
        </div>
        <!-- END: Mobile Menu -->
        <div class="flex mr-8 bg-merah200-polteka text-putih-polteka">
            <!-- BEGIN: Side Menu -->
            <nav class="xl:w-[20%] lg:w-[12%]">
                <div href="" class="intro-x flex xl:justify-start lg:justify-center xl:pl-5 pt-4">
                    <img alt="Logo" class="xl:hidden lg:w-[50px]" src="logoputih.png">
                    <span class="xl:block hidden text-putih-polteka text-lg ml-3 font-semibold text-[20px]"> Polteka <br>Mangunwijaya</br> </span> 
                </div>
                <div class="my-9"></div>
                <ul>
                    <li>
                        <a class="lg:justify-center xl:justify-start flex active:pt-2 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full xl:active:ml-10 lg:active:ml-7 lg:active:mr-7 active:w-full">
                            <div class="xl:ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="xl:w-6 lg:w-8" viewBox="0 0 1024 1024"><path fill="currentColor" d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 0 0-44.4 0L77.5 505a63.9 63.9 0 0 0-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0 0 18.7-45.3c0-17-6.7-33.1-18.8-45.2M568 868H456V664h112zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7l23.1 23.1L882 542.3z"/></svg>
                            </div>
                            <div class="ml-2 mb-3 font-semibold hidden xl:block">Dashboard</div>
                        </a>
                    </li>
                    <li class="my-6"></li>
                    <li>
                        <a class="lg:justify-center xl:justify-start flex">
                            <div class="xl:ml-8 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="xl:w-6 lg:w-8" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.55" d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm0 5h18M10 3v18"/></svg>
                            </div>
                            <div class="ml-2 mb-3 font-semibold hidden xl:block">Manajemen</div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <div class="hidden xl:block ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Pengajuan Barang
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="block xl:hidden xl:w-6 lg:w-8" viewBox="0 0 256 256"><path fill="currentColor" d="M245 110.64a16 16 0 0 0-13-6.64h-16V88a16 16 0 0 0-16-16h-69.33l-27.73-20.8a16.14 16.14 0 0 0-9.6-3.2H40a16 16 0 0 0-16 16v144a8 8 0 0 0 8 8h179.1a8 8 0 0 0 7.59-5.47l28.49-85.47a16.05 16.05 0 0 0-2.18-14.42M93.34 64l27.73 20.8a16.12 16.12 0 0 0 9.6 3.2H200v16H69.77a16 16 0 0 0-15.18 10.94L40 158.7V64Z"/></svg>
                        </a>
                    </li>
                    <li class="my-8"></li>
                    <li>
                        <a class=" flex">
                            <div class="ml-8 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" viewBox="0 0 24 24"><path fill="currentColor" d="m16 11.78l4.24-7.33l1.73 1l-5.23 9.05l-6.51-3.75L5.46 19H22v2H2V3h2v14.54L9.5 8z"/></svg>
                            </div>
                            <div class="ml-2 mb-3 font-semibold">Laporan</div>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div class="ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Laporan Laboratorium
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5"> Laporan Prodi </div>
                        </a>
                    </li>
                    <li class="my-8"></li>
                    <li>
                        <a class=" flex">
                            <div class="ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                                </svg>
                            </div>
                            <div class="ml-2 mb-3 font-semibold">Pengaturan</div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <div class="ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Ubah Password
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a>
                                    <div class="ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5"> Ubah Gambar Profil </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="my-8"></li>
                    <li>
                        <a class="flex" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <div class="ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                            </div>
                            <div class="ml-2 mb-3 font-semibold"> {{ __('Logout') }}</div>
                        </a>
                        <form id="logout-form" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </li>
                </ul>
            </nav>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            @yield('content')
            <!-- END: Content -->
        </div>
        
        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="dist/js/app.js"></script>
       
        <!-- END: JS Assets-->
    </body>
</html>