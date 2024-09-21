@extends('auth.layouts.app')
@section('content')
    <div class="container-fluid container_login" style="width: 100vw; height:100vh; overflow:hidden; background-image:url('images/image-masjid.png'); background-size:cover;">
        <div class="continer-fluid d-flex flex-column justify-content-center align-items-center" style="height:100vh;" >
            <div style="width: 100vw; height:100vh;position:absolute; background-color:black; opacity:70%;"></div>
            <h3 class="display-5 fw-bold z-2 my-4" style="color:white">Masjid Taqwa</h3>
            @if ($message = Session::get('success'))
                <div class="alert alert-success fw-bold z-2 fs-4" style="color:white" role="alert"><strong>{{ $message }}</strong></div>
            @elseif($message = Session::get('error'))
                <div class="alert alert-failed fw-bold z-2 fs-4" style="color:white" role="alert"><strong>{{ $message }}</strong></div>
            @endif
            <form action="/login" method="POST" class="col-10 col-md-6 col-lg-4 col-xxl-3 p-4 bg-light rounded z-2">
                @csrf
                <div class="mb-3">
                    <x-input type="text" name="username" id="username" placeholder="admin" :value="old('username')"> Username </x-input>
                </div>
                <div class="mb-3">
                    <x-input type="password" name="password" id="password" placeholder="" :value="old('password')"> Password </x-input>
                </div>
                <div class="mb-3 row-2">
                    <input class="form-check-input hover-" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary col-12 border-0" style="background-color: #1DA599; border: 1px solid #1da599;">Login</button>
            </form>
        </div>
    </div>
@endsection
