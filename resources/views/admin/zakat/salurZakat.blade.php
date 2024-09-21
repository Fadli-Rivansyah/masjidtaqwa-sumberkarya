@extends('admin.layouts.app')
@section('content')
<div class="container my-4">
    <x-alert />
    {{-- breadcrumbs --}}
    <div>{{ Breadcrumbs::render('salur_zakat', $idZakat)}}</div>
    <div class="row d-flex justify-content-between">
        <h2 class="h2 fw-bold fs-2 display-6 col-md-6">Salur Zakat - {{$tanggal}}</h2>
        {{-- fitur search --}}
        <div class="col-md-6 col-lg-4">
             <form action="/admin/zakat/{{$idZakat}}/view/salurZakat" method="get" class="col-sm-6 col-md-12 d-flex">
                @method('get') 
                @csrf
                 <input class="form-control" type="text" placeholder="Cari.." value="{{old('search_mustahik')}}" name="search_mustahik">
                 <button type="submit" class="text-light btn-search mx-2 rounded px-3 py-1 border-0" style="background-color:#1DA599"><i class="bi bi-search"></i></button>
             </form>
         </div>
    </div>
    {{-- card --}}
  <div class="row col-12 d-flex gap-3 mx-auto">
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
<div class="row-2 gap-5 mt-4 col-md-12 d-flex justify-content-between align-items-center">
    <h4 class="h4 col-md-4">Daftar Mustahik</h4>
    <div class="d-flex gap-3 d-none d-md-flex">
        <a href="/admin/zakat/{{$idZakat}}/view/salurZakat" class="text-dark btn btn-hover border mb-2 text-light fw-medium d-flex gap-2 align-items-center"><i class="bi bi-arrow-clockwise fs-5 "></i> Refresh</a>
        <a href="/admin/zakat/{{$idZakat}}/view/salurZakat/reportMustahik" class="btn  btn-hover btn-hover border mb-2  fw-medium d-flex gap-2 align-items-center" style="background-color: #FFC265;"><i class="bi bi-printer  fs-5"></i> Export</a>
        <a href="/admin/zakat/{{$idZakat}}/view/salurZakat/createMustahik" class="btn border mb-2 text-light fw-medium d-flex gap-2 align-items-center" style="background-color: #1DA599; width: max-content;"><i class="bi bi-person-add fs-5"></i>  Buat Mustahik</a>
    </div>
    <div class="dropdown d-sm-block d-md-none mt-2">
        <button class="btn border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </button>
        <div class="dropdown-menu p-3 gap-2 mt-3" style="width: 15em;">
            <a href="/admin/zakat/{{$idZakat}}/view/salurZakat" class="text-dark btn btn-hover border mb-2 text-light fw-medium d-flex gap-2 align-items-center"><i class="bi bi-arrow-clockwise fs-5 "></i> Refresh</a>
            <a href="/admin/zakat/{{$idZakat}}/view/salurZakat/reportMustahik" class="btn  btn-hover btn-hover border mb-2  fw-medium d-flex gap-2 align-items-center" style="background-color: #FFC265;"><i class="bi bi-printer  fs-5"></i> Export</a>
            <a href="/admin/zakat/{{$idZakat}}/view/salurZakat/createMustahik" class="btn border mb-2 text-light fw-medium d-flex gap-2 align-items-center" style="background-color: #1DA599;"><i class="bi bi-person-add fs-5"></i>  Buat Mustahik</a>    
        </div>
    </div>
</div>
  <div class="table table-responsive-md my-3">
    <table class="table border border-1 rounded" >
        <thead>
            <tr>
                <td scope="col">Id</td>
                <td scope="col">Nama Mustahik</td>
                <td scope="col">No. Telepon</td>
                <td scope="col">Jenis Asnaf</td>
                <td scope="col">Alamat</td>
                <td scope="col">Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataMustahik as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td class="text-capitalize">{{$item->nama}}</td>
                <td class="text-capitalize">{{$item->no_telepon}}</td>
                <td class="text-capitalize">{{$item->jenis_asnaf}}</td>
                <td class="text-capitalize">{{ $item->alamat}}</td>
                <td class="col-2">
                    <div class="d-flex gap-2">
                        <a class="text-dark btn-hover" title="Ubah" href="/admin/zakat/{{$idZakat}}/view/salurZakat/{{$item->id}}/edit"><i class="bi bi-pencil fs-5"></i></a>
                        <form action="/admin/zakat/{{$idZakat}}/view/salurZakat/{{$item->id}}/delete" method="post" onsubmit="if(!confirm('yakin mau dihapus!')){return false;}">
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
        {{ $dataMustahik->appends(request()->except('page'))->links() }}
    </div>
    {{-- alert table --}}
    @if($dataMustahik->isEmpty())
        <div class="section_notFound container col-12">
            <h5 class="col-12 mb-4 text-center"><i class="bi "> </i>Tidak ada data !!</h5>
            <a href="/admin/zakat/{{$idZakat}}/view/salurZakat/createMustahik" class="btn  mb-2 text-dark d-flex align-items-center gap-2" style="border: 2px dashed silver"><i class="bi bi-plus-square-dotted  bg-transparent fs-5"></i> Buat Mustahik</a>
        </div>
    @endif
 </div>
@endsection