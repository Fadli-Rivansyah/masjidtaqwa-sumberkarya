@extends('admin.layouts.app')
@section('content')
<div class="container my-4">
    <x-alert />
    {{-- breadcrumbs --}}
    <div>{{ Breadcrumbs::render('zakat')}}</div>
    <div class="row d-flex justify-content-between col-md-12 ">
        <div class="col-sm-12 col-md-6">
            <h2 class="h2 fw-bold fs-2 display-6">Zakat Fitra</h2>
            <p class="col-md-12 col-lg-10">
                Setiap kontribusi, sekecil apapun, memiliki dampak besar dalam membantu mereka yang membutuhkan. Dengan berpartisipasi dalam zakat fitrah, kita menjadi bagian dari upaya besar untuk mengurangi kesenjangan sosial.
            </p>
        </div>
    </div>
    {{-- daftar list --}}
    <div class="row-2 gap-5 mt-4 col-md-12 d-flex justify-content-between align-items-center">
        <h4 class="h4 col-md-3">Daftar Program Zakat</h4>
        <div class="d-flex gap-3 d-none d-md-flex">
            <a href="{{route('zakat')}}" class="text-dark btn b btn-hover fw-medium btn-hover border mb-2 text-light d-flex align-items-center gap-2"><i class="bi bi-arrow-clockwise fs-5"></i> Refresh</a>
            @if($berlangsung < 1)
                <a href="{{route('create_zakat')}}" class="btn border mb-2 text-light d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5"></i> Buat Program Zakat</a>
            @else
                <button type="button" class="btn border mb-2 text-light fw-medium d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalPembatas" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5 "></i> Buat Program Zakat</button>
            @endif
            <!-- Modal keterangan -->
            <div class="modal fade" id="modalPembatas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header  section_keterangan">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">peringatan !!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <P class="fs-6">Tidak dapat menambahkan Program.</P>
                            <p class="fs-6">Dikarenakan program masih ada yang berstatus <strong>DIBUKA</strong>.</p>                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown d-sm-block d-md-none mt-2">
            <button class="btn border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
              </button>
            <div class="dropdown-menu p-3 col-sm-12 gap-2">
                <a href="{{route('zakat')}}" class="text-dark btn b btn-hover btn-hover border mb-2 text-light d-flex align-items-center gap-2"><i class="bi bi-arrow-clockwise fs-5"></i> Refresh</a>
                @if($berlangsung < 1)
                    <a href="{{route('create_zakat')}}" class="btn border mb-2 text-light d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5"></i> Buat Program Zakat</a>
                @else
                    <button type="button" class="btn border mb-2 text-light d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalPembatas" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5 "></i> Buat Program Zakat</button>
                @endif
                <!-- Modal keterangan -->
                <div class="modal fade" id="modalPembatas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header  section_keterangan">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">peringatan !!</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <P class="fs-6">Tidak dapat menambahkan Program.</P>
                                <p class="fs-6">Dikarenakan program masih ada yang berstatus <strong>DIBUKA</strong>.</p>                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- table --}}
   <div class="table  table-responsive-md my-4">
        <table class="table border border-1 rounded">
            <thead>
                <tr>
                    <td scope="col">Id</td>
                    <td scope="col">Tahun Ramadhan</td>
                    <td scope="col">Tanggal Pembukaan</td>
                    <td scope="col">Tanggal Penutupan</td>
                    <td scope="col">Status</td>
                    <td scope="col">Keterangan</td>
                    <td scope="col">Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataZakat as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->tahun_ramadhan}}</td>
                    <td>{{date('d F Y' ,strtotime($item->tanggal_pembukaan))}}</td>
                    <td>{{date('d F Y', strtotime($item->tanggal_penutupan))}}</td>
                    <td>
                        @if ($item->status == "dibuka")
                            <span class="badge text-capitalize rounded text-light" style="background-color: #1DA599;">{{$item->status}}</span>
                        @elseif($item->status == "selesai")
                            <span class="badge text-capitalize rounded text-light" style="background-color: #2087c2;">{{$item->status}}</span>
                        @else
                            <span class="badge text-capitalize  rounded text-light" style="background-color: #b93f54;">{{$item->status}}</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($item->keterangan, 10) }}</td>
                    <td>
                        <div class="d-flex gap-3">
                            <a class="text-dark btn-hover" title="Lihat" href="/admin/zakat/{{$item->id}}/view"><i class="bi bi-eye fs-5"></i></a>
                            <a class="text-dark btn-hover" title="Ubah" href="/admin/zakat/{{$item->id}}/edit"><i class="bi bi-pencil fs-5"></i></a>
                            <form action="/admin/zakat/{{$item->id}}/delete" method="post" onsubmit="if(!confirm('yakin mau dihapus!')){return false;}">
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
        {{ $dataZakat->appends(request()->except('page'))->links() }}
    </div>
    {{-- alert table --}}
    @if($dataZakat->isEmpty())
        <div class="section_notFound container col-12">
            <h5 class="col-12 mb-4 text-center"><i class="bi "> </i>Tidak ada data !!</h5>
            <a href="{{route('create_zakat')}}" class="btn  mb-2 text-dark d-flex align-items-center gap-2" style="border: 2px dashed silver"><i class="bi bi-plus-square-dotted  bg-transparent fs-5"></i> Buat Mustahik</a>
        </div>
    @endif
 </div>
@endsection
