<?php

namespace App\Http\Controllers;

use App\Jobs\RegNewStudent;
use App\Models\User;
use App\Notifications\RegisterStudent;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use App\Models\School;
use App\Models\Regency;
use App\Models\Student;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateOrtuRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateDomisiliRequest;
use App\Http\Requests\UpdateStudentRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();
        $count = Student::where('user_id', auth()->id())->get()->count();
        $schools = School::all();
        return view('student.index', compact('student', 'count', 'schools'));
    }

    public function isibiodata()
    {
        $student = Student::where('user_id', auth()->id())->first();
        $count = Student::where('user_id', auth()->id())->get()->count();
        $siswa = new Student();
        $jenis_kelamin = $siswa->jenis_kelamin();
        $agama = $siswa->agama();
        $pekerjaan = $siswa->pekerjaan();
        $pendidikan = $siswa->pendidikan();
        $schools = School::all();
        return view('student.biodata', compact('student','pendidikan',
            'count', 'schools','jenis_kelamin','agama','schools','pekerjaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function biodata()
    {
        $student = Student::where('user_id', auth()->id())->first();
        //dd($student);
        $siswa = new Student();
        $jenis_kelamin = $siswa->jenis_kelamin();
        $agama = $siswa->agama();
        $hoby = $siswa->hoby();
        $cita = $siswa->cita();
        $schools = School::all();
        return view('student.biodata.biodata_siswa', compact(
            'student',
            'jenis_kelamin',
            'agama',
            'hoby',
            'cita',
            'schools'
        ));
    }

    public function editbiodata()
    {
        $student = Student::where('user_id', auth()->id())->first();
        $siswa = new Student();
        $jenis_kelamin = $siswa->jenis_kelamin();
        $agama = $siswa->agama();
        $hoby = $siswa->hoby();
        $cita = $siswa->cita();
        $pekerjaan = $siswa->pekerjaan();
        $pendidikan = $siswa->pendidikan();
        $schools = School::all();
        return view('student.biodata.biodata_pesertadidik', compact('student',
            'jenis_kelamin', 'agama', 'schools', 'pekerjaan', 'cita', 'pendidikan', 'schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:students',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'nama_ayah' => 'required',
            'asal_sekolah' => 'required',
            'provinces_id' => 'required',
            'regencies_id' => 'required',
            'districts_id' => 'required',
            'nohp_siswa' => 'required|min:10|numeric'
        ],[
            'name.required' => 'Nama Lengkap tidak boleh kosong',
            'name.unique' => 'Nama sudah terdaftar',
            'nama_ayah.required' => 'Nama Ayah tidak boleh kosong',
            'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'nohp_siswa.required' => 'No WA siswa tidak boleh kosong',
            'nohp_siswa.numeric' => 'No WA siswa harus berupa angka',
            'asal_sekolah.required' => 'Asal sekolah tidak boleh kosong',
            'provinces_id.required' => 'Provinsi tidak boleh kosong',
            'regencies_id.required' => 'Kota / Kabupaten tidak boleh kosong',
            'districts_id.required' => 'Kecamatan tidak boleh kosong',
        ]);
        if ($valid->fails()) {
            return response()->json(['errors' => $valid->errors()->all()]);
        } else {
            $school = School::find($request->asal_sekolah);
            $provinsi = Province::find($request->provinces_id);
            $kota = Regency::find($request->regencies_id);
            $kec = District::find($request->districts_id);
            $uuid = Uuid::uuid4();
            //dd($uuid);
            //dd($school);
            $Id = IdGenerator::generate(['table' => 'students', 'field' => 'nodaftar', 'length' => 10, 'prefix' => ('SMATEL-')]);
            $student = Student::create([
                'name' => $request->name,
                'provinsi_pd' => $provinsi->name,
                'kota_pd' => $kota->name,
                'kec_pd' => $kec->name,
                'jenis_kelamin' => $request->jenis_kelamin,
                'asal_sekolah' => $school->sekolah,
                'npsn' => $school->npsn,
                'provinsi_sekolah' => $school->propinsi,
                'kota_sekolah' => $school->kabupaten_kota,
                'kec_sekolah' => $school->kecamatan,
                'user_id' => auth()->id(),
                'nodaftar' => $Id,
                'nohp_ortu' => auth()->user()->no_handphone,
                'nohp_siswa' => $request->nohp_siswa,
                'nama_ayah' => $request->nama_ayah,
                'tanggal_lahir' => $request->tanggal_lahir,
                'uuid' => $uuid,
            ]);
            Notification::send($student, new RegisterStudent($student));
            RegNewStudent::dispatch($student);
            //SendRegisStudent::dispatch($student);
            return response()->json(['success' => 'Data is successfully added']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function updatealamat(UpdateDomisiliRequest $request, $uuid)
    {
        $student = Student::where('uuid', $uuid)->first();
        $student->update([
            'alamat_pd' => $request->alamat_pd,
            'jarak' => $request->jarak,
            'waktu' => $request->waktu,
            'provinsi_pd' => $request->provinsi_pd,
            'kota_pd' => $request->kota_pd,
            'kec_pd' => $request->kec_pd,
            'desa_pd' => $request->desa_pd,
        ]);
        return redirect()->back()->with('success', 'Data Alamat Berhasil Diupdate');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updatefoto(Request $request, $id)
    {
        $test = Student::find($id);
        if ($request->file('foto')) {
            if ($test->foto) {
                Storage::delete($test->foto);
            }
            $save = $request->file('foto')->store('foto');
        }
        $test->update([
            'foto' => $save,
        ]);
        return redirect()->back();
    }

    public function updatebiodata(Request $request, $id)
    {
        //dd($request->all());
        $students = Student::where('id', $id)->first();

        $validated = $request->validate([
            'nik'=>'required|size:16',
            'name'=>'required|string',
            'nisn'=>'required|size:10',
            'jenis_kelamin'=>'required',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'agama'=>'required',
            'alamat_pd'=>'required',
            'provinsi_pd'=>'required',
            'kota_pd'=>'required',
            'kec_pd'=>'required',
            'desa_pd'=>'required',
            'kode_pos'=>'required|numeric',
            'suku'=>'required|string',
            'bahasa'=>'required|string',
            'anak_ke'=>'required|numeric',
            'golongan'=>'required|string',
            'nohp_siswa'=>'required|numeric',
            'email'=>'required|email',
        ],[
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.size' => 'NIK tidak boleh lebih dari 16',
            'name.required' => 'Nama tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'agama.required' => 'Agama tidak boleh kosong',
            'alamat_pd.required' => 'Alamat tidak boleh kosong',
            'provinsi_pd.required' => 'Provinsi tidak boleh kosong',
            'kota_pd.required' => 'Kota tidak boleh kosong',
            'kec_pd.required' => 'Kecamatan tidak boleh kosong',
            'desa_pd.required' => 'Desa tidak boleh kosong',
            'kode_pos.required' => 'Kode pos tidak boleh kosong',
            'suku.required' => 'Suku tidak boleh kosong',
            'bahasa.required' => 'Bahasa tidak boleh kosong',
            'anak_ke.required' => 'Anak ke-tidak boleh kosong',
            'golongan.required' => 'Golongan tidak boleh kosong',
            'nohp_siswa.required' => 'No HP tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid'

        ]);
        $students->update($validated);
        return redirect()->back()->with('success', 'Data Siswa Berhasil Diupdate');
    }

    public function updatesekolah(Request $request, $uuid)
    {
        $valid = $request->validate([
            'nisn' => 'required',
        ]);
        $school = School::findorfail($request->asal_sekolah);
        $students = Student::where('uuid', $uuid)->first();
        $students->update([
            'asal_sekolah' => $school->sekolah,
            'nisn' => $request->nisn,
            'npsn' => $school->npsn,
            'provinsi_sekolah' => $school->propinsi,
            'kota_sekolah' => $school->kabupaten_kota,
            'kec_sekolah' => $school->kecamatan,
        ]);
        return redirect()->back()->with('success', 'Data Sekolah Berhasil Diupdate');
    }

    public function editorangtua()
    {
        $student = Student::where('user_id', auth()->id())->first();
        $siswa = new Student();
        $pendidikan = $siswa->pendidikan();
        $pekerjaan = $siswa->pekerjaan();
        $penghasilan = $siswa->penghasilan();
        return view('student.biodata.biodata_orangtua', compact('student', 'pendidikan', 'pekerjaan', 'penghasilan'));
    }

    public function updateayah(Request $request, $id)
    {
        $students = Student::where('id', $id)->first();
        $validated = $request->validate([
            'nama_ayah'=>'required|string',
            'usia_ayah'=>'required|size:2',
            'alamat_ayah'=>'required|string',
            'nowa_ayah'=>'required|numeric',
            'pendidikan_ayah'=>'required|string',
            'pekerjaan_ayah'=>'required|string',
        ],[
            'nama_ayah.required' => 'Nama Ayah tidak boleh kosong',
            'usia_ayah.required' => 'Usia Ayah tidak boleh kosong',
            'alamat_ayah.required' => 'Alamat Ayah tidak boleh kosong',
            'pekerjaan_ayah.required' => 'Pekerjaan Ayah tidak boleh kosong',
            'nowa_ayah.required' => 'No. WA tidak boleh kosong',
            'pendidikan_ayah.required' => 'Pendidikan Ayah tidak boleh kosong',
        ]);
        $students->update($validated);
        return redirect()->back()->with('success', 'Data Ayah Berhasil Diupdate');
    }

    public function updateibu(Request $request, $id)
    {
        //dd($request->all());
        $students = Student::where('id', $id)->first();
        $validated = $request->validate([
            'nama_ibu'=>'required|string',
            'usia_ibu'=>'required|size:2',
            'alamat_ibu'=>'required|string',
            'nowa_ibu'=>'required|numeric',
            'pendidikan_ibu'=>'required|string',
            'pekerjaan_ibu'=>'required|string',
        ],[
            'nama_ibu.required' => 'Nama Ibu tidak boleh kosong',
            'usia_ibu.required' => 'Usia Ibu tidak boleh kosong',
            'alamat_ibu.required' => 'Alamat Ibu tidak boleh kosong',
            'pekerjaan_ibu.required' => 'Pekerjaan Ibu tidak boleh kosong',
            'nowa_ibu.required' => 'No. WA tidak boleh kosong',
            'pendidikan_ibu.required' => 'Pendidikan Ibu tidak boleh kosong',
        ]);
        $students->update($validated);
        return redirect()->back()->with('success', 'Data Ibu Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function editsekolah()
    {
        $student = Student::where('user_id', auth()->id())->first();
        $schools = School::all();
        return view('student.biodata.asalsekolah', compact('student', 'schools'));
    }

    public function uploadfile()
    {
        $student = Student::where('user_id', auth()->id())->first();
        $title = 'Upload File';
        return view('student.file.index', compact('student', 'title'));

    }

    public function uploadkk(Request $request)
    {

        $request->validate([
            'doc_kk' => 'required|image',
        ]);
        if ($request->file('doc_kk')) {
            if ($request->oldfile) {
                Storage::delete($request->oldfile);
            }
            $save = $request->file('doc_kk')->store('doc_kk');
        }
        $student = Student::find($request->id);
        $student->update([
            'doc_kk' => $save,
        ]);
        return redirect()->back()->with('success', 'Berhasil Upload Kartu Keluarga');

    }

    public function uploadakte(Request $request)
    {
        $request->validate([
            'doc_akte' => 'required|image',
        ]);
        if ($request->file('doc_akte')) {
            if ($request->oldfile) {
                Storage::delete($request->oldfile);
            }
            $save = $request->file('doc_akte')->store('doc_akte');
        }
        $student = Student::find($request->id);
        $student->update([
            'doc_akte' => $save,
        ]);
        return redirect()->back()->with('success', 'Berhasil Upload Akte Lahir');

    }

    public function uploadfoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image',
        ]);
        if ($request->file('foto')) {
            if ($request->oldfile) {
                Storage::delete($request->oldfile);
            }
            $save = $request->file('foto')->store('foto');
        }
        $student = Student::find($request->id);
        $student->update([
            'foto' => $save,
        ]);
        return redirect()->back()->with('success', 'Berhasil Upload Pas Foto');

    }

    public function savebiodata(Request $request, $id)
    {
        //return $request->all();
        $validated = $request->validate([
            'name' => 'required',
            'nisn' => 'required|size:10',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'asal_sekolah' => 'required',
            'nohp_siswa' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'nohp_ortu' => 'required',
            'alamat_pd' => 'required',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'desa_pd' => 'required',
            'kec_pd' => 'required',
            'kota_pd' => 'required',
            'provinsi_pd' => 'required',
        ],[
            'name.required' => 'Nama Harus Diisi',
            'nisn.required' => 'NISN Harus Diisi',
            'nisn.size' => 'NISN Harus 10 Angka',
            'tempat_lahir.required' => 'Tempat Lahir Harus Diisi',
            'tanggal_lahir.required' => 'Tanggal Lahir Harus Diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Harus Diisi',
            'agama.required' => 'Agama Harus Diisi',
            'asal_sekolah.required' => 'Asal Sekolah Harus Diisi',
            'nohp_siswa.required' => 'No. HP Harus Diisi',
            'nama_ayah.required' => 'Nama Ayah Harus Diisi',
            'pekerjaan_ayah.required' => 'Pekerjaan Ayah Harus Diisi',
            'nama_ibu.required' => 'Nama Ibu Harus Diisi',
            'pekerjaan_ibu.required' => 'Pekerjaan Ibu Harus Diisi',
            'nohp_ortu.required' => 'No. HP Harus Diisi',
            'alamat_pd.required' => 'Alamat Harus Diisi',
            'rt.required' => 'RT Harus Diisi',
            'rt.max' => 'Maksimal 3 Angka',
            'rw.required' => 'RW Harus Diisi',
            'rw.max' => 'Maximal 3 Angka',
            'desa_pd.required' => 'Desa / Kelurahan Harus Diisi',
            'kec_pd.required' => 'Kecamatan Harus Diisi',
            'kota_pd.required' => 'Kota Harus Diisi',
            'provinsi_pd.required' => 'Provinsi Harus Diisi',
        ]);
        $student = Student::find($id);
        $student->update($validated);
        return redirect()->back()->with('success', 'Biodata CPD Berhasil Diupdate');

    }
}
