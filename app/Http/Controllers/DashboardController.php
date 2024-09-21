<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\Program;
use App\Models\Zakat;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    // menampilkan chart, data bulanan, dan setipa data yang masuk
    public function index(MonthInfaqMasjidController $chart)
    {
        // 1. menghitung data jumlah setiap pemasukan dan pengeluaran
        $pemasukan = Keuangan::where('jenis_data','pemasukan')->sum('jumlah_data');
        $pengeluaran = Keuangan::where('jenis_data','pengeluaran')->sum('jumlah_data');
        // 2. menghitung saldo
        $saldo = $pemasukan - $pengeluaran;
        // menampilkan data baru ke paling atas
        $dataTransaksi = Keuangan::latest()->limit(8)->get();
        //  menampilkan data bulanan
        // 1. temukan data paling awal 
        $akhirTransaksi = Keuangan::latest()->first();
        // 2. cek apakah data bernilai null
        if(isset($akhirTransaksi)){
            // 3. jika tidak ubah ke format nama bulan
            $bulan = date('m',strtotime($akhirTransaksi->tanggal_data));
        }else{
            $bulan = [];
        }
        // menampilkan data bulanan dan jumlah transaksi
        // 1.menghitung pemasukan dan pengeluaran
        $pemasukanBulanIni = Keuangan::whereMonth('tanggal_data', $bulan)->where('jenis_data','pemasukan')->sum('jumlah_data');
        $pengeluaranBulanIni = Keuangan::whereMonth('tanggal_data', $bulan)->where('jenis_data','pengeluaran')->sum('jumlah_data');
        // 2. menghitung berapa banyak jumlah data
        $jumlahTransaksi = Keuangan::whereMonth('tanggal_data', $bulan)->count();
        // 
        $transaksi = Keuangan::get();
        // 3. Ubah format tanggal menjadi nama bulan
        $saldoBulanan = $transaksi->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_data)->format('F Y');
        })->map(function ($group) {
            // 4. Menghitung jumlah dari nilai pada setiap kelompok
            $pemasukan = $group->where('jenis_data','pemasukan')->sum('jumlah_data');
            $pengeluaran = $group->where('jenis_data','pengeluaran')->sum('jumlah_data');
            // 5. menghitung pendapatan
            $saldo = $pemasukan - $pengeluaran;
            return [
                'saldo' => $saldo,
                'pemasukanBulanan' => $pemasukan,
                'pengeluaranBulanan' => $pengeluaran
            ];
        });
        return view('admin.dashboard.index', [
            'title' => 'Dashboard',
            'totalSaldo' => $saldo,
            'chart' => $chart->build(),
            'dataTransaksi' => $dataTransaksi,
            'pemasukanBulanIni' => $pemasukanBulanIni,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'jumlahTransaksiBulanIni' => $jumlahTransaksi,
            'bulanan' => $saldoBulanan
        ]);
    }
    // menghapus data bulanan pada halama dahsboard
    public function deleteBulan(Request $request)
    {
        $month = $request->data_bulan;
        $angka = \Carbon\Carbon::parse($month)->format('m');
        // 1. mendelete bulanan
        $delete = Keuangan::whereMonth('tanggal_data',$angka)->delete();
        return redirect()->route('dashboard');
    }
    // mengexport data bulanan ke format pdf
    public function exportBulanan()
    {
        // 1. mengambil semua data keuangan
        $transaksi = Keuangan::get();
        // 2. Ubah format tanggal menjadi nama bulan
        $saldoBulanan = $transaksi->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_data)->format('F Y');
        })->map(function ($group) {
            // 3. Menghitung jumlah dari nilai pada pemasukan dan pengeluaran
            $pemasukan = $group->where('jenis_data','pemasukan')->sum('jumlah_data');
            $pengeluaran = $group->where('jenis_data','pengeluaran')->sum('jumlah_data');
            // 4. menghitung saldo 
            $saldo = $pemasukan - $pengeluaran;
            return [
                'saldo' => $saldo,
                'pemasukanBulanan' => $pemasukan,
                'pengeluaranBulanan' => $pengeluaran,
            ];
        });
        $pdf = Pdf::loadView('admin.dashboard.reportBulanan', [
            'title' => 'Laporan Bulanan',
            'bulanan' => $saldoBulanan,
            'totalSaldo' => $saldoBulanan->sum('saldo'),
            'awalTransaksi' => Keuangan::first(),
            'akhirTransaksi' => Keuangan::latest()->first(),
        ]);
        return $pdf->download('laporan-bulanan-keuangan.pdf');
    }
}
