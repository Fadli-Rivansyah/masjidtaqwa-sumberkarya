@extends('layouts.app')
@section('content')
{{-- container_program --}}
<div class="container">
  <h2 class="h2 fw-bold display-5 col-md-8 col-lg-6 my-4">Program dan layanan <span class="font-color-green">Masjid Taqwa</span></h2>
  <div class="row col-md-6 col-lg-12 d-flex flex-wrap gap-4 mt-4 my-4 text-dark mx-auto">
      <x-card :title="'Pengajian Muhammadiyah'" :status="'masih berjalan'" :tag="'program'">setiap Jum'at malam setelah Isya, Masjid Taqwa membuka pintu untuk kajian khusus ikhwan. Ini kesempatan emas untuk menambah ilmu, mempererat ukhuwah, dan meraih keberkahan di malam istimewa.</x-card>
      <x-card :title="'Pengajian Aisiyah'" :status="'masih berjalan'" :tag="'program'">Dilaksanakan ba’da sholat jum’at sekitar pukul 14.00 wib. Lokasi di Masjid Taqwa kelurahan sumber karya. pengajian ini dikhususkan untuk kaum perempuan</x-card>
      <x-card :title="'Pengajian Tahsin Al-Quran'" :status="'belum berjalan'" :tag="'program'">Belajar tahsin gratis di masjid taqwa, program ini terbuka untuk siapa saja yang ikut berlajar. baik itu masih anak-anak, remaja, maupun dewasa</x-card>
      <x-card :title="'Pengajian Ahad Shubuh'" :status="'masih berjalan'" :tag="'program'">Pengajian yang dilaksanakan setiap hari ahad tepatnya selesai sholat shubuh. dihadiri berbagai kalangan mulai dari anak-anak, remaja, maupun dewasa.</x-card>
      <x-card :title="'Penyaluran Infaq'" :status="'masih berjalan'" :tag="'program'">Hasil infaq  untuk anak yatim & duafa akan disalurkan kepada anak yatim dan duafa berupa uang dan beras. infaq tersebut berasal dari masyarakat</x-card>
      <x-card :title="'Donor Darah'" :status="'masih berjalan'" :tag="'program'">Program ini bukan hanya membantu sesama yang membutuhkan darah, tetapi juga membawa manfaat kesehatan bagi para pendonornya. program ini untuk ihkwan dan akhwat</x-card>
      <x-card :title="'Koperasi Karya Melati'" :status="'masih berjalan'" :tag="'Layanan'">Koperasi ini digunakan ketika ingin memminjam berkaitan tentang keuangan, baik itu untuk modal usaha dan hal-hal lain. dan ini membutuhkan persetujuan pengurus</x-card>
      <x-card :title="'Pelayanan Ambulan'" :status="'masih berjalan'" :tag="'Layanan'">Mobil ambulan boleh dipakai siapa saja kepada umat muslim. ketika seseorang bukan berstatus anggota, maka orang tersebut dapat berinfaq saja .</x-card>
      <x-card :title="'PKU Masjid'" :status="'masih berjalan'" :tag="'Layanan'">Program ini berguna untuk kemalangan seperti meninggal dunia atau sakit. ketika anggota meninggal dunia keluarga almarhum berhak disantuni.</x-card>
  </div>
  </div>
@endsection
