@extends('layouts.main')

@section('title', $buku->buku->f_judul)

@section('content')
    <div class="min-h-screen flex justify-center items-start lg:pt-16 pt-6 px-8">
        <div class="flex lg:flex-row flex-col justify-center lg:items-start items-center gap-8">
            <div class="flex justify-center items-center h-full lg:pb-0 pb-4">
                <img src="{{ $buku->buku->f_gambar ? asset('storage/'.$buku->buku->f_gambar) : asset('assets/image/noBookImg.png') }}" class="h-[400px] max-w-[300px]" alt="">
            </div>
            <div class="flex flex-col justify-center items-start gap-3 max-w-xl pb-6">
                <div class="flex justify-start items-center gap-2">
                    <p class="p-2 font-semibold text-xl rounded {{ $buku->f_status == 'Tersedia' ? 'bg-green-50 text-green-500' : 'bg-red-50 text-red-500' }}">{{ $buku->f_status }}</p> | <p class="bg-blue-50 p-2 font-semibold text-xl rounded text-blue-500">{{ $buku->buku->kategori->f_kategori }}</p>
                </div>
                <h3 class="text-3xl font-semibold">{{ $buku->buku->f_judul }}</h3>
                <div class="flex justify-start items-center gap-2">
                    <p class="bg-blue-50 p-2 font-semibold text-xl rounded text-blue-500">{{ $buku->buku->f_pengarang }}</p>
                </div>
                <p class="text-xl"><span class="font-semibold">Tahun Terbit:</span> {{ $buku->buku->f_penerbit }} </p>
                <p class="text-xl"><span class="font-semibold">Deskripsi:</span> {{ $buku->buku->f_deskripsi }} </p>
                
<div class="h-80">
    <div x-data="{ pinjamBuku: false  }" x-on:keydown.window.escape="pinjamBuku = false">
      <div class="flex justify-center">
        <button x-on:click="pinjamBuku = !pinjamBuku" class="rounded text-lg border border-primary-500 bg-primary-500 px-3 py-2 text-center  font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Pinjam</button>
      </div>
      <div x-cloak x-show="pinjamBuku" x-transition.opacity class="fixed inset-0 z-10 bg-secondary-700/50"></div>
      <div x-cloak x-show="pinjamBuku" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
        <div class="mx-auto w-full overflow-hidden rounded-lg bg-white shadow-xl sm:max-w-sm">
          <div class="relative p-5">
            <div class="text-center">
              <div class="mx-auto mb-5 flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-medium text-secondary-900">Ingin Meminjam Buku Ini?</h3>
                <div class="mt-2 text-sm text-secondary-500">Silahkan temui admin perpustakaan untuk meminjam buku <span class="font-semibold">{{ $buku->buku->f_judul }}</span></div>
              </div>
            </div>
            <div class="mt-5 flex justify-end gap-3">
              <button type="button" x-on:click="pinjamBuku = false" class="flex-1 rounded-lg border border-primary-500 bg-primary-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Confirm</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
            </div>
        </div>
    </div>
@endsection