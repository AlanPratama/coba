@extends('layouts.admin')

@section('title', 'Pustakawan')

@section('content')

    <div>
        <div x-data="{ tambahAkun: false }" x-on:keydown.window.escape="tambahAkun = false">
            <div class="">
                <button type="button" x-on:click="tambahAkun = !tambahAkun"
                    class="flex justify-center items-center gap-2 rounded border border-primary-600 mb-3 bg-primary-600 px-3 py-1 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300"><i
                        class="fa-solid fa-plus font-bold text-2xl"></i> <span>TAMBAH PUSTAKAWAN</span></button>
            </div>
            <div x-cloak x-show="tambahAkun" x-transition.opacity class="fixed inset-0 z-10 bg-secondary-700/50"></div>
            <div x-cloak x-show="tambahAkun" x-transition
                class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                <form action="{{ route('pustakawan.store') }}" method="POST"
                    class="mx-auto overflow-hidden rounded-lg bg-white shadow-xl sm:w-full sm:max-w-3xl">
                    @csrf
                    <div class="relative p-6">
                        <button type="button" x-on:click="tambahAkun = false"
                            class="absolute top-4 right-4 rounded-lg p-1 text-center font-medium text-secondary-500 transition-all hover:bg-secondary-100">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6">
                                <path
                                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg>
                        </button>
                        <h3 class="text-lg font-medium text-secondary-900">PUSTAKAWAN</h3>
                        <div class="mt-2 text-sm text-secondary-500">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div>
                                    <label for="f_nama" class="mb-1 block text-sm font-medium text-gray-700">Nama</label>
                                    <input type="text" name="f_nama" id="f_nama" required
                                        class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                        placeholder="Masukkan Nama..." />
                                </div>
                                <div>
                                    <label for="f_status"
                                        class="mb-1 block text-sm font-medium text-gray-700">Status</label>
                                    <select name="f_status" id="f_status" required
                                        class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                                        <option value="" selected>Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="f_level" class="mb-1 block text-sm font-medium text-gray-700">Level</label>

                                    <input type="text" name="f_level" id="f_level" readonly disabled required
                                        class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                        value="Pustakawan" placeholder="Masukkan Level..." />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-6">
                                <div>
                                    <label for="f_username"
                                        class="mb-1 block text-sm font-medium text-gray-700">Username</label>
                                    <input type="text" name="f_username" id="f_username" required
                                        class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                        placeholder="Masukkan Username..." />
                                </div>
                                <div>
                                    <label for="f_password"
                                        class="mb-1 block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" name="f_password" id="f_password" required
                                        class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                        placeholder="Masukkan Password..." />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 bg-secondary-50 px-6 py-3">
                        <button type="button" x-on:click="tambahAkun = false"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100 disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-50 disabled:text-gray-400">Cancel</button>
                        <button type="submit"
                            class="rounded-lg border border-primary-500 bg-primary-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-red-500">{{ $errors }}</p>
            @endforeach
        @endif
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">No.</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nama</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Username</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Level</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @foreach ($pustakawan as $pstk)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}.</td>
                        <td class="px-6 py-4">{{ $pstk->f_nama }}</td>
                        <td class="px-6 py-4">{{ $pstk->f_username }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                {{-- @if ($pstk->f_level == 'Admin')
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-violet-50 px-2 py-1 text-xs font-semibold text-violet-600">Admin</span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">Pustakawan</span>
                                @endif --}}
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">Pustakawan</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold {{ $pstk->f_status == 'Aktif' ? 'text-green-600' : 'text-red-600' }}">
                                <span
                                    class="h-1.5 w-1.5 rounded-full {{ $pstk->f_status == 'Aktif' ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                {{ $pstk->f_status }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4">
                                <div>
                                    <a href="/admin/pustakawan/{{ $pstk->f_id }}">
                                        <img src="{{ asset('assets/image/eye-regular.svg') }}" class="h-6 w-6 text-blue-500" alt="">
                                    </a>
                                </div>

                                <div>
                                    <div x-data="{ destroyAkun{{ $pstk->f_id }}: false }"
                                        x-on:keydown.window.escape="destroyAkun{{ $pstk->f_id }} = false">
                                        <div class="flex justify-center">
                                            <button
                                                x-on:click="destroyAkun{{ $pstk->f_id }} = !destroyAkun{{ $pstk->f_id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-6 w-6 text-red-500" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div x-cloak x-show="destroyAkun{{ $pstk->f_id }}" x-transition.opacity
                                            class="fixed inset-0 z-10 bg-secondary-700/50"></div>
                                        <div x-cloak x-show="destroyAkun{{ $pstk->f_id }}" x-transition
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
                                                                Hapus Akun {{ $pstk->f_nama }}?
                                                            </h3>
                                                            <div class="mt-2 text-sm text-secondary-500">
                                                                Apakah Kamu Yakin Akan Menghapus Akun {{ $pstk->f_nama }}?
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form
                                                        action="{{ route('pustakawan.destroy', ['id' => $pstk->f_id]) }}"
                                                        method="POST" class="mt-5 flex justify-end gap-3">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button"
                                                            x-on:click="destroyAkun{{ $pstk->f_id }} = false"
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
                                    <div x-data="{ editAkun{{ $pstk->f_id }}: false }"
                                        x-on:keydown.window.escape="editAkun{{ $pstk->f_id }} = false">
                                        <div class="">
                                            <button type="button"
                                                x-on:click="editAkun{{ $pstk->f_id }} = !editAkun{{ $pstk->f_id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-6 w-6 text-green-500" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div x-cloak x-show="editAkun{{ $pstk->f_id }}" x-transition.opacity
                                            class="fixed inset-0 z-10 bg-secondary-700/50"></div>
                                        <div x-cloak x-show="editAkun{{ $pstk->f_id }}" x-transition
                                            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                                            <form action="{{ route('pustakawan.update', ['id' => $pstk->f_id]) }}"
                                                method="POST"
                                                class="mx-auto overflow-hidden rounded-lg bg-white shadow-xl sm:w-full sm:max-w-3xl">
                                                @method('put')
                                                @csrf
                                                <div class="relative p-6">
                                                    <button type="button"
                                                        x-on:click="editAkun{{ $pstk->f_id }} = false"
                                                        class="absolute top-4 right-4 rounded-lg p-1 text-center font-medium text-secondary-500 transition-all hover:bg-secondary-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="h-6 w-6">
                                                            <path
                                                                d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                                        </svg>
                                                    </button>
                                                    <h3 class="text-lg font-medium text-secondary-900">PUSTAKAWAN</h3>
                                                    <div class="mt-2 text-sm text-secondary-500">
                                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                                            <div>
                                                                <label for="f_nama"
                                                                    class="mb-1 block text-sm font-medium text-gray-700">Nama</label>
                                                                <input type="text" name="f_nama" id="f_nama"
                                                                    required value="{{ $pstk->f_nama }}"
                                                                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                                                    placeholder="Masukkan Nama..." />
                                                            </div>

                                                            <div>
                                                                <label for="f_status"
                                                                    class="mb-1 block text-sm font-medium text-gray-700">Status</label>
                                                                <select name="f_status" id="f_status" required
                                                                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500">
                                                                    @if ($pstk->f_status == 'Aktif')
                                                                        <option value="Aktif" selected>Aktif</option>
                                                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                                                    @else
                                                                        <option value="Tidak Aktif" selected>Tidak Aktif
                                                                        </option>
                                                                        <option value ="Aktif">Aktif</option>
                                                                    @endif
                                                                </select>
                                                            </div>

                                                            <div>
                                                                <label for="f_level"
                                                                    class="mb-1 block text-sm font-medium text-gray-700">Level</label>

                                                                <input type="text" name="f_level" id="f_level"
                                                                    readonly disabled required
                                                                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                                                    value="Pustakawan" placeholder="Masukkan Level..." />
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-6">
                                                            <div>
                                                                <label for="f_username"
                                                                    class="mb-1 block text-sm font-medium text-gray-700">Username</label>
                                                                <input type="text" name="f_username" id="f_username"
                                                                    value="{{ $pstk->f_username }}" required
                                                                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                                                    placeholder="Masukkan Username..." />
                                                            </div>
                                                            <div>
                                                                <label for="f_password"
                                                                    class="mb-1 block text-sm font-medium text-gray-700">Password</label>
                                                                <input type="password" name="f_password" id="f_password"
                                                                    class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                                                    placeholder="Masukkan Password... (OPTIONAL)" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-3 bg-secondary-50 px-6 py-3">
                                                    <button type="button"
                                                        x-on:click="editAkun{{ $pstk->f_id }} = false"
                                                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100 disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-50 disabled:text-gray-400">Cancel</button>
                                                    <button type="submit"
                                                        class="rounded-lg border border-primary-500 bg-primary-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Tambah</button>
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
