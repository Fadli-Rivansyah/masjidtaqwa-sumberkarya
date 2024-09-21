@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column" >
        <div>{{ Breadcrumbs::render('create_jamaah', $data->id)}}</div>
        <h4 class="my-2 fw-semibold">Tambahkan Jama'ah</h4>
        {{-- form tamnbah jamaah --}}
        <form action="{{route('store_jamaah', ['id' => $data->id])}}" method="POST" class="my-1">
            @method('POST')
            @csrf
            <div class="mb-3">
                {{-- form nama jamaah --}}
                <label for="nama" class="form-label fw-semibold">Nama jama'ah</label>
                <input type="text" placeholder="Fulan" name="nama" value="{{old('nama')}}" class="form-control @error('nama') is-invalid @enderror" id="inputText" onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                {{-- alert jika error --}}
                @error('nama')
                    <div class="invalid-feedback">{{$message}}</div>   
               @enderror
            </div>
            <div class="mb-3 row col-12">
                {{-- form tanggal --}}
                <div class="col-md-6">
                    <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal"  value="{{now()->format('Y-m-d')}}" class="form-control @error('tanggal') is-invalid @enderror" id="inputText" value="{{old('tanggal')}}" onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                    {{-- alert, jika error --}}
                    @error('tanggal')
                        <div class="invalid-feedback">{{$message}}</div>   
                    @enderror
                </div>
                {{-- form status --}}
                <div class="col-md-6">
                    <label for="status" class="form-label fw-semibold">Status</label>
                    <select class="form-select col-md-12" name="status" value="{{old('status')}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                        <option value="lunas" selected>Lunas</option>
                        <option value="utang">Utang</option>
                      </select>
                    @error('status')
                    <div class="invalid-feedback">{{$message}}</div>   
                    @enderror
                </div>
            </div>
            {{-- form telepon --}}
            <div class="mb-3">
                <label for="telepon" class="form-label fw-semibold">No. Telepon</label>
                <input type="tel" placeholder="081234567890" name="telepon" value="{{old('telepon')}}" class="form-control @error('telepon') is-invalid @enderror" id="inputText" onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                {{-- alert, jika error --}}
                @error('telepon')
                    <div class="invalid-feedback">{{$message}}</div>   
               @enderror
            </div>
            {{-- form jumlah --}}
            <div class="mb-3">
                <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                <input type="text" placeholder="100.000" name="jumlah" value="{{old('jumlah')}}" class="form-control @error('jumlah') is-invalid @enderror" id="inputText" onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                {{-- alert, jika error --}}
                @error('jumlah')
                    <div class="invalid-feedback">{{$message}}</div>   
               @enderror
            </div>
            <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
        </form>
    </div>
    </div>
@endsection