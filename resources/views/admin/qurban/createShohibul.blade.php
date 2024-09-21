@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column" >
        {{-- breadcrumbs --}}
    <div>{{ Breadcrumbs::render('create_shohibul', $idQurban)}}</div>
        <h4 class="my-2 fw-semibold">Buat Shohibul Qurban</h4>
        <form action="/admin/qurban/{{$idQurban}}/viewQurban" method="POST" class="my-1">
            @method('POST')
            @csrf
            <div class="mb-3">
               <x-input type="text" name="nama_shohibul" id="nama_shohibul" placeholder="Fulan" :value="old('nama_shohibul')">Nama Shohibul Qurban</x-input>
            </div>
            <div class="mb-3">
               <x-input type="tel" name="telepon_shohibul" id="telepon_shohibul" placeholder="08235236424" value="-">No. Telepon</x-input>
               {{-- <x-input type="tel" name="telepon_shohibul" id="telepon_shohibul" placeholder="08235236424" :value="old('telepon_shohibul')">No. Telepon</x-input> --}}
           </div>
            <div class="mb-3 row col-12">
                <div class="col-md-6">
                    <label for="metode_qurban" class="form-label fw-semibold">Metode Qurban</label>
                    <select class="metode_qurban form-select col-md-12 @error('metode_qurban') is-invalid @enderror" name="metode_qurban" value="{{old('metode_qurban')}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                        <option value="mandiri" selected >Mandiri</option>
                        <option value="patungan" >Patungan</option>
                      </select>
                    @error('metode_qurban')
                        <div class="invalid-feedback">{{$message}}</div>   
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="jenis_hewan" class="form-label fw-semibold">Jenis Hewan</label>
                    <select class="form-select col-md-12 @error('jenis_hewan') is-invalid @enderror" name="jenis_hewan" value="{{old('jenis_hewan')}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'"> 
                        <option value="kambing" selected>Kambing</option>
                        <option value="lembu" >Lembu</option>
                    </select>
                    @error('jenis_hewan')
                    <div class="invalid-feedback">{{$message}}</div>   
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                {{-- <x-input type="number" name="jumlah_dana" id="jumlah_dana" placeholder="1000000" :value="old('jumlah_dana')">Jumlah</x-input> --}}
                <x-input type="number" name="jumlah_dana" id="jumlah_dana" placeholder="1000000" value="0">Jumlah</x-input>
            </div>
            <div class="mb-3">
                <label for="alamat_shohibul" class="form-label fw-semibold">Alamat</label>
                <textarea class="form-control  @error('alamat_shohibul') is-invalid @enderror" name="alamat_shohibul" placeholder="ceritakan disini.." id="alamat_shohibul" style="height: 100px">beli sendiri</textarea>
                @error('alamat_shohibul')
                    <div class="invalid-feedback">{{$message}}</div>   
                @enderror
            </div>
            <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
        </form>
    </div>
    </div>
@endsection