@extends('admin.layouts.app')
@section('content')
<div class="container">
        <x-alert />
        <div class="col-md-12 col-xl-6 mx-auto d-flex flex-column">
            <div>
                <div>{{Breadcrumbs::render('setting_profile')}}</div>
                <h4 class="mt-4 my-2 fw-semibold"><i class="bi bi-gear"></i> Setting</h4>
            </div>
            <div class="mb-3">
                <div>
                    <span class="fs-5 fw-medium">Profile</span>
                    <p>Ubah profile disini!</p>
                </div>
                <div>
                    <form action="/admin/setting/profile" method="POST" class="my-3">
                        @method('patch')
                        @csrf
                        <div class="mb-3 row col-12 gap-3 ">
                            <div class="col-md-5">
                                <label for="nama" class="form-label fw-medium">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"  onmouseover="this.style.border='1px solid #1DA599'" value="{{$dataUser->name}}">
                                @error('nama')
                                    <div class="invalid-feedback">{{$message}}</div>   
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="username" class="form-label fw-medium">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username"  onmouseover="this.style.border='1px solid #1DA599'" value="{{$dataUser->username}}">
                                @error('username')
                                    <div class="invalid-feedback">{{$message}}</div>   
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input type="email" name="email" value="{{$dataUser->email}}" class="form-control @error('email') is-invalid @enderror" id="inputText" onmouseover="this.style.border='1px solid #1DA599'">
                            @error('email')
                                <div class="invalid-feedback">{{$message}}</div>   
                           @enderror
                        </div>
                        <button type="submit" class="p-2 btn-hover rounded border-scondary text-dark  bg-transparent border-1 font-medium d-flex gap-2"><i class="bi bi-pencil"></i> Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
@endsection