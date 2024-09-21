@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column" >
        {{-- bradcrumbs --}}
        <div>{{ Breadcrumbs::render('create_qurban')}}</div>
        <h4 class="my-2 fw-semibold">Buat Program Qurban</h4>
        <form action="{{route('store_qurban')}}" method="POST" class="my-1">
            @method('POST')
            @csrf
            <div class="mb-3">
               <x-input type="text" name="tahun_qurban" id="tahun_qurban" placeholder="1445 H" :value="old('tahun_qurban')">Tahun Qurban</x-input>
            </div>
            <div class="mb-3 row col-12">
                <div class="col-md-6">
                    <x-input type="date" name="tanggal_pembukaan" id="tanggal_pembukaan" placeholder="" :value="now()->format('Y-m-d')">Tanggal Pembukaan</x-input>
                </div>
                <div class="col-md-6">
                    <x-input type="date" name="tanggal_penutupan" id="tanggal_penutupan" placeholder="" :value="now()->format('Y-m-d')">Tanggal Penutupan</x-input>
                </div>
            </div>
            <div class="mb-3 col-12">
                <label for="status" class="form-label fw-semibold">Status</label>
                <select class="form-select col-md-12 @error('status') is-invalid @enderror" name="status" value="{{old('status')}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                    <option value="dibuka">Dibuka</option>
                    <option value="ditutup">Ditutup</option>
                  </select>
                @error('status')
                    <div class="invalid-feedback">{{$message}}</div>   
                @enderror
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                <textarea class="form-control  @error('keterangan') is-invalid @enderror" name="keterangan" placeholder="ceritakan disini.." id="keterangan" style="height: 100px"></textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{$message}}</div>   
                @enderror
            </div>
            <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
        </form>
    </div>
    </div>
@endsection