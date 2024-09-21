@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column" >
        {{-- breadcrumbs --}}
        <div>{{ Breadcrumbs::render('create_mustahik', $idZakat)}}</div>
        <h4 class="my-2 fw-semibold">Buat Mustahik</h4>
            <form action="/admin/zakat/{{$idZakat}}/view/salurZakat" method="POST" class="my-1">
                @method('post')
                @csrf
                <div class="mb-3">
                    <x-input type="text" name="nama_mustahik" id="nama_mustahik" placeholder="Fulan" :value="old('nama_mustahik')">Nama Mustahik</x-input>
                </div>
                <div class="mb-3 row col-12">
                    <div class="col-md-6">
                        <x-input type="date" name="tanggal_mustahik" id="tanggal_mustahik" placeholder="" :value="now()->format('Y-m-d')">Nama Mustahik</x-input>
                    </div>
                    <div class="col-md-6">
                        <x-input type="tel" name="telepon_mustahik" id="telepon_mustahik" placeholder="08234236233" :value="old('telepon_mustahik')">No. Telepon</x-input>
                    </div>
                </div>
                <div class="mb-3 col-12">
                    <label for="jenis_asnaf" class="form-label fw-semibold">Jenis Asnaf</label>
                    <select class="form-select col-md-12 @error('jenis_asnaf') is-invalid @enderror" name="jenis_asnaf" value="{{old('jenis_asnaf')}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                        <option value="fakir">Fakir</option>
                        <option value="miskin">Miskin</option>
                      </select>
                    @error('jenis_asnaf')
                        <div class="invalid-feedback">{{$message}}</div>   
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <x-input type="text" name="alamat_mustahik" id="alamat_mustahik" placeholder="Jl. LurusLempeng" :value="old('alamat_mustahik')">Alamat</x-input>
                </div>
                <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
            </form>
        </div>
    </div>
@endsection