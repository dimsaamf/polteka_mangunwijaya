<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="{{ asset('login.png') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekapitulasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="header text-center mb-8">
        <img src="logo.png" alt="Logo" class="h-20">
        <div class="mt-2">
            <h5 class="text-lg font-semibold">LAPORAN BARANG MASUK PROGRAM STUDI</h5>
            <h6 class="text-base">POLITEKNIK KATOLIK MANGUNWIJAYA</h6>
            <h6 class="text-base">Tanggal {{ \Carbon\Carbon::parse($dari)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($sampai)->translatedFormat('d F Y') }}</h6>
        </div>
        <hr class="border-2 border-blue-600 my-6">
    </div>

    <table class="w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-200 px-4 py-2">No</th>
                <th class="border border-gray-200 px-4 py-2">Nama Barang</th>
                <th class="border border-gray-200 px-4 py-2">ID Barang</th>
                <th class="border border-gray-200 px-4 py-2">Tanggal Masuk</th>
                <th class="border border-gray-200 px-4 py-2">Jumlah</th>
                <th class="border border-gray-200 px-4 py-2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @if($semuaBarangMasuk->isEmpty())
                <tr>
                    <td colspan="6" class="border border-gray-200 px-4 py-2 text-center">Tidak Ada Data Barang Masuk</td>
                </tr>
            @else
                @foreach($semuaBarangMasuk as $barangMasuk)
                    <tr class="text-center bg-abu-polteka">
                        <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $barangMasuk->nama_barang }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $barangMasuk->kode_barang }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $barangMasuk->tanggal_masuk }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $barangMasuk->jumlah_masuk }} {{ $barangMasuk->satuan }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $barangMasuk->keterangan_masuk }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>
