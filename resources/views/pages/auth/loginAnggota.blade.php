<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Anggota</title>
    @vite('resources/css/app.css')
</head>

<body>

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


    <div class="relative">
        <img src="{{ asset('assets/image/loginAnggotaWall.png') }}" class="absolute inset-0 object-cover w-full h-full" alt="" />
        <div class="relative min-h-screen bg-opacity-75 bg-black">
          <svg class="absolute inset-x-0 bottom-0 text-gray-100" viewBox="0 0 1160 163">
            <path
              fill="currentColor"
              d="M-164 13L-104 39.7C-44 66 76 120 196 141C316 162 436 152 556 119.7C676 88 796 34 916 13C1036 -8 1156 2 1216 7.7L1276 13V162.5H1216C1156 162.5 1036 162.5 916 162.5C796 162.5 676 162.5 556 162.5C436 162.5 316 162.5 196 162.5C76 162.5 -44 162.5 -104 162.5H-164V13Z"
            ></path>
          </svg>
          <div class="relative px-4 py-16 mx-auto overflow-hidden sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="flex flex-col items-center justify-between xl:flex-row">
              <div class="w-full max-w-xl mb-12 xl:mb-0 xl:pr-16 xl:w-7/12">
                <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl sm:leading-none">
                  "Ada lebih banyak harta karun di dalam buku daripada di semua jarahan bajak laut di Pulau Harta Karun."
                </h2>
                <p class="max-w-xl mb-4 text-base text-gray-200 md:text-lg">
                  {{-- Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan, totam rem aperiam, eaque ipsa quae. --}}
                </p>
                <a href="/" aria-label="" class="inline-flex items-center font-semibold tracking-wider transition-colors duration-200 text-white">
                  Kembali Ke Homepage
                  <svg class="inline-block w-3 ml-2" fill="currentColor" viewBox="0 0 12 12">
                    <path d="M9.707,5.293l-5-5A1,1,0,0,0,3.293,1.707L7.586,6,3.293,10.293a1,1,0,1,0,1.414,1.414l5-5A1,1,0,0,0,9.707,5.293Z"></path>
                  </svg>
                </a>
              </div>
              <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
                <div class="bg-white rounded shadow-2xl p-7 sm:p-10">
                  <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                    Login Anggota
                  </h3>
                  @if ($errors->any())
                      @foreach ($errors->all() as $error)
                          <p>{{ $error }}</p>
                      @endforeach
                  @endif
                  <form action="{{ route('login.anggotaProcess') }}" method="POST">
                    @csrf
                    <div class="mb-1 sm:mb-2">
                      <label for="f_username" class="inline-block mb-1 font-medium">Username</label>
                      <input
                        placeholder="Masukkan Username"
                        required=""
                        type="text"
                        class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-blue-400 focus:outline-none focus:shadow-outline"
                        id="f_username"
                        name="f_username"
                      />
                    </div>
                    <div class="mb-1 sm:mb-2">
                      <label for="f_password" class="inline-block mb-1 font-medium">Password</label>
                      <input
                        placeholder="Masukkan Password"
                        required=""
                        type="password"
                        class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-blue-400 focus:outline-none focus:shadow-outline"
                        id="f_password"
                        name="f_password"
                      />
                    </div>
                    <div class="mt-4 mb-2 sm:mb-4">
                      <button
                        type="submit"
                        class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-blue-600 hover:bg-blue-700 focus:shadow-outline focus:outline-none"
                      >
                        Login
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  <script src="{{ asset('assets/alphine.js') }}"></script>

</body>

</html>
 