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
    <body class="bg-biru160-polteka">
        <section>
            <div class="px-32 grid grid-cols-2 gap-4">
                <div class="hidden xl:flex flex-col min-h-screen">
                    <div class="my-auto">
                        <img alt="Logo" class="w-1/2 -mt-16" src="illustration.svg">
                        <div class="text-white font-polteka text-4xl leading-tight mt-10">
                            Selamat Datang 
                            <br>
                            Sistem Informasi Inventarisasi
                        </div>
                        <div class="mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Politeknik Katolik Mangunwijaya</div>
                    </div>
                </div>
                <div class="bg-putih-polteka min-h-screen flex flex-col">
                    <img alt="Logo" class="w-[80px] mx-auto mt-20" src="logo.png">
                    <div class="mt-10 ml-20">
                        <h2 class="font-polteka font-bold text-biru160-polteka text-4xl text-left">
                            Masuk
                        </h2>
                        <form method="POST" action="#">
                            @csrf
                            <div class="intro-x mt-8">
                                <input type="email" name="email" class="intro-x login__input py-3 px-4 block form-control @error('email') is-invalid @enderror" placeholder="Email" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <input type="password" id="password" name="password" class="intro-x login__input py-3 px-4 block mt-4 form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" href="#" type="submit">{{ __('Login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>