<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateStudentAdminRequest;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use function Termwind\render;

use App\Http\Controllers\Controller;
use App\DataTables\StudentsDataTable;

class StudentController extends Controller
{
    public function index(StudentsDataTable $dataTable)
    {
        $students = Student::orderBy('nodaftar')->get();
        return $dataTable->render('admin.student.index', compact('students'));
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->back()->with('success', 'Student berhasil dihapus');
    }

    public function showtudent($id)
    {
        $student = Student::find($id);
        $siswa = new Student();
        $jenis_kelamin = $siswa->jenis_kelamin();
        $agama = $siswa->agama();
        $hoby = $siswa->hoby();
        $cita = $siswa->cita();
        $schools = School::all();
        return view('admin.student.show', compact('student', 'jenis_kelamin', 'agama', 'hoby', 'cita', 'schools'));
    }

    public function updatestudentadmin(UpdateStudentAdminRequest $request, $uuid)
    {
        $student = Student::where('uuid', $uuid)->first();
        $student->update([
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
}
