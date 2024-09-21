@extends('admin.layouts.app')
@section('content')
<div class="container">
    <x-alert />
    <div>{{ Breadcrumbs::render('view_program', $program->id)}}</div>
    <div class="row col-sm-12  d-flex gap-3 justify-content-between">
        <div class="col-md-6">
            <h2 class="h2 fw-bold display-6 fs-2">GAS (Gerakan Amal Sholeh)</h2>
                <!-- Button trigger modal -->
            <button type="button" class="btn-hover text-dark btn border mb-2 text-light d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalKeteranganGAS"><i class="bi bi-view-list fs-5"></i>
                Lihat Keterangan
            </button>
        </div>
        {{-- search --}}
        <div class="col-md-5">
            <form action="{{route('view_program', ['id' => $program->id])}}" method="GET" class="col-sm-6 col-md-12 d-flex">
                @method('GET')
                @csrf
                <input class="form-control" type="text" placeholder="Cari.." value="{{request('search_jamaah')}}" name="search_jamaah">
                <button type="submit" href="#tabel-jamaah" class="btn-search text-light mx-2 rounded px-3 py-1 border-0" style="background-color: #1DA599"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
    <!-- Modal keterangan -->
    <div class="modal fade" id="modalKeteranganGAS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header  section_keterangan">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Keterangan Program</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="h4 fw-bold">{{$program->nama_program}}</h4>
                    <p>{{$program->keterangan_program}}</p>
                    <p class="fw-bold">Etimasi Biaya : Rp {{number_format($program->biaya, 2, ',', '.')}} </p>                   
                </div>
            </div>
        </div>
    </div>
    {{-- card --}}
    <div class="row col-md-12 d-flex gap-2 mx-auto mt-3">
        <div class="col-md-5 col-xl-3 col-xxl-3 p-3 border rounded "  @if(intval($danaTerkumpul) >= intval($program->biaya)) style="background-color:#1DA599;color:white;" @endif>
            <div class="col" style="height: max-content;">
                <i class="bi bi-wallet2 float-end fs-3 mx-2 fw-bold"></i>
                <h6 class="fs-6 mb-3">Dana Terkumpul</h6>
                    @if (!empty($danaTerkumpul))
                        <span class="display-6 fw-bold fs-4">Rp {{number_format($danaTerkumpul, 2, ',', '.')}}</span>
                    @else
                        <span class="display-6 fw-bold fs-4">Rp 0</span>
                    @endif
            </div>
        </div>
        <x-box-summary :total="$dataUtang">
            <x-slot name="icon">
                <i class="bi bi-arrows-angle-contract mx-2 fs-3 float-end"></i>
            </x-slot>
            Pembayaran (Utang)
            <x-slot name="total_true">Rp {{$dataUtang}}</x-slot>
            <x-slot name="total_false">Rp 0</x-slot>
        </x-box-summary>
        <x-box-summary :total="$totalJamaah">
            <x-slot name="icon">
                <i class="bi bi-people-fill mx-2 fs-3 float-end"></i>
            </x-slot>
            Total Partisipan
            <x-slot name="total_true">{{$totalJamaah}}</x-slot>
            <x-slot name="total_false">0</x-slot>
        </x-box-summary>
        <x-box-summary :total="$totalUtang">
            <x-slot name="icon">
                <i class="bi bi-dash-circle-fill mx-2 fs-3 float-end"></i>
            </x-slot>
            Total Berutang
            <x-slot name="total_true">{{$totalUtang}}</x-slot>
            <x-slot name="total_false">0</x-slot>
        </x-box-summary>
    </div>
    {{-- daftar jamaah --}}
    <div class="row-4 gap-2 mt-4 my-2 col-md-12 d-flex justify-content-between align-items-center">
        <h4 class="h4" style="width: max-content;">Daftar Jama'ah</h4>
        <div class="gap-4 d-none d-md-flex">
            <a href="{{route('view_program', ['id'=> $program->id])}}" class="btn-hover fw-medium text-dark btn border mb-2 text-light d-flex align-items-center gap-2" ><i class="bi bi-arrow-clockwise fs-5"></i> Refresh</a>
            <a href="{{route('report_jamaah', ['id'=>$program->id])}}" class="btn btn-hover fw-medium border mb-2  d-flex align-items-center gap-2" style="background-color: #FFC265"><i class="bi bi-printer fs-5"></i> Export</a>
            <a href="{{route('create_jamaah', ['id' => $program->id])}}" class="btn border fw-medium mb-2 text-light float-end d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-person-add fs-5"></i> Tambah Jama'ah</a>
        </div>
        <div class="dropdown d-sm-block d-md-none mt-2">
            <button class="btn border dropdown-toggle fw-medium" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
              </button>
            <div class="dropdown-menu p-3 col-sm-12 gap-2">
                <a href="{{route('view_program', ['id'=> $program->id])}}" class="btn-hover fw-medium text-dark btn border mb-2 text-light d-flex align-items-center gap-2" ><i class="bi bi-arrow-clockwise fs-5"></i> Refresh</a>
                <a href="{{route('report_jamaah', ['id'=>$program->id])}}" class="btn btn-hover fw-medium border mb-2  d-flex align-items-center gap-2" style="background-color: #FFC265"><i class="bi bi-printer fs-5"></i> Export</a>
                <a href="{{route('create_jamaah', ['id' => $program->id])}}" class="btn border fw-medium mb-2 text-light float-end d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-person-add fs-5"></i> Tambah Jama'ah</a>
            </div>
        </div>
    </div>
    <div class="table table-responsive-md my-3" id="table-jamaah">
        <table class="table border border-1 rounded">
            <thead>
                <tr>
                    <td scope="col">Id<I/td>
                    <td scope="col">Nama</td>
                    <td scope="col">Tanggal</td>
                    <td scope="col">Status</td>
                    <td scope="col">No. Telepon</td>
                    <td scope="col">Jumlah</td>
                    <td scope="col">Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataJamaah as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td class="text-capitalize">{{$item->nama}}</td>
                    <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                    <td class="text-capitalize">
                        @if ($item->status == "lunas")
                            <span class="badge text-medium rounded text-light" style="background-color: #1DA599;">{{$item->status}}</span>
                        @else
                            <span class="badge text-medium rounded text-light" style="background-color: #b93f54;">{{$item->status}}</span>
                        @endif
                    </td>
                    <td>{{$item->no_telepon}}</td>
                    <td>Rp. {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                    <td>
                        <div class="d-flex gap-3">
                            <a class="text-dark btn-hover" title="Ubah" href="{{ route('edit_jamaah', ['id' => $program->id, 'idJamaah' => $item->id]) }}"><i class="bi bi-pencil fs-5"></i></a>
                            <form action="{{route('delete_jamaah', ['id'=> $program->id, 'idJamaah' => $item->id])}}" method="POST" onsubmit="if(!confirm('Mau hapus jamaah {{$item->nama}}')){return false;}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn-outline-none btn-hover border border-0 bg-transparent"><i class="bi bi-trash fs-5"></i></button>
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
        {{ $dataJamaah->appends(request()->except('page'))->links() }}
    </div>
    {{-- alert table --}}
    @if($dataJamaah->isEmpty())
        <div class="section_notFound container col-12">
            <h5 class="col-12 mb-4 text-center"><i class="bi "> </i>Tidak ada data !!</h5>
            <a href="{{route('create_jamaah', ['id' => $program->id])}}" class="btn  mb-2 text-dark d-flex align-items-center gap-2" style="border: 2px dashed silver"><i class="bi bi-plus-square-dotted  bg-transparent fs-5"></i> Tambah Jama'ah</a>
        </div>
    @endif
</div>
@endsection