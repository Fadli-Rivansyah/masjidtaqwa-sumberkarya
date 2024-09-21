@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column" >
         {{-- breadcrumbs --}}
        <div>{{ Breadcrumbs::render('edit_zakat', $dataZakat->id)}}</div>
        <h4 class="my-2 fw-semibold">Edit Program Zakat</h4>
        <form action="/admin/zakat" method="POST" class="my-1">
            @method('patch')
            @csrf
            <div class="mb-3">
               <x-input type="text" name="tahun_ramadhan" id="tahun_ramadhan" placeholder="1445 H" :value="$dataZakat->tahun_ramadhan">Tahun Ramadhan</x-input>
            </div>
            <div class="mb-3 row col-12">
                <div class="col-md-6">
                    <x-input type="date" name="tanggal_pembukaan" id="tanggal_pembukaan" placeholder="" :value="$dataZakat->tanggal_pembukaan">Tanggal Pembukaan</x-input>
                </div>
                <div class="col-md-6">
                    <x-input type="date" name="tanggal_penutupan" id="tanggal_penutupan" placeholder="" :value="$dataZakat->tanggal_penutupan">Tanggal Penutupan</x-input>
                </div>
            </div>
            <div class="mb-3 col-12">
                <label for="status" class="form-label fw-semibold">Status</label>
                <select class="form-select col-md-12 @error('status') is-invalid @enderror" name="status" value="{{old('status')}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                    <option value="dibuka" @if($dataZakat->status == 'dibuka') selected @endif>Dibuka</option>
                    <option value="ditutup" @if($dataZakat->status == 'ditutup') selected @endif>Ditutup</option>
                  </select>
                @error('status')
                    <div class="invalid-feeback">{{$message}}</div>   
                @enderror
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                <textarea class="form-control  @error('keterangan') is-invalid @enderror" name="keterangan" placeholder="ceritakan disini.." id="keterangan" style="height: 100px">{{$dataZakat->keterangan}}</textarea>
                @error('keterangan')
                    <div class="invalid-feeback">{{$message}}</div>   
                @enderror
            </div>
            <input type="hidden" name="id_zakat" value="{{$dataZakat->id}}">
            <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
        </form>
    </div>
    </div>
@endsection