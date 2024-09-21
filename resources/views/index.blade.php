@extends('layouts.app')
@section('content')
    
<div class="section-first container-fluid" >
    {{-- jumbotron --}}
  <div class="container" >
        <div class="row">
          <div class="col-sm-12 col-lg-6 col-xxl-8 gap-4" >
            <h1 class="fw-bold text-capitalize fw-bold display-5 col-md-10 col-lg-12 col-xxl-11 ">Selamat Datang di <span class="font-color-green">masjid taqwa</span> Muhammadiyah  Ranting kelurahan sumber karya</h1>
            <p class="lead text_description col-md-6 col-lg-8 col-xxl-6">Bersama-sama memakmurkan masjid ini dengan berbagai aktivitas ibadah dan sosial. </p>
            <a class="nav-link-jumbotron text-dark fw-semibold" href="#footer">Gabung Sekarang</a>
          </div>
          <div class="col-sm-2 col-md-2 col-lg-1 col-xxl-2 " data-aos="fade-left">
            <img src="images/image-masjid.png" alt="Gambar" class="img_jumbotron " >
          </div>
        </div>
  </div>
</div>
 <!-- Container untuk Partikel -->
 
  {{-- section total --}}
<div class="container col-md-8 col-lg-5 col-xl-7 col-xxl-4 mx-auto  container_total" >
  <div class="col-1 col-sm-12  py-2 row mx-auto text-center">
      <div class="col-1 col-sm-1 mx-auto section_total">
          <span class="count display-6 value" data-value="120">0+</span>
          <span  class="mb-2">Anggota</span>
      </div>
      <div class="col-1 col-sm-1 mx-auto section_total">
          <span class="count display-6 value" data-value="109">0+</span>
          <span  class="mb-2">Simpatisan</span>
      </div>
      <div class="col-1 col-sm-1 mx-auto section_total">
          <span class="count display-6 value" data-value="4">0</span>
          <span class="mb-2">Program</span>
      </div>
  </div>
</div>
<div class="container my-4" >
  <div class="container container_keuangan d-lg-flex justify-content-between">
    {{-- table --}}
    <div class="col-md-6 gap-3">
      <div class="table table-responsive-md my-1">
          <h2 class="h2 fw-bold fs-3 col-md-8 col-lg-12">Laporan Keuangan</h2>
          <table class="table border border-1 rounded col-lg-3" >
              <thead>
                  <tr>
                      <th scope="col">Bulan</th>
                      <th scope="col">Pemasukan</th>
                      <th scope="col">Pengeluaran</th>
                      <th scope="col">Pendapatan</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($bulanan as $month => $data)
                  <tr>
                      <td>{{$month}}</td>
                      <td>Rp {{number_format($data['pemasukanBulanan'],2,',','.')}}</td>
                      <td>Rp {{number_format($data['pengeluaranBulanan'],2,',','.')}}</td>
                      @if($data['saldo'] < 0)
                      <td style="color:#b93f54;">Rp {{number_format($data['saldo'], 2, ',','.')}}</td>
                      @else
                          <td>Rp {{number_format($data['saldo'], 2, ',','.')}}</td>
                      @endif
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
    </div>
    <div class="col-md-5">
      <h2 class="h2 fw-bold display-6 col-md-8 col-lg-12">Laporan <span class="font-color-green">Masjid Taqwa</span></h2>
      <p class="my-4">Masjid bukan sekadar tempat ibadah. Lebih dari itu, masjid merupakan pusat dakwah dan pilar kesejahteraan bagi umat. Di masjid, gema takbir berkumandang, ilmu agama ditebarkan, dan rasa persaudaraan diikat erat. Namun, untuk menjalankan fungsinya dengan optimal, masjid membutuhkan dukungan dari kita semua. Salah satu caranya adalah dengan berinfaq.</p>
      <a class="nav-link-jumbotron text-dark fw-semibold shadow py-2" href="{{route('keuangan')}}">Lihat Laporan</a>
    </div> 
  </div>
  {{-- container_program --}}
  <div class="container d-md-flex justify-content-between" style="margin-top:5em;background-color:transparent;">
    <div class="col-sm-12 col-md-6 col-lg-6 my-2 text-dark"  >
      <h2 class="h2 fw-bold text-dark display-6 col-md-8 col-lg-10">Program dan layanan <span class="font-color-green">Masjid Taqwa</span></h2>
      <p class="lh-base my-4">Program ini terbuka untuk semua yang ingin berkontribusi dalam membangun masyarakat Islam yang ideal.  Dengan pengetahuan dan dukungan yang tepat, kita bisa menciptakan masa depan yang lebih baik.</p>
      <p class="lh-base my-4">Temukan Jalinan Persaudaraan melalui Kegiatan Sosial dan Kemanusiaan. Dapatkan Ilmu dan Inspirasi dari Kuliah Agama dan Diskusi Kelompok Kami. Jadilah Bagian dari Komunitas yang Berfokus pada Kebajikan dan Kedamaian.</p>
    </div>
    <div class="col-md-4 " >
      <img src="./images/inside-masjid.jpg" alt="inside-masjid"  class="img-fluid rounded"/>
    </div>
  </div>
</div>

@endsection
