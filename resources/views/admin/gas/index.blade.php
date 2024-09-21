@extends('admin.layouts.app')
@section('content')
<div class="container my-4">
    <x-alert />
    {{-- breadcrumbs --}}
    <div>{{ Breadcrumbs::render('GAS')}}</div>
    <div class="row d-flex justify-content-between col-md-12 ">
        <div class="col-sm-12 col-md-6">
            <h2 class="h2 fw-bold fs-2 display-6">GAS (Gerakan Amal Sholeh)</h2>
            <p>Setiap orang memiliki peran penting dalam gerakan amal sholeh. Tidak peduli seberapa kecil tindakan kita, setiap langkah kebaikan memiliki dampak yang besar dalam membangun dunia yang lebih baik.</p>
        </div>
        {{-- fitur search --}}
        <div class="col-md-5 col-xl-4">
             <form action="{{route('gas')}}" method="get" class="col-sm-6 col-md-12 d-flex">
                 @csrf
                 <input class="form-control" type="text" placeholder="Cari.." value="{{request('search_program')}}" name="search_program"  >
                 <button type="submit" class="btn-search mx-2 rounded px-3 py-1 border-0 text-light" style="background-color: #1DA599"><i class="bi bi-search"></i></button>
             </form>
         </div>
    </div>
    {{-- card --}}
  <div class="row col-12 d-flex gap-2 mx-auto mt-3">
    <x-box-summary :total="$totalBerlangsung">
        <x-slot name="icon">
            <i class="bi bi-clock-fill float-end fs-3 mx-2 fw-bold"></i>
        </x-slot>
        Sedang Berlangsung
        <x-slot name="total_true">{{ $totalBerlangsung }}</x-slot>
        <x-slot name="total_false">0</x-slot>
    </x-box-summary>
    <x-box-summary :total="$totalSelesai">
        <x-slot name="icon">
            <i class="bi bi-check2-circle float-end fs-3 mx-2 fw-bold"></i>
        </x-slot>
        Program (Selsesai)
        <x-slot name="total_true">{{ $totalSelesai }}</x-slot>
        <x-slot name="total_false">0</x-slot>
    </x-box-summary>
    <x-box-summary :total="$totalProgram">
        <x-slot name="icon">
            <i class="bi bi-collection-fill mx-2 fs-3 float-end"></i>
        </x-slot>
        Jumlah Program
        <x-slot name="total_true">{{ $totalProgram }}</x-slot>
        <x-slot name="total_false">0</x-slot>
    </x-box-summary>
   {{-- daftar list --}}
   <div class="row-2 gap-5 mt-4 col-md-12 d-flex justify-content-between align-items-center">
        <h4 class="h4 col-md-4">Daftar Program GAS</h4>
        <div class="d-flex gap-3 d-none d-md-flex">
            <a href="{{route('gas')}}" class="btn-hover fw-medium text-dark btn border mb-2 text-light d-flex align-items-center gap-2"><i class="bi bi-arrow-clockwise fs-5"></i> Refresh</a>
            @if($totalBerlangsung < 1)
                <a href="{{route('create_program')}}" class="btn fw-medium border mb-2 text-light d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5 "></i> Buat Program</a>
            @else
                <button type="button" class="btn border fw-medium mb-2 text-light d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalPembatas" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5 "></i> Buat Program</button>
            @endif
        </div>
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
                         <p class="fs-6">Dikarenakan program masih ada yang belum <strong>SELESAI</strong>.</p>                   
                     </div>
                 </div>
             </div>
         </div>
        <div class="dropdown d-sm-block d-md-none mt-2">
            <button class="btn border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
              </button>
            <div class="dropdown-menu p-3 col-sm-12 gap-2">
                <a href="{{route('gas')}}" class="btn-hover text-dark btn fw-medium border mb-2 text-light d-flex align-items-center gap-2"><i class="bi bi-arrow-clockwise fs-5"></i> Refresh</a>
                @if($totalBerlangsung < 1)
                    <a href="{{route('create_program')}}" class="btn fw-medium border mb-2 text-light d-flex align-items-center gap-2" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5 "></i> Buat Program</a>
                @else
                    <button type="button" class="btn fw-medium border mb-2 text-light d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalPembatas" style="background-color:#1DA599; width: max-content;"><i class="bi bi-plus fs-5 "></i> Buat Program</button>
                @endif
            </div>
        </div>
    </div>
  </div>
  <div class="table table-responsive-md my-3">
    <table class="table border border-1 rounded ">
        <thead>
            <tr>
                <td scope="col">Id</td>
                <td scope="col">Nama Program</td>
                <td scope="col">Tanggal</td>
                <td scope="col">Kategori</td>
                <td scope="col">Biaya</td>
                <td scope="col">Target</td>
                <td scope="col">Status</td>
                <td scope="col">Keterangan</td>
                <td scope="col">Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataProgram as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td class="text-capitalize">{{ Str::limit($item->nama_program, 10) }}</td>
                <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                <td class="text-capitalize">{{$item->kategori}}</td>
                <td>Rp. {{ number_format($item->biaya, 2, ',', '.') }}</td>
                <td>{{date('d F Y', strtotime($item->target))}}</td>
                <td class="text-capitalize">
                    @if ($item->status == "selesai")
                        <span class="badge text-medium rounded text-light" style="background-color: #1DA599;">{{$item->status}}</span>
                    @else
                        <span class="badge text-medium rounded text-light" style="background-color: #b93f54;">{{$item->status}}</span>
                    @endif
                </td>
                <td>{{ Str::limit($item->keterangan_program, 10) }}</td>
                <td>
                    <div class="d-flex gap-3">
                        <a class="text-dark btn-hover" title="Lihat" href="{{route('view_program', ['id' => $item->id])}}"><i class="bi bi-eye fs-5"></i></a>
                        <a class="text-dark btn-hover" title="Ubah" href="{{route('edit_program', ['id' => $item->id])}}"><i class="bi bi-pencil fs-5"></i></a>
                        <form action="{{route('delete_program', ['id' => $item->id])}}" method="post" onsubmit="if(!confirm('Mau hapus Program {{$item->nama_program}}')){return false;}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn-outline-none border border-0 bg-transparent btn-hover"title="Delete"><i class="bi bi-trash fs-5"></i></button>
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
        {{ $dataProgram->appends(request()->except('page'))->links() }}
    </div>
    {{-- alert table --}}
    @if($dataProgram->isEmpty())
        <div class="section_notFound container col-12">
            <h5 class="col-12 mb-4 text-center"><i class="bi "> </i>Tidak ada data !!</h5>
            <a href="{{route('create_program')}}" class="btn  mb-2 text-dark d-flex align-items-center gap-2" style="border: 2px dashed silver"><i class="bi bi-plus-square-dotted  bg-transparent fs-5"></i> Buat Program</a>
        </div>
    @endif
 </div>
@endsection