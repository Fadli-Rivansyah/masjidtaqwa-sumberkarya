<div style="overflow-y: scroll; height:50vh;scrollbar-color:#11635c27 rgba(116, 116, 116, 0.253)">
    <div class="table table-borderless table-responsive-md">
        <table class="table ">
            <thead >
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataInfaq as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{date('d F Y', strtotime($item->tanggal_data))}}</td>
                    <td class="text-capitalize">
                        @if ($item->jenis_data == "pemasukan")
                            <span name="jenisTransaksi" class="badge text-medium rounded text-light" style="background-color: #1DA599;">{{$item->jenis_data}}</span>
                        @else
                            <span name="jenisTransaksi" class="badge text-medium rounded text-light" style="background-color: #b93f54;">{{$item->jenis_data}}</span>
                        @endif
                    </td>
                    <td class="text-capitalize">{{$item->kategori_data}}</td>
                    <td>Rp. {{ number_format($item->jumlah_data, 2, ',', '.') }}</td>
                    <td>{{$item->keterangan}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>