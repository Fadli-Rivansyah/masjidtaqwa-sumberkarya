@extends('admin.layouts.app')
@section('content')
<div class="container my-2">
    <div class="col-md-12 col-xl-5 mx-auto d-flex flex-column">
        <div>{{ Breadcrumbs::render('edit_keuangan', $data->id)}}</div>
        <h4 class="my-2 fw-semibold">Edit Data Pemasukan & Pengeluaran</h4>
        <form action="{{route('keuangan')}}" method="POST" class="my-1">
            @method("patch")
            @csrf
            <div class="mb-3 row col-12">
                <div class="col-md-6">
                    <x-input type="date" name="tanggal_data" id="tanggal" placeholder="" :value="$data->tanggal_data"> Tanggal </x-input>
                </div>
                <div class="col-md-6">
                    <label for="jenis_data" class="form-label fw-semibold ">Jenis</label>
                    <select class="form-select col-md-12 @error('jenis_data') is-invalid @enderror" name="jenis_data" value="{{$data->jenis_data}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                        <option value="pemasukan" @if($data->jenis_data == 'pemasukan') selected @endif>Pemasukan</option>
                        <option value="pengeluaran" @if($data->jenis_data == 'pengeluaran') selected @endif>Pengeluaran</option>
                      </select>
                    @error('jenis_data')
                    <div class="invalid-feedback">{{$message}}</div>   
                    @enderror
                </div>
            </div>
            <div class="mb-3 col-12">
                <label for="kategori_data" class="form-label fw-semibold">Kategori</label>
                <select class="form-select col-md-12 @error('kategori_data') is-invalid @enderror" name="kategori_data" value="{{old($data->kategori_data)}}"  onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'">
                    <option value="infaq" @if($data->kategori_data == 'infaq') selected @endif>Infaq</option>
                    <option value="sedekah" @if($data->kategori_data == 'sedekah') selected @endif>Sedekah</option>
                    <option value="wakaf" @if($data->kategori_data == 'wakaf') selected @endif>Wakaf</option>
                    <option value="biaya perlengkapan kantor" @if($data->kategori_data == 'biaya perlengkapan kantor') selected @endif>Biaya Perlengkapan Kantor</option>
                    <option value="biaya pengurus masjid" @if($data->kategori_data == 'biaya pengurus masjid') selected @endif>Biaya Pengurus Masjid</option>
                    <option value="biaya pemeliharaan bangunan" @if($data->kategori_data == 'biaya pemeliharaan bangunan') selected @endif>Biaya pemeliharaan Bangunan</option>
                    <option value="biaya lainnya" @if($data->kategori_data == 'biaya lainnya') selected @endif>Biaya lainnya</option>
                  </select>
                @error('kategori_data')
                <div class="invalid-feedback">{{$message}}</div>   
                @enderror
            </div>
            <div class="mb-3">
               <x-input type="number" name="jumlah_data" id="jumlah_data" placeholder="10000000" :value="$data->jumlah_data"> jumlah </x-input>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"  placeholder="ceritakan disini.." id="keterangan" style="height: 100px">{{$data->keterangan}}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{$message}}</div>   
                @enderror
            </div>
            <input type="hidden" name="id" value="{{$data->id}}">
            <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Buat</button>
        </form>
    </div>
    </div>
    
@endsection