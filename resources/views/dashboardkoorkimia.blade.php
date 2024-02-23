<!DOCTYPE html>
<html>
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <title>Dashboard Koor Lab Kimia</title>
        <link rel="stylesheet" href="dist/css/app.css" />
        <script src="https://cdn.tailwindcss.com"></script>
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
        <div class="flex bg-merah200-polteka text-putih-polteka">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <div href="" class="intro-x flex items-center pl-5 pt-4">
                    <span class="xl:block text-putih-polteka text-lg ml-3 font-semibold text-[20px]"> Polteka <br>Mangunwijaya</br> </span> 
                </div>
                <div class="side-nav__devider my-9"></div>
                <ul>
                    <li>
                        <a class="side-menu side-menu--active flex active:pt-2 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full">
                        <div class="ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 1024 1024"><path fill="currentColor" d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 0 0-44.4 0L77.5 505a63.9 63.9 0 0 0-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0 0 18.7-45.3c0-17-6.7-33.1-18.8-45.2M568 868H456V664h112zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7l23.1 23.1L882 542.3z"/></svg>
                            </div>
                            <div class="side-menu__title ml-2 mb-3 font-semibold">Dashboard</div>
                        </a>
                    </li>
                    <li class="side-nav__devider my-6"></li>
                    <li>
                        <a class="side-menu side-menu--active flex">
                            <div class="ml-8 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3rem" height="1.3rem" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.55" d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm0 5h18M10 3v18"/></svg>
                            </div>
                            <div class="side-menu__title ml-2 mb-3 font-semibold">Manajemen</div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Lab Kimia Analisa
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Lab Kimia Fisika
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Lab Operasi Teknik Kimia
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                    </li>    
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Lab Mikrobiologi
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                    </li>
                    <li>   
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Lab Kimia Terapan
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                    </li>
                    
                    
   
                    <!-- <li>    
                    <button type="button" class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Lab Kimia Organik
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        </button>
                        <ul id="dropdown-example" class="hidden py-2 space-y-2">
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-putih-polteka transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Products</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Billing</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Invoice</a>
                            </li>
                        </ul>
                    </li> -->

                    

                    <div>
                    <li>
					<button type="button" class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example" onclick="dropDown()">
                  <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>E-commerce</span>
                  <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
					<ul id="dropdown-example" class="hidden py-2 space-y-2">
						<li>
							<a href="#"
								class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Products</a>
						</li>
						<li>
							<a href="#"
								class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Billing</a>
						</li>
						<li>
							<a href="#"
								class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">Invoice</a>
						</li>
					</ul>
				</li>
                    </div>

                <!-- lab kimia terapan -->
                <div class="ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5 cursor-pointer">
                <div class="flex justify-between w-full items-center" onclick="dropDown()">
                    <span>Lab Kimia Terapan</span>
                    <span class="text-sm rotate-180" id="arrow">
                    <i class="bi bi-chevron-down"></i>
                    </span>
                </div>
                </div>
                <div class=" leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto" id="submenu">
                <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title cursor-pointer ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Data Barang
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title cursor-pointer ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Barang Masuk
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title cursor-pointer ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Barang Keluar
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title cursor-pointer ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Pengajuan Barang
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                </div>


                <div class="ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5 cursor-pointer">
                <div class="flex justify-between w-full items-center" onclick="dropDown()">
                    <span>Lab Kimia Organik</span>
                    <span class="text-sm rotate-180" id="arrow">
                    <i class="bi bi-chevron-down"></i>
                    </span>
                </div>
                </div>
                <div class=" leading-7 text-left text-sm font-thin mt-2 w-4/5 mx-auto" id="submenu">
                <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title cursor-pointer ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Data Barang
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title cursor-pointer ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Barang Masuk
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title cursor-pointer ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Barang Keluar
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                            <div class="side-menu__title cursor-pointer ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Pengajuan Barang
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                </div>

               
                    <li class="side-nav__devider my-8"></li>
                    <li>
                        <a class="side-menu side-menu--active flex">
                            <div class="ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z" />
                                </svg>
                            </div>
                            <div class="side-menu__title ml-2 mb-3 font-semibold">Pengaturan</div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="side-menu__title ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5">
                                Ubah Password
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title ml-8 mb-3 active:text-hitam-polteka active:bg-putih-polteka active:rounded-full active:ml-10 active:w-full active:py-2 active:pl-5"> Ubah Gambar Profil </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="side-nav__devider my-8"></li>
                    <li>
                        <a class="side-menu flex" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <div class="ml-8 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                            </div>
                            <div class="side-menu__title ml-2 mb-3 font-semibold"> {{ __('Logout') }}</div>
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
        <script>
            function dropDown() {
            document.querySelector('#submenu').classList.toggle('hidden')
            document.querySelector('#arrow').classList.toggle('rotate-0')
            }
            dropDown()

            function Openbar() {
            document.querySelector('.sidebar').classList.toggle('left-[-300px]')
            }
        </script>
       
        <!-- END: JS Assets-->
    </body>
</html>