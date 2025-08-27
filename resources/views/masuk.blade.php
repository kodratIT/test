<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-esdm.svg') }}" />
  <title>Masuk</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Nucleo Icons -->
  <link href=" {{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href=" {{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Main Styling -->
  <link href="{{ asset('assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
  <div class="container sticky top-0 z-sticky">
    <div class="flex flex-wrap -mx-3">
      <div class="w-full max-w-full px-3 flex-0">
        <main class="mt-0 transition-all duration-200 ease-in-out">
          <section>
            <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover">
              <div class="container z-1">
                <div class="flex flex-wrap -mx-3">
                  <div class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                    <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
                      <div class="p-6 pb-0 mb-0">
                        <h4 class="font-bold">Masuk</h4>
                        <p class="mb-0">Masukan Email dan Kata Sandi Anda </p>
                      </div>
                      <div class="flex-auto p-6">
                      <form action="{{ route('masuk') }}" method="POST" autocomplete="off">
                        @csrf

                        {{-- Input Email --}}
                        <div class="mb-4">
                          <input 
                            type="email" 
                            name="email" 
                            placeholder="Email" 
                            required 
                            autocomplete="off"
                            class="text-sm block w-full rounded-lg border p-3 text-gray-700 placeholder:text-gray-500 focus:border-blue-500 @error('email') border-red-500 @enderror" 
                          />

                          @error('email')
                            <div class="mt-1 text-red-500 text-sm">
                              {{ $message }}
                            </div>
                            <a href="{{ route('daftar') }}" class="text-blue-600 text-sm underline"> </a>
                          @enderror
                        </div>

                        {{-- Input Password --}}
                        <div class="mb-4">
                          <input 
                            type="password" 
                            name="password" 
                            placeholder="Kata Sandi" 
                            required 
                            autocomplete="new-password"
                            class="text-sm block w-full rounded-lg border p-3 text-gray-700 placeholder:text-gray-500 focus:border-blue-500 @error('password') border-red-500 @enderror" 
                          />

                          @error('password')
                            <div class="mt-1 text-red-500 text-sm">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>

                        {{-- Checkbox Ingat Saya --}}
                        <div class="flex items-center mb-4">
                          <input id="rememberMe" name="remember" type="checkbox" class="mr-2" />
                          <label for="rememberMe" class="text-sm text-gray-700">Ingat saya</label>
                        </div>

                        {{-- Tombol Masuk --}}
                        <div class="text-center">
                          <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition">
                            Masuk
                          </button>
                        </div>
                      </form>
                    </div>
                      </div>
                      <div class="border-black/12.5 rounded-b-2xl border-t-0 border-solid p-6 text-center pt-0 px-1 sm:px-6">
                        <p class="mx-auto mb-6 leading-normal text-sm">Belum punya akun? <a href="{{ route('daftar') }}" class="font-semibold text-transparent bg-clip-text bg-gradient-to-tl from-blue-500 to-violet-500">Daftar akun</a></p>
                      </div>
                    </div>
                  </div>

                  <div class="absolute top-0 right-0 flex-col justify-center hidden w-6/12 h-full max-w-full px-3 pr-0 my-auto text-center flex-0 lg:flex">
                    <div class="relative flex flex-col justify-center h-full bg-cover px-24 m-4 overflow-hidden rounded-xl " style="background-image: url('{{ asset('assets/img/listrik1.jpg') }}')">
                      <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-orange-500 to-violet-500 opacity-60"></span>
                      <h4 class="z-20 mt-12 font-bold text-white">--</h4>
                      <p class="z-50 text-white" style="text-align: justify; ">"Sistem ini adalah aplikasi berbasis web yang dibuat untuk mempermudah proses pengajuan izin pembangunan dan operasional pembangkit listrik.
                        Pengajuan bisa dilakukan oleh perusahaan (swasta/BUMN) atau perorangan secara online.
                        Aplikasi ini digunakan oleh Dinas ESDM Provinsi Jambi untuk menggantikan proses pengajuan manual agar lebih cepat, efisien, dan terdokumentasi dengan baik."
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </main>
        <footer class="py-12">
        </footer>
</body>

<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>