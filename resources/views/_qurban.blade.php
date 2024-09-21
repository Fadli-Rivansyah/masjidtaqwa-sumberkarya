<div class="content col-md-12 mx-auto">
    <h2 class="h2 fw-bold">Qurban</h2>
    @empty($dataQurban)
        <x-alert-empty />
    @else
        <div class="col-sm-12  rounded p-4 shadow text-white" style="background-color: #454545">
            <h4 class="fw-semibold fs-5">Idul Adha <span class="font-color-orange">{{$dataQurban->tahun_qurban}}</span> </h4>
            <p>{{$dataQurban->keterangan}}</p>
        </div>
        <div class="row mx-auto my-2 d-flex gap-3">
            <div class="col-md-5 col-lg-4 col-xxl-3 p-3 rounded mt-3 shadow text-light float-end" style="background-color: #1DA599;">
                <div class="col" style="height: max-content;">
                    <i class="bi bi-wallet-fill float-end fs-3 mx-2 fw-bold"></i>
                    <h6 class="fs-6 mb-3 fw-semibold">Total Dana</h6>
                    @if (!empty($danaQurban))
                        <span class="display-6 fw-bold fs-4">Rp {{ number_format($danaQurban, 2, ',', '.') }}</span>
                    @else
                        <span class="display-6 fw-bold fs-4">0</span>
                    @endif
                </div>
            </div>
            <div class="col-md-5 col-lg-4 col-xxl-3 p-3 rounded mt-3 shadow float-end text-white" style="background-color:#454545;">
                <div class="col" style="height: max-content;">
                    <i class="bi bi bi-bar-chart-fill float-end fs-3 mx-2 fw-bold"></i>
                    <h6 class="fs-6 mb-3 fw-semibold">Jumlah Shohibul Qurban</h6>
                    @if ($jumlahShohibul > 0)
                        <span class="display-6 fw-bold fs-4">{{ $jumlahShohibul }}</span>
                    @else
                        <span class="display-6 fw-bold fs-4">0</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row col-12 d-flex justify-content-between my-2 mt-3">
            <h5 class="fs-6 fw-bolder">Daftar shohibul Qurban</h5>
        </div>
        <div class="my-4 mt-1">
            <div>
                <h5 class="fs-5">Patungan (Lembu)</h5>
                @if($dataPatunganLembu->isEmpty()) 
                <x-alert-empty />
                @else
                    <div class="table table-responsive-md my-4 d-flex flex-wrap gap-4  ">
                        @foreach($dataPatunganLembu as $group)
                            <table class="table border border-1 rounded" style="width: 18em;">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor Urut {{ $loop->iteration }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($group as $item)
                                    <tr>
                                        <td class="text-capitalize">{{ $item->nama }}</td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                @endif
            </div>
            <div>
            <h5 class="fs-5">Mandiri (Lembu)</h5>
            @if($dataMandiriLembu->isEmpty()) 
            <x-alert-empty />
            @else
                <div class="table  table-responsive-md my-4  d-flex flex-wrap gap-4 col-md-12">
                    @foreach($dataMandiriLembu as $item)
                        <table class="table border border-1 rounded" style="width: 18em;">
                            <thead>
                                <tr>
                                    <th scope="col">Nomor Urut {{ $loop->iteration }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-capitalize">{{ $item->nama }}</td> 
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>
            @endif
            </div>
            <div>
                <h5 class="fs-5">Mandiri (Kambing)</h5>
                @if($dataMandiriKambing->isEmpty()) 
                <x-alert-empty />
                @else
                    <div class="table table-responsive-md my-4  d-flex flex-wrap gap-4">
                        @foreach($dataMandiriKambing as $item)
                            <table class="table border border-1 rounded" style="width: 18em;">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor Urut {{ $loop->iteration }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-capitalize">{{ $item->nama }}</td> 
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach 
                    </div>
                @endif    
            </div>
        </div>
    @endempty
</div>