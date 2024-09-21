<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\Zakat;
use App\Models\JamaahProgram;
use App\Models\Program;
use App\Models\Qurban;

class PublikController extends Controller
{
    public function index()
    {
        // menampilkan data keuangan bulanan pada halaman home
        // 1. ambil data keuangan
        $transaksi = Keuangan::get();
        // 2. Ubah format tanggal menjadi nama bulan
        $saldoBulanan = $transaksi->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal_data)->format('F Y');
        })->map(function ($group) {
            // 3. Menghitung jumlah dari nilai pada setiap pemasukan dan pengealuran
            $pemasukan = $group->where('jenis_data','pemasukan')->sum('jumlah_data');
            $pengeluaran = $group->where('jenis_data','pengeluaran')->sum('jumlah_data');
            // 4. menghitung saldo
            $saldo = $pemasukan - $pengeluaran;
            return [
                'saldo' => $saldo,
                'pemasukanBulanan' => $pemasukan,
                'pengeluaranBulanan' => $pengeluaran
            ];
        });
        return view('index', [
            'title' => 'masjid taqwa',
            'bulanan' => $saldoBulanan
        ]);
    }
    // halaman publik keuangan
    public function pageKeuangan()
    {
        // sub menu keuangan => menampilkan data keuangan 
        // 1. menjumlahkan pemasukan dan pengeluaran
        $pemasukan = Keuangan::where('jenis_data','pemasukan')->sum('jumlah_data');
        $pengeluaran = Keuangan::where('jenis_data','pengeluaran')->sum('jumlah_data');
        // 2. menghitung saldo
        $saldo = $pemasukan - $pengeluaran;
        // sub menu GAS(Gerakan Amal Sholeh)
        // 1. mengambil data prgram dengan status belum selesai
        $program = Program::where('status', 'belum selesai')->get();
        // 2. jika kondisi program bernilai kosong
        if($program->isEmpty()){
            $findProgram = [];
            $datajamaah = [];
            $jumlahJamaah = 0;
            $danaProgramTerkumpul = 0;      
        }else {
            // 3. jika nilai program tidak bernilai konsong
            $findProgram = Program::find($program->first()->id);
            $datajamaah = $findProgram->jamaah()->latest()->get();
            $danaProgramTerkumpul = $findProgram->jamaah()->where('status','lunas')->sum('jumlah');
            $jumlahJamaah = $findProgram->jamaah()->count();
        }
        // mengelolah submenu zakat
        // 1. mengambil data program dengan status masih dibuka
        $zakat = Zakat::where('status', 'dibuka')->get();
        // 2. membuat nilai kosong agar sistem tau bahwa berisi tipe data
        $findZakat = '';
        $dataMuzakki = [];
        $dataMustahik = [];
        $jumlahMuzakki =[];
        $jumlahMustahik =[];
        // 3. looping data zakat
        foreach ($zakat as $item) {
            $findZakat = Zakat::find($item->id);
            $dataMuzakki = $findZakat->muzakki()->latest()->get();
            $dataMustahik = $findZakat->mustahik()->latest()->get();
            $jumlahMuzakki = $findZakat->muzakki()->count();
            $jumlahMustahik = $findZakat->mustahik()->count();
        }
        // mengolah submenu qurban
        // 1. mengambil data prgram qurban dengan status dibuka
        $qurban = Qurban::where('status', 'dibuka')->get();
        // 2. agar tidak error harus berisi tipe data sebagai penampung data
        if($qurban->isEmpty()){
            $shohibul = [];
            $findQurban = [];
            $patunganLembu=[];
            $mandiriLembu=[];
            $mandiriKambing=[];
            $danaQurban = [];
            $jumlahShohibul = [];
            $patunganLembu = [];
        }else {
            // 3. melakukan lopping data qurban
            foreach ($qurban as $item) {
                $findQurban = Qurban::find($item->id);
                $shohibul = $findQurban->pesertaQurban()->latest()->get();
                $patunganLembu = $findQurban->pesertaQurban()->where('metode_qurban','patungan')->where('jenis_hewan','lembu')->get();
                $mandiriLembu = $findQurban->pesertaQurban()->where('metode_qurban','mandiri')->where('jenis_hewan','lembu')->get();
                $mandiriKambing = $findQurban->pesertaQurban()->where('metode_qurban','mandiri')->where('jenis_hewan','kambing')->get();
                $danaQurban = $findQurban->pesertaQurban()->sum('jumlah');
                $jumlahShohibul = $findQurban->pesertaQurban()->count();
                $patunganLembu = $patunganLembu->chunk(7);
            }
        }
        return view('keuangan',[
            'title' => 'keuangan',
            'saldo' => $saldo,
            'dataInfaq' => Keuangan::latest()->get(),
            'jumlahTransaksi' => Keuangan::count(),
            'dataJamaah' => $datajamaah,
            'dataProgram' => $findProgram,
            'jumlahPartisipan'=>$jumlahJamaah,
            'danaProgramTerkumpul' => $danaProgramTerkumpul,
            'dataMuzakki' => $dataMuzakki,
            'dataMustahik' => $dataMustahik,
            'dataZakat' => $findZakat,
            'jumlahMuzakki' => $jumlahMuzakki,
            'jumlahMustahik' => $jumlahMustahik,
            'dataQurban' => $findQurban,
            'danaQurban' => $danaQurban,
            'jumlahShohibul' => $jumlahShohibul,
            'dataPatunganLembu' => $patunganLembu,
            'dataMandiriLembu' => $mandiriLembu,
            'dataMandiriKambing' => $mandiriKambing
        ]);
    }
    // menampilkan program dan layanan pada halaman publik
    public function pageProgramLayanan()
    {
        return view('program&layanan', [
            'title' => 'program & layanan'
        ]);
    }
}
