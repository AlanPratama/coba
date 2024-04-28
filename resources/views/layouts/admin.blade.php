<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Admin</title>
    <link rel="shortcut icon" href="{{ asset('assets/image/logo65.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/all.min.css') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    @php
        $admin = Auth::guard('admin')->user();
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

    <aside
        class="fixed top-0 ml-[-100%] flex h-screen w-full flex-col justify-between border-r bg-white px-3 pb-3 transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[14%] dark:bg-gray-800 dark:border-gray-700">
        <div>
            <div class="mt-1 text-center">
                <img src="{{ asset('assets/image/logo65.png') }}" alt=""
                    class="m-auto h-10 w-10 rounded-full object-cover lg:h-36 lg:w-36" />
                <h5 class="mt-4 hidden text-xl font-semibold text-gray-600 lg:block dark:text-gray-300">
                    {{ $admin->f_nama }}</h5>
                <span class="hidden text-blue-400 font-semibold lg:block">{{ $admin->f_level }}</span>
            </div>

            <ul class="mt-8 space-y-2 tracking-wide">
                <li>
                    <a href="{{ url('/admin/dashboard') }}" aria-label="dashboard"
                        class="flex items-center space-x-4 rounded-md px-4 py-3 {{ $pgMenu == 'Dashboard' ? 'relative bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white' : 'group text-gray-600 dark:text-gray-300' }}">
                        <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z"
                                class="dark:fill-slate-600 fill-current text-cyan-400"></path>
                            <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z"
                                class="fill-current text-cyan-200 group-hover:text-cyan-300"></path>
                            <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z"
                                class="fill-current group-hover:text-sky-300"></path>
                        </svg>
                        <span class="-mr-1 font-medium">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/peminjaman') }}" aria-label="dashboard"
                        class="flex items-center space-x-4 rounded-md px-4 py-3 {{ $pgMenu == 'Peminjaman' ? 'relative bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white' : 'group text-gray-600 dark:text-gray-300' }}">
                        <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z"
                                class="dark:fill-slate-600 fill-current text-cyan-400"></path>
                            <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z"
                                class="fill-current text-cyan-200 group-hover:text-cyan-300"></path>
                            <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z"
                                class="fill-current group-hover:text-sky-300"></path>
                        </svg>
                        <span class="-mr-1 font-medium">E. Peminjaman</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/pengembalian') }}" aria-label="dashboard"
                        class="flex items-center space-x-4 rounded-md px-4 py-3 {{ $pgMenu == 'Pengembalian' ? 'relative bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white' : 'group text-gray-600 dark:text-gray-300' }}">
                        <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z"
                                class="dark:fill-slate-600 fill-current text-cyan-400"></path>
                            <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z"
                                class="fill-current text-cyan-200 group-hover:text-cyan-300"></path>
                            <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z"
                                class="fill-current group-hover:text-sky-300"></path>
                        </svg>
                        <span class="-mr-1 font-medium">E. Pengembalian</span>
                    </a>
                </li>
                <hr>
                @if ($admin->f_level == 'Admin')
                <li>
                  <a href="{{ url('/admin/kategori') }}"
                      class="flex items-center space-x-4 rounded-md px-4 py-3 {{ $pgMenu == 'Kategori' ? 'relative bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white' : 'group text-gray-600 dark:text-gray-300' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd"
                              d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                              clip-rule="evenodd" />
                          <path
                              class="fill-current text-gray-600 group-hover:text-cyan-600 dark:group-hover:text-sky-400"
                              d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                      </svg>
                      <span class="group-hover:text-gray-700 dark:group-hover:text-gray-50">Kategori</span>
                  </a>
              </li>
              <li>
                  <a href="{{ url('/admin/buku') }}"
                      class="flex items-center space-x-4 rounded-md px-4 py-3 {{ $pgMenu == 'Buku' ? 'relative bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white' : 'group text-gray-600 dark:text-gray-300' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd"
                              d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                              clip-rule="evenodd" />
                          <path
                              class="fill-current text-gray-600 group-hover:text-cyan-600 dark:group-hover:text-sky-400"
                              d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                      </svg>
                      <span class="group-hover:text-gray-700 dark:group-hover:text-gray-50">Buku</span>
                  </a>
              </li>
              <li>
                  <a href="{{ url('/admin/anggota') }}"
                      class="flex items-center space-x-4 rounded-md px-4 py-3 {{ $pgMenu == 'Anggota' ? 'relative bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white' : 'group text-gray-600 dark:text-gray-300' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd"
                              d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                              clip-rule="evenodd" />
                          <path
                              class="fill-current text-gray-600 group-hover:text-cyan-600 dark:group-hover:text-sky-400"
                              d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                      </svg>
                      <span class="group-hover:text-gray-700 dark:group-hover:text-gray-50">Anggota</span>
                  </a>
              </li>
              <li>
                  <a href="{{ url('/admin/pustakawan') }}"
                      class="flex items-center space-x-4 rounded-md px-4 py-3 {{ $pgMenu == 'Pustakawan' ? 'relative bg-gradient-to-r from-sky-600 to-cyan-400 px-4 py-3 text-white' : 'group text-gray-600 dark:text-gray-300' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd"
                              d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                              clip-rule="evenodd" />
                          <path
                              class="fill-current text-gray-600 group-hover:text-cyan-600 dark:group-hover:text-sky-400"
                              d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                      </svg>
                      <span class="group-hover:text-gray-700 dark:group-hover:text-gray-50">Pustakawan</span>
                  </a>
              </li>
                @endif
            </ul>
        </div>

        <form action="{{ route('logout') }}" method="POST"
            class="-mx-6 flex items-center justify-between border-t px-6 pt-4 dark:border-gray-700">
            @csrf
            <button type="submit"
                class="group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-600 dark:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="group-hover:text-gray-700 dark:group-hover:text-white">Logout</span>
            </button>
        </form>
    </aside>
    <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[86%]">
        <div class="sticky top-0 h-16 border-b bg-white dark:bg-gray-800 dark:border-gray-700 lg:py-2.5">
            <div class="flex items-center justify-start space-x-4 px-6 2xl:container">
                <h5 hidden class="text-2xl font-medium text-gray-800 lg:block mt-1 dark:text-white">{{ $pgMenu }}</h5>
                <button class="-mr-2 h-16 w-12 border-r lg:hidden dark:border-gray-700 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="my-auto h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="px-6 pt-6 2xl:container">
            @yield('content')
        </div>
    </div>



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
