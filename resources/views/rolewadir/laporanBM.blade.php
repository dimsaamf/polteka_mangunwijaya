<!DOCTYPE html>
<html>

<head>
    <title>Laporan Rekapitulasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td {
            font-size: 9pt;
        }

        table thead tr th {
            text-align: center;
            font-size: 11pt;
        }

        .total th {
            font-size: 11pt;
            color: red;
        }

        hr {
            margin-top: 1px;
            margin-bottom: 30px;
            border: 2px;
            color: rgb(4, 79, 102);
        }

        img {
            height: 100px;
            width: 100px;
        }

    </style>

    <center>
        <img src="images/kantor.png" alt="">
        <h5>Inventori Barang Kantor Kelurahan Kalitimbang Cilegon</h5>
            <br>Laporan Barang Masuk<br>
            <h6>Tanggal : {{ date('d-M-Y', strtotime($dari)) }} - {{ date('d-M-Y', strtotime($sampai)) }}</h6>

        </center>
        <hr>

        <table class='table table-bordered'>
            <thead>
                <tr >
                    <th scope="col" class="px-6 py-3 text-center">No</th>
                    <th scope="col" class="px-6 py-3 text-center">Nama Barang</th>
                    <th scope="col" class="px-6 py-3 text-center">ID Barang</th>
                    <th scope="col" class="px-6 py-3 text-center">Tanggal Masuk</th>
                    <th scope="col" class="px-6 py-3 text-center">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($laporanMasuk) && count($laporanMasuk) > 0)
                    @foreach($laporanMasuk as $item)
                        <tr class="text-center bg-abu-polteka ">
                            <td class="px-6 py-2 whitespace-nowrap rounded-l-xl">{{ $loop->iteration }}</td>
                            <td class="px-6 py-2 whitespace-nowrap">@foreach($data as $barang)
                                @if($barang->id == $item->id_barang)
                                    {{ $barang->nama_barang }}
                                @endif
                            @endforeach</td>
                            <td class="px-6 py-2 whitespace-nowrap">@foreach($data as $barang)
                                @if($barang->id == $item->id_barang)
                                    {{ $barang->kode_barang }}
                                @endif
                            @endforeach</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $item->tanggal_masuk }}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $item->jumlah_masuk }}
                            @foreach($data as $barang)
                                @if($barang->id == $item->id_barang)
                                    {{ $barang->satuan }}
                                @endif
                            @endforeach</td>
                        </tr>
                    @endforeach
                    @elseif(isset($laporanKeluar) && count($laporanKeluar) > 0)
                    @foreach($laporanKeluar as $item)
                        <tr class="text-center bg-abu-polteka ">
                            <td class="px-6 py-2 whitespace-nowrap rounded-l-xl">{{ $loop->iteration }}</td>
                            <td class="px-6 py-2 whitespace-nowrap">@foreach($data as $barang)
                                @if($barang->id == $item->id_barang)
                                    {{ $barang->nama_barang }}
                                @endif
                            @endforeach</td>
                            <td class="px-6 py-2 whitespace-nowrap">@foreach($data as $barang)
                                @if($barang->id == $item->id_barang)
                                    {{ $barang->kode_barang }}
                                @endif
                            @endforeach</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $item->tanggal_keluar }}</td>
                            <td class="px-6 py-2 whitespace-nowrap">{{ $item->jumlah_keluar }}
                            @foreach($data as $barang)
                                @if($barang->id == $item->id_barang)
                                    {{ $barang->satuan }}
                                @endif
                            @endforeach</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No data available</td>
                    </tr>
                @endif
            </tbody>
            
        </table>

    </body>

    </html>
