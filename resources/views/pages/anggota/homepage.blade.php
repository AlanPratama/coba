@extends('layouts.main')

@section('title', 'Homepage')

@section('content')
<div class="relative -mt-20 -z-10">
    <img src="{{ asset('assets/image/homepageWall.png') }}" class="absolute inset-0 object-cover w-full h-full" alt="" />
    <div class="relative min-h-screen bg-black pb-4 bg-opacity-75">
      <div class="px-4 mx-auto sm:max-w-xl md:max-w-full w-full md:px-24 lg:px-8">
        <div class="h-screen flex flex-col items-center justify-center xl:flex-row">
          <div class="w-full mb-12 xl:mb-0 xl:pr-16 xl:w-7/12">
            <h2 class="mb-6 font-sans text-3xl font-bold tracking-tight text-white sm:text-6xl sm:leading-none">
              Jika kamu tidak sanggup menahan <span class="text-blue-600">lelahnya</span> belajar, maka kamu harus sanggup<br class="hidden md:block" /> 
              menahan perihnya <span class="text-blue-600">kebodohan</span> 
            </h2> 
            {{-- <p class="mb-4  text-gray-400 text-2xl">
              - Imam Syafi'i
            </p> --}}
            <p class="inline-flex items-center text-3xl font-semibold tracking-wider transition-colors duration-200 text-blue-400 hover:text-blue-700">
              - Imam Syafi'i
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="flex flex-col items-center justify-between w-full mb-10 lg:flex-row">
      <div class="mb-16 lg:mb-0 lg:max-w-lg lg:pr-5">
        <div class="max-w-xl mb-6">
          <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl sm:leading-none">
            Aplikasi Perpustakaan Online<br class="hidden md:block" />
            Buatan 
            <span class="inline-block text-blue-600">Siswa SMK 65 Jakarta</span>
          </h2>
          <p class="text-base text-gray-700 md:text-lg">
            Meminjam buku di Perpustakaan kini lebih mudah dengan adanya aplikasi <span class="inline-block text-blue-600 font-semibold">Spanca Library</span>!
          </p>
        </div>
      </div>
      <div class="flex items-center justify-center lg:w-1/2">
        <div class="w-2/5">
          <img class="object-cover" src="{{ asset('assets/image/spancaLibraryPhone.png') }}" alt="spanca phone" />
        </div>
        <div class="w-5/12 -ml-16 lg:-ml-32">
          <img class="object-cover" src="{{ asset('assets/image/spancaLibraryPhone.png') }}" alt="spanca phone" />
        </div>
      </div>
    </div>
    <a
      href="#kumpulanBuku"
      aria-label="Scroll down"
      class="flex items-center justify-center w-10 h-10 mx-auto text-gray-600 duration-300 transform border border-gray-400 rounded-full hover:text-blues-400 hover:border-blues-400 hover:shadow hover:scale-110"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="currentColor">
        <path d="M10.293,3.293,6,7.586,1.707,3.293A1,1,0,0,0,.293,4.707l5,5a1,1,0,0,0,1.414,0l5-5a1,1,0,1,0-1.414-1.414Z"></path>
      </svg>
    </a>
  </div>


    <div class="mt-8 px-8 pb-12" id="kumpulanBuku">
      <div class="flex justify-between items-center mb-4">
        <h3 class="md:text-4xl text-2xl font-bold text-blue-600">KUMPULAN BUKU</h3>
        <a href="/buku" class="lg:text-xl text-sm rounded font-bold lg:px-2 px-1 lg:py-1 py-0.5 border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white transition-all">Lihat Semua</a>
      </div>
      <div class="grid justify-center items-center grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach ($buku as $bk)
            <a href="/buku/{{ $bk->f_id }}" class="min-w-full max-w-full min-h-72 max-h-72 md:min-w-64 md:max-w-64 md:min-h-96 md:max-h-96">
                <img src="{{ $bk->buku->f_gambar ? asset('storage/'.$bk->buku->f_gambar) : asset('assets/image/noBookImg.png') }}" class="w-full shadow rounded h-full" alt="{{ $bk->buku->f_judul }}">
                <h3 class="font-semibold">{{ $bk->buku->f_judul }}</h3>
            </a>
            @endforeach
        </div>
    </div>
@endsection
