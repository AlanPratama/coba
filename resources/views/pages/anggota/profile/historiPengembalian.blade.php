@extends('layouts.main')

@section('title', 'Histori Pengembalian')

@section('content')
    <div class="px-8 py-8">
        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">No.</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Admin</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Buku</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Tgl. Pinjam</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Tgl. Kembali</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    @foreach ($dPeminjaman as $dPinjam)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $loop->iteration }}.</td>
                            <td class="px-6 py-4">{{ $dPinjam->peminjaman->admin->f_nama }}</td>
                            <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                <div class="relative w-10 h-14">
                                    <img class="h-full w-full rounded object-cover object-center shadow"
                                        src="{{ $dPinjam->detailBuku->buku->f_gambar ? asset('storage/' . $dPinjam->detailBuku->buku->f_gambar) : asset('assets/image/noBookImg.png') }}"
                                        alt="" />
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium text-gray-700">{{ $dPinjam->detailBuku->buku->f_judul }}
                                    </div>
                                    <div class="text-gray-400">{{ $dPinjam->detailBuku->buku->f_pengarang }}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">{{ $dPinjam->peminjaman->f_tanggalpeminjaman }}</td>
                            <td class="px-6 py-4">{{ $dPinjam->f_tanggalkembali }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                    {{ $dPinjam->f_status }} </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
