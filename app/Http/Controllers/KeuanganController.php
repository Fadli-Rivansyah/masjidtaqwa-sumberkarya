<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\KeuanganRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class KeuanganController extends Controller
{
    public function index(Request $request)
    { 
        // summary
        //1. menghitung jumlah berdasarkan column jenis_data
        $pemasukan = Keuangan::where('jenis_data', 'pemasukan')->sum('jumlah_data');
        $pengeluaran = Keuangan::where('jenis_data', 'pengeluaran')->sum('jumlah_data');
        //2. menghitung saldo 
        $jumlahSaldo = $pemasukan - $pengeluaran;
        $saldo = number_format($jumlahSaldo, 2, ',', '.');
        // filter berdasarkan tanggal 
        // 1. mengambil data dari field filter tanggal_mulai
        $tanggalMulai = $request->tanggal_mulai;
        // 2. mengambil data dari field filter tanggal_selesai
        $tanggalSelesai = $request->tanggal_selesai;
        // 3.mengecek apakah bernilai null
        if($request->exists('tanggal_mulai') && $request->exists('tanggal_selesai')){
            // 4. menampilkan data berdasarkan tanggal_mulai dan tanggal_selesai
            $data = Keuangan::when($tanggalMulai && $tanggalSelesai, function ($query) use ($tanggalMulai, $tanggalSelesai) {
                return $query->whereDate('tanggal_data','>=', $tanggalMulai)->whereDate('tanggal_data','<=', $tanggalSelesai);
            })->paginate(12);
            //5. menampilkan data berdasarkan filter tanggal
            $dataExport = Keuangan::when($request->exists('tanggal_mulai') && $request->exists('tanggal_selesai'), function ($query) use ($tanggalMulai, $tanggalSelesai) {
                return $query->whereDate('tanggal_data','>=', $tanggalMulai)->whereDate('tanggal_data','<=', $tanggalSelesai);
            })->get();
            //6. menghitung data dari hasil filter
            $pemasukan = $data->where('jenis_data', 'pemasukan')->sum('jumlah_data');
            $pengeluaran = $data->where('jenis_data', 'pengeluaran')->sum('jumlah_data');
        }else{
            // 7. jika datanya tidak difilter
            $data = Keuangan::latest()->paginate(12);
            $dataExport = Keuangan::get();
        }
        // fitur search
        // 1. ambil nilai diari field input
        $keyword = $request->search;
        // 2. cek keyword apakah bernilai null atau tidak
        if (isset($keyword)){
            // 3. menemukan data berdasrkan column
            $data = Keuangan::where('tanggal_data', 'like', "%" . $keyword . "%")
            ->orWhere('jenis_data', 'like', "%" . $keyword . "%")
            ->orWhere('kategori_data', 'like', "%" . $keyword . "%")
            ->orWhere('jumlah_data', 'like', "%" . $keyword . "%")
            ->orWhere('keterangan', 'like', "%" . $keyword . "%")
            ->latest()->paginate(12); 
            // 4. menjumlahkan data pemasukan untuk summary
            $pemasukan = $data->where('jenis_data', 'pemasukan')->sum('jumlah_data');
            // 5. menjumlahkan data pengeluaran untuk summary
            $pengeluaran = $data->where('jenis_data', 'pengeluaran')->sum('jumlah_data');
        }
        return view('admin.keuangan.index', [
            'title' => 'Keuangan Masjid',
            'totalPemasukan' => $pemasukan,
            'totalPengeluaran' => $pengeluaran,
            'totalSaldo' => $saldo,
            'data' => $data,
            'dataExport'=> $dataExport,
            'countTransaksi' => Keuangan::count(),
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai
        ]);
    }
    // membuat data pemasukan dan pengeluaran
    public function createKeuangan()
    {
        // 1. menampilkan form membuat data pemasukan dan pengeluaran
        return view('admin.keuangan.createData',[
            "title" => "Membuat Data Pemasukan & Pengeluaran",
        ]);
    }
    // menyimpan data ke database
    public function storeKeuangan(KeuanganRequest $request)
    {
        // 1. validasi form
        $validatedData = $request->validated();
            // 2. membuat pengkondisian kesalahan pada form
            $pemasukan = ['infaq', 'sedekah', 'waqaf'];
            $pengeluaran = ['biaya perlengkapan kantor', 'biaya pengurus masjid', 'biaya pemeliharaan bangunan', 'biaya lainnya'];
            // 4. jika data tidak sesuai dengan select antara kategori dan jenis data
            if($validatedData['jenis_data'] == 'pengeluaran' && in_array($validatedData['kategori_data'],$pemasukan) || $validatedData['jenis_data'] == 'pemasukan' && in_array($validatedData['kategori_data'],$pengeluaran)){
                // 5. meredirect kehalaman form jika terjadi error
                return redirect()->back()->withErrors(['jenis_data' => 'jenis transaksi harus sesuai dengan kategori transaksi']);
            }else{
                // 6. simpan ke database
                Keuangan::create([
                    'tanggal_data'=>$validatedData['tanggal_data'],
                    'jenis_data'=>$validatedData['jenis_data'],
                    'kategori_data' => $validatedData['kategori_data'],
                    'jumlah_data' => $validatedData['jumlah_data'],
                    'keterangan' => $validatedData['keterangan'],
                ]);
                // 7. meredirect kehalaman utama fitur keuangan
                return redirect()->route('keuangan')->with('success', 'Berhasil ditambahkan!');   
            }
    }
    // menngubah data pemasukan dan pengeluaran
    public function editKeuangan($id)
    {
        // 1. menemukan id pada data keuangan
        $data = Keuangan::find($id);
        // 2. tampilkan halaman
        return view('admin.keuangan.editData',[
            "title" => "Edit Permasukan & Pengeluaran",
            "data" => $data
        ]);
    }
    //simpan data keuangan ke DB
    public function updateKeuangan(KeuanganRequest $request)
    {
        // 1. temukan data keuangan berdasarkan request id
        $transaksi = Keuangan::find($request->id);
        // 2. validas form
        $validatedData = $request->validated();
        // 3. membuat pengkodisian sesuai pemasukan dan pengeluaran
        $pemasukan = ['infaq', 'sedekah', 'waqaf'];
        $pengeluaran = ['biaya perlengkapan kantor', 'biaya pengurus masjid', 'biaya pemeliharaan bangunan', 'biaya lainnya'];
        if($validatedData['jenis_data'] == 'pengeluaran' && in_array($validatedData['kategori_data'],$pemasukan) || $validatedData['jenis_data'] == 'pemasukan' && in_array($validatedData['kategori_data'],$pengeluaran)){
            return redirect()->back()->withErrors(['jenis_data' => 'jenis transaksi harus sesuai dengan kategori transaksi']);
        }else{
            // 4. update data
            $transaksi->update([
                'tanggal_data'=>$validatedData['tanggal_data'],
                'jenis_data'=>$validatedData['jenis_data'],
                'kategori_data' => $validatedData['kategori_data'],
                'jumlah_data' => $validatedData['jumlah_data'],
                'keterangan' => $validatedData['keterangan'],
            ]);
            // 5. redirect kehalaman utama keuangan
            return redirect()->route('keuangan')->with('success', 'Berhasil diubah!');   
        }
    }
    // delete transaksi
    public function deleteKeuangan(Request $request)
    {
        Keuangan::destroy($request->id);
        return redirect()->route('keuangan')->with('success', 'Berhasil dihapus!');
    }
    // mengelolah data unduhan 
    public function reportPDF(Request $request)
    {
        // 1. ambil data request
        $data =$request->data;
        $pemasukan = $request->total_pemasukan;
        $pengeluaran = $request->total_pengeluaran;
        // 2. mengubah string menjadi array objek
        $data = json_decode($data);
        // 3. mengambil tanggal awal dan mengubah angka menjadi nama bulan
        $awalTransaksi = date('d F Y', strtotime($data[0]->tanggal_data));
        // 4. mengambil tahun pada tanggal awal
        $tahunAwal = date('Y', strtotime($data[0]->tanggal_data));
        $tahunAkhir = date('Y', strtotime($data[count($data) - 1]->tanggal_data));
        // 5. mengambil tanggal akhir
        $akhirTransaksi = date('d F Y', strtotime($data[count($data) - 1]->tanggal_data));
        // 6. mengubah ke format rupiah
        $totalPemasukan = number_format($pemasukan, 2, ',', '.');
        $totalPengeluaran = number_format($pengeluaran, 2, ',', '.');
        // 7. menghitung saldo
        $saldo = $pemasukan - $pengeluaran;
        $pdf = Pdf::loadView('admin.keuangan.reportPDF', [
            'title' => 'laporan keuangan',
            'dataExport' => $data ,
            'awalTransaksi' => $awalTransaksi,
            'akhirTransaksi' => $akhirTransaksi,
            'tahunAwal' => $tahunAwal,
            'tahunAkhir' => $tahunAkhir,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => number_format($saldo, 2, ',', '.')
        ]);
        return $pdf->download('laporan-keuangan.pdf');
    }
}
 