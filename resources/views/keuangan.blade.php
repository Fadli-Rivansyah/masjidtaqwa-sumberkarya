@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="mt-4 col-lg-8 col-xl-9 col-xxl-12" id="keuangan">
            {{-- tabs menu --}}
            <nav class="mx-2 my-4 col-sm-2 d-flex align-items-center gap-2">
                <button class="border border-2 navbar-toggler fs-5 rounded p-2" style="border-color:#818181 !important;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-app-indicator"></i>
                </button>
                <span class="fs-5 fw-medium">Menu</span>
            </nav>
            <div class="container collapse navbar-collapse" id="navbarToggleExternalContent">
                <div class="tab_box  navbar-collapse col-sm-4 col-md-12 col-xxl-12 d-flex justify-content-between border-1 py-1">
                    <ul class="list-unstyled d-lg-flex justify-content-between col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-8">
                        <li><button class="tab_btn fw-semibold d-flex align-items-center gap-3 active-menu"><i class="bi bi-wallet-fill fs-4"></i>Keuangan Masjid</button></li>
                        <li><button class="tab_btn fw-semibold d-flex align-items-center gap-3"><i class="bi bi-calendar2-heart-fill fs-4"></i>GAS (Gerakan Amal Sholeh)</button></li>
                        <li><button class="tab_btn fw-semibold d-flex align-items-center gap-3"><i class="bi bi-person-raised-hand fs-4"></i>Zakat Fitra</button></li>
                        <li><button class="tab_btn fw-semibold d-flex align-items-center gap-3"><i class="bi bi-people-fill fs-4"></i>Qurban</button></li>
                    </ul> 
                </div>
            </div>
        </div>
        <div class="col-md-12 content_box" >
            <div class="row content active-menu col-md-12 mx-auto" id="infaq-masjid-page">
                <h2 class="h2 fw-bold ">Keuangan Masjid</h2>
                <div class="col my-2">
                    {{-- section laporan transaksi --}}
                    <div class="row mx-auto my-2 d-flex gap-3">
                        <div class="col-md-5 col-lg-4 col-xxl-3 p-3 rounded mt-3 shadow text-light" style="background-color :#1DA599;">
                            <div class="col" style="height: max-content;">
                                <i class="bi bi-wallet-fill float-end fs-3 mx-2 fw-bold"></i>
                                <h6 class="fs-6 mb-3 fw-semibold">Saldo</h6>
                                @if (!empty($saldo))
                                    <span class="display-6 fw-bold fs-4">Rp {{ number_format($saldo, 2, ',', '.') }}</span>
                                @else
                                    <span class="display-6 fw-bold fs-4">0</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-4 col-xxl-3 p-3 rounded mt-3 shadow float-end text-white" style="background-color:#454545;">
                            <div class="col" style="height: max-content;">
                                <i class="bi bi bi-bar-chart-fill float-end fs-3 mx-2 fw-bold"></i>
                                <h6 class="fs-6 mb-3 fw-semibold">Jumlah</h6>
                                @if ($jumlahTransaksi > 0)
                                    <span class="display-6 fw-bold fs-4">{{ $jumlahTransaksi }}</span>
                                @else
                                    <span class="display-6 fw-bold fs-4">0</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row-2 gap-5 mt-4 col-md-8 mb-3">
                            <h4 class="h4 fs-6 fw-bolder">Daftar Pemasukan dan Pengeluaran</h4>
                            <p class="fs-6">Meluaskan Berkah, Membangun Jembatan Kasih: Infaq Masjid untuk Kebaikan Bersama.</p>
                        </div>
                        @if($dataInfaq->isEmpty())
                        <x-alert-empty />
                        @else
                        {{-- table --}}
                            @include('_tabelBulanan')
                        @endif  
                    </div>
                </div>
            </div>
            @include('_gas')
            @include('_zakat')
            @include('_qurban')
        </div>
    </div>
@endsection