<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href=" {{ asset('assets/img/logo-esdm.svg') }} " />
  <title>Profile Perusahaan</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Popper -->
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Main Styling -->
  <link href="{{ asset('assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
</head>

<body
  class="m-0 font-sans antialiased font-normal dark:bg-slate-900 text-base leading-default bg-gray-50 text-slate-500">
  <div
    class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
    <span class="absolute top-0 left-0 w-full h-full" style="background-color: #08A04B; opacity:0.8;"></span>
  </div>

  @include('components.sidebar')

  <div class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68">
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
              <a class="text-white opacity-50" href="javascript:;">Halaman</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Profil Badan Usaha</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Profil Badan Usaha</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
          <div class="flex items-center md:ml-auto md:pr-4">
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
              <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                <i class="fas fa-search"></i>
              </span>
              <!--<input type="text" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Type here..." />
              -->
            </div>
          </div>
          <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
            <li class="flex items-center pl-4 xl:hidden">
              <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" sidenav-trigger>
                <div class="w-4.5 overflow-hidden">
                  <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                  <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                  <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                </div>
              </a>
            </li>
            <li class="flex items-center px-4">
              <a href="javascript:;" class="p-0 text-sm text-white transition-all ease-nav-brand">
                <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i>
                <!-- fixed-plugin-button-nav  -->
              </a>
            </li>

            <!-- notifications -->

            <li class="relative flex items-center pr-2">
              <p class="hidden transform-dropdown-show"></p>
              <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" dropdown-trigger aria-expanded="false">
                <i class="cursor-pointer fa fa-bell"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="relative w-full mx-auto pt-0 ">

    </div>

    <div class="w-full p-6 mx-auto">
      <div class="flex flex-wrap -mx-3">
        <div class="w-full px-4 md:w-full">
          <div
            class="relative z-20 flex flex-col min-w-0 break-words bg-white border-0 shadow-2xl shadow-black/20 dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
              <div class="flex items-center">
                <!--  <p class="mb-0 dark:text-white/80">Edit Profil</p>-->
                <button type="button"
                  class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-m tracking-tight-rem hover:shadow-m hover:-translate-y-px active:opacity-85">Edit Profil</button>
              </div>
            </div>
            <form action="/submit" method="POST" class="w-full px-4 py-6 bg-white rounded-xl shadow-md  dark:bg-slate-800">
              <div class="max-w-6xl mx-auto">
                <!-- Bagian: Data Akun -->
                <div class="mb-6">
                  <p class="text-lg font-bold uppercase dark:text-white dark:opacity-60 mb-4">DATA AKUN</p>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <label for="username" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Nama Badan Usaha</label>
                      <input type="text" name="username" id="username" required
                        class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                    </div>
                    <div>
                      <label for="email" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Email Pengguna</label>
                      <input
                        type="email"
                        name="email"
                        id="emailakun"
                        required
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        title="Masukkan email yang valid, contoh: nama@email.com"
                        class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white"
                        placeholder="nama@email.com" />
                    </div>
                    <div>
                      <label for="alamatkantorpusat" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Alamat Kaantor Pusat</label>
                      <input type="text" name="username" id="username" required
                        class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                    </div>
                  </div>
                  <div class="mt-2">
                    <button type="button"
                      class="px-2 py-2 text-xs font-semibold text-white bg-red-400 rounded-lg hover:bg-red-500 transition-colors duration-200">
                      Reset Password
                    </button>
                  </div>
                </div>
              </div>

              <!-- Separator -->


              <hr class="h-px mb-2 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />


              <!-- Bagian: Profil Perusahaan -->
              <div class="mb-6">
                <p class="text-lg font-bold uppercase dark:text-white dark:opacity-60 mb-4">DATA ADMINISTRASI</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label for="namabadanusaha" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Nama Badan Usaha / Instansi / Perseorangan</label>
                    <input type="text" name="namabadanusaha" id="namabadanusaha" required
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>
                  <div>
                    <label for="jenisbidang" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Nama Penanggung Jawab</label>
                    <input type="text" name="jenisbidang" id="jenisbidang" required
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>
                  <div>
                    <label for="penanggungjawab" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Kode KBLI</label>
                    <input
                      type="text"
                      name="penanggungjawab"
                      id="penanggungjawab"
                      required
                      pattern="\d{5}"
                      maxlength="5"
                      inputmode="numeric"
                      title="Masukkan 5 digit angka sesuai format KBLI"
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white"
                      placeholder="contoh: 62011" />
                  </div>

                  <div>
                    <label for="judulkbli" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Judul KBLI</label>
                    <input type="text" name="judulkbli" id="judulkbli" required
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>
                  <div>
                    <label for="nomorhp" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">No Tlp./HP</label>
                    <input type="numeric" name="nomorhp" id="nomorhp" required
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>
                  <div>
                    <label for="email" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Email Perusahaan</label>
                    <input
                      type="email"
                      name="emailpt"
                      id="emailpt"
                      required
                      pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                      title="Masukkan email yang valid, contoh: nama@email.com"
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white"
                      placeholder="nama@email.com" />
                  </div>
                </div>


                <!-- Alamat Perusahaan (Optional Toggle) -->

                <div id="alamatForm" class=" mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="col-span-2">
                    <label for="address" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">Alamat Badan Usaha</label>
                    <input type="text" name="address" id="address" required
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>

                  <div class="col-span-2">
                    <label for="nib" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">
                      Nomor Induk Berusaha (NIB)
                    </label>
                    <input type="text" name="nib" id="nib" required
                      pattern="^\d{13,16}$"
                      maxlength="16"
                      inputmode="numeric"
                      title="Masukkan NIB yang terdiri dari 13 hingga 16 digit angka"
                      placeholder="Contoh: 1234567890123"
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                    <p class="text-m mt-1 text-slate-500">
                      Note: Sesuai NIB jika Badan Usaha / Sesuai KTP jika Instansi/Perseorangan
                    </p>
                  </div>
                  <div class="col-span-2">
                    <label for="npwp" class="block mb-2 text-m font-bold text-slate-700 dark:text-white/80">
                      Nomor Pokok Wajib Pajak (NPWP)
                    </label>
                    <input type="text" name="npwp" id="npwp" required
                      pattern="^\d{2}\.\d{3}\.\d{3}\.\d-\d{3}\.\d{3}$"
                      maxlength="20"
                      title="Masukkan NPWP sesuai format: 12.345.678.9-012.345"
                      placeholder="Contoh: 12.345.678.9-012.345"
                      class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg placeholder:text-gray-500 focus:outline-none focus:border-blue-500 dark:bg-slate-850 dark:text-white" />
                  </div>

                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                  <button type="submit"
                    class="w-full md:w-auto px-6 py-3 text-sm font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition-all">
                    Simpan
                  </button>
                </div>
              </div>
            </form>

            <!--
                  <div class="relative w-full mx-auto mt-60 ">

                    <div
                      class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
                      <div class="flex flex-wrap -mx-3">
                        <div class="flex-none w-auto max-w-full px-3">
                          <div
                            class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                            <img src="../assets/img/team-1.jpg" alt="profile_image"
                              class="w-full shadow-2xl rounded-xl" />
                          </div>
                        </div>
                        <div class="flex-none w-auto max-w-full px-3 my-auto">
                          <div class="h-full">
                            <h5 class="mb-1 dark:text-white">Sayo Kravits</h5>
                            <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-sm">Public
                              Relations</p>
                          </div>
                        </div>
                        <div
                          class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                          <div class="relative right-0">
                            <ul class="relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl" nav-pills
                              role="tablist">
                              <li class="z-30 flex-auto text-center">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                  nav-link active href="javascript:;" role="tab" aria-selected="true">
                                  <i class="ni ni-app"></i>
                                  <span class="ml-2">App</span>
                                </a>
                              </li>
                              <li class="z-30 flex-auto text-center">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                  nav-link href="javascript:;" role="tab" aria-selected="false">
                                  <i class="ni ni-email-83"></i>
                                  <span class="ml-2">Messages</span>
                                </a>
                              </li>
                              <li class="z-30 flex-auto text-center">
                                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                  nav-link href="javascript:;" role="tab" aria-selected="false">
                                  <i class="ni ni-settings-gear-65"></i>
                                  <span class="ml-2">Settings</span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="w-full p-6 mx-auto">
                    <div class="flex flex-wrap -mx-3">
                      <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
                        <div
                          class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                          <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                              <p class="mb-0 dark:text-white/80">Edit Profile</p>
                              <button type="button"
                                class="inline-block px-8 py-2 mb-4 ml-auto font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer text-m tracking-tight-rem hover:shadow-m hover:-translate-y-px active:opacity-85">Settings</button>
                            </div>
                          </div>
                          <div class="flex-auto p-6">
                            <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-sm">User Information
                            </p>
                            <div class="flex flex-wrap -mx-3">
                              <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                  <label for="username"
                                    class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">Username</label>
                                  <input type="text" name="username" value="lucky.jesse"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                              </div>
                              <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                  <label for="email"
                                    class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">Email
                                    address</label>
                                  <input type="email" name="email" value="jesse@example.com"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                              </div>
                              <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                  <label for="first name"
                                    class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">First
                                    name</label>
                                  <input type="text" name="first name" value="Jesse"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                              </div>
                              <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-4">
                                  <label for="last name"
                                    class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">Last
                                    name</label>
                                  <input type="text" name="last name" value="Lucky"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                              </div>
                            </div>
                            <hr
                              class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />

                            <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-sm">Contact
                              Information</p>
                            <div class="flex flex-wrap -mx-3">
                              <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                <div class="mb-4">
                                  <label for="address"
                                    class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">Address</label>
                                  <input type="text" name="address"
                                    value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                              </div>
                              <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                <div class="mb-4">
                                  <label for="city"
                                    class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">City</label>
                                  <input type="text" name="city" value="New York"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                              </div>
                              <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                <div class="mb-4">
                                  <label for="country"
                                    class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">Country</label>
                                  <input type="text" name="country" value="United States"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                              </div>
                              <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                <div class="mb-4">
                                  <label for="postal code"
                                    class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">Postal
                                    code</label>
                                  <input type="text" name="postal code" value="437300"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                              </div>
                            </div>
                            <hr
                              class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />

                            <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-sm">About me</p>
                            <div class="flex flex-wrap -mx-3">
                              <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                <div class="mb-4">
                                  <label for="about me"
                                    class="inline-block mb-2 ml-1 font-bold text-m text-slate-700 dark:text-white/80">About
                                    me</label>
                                  <input type="text" name="about me"
                                    value="A beautiful Dashboard for Bootstrap 5. It is Free and Open Source."
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <div class="w-full max-w-full px-3 mt-6 shrink-0 md:w-4/12 md:flex-0 md:mt-0">
                        <div
                          class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                          <img class="w-full rounded-t-2xl" src="../assets/img/bg-profile.jpg"
                            alt="profile cover image">
                          <div class="flex flex-wrap justify-center -mx-3">
                            <div class="w-4/12 max-w-full px-3 flex-0 ">
                              <div class="mb-6 -mt-6 lg:mb-0 lg:-mt-16">
                                <a href="javascript:;">
                                  <img class="h-auto max-w-full border-2 border-white border-solid rounded-circle"
                                    src="../assets/img/team-2.jpg" alt="profile image">
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="border-black/12.5 rounded-t-2xl p-6 text-center pt-0 pb-6 lg:pt-2 lg:pb-4">
                            <div class="flex justify-between">
                              <button type="button"
                                class="hidden px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-m bg-cyan-500 lg:block tracking-tight-rem hover:shadow-m hover:-translate-y-px active:opacity-85">Connect</button>
                              <button type="button"
                                class="block px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-m bg-cyan-500 lg:hidden tracking-tight-rem hover:shadow-m hover:-translate-y-px active:opacity-85">
                                <i class="ni ni-collection text-2.8"></i>
                              </button>
                              <button type="button"
                                class="hidden px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-m bg-slate-700 lg:block tracking-tight-rem hover:shadow-m hover:-translate-y-px active:opacity-85">Message</button>
                              <button type="button"
                                class="block px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-m bg-slate-700 lg:hidden tracking-tight-rem hover:shadow-m hover:-translate-y-px active:opacity-85">
                                <i class="ni ni-email-83 text-2.8"></i>
                              </button>
                            </div>
                          </div>

                          <div class="flex-auto p-6 pt-0">
                            <div class="flex flex-wrap -mx-3">
                              <div class="w-full max-w-full px-3 flex-1-0">
                                <div class="flex justify-center">
                                  <div class="grid text-center">
                                    <span class="font-bold dark:text-white text-lg">22</span>
                                    <span class="leading-normal dark:text-white text-sm opacity-80">Friends</span>
                                  </div>
                                  <div class="grid mx-6 text-center">
                                    <span class="font-bold dark:text-white text-lg">10</span>
                                    <span class="leading-normal dark:text-white text-sm opacity-80">Photos</span>
                                  </div>
                                  <div class="grid text-center">
                                    <span class="font-bold dark:text-white text-lg">89</span>
                                    <span class="leading-normal dark:text-white text-sm opacity-80">Comments</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="mt-6 text-center">
                              <h5 class="dark:text-white ">
                                Mark Davis
                                <span class="font-light">, 35</span>
                              </h5>
                              <div
                                class="mb-2 font-semibold leading-relaxed text-base dark:text-white/80 text-slate-700">
                                <i class="mr-2 dark:text-white ni ni-pin-3"></i>
                                Bucharest, Romania
                              </div>
                              <div
                                class="mt-6 mb-2 font-semibold leading-relaxed text-base dark:text-white/80 text-slate-700">
                                <i class="mr-2 dark:text-white ni ni-briefcase-24"></i>
                                Solution Manager - Creative Tim Officer
                              </div>
                              <div class="dark:text-white/80">
                                <i class="mr-2 dark:text-white ni ni-hat-3"></i>
                                University of Computer Science
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      
                    </div>
                    <footer class="pt-4">
                      <div class="w-full px-6 mx-auto">
                        <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                          <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                            <div class="leading-normal text-center text-sm text-slate-500 lg:text-left">
                              ©
                              <script>
                                document.write(new Date().getFullYear() + ",");
                              </script>
                              made with <i class="fa fa-heart"></i> by
                              <a href="https://www.creative-tim.com"
                                class="font-semibold dark:text-white text-slate-700" target="_blank">Creative Tim</a>
                              for a better web.
                            </div>
                          </div>

                        </div>
                      </div>
                    </footer>

                  </div>
              
                </div>
                -right-90 in loc de 0
                <div fixed-plugin-card
                  class="z-sticky backdrop-blur-2xl backdrop-saturate-200 dark:bg-slate-850/80 shadow-3xl w-90 ease -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 duration-200">
                  <div class="px-6 pt-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
                    <div class="float-left">
                      <h5 class="mt-4 mb-0 dark:text-white">Argon Configurator</h5>
                      <p class="dark:text-white dark:opacity-80">See our dashboard options.</p>
                    </div>
                    <div class="float-right mt-6">
                      <button fixed-plugin-close-button
                        class="inline-block p-0 mb-4 font-bold leading-normal text-center uppercase align-middle transition-all ease-in bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:-translate-y-px text-sm tracking-tight-rem bg-150 bg-x-25 active:opacity-85 dark:text-white text-slate-700">
                        <i class="fa fa-close"></i>
                      </button>
                    </div>
                   End Toggle Button 
                  </div>
                  <hr
                    class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
                  <div class="flex-auto p-6 pt-0 overflow-auto sm:pt-4">
                     Sidebar Backgrounds 
                    <div>
                      <h6 class="mb-0 dark:text-white">Sidebar Colors</h6>
                    </div>
                    <a href="javascript:void(0)">
                      <div class="my-2 text-left" sidenav-colors>
                        <span
                          class="py-2.2 text-m rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-blue-500 to-violet-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-slate-700 text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                          active-color data-color="blue" onclick="sidebarColor(this)"></span>
                        <span
                          class="py-2.2 text-m rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                          data-color="gray" onclick="sidebarColor(this)"></span>
                        <span
                          class="py-2.2 text-m rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-blue-700 to-cyan-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                          data-color="cyan" onclick="sidebarColor(this)"></span>
                        <span
                          class="py-2.2 text-m rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-emerald-500 to-teal-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                          data-color="emerald" onclick="sidebarColor(this)"></span>
                        <span
                          class="py-2.2 text-m rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-orange-500 to-yellow-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                          data-color="orange" onclick="sidebarColor(this)"></span>
                        <span
                          class="py-2.2 text-m rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-red-600 to-orange-600 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                          data-color="red" onclick="sidebarColor(this)"></span>
                      </div>
                    </a>
                     Sidenav Type 
                    <div class="mt-4">
                      <h6 class="mb-0 dark:text-white">Sidenav Type</h6>
                      <p class="leading-normal dark:text-white dark:opacity-80 text-sm">Choose between 2 different
                        sidenav types.</p>
                    </div>
                    <div class="flex">
                      <button transparent-style-btn
                        class="inline-block w-full px-4 py-2.5 mb-2 font-bold leading-normal text-center text-white capitalize align-middle transition-all bg-blue-500 border border-transparent border-solid rounded-lg cursor-pointer text-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-m active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-blue-500 to-violet-500 hover:border-blue-500"
                        data-class="bg-transparent" active-style>White</button>
                      <button white-style-btn
                        class="inline-block w-full px-4 py-2.5 mb-2 ml-2 font-bold leading-normal text-center text-blue-500 capitalize align-middle transition-all bg-transparent border border-blue-500 border-solid rounded-lg cursor-pointer text-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-m active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-none hover:border-blue-500"
                        data-class="bg-white">Dark</button>
                    </div>
                    <p class="block mt-2 leading-normal dark:text-white dark:opacity-80 text-sm xl:hidden">You can
                      change the sidenav type just on desktop view.</p>
                     Navbar Fixed 
                    <div class="flex my-4">
                      <h6 class="mb-0 dark:text-white">Navbar Fixed</h6>
                      <div class="block pl-0 ml-auto min-h-6">
                        <input navbarFixed
                          class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right"
                          type="checkbox" />
                      </div>
                    </div>
                    <hr
                      class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                    <div class="flex mt-2 mb-12">
                      <h6 class="mb-0 dark:text-white">Light / Dark</h6>
                      <div class="block pl-0 ml-auto min-h-6">
                        <input dark-toggle
                          class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right"
                          type="checkbox" />
                      </div>
                    </div>
                    <a target="_blank"
                      class="dark:border dark:border-solid dark:border-white inline-block w-full px-6 py-2.5 mb-4 font-bold leading-normal text-center text-white align-middle transition-all bg-transparent border border-solid border-transparent rounded-lg cursor-pointer text-sm ease-in hover:shadow-m hover:-translate-y-px active:opacity-85 tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850"
                      href="https://www.creative-tim.com/product/argon-dashboard-tailwind">Free Download</a>
                    <a target="_blank"
                      class="dark:border dark:border-solid dark:border-white dark:text-white inline-block w-full px-6 py-2.5 mb-4 font-bold leading-normal text-center align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:shadow-m hover:-translate-y-px active:opacity-85 text-sm ease-in tracking-tight-rem bg-150 bg-x-25 border-slate-700 text-slate-700 hover:bg-transparent hover:text-slate-700 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-slate-700 active:hover:shadow-none"
                      href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/argon-dashboard/">View
                      documentation</a>
                    <div class="w-full text-center">
                      <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard-tailwind"
                        data-icon="octicon-star" data-size="large" data-show-count="true"
                        aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
                      <h6 class="mt-4 dark:text-white">Thank you for sharing!</h6>
                      <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23tailwindcss&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard-tailwind"
                        class="inline-block px-5 py-2.5 mb-0 mr-2 font-bold text-center text-white align-middle transition-all border-0  rounded-lg cursor-pointer hover:shadow-m hover:-translate-y-px active:opacity-85 leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700"
                        target="_blank"> <i class="mr-1 fab fa-twitter"></i> Tweet </a>
                      <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard-tailwind"
                        class="inline-block px-5 py-2.5 mb-0 mr-2 font-bold text-center text-white align-middle transition-all border-0  rounded-lg cursor-pointer hover:shadow-m hover:-translate-y-px active:opacity-85 leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700"
                        target="_blank"> <i class="mr-1 fab fa-facebook-square"></i> Share </a>
                    </div>
                  </div>
                </div>
              </div> -->
</body>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>