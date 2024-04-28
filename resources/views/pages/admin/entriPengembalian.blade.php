@extends('layouts.admin')

@section('title', 'Pengembalian');

@section('content')

    <div class="flex justify-start items-center">
        <div x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }
        
                this.$refs.button.focus()
        
                this.open = true
            },
            close(focusAfter) {
                if (!this.open) return
        
                this.open = false
        
                focusAfter && focusAfter.focus()
            }
        }" x-on:keydown.escape.prevent.stop="close($refs.button)"
            x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
            class="relative inline-block">
            <!-- Button -->

            <div>
                <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                    :aria-controls="$id('dropdown-button')" type="button"
                    class="inline-flex gap-2 items-center justify-center h-10 mb-3 px-2.5 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-green-500 hover:bg-green-600 focus:shadow-outline focus:outline-none"
                    aria-label="Sign up" title="Sign up">
                    <img src="{{ asset('assets/image/file-pdf-regular.svg') }}" class="h-[20px]" alt=""> LAPORAN PDF

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Panel -->
            <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
                :id="$id('dropdown-button')"
                class="absolute left-0 z-10 mt-2 w-48 divide-y divide-gray-100 rounded-lg border border-gray-100 bg-white text-left text-sm shadow-lg">
                <div class="p-1">
                    <form action="{{ route('pengembalian.streamPdf') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                            <img src="{{ asset('assets/image/eye-solid.svg') }}" class="h-4 opacity-85" alt="lihat pdf">
                            Lihat PDF
                        </button>
                    </form>
                    <form action="{{ route('pengembalian.downloadPdf') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-gray-700 hover:bg-gray-100">
                            <img src="{{ asset('assets/image/download-solid.svg') }}" class="h-4 opacity-85" alt="download pdf">
                            Download PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="pl-6 py-4 font-medium text-gray-900">No.</th>
                    <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Peminjam</th>
                    <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Admin</th>
                    <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Buku</th>
                    <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Tgl. Pinjam</th>
                    <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Tgl. Kembali</th>
                    <th scope="col" class="pl-6 py-4 font-medium text-gray-900">Status</th>
                    <th scope="col" class="pl-6 py-4 font-medium text-gray-900"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">

                @foreach ($dPeminjaman as $dp)
                    <tr class="hover:bg-gray-50">
                        <td class="pl-6 py-4">{{ $loop->iteration }}</td>
                        <td class="pl-6 py-4">{{ $dp->peminjaman->anggota->f_nama }}</td>
                        <td class="pl-6 py-4">{{ $dp->peminjaman->admin->f_nama }}</td>
                        <td class="pl-6 py-4">{{ $dp->detailbuku->buku->f_judul }}</td>
                        <td class="pl-6 py-4">{{ $dp->peminjaman->f_tanggalpeminjaman }}</td>
                        <td class="pl-6 py-4">{{ $dp->f_tanggalkembali }}</td>
                        <td class="pl-6 py-4">
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                {{ $dp->f_status }}
                            </span>
                        </td>
                        <td class="pl-2 pr-3 py-4">
                            <div class="flex justify-end gap-4">



                                <div>
                                    <div x-data="{ hapusPeminjaman{{ $dp->f_id }}: false }"
                                        x-on:keydown.window.escape="hapusPeminjaman{{ $dp->f_id }} = false">
                                        <div class="flex justify-center">
                                            <button
                                                x-on:click="hapusPeminjaman{{ $dp->f_id }} = !hapusPeminjaman{{ $dp->f_id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-6 w-6 text-red-500" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div x-cloak x-show="hapusPeminjaman{{ $dp->f_id }}" x-transition.opacity
                                            class="fixed inset-0 z-10 bg-secondary-700/50"></div>
                                        <div x-cloak x-show="hapusPeminjaman{{ $dp->f_id }}" x-transition
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
                                                                Ingin Menghapus Peminjaman?
                                                            </h3>
                                                            <div class="mt-2 text-sm text-secondary-500">
                                                                Apakah Kamu Yakin Akan Menghapus Peminjaman Ini?
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form
                                                        action="{{ route('peminjaman.destroy', ['id' => $dp->peminjaman->f_id]) }}"
                                                        method="POST" class="mt-5 flex justify-end gap-3">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button"
                                                            x-on:click="hapusPeminjaman{{ $dp->f_id }} = false"
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
                                    <div x-data="{ editPeminjaman{{ $dp->f_id }}: false }"
                                        x-on:keydown.window.escape="editPeminjaman{{ $dp->f_id }} = false">
                                        <div class="">
                                            <button type="button"
                                                x-on:click="editPeminjaman{{ $dp->f_id }} = !editPeminjaman{{ $dp->f_id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-6 w-6 text-green-500" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                            </button>

                                        </div>
                                        <div x-cloak x-show="editPeminjaman{{ $dp->f_id }}" x-transition.opacity
                                            class="fixed inset-0 z-10 bg-secondary-700/50"></div>
                                        <div x-cloak x-show="editPeminjaman{{ $dp->f_id }}" x-transition
                                            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                                            <form
                                                action="{{ route('pengembalian.update', ['id' => $dp->peminjaman->f_id]) }}"
                                                method="POST"
                                                class="mx-auto overflow-hidden rounded-lg bg-white shadow-xl sm:w-full sm:max-w-xl">
                                                @method('PUT')
                                                @csrf
                                                <div class="relative p-6">
                                                    <button type="button"
                                                        x-on:click="editPeminjaman{{ $dp->f_id }} = false"
                                                        class="absolute top-4 right-4 rounded-lg p-1 text-center font-medium text-secondary-500 transition-all hover:bg-secondary-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="h-6 w-6">
                                                            <path
                                                                d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                                        </svg>
                                                    </button>
                                                    <h3 class="text-lg font-medium text-secondary-900">TAMBAH ENTRI
                                                        PEMINJAMAN</h3>
                                                    <div class="mt-2 text-sm text-secondary-500 grid grid-cols-1 gap-5">
                                                        <div>
                                                            <label for="f_status"
                                                                class="mb-1 block text-sm font-medium text-gray-700">Status
                                                                Peminjaman</label>
                                                            <input type="text" name="f_status" id="f_status"
                                                                value="Dikembalikan" readonly disabled required
                                                                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" />
                                                        </div>
                                                        <div>
                                                            <label for="f_idadmin2"
                                                                class="mb-1 block text-sm font-medium text-gray-700">Admin</label>
                                                            <select name="f_idadmin" id="f_idadmin2"
                                                                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                                                required>
                                                                <option value="{{ $dp->peminjaman->admin->f_id }}"
                                                                    selected>{{ $dp->peminjaman->admin->f_nama }}</option>
                                                                @foreach ($admin as $ad)
                                                                    <option value="{{ $ad->f_id }}">
                                                                        {{ $ad->f_nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label for="f_tanggalpeminjaman"
                                                                class="mb-1 block text-sm font-medium text-gray-700">Tanggal
                                                                Peminjaman</label>
                                                            <input type="date" name="f_tanggalpeminjaman"
                                                                id="f_tanggalpeminjaman" required
                                                                value="{{ $dp->peminjaman->f_tanggalpeminjaman }}"
                                                                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" />
                                                        </div>
                                                        <div>
                                                            <label for="f_tanggalkembali"
                                                                class="mb-1 block text-sm font-medium text-gray-700">Tanggal
                                                                Dikembalikan</label>
                                                            <input type="date" name="f_tanggalkembali"
                                                                id="f_tanggalkembali" required
                                                                value="{{ $dp->f_tanggalkembali }}"
                                                                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500" />
                                                        </div>
                                                        <div>
                                                            <label for="f_idanggota2"
                                                                class="mb-1 block text-sm font-medium text-gray-700">Peminjamn</label>
                                                            <select name="f_idanggota" id="f_idanggota2"
                                                                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                                                required>
                                                                <option value="{{ $dp->peminjaman->anggota->f_id }}"
                                                                    selected>{{ $dp->peminjaman->anggota->f_nama }}
                                                                </option>
                                                                @foreach ($anggota as $agt)
                                                                    <option value="{{ $agt->f_id }}">
                                                                        {{ $agt->f_nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label for="f_iddetailbuku2"
                                                                class="mb-1 block text-sm font-medium text-gray-700">Buku</label>
                                                            <select name="f_iddetailbuku" id="f_iddetailbuku2"
                                                                class="block w-full rounded-md border-gray-300 text-gray-800 shadow-sm border py-2 px-3 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                                                required>
                                                                <option value="{{ $dp->detailbuku->f_id }}" selected>
                                                                    {{ $dp->detailbuku->buku->f_judul }}</option>
                                                                @foreach ($buku as $bk)
                                                                    <option value="{{ $bk->f_id }}">
                                                                        {{ $bk->buku->f_judul }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-3 bg-secondary-50 px-6 py-3">
                                                    <button type="button"
                                                        x-on:click="editPeminjaman{{ $dp->f_id }} = false"
                                                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100 disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-50 disabled:text-gray-400">Cancel</button>
                                                    <button type="submit"
                                                        class="rounded-lg border border-primary-500 bg-primary-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Confirm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div>



                                    <div>
                                        <div x-data="{ rollback{{ $dp->f_id }}: false }"
                                            x-on:keydown.window.escape="rollback{{ $dp->f_id }} = false">
                                            <div class="flex justify-center">
                                                <button type="button"
                                                    x-on:click="rollback{{ $dp->f_id }} = !rollback{{ $dp->f_id }}">
                                                    <svg class="svg-icon h-6 text-blue-500" viewBox="0 0 20 20">
                                                        <path fill="#2563eb" d="M1.729,9.212h14.656l-4.184-4.184c-0.307-0.306-0.307-0.801,0-1.107c0.305-0.306,0.801-0.306,1.106,0
                        l5.481,5.482c0.018,0.014,0.037,0.019,0.053,0.034c0.181,0.181,0.242,0.425,0.209,0.66c-0.004,0.038-0.012,0.071-0.021,0.109
                        c-0.028,0.098-0.075,0.188-0.143,0.271c-0.021,0.026-0.021,0.061-0.045,0.085c-0.015,0.016-0.034,0.02-0.051,0.033l-5.483,5.483
                        c-0.306,0.307-0.802,0.307-1.106,0c-0.307-0.305-0.307-0.801,0-1.105l4.184-4.185H1.729c-0.436,0-0.788-0.353-0.788-0.788
                        S1.293,9.212,1.729,9.212z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div x-cloak x-show="rollback{{ $dp->f_id }}" x-transition.opacity
                                                class="fixed inset-0 z-10 bg-secondary-700/50"></div>
                                            <div x-cloak x-show="rollback{{ $dp->f_id }}" x-transition
                                                class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
                                                <div
                                                    class="mx-auto overflow-hidden rounded-lg bg-white shadow-xl sm:w-full sm:max-w-xl">
                                                    <div class="relative p-6">
                                                        <div class="flex gap-4">
                                                            <div
                                                                class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-green-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="h-6 w-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </div>
                                                            <div class="flex-1">
                                                                <h3 class="text-lg font-medium text-secondary-900">Apakah Ingin Mengubah Kembali Status Entri?</h3>
                                                                <div class="mt-2 text-sm text-secondary-500">Status Akan Berubah Menjadi Entri Peminjaman Kembali</div>
                                                            </div>
                                                        </div>
                                                        <form action="{{ route('pengembalian.rollback', ['id' => $dp->f_id]) }}" method="POST" class="mt-6 flex justify-end gap-3">
                                                            @method('put')
                                                            @csrf
                                                            <button type="button"
                                                                x-on:click="rollback{{ $dp->f_id }} = false"
                                                                class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-center text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100 disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-50 disabled:text-gray-400">Cancel</button>
                                                            <button type="submit"
                                                                class="rounded-lg border border-primary-500 bg-primary-500 px-4 py-2 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-primary-700 hover:bg-primary-700 focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:border-primary-300 disabled:bg-primary-300">Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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

    <x-select2 />
    <script>
        $(document).ready(function() {
            $('#f_idanggota').select2({
                theme: 'bootstrap5',
                placeholder: 'Silahkan Pilih Anggota (Klik Disini!)',
            })
            $('#f_iddetailbuku').select2({
                theme: 'bootstrap5',
                placeholder: 'Silahkan Pilih Buku {Klik Disini}',
            })

            $('#f_idanggota2').select2({
                theme: 'bootstrap5',
                placeholder: 'Silahkan Pilih Anggota (Klik Disini!)',
            })
            $('#f_iddetailbuku2').select2({
                theme: 'bootstrap5',
                placeholder: 'Silahkan Pilih Buku {Klik Disini}',
            })
            $('#f_idadmin2').select2({
                theme: 'bootstrap5',
                placeholder: 'Silahkan Pilih Admin {Klik Disini}',
            })
        })
    </script>

@endsection
