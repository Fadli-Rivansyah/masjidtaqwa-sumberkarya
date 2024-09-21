<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qurban;
use App\Http\Requests\QurbanRequest;
use App\Http\Requests\ShohibulqurbanRequest;
use App\Models\ShohibulQurban;
use \go2hi\go2hi;
use Barryvdh\DomPDF\Facade\Pdf;

class QurbanController extends Controller
{
    public function index(Request $request)
    {
        // menampilkan data baru menjadi data pertama
        $qurban = Qurban::latest()->paginate(10);
        // menghitung program qurban
        $berlangsung = Qurban::where('status', 'dibuka')->count();
        //fitur penutupan qurban 'selesai'
        // 1. looping data qurban
        foreach($qurban as $item){
            // 2. ambil data qurban berdasarkan id
            $ambilQurban = Qurban::find($item->id);
            // 3. ubah status menjadi selesai jika melewati waktu sekarang
            if (date(now()) > date($ambilQurban->tanggal_penutupan)){
                $status = [
                    'status' => 'selesai'
                ];
                // 4. simpan dan update ke database
                Qurban::where('id', $ambilQurban->id)->update($status);
            }
        }
        //fitur search qurban
        // 1. ambil nilai dari field input
        $keyword = $request->get('search_qurban');
        // 2. cek apakah bernilai null
        if(isset($keyword)){
            $qurban = Qurban::where('tahun_qurban', 'like', "%" . $keyword . "%")
            ->orWhere('tanggal_pembukaan', 'like', "%" . $keyword . "%")
            ->orWhere('tanggal_penutupan', 'like', "%" . $keyword . "%")
            ->orWhere('status', 'like', "%" . $keyword . "%")
            ->orWhere('keterangan', 'like', "%" . $keyword . "%")
            ->latest()->paginate(10); 
        }else{
            $qurban = $qurban;
        }
        // 3. tampilkan data
        return view('admin.qurban.index', [
            'title' => 'Qurban',
            'dataQurban' => $qurban,
            'berlangsung' => $berlangsung
        ]);
    }
    // create with form program qurban
    public function createQurban()
    {
        return view('admin.qurban.createQurban', [
            'title' => 'create qurban',
        ]);
    }
    // save data qurban
    public function storeQurban(QurbanRequest $request)
    {
        // 1. validasi form
        $validatedData = $request->validated();
        // 2. simpan data berdasarkan column tabel
         $data = [
                'tahun_qurban' => $validatedData['tahun_qurban'],
                'tanggal_pembukaan' => $validatedData['tanggal_pembukaan'],
                'tanggal_penutupan' => $validatedData['tanggal_penutupan'],
                'status' => $validatedData['status'],
                'keterangan' => $validatedData['keterangan']
            ];
        // 3. simpan data ke database
        Qurban::create($data);
        // 4. redirect ke halaman qurban dengan pesan 
        return redirect()->route('qurban')->with('success', 'Program qurban telah di tambahkan!');
    }
    // view edit form qurban
    public function editQurban($id)
    {
        // 1. temukan data berdasarkan id program qurban
        $qurban = Qurban::find($id);
        // 2. tampilkan data
        return view('admin.qurban.editQurban', [
            'title' => 'Edit program qurban',
            'dataQurban' => $qurban
        ]);
    }
    // update data program qurban
    public function updateQurban(QurbanRequest $request)
    {   
        // 1. validasi form
        $validatedData = $request->validated();
        // 2. simpan data berdasrkan column tabel
        $data = [
            'tahun_qurban' => $request->tahun_qurban,
            'tanggal_pembukaan' => $request->tanggal_pembukaan,
            'tanggal_penutupan' => $request->tanggal_penutupan,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ];
        // 3. ambil data berdasarkan id
        $qurban = Qurban::find($request->idQurban);
        // 4. simpan dan update data 
        Qurban::where('id', $request->idQurban)->update($data);
        // 5. redirect ke halaman utama qurban
        return redirect()->route('qurban')->with('success', 'Program qurban telah diubah!');
    }
    // hapus program qurban
    public function deleteQurban($id)
    {
        // 1. ambil data bedasarkan id
        $qurban = Qurban::find($id);
        // 2. hapus shohibul qurban
        $qurban->pesertaQurban()->delete();
        // 3. hapus program qurban
        $qurban->delete();
        // 4. redirect kehalaman utama qurban
        return redirect()->route('qurban')->with('success', 'Program telah di hapus!');
    }
    // view data qurban -> shohibul qurban
    public function viewQurban(Request $request, $id)
    {
        $qurban = Qurban::find($id);
        // menghitung qurban metode patungan
        $patunganLembu =  $qurban->pesertaQurban()->where('metode_qurban','patungan')->where('jenis_hewan','lembu')->get();
        $totalPL = $patunganLembu->count() / 7;
        // menghitung qurban metode mandiri
        $mandiriLembu = $qurban->pesertaQurban()->where('metode_qurban','mandiri')->where('jenis_hewan','lembu')->get();
        $mandiriKambing = $qurban->pesertaQurban()->where('metode_qurban','mandiri')->where('jenis_hewan','kambing')->get();
        // total lembu
        $totalLembu = ceil($totalPL) + $mandiriLembu->count() ;
        // fitur search shohibul
        $keyword = $request->get('search_shohibul');
        if(isset($keyword)){
            $dataShohibul = $qurban->pesertaQurban()->where('nama', 'like', "%" . $keyword . "%")
            ->orWhere('no_telepon', 'like', "%" . $keyword . "%")
            ->orWhere('metode_qurban', 'like', "%" . $keyword . "%")
            ->orWhere('jenis_hewan', 'like', "%" . $keyword . "%")
            ->orWhere('jumlah', 'like', "%" . $keyword . "%")
            ->orWhere('alamat', 'like', "%" . $keyword . "%")
            ->latest()->paginate(10); 
        }else{
            $dataShohibul = $qurban->pesertaQurban()->latest()->paginate(10);
        }
        return view('admin.qurban.viewQurban',[
            'title' => 'view qurban',
            'qurban' => $qurban,
            'idQurban' => $id,
            'dataShohibul' => $dataShohibul,
            'totalLembu' => $totalLembu,
            'totalKambing' => $mandiriKambing->count(),
            'totalHewan' => $totalLembu + $mandiriKambing->count(),
            'totalShohibul' => $qurban->pesertaQurban()->count(),
            'jumlahDana' => $qurban->pesertaQurban()->sum('jumlah'),
        ]);
    }
    // create a data Shohibul qurban
    public function createShohibul($id)
    {
        return view('admin.qurban.createShohibul', [
            'title' => 'Create Shohibul',
            'idQurban' => $id
        ]);
    }
    //save data shohibul qurban
    public function storeShohibul(ShohibulqurbanRequest $request, $id)
    {
        $validatedData = $request->validated();
        // pesan error jika user memilih metode patungan untuk qurban kambing
        if($validatedData['metode_qurban'] == "patungan" && $validatedData['jenis_hewan'] == "kambing"){
            return redirect()->back()->withErrors(['jenis_hewan' => 'kambing tidak boleh patungan']);
        } else {
            ShohibulQurban::create([
                'qurban_id' => $id,
                'nama' => $validatedData['nama_shohibul'],
                'no_telepon' => $validatedData['telepon_shohibul'],
                'metode_qurban' => $validatedData['metode_qurban'],
                'jenis_hewan' => $validatedData['jenis_hewan'],
                'jumlah' => $validatedData['jumlah_dana'],
                'alamat' => $validatedData['alamat_shohibul']
            ]);
            return redirect('/admin/qurban/'. $id .'/viewQurban')->with('success', 'Shohibul qurban telah di tambahkan!');
        }
    }
    // form edit shohibul qurban
    public function editShohibul($id, $idShohibul)
    {
        $shohibul = ShohibulQurban::find($idShohibul);
        return view('admin.qurban.editShohibul', [
            'title' => 'edit shohibul',
            'dataShohibul' => $shohibul,
            'idQurban' => $id
        ]);
    }
    // update data shohibul qurban
    public function updateShohibul(ShohibulqurbanRequest $request, $id)
    {
        $shohibul = ShohibulQurban::find($request->idShohibul);
        $validatedData = $request->validated();
        // jika user memilik patungan untuk qurban kambing
        if($validatedData['metode_qurban'] == "patungan" && $validatedData['jenis_hewan'] == "kambing"){
            return redirect()->back()->withErrors(['jenis_hewan' => 'kambing tidak boleh patungan']);
        } else {
            $shohibul->update([
                'qurban_id' => $id,
                'nama' => $validatedData['nama_shohibul'],
                'no_telepon' => $validatedData['telepon_shohibul'],
                'metode_qurban' => $validatedData['metode_qurban'],
                'jenis_hewan' => $validatedData['jenis_hewan'],
                'jumlah' => $validatedData['jumlah_dana'],
                'alamat' => $validatedData['alamat_shohibul']
            ]);
            return redirect('/admin/qurban/'. $id .'/viewQurban')->with('success', 'Shohibul qurban telah diubah!');
        }
    }
    // delete shohibul qurban
    public function deleteShohibul($id, $idShohibul)
    {
        $shohibul = ShohibulQurban::find($idShohibul);
        $shohibul->delete();   
        return redirect('/admin/qurban/'. $id .'/viewQurban')->with('success', 'Shohibul qurban bernama '. $shohibul->nama .' berhasil di hapus!'); 
    }
    // create urutan qurban
    public function pengurutanShohibul($id)
    {
        $qurban = Qurban::find($id);
        $patunganLembu =  $qurban->pesertaQurban()->where('metode_qurban','patungan')->where('jenis_hewan','lembu')->get();
        $mandiriLembu = $qurban->pesertaQurban()->where('metode_qurban','mandiri')->where('jenis_hewan','lembu')->get();
        $mandiriKambing = $qurban->pesertaQurban()->where('metode_qurban','mandiri')->where('jenis_hewan','kambing')->get();
        return view('admin.qurban.pengurutan', [
            'title' => 'pengurutan',
            'idQurban' => $id,
            'patunganLembu' => $patunganLembu->chunk(7), 
            'mandiriLembu' => $mandiriLembu,
            'mandiriKambing' => $mandiriKambing,
        ]);
    }
    // export data shohibul qirban
    public function exportShohibul($id)
    {
        $qurban = Qurban::find($id);
        $patunganLembu =  $qurban->pesertaQurban()->where('metode_qurban','patungan')->where('jenis_hewan','lembu')->get();
        $mandiriLembu = $qurban->pesertaQurban()->where('metode_qurban','mandiri')->where('jenis_hewan','lembu')->get();
        $mandiriKambing = $qurban->pesertaQurban()->where('metode_qurban','mandiri')->where('jenis_hewan','kambing')->get();

        $pdf = Pdf::loadView('admin.qurban.reportQurban', [
            'title' => 'Laporan Qurban',
            'qurban' => $qurban,
            'idQurban' => $id,
            'patunganLembu' => $patunganLembu->chunk(7), 
            'mandiriLembu' => $mandiriLembu,
            'mandiriKambing' => $mandiriKambing,
            'jumlahShohibulPL' => $qurban->pesertaQurban()->where('metode_qurban','patungan')->where('jenis_hewan','lembu')->count(),
            'totalDana' => $qurban->pesertaQurban()->sum('jumlah'),
        ]);
        return $pdf->download('laporan-qurban.pdf');
    }
}