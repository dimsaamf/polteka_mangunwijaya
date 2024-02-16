<!DOCTYPE html>
<html>
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="LEFT4CODE">
        <title>Login</title>
        <!-- BEGIN: CSS Assets-->
        @vite('resources/css/app.css')
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="bg-biru160-polteka text-polteka">
        <section>
            <div class="grid grid-cols-2 gap-4">
            <div class="hidden xl:flex flex-col min-h-screen">
                    <div class="my-auto">
                        <img alt="Logo" class="-intro-x w-1/2 -mt-16" src="dist/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            Selamat Datang 
                            <br>
                            Sistem Informasi Inventarisasi
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Politeknik Katolik Mangunwijaya</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Log In
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