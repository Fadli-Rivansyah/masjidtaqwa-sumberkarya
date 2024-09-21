@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <h5 class="h5 display-6 fs-2 mb-4">Pertanyaan yang mungkin sering diajukan</h5>
        <div class="accordion my-4 " id="accordionExample">
          {{-- pertama --}}
            <div class="accordion-item ">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Apa manfaat aplikasi ini ?
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Aplikasi ini hadir mempermudahkan dalam pengolahan keuangan. salah satunya adalah laporan keuangan infaq masjid. tidak hanya itu terdapat fitur lain seperti GAS(Gerakan Amal Sholeh), Zakat, dan Qurban. insyaallah fitur tersebut bermanfaat dalam pengolahan keuangan serta pendataan jama'ah.
                </div>
              </div>
            </div>
            {{-- kedua --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Bagaimana membuat transaksi pada fitur infaq masjid?
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Untuk membuat transaksi pada laporan infaq masjid cukup mudah berikut langkah-langkah dalam membuat transaksi.
                  <ol>
                    <li>Pilih navigasi, lalu klik infaq masjid</li>
                    <li>Dihalaman infaq masjid cukup banyak yang bisa dimanfaatkan. untuk membuat transaksi klik <strong>Buat Transaksi</strong>. itu akan menuju ke halaman membuat transaksi</li>
                    <li>Pada halaman membuat transaksi terdapat form untuk mengirim beberapa data.</li>
                    <li>Isi form tersebut sesuai apa yang terjadi, apakah pengeluaran atau pemasukan, dan pilih opsi lainnya. setelah diisi, pilih <strong>Buat</strong></li>
                    <li>jika berhasil akan ditampilkan pada tabel diurutan pertama. data tersebut juga dapat <strong>diubah</strong> maupun <strong>dihapus</strong>.</li>
                  </ol>
                </div>
              </div>
            </div>
            {{-- ketiga --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                 Bagaimana cara menggunakan fitur filter infaq masjid?
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <P>filter infaq masjid digunakan untuk mempermudahkan user dalam mengambil data berdasarkan tanggal tertentu. itu dapat dilakukan dengan mudah. dan data tersebut juga bisa di export menjadi format PDF. berikut cara bagaimana menggunakan fitur tersebut.</P>
                </div>
              </div>
            </div>
            {{-- keempat --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
                  Bagaimana cara membuat program GAS (Gerakan Amal Sholeh)
                </button>
              </h2>
              <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Untuk membuat Program GAS tidaklah sulit. berikut beberapa langkah dalam memembuat program GAS.</p>
                  <ol>
                    <li>Pergi ke <strong>halaman GAS (Gerakan Amal Sholeh)</strong> dengan mengklik navigasi pada GAS</li>
                    <li>Ketika Halaman GAS tampil. tekan <strong>tombol Buat Program</strong>. setelah diklik akan menuju ke halaman <strong>Buat Program</strong> dengan syarat tidak ada program yang berstatus <strong>belum selesai</strong>, jika itu ada aplikasi akan menampilkan sebuah popup berisi pesan dan tidak dapat menuju kehalaman <strong>buat program</strong>. untuk membuat program pastikan tidak ada program yang berstatus belum selesai.</li>
                    <li>Di halaman <strong>Buat Program</strong> terdapat form yang dapat isi seperti nama program, tanggal, biaya yang diperlukan, target selesai, dan keterangan tentang program tersebut. form harus diisi dengan benar, karena akan ditampilkan pada landing page. jika selesai diisi dapat menekan <strong>tombol Buat</strong>, jika berhasil akan tampil ditabel pada urutan pertama.</li>
                    <li>Setelah data ditampilkan pada tabel, maka didalam field tersebut terdapat tombol <strong>view, edit, dan update</strong>. user dapat melihat, mengubah, dan mengapus.</li>
                    <li>Untuk melihat program, tekan <strong>tombol view</strong>. akan menuju halaman program. disana pengguna dapat menambahkan jama'ah, mencari jama'ah, mengexport dan masih banyak lainnya.</li>
                    <li>jika ingin jama'ah sebagai ikut serta program. pengguna dapat mengklik <strong>tombol Tambah Jama'ah</strong> lalu diarahkan ke form buat jama'ah.</li>
                  </ol>
                </div>
              </div>
            </div>
            {{-- kelima --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLima" aria-expanded="false" aria-controls="collapseThree">
                  Bagaimana cara mengexport data jama'ah menjadi laporan jama'ah ?
                </button>
              </h2>
              <div id="collapseLima" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Data jama'ah yang yang dapat dilihat pada tabel dapat diexport. ppengguna juga dapat mencari data jama'ah menggunakan fitur pencarian yang telah disediakan. berikut langkah-langkah untuk mengexport data jama'ah</p>
                  <ol>
                    <li>Pergi kehalaman <strong>view program</strong>, ini dapat dilihat jika sudah membuat program yang bestatus <strong>belum selesai</strong>.</li>
                    <li>jika sudah masuk pada halaman view program, lalu klik tombol <strong>export</strong>. setelah itu proses download pun akan terjadi.</li>
                    <li>selesai</li>
                  </ol>
                </div>
              </div>
            </div>
            {{-- keenam --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
                  Apa manfaat fitur zakat ?
                </button>
              </h2>
              <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Zakat pada aplikasi ini merupakan zakat fitra. fitur ini mengolah data muzakki(pemberi zakat) dan data mustahik(penerima zakat). data mustahik akan dijumlahkan tidak dengan secara manual melainkan menggunakan sistem agar mudah dalam memnghitung serta membagikan kepada jama'ah mustahik.</p>
                </div>
              </div>
            </div>
            {{-- ketujuh --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseThree">
                  Bagaimana membuat program zakat ?
                </button>
              </h2>
              <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Pada fitur ini digunakan untuk mengolah data jama'ah muzakki dan mustahik. terdapat langkah-langkah dalam dalam membuat program zakat</p>
                  <ol>
                    <li>Pergi ke navigasi, lalu pilih <strong>zakat</strong>. ini akan menuju ke halaman zakat</li>
                    <li>Pada halaman zakat terdapat tombol <strong>Buat Program Zakat</strong>. terdapat syarat seperti pada tombol buat program GAS. tidak boleh membuat program zakat jika masih ada data yang berstatus <strong>dibuka</strong>. jika tidak ada status tersebut, maka akan diarahkan ke halaman buat program zakat.</li>
                    <li>Pada halaman buat program. pengguna harus mengisi form sesuai ketentuan yang berlaku. terdapat beberapa form seperti tahun ramadhan yang sudah diisi secara otomatis. tetapi bisa diubah jika diperlukan. terdapat tanggal pembukaan dan tanggal penutupan pembayaran zakat, status, dan keterangan pada program zakat. kemudian klik tombol <strong>Buat</strong>, jika berhasil data akan tampil pada tabel.</li>
                    <li>Data di field tabel memiliki <strong>aksi</strong>. bisa dihapus, diubah dan dilihat. untuk menambahkan data muzakki pengguna harus melihat program dengan cara mengklik tombol <strong>icon mata</strong>. pengguna akan masuk ke halaman view zakat, dimana pengguna dapat melakukan beberapa hal seperti membuat data Muzakki dan mustahik.</li>
                    </ol>
                </div>
              </div>
            </div>
            {{-- delapan --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseThree">
                  Bagaimana cara membuat data muzakki ?
                </button>
              </h2>
              <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Membuat data muzakki(pemberi zakat) pengguna harus memiliki syarat yaitu harus adanya progrma yang berstatus <strong>dibuka</strong>. berikut beberapa langkap untuk membuat data muzakki.</p>
                  <ol>
                    <li>Pergi ke view zakat dengan mengklik <strong>tombol view</strong> yang akan menuju ke halaman view zakat.</li>
                    <li>Seteah berada di halaman view zakat. pengguna dapat menambahkan data dengan klik <strong>tombol Buat Muzakki</strong>, sistem akan mengalikan menuju halaman buat muzakki</li>
                    <li>Halaman buat muzakki berisi form yang harus diisi sesuai syarat yang berlaku terdapat nama,no telepon, tanggal, jumlah orang, kategori, dan jumlah</li>
                    <li>Setelah berhasil mengisi form, data akan tampil di tabel muzakki. disana pengguna dapat mengolah data tersebu, apakah diubah dan dihapus</li>
                  </ol>
                </div>
              </div>
            </div>
            {{-- sembilan --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseThree">
                  Bagaimana cara membuat data mustahik ?
                </button>
              </h2>
              <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Adapun cara untuk menambahkan data mustahik sebagai berikut.</p>
                  <ol>
                    <li>Pergi ke view zakat, lalu klik <strong>tombol salurakan zakat</strong>. itu akan menuju kehalaman mustahik. disana pengguna dapat menambahkan data mustahik</li>
                    <li>untuk menambahkan data mustahik pengguna dapat mengklik <strong>tombol mustahik</strong>. yang menuju ke halaman buat data mustahik</li>
                    <li>Terdapat beberapa form yang harus diisi yaitu nama, tanggal, status, dan alamat. jika berhasil data akan masuk pada tabel mustahik</li>
                    <li>pengguna dapat melakukan ubah data dan hapus data.</li>
                  </ol>
                </div>
              </div>
            </div>
            {{-- sepuluh --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseThree">
                  Bagaimana cara membuat program qurban ?
                </button>
              </h2>
              <div id="collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Membuat program qurban caranya hampir sama dengan membuat program pada fitur lainnya. tetapi berbeda ketika mengisi sebuah data form untuk membuat program qurban</p>
                </div>
              </div>
            </div>
            {{-- sebelas --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseThree">
                  Bagaimana cara membuat data Shohibul qurban?
                </button>
              </h2>
              <div id="collapseEleven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Shohibul qurban merupakan seseorang yang berqurban dengan hewan tertentu. pada aplikasi ini dapat mengolah data shohibul serta pengurutan dalam memotong hewan qurban. berikut langkah-langka dalam membuat data shohibuk qurban</p>
                  <ol>
                    <li>Untuk masuk ke halaman shohibul, caranya hampir sama dengan fitur lain yaitu mengklik <strong>tombol mata</strong></li>
                    <li>Jika berhasil masuk kehalaman shohibul qurban, pengguna dapat mengklik <strong>tombol Buat Shohibul Qurban</strong>. setelah itu akan dialikan ke halaman buat shohibul qurban.</li>
                    <li>Pada halaman buat shohibul qurban, pengguna harus mengsisi sebuah form yaitu nama, no telepon, metode qurban, jenis hewan, jumlah, dan alamat.</li>
                    <li>Jika berhasil data akan muncul pada tabel shohibul qurban diurutan pertama</li>
                  </ol>
                </div>
              </div>
            </div>
             {{-- duabelas --}}
             <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTweleve" aria-expanded="false" aria-controls="collapseThree">
                  Bagaimana mengubah data profil
                </button>
              </h2>
              <div id="collapseTweleve" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Untuk mengubah data profile, pengguna harus pergi ke navigasi yang berada di sebelah atas kanan. lalu klik <strong>setting</strong>, itu akan mengalikan ke halaman setting. setelah itu klik tombol <strong>Update Profile. kemudian ubah profile sesuai keinginan</strong></p>
                </div>
              </div>
            </div>
            {{-- tigabelas --}}
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThree">
                  Bagaimana cara mengubah password ?
                </button>
              </h2>
              <div id="collapseThirteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Mengubah password dapat dilakukan dengan mudah berikut langkah-langkah dalam mengubah password</p>
                  <ol>
                    <li>Pergi ke <strong>navigasi</strong> lalu klik tombol disebelah kanan atas yang ada <strong>nama pengguna</strong></li>
                    <li>Lalu pilih <strong>setting</strong>, setelah memasuki halaman setting. pengguna dapat mengklik <strong>update password</strong> itu akan menuju kehalaman ubah password.</li>
                    <li>pengguna harus mengisi password lama dan passwword baru, jika password lama tidak sesuai yang dimasuan makan akan gagal ubah password.</li>
                    <li>Pastikan password diisi dengan benar</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
@endsection
