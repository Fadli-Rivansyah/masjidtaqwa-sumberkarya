<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .section_header{
            line-height: 35%;
        }
        th{
            background-color: silver;
        }
        .table, th ,td{
            padding: 10px;
            border: 1px solid black;
            border-collapse: collapse;
        }
        .bold{
            font-weight: 700;
        }
        .section_tandaTangan{
            width: max-content;
            display: flex;
        }
        .section_kesimpulan{
            margin: 1em 0em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="section_header">
            <h1>MASJID TAQWA</h1>
            <h4>MUHAMMADIYAH RANTING SUMBER KARYA</h4>
            <h4>JALAN DANAU TEMPE N0.40 KOTA BINJAI</h4>
        </div>
        <hr style="border: 2px solid black;">
        <div class="my-2">
            <h4>Laporan data pemasukan dan pengeluaran pada tahun 
                @if (intval($tahunAwal) > intval($tahunAkhir) && intval($tahunAkhir) < intval($tahunAwal))
                    {{$tahunAwal}} - {{$tahunAkhir}}
                @else
                    {{$tahunAwal}}
            @endif</h4>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- data transaksi --}}
                    @foreach ($dataExport as $item)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{$item->tanggal_data}}</td>
                            <td>{{$item->jenis_data}}</td>
                            <td>{{$item->kategori_data}}</td>
                            <td>Rp. {{ number_format($item->jumlah_data, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        {{-- section kesimpulan --}}
        <div class="section_kesimpulan">
            <p style="line-height:30px;">Data pemasukan dan pengeluaran pada tanggal <span class="bold">{{$awalTransaksi}}</span> sampai dengan <span class="bold">{{$akhirTransaksi}}</span>, untuk <span class="bold">Pemasukan</span> masjid berjumlah <span class="bold">Rp {{$totalPemasukan}}</span> dan <span class="bold">Pengeluaran</span> masjid berjumlah <span class="bold">Rp {{$totalPengeluaran}}</span>.</p>
            <p style="margin-top: 1em;">Hasil = Rp {{$totalPemasukan}} - Rp {{$totalPengeluaran}}</p>
            <p> = Rp {{$saldo}} </p>
        </div>
    </div>
</body>
</html>