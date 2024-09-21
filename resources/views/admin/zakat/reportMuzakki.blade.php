<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Muzakki</title>
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
            text-transform: capitalize;
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
            <p style="line-height:26px;">Laporan peserta Zakat Fitra di  masjid taqwa  pada bulan {{$tanggal}} </p>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah Orang</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Jumlah/Kg</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- data transaksi --}}
                    @foreach ($dataMuzakki as $item)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td style="text-transform:capitalize;">{{$item->nama}}</td>
                            <td>{{$item->jumlah_orang}}</td>
                            @if($item->kategori == 'beras')
                                <td style="text-transform:capitalize;">{{$item->kategori}}</td>
                                <td >{{$item->jumlah}} Kg</td>
                            @else
                                <td style="text-transform:capitalize;">{{$item->kategori}}</td>
                                <td>Rp. {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        {{-- section kesimpulan --}}
        <div class="section_kesimpulan">
            <h4>Total</h4>
            <p>Zakat Uang sebesar <strong>Rp. {{ number_format($totalZakatUang, 2, ',', '.')}}</strong> dan Zakat Beras seberat <strong>{{$totalZakatBeras}} Kg</strong> dari <strong>{{$jumlahMuzakki}} Jiwa</strong>.</p>
            <p>Jadi, laporan pada  peserta zakat fitra pada <strong>{{$tanggal}}</strong> ini terkumpul uang sebesar <strong>Rp {{number_format($totalZakatUang, 2, ',', '.')}}</strong> dan beras seberat <strong>{{$totalZakatBeras}} Kg</strong> </p>
          
        </div>
      
    </div>
</body>
</html>