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
            <hp style="line-height:26px;">Laporan Peserta GAS (Gerakan Amal Sholeh)  dalam program {{$dataProgram->nama_program}} pada tanggal {{$dataProgram->tanggal}} hingga saat ini. </hp>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- data transaksi --}}
                    @foreach ($dataJamaah as $item)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->tanggal}}</td>
                            <td>Rp. {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                            <td>{{$item->status}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        {{-- section kesimpulan --}}
        <div class="section_kesimpulan">
            <p>Biaya dibutuhkan sebesar <strong>Rp. {{ number_format($dataProgram->biaya, 2, ',', '.')}}</strong></p>
            <p>Dana terkumpul berstatus lunas sebesar <strong>Rp. {{ number_format($danaTerkumpul, 2, ',', '.') }}</strong> dengan total jama'ah sebanyak <strong>{{$totalLunas}} jiwa</strong>.</p>
            <p>Dana berstatus utang sebesar <strong>Rp. {{ number_format($dataUtang, 2, ',', '.')}}</strong> dengan total jama'ah sebanyak <strong>{{$totalUtang}} jiwa</strong></p>
            @if($danaTerkumpul > $dataProgram->biaya)
                <p>Jadi, dana terkumpul <strong>Sudah Terpenuhi</strong> dengan sisa sebesar<strong> Rp. {{ number_format($totalTambah, 2, ',', '.') }} </strong></p>     
            @else
                <p>Jadi, dana terkumpul <strong>Belum Terpenuhi</strong> dengan kurang sebesar<strong> Rp. {{ number_format($totalKurang, 2, ',', '.') }} </strong></p>  
            @endif
        </div>
    </div>
</body>
</html>