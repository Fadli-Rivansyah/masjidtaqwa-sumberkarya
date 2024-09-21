@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12 col-xl-6 mx-auto d-flex flex-column">
            <div>
                <div>{{Breadcrumbs::render('setting')}}</div>
                <h4 class="mt-4 my-2 fw-semibold d-flex gap-2"><i class="bi bi-gear"></i> Setting</h4>
            </div>
            <div class="mb-3 border-1 border-bottom">
                <div>
                    <span class="fs-5 fw-medium">Profile</span>
                    <p>Ubah profile disini!</p>
                </div>
                <div class="mb-4">
                    <a href="{{route('setting_profile')}}" class="border border-secondary btn-hover rounded text-decoration-none text-dark p-1 ">Update Profile</a>
                </div>
            </div>
            <div class="mb-3">
                <div>
                    <span class="fs-5 fw-medium">Password</span>
                    <p>Ganti passwordmu disini!</p>
                </div>
                <div>
                    <a href="{{route('setting_password')}}" class="border border-secondary btn-hover rounded text-decoration-none text-dark p-1 ">Update Password</a>
                </div>
            </div>
        </div>
@endsection