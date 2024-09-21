@extends('admin.layouts.app')
@section('content')
    <div class="container my-4">
        <x-alert />
           {{-- bradcrumbs --}}
           <div>{{ Breadcrumbs::render('dashboard')}}</div>
        <div class="col-sm-12 col-md-12 col-lg-12 d-md-flex  justify-content-between ">
            <div class="col-sm-12 col-md-6">
                <h2 class="h2 fw-bold fs-2 display-6">Dashboard</h2>
                <p class="text-muted fw-medium">Halo!! Selamat datang {{auth()->user()->name}}!!</p>
            </div>
            <div class="d-flex row flex-column justify-content-start align-items-end row col-sm-2 col-md-6 ">
                <span class="fs-4 fw-bold text_saldo  d-md-flex align-items-center justify-content-end gap-3 " style="color:#1DA599"><i class="bi bi-wallet-fill fs-1 fw-bold"  style="color:#1DA599"></i> SALDO</span>
                @if (!empty($totalSaldo))
                <span class="display-6 fw-bold fs-3  d-md-flex align-items-center justify-content-end gap-3">Rp {{number_format($totalSaldo, 2, ',','.')}}</span>
                @else
                <span class="display-6 fw-bold fs-3 d-md-flex align-items-center justify-content-end gap-3">Rp 0</span>
                @endif
            </div>
        </div>
        {{-- summary --}}
        <div class="row d-flex gap-2 mt-2 mb-4 ">
            <h5 class="mt-1">Daftar Pemasukan & Pengeluaran Bulan Ini</h5>
            <div class="row mx-auto gap-2 ">
                <x-box-summary :total="$pemasukanBulanIni">
                    <x-slot name="icon">
                        <i class="bi bi-graph-up-arrow float-end fs-3 mx-2 fw-bold"></i>
                    </x-slot>
                    Total Pengeluaran
                    <x-slot name="total_true">Rp {{ number_format($pemasukanBulanIni, 2, ',', '.') }}</x-slot>
                    <x-slot name="total_false">Rp 0</x-slot>
                </x-box-summary>
                <x-box-summary :total="$pengeluaranBulanIni">
                    <x-slot name="icon">
                        <i class="bi bi-graph-down-arrow mx-2 fs-3 float-end"></i>
                    </x-slot>
                    Total Pengeluaran
                    <x-slot name="total_true">Rp {{ number_format($pengeluaranBulanIni, 2, ',', '.') }}</x-slot>
                    <x-slot name="total_false">Rp 0</x-slot>
                </x-box-summary>
                <x-box-summary :total="$jumlahTransaksiBulanIni">
                    <x-slot name="icon">
                        <i class="bi bi-bar-chart mx-2 fs-3 float-end"></i>
                    </x-slot>
                    Jumlah
                    <x-slot name="total_true">{{ $jumlahTransaksiBulanIni }}</x-slot>
                    <x-slot name="total_false">0</x-slot>
                </x-box-summary>
            </div>
        </div>
        {{-- chart --}}
        <div id="chart">
            {!! $chart->container() !!}
        </div>
        {{-- table --}}
        <div class="gap-3 my-2">
            <div class="table table-responsive-md my-3">
                <div class="d-flex gap-4 align-items-center my-3" >
                    <h5>Bulanan Pemasukan & Pengeluaran</h5>
                    <div>
                        <form action="{{route('dashboard_export')}}" method="post">
                            @method('post')
                            @csrf
                            <button class="btn fw-medium d-flex text-dark align-items-center gap-2"  style="background-color: #FFC265" ><i class="bi bi-printer fs-5 "></i> Export</button>
                        </form>
                    </div>
                </div>
                <table class="table border border-1 rounded col-lg-3" >
                    <thead>
                        <tr>
                            <td scope="col">Bulan</td>
                            <td scope="col">Pemasukan</td>
                            <td scope="col">Pengeluaran</td>
                            <td scope="col">Pendapatan</td>
                            <td scope="col">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bulanan as $month => $data)
                        <tr>
                            <td>{{$month}}</td>
                            <td>Rp {{number_format($data['pemasukanBulanan'],2,',','.')}}</td>
                            <td>Rp {{number_format($data['pengeluaranBulanan'],2,',','.')}}</td>
                            @if($data['saldo'] < 0)
                                <td style="color:#b93f54;">Rp {{number_format($data['saldo'], 2, ',','.')}}</td>
                            @else
                                <td>Rp {{number_format($data['saldo'], 2, ',','.')}}</td>
                            @endif
                            <td>
                                <form action="/dashboard" method="post">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="data_bulan" value="{{$month}}">
                                    <button type="submit" class="btn-outline-none btn-hover border border-0 bg-transparent"><i class="bi bi-trash fs-5"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table table-responsive-md my-2 mb-4">
                <div class="d-flex gap-4 align-items-center my-3" >
                    <h5>Daftar Pemasukan & Pengeluaran</h5>
                    <div>
                        <a href="{{route('create_dataKeuangan')}}" class="btn border fw-medium text-light d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5"></i>Buat Data</a>
                    </div>
                </div>
                <table class="table border border-1 rounded">
                    <thead>
                        <tr>
                            <td scope="col">Tanggal</td>
                            <td scope="col">Jenis</td>
                            <td scope="col">Jumlah</td>
                            <td scope="col">Keterangan</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataTransaksi as $item)
                        <tr>
                            <td>{{date('d F Y', strtotime($item->tanggal_data))}}</td>
                            <td class="text-capitalize">
                                @if ($item->jenis_data == "pemasukan")
                                    <span name="jenisTransaksi" class="badge text-medium rounded text-light" style="background-color: #1DA599;">{{$item->jenis_data}}</span>
                                @else
                                    <span name="jenisTransaksi" class="badge text-medium rounded text-light" style="background-color: #b93f54;">{{$item->jenis_data}}</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($item->jumlah_data, 2, ',', '.') }}</td>
                            <td>{{$item->keterangan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
@endsection