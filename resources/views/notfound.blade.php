<!DOCTYPE html>
<html>
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="logo.png" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="LEFT4CODE">
        <title>Page Not Found</title>
        <!-- BEGIN: CSS Assets-->
        @vite('resources/css/app.css')
        <!-- END: CSS Assets-->
    </head>
    <body>
    <div class="fixed bg-putih-polteka w-full h-screen">
      <div class="lg:flex lg:grid-cols-2">
        <div class="w-auto h-auto mt-28 lg:h-auto lg:w-[460px] lg:ml-[300px] lg:mt-48 lg:items-start flex flex-col items-center">
          <p class="text-[25px] md:text-[45px] md:h-[35px] sm:text-[45px] sm:h-[30px] h-[15px] lg:text-[56px] lg:h-[40px] font-medium font-polteka text-biru160-polteka">
            ERROR
          </p>
          <p class="text-[70px] md:text-[130px] md:h-[160px] sm:text-[100px] sm:h-[120px] h-[85px] lg:text-[150px] lg:h-[190px] font-bold font-polteka text-merah200-polteka">
            404
          </p>
          <p class="text-[20px] md:text-[30px] sm:text-[30px] lg:text-[40px] font-medium font-polteka text-biru160-polteka">
            PAGE NOT FOUND
          </p>
          <a href="/">
            <img
              src="buttonhome.png"
              class="hover:scale-75 duration-200 w-auto h-[40px] md:w-[120px] sm:w-[120px] sm:h-auto mt-5 lg:h-auto lg:w-[170px] lg:mt-7 md:h-[330px]"></img>
          </a>
        </div>
        <div class="flex items-center justify-center">
          <img
            src="notfound.png"
            class="w-auto h-[250px] lg:h-auto lg:w-[540px] lg:mr-[130px] lg:ml-[100px] lg:mt-[130px] md:h-[330px]"
            alt="Not Found Image"
          />
        </div>
      </div>
      <svg class="mt-10"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#060A6B" fill-opacity="1" d="M0,128L120,144C240,160,480,192,720,181.3C960,171,1200,117,1320,90.7L1440,64L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
    </div>
    </body>
</html>