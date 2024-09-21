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
            font-size: 0.8rem;
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            text-transform: capitalize;
        }
       .section_notfound{
            font-size: 0.9rem;
            text-align: center;
       }
        .bold{
            font-weight: 700;
        }
        .section_tandaTangan{
            width: max-content;
            display: flex;
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
        <div>
            <p>Laporan peserta Qurban dimasjid taqwa  pada bulan {{$qurban->tahun_qurban}} </p>
            {{-- section kesimpulan --}}
            <div class="section_kesimpulan">
                <p style="line-height: 29px;">Total Uang Qurban sebesar <strong>Rp. {{ number_format($totalDana, 2, ',', '.')}}</strong>. untuk <strong>Patungan hewan lembu</strong> berjumlah <strong>{{$jumlahShohibulPL}}</strong> shohibul qurban, untuk <strong>Mandiri hewan lembu</strong> berjumlah <strong>{{$mandiriLembu->count()}}</strong> shohibul qurban, dan untuk <strong>Mandiri hewan kambing</strong> berjumlah <strong>{{$mandiriKambing->count()}}</strong> shohibul qurban.</p>
            </div>
            <div>
                <div>
                    <div>
                        <h4>Patungan (Lembu)</h4>
                        @if(isset($patunganLembu))
                            @foreach($patunganLembu as $group)
                                <table class="table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Nomor Urut {{ $loop->iteration }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($group as $item)
                                        <tr>
                                            <td>{{ $item->nama }}</td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                            @else
                            <div class="section_notfound">
                                <span>Tidak ada data patungan(Lembu)</span>
                            </div>
                            @endif
                        </div>
                    <div>
                <div>
                <div>
                    <h4>Mandiri (Lembu)</h4>
                    @if(isset($mandiriLembu))
                        @foreach($mandiriLembu as $item)
                                <table class="table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nomor Urut {{ $loop->iteration }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $item->nama }}</td> 
                                        </tr>
                                    </tbody>
                            </table>
                        @endforeach
                    @else
                    <div class="section_notfound">
                        <span>Tidak ada data Mandiri(Lembu)</span>
                    </div>
                    @endif
                </div>
                <div>
                    <h4>Mandiri (Kambing)</h4>
                    @if(isset($mandiriKambing))
                        @foreach($mandiriKambing as $item)
                            <table class="table " style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor Urut {{ $loop->iteration }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $item->nama }}</td> 
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                     @else
                     <div class="section_notfound">
                         <span>Tidak ada data Mandiri(Kambing)</span>
                     </div>
                     @endif   
                </div>
            </div>
        </div>
        
      
    </div>
</body>
</html>