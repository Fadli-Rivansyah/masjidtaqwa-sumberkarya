<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Mustahik</title>
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
            <p style="line-height:26px;">Laporan penerima zakat fitra dimasjid taqwa  pada bulan {{$tanggal}}</p>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis Asnaf</th>
                    <th scope="col">Alamat</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- data transaksi --}}
                    @foreach ($dataMustahik as $item)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td style="text-transform:capitalize;">{{$item->nama}}</td>
                            <td style="text-transform:capitalize;">{{$item->jenis_asnaf}}</td>
                            <td style="text-transform:capitalize;">{{$item->alamat}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        {{-- section kesimpulan --}}
        <div class="section_kesimpulan">
            <h4>Total</h4>
            <p>Jama'ah Mustahik sebesar <strong>{{$totalMustahik}} Jiwa</strong>  </p>
            <p>Jadi, laporan Mustahik pada bulan <strong>{{$tanggal}}</strong>  sebanyak <strong>{{$totalMustahik}} Jiwa.</strong></p>
          
        </div>
      
    </div>
</body>
</html>