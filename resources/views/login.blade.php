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
    <body class="xl:bg-putih-polteka bg-biru160-polteka">
        <section>
            <div class="block xl:grid px-20 grid-cols-2 gap-10">
                <div class="hidden xl:flex flex-col min-h-screen">
                    <div class="my-auto">
                        <img alt="Logo" class="w-80 -mt-16" src="illustration.svg">
                        <div class="text-putih-polteka font-polteka font-bold xl:text-3xl leading-tight mt-14">
                            Sistem Informasi 
                            <br>
                            Inventarisasi Barang dan Peralatan
                        </div>
                        <div class="mt-5 text-lg text-putih-polteka font-polteka text-opacity-70">Politeknik Katolik Mangunwijaya</div>
                    </div>
                </div>
                <div class="h-screen py-5 mx-auto">
                    <img alt="Logo" class="w-[80px] mx-auto xl:mt-10" src="logo.png">
                    <div class="mt-24">
                        <img alt="Logo" class="xl:hidden w-[80px] mx-auto " src="logo.png">
                        <h2 class="font-polteka font-bold text-biru160-polteka xl:text-3xl xl:text-left">
                            Masuk
                        </h2>
                        <div class="xl:mt-2 xl:text-sm xl:mb-1 text-biru160-polteka font-polteka text-opacity-50">
                            Masukkan email dan password Anda!
                        </div>
                        <hr class="border-1 border-biru160-polteka border-opacity-50 w-96">
                        <form method="POST" action="#">
                            @csrf
                            <div class="xl:mt-3">
                                <div class="xl:mt-2 xl:text-sm xl:mb-1 text-biru160-polteka font-polteka">
                                    Username*
                                </div>
                                <input type="username" name="username" class="xl:placeholder-sm placeholder-biru160-polteka placeholder-opacity-50 xl:text-sm text-biru160-polteka xl:py-2 xl:px-4 xl:w-96 xl:rounded-xl block form-control border border-biru160-polteka @error('username') is-invalid @enderror" placeholder="Username" required autocomplete="username" autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <div class="xl:mt-2 xl:text-sm xl:mb-1 text-biru160-polteka font-polteka">
                                    Password*
                                </div>
                                <input type="password" id="password" name="password" class="xl:placeholder-sm placeholder-biru160-polteka placeholder-opacity-50 xl:text-sm text-biru160-polteka xl:py-2 xl:px-4 xl:w-96 xl:rounded-xl block form-control border border-biru160-polteka @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="xl:mt-8 xl:text-left">
                                <button class="xl:text-xs text-putih-polteka xl:font-bold text-polteka xl:rounded-xl xl:w-96 bg-biru160-polteka xl:py-2 xl:px-4 align-top" href="#" type="submit">Masuk</button>
                            </div>
                        </form>
                    </div>
                    <div class="xl:mt-32 xl:text-xs xl:mx-auto text-biru160-polteka font-polteka">
                            © 2024 Tim Capstone 07 Teknik Komputer Universitas Diponegoro
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>