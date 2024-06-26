<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="{{ asset('logo.png') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekapitulasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="header text-center mb-8">
        <img src="logo.png" alt="Logo" class="h-20">
        <div class="mt-2">
            <h5 class="text-lg font-semibold">LAPORAN BARANG KELUAR LABORATORIUM</h5>
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
                <th class="border border-gray-200 px-4 py-2">Tanggal Keluar</th>
                <th class="border border-gray-200 px-4 py-2">Jumlah</th>
                <th class="border border-gray-200 px-4 py-2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @if($semuaBarangKeluar->isEmpty())
                <tr>
                    <td colspan="6" class="border border-gray-200 px-4 py-2 text-center">Tidak Ada Data Barang Keluar</td>
                </tr>
            @else
                @foreach($semuaBarangKeluar as $barangKeluar)
                    <tr class="text-center bg-abu-polteka">
                        <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $barangKeluar->nama_barang }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $barangKeluar->kode_barang }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $barangKeluar->tanggal_keluar }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $barangKeluar->jumlah_keluar }} {{ $barangKeluar->satuan }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $barangKeluar->keterangan_keluar }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>
