@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column" >
        {{-- breadcrumbs --}}
        <div>{{ Breadcrumbs::render('edit_muzakki', $idZakat, $dataMuzakki->id)}}</div>
        <h4 class="my-2 fw-semibold">Edit Muzakki</h4>

        <form action="/admin/zakat/{{$idZakat}}/view" method="POST" class="my-1">
            @method('patch')
            @csrf
            <div class="mb-3">
               <x-input type="text" name="nama_muzakki" id="nama_muzakki" placeholder="Fulan" :value="$dataMuzakki->nama">Nama Muzakki</x-input>
            </div>
            <div class="mb-3">
               <x-input type="tel" name="telepon_muzakki" id="telepon_muzakki" placeholder="082342352362" :value="$dataMuzakki->no_telepon">No. Telepon</x-input>
            </div>
            <div class="mb-3 row col-12">
                <div class="col-md-6">
                    <x-input type="date" name="tanggal_muzakki" id="tanggal_muzakki" placeholder="082342352362" :value="$dataMuzakki->tanggal">Tanggal</x-input>
                </div>
                <div class="col-md-6">
                    <x-input type="number" name="jumlah_muzakki" id="jumlah_muzakki" placeholder="0" :value="$dataMuzakki->jumlah_orang">Jumlah Orang</x-input>
                </div>
            </div>
            <div class="mb-3 col-12">
                <label for="kategori_muzakki" class="form-label fw-semibold">Kategori</label>
                <select class="form-select col-md-12 @error('kategori_muzakki') is-invalid @enderror" name="kategori_muzakki" value="{{$dataMuzakki->kategori}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                    <option value="beras" @if($dataMuzakki->kategori == 'beras') selected @endif >Beras</option>
                    <option value="uang" @if($dataMuzakki->kategori == 'uang') selected @endif >Uang</option>
                  </select>
                @error('kategori_muzakki')
                    <div class="invalid-feedback">{{$message}}</div>   
                @enderror
            </div>
            <div class="mb-3 col-12">
                <x-input type="number" name="jumlah_zakat" id="jumlah_zakat" placeholder="0" :value="$dataMuzakki->jumlah">Jumlah (Rp / Kg)</x-input>
            </div>
            <input type="hidden" name="idMuzakki" value="{{$dataMuzakki->id}}">
            <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
        </form>
    </div>
    </div>
@endsection