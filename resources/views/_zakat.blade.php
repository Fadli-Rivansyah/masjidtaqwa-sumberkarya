<div class="content col-md-12 mx-auto">
    <h2 class="h2 fw-bold">Zakat Fitra</h2>
    @empty($dataZakat)
        <x-alert-empty />
    @else
        <div class="col-sm-12 my-2 rounded p-4 shadow text-white"style="background-color: #454545;">
          <h4 class="fs-5 fw-semibold">Zakat Idul Fitri - <span class="font-color-orange">{{$dataZakat->tahun_ramadhan}} </span></h4>
          <p class="font-semibold mt-2">{{$dataZakat->keterangan}}</p>
        </div>
        <div class="row mx-auto my-2 d-flex gap-3">
          <div class="col-md-5 col-lg-5 col-xl-3 p-3 rounded mt-3 shadow text-light float-end" style="background-color: #1DA599;">
              <div class="col" style="height: max-content;">
                  <i class="bi bi-people-fill float-end fs-3 mx-2 fw-bold"></i>
                  <h6 class="fs-6 mb-3 fw-semibold">Total Muzakki</h6>
                  @if ($jumlahMuzakki > 0)
                      <span class="display-6 fw-bold fs-4">{{ $jumlahMuzakki }}</span>
                  @else
                      <span class="display-6 fw-bold fs-4">0</span>
                  @endif
              </div>
          </div>
          <div class="col-md-5 col-lg-5 col-xl-3 p-3 rounded mt-3 shadow float-end text-white" style="background-color:#454545;">
              <div class="col " style="height: max-content;">
                  <i class="bi bi bi-people-fill float-end fs-3 mx-2 fw-bold"></i>
                  <h6 class="fs-6 mb-3 fw-semibold">Total Mustahik</h6>
                  @if ($jumlahMustahik > 0)
                      <span class="display-6 fw-bold fs-4">{{ $jumlahMustahik }}</span>
                  @else
                      <span class="display-6 fw-bold fs-4">0</span>
                  @endif
              </div>
          </div>
        </div>
        <div class="tabs_zakat d-flex gap-4 my-4 mt-3">
          <button class="tab-btn-zakat active-content-zakat">Muzakki</button>
          <button class="tab-btn-zakat">Mustahik</button>
        </div>
        <div class="box-content-zakat ">
          <div class="content_zakat active-content-zakat">
            <div class="my-4">
              <div class="col">
                <h4 class="fw-bolder fs-6">Laporan Pemberi Zakat (Muzakki)</h4>
                <p class="fs-6">Menyentuh Hati, Membangun Kebaikan</p>
              </div>
              @if($dataMuzakki->isEmpty())
                <x-alert-empty />
              @else
              {{-- tabel --}}
              <div  style="overflow-y: scroll; height:50vh;scrollbar-color:#11635c27 rgba(116, 116, 116, 0.253)">
                <div class="table table-borderless table-responsive-md">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">No</th>
                              <th scope="col">Nama Muzakki</th>
                              <th scope="col">Tanggal</th>
                              <th scope="col">Kategori</th>
                              <th scope="col">Jumlah</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($dataMuzakki as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="text-capitalize">{{$item->nama}}</td>
                                <td class="text-capitalize">{{date('d F Y', strtotime($item->tanggal))}}</td>
                                @if ($item->kategori == "uang")
                                    <td>
                                        <span class="badge text-capitalize text-medium rounded text-light" style="background-color: #447cc5;">{{$item->kategori}}</span>
                                    </td>
                                    <td>Rp {{number_format($item->jumlah, 2, ',', '.') }}</td>
                                @else
                                    <td>
                                        <span class="badge text-capitalize text-medium rounded text-light" style="background-color:#1DA599;">{{$item->kategori}}</span>
                                    </td>
                                    <td>{{$item->jumlah}} Kg</td>       
                                @endif
                            </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
              </div>
              @endif
            </div>
          </div>
          <div class="content_zakat">
            <div class="my-4">
              <div>
                <h4 class="h4 fw-bolder fs-6">Laporan Penerima Zakat</h4>
                <p class="col-md-8 fs-6">Memberikan zakat adalah memberi kesempatan kepada mereka yang membutuhkan untuk memulai kembali.</p>
              </div>
              @if($dataMustahik->isEmpty())
                <x-alert-empty />
              @else
              <div  style="overflow-y: scroll; height:50vh;scrollbar-color:#11635c27 rgba(116, 116, 116, 0.253)">
                <div class="table table-borderless table-responsive-md">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">No</th>
                              <th scope="col">Nama Mustahik</th>
                              <th scope="col">Jenis Asnaf</th>
                              <th scope="col">Alamat</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($dataMustahik as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td class="text-capitalize">{{$item->nama}}</td>
                                <td class="text-capitalize">{{$item->jenis_asnaf}}</td>
                                <td class="text-capitalize">{{$item->alamat}}</td>
                            </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>
    @endempty
  </div>