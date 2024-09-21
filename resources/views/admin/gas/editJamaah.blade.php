@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column" >
        <div>{{ Breadcrumbs::render('edit_jamaah', $program->id, $data->id)}}</div>
        <h4 class="my-2 fw-semibold">Edit Jama'ah</h4>
        {{-- form tamnbah jamaah --}}
        <form action="{{route('update_jamaah', ['id' => $program->id])}}" method="POST" class="my-1">
            @method('patch')
            @csrf
            <div class="mb-3">
                {{-- form nama jamaah --}}
                <label for="nama" class="form-label fw-semibold">Nama jama'ah</label>
                <input type="text" placeholder="Fulan" required name="nama" value="{{$data->nama}}" class="form-control @error('nama') is-invalid @enderror" id="inputText" onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                {{-- alert jika error --}}
                @error('nama')
                    <div class="invalid-feedback">{{$message}}</div>   
               @enderror
            </div>
            <div class="mb-3 row col-12 ">
                {{-- form tanggal --}}
                <div class="col-md-6 ">
                    <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                    <input type="date"name="tanggal"  value="{{$data->tanggal}}" class="form-control @error('tanggal') is-invalid @enderror" id="inputText" value="{{old('tanggal')}}" onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'" required>
                    {{-- alert, jika error --}}
                    @error('tanggal')
                        <div class="invalid-feedback">{{$message}}</div>   
                    @enderror
                </div>
                {{-- form status --}}
                <div class="col-md-6">
                    <label for="status" class="form-label fw-semibold">Status</label>
                    <select class="form-select col-md-12" name="status" value="{{$data->status}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                        <option value="lunas" @if($data->status == 'lunas') selected @endif>Lunas</option>
                        <option value="utang" @if($data->status == 'utang') selected @endif>Utang</option>
                      </select>
                    @error('status')
                    <div class="invalid-feedback">{{$message}}</div>   
                    @enderror
                </div>
            </div>
            {{-- form telepon --}}
            <div class="mb-3">
                <label for="telepon" class="form-label fw-semibold">No. Telepon</label>
                <input type="tel" placeholder="081234567890" required name="telepon" value="{{$data->no_telepon}}" class="form-control @error('telepon') is-invalid @enderror" id="inputText" onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                {{-- alert, jika error --}}
                @error('telepon')
                    <div class="invalid-feedback">{{$message}}</div>   
               @enderror
            </div>
            {{-- form jumlah --}}
            <div class="mb-3">
                <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                <input type="number" placeholder="100000" name="jumlah" required value="{{$data->jumlah}}" class="form-control @error('jumlah') is-invalid @enderror" id="inputText" onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                {{-- alert, jika error --}}
                @error('jumlah')
                    <div class="invalid-feedback">{{$message}}</div>   
               @enderror
            </div>
            <input type="hidden" name="id" value="{{$data->id}}">
            <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
        </form>
    </div>
    </div>
@endsection