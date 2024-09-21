@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column" >
        <x-alert />
        <div>{{ Breadcrumbs::render('create_mustahik', $idZakat)}}</div>
        <h4 class="my-2 fw-semibold">Buat Mustahik</h4>
        <form action="/admin/zakat/{{$idZakat}}/view/salurZakat" method="POST" class="my-1">
            @method('patch')
            @csrf
            <div class="mb-3">
                <x-input type="text" name="nama_mustahik" id="nama_mustahik" placeholder="Fulan" :value="$dataMustahik->nama">Nama Mustahik</x-input>
            </div>
            <div class="mb-3 row col-12">
                <div class="col-md-6">
                    <x-input type="date" name="tanggal_mustahik" id="tanggal_mustahik" placeholder="" :value="$dataMustahik->tanggal">Tanggal Mustahik</x-input>
                </div>
                <div class="col-md-6">
                    <x-input type="tel" name="telepon_mustahik" id="telepon_mustahik" placeholder="08234236233" :value="$dataMustahik->no_telepon">No. Telepon</x-input>
                </div>
            </div>
            <div class="mb-3 col-12">
                <label for="editJenis_asnaf" class="form-label fw-semibold">Jenis Asnaf</label>
                <select class="form-select col-md-12 @error('editJenis_asnaf') is-invalid @enderror" name="jenis_asnaf" value="{{$dataMustahik->jenis_asnaf}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                    <option value="fakir" @if($dataMustahik->jenis_asnaf == 'fakir') selected @endif>Fakir</option>
                    <option value="miskin" @if($dataMustahik->jenis_asnaf == 'miskin') selected @endif>Miskin</option>
                  </select>
                @error('jenis_asnaf')
                    <div class="invalid-feedback">{{$message}}</div>   
                @enderror
            </div>
            <div class="col-12 mb-3">
                <x-input type="text" name="alamat_mustahik" id="alamat_mustahik" placeholder="Jl. luruslempeng" :value="$dataMustahik->alamat">Alamat</x-input>
            </div>
            <input type="hidden" name="idMustahik" value="{{$dataMustahik->id}}">
            <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
        </form>
    </div>
    </div>
@endsection