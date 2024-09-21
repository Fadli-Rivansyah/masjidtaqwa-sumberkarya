@extends('admin.layouts.app')
@section('content')
<div class="container my-4">
    <x-alert />
    {{-- breadcrumbs --}}
    <div>{{ Breadcrumbs::render('view_zakat', $viewZakat->id)}}</div>
    <div class="row d-flex justify-content-between">
        <div class="col-md-6">
            <h2 class="h2 fw-bold fs-2 display-6 ">Zakat Fitra - {{$tanggal}}</h2>
            <button type="button" class="btn-hover text-dark btn border mb-2 text-light d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalKeteranganZakat" style="width: max-content;"><i class="bi bi-view-list fs-5"></i>
                Lihat Keterangan
            </button>
             <!-- Modal keterangan -->
            <div class="modal fade" id="modalKeteranganZakat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header  section_keterangan">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Keterangan & Syarat Berzakat</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{$viewZakat->keterangan}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- fitur search --}}
        <div class="col-md-5 col-lg-4">
             <form action="/admin/zakat/{{$viewZakat->id}}/view" method="get" class="col-sm-6 col-md-12 d-flex">
                 @csrf
                 <input class="form-control" type="text" placeholder="Cari.." value="{{request('search_muzakki')}}" name="search_muzakki">
                 <button type="submit" class="btn-search text-light mx-2 rounded px-3 py-1 border-0" style="background-color:#1DA599;"><i class="bi bi-search"></i></button>
             </form>
         </div>
    </div>
    {{-- card --}}
  <div class="row col-12 d-flex gap-2 mt-3 mx-auto">
     <x-box-summary :total="$totalUang">
        <x-slot name="icon">
            <i class="bi bi-currency-dollar float-end fs-3 mx-2 fw-bold"></i>
        </x-slot>
        Zakat (Uang)
        <x-slot name="total_true">Rp {{ number_format($totalUang, 2, ',', '.') }}</x-slot>
        <x-slot name="total_false">Rp 0</x-slot>
    </x-box-summary> 
    <x-box-summary :total="$totalBeras">
        <x-slot name="icon">
            <i class="bi bi-archive-fill float-end fs-3 mx-2 fw-bold"></i>
        </x-slot>
        Zakat (Beras)
        <x-slot name="total_true">{{ $totalBeras }}</x-slot>
        <x-slot name="total_false">0</x-slot>
    </x-box-summary>
    <x-box-summary :total="$totalMuzakki">
        <x-slot name="icon">
            <i class="bi bi-people-fill mx-2 fs-3 float-end"></i>
        </x-slot>
        Total Muzakki
        <x-slot name="total_true">{{ $totalMuzakki }}</x-slot>
        <x-slot name="total_false">0</x-slot>
    </x-box-summary>
    <x-box-summary :total="$totalMustahik">
        <x-slot name="icon">
            <i class="bi bi-people-fill mx-2 fs-3 float-end"></i>
        </x-slot>
        Total Mustahik
        <x-slot name="total_true">{{ $totalMustahik }}</x-slot>
        <x-slot name="total_false">0</x-slot>
    </x-box-summary>
</div>
{{-- daftar list --}}
<div class="row mt-4 d-flex justify-content-between my-3 align-items-center">
    <h4 class="h4 col-md-4 col-lg-3">Daftar Muzakki</h4>
    <div class="d-flex gap-3 d-none d-lg-flex col-lg-7 justify-content-end">
        <a href="/admin/zakat/{{$viewZakat->id}}/view" class="text-dark btn btn-hover border mb-2 text-light align-items-center d-flex fw-medium gap-2"><i class="bi bi-arrow-clockwise fs-5 mx-1 "></i> Refresh</a>
        <a href="/admin/zakat/{{$viewZakat->id}}/view/reportMuzakki" class="btn btn-hover border mb-2 fw-medium align-items-center d-flex gap-2"style="background-color: #FFC265;" ><i class="bi bi-printer  fs-5 mx-1"></i> Export</a>
        <a href="/admin/zakat/{{$viewZakat->id}}/view/salurZakat" class="btn border mb-2 fw-medium text-light align-items-center d-flex gap-2" style="background-color:#454545; width: max-content;"><i class="bi bi-people-fill fs-5 mx-1"></i> Salurkan Zakat</a>
        <a href="/admin/zakat/{{$viewZakat->id}}/view/createMuzakki" class="btn border mb-2 fw-medium text-light align-items-center d-flex gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-person-add fs-5 mx-1"></i> Buat Muzakki</a>
    </div>
    <div class="dropdown d-sm-block d-lg-none mt-2">
        <button class="btn border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </button>
        <div class="dropdown-menu p-3 gap-2 mt-3" style="width: 15em;">
            <a href="/admin/zakat/{{$viewZakat->id}}/view" class="text-dark btn btn-hover border mb-2 text-light align-items-center d-flex fw-medium gap-2"><i class="bi bi-arrow-clockwise fs-5 mx-1 "></i> Refresh</a>
            <a href="/admin/zakat/{{$viewZakat->id}}/view/reportMuzakki" class="btn btn-hover border mb-2 fw-medium align-items-center d-flex gap-2"style="background-color: #FFC265;" ><i class="bi bi-printer-fill  fs-5 mx-1"></i> Export</a>
            <a href="/admin/zakat/{{$viewZakat->id}}/view/salurZakat" class="btn border mb-2 text-light align-items-center d-flex gap-2" style="background-color:#454545; "><i class="bi bi-people-fill fs-5 mx-1"></i> Salurkan Zakat</a>
            <a href="/admin/zakat/{{$viewZakat->id}}/view/createMuzakki" class="btn border mb-2 text-light align-items-center d-flex gap-2" style="background-color:#1DA599; "><i class="bi bi-person-add fs-5 mx-1"></i> Buat Muzakki</a>
        </div>
    </div>
</div>
{{-- tabel --}}
  <div class="table  table-responsive-md my-3 ">
    <table class="table border berder-2 rounded">
        <thead>
            <tr>
                <td scope="col">Id</td>
                <td scope="col">Nama Muzakki</td>
                <td scope="col">No. Telepon</td>
                <td scope="col">Tanggal</td>
                <td scope="col">Jumlah Orang</td>
                <td scope="col">Kategori</td>
                <td scope="col">Jumlah</td>
                <td scope="col">Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataMuzakki as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td class="text-capitalize">{{$item->nama}}</td>
                <td>{{$item->no_telepon}}</td>
                <td class="text-capitalize">{{date('d F Y', strtotime($item->tanggal))}}</td>
                <td>{{$item->jumlah_orang}}</td>
                @if ($item->kategori == "uang")
                    <td>
                        <span class="badge text-capitalize text-medium rounded text-light" style="background-color: #447cc5;">{{$item->kategori}}</span>
                    </td>
                    <td>Rp {{number_format($item->jumlah, 2, ',', '.') }}</td>
                @else
                    <td>
                        <span class="badge text-capitalize text-medium rounded text-light" style="background-color:#1DA599;">{{$item->kategori}}</span>
                    </td>
                    <td>{{$item->jumlah}} Kg</td>       
                @endif
                <td class="col">
                    <div class="d-flex gap-3"> 
                        <a class="text-dark btn-hover" title="Ubah" href="/admin/zakat/{{$viewZakat->id}}/view/{{$item->id}}/edit"><i class="bi bi-pencil fs-5"></i></a>
                        <form action="/admin/zakat/{{$viewZakat->id}}/view/{{$item->id}}/delete" method="post" onsubmit="if(!confirm('yakin mau dihapus!')){return false;}">
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
        {{ $dataMuzakki->appends(request()->except('page'))->links() }}
    </div>
    {{-- alert table --}}
    @if($dataMuzakki->isEmpty())
        <div class="section_notFound container col-12">
            <h5 class="col-12 mb-4 text-center"><i class="bi "> </i>Tidak ada data !!</h5>
            <a href="/admin/zakat/{{$viewZakat->id}}/view/createMuzakki" class="btn  mb-2 text-dark d-flex align-items-center gap-2" style="border: 2px dashed silver"><i class="bi bi-plus-square-dotted  bg-transparent fs-5"></i> Buat Muzakki</a>
        </div>
    @endif
 </div>
@endsection