<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        //dd($student);
        $count = Student::where('user_id', auth()->id())->get()->count();
        $schools = School::all();
        //dd($schools);
        //dd($count);
        return view('student.index', compact('student', 'count', 'schools'));
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:students',
            'jenis_kelamin' => 'required',
            'nama_ayah' => 'required',
            'asal_sekolah' => 'required',
            'provinces_id' => 'required',
            'regencies_id' => 'required',
            'districts_id' => 'required',
            'nohp_siswa' => 'required|min:10|numeric'
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
                'uuid' => $uuid,
            ]);
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
        if ($request->file('foto')){
            if ($test->foto) {
                Storage::delete($test->foto);
            }
            $save=$request->file('foto')->store('foto');
        }
        $test->update([
            'foto'=>$save,
        ]);
        return redirect()->back();
    }
    public function updatebiodata(UpdateStudentRequest $request, $uuid)
    {
        //dd($uuid);
        $students = Student::where('uuid', $uuid)->first();
        //dd($students);
        $students->update([
            'name' => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'nik' => $request->nik,
            'agama' => $request->agama,
            'nohp_siswa' => $request->nohp_siswa,
            'anak_ke' => $request->anak_ke,
            'jumlah_saudara' => $request->jumlah_saudara,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'hoby' => $request->hoby,
            'cita' => $request->cita,
        ]);
        return redirect()->back()->with('success', 'Data Siswa Berhasil Diupdate');
    }

    public function updatesekolah(Request $request, $uuid)
    {
        $school = School::findorfail($request->asal_sekolah);
        $students = Student::where('uuid', $uuid)->first();
        $students->update([
            'asal_sekolah' => $school->sekolah,
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

    public function updateorangtua(UpdateOrtuRequest $request, $uuid)
    {
        $students = Student::where('uuid', $uuid)->first();
        $students->update([
            'no_kk' => $request->no_kk,
            'nama_ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'tahun_ayah' => $request->tahun_ayah,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'tahun_ibu' => $request->tahun_ibu,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
        ]);
        return redirect()->back()->with('success', 'Data Orang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
