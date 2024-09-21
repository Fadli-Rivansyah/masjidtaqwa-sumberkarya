<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GasRequest;
use App\Http\Requests\ViewprogramGasRequest;
use App\Models\Program;
use App\Models\JamaahProgram;
use Barryvdh\DomPDF\Facade\Pdf;

class GasController extends Controller
{
    // page main
    public function index(Request $request)
    {
        $data = Program::latest()->paginate(10);
        $totalBerlangsung = Program::where('status','belum selesai')->count();
        // dd($totalBerlangsung);
        $totalSelesai = Program::where('status','selesai')->count();
        $keyword = $request->get('search_program');
        if(!empty($keyword)){
            $data = Program::where('nama_program', 'like', "%" . $keyword . "%")
            ->orWhere('tanggal', 'like', "%" . $keyword . "%")
            ->orWhere('kategori', 'like', "%" . $keyword . "%")
            ->orWhere('biaya', 'like', "%" . $keyword . "%")
            ->orWhere('status', 'like', "%" . $keyword . "%")
            ->orWhere('target', 'like', "%" . $keyword . "%")
            ->orWhere('keterangan_program', 'like', "%" . $keyword . "%")
            ->paginate(10); 
        }else{
            $data = Program::latest()->paginate(10);
        }
        return view('admin.gas.index', [
            'title' => 'GAS (Gerakan Amal Sholeh)',
            'dataProgram' => $data,
            'totalBerlangsung' => $totalBerlangsung,
            'totalSelesai' => $totalSelesai,
            'totalProgram' => $data->count()
        ]);
    }
    // form create program
    public function createProgram()
    {
        return view('admin.gas.createProgram',[
            'title' => 'Buat Program',
        ]);
    }
    // save data program
    public function storeProgram(GasRequest $request)
    {
        // 1. validasi data
        $validateData = $request->validated();
        $data = [
            'nama_program' => $validateData['nama_program'],
            'kategori' => $validateData['kategori_program'],
            'tanggal' => $validateData['tanggal_program'],
            'biaya' => $validateData['biaya_program'],
            'target' => $validateData['target_program'],
            'status' => 'belum selesai',
            'keterangan_program' => $validateData['keterangan_program']
        ];
        // 2. tambahkan data
        Program::create($data);
        // 3. arahkan ke halaman utama GAS dan tambahkab pesan sukses
        return redirect()->route('gas')->with('success', 'Berhasil ditambahkan!');   
    }
    // view form edit
    public function tampilanEditProgram($id)
    {
        // 1. temukan data berdasarkan $id dari parameter route
        $data = Program::find($id);
        return view('admin.gas.editProgram',[
            'title' => 'Edit Program',
            'data' => $data
        ]);
    }
    // update data program
    public function simpanPerubahanProgram(GasRequest $request)
    {
        // 1. validasi data
        $validateData = $request->validated();
        $data = [
            'nama_program' => $validateData['nama_program'],
            'kategori' => $validateData['kategori_program'],
            'tanggal' => $validateData['tanggal_program'],
            'biaya' => $validateData['biaya_program'],
            'target' => $validateData['target_program'],
            'keterangan_program' => $validateData['keterangan_program']
        ];
        // 2. ubah data 
        Program::where('id', $request->id)->update($data);
        // 3. redirect ke halaman utama gas
        return redirect()->route('gas')->with('success', 'Berhasil diubah!');   
    }
    // delete program
    public function deleteProgram(Request $request, $id)
    {
        // 1. temukan data berdasarkan id
        $program = Program::find($id);
        // 2. menghapus data program sekaligus data shohibulqurban
        $program->jamaah()->delete();
        Program::destroy($id);
        // 3. redirect ke halaman utama gas
        return redirect()->route('gas')->with('success', 'Berhasil dihapus!');   
    }
    // view program
    public function viewProgram(Request $request, $id)
    {
        $data = Program::find($id);
        $danaTerkumpul = $data->jamaah()->where('status','lunas')->sum('jumlah');
        $dataUtang = $data->jamaah()->where('status','utang')->sum('jumlah');
        $totalUtang = $data->jamaah()->where('status','utang')->count();
        if($danaTerkumpul >= $data->biaya){
            $status =[
                'status' => 'selesai'
            ];
            Program::where('id',$id)->update($status);
        }else{
            $status =[
                'status' => 'belum selesai'
            ];
            Program::where('id',$id)->update($status);
        }
        // fitur search
        $keyword = $request->search_jamaah;
        if (!empty($keyword)){
            $dataJamaah = $data->jamaah()->where('nama', 'like', "%" . $keyword . "%")
            ->orWhere('tanggal', 'like', "%" . $keyword . "%")
            ->orWhere('status', 'like', "%" . $keyword . "%")
            ->orWhere('no_telepon', 'like', "%" . $keyword . "%")
            ->orWhere('jumlah', 'like', "%" . $keyword . "%")
            ->latest()->paginate(10); 
        }else{
            $dataJamaah = $data->jamaah()->latest()->paginate(10);
        }
        return view('admin.gas.viewProgram', [
            'title' => 'program',
            'program' => $data,
            'dataJamaah' => $dataJamaah,
            'totalJamaah' => $data->jamaah()->count(),
            'dataUtang' => number_format($dataUtang, 2, ',', '.'),
            'danaTerkumpul' => $danaTerkumpul,
            'totalUtang' => $totalUtang
        ]);
    }
    // tambah Jamaah
    public function tambahJamaah($id)
    {
        $data = Program::find($id);
        return view('admin.gas.createJamaah', [
            'title' => 'Tambah Jamaah',
            'data' => $data
        ]);
    }
    // save jamaah
    public function storeJamaah(ViewprogramGasRequest $request, $id)
    {
        // 1. validasi data
        $validateData = $request->validated();
        // 2. ambil data berdasarkan id
        $ambilId = Program::find($id);
        // 3. simpan data sesuai column
        $data = [
            // tambahkan foreign key
            'program_id' => $ambilId->id,
            'nama' => $validateData['nama'],
            'tanggal' => $validateData['tanggal'],
            'status' => $validateData['status'],
            'no_telepon' => $validateData['telepon'],
            'jumlah' => $validateData['jumlah'],
        ];
        // 4. simpan data ke DB
        JamaahProgram::create($data);
        // 5. redirect ke halaman view program
        return redirect()->route('view_program', ['id' => $ambilId->id])->with('success', 'Jamaah berhasil ditambahkan!');
    }
    // form edit Jamaah
    public function editJamaah($id,$idJamaah)
    {
        $dataJamaah = Program::find($id);
        return view('admin.gas.editJamaah', [
            'title' => 'Edit Jamaah',
            'data' => $dataJamaah->jamaah()->find($idJamaah),
            'program' => Program::find($id),
        ]);
    }
    // update data jamaah
    public function updateJamaah(ViewprogramGasRequest $request, $id)
    {
        // 1. ambil program berdasarkan id
        $program = Program::find($id);
        // 2. validasi berdasarkan folder requests
        $validateData = $request->validated();
        // 3. masukan data sesuai dengan column
        $data = [
            'nama' => $validateData['nama'],
            'tanggal' => $validateData['tanggal'],
            'status' => $validateData['status'],
            'no_telepon' => $validateData['telepon'],
            'jumlah' => $validateData['jumlah'],
        ];
        // 4. update data partisipan
        $program->jamaah()->where('id', $request->id)->update($data);
        // 5. redirect kehalaman view program
        return redirect()->route('view_program', ['id' => $id])->with('success', 'Jamaah berhasil diubah!');
    }
    // btn delete jamaah
    public function deleteJamaah( $id, $idJamaah)
    {
        // 1. hapus partisipan dengan destroy()
        JamaahProgram::destroy($idJamaah);
        // 2. redirect kehalaman view program
        return redirect()->route('view_program',['id' => $id])->with('success', 'Jamaah berhasil dihapus!');
    }
    // btn laporan pdf jamaah 
    public function reportJamaah($id){
        // 1. ambil data program sesuai dengan $id
        $program = Program::find($id);
        // 2. ambil data jama'ah berdasarkan id program sebelumnya
        $dataJamaah = $program->jamaah();
        // 3. hitung jumlah infaq dengan status lunas
        $danaTerkumpul = $program->jamaah()->where('status','lunas')->sum('jumlah');
        // 4. menghitung jumlah infaq dengan status utang
        $dataUtang = $program->jamaah()->where('status','utang')->sum('jumlah');
        // 5. menghitung jumlah data berstatus lunas dan utang
        $totalLunas = $program->jamaah()->where('status','lunas')->count();
        $totalUtang = $program->jamaah()->where('status','utang')->count();
        // 6. menghitung kurangnya biaya
        $totalKurang = $program->biaya - $danaTerkumpul;
        $totalTambah = $danaTerkumpul - $program->biaya;
        // 7. tampilkan data kehalaman PDF
        $pdf = Pdf::loadView('admin.gas.reportJamaah', [
            'title' => 'laporan daftar list Jamaah',
            'danaTerkumpul' => $danaTerkumpul,
            'dataUtang' => $dataUtang,
            'totalUtang' => $totalUtang,
            'totalLunas' => $totalLunas,
            'dataProgram' => $program,
            'totalKurang' => $totalKurang,
            'totalTambah' => $totalTambah,
            'dataJamaah' => $dataJamaah->latest()->get()
        ]);
        return $pdf->download('laporan-jamaah.pdf');
    }
}
