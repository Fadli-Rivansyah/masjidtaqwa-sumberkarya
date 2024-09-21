@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <x-alert />
        <div class="col-md-12 col-xl-6 mx-auto d-flex flex-column">
            <div>
                <div>{{Breadcrumbs::render('setting_password')}}</div>
                <h4 class="mt-4 my-2 fw-semibold"><i class="bi bi-gear"></i> Setting</h4>
            </div>
            <div class="mb-3">
                <div>
                    <span class="fs-5 fw-medium">Password</span>
                    <p>Ganti passwordmu disini!</p>
                </div>
                <div>
                    <form action="/admin/setting/password" method="POST" class="my-3">
                        @method('patch')
                        @csrf
                        <div class="mb-3 row d-flex gap-3 col-12 ">
                            <div class="col-md-5 ">
                                <label for="passwordL" class="form-label fw-medium">Password Lama</label>
                                <input type="password" placeholder="@#$@" class="form-control @error('passwordL') is-invalid @enderror" name="passwordL"  onmouseover="this.style.border='1px solid #1DA599'">
                                @error('passwordL')
                                    <div class="invalid-feedback">{{$message}}</div>   
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <label for="passwordB" class="form-label fw-medium">Password Baru</label>
                                <input type="password" placeholder="$$%@" class="form-control @error('passwordB') is-invalid @enderror" name="passwordB" id="passwordB"  onmouseover="this.style.border='1px solid #1DA599'">
                                @error('passwordB')
                                <div class="invalid-feedback">{{$message}}</div>   
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn-hover p-2 rounded border-scondary text-dark bg-transparent border-1 font-medium d-flex gap-2"><i class="bi bi-pencil"></i> Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
@endsection