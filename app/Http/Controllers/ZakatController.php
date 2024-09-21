<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zakat;
use App\Http\Requests\ZakatRequest;
use App\Http\Requests\MuzakkiRequest;
use App\Http\Requests\MustahikRequest;
use App\Models\Muzakki;
use App\Models\Mustahik;
use Barryvdh\DomPDF\Facade\Pdf;
use \go2hi\go2hi;

class ZakatController extends Controller
{
    public function index()
    {
        $totalBeras = 0;
        $totalUang = 0;
        $dataMuzakki =0;
        $dataMustahik=0;
        $dataZakat = Zakat::latest()->paginate(10);
        $berlangsung = Zakat::where('status', 'dibuka')->count();
        // fitur penutupan zakat
        foreach($dataZakat as $zakat){
            $zakat = Zakat::find($zakat->id);
            $status =[
                'status' => 'selesai'
            ];
            if (date(now()) > date($zakat->tanggal_penutupan)){
                Zakat::where('id', $zakat->id)->update($status);
            } elseif ($zakat->status == 'dibuka' ){
                $dataMuzakki = $zakat->muzakki()->sum('jumlah_orang');
                $dataMustahik = $zakat->mustahik()->count();
                $totalBeras = $zakat->muzakki()->where('kategori', 'beras')->sum('jumlah');
                $totalUang = $zakat->muzakki()->where('kategori', 'uang')->sum('jumlah');
            }
        }
        // if(isset($zakat)){
        //     $zakat = go2hi::date('d F Y', go2hi::GO2HI_HIJRI, strtotime($zakat->tanggal_pembukaan));
        // }else{
        //     $zakat = go2hi::date('d F Y', go2hi::GO2HI_HIJRI, strtotime(now()));
        // }
        // $zakat = $zakat;
        return view('admin.zakat.index', [
            'title' => 'Zakat',
            'dataZakat' => $dataZakat,
            'totalBeras' => $totalBeras,
            'totalUang' => $totalUang,
            'dataMuzakki'=> $dataMuzakki,
            'dataMustahik'=> $dataMustahik,
            'berlangsung' => $berlangsung
        ]);
    }
    // menampilkan form buat program zakat
    public function createZakat()
    {
        return view('admin.zakat.createZakat', [
            'title' => 'Create Zakat',
        ]);
    }
    //menyimpan data zakat
    public function storeZakat(ZakatRequest $request)
    {
        $validatedData = $request->validated();
        $data = [
            'tahun_ramadhan' => $validatedData['tahun_ramadhan'],
            'tanggal_pembukaan' => $validatedData['tanggal_pembukaan'],
            'tanggal_penutupan' => $validatedData['tanggal_penutupan'],
            'status' => $validatedData['status'],
            'keterangan' => $validatedData['keterangan'],
        ];
        Zakat::create($data);
        return redirect()->route('zakat')->with('success', 'Zakat berhasil ditambahkan!'); 
    }
    // membuat edit zakat
    public function editZakat($id)
    {
        $dataZakat = Zakat::find($id);
        return view('admin.zakat.editZakat',[
            'title' => 'Edit Zakat',
            'dataZakat' => $dataZakat
        ]);
    }
    // mengupdate data zakat
    public function updateZakat(ZakatRequest $request)
    {
        $validatedData = $request->validated();
        $data = [
            'tahun_ramadhan' => $validatedData['tahun_ramadhan'],
            'tanggal_pembukaan' => $validatedData['tanggal_pembukaan'],
            'tanggal_penutupan' => $validatedData['tanggal_penutupan'],
            'status' => $validatedData['status'],
            'keterangan' => $validatedData['keterangan'],
        ];
        Zakat::where('id', $request->id_zakat)->update($data);
        return redirect()->route('zakat')->with('success', 'Zakat berhasil diubah'); 
    }
    // delete data zakat
    public function deleteZakat($id)
    {
        $zakat = Zakat::find($id);
        $zakat->muzakki()->delete();
        $zakat->mustahik()->delete();
        Zakat::destroy($id);
        return redirect()->route('zakat')->with('success', 'Zakat Berhasil Dihapus'); 
    }
    //menampilkan data program zakat
    public function viewZakat(Request $request, $id)
    {
        $zakat = Zakat::find($id);
        $dataMuzakki = $zakat->muzakki()->latest()->paginate(10);
        $totalBeras = $zakat->muzakki()->where('kategori', 'beras')->sum('jumlah');
        $totalUang = $zakat->muzakki()->where('kategori', 'uang')->sum('jumlah');
        // fitur pencarian
        $keyword = $request->get('search_muzakki');
        if(isset($keyword)){
            $dataMuzakki = $zakat->muzakki()->where('nama_program', 'like', "%" . $keyword . "%")
            ->orWhere('nama', 'like', "%" . $keyword . "%")
            ->orWhere('no_telepon', 'like', "%" . $keyword . "%")
            ->orWhere('jumlah_orang', 'like', "%" . $keyword . "%")
            ->orWhere('kategori', 'like', "%" . $keyword . "%")
            ->orWhere('jumlah', 'like', "%" . $keyword . "%")
            ->paginate(10); 
        }else{
            $dataMuzakki = $zakat->muzakki()->latest()->paginate(10);
        }
        return view('admin.zakat.viewZakat', [
            'title' => 'view zakat',
            'viewZakat' => $zakat,
            'dataMuzakki' => $dataMuzakki,
            'tanggal' => $zakat->tahun_ramadhan,
            'totalMuzakki' =>  $zakat->muzakki()->sum('jumlah_orang'),
            'totalMustahik' => $zakat->mustahik()->count(),
            'totalBeras'=> $totalBeras,
            'totalUang' => $totalUang
        ]);
    }
    // form create muzakki
    public function createMuzakki($id)
    {
        return view('admin.zakat.createMuzakki', [
            'title' => 'create muzakki',
            'viewId' => $id,
        ]);
    }
    // simpan data muzakki ke DB
    public function storeMuzakki(MuzakkiRequest $request,$id)
    {
        $dataZakat = Zakat::find($id);        
        $validatedData = $request->validated();
        $data = [
            'zakat_id' => $dataZakat->id,
            'nama' => $validatedData['nama_muzakki'],
            'no_telepon' => $validatedData['telepon_muzakki'],
            'tanggal' => $validatedData['tanggal_muzakki'],
            'jumlah_orang' => $validatedData['jumlah_muzakki'],
            'kategori' => $validatedData['kategori_muzakki'],
            'jumlah' => $validatedData['jumlah_zakat'],
        ];
        $dataZakat = Zakat::find($id);
        Muzakki::create($data);

        return redirect('/admin/zakat/'. $dataZakat->id . '/view')->with('success', 'Berhasil ditambahkan!');
    }
    // form create edit muzakki
    public function editMuzakki($id, $idMuzakki)
    {
        $dataMuzakki = Muzakki::find($idMuzakki);
        return view('admin.zakat.editMuzakki', [
            'title' => 'editMuzakki',
            'dataMuzakki' => $dataMuzakki,
            'idZakat' => $id
        ]);
    }
    // update data muzakki
    public function updateMuzakki(MuzakkiRequest $request, $id)
    {
        $dataZakat = Zakat::find($id);        
        $validatedData = $request->validated();
        $data = [
            'zakat_id' => $dataZakat->id,
            'nama' => $validatedData['nama_muzakki'],
            'no_telepon' => $validatedData['telepon_muzakki'],
            'tanggal' => $validatedData['tanggal_muzakki'],
            'jumlah_orang' => $validatedData['jumlah_muzakki'],
            'kategori' => $validatedData['kategori_muzakki'],
            'jumlah' => $validatedData['jumlah_zakat'],
        ];
        Muzakki::where('id', $request->idMuzakki)->update($data);
        return redirect('/admin/zakat/'. $dataZakat->id . '/view')->with('success', 'Berhasil diubah!');
    }
    // menghapus data muzakki
    public function deleteMuzakki($id, $idMuzakki)
    {
        $dataMuzakki = Muzakki::find($idMuzakki);
        Muzakki::destroy($idMuzakki);
        return redirect('/admin/zakat/'. $id .'/view')->with('success', ''. $dataMuzakki->nama . ' berhasil dihapus!');
    }
    //view penyaluran zakat
    public function salurZakat(Request $request, $id)
    {
        $zakat = Zakat::find($id);
        $dataMustahik = $zakat->mustahik()->latest()->paginate(10);
        $keyword = $request->get('search_mustahik');
        if(!empty($keyword)){
            $dataMustahik = $zakat->mustahik()->where('nama', 'like', "%" . $keyword . "%")
            ->orWhere('tanggal', 'like', "%" . $keyword . "%")
            ->orWhere('no_telepon', 'like', "%" . $keyword . "%")
            ->orWhere('jenis_asnaf', 'like', "%" . $keyword . "%")
            ->orWhere('alamat', 'like', "%" . $keyword . "%")
            ->latest()->paginate(10); 
        }else{
            $dataMustahik = $zakat->mustahik()->latest()->paginate(10);
        }
        return view('admin.zakat.salurZakat', [
            'title' => 'salur zakat',
            'idZakat'=> $id,
            'totalMustahik' => $zakat->mustahik()->count(),
            'dataMustahik' => $dataMustahik,
            'tanggal' => $zakat->tahun_ramadhan
        ]);
    }
    // form create mustahik
    public function createMustahik($id)
    {
        return view('admin.zakat.createMustahik', [
            'title' =>  'create mustahik',
            'idZakat' => $id,
        ]);
    }
    // save data mustahik
    public function storeMustahik(MustahikRequest $request, $id)
    {
        $validatedData = $request->validated();   
        $data = [
            'zakat_id' => $id,
            'nama' => $validatedData['nama_mustahik'],
            'tanggal' => $validatedData['tanggal_mustahik'],
            'no_telepon' => $validatedData['telepon_mustahik'],
            'alamat' => $validatedData['alamat_mustahik'],
            'jenis_asnaf' => $validatedData['jenis_asnaf']
        ];
        Mustahik::create($data);
        return redirect('admin/zakat/'. $id .'/view/salurZakat')->with('success', '' . $request->nama . ' berhasil di tambahkan!');   
    }
    // view form for edit data musthaik
    public function editMustahik($id, $idMustahik)
    {
        $mustahik = Mustahik::find($idMustahik);
        return view('admin.zakat.editMustahik', [
            'title' => 'Edit Mustahik',
            'dataMustahik' => $mustahik,
            'idZakat' => $id
        ]);
    }
    // update data mustahik
    public function updateMustahik(MustahikRequest $request, $id)
    {
        $validatedData = $request->validated();   
        $data = [
            'zakat_id' => $id,
            'nama' => $validatedData['nama_mustahik'],
            'tanggal' => $validatedData['tanggal_mustahik'],
            'no_telepon' => $validatedData['telepon_mustahik'],
            'alamat' => $validatedData['alamat_mustahik'],
            'jenis_asnaf' => $validatedData['jenis_asnaf']
        ];
        Mustahik::where('id', $request->idMustahik)->update($data);
        
        return redirect('/admin/zakat/'. $id .'/view/salurZakat')->with('success', '' . $request->nama . ' berhasil di tambahkan!');   
    }
    // delete data mustahik
    public function deleteMustahik($id, $idMustahik)
    {
        $dataMustahik = Mustahik::find($idMustahik);
        Mustahik::destroy($idMustahik);
        return redirect('/admin/zakat/'. $id .'/view/salurZakat')->with('success', ''. $dataMustahik->nama . ' berhasil dihapus!');
    }
    // membuat laporan pdf muzakki
    public function reportMuzakki($id)
    {
        $zakat = Zakat::find($id);
        $dataMuzakki = $zakat->muzakki();
        $pdf = Pdf::loadView('admin.zakat.reportMuzakki', [
            'dataMuzakki' => $dataMuzakki->latest()->get(),
            'tanggal' => $zakat->tahun_ramadhan,
            'totalZakatUang' =>$zakat->muzakki()->where('kategori', 'uang')->sum('jumlah'),
            'totalZakatBeras' => $zakat->muzakki()->where('kategori', 'beras')->sum('jumlah'),
            'jumlahMuzakki' => $zakat->muzakki()->sum('jumlah_orang')
        ]);
        return $pdf->download('laporan-muzakki.pdf');
    }
    // membuat laporan pdf mustahik
    public function reportMustahik($id)
    {
        $zakat = Zakat::find($id);
        $dataMustahik = $zakat->mustahik();
        $pdf = Pdf::loadView('admin.zakat.reportMustahik', [
            'title' => 'laporan mustahik',
            'dataMustahik' => $dataMustahik->latest()->get(),
            'totalMustahik' => $dataMustahik->count(),
            'tanggal' => $zakat->tahun_ramadhan
        ]);
        return $pdf->download('laporan-mustahik.pdf');
    }
}