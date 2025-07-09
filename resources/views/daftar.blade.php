<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-esdm.svg') }}" />
    <title>Daftar Akun</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }} " rel="stylesheet" />
    <link href=" {{ asset('assets/css/nucleo-svg.css ') }}" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="{{ asset('assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
  </head>

  <body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
    <!-- Navbar -->
    <nav class="absolute top-0 z-30 flex flex-wrap items-center justify-between w-full px-4 py-2 mt-6 mb-4 shadow-none lg:flex-nowrap lg:justify-start">
      <div class="container flex items-center justify-between py-0 flex-wrap-inherit">
        <!--<a class="py-1.75 ml-4 mr-4 font-bold text-white text-sm whitespace-nowrap lg:ml-0" href="https://demos.creative-tim.com/argon-dashboard-tailwind/pages/dashboard.html" target="_blank"> Pendaftaran Akun Baru </a>
        <button navbar-trigger class="px-3 py-1 ml-2 leading-none transition-all ease-in-out bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer text-lg lg:hidden" type="button" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="inline-block mt-2 align-middle bg-center bg-no-repeat bg-cover w-6 h-6 bg-none">
            <span bar1 class="w-5.5 rounded-xs duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
            <span bar2 class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
            <span bar3 class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
          </span>
        </button>
        <div navbar-menu class="items-center flex-grow transition-all ease duration-350 lg-max:bg-white lg-max:max-h-0 lg-max:overflow-hidden basis-full rounded-2xl lg:flex lg:basis-auto">
        -->
          <!-- online builder btn  -->
          <!-- <li class="flex items-center">
            <a
              class="leading-pro ease-in border-white/75 text-xs tracking-tight-rem rounded-3.5xl hover:border-white/75 hover:-translate-y-px active:hover:border-white/75 active:hover:-translate-y-px active:opacity-85 active:shadow-xs active:border-white/75 bg-white/10 hover:bg-white/10 active:hover:bg-white/10 mr-2 mb-0 inline-block cursor-pointer border border-solid py-2 px-8 text-center align-middle font-bold uppercase text-white shadow-none transition-all hover:text-white hover:opacity-75 hover:shadow-none active:scale-100 active:bg-white active:text-black active:hover:text-white active:hover:opacity-75 active:hover:shadow-none"
              target="_blank"
              href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053"
              >Online Builder</a
            >
          </li> -->
          
          <ul class="hidden pl-0 mb-0 list-none lg:block lg:flex-row">
            <li>
              
            </li>
          </ul>


        </div>
      </div>
    </nav>

    <main class="mt-0 transition-all duration-200 ease-in-out">
      <section class="min-h-screen">
        <div class="bg-top relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-cover min-h-50-screen rounded-xl "  style="background-image: url('{{ asset('assets/img/listrik.jpg') }}')">
          <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-zinc-800 to-zinc-700 opacity-60"></span>
          <div class="container z-10">
            <div class="flex flex-wrap justify-center -mx-3">
              <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                <h1 class="mt-12 mb-2 text-white">Selamat Datang!</h1>
                <p class="text-white"></p>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
            <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
              <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                  <h5>Daftar Menggunakan</h5>
                </div>
                <div class="flex flex-wrap px-3 -mx-3 sm:px-6 xl:px-12">
                  <div class="w-3/12 max-w-full px-1 ml-auto flex-0">
                  </div>
                  <div class="w-3/12 max-w-full px-1 flex-0">
                    <a class="inline-block w-full px-5 py-2.5 mb-4 font-bold text-center text-gray-200 uppercase align-middle transition-all bg-transparent border border-gray-200 border-solid rounded-lg shadow-none cursor-pointer hover:-translate-y-px leading-pro text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:bg-transparent hover:opacity-75" href="javascript:;">
                      <svg width="24px" height="32px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g transform="translate(3.000000, 2.000000)" fill-rule="nonzero">
                            <path d="M57.8123233,30.1515267 C57.8123233,27.7263183 57.6155321,25.9565533 57.1896408,24.1212666 L29.4960833,24.1212666 L29.4960833,35.0674653 L45.7515771,35.0674653 C45.4239683,37.7877475 43.6542033,41.8844383 39.7213169,44.6372555 L39.6661883,45.0037254 L48.4223791,51.7870338 L49.0290201,51.8475849 C54.6004021,46.7020943 57.8123233,39.1313952 57.8123233,30.1515267" fill="#4285F4"></path>
                            <path d="M29.4960833,58.9921667 C37.4599129,58.9921667 44.1456164,56.3701671 49.0290201,51.8475849 L39.7213169,44.6372555 C37.2305867,46.3742596 33.887622,47.5868638 29.4960833,47.5868638 C21.6960582,47.5868638 15.0758763,42.4415991 12.7159637,35.3297782 L12.3700541,35.3591501 L3.26524241,42.4054492 L3.14617358,42.736447 C7.9965904,52.3717589 17.959737,58.9921667 29.4960833,58.9921667" fill="#34A853"></path>
                            <path d="M12.7159637,35.3297782 C12.0932812,33.4944915 11.7329116,31.5279353 11.7329116,29.4960833 C11.7329116,27.4640054 12.0932812,25.4976752 12.6832029,23.6623884 L12.6667095,23.2715173 L3.44779955,16.1120237 L3.14617358,16.2554937 C1.14708246,20.2539019 0,24.7439491 0,29.4960833 C0,34.2482175 1.14708246,38.7380388 3.14617358,42.736447 L12.7159637,35.3297782" fill="#FBBC05"></path>
                            <path d="M29.4960833,11.4050769 C35.0347044,11.4050769 38.7707997,13.7975244 40.9011602,15.7968415 L49.2255853,7.66898166 C44.1130815,2.91684746 37.4599129,0 29.4960833,0 C17.959737,0 7.9965904,6.62018183 3.14617358,16.2554937 L12.6832029,23.6623884 C15.0758763,16.5505675 21.6960582,11.4050769 29.4960833,11.4050769" fill="#EB4335"></path>
                          </g>
                        </g>
                      </svg>
                    </a>
                  </div>
                  <div class="w-3/12 max-w-full px-1 mr-auto flex-0">
                    
                    </a>
                  </div>
                  <div class="relative w-full max-w-full px-3 mt-2 text-center shrink-0">
                    <p class="z-20 inline px-4 mb-2 font-semibold leading-normal bg-white text-sm text-slate-400">Atau</p>
                  </div>
                </div>
                <div class="flex-auto p-6">
                  <form role="form text-left">
                    <div class="mb-4">
                      <input type="text" class="placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Name" aria-label="Name" aria-describedby="email-addon" />
                    </div>
                    <div class="mb-4">
                      <input type="email" class="placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Email" aria-label="Email" aria-describedby="email-addon" />
                    </div>
                    <div class="mb-4">
                      <input type="password" class="placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Password" aria-label="Password" aria-describedby="password-addon" />
                    </div>
                    <div class="min-h-6 pl-7 mb-0.5 block">
                      <input class="w-4.8 h-4.8 ease -ml-7 rounded-1.4 checked:bg-gradient-to-tl checked:from-blue-500 checked:to-violet-500 after:text-xxs after:font-awesome after:duration-250 after:ease-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-200 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" value="" checked />
                      <label class="mb-2 ml-1 font-normal cursor-pointer text-sm text-slate-700" for="flexCheckDefault"> Saya menyetujui <a href="javascript:;" class="font-bold text-slate-700">terhadap data yang saya input</a> </label>
                    </div>
                    <div class="text-center">
                      <button type="button" class="inline-block w-full px-5 py-2.5 mt-6 mb-2 font-bold text-center text-white align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:-translate-y-px hover:shadow-xs leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-zinc-800 to-zinc-700 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Daftarkan Akun</button>
                    </div>
                    <p class="mt-4 mb-0 leading-normal text-sm">Anda sudah ada akun? <a href="{{ route('masuk') }}" class="font-bold text-slate-700">Masuk</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
      <footer class="py-12">
      </footer>
      <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    </main>
  </body>
  <!-- plugin for scrollbar  -->
  <script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
  <!-- main script file  -->
  <script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
</html>
