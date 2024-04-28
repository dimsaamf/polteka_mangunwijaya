<!DOCTYPE html>
<html>

<head>
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
            </tr>
        </thead>
        <tbody>
            @if(isset($laporanMasuk) && count($laporanMasuk) > 0)
            @foreach($laporanMasuk as $item)
            <tr class="text-center bg-abu-polteka">
                <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border border-gray-200 px-4 py-2">
                    @foreach($data as $barang)
                    @if($barang->id == $item->id_barang)
                        {{ $barang->nama_barang }}
                    @endif
                    @endforeach
                </td>
                <td class="border border-gray-200 px-4 py-2">
                    @foreach($data as $barang)
                        @if($barang->id == $item->id_barang)
                            {{ $barang->kode_barang }}
                        @endif
                    @endforeach
                </td>
                <td class="border border-gray-200 px-4 py-2">{{ $item->tanggal_masuk }}</td>
                <td class="border border-gray-200 px-4 py-2">
                    {{ $item->jumlah_masuk }}
                    @foreach($data as $barang)
                        @if($barang->id == $item->id_barang)
                            {{ $barang->satuan }}
                        @endif
                    @endforeach
                </td>
            </tr>
            @endforeach

            @elseif(isset($laporanKeluar) && count($laporanKeluar) > 0)
            @foreach($laporanKeluar as $item)
            <tr>
                <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border border-gray-200 px-4 py-2">
                    @foreach($data as $barang)
                    @if($barang->id == $item->id_barang)
                        {{ $barang->nama_barang }}
                    @endif
                    @endforeach
                </td>
                <td class="border border-gray-200 px-4 py-2">
                    @foreach($data as $barang)
                        @if($barang->id == $item->id_barang)
                            {{ $barang->kode_barang }}
                        @endif
                    @endforeach
                </td>
                <td class="border border-gray-200 px-4 py-2">{{ $item->tanggal_keluar }}</td>
                <td class="border border-gray-200 px-4 py-2">
                    {{ $item->jumlah_keluar }}
                    @foreach($data as $barang)
                        @if($barang->id == $item->id_barang)
                            {{ $barang->satuan }}
                        @endif
                    @endforeach
                </td>
            </tr>
            @endforeach

            @else
            <tr>
                <td colspan="5" class="border border-gray-200 px-4 py-2 text-center">No data available</td>
            </tr>
            @endif

        </tbody>
    </table>
</body>

</html>
