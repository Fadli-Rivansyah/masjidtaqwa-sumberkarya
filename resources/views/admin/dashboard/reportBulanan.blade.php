<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laporan keuangan</title>
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
            <p>Data Pemasukan dan pengeluaran bulanan tahun {{date(now()->format('Y'))}}</p>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Bulan</th>
                    <th scope="col">Pemasukan</th>
                    <th scope="col">Pengeluaran</th>
                    <th scope="col">Pendapatan</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- data transaksi --}}
                    @foreach ($bulanan as $item => $data)
                        <tr>
                            <td>{{$item}}</td>
                            <td>Rp {{number_format($data['pemasukanBulanan'], 2,',','.')}}</td>
                            <td>Rp {{number_format($data['pengeluaranBulanan'], 2,',','.')}}</td>
                            <td>Rp {{number_format($data['saldo'], 2,',','.')}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        {{-- section kesimpulan --}}
        <div class="section_kesimpulan">
            <p style="line-height:30px;">Data pemasukan dan pengeluaran pada tanggal <span class="bold">{{date('d F Y', strtotime($awalTransaksi->tanggal_data))}}</span> sampai dengan <span class="bold">{{date('d F Y', strtotime($akhirTransaksi->tanggal_data))}}
            <p style="margin-top: 1em;">Hasil pendapatan = <strong> Rp {{number_format($totalSaldo, 2, ',', '.')}} </strong>
        </div>
    </div>
</body>
</html>