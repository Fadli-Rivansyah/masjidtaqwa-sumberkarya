@extends('admin.layouts.app')
@section('content')
<div class="container my-4">
    <x-alert />
    <div>{{ Breadcrumbs::render('view_qurban', $idQurban)}}</div>
    <div class="row d-flex justify-content-between col-sm-12 ">
        <div class="col-md-6">
            <h2 class="h2 fw-bold fs-2 display-6 ">Qurban - {{$qurban->tahun_qurban}}</h2>
            <!-- Button trigger modal -->
            <div>
                <button type="button" class="btn-hover text-dark btn border mb-2 text-light d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalKeteranganQurban" style="width: max-content;"><i class="bi bi-view-list fs-5"></i>
                    Lihat Keterangan
                </button>
            </div>
        </div>
        {{-- fitur search --}}
        <div class="col-md-5">
            <form action="/admin/qurban/{{$idQurban}}/viewQurban" method="get" class="col-sm-6 col-md-12 d-flex">
               @method('get') 
               @csrf
                <input class="form-control" type="text" placeholder="Cari.." value="{{request('search_shohibul')}}" name="search_shohibul">
                <button type="submit" class="btn-search mx-2 rounded px-3 py-1 border-0 text-light" style="background-color: #1DA599;" ><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
    <!-- Modal keterangan -->
        <div class="modal fade" id="modalKeteranganQurban" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header  section_keterangan">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Keterangan & Syarat Berqurban</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{$qurban->keterangan}}</p>
                    </div>
                </div>
            </div>
        </div>
    {{-- card --}}
    <div class="row col-12 d-flex gap-2 mx-auto mt-4">
         {{-- jumlah dana --}}
         <x-box-summary :total="$jumlahDana">
            <x-slot name="icon">
                <i class="bi bi-clipboard-check-fill float-end fs-3 mx-2 fw-bold"></i>
            </x-slot>
            Total Dana
            <x-slot name="total_true">Rp {{  number_format($jumlahDana, 2, ',', '.') }}</x-slot>
            <x-slot name="total_false">Rp 0</x-slot>
        </x-box-summary>
        {{-- total lembu --}}
        <x-box-summary :total="$totalLembu">
            <x-slot name="icon">
                <i class="bi bi-check-circle-fill mx-2 fs-3 float-end"></i>
            </x-slot>
            Qurban Lembu
            <x-slot name="total_true">{{ $totalLembu }}</x-slot>
            <x-slot name="total_false">0</x-slot>
        </x-box-summary>
        {{-- total kambing --}}
        <x-box-summary :total="$totalKambing">
            <x-slot name="icon">
                <i class="bi bi-check-circle-fill float-end fs-3 mx-2 fw-bold"></i>
            </x-slot>
            Qurban Kambing
            <x-slot name="total_true">{{ $totalKambing }}</x-slot>
            <x-slot name="total_false">0</x-slot>
        </x-box-summary>
        {{-- shohibul qurban --}}
        <x-box-summary :total="$totalShohibul">
            <x-slot name="icon">
                <i class="bi bi-people-fill mx-2 fs-3 float-end"></i>
            </x-slot>
            Shohibul Qurban
            <x-slot name="total_true">{{ $totalShohibul }}</x-slot>
            <x-slot name="total_false">0</x-slot>
        </x-box-summary>        
    </div>
   {{-- daftar list --}}
   <div class="mt-4 d-flex justify-content-between align-items-center">
       <div class="d-flex col-sm-2 col-md-6  col-lg-3 row">
            <h5 class="fs-5">Daftar Shohibul Qurban</h5>
      </div>
      <div class="d-flex gap-3 d-none d-lg-flex justify-content-end">
          <a href="/admin/qurban/{{$idQurban}}/viewQurban" class="btn-hover text-dark fw-medium btn border mb-2 text-light d-flex align-items-center gap-2"><i class="bi bi-arrow-clockwise fs-5"></i> Refresh</a>
          <a href="/admin/qurban/{{$idQurban}}/viewQurban/pengurutan" class="btn-hover fw-medium text-dark btn border mb-2 text-light d-flex align-items-center gap-2"><i class="bi bi-list-check fs-5"></i> Pengurutan</a>
          <a href="/admin/qurban/{{$idQurban}}/viewQurban/createShohibul" class="btn border fw-medium mb-2 text-light d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-person-add fs-5"></i> Buat Shohibul Qurban</a>
      </div>
      <div class="dropdown d-sm-block d-md-block d-lg-none col-sm-2">
            <button class=" border btn-hover rounded px-3 bg-transparent py-1 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
            </button>
            <div class="dropdown-menu p-3 ">
                <a href="/admin/qurban/{{$idQurban}}/viewQurban" class="btn-hover text-dark fw-medium btn border mb-2 text-light d-flex align-items-center gap-2"><i class="bi bi-arrow-clockwise fs-5"></i> Refresh</a>
                <a href="/admin/qurban/{{$idQurban}}/viewQurban/pengurutan" class="btn-hover fw-medium text-dark btn border mb-2 text-light d-flex align-items-center gap-2"><i class="bi bi-list-check fs-5"></i> Pengurutan</a>
                <a href="/admin/qurban/{{$idQurban}}/viewQurban/createShohibul" class="btn border fw-medium mb-2 text-light d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5"></i> Buat Shohibul Qurban</a>
            </div>
        </div>
   </div>
    {{-- table --}}
    <div class="table  table-responsive-md my-4">
        <table class="table border border-1 rounded">
            <thead>
                <tr>
                    <td scope="col">Id</td>
                    <td scope="col">Nama</td>
                    <td scope="col">No. Telepon</td>
                    <td scope="col">Metode Qurban</td>
                    <td scope="col">Jenis Hewan</td>
                    <td scope="col">Jumlah</td>
                    <td scope="col">Alamat</td>
                    <td scope="col">Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataShohibul as $item) 
                <tr>
                    <td>{{$item->id}}</td>
                    <td class="text-capitalize">{{$item->nama}}</td>
                    <td>{{$item->no_telepon}}</td>
                    <td>
                        @if ($item->metode_qurban== "mandiri")
                            <span class="badge text-capitalize rounded text-light" style="background-color: #1DA599;">{{$item->metode_qurban}}</span>
                        @elseif($item->metode_qurban == "patungan")
                            <span class="badge text-capitalize rounded text-dark" style="background-color: #FFC265;">{{$item->metode_qurban}}</span>
                        @endif
                    </td>
                    <td class="text-capitalize">{{$item->jenis_hewan}}</td>
                    <td class="text-capitalize">Rp {{number_format($item->jumlah, 2, ',', '.') }}</td>
                    <td>{{ Str::limit($item->alamat, 15) }}</td>
                    <td>
                        <div class="d-flex gap-3">
                            <a class="text-dark btn-hover" title="Ubah" href="/admin/qurban/{{$idQurban}}/viewQurban/{{$item->id}}/edit"><i class="bi bi-pencil fs-5"></i></a>
                            <form action="/admin/qurban/{{$idQurban}}/viewQurban/{{$item->id}}/delete" method="post" onsubmit="if(!confirm('yakin mau dihapus!')){return false;}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn-hover btn-outline-none border border-0 bg-transparent"><i class="bi bi-trash fs-5"></i></button>
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
        {{ $dataShohibul->appends(request()->except('page'))->links() }}
    </div>
    {{-- alert table --}}
    @if($dataShohibul->isEmpty())
        <div class="section_notFound container col-12">
            <h5 class="col-12 mb-4 text-center"><i class="bi "> </i>Tidak ada data !!</h5>
            <a href="/admin/qurban/{{$idQurban}}/viewQurban/createShohibul" class="btn  mb-2 text-dark d-flex align-items-center gap-2" style="border: 2px dashed silver"><i class="bi bi-plus-square-dotted  bg-transparent fs-5"></i> Buat Shohibul</a>
        </div>
    @endif
</div>
@endsection