@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column" >
        {{-- breadcrumbs --}}
        <div>{{ Breadcrumbs::render('create_muzakki', $viewId)}}</div>
        <h4 class="my-2 fw-semibold">Buat Muzakki</h4>
        <form action="/admin/zakat/{{$viewId}}/view" method="POST" class="my-1">
            @method('post')
            @csrf
            <div class="mb-3">
               <x-input type="text" name="nama_muzakki" id="nama_muzakki" placeholder="Fulan" :value="old('nama_muzakki')">Nama Muzakki</x-input>
            </div>
            <div class="mb-3">
               <x-input type="tel" name="telepon_muzakki" id="telepon_muzakki" placeholder="082342352362" :value="old('telepon_muzakki')">No. Telepon</x-input>
            </div>
            <div class="mb-3 row col-12">
                <div class="col-md-6">
                    <x-input type="date" name="tanggal_muzakki" id="tanggal_muzakki" placeholder="082342352362" :value="now()->format('Y-m-d')">Tanggal</x-input>
                </div>
                <div class="col-md-6">
                    <x-input type="number" name="jumlah_muzakki" id="jumlah_muzakki" placeholder="0" :value="old('jumlah_muzakki')">Jumlah Orang</x-input>
                </div>
            </div>
            <div class="mb-3 col-12">
                <label for="kategori_muzakki" class="form-label fw-semibold">Kategori</label>
                <select class="form-select col-md-12 @error('kategori_muzakki') is-invalid @enderror" name="kategori_muzakki" value="{{old('kategori_muzakki')}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                    <option value="beras">Beras</option>
                    <option value="uang">Uang</option>
                  </select>
                @error('kategori_muzakki')
                    <div class="invalid-feedback">{{$message}}</div>   
                @enderror
            </div>
            <div class="col-12 mb-3">
                <x-input type="number" name="jumlah_zakat" id="jumlah_zakat" placeholder="0" :value="old('jumlah_zakat')">Jumlah (Rp / Kg)</x-input>
            </div>
            <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
        </form>
    </div>
    </div>
@endsection