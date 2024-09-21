<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthInfaqMasjidController extends Controller
{
    protected $chart;
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    } 
    public function build()
    {
        $hasilPemasukan = [];
        $hasilPengeluaran = [];
    // Loop dari bulan 1 hingga 12
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            // Query untuk mengambil data untuk bulan tertentu
            $pemasukan = Keuangan::where('jenis_data','pemasukan')->whereMonth('tanggal_data', $bulan)->sum('jumlah_data');
            $pengeluaran = Keuangan::where('jenis_data','pengeluaran')->whereMonth('tanggal_data', $bulan)->sum('jumlah_data');
            // Menambahkan data dari bulan tersebut ke dalam array hasil
            $hasilPemasukan[] =$pemasukan ;
            $hasilPengeluaran[] =$pengeluaran;
        }
        // Menggunakan nama bulan sebagai label di sumbu X
        $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return $this->chart->lineChart()
            ->setTitle('Keuangan Bulanan')
            ->setSubtitle('Jumlah Keuangan')
            ->addData('Total Pemasukan', $hasilPemasukan)
            ->addData('Total Pengeluaran', $hasilPengeluaran)
            ->setXAxis($namaBulan)
            ->setColors(['#1DA599', '#b93f54'])
            ->setGrid(false, '#1da599', 0.1)
            ->setMarkers(['#1da599', '#b93f54'], 7, 10);
    }
}
