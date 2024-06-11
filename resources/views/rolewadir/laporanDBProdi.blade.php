<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="{{ asset('login.png') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekapitulasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <div class="header text-center mb-8">
        <img src="logo.png" alt="Logo" class="h-20">
        <div class="mt-2">
            <h5 class="text-lg font-semibold">LAPORAN PERSEDIAAN BARANG PROGRAM STUDI</h5>
            <h6 class="text-base">POLITEKNIK KATOLIK MANGUNWIJAYA</h6>
            <h2 class="text-base">Laporan Persediaan Barang Program Studi {{ $prodi }}</h2>
        </div>
        <hr class="border-2 border-blue-600 my-6">
    </div>

    <table class="w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-200 px-4 py-2">No</th>
                <th class="border border-gray-200 px-4 py-2">Nama Barang</th>
                <th class="border border-gray-200 px-4 py-2">Kode Barang</th>
                <th class="border border-gray-200 px-4 py-2">Jumlah</th>
                <th class="border border-gray-200 px-4 py-2">Harga</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($semuaData) && count($semuaData) > 0)
            @foreach($semuaData as $item)
            <tr class="text-center bg-abu-polteka">
                <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border border-gray-200 px-4 py-2">
                    {{ $item->nama_barang }}
                </td>
                <td class="border border-gray-200 px-4 py-2">
                    {{ $item->kode_barang }}
                </td>
                <td class="border border-gray-200 px-4 py-2">
                    {{ $item->jumlah }}
                </td>
                <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" class="border border-gray-200 px-4 py-2 text-center">No data available</td>
            </tr>
            @endif

        </tbody>
    </table>
</body>

</html>
