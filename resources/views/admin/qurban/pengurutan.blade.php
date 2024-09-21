@extends('admin.layouts.app')
@section('content')
<div class="container my-4">
    <x-alert />
    {{-- breadcrumbs --}}
    <div>{{ Breadcrumbs::render('pengurutan_qurban', $idQurban)}}</div>
   {{-- daftar list --}}
   <div class="row mt-4 d-flex col-12 justify-content-between">
        <h4 class="h4 col-12 col-md-6">Urutan Penyembelihan</h4>
        <div class="gap-3 d-none d-md-flex col-md-6 justify-content-end p-0">
            <a href="{{route('report_pengurutan', ['id' => $idQurban])}}" class="text-dark fw-medium btn-hover btn border mb-2 text-light d-flex align-items-center gap-2" style="background-color: #FFC265;"><i class="bi bi-printer fs-5"></i> Export</a>
            <a href="/admin/qurban/{{$idQurban}}/viewQurban/createShohibul" class="btn border mb-2 text-light fw-medium d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5"></i> Buat Shohibul Qurban</a>
        </div>
        <div class="dropdown d-sm-block d-md-none ">
            <button class=" border btn-hover rounded px-3 bg-transparent py-1 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
            </button>
            <div class="dropdown-menu p-3 ">
                <a href="/admin/qurban/{{$idQurban}}/viewQurban/pengurutan/reportQurban" class="text-dark btn-hover btn fw-medium border mb-2 text-light d-flex align-items-center gap-2"><i class="bi bi-printer fs-5"></i> Export</a>
                <a href="/admin/qurban/{{$idQurban}}/viewQurban/createShohibul" class="btn border mb-2 text-light d-flex fw-medium align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5"></i> Buat Shohibul Qurban</a>
            </div>
        </div>
    </div>
    <div class="my-4 mt-3">
        <div>
            <h5>Patungan (Lembu)</h5>
            <div class="table table-responsive-md my-4 d-flex flex-wrap gap-4 col-md-4 ">
                @if($patunganLembu->isEmpty())
                    <div class="section_notFound  col-12">
                        <h5 class="col-12 mb-4 text-center"><i class="bi "> </i>Tidak ada data !!</h5>
                    </div>
                @else
                    @foreach($patunganLembu as $group)
                        <table class="table border border-1 rounded col-md-4" style="width: 20em;">
                            <thead>
                                <tr>
                                    <td scope="col">Nomor Urut {{ $loop->iteration }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($group as $item)
                                <tr>
                                    <td class="text-capitalize">{{ $item->nama }}</td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                @endif
            </div>
        </div>
        <div>
            <h5>Mandiri (Lembu)</h5>
            <div class="table  table-responsive-md my-4  d-flex flex-wrap gap-4 col-md-12">
                @if($mandiriLembu->isEmpty()) 
                    <div class="section_notFound  col-12">
                        <h5 class="col-12 mb-4 text-center"><i class="bi "> </i>Tidak ada data !!</h5>
                    </div>
                @else
                    @foreach($mandiriLembu as $item)
                            <table class="table border border-1 rounded" style="width: 20em;">
                                <thead>
                                    <tr>
                                        <td scope="col">Nomor Urut {{ $loop->iteration }}</td>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <td class="text-capitalize">{{ $item->nama }}</td> 
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                @endif
            </div>
        </div>
        <div>
            <h5>Mandiri (Kambing)</h5>
            <div class="table  table-responsive-md my-4  d-flex flex-wrap gap-4">
                @if($mandiriKambing->isEmpty())
                    <div class="section_notFound  col-12">
                        <h5 class="col-12 mb-4 text-center"><i class="bi "> </i>Tidak ada data !!</h5>
                    </div>
                @else
                    @foreach($mandiriKambing as $item)
                        <table class="table border border-1 rounded " style="width: 20em;">
                            <thead>
                                <tr>
                                    <td scope="col">Nomor Urut {{ $loop->iteration }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-capitalize">{{ $item->nama }}</td> 
                                </tr>
                            </tbody>
                        </table>
                    @endforeach 
                @endif    
            </div>
        </div>
    </div>
 </div>
@endsection