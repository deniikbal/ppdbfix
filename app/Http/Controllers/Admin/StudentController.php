<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateStudentAdminRequest;
use App\Jobs\RegNewStudent;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Ramsey\Uuid\Uuid;
use function Termwind\render;

use App\Http\Controllers\Controller;
use App\DataTables\StudentsDataTable;

class StudentController extends Controller
{
    public function index(StudentsDataTable $dataTable)
    {
        $title = 'Student';
        $users = User::all();
        $schools = School::all();
        return $dataTable->render('admin.student.index', compact('title', 'users', 'schools'));
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->back()->with('success', 'Student berhasil dihapus');
    }

    public function showtudent($id)
    {
        $title = 'Edit Student';
        $student = Student::find($id);
        $siswa = new Student();
        $jenis_kelamin = $siswa->jenis_kelamin();
        $agama = $siswa->agama();
        $hoby = $siswa->hoby();
        $cita = $siswa->cita();
        $schools = School::all();
        return view('admin.student.show', compact('student', 'title', 'jenis_kelamin', 'agama', 'hoby', 'cita', 'schools'));
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

    public function createstudentadmin(Request $request)
    {
        $school = School::find($request->asal_sekolah);
        $provinsi = Province::find($request->provinces_id);
        $kota = Regency::find($request->regencies_id);
        $kec = District::find($request->districts_id);
        $uuid = Uuid::uuid4();
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:students',
            'jenis_kelamin' => 'required',
            'id' => 'required',
            'nama_ayah' => 'required',
            'asal_sekolah' => 'required',
            'provinces_id' => 'required',
            'regencies_id' => 'required',
            'districts_id' => 'required',
            'nohp_siswa' => 'required|min:10|numeric',
            'nodaftar' => 'unique:students'
        ]);
        if ($valid->fails()) {
            return response()->json(['errors' => $valid->errors()->all()]);
        } else {
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
                'user_id' => $request->id,
                'nodaftar' => $Id,
                'nohp_ortu' => auth()->user()->no_handphone,
                'nohp_siswa' => $request->nohp_siswa,
                'nama_ayah' => $request->nama_ayah,
                'uuid' => $uuid,
            ]);
            RegNewStudent::dispatch($student);
            //SendRegisStudent::dispatch($student);
            return response()->json(['success' => 'Data is successfully added']);
        }

    }

    public function export()
    {
        $students = Student::all()->sortBy('nodaftar');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "No");
        $sheet->setCellValue('B1', "No Daftar");
        $sheet->setCellValue('C1', "Nama Lengkap");
        $sheet->setCellValue('D1', "Nama Ayah");
        $sheet->setCellValue('E1', "No HP Orang Tua");
        $sheet->setCellValue('F1', "No Hp Siswa");
        $sheet->setCellValue('G1', "Asal Sekolah");
        $sheet->setCellValue('H1', "Jenis Kelamin");
        $sheet->setCellValue('I1', "NISN");
        $sheet->setCellValue('J1', "NPSN Sekolah");
        $sheet->setCellValue('K1', "NIK");
        $sheet->setCellValue('L1', "NO KK");
        $sheet->setCellValue('M1', "Tempat Lahir");
        $sheet->setCellValue('N1', "Tanggal Lahir");
        $sheet->setCellValue('O1', "Agama");
        $sheet->setCellValue('P1', "Anak Ke-");
        $sheet->setCellValue('Q1', "Alamat");
        $sheet->setCellValue('R1', "Desa");
        $sheet->setCellValue('S1', "Kecamatan");
        $sheet->setCellValue('T1', "Kabupaten");
        $sheet->setCellValue('U1', "Provinsi");
        $sheet->setCellValue('V1', "Nama Ayah");
        $sheet->setCellValue('W1', "NIK Ayah");
        $sheet->setCellValue('X1', "Tahun Lahir Ayah");
        $sheet->setCellValue('Y1', "Pendidikan Ayah");
        $sheet->setCellValue('Z1', "Pekerjaan Ayah");
        $sheet->setCellValue('AA1', "Penghasilan Ayah");
        $sheet->setCellValue('AB1', "Nama Ibu");
        $sheet->setCellValue('AC1', "NIK Ibu");
        $sheet->setCellValue('AD1', "Tahun Lahir Ibu");
        $sheet->setCellValue('AE1', "Pendidikan Ibu");
        $sheet->setCellValue('AF1', "Pekerjaan Ibu");
        $sheet->setCellValue('AG1', "Penghasilan Ibu");
        $sheet->setCellValue('AH1', "Tinggi Badan");
        $sheet->setCellValue('AI1', "Berat Badan");
        $sheet->setCellValue('AJ1', "Jarak");
        $sheet->setCellValue('AK1', "Waktu");
        $sheet->setCellValue('AL1', "Jumlah Saudara");
        $sheet->setCellValue('AM1', "VALIDASI");
        $sheet->setCellValue('AN1', "CREATED_AT");

        $column = 2;
        foreach ($students as $student) {
            $sheet->setCellValue('A' . $column, $column - 1);
            $sheet->setCellValue('B' . $column, $student->nodaftar);
            $sheet->setCellValue('C' . $column, $student->name);
            $sheet->setCellValue('D' . $column, $student->nama_ayah);
            $sheet->setCellValue('E' . $column, $student->nohp_ortu);
            $sheet->setCellValue('F' . $column, $student->nohp_siswa);
            $sheet->setCellValue('G' . $column, $student->asal_sekolah);
            $sheet->setCellValue('H' . $column, $student->jenis_kelamin);
            $sheet->setCellValue('I' . $column, $student->nisn);
            $sheet->setCellValue('J' . $column, $student->npsn);
            $sheet->setCellValue('K' . $column, "'" . $student->nik);
            $sheet->setCellValue('L' . $column, "'" . $student->no_kk);
            $sheet->setCellValue('M' . $column, $student->tempat_lahir);
            $sheet->setCellValue('N' . $column, $student->tanggal_lahir);
            $sheet->setCellValue('O' . $column, $student->agama);
            $sheet->setCellValue('P' . $column, $student->anak_ke);
            $sheet->setCellValue('Q' . $column, $student->alamat_pd);
            $sheet->setCellValue('R' . $column, $student->desa_pd);
            $sheet->setCellValue('S' . $column, $student->kec_pd);
            $sheet->setCellValue('T' . $column, $student->kota_pd);
            $sheet->setCellValue('U' . $column, $student->provinsi_pd);
            $sheet->setCellValue('V' . $column, $student->nama_ayah);
            $sheet->setCellValue('W' . $column, "'" . $student->nik_ayah);
            $sheet->setCellValue('X' . $column, \Carbon\Carbon::parse($student->tahun_ayah)->isoFormat('DD MMMM YYYY'));
            $sheet->setCellValue('Y' . $column, $student->pendidikan_ayah);
            $sheet->setCellValue('Z' . $column, $student->pekerjaan_ayah);
            $sheet->setCellValue('AA' . $column, $student->penghasilan_ayah);
            $sheet->setCellValue('AB' . $column, $student->nama_ibu);
            $sheet->setCellValue('AC' . $column, "'" . $student->nik_ibu);
            $sheet->setCellValue('AD' . $column, \Carbon\Carbon::parse($student->tahun_ibu)->isoFormat('DD MMMM YYYY'));
            $sheet->setCellValue('AE' . $column, $student->pendidikan_ibu);
            $sheet->setCellValue('AF' . $column, $student->pekerjaan_ibu);
            $sheet->setCellValue('AG' . $column, $student->penghasilan_ibu);
            $sheet->setCellValue('AH' . $column, $student->tinggi_badan);
            $sheet->setCellValue('AI' . $column, $student->berat_badan);
            $sheet->setCellValue('AJ' . $column, $student->jarak);
            $sheet->setCellValue('AK' . $column, $student->waktu);
            $sheet->setCellValue('AL' . $column, $student->jumlah_saudara);
            $sheet->setCellValue('AM' . $column, $student->verifikasi);
            $sheet->setCellValue('AN' . $column, \Carbon\Carbon::parse($student->created_at)->isoFormat('DD MMMM YYYY'));
            $column++;
        }
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->getColumnDimension('S')->setAutoSize(true);
        $sheet->getColumnDimension('T')->setAutoSize(true);
        $sheet->getColumnDimension('U')->setAutoSize(true);
        $sheet->getColumnDimension('V')->setAutoSize(true);
        $sheet->getColumnDimension('W')->setAutoSize(true);
        $sheet->getColumnDimension('X')->setAutoSize(true);
        $sheet->getColumnDimension('Y')->setAutoSize(true);
        $sheet->getColumnDimension('Z')->setAutoSize(true);
        $sheet->getColumnDimension('AA')->setAutoSize(true);
        $sheet->getColumnDimension('AB')->setAutoSize(true);
        $sheet->getColumnDimension('AC')->setAutoSize(true);
        $sheet->getColumnDimension('AD')->setAutoSize(true);
        $sheet->getColumnDimension('AE')->setAutoSize(true);
        $sheet->getColumnDimension('AF')->setAutoSize(true);
        $sheet->getColumnDimension('AG')->setAutoSize(true);
        $sheet->getColumnDimension('AH')->setAutoSize(true);
        $sheet->getColumnDimension('AI')->setAutoSize(true);
        $sheet->getColumnDimension('AJ')->setAutoSize(true);
        $sheet->getColumnDimension('AK')->setAutoSize(true);
        $sheet->getColumnDimension('AL')->setAutoSize(true);
        $sheet->getColumnDimension('AM')->setAutoSize(true);
        $sheet->getColumnDimension('AN')->setAutoSize(true);
        $sheet->getStyle('A1:AN1')->getFont()->setBold(true);
        $sheet->getStyle('A1:AN1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:AN1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');
        $name = Auth::user()->name;
        $sheet->setTitle("Laporan Data Siswa");
        $filename = 'export_' . Carbon::now() . '.xls';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $filename); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

    }
}
