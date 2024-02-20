<!DOCTYPE html>
<html>
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="logo.png" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="LEFT4CODE">
        <title>Login</title>
        <!-- BEGIN: CSS Assets-->
        @vite('resources/css/app.css')
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="xl:bg-putih-polteka lg:bg-putih-polteka bg-biru160-polteka">
        <section>
            <div class="xl:grid xl:px-20 xl:grid-cols-2 xl:gap-10 lg:grid lg:px-20 lg:grid-cols-2 lg:gap-10">
                <div class="hidden xl:flex xl:flex-col lg:flex lg:flex-col min-h-screen">
                    <div class="my-auto">
                        <img alt="Logo" class="w-80 -mt-16" src="illustration.svg">
                        <div class="text-putih-polteka font-polteka font-bold xl:text-3xl leading-tight xl:mt-14 lg:text-3xl lg:mt-14">
                            Sistem Informasi 
                            <br>
                            Inventarisasi Barang dan Peralatan
                        </div>
                        <div class="xl:mt-5 lg:mt-5 text-lg text-putih-polteka font-polteka text-opacity-70">
                            Politeknik Katolik Mangunwijaya
                        </div>
                    </div>
                </div>
                <div class="h-screen lg:h-auto flex py-0 xl:py-0 lg:py-0 my-0 xl:my-auto lg:my-0">
                    <div class="xl:bg-none xl:shadow-none xl:mt-0 xl:w-[400px] lg:bg-none lg:shadow-none lg:mt-20 lg:w-[400px] w-[360px] sm:w-[500px] md:w-[650px] bg-white rounded-3xl shadow-md shadow-black mx-auto my-auto ">
                        <img alt="Logo" class="hidden xl:block xl:w-[80px] xl:mx-auto xl:mt-0 lg:block lg:w-[80px] lg:mx-auto lg:mt-2" src="logo.png">
                        <div class="xl:mt-14">
                            <img alt="Logo" class="xl:hidden lg:hidden w-[80px] mx-auto mt-10 " src="logo.png">
                            <h2 class="font-polteka font-bold text-biru160-polteka xl:text-3xl xl:text-left xl:mt-0 lg:text-3xl lg:text-left lg:mt-10 text-center text-[24px] mt-10">
                                Masuk
                            </h2>
                            <div class="hidden xl:block xl:mt-2 xl:text-sm xl:mb-1 lg:block lg:mt-2 lg:text-sm lg:mb-1 text-biru160-polteka font-polteka text-opacity-50">
                                Masukkan email dan password Anda!
                            </div>
                            <hr class="hidden xl:block lg:block border-1 w-full border-biru160-polteka border-opacity-50">
                            <form method="POST" action="#">
                                @csrf
                                <div class="xl:mt-3 xl:px-0 lg:mt-3 lg:px-0 mt-3 px-10">
                                    <div class="xl:mt-2 xl:text-sm xl:mb-1 lg:mt-2 lg:text-sm lg:mb-1 text-lg text-biru160-polteka font-polteka">
                                        Username*
                                    </div>
                                    <input type="username" name="username" class="xl:placeholder-sm lg:placeholder-sm placeholder-lg placeholder-biru160-polteka placeholder-opacity-50 xl:text-sm lg:text-sm text-lg text-biru160-polteka xl:py-2 xl:px-4 xl:w-full xl:rounded-xl lg:py-2 lg:px-4 lg:w-full lg:rounded-xl py-2 w-full px-3 rounded-xl block form-control border border-biru160-polteka @error('username') is-invalid @enderror" placeholder="Username" required autocomplete="username" autofocus>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <div class="xl:mt-2 xl:text-sm xl:mb-1 lg:mt-2 lg:text-sm lg:mb-1 text-lg mt-2 text-biru160-polteka font-polteka">
                                        Password*
                                    </div>
                                    <input type="password" id="password" name="password" class="xl:placeholder-sm lg:placeholder-sm placeholder-lg placeholder-biru160-polteka placeholder-opacity-50 xl:text-sm lg:text-sm text-lg text-biru160-polteka xl:py-2 xl:px-4 xl:w-full xl:rounded-xl lg:py-2 lg:px-4 lg:w-full lg:rounded-xl py-2 w-full px-3 rounded-xl block form-control border border-biru160-polteka @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="xl:mt-8 xl:text-left xl:px-0 lg:mt-8 lg:text-left lg:px-0 px-10 mt-7">
                                    <button class="xl:text-xs lg:text-sm text-lg text-putih-polteka font-bold text-polteka rounded-xl w-full  bg-biru160-polteka xl:py-2 xl:px-4 lg:py-2 lg:px-4 py-1" href="#" type="submit">Masuk</button>
                                </div>
                            </form>
                        </div>
                        <div class="xl:mt-24 xl:text-[12px] xl:mx-auto xl:text-center xl:mb-0 xl:px-0 lg:mt-24 lg:text-[12px] lg:mx-auto lg:text-center lg:mb-0 lg:px-0 mt-14 text-xs text-center mb-10 px-10 text-biru160-polteka font-polteka">
                                © 2024 Tim Capstone 07 Teknik Komputer Universitas Diponegoro
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>