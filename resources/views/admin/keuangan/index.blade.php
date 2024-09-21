@extends('admin.layouts.app')
@section('content')
 <div class="container my-4">
    {{-- alert --}}
    <x-alert/>
    {{-- breadcrumb --}}
    <div>{{ Breadcrumbs::render('keuangan')}}</div>
    <div class="col-sm-12 col-md-12 col-lg-12 mt-3 gap-2 d-md-flex justify-content-between ">
        <div class="col-sm-12 col-md-6">
            <h2 class="h2 fw-bold fs-2 display-6">Keuangan </h2>
            <p>Laporan keuangan dapat dilakukan berdasarkan input tanggal awal dan akhir. salah satunya menggunakan fitur filter</p>
        </div>
        <div class="d-flex row flex-column justify-content-start align-items-end row col-sm-2 col-md-6 ">
            <span class="fs-4 fw-bold text_saldo  d-md-flex align-items-center justify-content-end gap-3 " style="color:#1DA599"><i class="bi bi-wallet-fill fs-3 fw-bold"  style="color:#1DA599"></i> SALDO</span>
            @if (!empty($totalSaldo))
            <span class="display-6 fw-bold fs-3  d-md-flex align-items-center justify-content-end gap-3">Rp {{$totalSaldo}}</span>
            @else
            <span class="display-6 fw-bold fs-3 d-md-flex align-items-center justify-content-end gap-3">Rp 0</span>
            @endif
        </div>
    </div>
   {{-- summary --}}
   <div class="row col-sm-12 d-flex gap-2 mx-auto my-2">
    {{-- total pemasukan --}}
        <x-box-summary :total="$totalPemasukan">
            <x-slot name="icon">
                <i class="bi bi-graph-up-arrow float-end fs-3 mx-2 fw-bold"></i>
            </x-slot>
            Total Pemasukan
            <x-slot name="total_true">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</x-slot>
            <x-slot name="total_false">Rp 0</x-slot>
        </x-box-summary>
        {{-- total pengeluaran --}}
       <x-box-summary :total="$totalPengeluaran">
            <x-slot name="icon">
                <i class="bi bi-graph-down-arrow mx-2 fs-3 float-end"></i>
            </x-slot>
            Total Pengeluaran
            <x-slot name="total_true">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</x-slot>
            <x-slot name="total_false">Rp 0</x-slot>
        </x-box-summary> 
        {{-- jumlah data --}}
        <x-box-summary :total="$countTransaksi">
            <x-slot name="icon">
                <i class="bi bi-bar-chart mx-2 fs-3 float-end"></i>
            </x-slot>
            Jumlah
            <x-slot name="total_true">{{ $countTransaksi }}</x-slot>
            <x-slot name="total_false">0</x-slot>
        </x-box-summary> 
    </div>
    {{-- form-filter --}}
    <!-- Modal -->
    <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Filter Pemasukan & Pengeluaran</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div>
                <form action="{{route('keuangan')}}" method="get" class=" gap-2 border rounded p-3 mx-auto">
                    <div class="modal-body">
                        @method('GET')
                        @csrf
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" class="form-label"><i class="bi bi-calendar"></i> Tanggal awal</label>
                            <input type="date" required name="tanggal_mulai" id="tanggal_mulai"  class="form-control" value="{{now()->format('Y-m-d')}}">
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlTextarea1" class="form-label"><i class="bi bi-calendar"></i> Tanggal akhir</label>
                            <input type="date" required name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{request('tanggal_selesai')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn border btn-hover rounded "style="height:max-content">Filter</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    {{-- section laporan transaksi --}}
    <div class="row col-sm-12">
        <div class="row-2 mt-2 col-md-12 d-md-flex justify-content-between">
            <div cllas="col-sm-12 row col-md-7">
                <div class="my-2">
                    <form action="{{route('keuangan')}}" method="get" class="d-flex col-sm-12 mx-auto">
                        @csrf
                        <input class="form-control" type="text" placeholder="Cari.." value="{{request('search')}}" name="search" required >
                        <button type="submit" class="btn-search mx-2 rounded px-3 py-1 border-0 text-light" style="background-color: #1DA599" ><i class="bi bi-search"></i></button>
                    </form>
                </div>
                <h5>Daftar Pemasukan & Pengeluaran</h5>
                @if(isset($tanggalMulai))
                    <span class="border border-2 rounded px-2 my-2 d-flex gap-2 align-items-center text-muted fw-medium" style="width:max-content;"><i class="bi bi-calendar fs-5"></i> {{date('d F', strtotime($tanggalMulai))}} - {{date('d F', strtotime($tanggalSelesai))}}</span>
                @endif
                 {{-- fitur pencarian data --}}
                <div class="dropdown d-sm-block d-md-none mt-2">
                    <button class="btn border fw-medium dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu p-3 col-sm-12 gap-2">
                        <a href="{{route('create_dataKeuangan')}}" class="btn mb-2 text-light d-flex align-items-center fw-medium gap-2" style="background-color:#1DA599; width:100%;"><i class="bi bi-plus fs-5 "></i> Buat Transaksi</a>
                            <a href="{{route('keuangan')}}" class="btn text-dark mb-2 d-flex align-items-center gap-2 btn-hover  fw-medium border"><i class="bi bi-arrow-clockwise fs-5 "></i> Refresh</a>
                            <!-- Button filter -->
                            <button type="button" class="btn text-dark mb-2 d-flex align-items-center gap-2 btn-hover fw-medium border" style="width:100%;" data-bs-toggle="modal" data-bs-target="#modalFilter">
                                <i class="bi bi-filter fs-5"></i> Filter
                            </button>
                            <form action="{{route('laporan_keuangan')}}" method="get" class="col-md-12">
                                @method('GET')
                                @csrf
                                <input type="hidden" name="data" value="{{$dataExport}}">
                                <input type="hidden" name="total_pemasukan" value="{{$totalPemasukan}}">
                                <input type="hidden" name="total_pengeluaran" value="{{$totalPengeluaran}}">
                                <button type="submit" class="btn col-sm-12 btn-hover d-flex align-items-center gap-2 border rounded text-dark fw-medium  d-flex align-items-center fw-medium" style="background-color: #FFC265; width:100%;"><i class="bi bi-printer fs-5"></i> Export</button>
                            </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 gap-4 d-none d-md-flex justify-content-end align-items-center">
                <a href="{{route('keuangan')}}" class="text-dark btn-hover text-center btn border gap-2 text-light d-flex fw-medium align-items-center"><i class="bi bi-arrow-clockwise fs-5 mx-1 "></i> Refresh</a>
                <!-- Button filter -->
                <button type="button" class="text-dark btn-hover text-center btn border gap-2 text-light d-flex fw-medium align-items-center" data-bs-toggle="modal" data-bs-target="#modalFilter">
                    <i class="bi bi-filter fs-5 mx-1"></i> Filter
                </button>
                <form action="{{route('laporan_keuangan')}}" method="get">
                    @method('GET')
                    @csrf
                    <input type="hidden" name="data" value="{{$dataExport}}">
                    <input type="hidden" name="total_pemasukan" value="{{$totalPemasukan}}">
                    <input type="hidden" name="total_pengeluaran" value="{{$totalPengeluaran}}">
                    <button type="submit" class="btn col-sm-12 btn-hover border rounded text-dark gap-2 d-flex align-items-center fw-medium" style="background-color: #FFC265;"><i class="bi bi-printer mx-1 fs-5"></i> Export</button>
                </form>
                <a href="{{route('create_dataKeuangan')}}" class="btn border fw-medium text-light d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5"></i>Buat Data</a>
               
            </div>
        </div>
    </div>
    {{-- table --}}
    <div class="table table-responsive-md my-3">
        <table class="table border border-1 rounded">
            <thead>
                <tr>
                    <td scope="col">Id</td>
                    <td scope="col">Tanggal</td>
                    <td scope="col">Jenis</td>
                    <td scope="col">Kategori</td>
                    <td scope="col">Jumlah</td>
                    <td scope="col">Keterangan</td>
                    <td scope="col">Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
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
                    <td>
                        <div class="d-flex gap-3">
                            <a class="text-dark" title="Ubah" href="{{route('edit_dataKeuangan', ['id' => $item->id])}}"><i class="bi bi-pencil fs-5"></i></a>
                            <form action="{{route('delete_dataKeuangan')}}" method="post" onsubmit="if(!confirm('yakin mau dihapus!')){return false;}">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button type="submit" class="bg-transparent border-0"> <i class="bi bi-trash fs-5"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- pagination --}}
    <div class="section_pagination col-12">
        {{ $data->appends(request()->except('page'))->links() }}
    </div>
    {{-- alert table --}}
    @if($data->isEmpty())
        <div class="section_notFound container col-12">
            <h5 class="col-12 mb-4 text-center"><i class="bi "> </i>Tidak ada data !!</h5>
            <a href="{{route('create_dataKeuangan')}}" class="btn  mb-2 text-dark d-flex align-items-center gap-2" style="border: 2px dashed silver"><i class="bi bi-plus-square-dotted  bg-transparent fs-5"></i> Buat Data</a>
        </div>
    @endif  
</div>
@endsection