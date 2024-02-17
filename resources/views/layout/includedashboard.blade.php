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
    <body class="py-5 bg-putih-polteka text-putih-polteka">
        <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden bg-merah200-polteka text-putih-polteka">
            <div class="mobile-menu-bar">
                <a href="" class="flex mr-auto">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="dist/images/logo.svg">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-white/[0.08] py-5 hidden">
                <li>
                    <a class="menu menu--active">
                        <div class="menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="menu__title"> Dashboard</div>
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
        <div class="flex bg-merah200-polteka text-putih-polteka">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <a href="" class="intro-x flex items-center pl-5 pt-4">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="dist/images/logo.svg">
                    <span class="hidden xl:block text-white text-lg ml-3"> EduSmile </span> 
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    <li>
                        <a class="side-menu side-menu--active">
                            <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="side-menu__title">
                                Dashboard 
                                <div class="side-menu__sub-icon transform rotate-180"></div>
                            </div>
                        </a>
                    </li>
                    <li class="side-nav__devider my-6"></li>
                    <li>
                            <div class="side-menu__title ml-5 mb-3" style="font-size: 16px; color:white;">
                            <b>PROFILE</b>
                            </div>
                    </li>
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title">
                                Setting Profile 
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title"> Ubah Password </div>
                                </a>
                            </li>
                            <li>
                                <a class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title"> Ubah Profile Picture </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="side-nav__devider my-6"></li>
                    <li>
                            <div class="side-menu__title ml-5 mb-3" style="font-size: 16px; color:white;">
                            <b>MANAJEMEN</b>
                            </div>
                    </li>
                    <li>
                        <a class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="sidebar"></i> </div>
                            <div class="side-menu__title">
                                Manajemen Sistem 
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-inbox.html" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title"> Konfigurasi Email </div>
                        </a>
                    </li>
                    <li class="side-nav__devider my-6"></li>
                    <li>
                            <div class="side-menu__title ml-5 mb-3" style="font-size: 16px; color:white;">
                            <b>ADMIN</b>
                            </div>
                    </li>
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="side-menu__title">
                                Manajemen User
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title"> Data User </div>
                                </a>
                            </li>
                            <li>
                                <a href="simple-menu-light-dashboard-overview-1.html" class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title"> Tambah Walisiswa </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="side-nav__devider my-6"></li>
                    <li>
                        <a class="side-menu" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <div class="side-menu__icon"> <i data-lucide="log-out"></i> </div>
                            <div class="side-menu__title"> {{ __('Logout') }}</div>
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