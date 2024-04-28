@extends('layouts.admin')

@section('title', $pustakawan->f_nama)

@section('content')

    <div class="flex flex-col justify-center items-start gap-2 mb-3">
        <h3 class="text-xl"><span class="font-semibold">Nama:</span> {{ $pustakawan->f_nama }}</h3>
        <h3 class="text-xl"><span class="font-semibold">Username:</span> {{ $pustakawan->f_username }}</h3>
        <h3 class="text-xl"><span class="font-semibold">Level:</span> {{ $pustakawan->f_level }}</h3>
        <h3 class="text-xl"><span class="font-semibold">Status:</span> {{ $pustakawan->f_status }}</h3>
    </div>

    <hr>

    <h3 class="mb-2 mt-3 font-semibold text-xl">Daftar Entri Peminjaman</h3>
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

                @forelse ($entriPeminjaman as $peminjaman)
                    <tr class="hover:bg-gray-50">
                        <td class="pl-6 py-4">{{ $loop->iteration }}</td>
                        <td class="pl-6 py-4">{{ $peminjaman->anggota->f_nama }}</td>
                        <td class="pl-6 py-4 font-bold">{{ $peminjaman->admin->f_nama }}</td>
                        <td class="pl-6 py-4">{{ $peminjaman->detailPeminjaman->detailbuku->buku->f_judul }}</td>
                        <td class="pl-6 py-4">{{ $peminjaman->f_tanggalpeminjaman }}</td>
                        <td class="pl-6 py-4">(Belum Dikembalikan)</td>
                        <td class="pl-6 py-4">
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                {{ $peminjaman->detailPeminjaman->f_status }}
                            </span>
                        </td>
                    </tr>

                @empty
                    <tr class="hover:bg-gray-50">
                        <td colspan="7" class="px-6 py-4 text-center">TIDAK ADA DATA ENTRI PEMINJAMAN</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <h3 class="mb-2 mt-8 font-semibold text-xl">Daftar Entri Pengembalian</h3>
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

                @forelse ($entriPengembalian as $peminjaman)
                    <tr class="hover:bg-gray-50">
                        <td class="pl-6 py-4">{{ $loop->iteration }}</td>
                        <td class="pl-6 py-4">{{ $peminjaman->anggota->f_nama }}</td>
                        <td class="pl-6 py-4 font-bold">{{ $peminjaman->admin->f_nama }}</td>
                        <td class="pl-6 py-4">{{ $peminjaman->detailPeminjaman->detailbuku->buku->f_judul }}</td>
                        <td class="pl-6 py-4">{{ $peminjaman->f_tanggalpeminjaman }}</td>
                        <td class="pl-6 py-4">{{ $peminjaman->detailPeminjaman->f_tanggalkembali }}</td>
                        <td class="pl-6 py-4">
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                {{ $peminjaman->detailPeminjaman->f_status }}
                            </span>
                        </td>
                    </tr>

                @empty
                    <tr class="hover:bg-gray-50">
                        <td colspan="7" class="px-6 py-4 text-center">TIDAK ADA DATA ENTRI PENGEMBALIAN</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
