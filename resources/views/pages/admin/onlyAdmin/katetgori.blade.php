@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')



    <div>
        <div x-data="{ tambahKategoriModal: false }" x-on:keydown.window.escape="tambahKategoriModal = false">
            <div class="">
                <button type="button" x-on:click="tambahKategoriModal = !tambahKategoriModal"
                    class="flex justify-center items-center gap-2 rounded border border-primary-600 mb-3 bg-primary-600 px-3 py-1 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300"><i
                        class="fa-solid fa-plus font-bold text-2xl"></i> <span>TAMBAH KATEGORI</span></button>
            </div>
            <div x-cloak x-show="tambahKategoriModal" x-transition.opacity class="fixed inset-0 z-10 bg-secondary-700/50">
            </div>
            <div x-cloak x-show="tambahKategoriModal" x-transition
                class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                <form action="{{ route('kategori.store') }}" method="POST"
                    class="mx-auto overflow-hidden rounded-lg bg-white shadow-xl sm:w-full sm:max-w-xl">
                    @csrf
                    <div class="relative p-6">
                        <button type="button" x-on:click="tambahKategoriModal = false"
                            class="absolute top-4 right-4 rounded-lg p-1 text-center font-medium text-secondary-500 transition-all hover:bg-secondary-100">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6">
                                <path
                                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg>
                        </button>
                        <h3 class="text-lg font-medium text-secondary-900">TAMBAH KATEGORI</h3>
                        <div class="mt-2 text-sm text-secondary-500">
                            <div>
                                <label for="f_kategori"
                                    class="mb-1 block text-sm font-medium text-gray-700">KATEGORI</label>
                                <input type="text" name="f_kategori" id="f_kategori"
                                    class="block w-full rounded-md border-gray-300 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                    placeholder="Masukkan Kategori Baru..." />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 bg-secondary-50 px-6 py-3">
                        <button type="button" x-on:click="tambahKategoriModal = false"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100 disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-50 disabled:text-gray-400">Cancel</button>
                        <button type="submit"
                            class="rounded-lg border border-primary-500 bg-primary-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-red-500 font-bold text-lg">*{{ $error }}</p>
            @endforeach
        @endif
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">No.</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Kategori</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Total Buku</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @foreach ($kategori as $ktg)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $ktg->f_kategori }}</td>
                        <td class="px-6 py-4">{{ $ktg->buku ? $ktg->buku->count() : 0 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-start gap-4">


                                <div>

                                </div>


                                <div>
                                    <div x-data="{ showDetail: false }" x-on:keydown.window.escape="showDetail = false">
                                        <div class="flex justify-center">
                                            <button x-on:click="showDetail = !showDetail">
                                                <img src="{{ asset('assets/image/eye-regular.svg') }}"
                                                    class="h-6 w-6 text-blue-500" alt="">
                                            </button>
                                        </div>
                                        <div x-cloak x-show="showDetail" x-transition.opacity
                                            class="fixed inset-0 z-10 bg-secondary-700/50"></div>
                                        <div x-cloak x-show="showDetail" x-transition
                                            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                                            <div
                                                class="mx-auto w-full overflow-hidden rounded-lg bg-white shadow-xl sm:max-w-6xl">
                                                <div class="relative p-5">
                                                    <h3 class="text-gray-800 mb-2 font-bold text-2xl">Detail Buku Dengan Kategori {{ $ktg->f_kategori }}</h3>
                                                    <div class="text-center">

                                                        <div
                                                            class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
                                                            <table
                                                                class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                                                                <thead class="bg-gray-50">
                                                                    <tr>
                                                                        <th scope="col"
                                                                            class="pl-4 py-4 font-medium text-gray-900">No.
                                                                        </th>
                                                                        <th scope="col"
                                                                            class="px-6 py-4 font-medium text-gray-900">
                                                                            Judul</th>
                                                                        <th scope="col"
                                                                            class="px-6 py-4 font-medium text-gray-900">
                                                                            Penerbit</th>
                                                                        <th scope="col"
                                                                            class="pl-6 py-4 font-medium text-gray-900">
                                                                            Deskripsi</th>
                                                                        <th scope="col"
                                                                            class="px-6 py-4 font-medium text-gray-900">
                                                                            Kategori</th>
                                                                        <th scope="col"
                                                                            class="px-6 py-4 font-medium text-gray-900">
                                                                            Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody
                                                                    class="divide-y divide-gray-100 border-t border-gray-100">
                                                                    @if ($ktg->buku->count() > 0)
                                                                    @foreach ($ktg->buku as $bk)
                                                                    <tr class="hover:bg-gray-50">
                                                                        <td class="pl-4 py-4">{{ $loop->iteration }}.
                                                                        </td>
                                                                        <th
                                                                            class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                                                            <div class="relative w-10 h-14">
                                                                                <img class="h-full w-full rounded object-cover object-center shadow"
                                                                                    src="{{ $bk->f_gambar ? asset('storage/' . $bk->f_gambar) : asset('assets/image/noBookImg.png') }}"
                                                                                    alt="" />
                                                                            </div>
                                                                            <div class="text-sm">
                                                                                <div class="font-medium text-gray-700">
                                                                                    {{ $bk->f_judul }}
                                                                                </div>
                                                                                <div class="text-gray-400">
                                                                                    {{ $bk->f_pengarang }}</div>
                                                                            </div>
                                                                        </th>
                                                                        <td class="px-6 py-4">
                                                                            {{ $bk->f_penerbit }}</td>
                                                                        <td class="pl-1 py-4 max-w-lg">
                                                                            {{ $bk->f_deskripsi }}</td>
                                                                        <td class="px-6 py-4 font-bold">
                                                                            {{ $bk->kategori->f_kategori }}
                                                                        </td>
                                                                        <td class="px-6 py-4">
                                                                            <p
                                                                                class="{{ $bk->detailBuku->f_status == 'Tersedia' ? ' text-blue-500' : 'text-red-500' }} font-semibold p-1 rounded-xl">
                                                                                {{ $bk->detailBuku->f_status }}</p>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                @else
                                                                <tr class="hover:bg-gray-50">
                                                                    <td colspan="7" rowspan="7" class="px-6 py-4 text-center">TIDAK ADA DATA BUKU DENGAN KATEGORI {{ $ktg->f_kategori }}</td>
                                                                </tr>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="mt-5 flex justify-end gap-3">
                                                        <button type="button" x-on:click="showDetail = false"
                                                            class="flex-1 rounded-lg border border-primary-500 bg-primary-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Confirm</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div x-data="{ destroyKategori{{ $ktg->f_id }}: false }"
                                        x-on:keydown.window.escape="destroyKategori{{ $ktg->f_id }} = false">
                                        <div class="">
                                            <button
                                                x-on:click="destroyKategori{{ $ktg->f_id }} = !destroyKategori{{ $ktg->f_id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-6 w-6 text-red-500" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div x-cloak x-show="destroyKategori{{ $ktg->f_id }}" x-transition.opacity
                                            class="fixed inset-0 z-10 bg-secondary-700/50"></div>
                                        <div x-cloak x-show="destroyKategori{{ $ktg->f_id }}" x-transition
                                            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                                            <div
                                                class="mx-auto w-full overflow-hidden rounded-lg bg-white shadow-xl sm:max-w-sm">
                                                <div class="relative p-5">
                                                    <div class="text-center">
                                                        <div
                                                            class="mx-auto mb-5 flex h-10 w-10 items-center justify-center rounded-full bg-red-100 text-red-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="h-6 w-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <h3 class="text-lg font-medium text-secondary-900">
                                                                Hapus Kategori {{ $ktg->f_kategori }}?
                                                            </h3>
                                                            <div class="mt-2 text-sm text-secondary-500">
                                                                Apakah anda yakin untuk menghapus kategori
                                                                {{ $ktg->f_kategori }}?
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('kategori.destroy', ['id' => $ktg->f_id]) }}"
                                                        method="post" class="mt-5 flex justify-end gap-3">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button"
                                                            x-on:click="destroyKategori{{ $ktg->f_id }} = false"
                                                            class="flex-1 rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100 disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-50 disabled:text-gray-400">
                                                            Cancel
                                                        </button>
                                                        <button type="submit"
                                                            class="flex-1 rounded-lg border border-red-500 bg-red-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-red-700 hover:bg-red-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-300">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div>
                                    <div x-data="{ updateKategori{{ $ktg->f_id }}: false }"
                                        x-on:keydown.window.escape="updateKategori{{ $ktg->f_id }} = false">
                                        <div class="">
                                            <button type="button"
                                                x-on:click="updateKategori{{ $ktg->f_id }} = !updateKategori{{ $ktg->f_id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-6 w-6 text-green-500" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div x-cloak x-show="updateKategori{{ $ktg->f_id }}" x-transition.opacity
                                            class="fixed inset-0 z-10 bg-secondary-700/50"></div>
                                        <div x-cloak x-show="updateKategori{{ $ktg->f_id }}" x-transition
                                            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                                            <form action="{{ route('kategori.update', ['id' => $ktg->f_id]) }}"
                                                method="POST"
                                                class="mx-auto overflow-hidden rounded-lg bg-white shadow-xl sm:w-full sm:max-w-xl">
                                                @method('PUT')
                                                @csrf
                                                <div class="relative p-6">
                                                    <button type="button"
                                                        x-on:click="updateKategori{{ $ktg->f_id }} = false"
                                                        class="absolute top-4 right-4 rounded-lg p-1 text-center font-medium text-secondary-500 transition-all hover:bg-secondary-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="h-6 w-6">
                                                            <path
                                                                d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                                        </svg>
                                                    </button>
                                                    <h3 class="text-lg font-medium text-secondary-900">TAMBAH KATEGORI</h3>
                                                    <div class="mt-2 text-sm text-secondary-500">
                                                        <div>
                                                            <label for="f_kategori"
                                                                class="mb-1 block text-sm font-medium text-gray-700">KATEGORI</label>
                                                            <input type="text" name="f_kategori" id="f_kategori"
                                                                value="{{ $ktg->f_kategori }}"
                                                                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                                                placeholder="Masukkan Kategori Baru..." />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-3 bg-secondary-50 px-6 py-3">
                                                    <button type="button"
                                                        x-on:click="updateKategori{{ $ktg->f_id }} = false"
                                                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100 disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-50 disabled:text-gray-400">Cancel</button>
                                                    <button type="submit"
                                                        class="rounded-lg border border-primary-500 bg-primary-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>



                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
