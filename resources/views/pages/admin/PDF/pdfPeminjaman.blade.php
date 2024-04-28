<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi Hari Ini</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 10px 5px;
        }

        th {
            background-color: #f2f2f2;
            font-size: 15px;
        }

        td{
            font-size: 14px;
        }
    </style>
</head>
<body>
    <center>
        <div class="header">
            {{-- <img src="{{ public_path('assets/image/logo65.png') }}" alt="" style="width: 100px;"> --}}
            <h1>SPANCA LIBRARY - ENTRI PEMINJAMAN</h1>
        </div>
    </center>
    <p style="font-size: 18px;"><span style="font-weight: 600;">Total Entri Peminjaman: </span>{{ $dPeminjaman->count() }}</p>
    </p>
    <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No.
                </th>
                <th scope="col" class="px-6 py-3">
                    Peminjam
                </th>
                <th scope="col" class="px-6 py-3" >
                    Admin
                </th>
                <th scope="col" class="px-6 py-3" >
                    Buku
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal Pinjam
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal Kembali
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>

                @foreach ($dPeminjaman as $dp)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="p-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="notNum px-6 py-4 font-semibold text-gray-500 font-medium dark:text-white">
                            {{ $dp->peminjaman->anggota->f_nama }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-500 font-medium dark:text-white">
                            {{ $dp->peminjaman->admin->f_nama }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-500 font-medium dark:text-white">
                            {{ $dp->detailbuku->buku->f_judul }}
                        </td>

                        <td class="notNum px-6 py-4 font-semibold text-gray-500 font-medium dark:text-white">
                            {{ $dp->peminjaman->f_tanggalpeminjaman }}
                        </td>

                        <td class="notNum px-6 py-4 font-semibold text-gray-500 font-medium dark:text-white">
                            (Belum Dikembalikan)
                        </td>
                        <td class="notNum px-6 py-4 font-semibold text-gray-500 font-medium dark:text-white">
                            {{ $dp->f_status }}
                        </td>
                    </tr>
                @endforeach



        </tbody>
    </table>
</body>
</html>