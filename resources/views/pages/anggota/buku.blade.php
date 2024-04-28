@extends('layouts.main')

@section('title', 'Kumpulan Buku')

@section('content')
<div class="mt-8 px-8 pb-12" id="kumpulanBuku">
    <h3 class="text-4xl mb-4 font-bold text-blue-500 text-center">KUMPULAN BUKU</h3>
    
    <form method="get" class="max-w-lg mx-auto">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" name="judul" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Buku Kesukaanmu..." />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

    <div class="grid justify-center items-center grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 py-8">
        @forelse ($buku as $bk)
        <a href="{{ route('buku.detail', $bk->f_id) }}" class="min-w-full max-w-full min-h-72 max-h-72 md:min-w-64 md:max-w-64 md:min-h-96 md:max-h-96">
            <img src="{{ $bk->buku->f_gambar ? asset('storage/'.$bk->buku->f_gambar) : asset('assets/image/noBookImg.png') }}" class="w-full shadow rounded h-full" alt="{{ $bk->buku->f_judul }}">
            <h3 class="font-semibold">{{ $bk->buku->f_judul }}</h3>
        </a>
        @empty
        <h3 class="font-bold text-xl w-full">BUKU TIDAK DITEMUKAN.....</h3>
        @endforelse
    </div>
</div>
@endsection