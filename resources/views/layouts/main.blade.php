<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/image/logo65.png') }}" type="image/x-icon">
    <title>@yield('title') | Spanca Library</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>

<body>
  @php
      $admin = Auth::guard('admin')->user();
      $anggota = Auth::guard('anggota')->user();
  @endphp


    @if (session('error'))
        <div>
            <div x-data="{ showModal: true }" x-on:keydown.window.escape="showModal = false">
                <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-10 bg-secondary-700/50"></div>
                <div x-cloak x-show="showModal" x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                    <div class="mx-auto w-full overflow-hidden rounded-lg bg-white shadow-xl sm:max-w-sm">
                        <div class="relative p-5">
                            <div class="text-center">
                                <div
                                    class="mx-auto mb-5 flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-secondary-900">TERJADI ERROR!</h3>
                                    <div class="mt-2 text-sm text-secondary-500">{{ session('error') }}</div>
                                </div>
                            </div>
                            <div class="mt-5 flex justify-end gap-3">
                                <button type="button" x-on:click="showModal = false"
                                    class="flex-1 rounded-lg border border-primary-500 bg-primary-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div>
            <div x-data="{ showModal: true }" x-on:keydown.window.escape="showModal = false">

                <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-10 bg-secondary-700/50">
                </div>
                <div x-cloak x-show="showModal" x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                    <div class="mx-auto w-full overflow-hidden rounded-lg bg-white shadow-xl sm:max-w-sm">
                        <div class="relative p-5">
                            <div class="text-center">
                                <div
                                    class="mx-auto mb-5 flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-secondary-900">BERHASIL!</h3>
                                    <div class="mt-2 text-sm text-secondary-500">{{ session('success') }}</div>
                                </div>
                            </div>
                            <div class="mt-5 flex justify-end gap-3">
                                <button type="button" x-on:click="showModal = false"
                                    class="flex-1 rounded-lg border border-primary-500 bg-primary-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

  <nav style="z-index: 999 !important;" class="{{ $pgMenu == 'Homepage' ? 'bg-transparent' : 'bg-white dark:bg-gray-900' }} shadow border-gray-200 dark:bg-gray-900 dark:border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
      <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="{{ asset('assets/image/logo65.png') }}" class="h-14" alt="SMK 65 Logo" />
          <span class="{{ $pgMenu == 'Homepage' ? 'text-white' : 'text-gray-900' }} self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Spanca Library</span>
      </a>
      <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
      <div class="hidden w-full md:block md:w-auto " id="navbar-dropdown">
        <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 {{ $pgMenu == 'Homepage' ? 'md:bg-transparent border-gray-100' : 'md:bg-white border-gray-100' }} dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <a href="{{ url('/') }}" class="block py-2 px-3 {{ $pgMenu == 'Homepage' ? 'text-white border-b-2 border-blue-500 bg-blue-700 md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent' : 'text-gray-900  hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent hover:border-b-2 hover:border-blue-500' }} transition-all" aria-current="page">Home</a>
          </li>
          <li>
            <a href="{{ url('/buku') }}" class="block py-2 px-3 {{ $pgMenu == 'Buku' ? 'border-b-2 border-blue-500 text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent' : 'hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 hover:border-b-2 hover:border-blue-500 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} transition-all {{ $pgMenu == 'Homepage' ? 'text-white' : 'text-gray-900' }}">Buku</a>
          </li>
          <li>
              <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 {{ $pgMenu == 'Homepage' ? 'text-white' : 'text-gray-900' }} transition-all hover:border-b-2 hover:border-blue-500 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">{{ $anggota || $admin ? 'Profile' : 'Masuk' }} <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg></button>
              <!-- Dropdown menu -->
              <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                  @if ($anggota || $admin)
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                    <li>
                      <a href="{{ url('/histori-peminjaman') }}" class="block px-4 py-2 {{ $pgMenu == 'Histori Peminjaman' ? 'text-blue-500' : 'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white' }} transition-all">Histori Peminjaman</a>
                    </li>
                    <li>
                      <a href="{{ url('/histori-pengembalian') }}" class="block px-4 py-2 {{ $pgMenu == 'Histori Pengembalian' ? 'text-blue-500' : 'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white' }} transition-all">Histori Pengembalian</a>
                    </li>
                  </ul>
                  <form action="{{ route('logout') }}" method="POST" class="py-1">
                    @csrf
                    <button type="submit" class="block w-full text-start px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white transition-all">Logout</button>
                  </form>
                  @else
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                    <li>
                      <a href="{{ url('/auth/anggota') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 transition-all dark:hover:text-white">Login Anggota</a>
                    </li>
                    <li>
                      <a href="{{ url('/auth/admin') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white transition-all">Login Admin</a>
                    </li>
                  </ul>
                  @endif
              </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  

  @yield('content')




  <script src="{{ asset('assets/alphine.js') }}"></script>
    @yield('script')
    {{-- <script>
        $(document).ready(function () {
                $("#testtt").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
            });
    </script> --}}
</body>

</html>
 