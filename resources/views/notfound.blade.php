<!DOCTYPE html>
<html>
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('logo.png') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="LEFT4CODE">
        <title>Page Not Found</title>
        <!-- BEGIN: CSS Assets-->
        @vite('resources/css/app.css')
        <!-- END: CSS Assets-->
    </head>
    <body>
    <div class="fixed bg-putih-polteka w-full max-h-screen font-polteka">
      <div class="w-full h-screen flex flex-col items-center justify-center">
        <div class="w-1/2 md:1/3 lg:w-96 text-merah200-polteka">
          <img alt="Not Found"  src="{{ asset('notfound2.svg') }}">
        </div>
        <div class="flex flex-col items-center justify-center font-polteka">
            <p class="text-3xl md:text-4xl lg:text-5xl text-gray-800 mt-3 font-semibold">Page Not Found</p>
            <p class="mx-5 text-center text-md md:text-lg lg:text-xl text-gray-600 mt-8">Sorry, the page you are looking for could not be found.</p>
            <a href="javascript:history.back()" class="flex items-center space-x-2 bg-biru160-polteka hover:bg-blue-700 text-gray-100 px-4 py-2 mt-12 rounded transition duration-150" title="Return Home">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                </svg>
                <span>Return Back</span>
            </a>
        </div>
      </div>
    </div>
    </body>
</html>