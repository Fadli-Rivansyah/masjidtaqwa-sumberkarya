<div class="content mx-auto col-md-12">
    <h2 class="h2 fw-bold">GAS (Gerakan Amal Sholeh)</h2>
    {{-- menampilkan program --}}
    @empty($dataProgram)
        <x-alert-empty />
    @else
        <div class="row col-md-12 mx-auto">
            <div class="program_gas col-sm-12 col-12 shadow text-white" style="background-color: #454545">
                <i class="bi bi-bell-fill float-end fs-2 mx-2" style="color:#454545;"></i>
                <h4 class="h4 fs-5 fw-semibold mb-1  text-capitalize header_program">{{$dataProgram->nama_program}} ({{$dataProgram->status}})</h4>
                <div class="col font-color-orange rounded fw-medium tanggal_program d-flex align-items-center gap-2 " style="width: max-content;background-color:#454545">
                    <span><i class="bi bi-calendar-check fs-5 gap-2"></i> Target Selesai</span>
                    <span>{{date('d F Y', strtotime($dataProgram->target))}}</span>
                </div>
                <div class="row col-sm-6 col-md-12 my-2 gap-3">
                    <div class="row col-md-6">
                        <span class="fw-bold fs-6">Kategori</span>
                        <span class="fw-semibold text-capitalize fs-6 ">{{$dataProgram->kategori}}</span>
                    </div>
                    <div class="row col-sm-4 col-md-6">
                        <span class="fw-bold">Etimasi Biaya</span>
                        <span class="fw-bolder fs-4 display-6">Rp {{number_format($dataProgram->biaya, 2, ',','.')}}</span>
                    </div>
                </div>
                <div class="rounded">
                    <p class="deskripsi_program">{{$dataProgram->keterangan_program}}.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-1 col-md-12 my-4">
            <div class="row col-sm-12 gap-3 mx-auto">
                <div class="col-md-5 col-lg-4 col-xxl-3 p-3 rounded shadow text-light" style="background-color:#1DA599;">
                    <div class="col">
                        <i class="bi bi-wallet-fill float-end fs-3 mx-2 fw-bold"></i>
                        <h6 class="fs-6 mb-3 fw-semibold">Dana Terkumpul</h6>
                        @if (!empty($danaProgramTerkumpul))
                            <span class="display-6 fw-bold fs-4">Rp {{ number_format($danaProgramTerkumpul, 2, ',', '.') }}</span>
                        @else
                            <span class="display-6 fw-bold fs-4">Rp 0</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 col-xxl-3 p-3 rounded shadow text-white" style="background-color:#454545;">
                    <div class="col">
                        <i class="bi bi-people-fill float-end fs-3 mx-2 fw-bold"></i>
                        <h6 class="fs-6 mb-3 fw-semibold">Jumlah Partisipan</h6>
                        @if ($jumlahPartisipan > 0)
                            <span class="display-6 fw-bold fs-4">{{$jumlahPartisipan}}</span>
                        @else
                            <span class="display-6 fw-bold fs-4">0</span>
                        @endif
                    </div>
                </div>
            </div>
            {{-- tablw jamaah --}}
            <div class="row mt-4 my-2 col-md-8 ">
                <h4 class="h4 fs-6 fw-bolder" style="width: max-content;">Daftar Peserta GAS</h4>
                <p class="fs-6">Menginspirasi Perubahan, Membangun Kebaikan</p>
            </div>
            @if($dataJamaah->isEmpty())
                <x-alert-empty />
            @else
            <div style="overflow-y: scroll; height:50vh;scrollbar-color:#11635c27 rgba(116, 116, 116, 0.253)">
                <div class="table table-borderless table-responsive-md">
                  <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No<I/th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Status</th>
                                <th scope="col">jumlah</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataJamaah as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="text-capitalize">{{$item->nama}}</td>
                                    <td>{{date('d F Y', strtotime($item->tanggal))}}</td>
                                    <td class="text-capitalize">
                                        @if ($item->status == "lunas")
                                            <span class="badge text-medium rounded text-light" style="background-color: #1DA599;">{{$item->status}}</span>
                                        @else
                                            <span class="badge text-medium rounded text-light" style="background-color: #b93f54;">{{$item->status}}</span>
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
            @endif
        </div>
    @endempty
</div>
