@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column">
        <div>{{ Breadcrumbs::render('edit_program', $data->id)}}</div>
        <h4 class="my-2 fw-semibold">Edit Program</h4>
        <form action="{{route('store_program')}}" method="POST" class="my-1">
            @method('patch')
            @csrf
            <div class="mb-3">
               <x-input type="text" name="nama_program" id="nama_program" placeholder="Pembangunan" :value="$data->nama_program"> Nama Program </x-input>
            </div>
            <div class="mb-3 row col-12">
                <div class=" col-md-6">
                    <x-input type="date" name="tanggal_program" id="tanggal_program" placeholder="" :value="$data->tanggal"> Tanggal </x-input>
                </div>
                <div class="col-md-6">
                    <x-input type="number" name="biaya_program" id="biaya_program" placeholder="1000000" :value="$data->biaya">Biaya</x-input>
                </div>
            </div>
            <div class="mb-3 row col-12">
                <div class="col-md-6">
                    <label for="kategori_program" class="form-label fw-semibold">Kategori</label>
                    <select class="form-select col-md-12 @error('kategori_program') is-invalid @enderror" name="kategori_program" value="{{$data->kategori}}" onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                        <option value="pembangunan masjid"  @if($data->kategori == 'pembangunan masjid') selected @endif>Pembangunan Masjid</option>
                        <option value="Kemanusiaan" @if($data->kategori == 'kemanusiaan') selected @endif>Kemanusiaan</option>
                      </select>
                    @error('kategori_program')
                        <div class="invalid-feedback">{{$message}}</div>   
                    @enderror
                </div>
                <div class="col-md-6">
                    <x-input type="date" name="target_program" id="target_program" placeholder="" :value="$data->target">Target Selesai</x-input>
                </div>
            </div>
            {{-- form keterangan --}}
            <div class="mb-3">
                <label for="keterangan_program" class="form-label fw-semibold">Keterangan</label>
                <textarea class="form-control  @error('keterangan_program') is-invalid @enderror" name="keterangan_program" placeholder="ceritakan disini.." id="keterangan_program" style="height: 100px">{{$data->keterangan_program}}</textarea>
                @error('keterangan_program')
                    <div class="invalid-feedback">{{$message}}</div>   
                @enderror
            </div>
            <input type="hidden" name="id" value="{{$data->id}}">
            <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
        </form>
    </div>
    </div>
@endsection