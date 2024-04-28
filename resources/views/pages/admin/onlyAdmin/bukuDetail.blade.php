@extends('layouts.admin')

@section('title', $dBuku->buku->f_judul)

@section('content')
    <div class="mb-3 flex lg:flex-row flex-col justify-start items-start gap-2">
        <div>
            <img src="{{ $dBuku->buku->f_gambar ? asset('storage/'.$dBuku->buku->f_gambar) : asset('assets/image/noBookImg.png') }}" alt="{{ $dBuku->buku->f_judul }}" class="h-[300px] max-w-[210px]">
        </div>
        <div class="flex flex-col justify-center items-start gap-2 mb-3">
            <h3 class="text-xl"><span class="font-semibold">Judul:</span> {{ $dBuku->buku->f_judul }}</h3>
            <h3 class="text-xl"><span class="font-semibold">Pengarang:</span> {{ $dBuku->buku->f_pengarang }}</h3>
            <h3 class="text-xl"><span class="font-semibold">Penerbit:</span> {{ $dBuku->buku->f_penerbit }}</h3>
            <h3 class="text-xl"><span class="font-semibold">Deskripsi:</span> {{ $dBuku->buku->f_deskripsi }}</h3>
            <h3 class="text-xl"><span class="font-semibold">Kategori:</span> {{ $dBuku->buku->kategori->f_kategori }}</h3>
        </div>
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
                        <td class="pl-6 py-4">{{ $peminjaman->admin->f_nama }}</td>
                        <td class="pl-6 py-4 font-bold">{{ $peminjaman->detailPeminjaman->detailbuku->buku->f_judul }}</td>
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
                        <td class="pl-6 py-4">{{ $peminjaman->admin->f_nama }}</td>
                        <td class="pl-6 py-4 font-bold">{{ $peminjaman->detailPeminjaman->detailbuku->buku->f_judul }}</td>
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
