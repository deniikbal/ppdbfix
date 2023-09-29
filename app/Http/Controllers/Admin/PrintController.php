<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrintFormulir;
use App\Models\Student;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrintController extends Controller
{
    protected $pdf;

    public function __construct(PrintFormulir $pdf)
    {
        $this->pdf = $pdf;
    }

    public function print(Student $student, $id)
    {
        $student = Student::where('uuid', $id)->first();
        $tgllahir = Carbon::parse($student->tanggal_lahir)->isoFormat('D MMMM Y');
        $image = asset('assets/img/logots.png', "r");
        //dd($image);
        $pasfoto = asset('storage/' . $student->foto);
        $iconuser = 'https://ppdb.smatelkombandung.sch.id/assets/img/pp.jpg';

        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->AddPage('P', 'a4');
        $this->pdf->SetCreator($student->name);
        $this->pdf->SetMargins(10, 10, 10);
        $this->pdf->Ln(7);
        $this->pdf->SetFont('Arial', 'B', 18);
        $this->pdf->Cell(190, 5, 'Formulir Pendaftaran PPDB Tahun ' . Carbon::now()->isoFormat('Y'), '0', 0, 'C');
        $this->pdf->Ln(7);
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(190, 7, 'Data Pribadi Pendaftar', '0', 1, 'L');
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Ln(5);
        //$this->pdf->Image($iconuser, 155, 75, 40, 60);
        if ($student->foto == null) {
            $this->pdf->Image($iconuser, 155, 75, 40, 60);
        } else {
            $this->pdf->Image($pasfoto, 155, 75, 40, 60,);
            // $this->pdf->Image($pasfoto);
        }
        $this->pdf->Cell(55, 5, 'No Pendaftaran', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->nodaftar, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Nama Lengkap', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->MultiCell(75, 5, Str::title($student->name), '0', 'L');

        $this->pdf->Cell(55, 5, 'Jenis Kelamin', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, Str::title($student->jenis_kelamin), '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Tempat, Tanggal Lahir', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, Str::title($student->tempat_lahir) . ', ' . $tgllahir, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'NIK', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->nik, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Agama', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, Str::title($student->agama), '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'No Hp', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->nohp_siswa, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Anak Ke', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->anak_ke, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Jumlah Saudara', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->jumlah_saudara, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Tinggi Badan', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->tinggi_badan, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Berat Badan', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->berat_badan, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Hobby', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, Str::title($student->hoby), '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Cita-cita', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, Str::title($student->cita), '0', 1, 'L');

        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(190, 7, 'Data Riwayat Sekolah', '0', 1, 'L');
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Ln(3);
        $this->pdf->Cell(55, 5, 'NISN', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, Str::title($student->nisn), '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Asal Sekolah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, Str::Upper($student->asal_sekolah), '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'NPSN Asal Sekolah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->npsn, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Provinsi SMP/MTs', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->provinsi_sekolah, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Kabupaten SMP/MTs', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->kota_sekolah, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Kecamatan SMP/MTs', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->kec_sekolah, '0', 1, 'L');

        //        $this->pdf->Cell(55, 5, 'Desa / Kelurahan SMP/MTs', '0', 0, 'L');
        //        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        //        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        //        $this->pdf->Cell(50, 5, $student->desa_sekolah, '0', 1, 'L');

        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(190, 7, 'Data Orang Tua', '0', 1, 'L');
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Ln(3);

        $this->pdf->Cell(55, 5, 'No Kartu Keluarga', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->no_kk, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Nama Ayah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->nama_ayah, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'NIK Ayah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->nik_ayah, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Tempat Lahir Ayah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->tempat_lahir_ayah, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Tanggal Lahir Ayah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        if ($student->tahun_ayah == null) {
            $this->pdf->Cell(50, 5, '', '0', 1, 'L');
        } else {
            $this->pdf->Cell(50, 5, Carbon::parse($student->tahun_ayah)->isoFormat('D MMMM Y'), '0', 1, 'L');
        }


        $this->pdf->Cell(55, 5, 'Pendidikan Ayah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->pendidikan_ibu, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Pekerjaan Ayah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->pekerjaan_ayah, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Penghasilan Ayah Ayah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->penghasilan_ayah, '0', 1, 'L');

        $this->pdf->Ln(5);

        $this->pdf->Cell(55, 5, 'Nama Ibu', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->nama_ibu, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'NIK Ibu', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->nik_ibu, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Tempat Lahir Ibu', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->tempat_lahir_ibu, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Tahun Lahir Ibu', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        if ($student->tahun_ibu == null) {
            $this->pdf->Cell(50, 5, '', '0', 1, 'L');
        } else {
            $this->pdf->Cell(50, 5, Carbon::parse($student->tahun_ibu)->isoFormat('D MMMM Y'), '0', 1, 'L');
        }

        $this->pdf->Cell(55, 5, 'Pendidikan Ibu', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->pendidikan_ibu, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Pekerjaan Ibu', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->pekerjaan_ibu, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Penghasilan Ibu', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->penghasilan_ibu, '0', 1, 'L');

        $this->pdf->SetAutoPageBreak(true, 5);

        $this->pdf->SetFont('Arial', 'I', 8);
        $this->pdf->SetFillColor(136, 137, 136);
        $this->pdf->SetY(280, 5);
        $this->pdf->Cell(
            0,
            5,
            'PPDB SMA TELKOM - Halaman : ' . $this->pdf->PageNo(),
            0,
            0,
            'C',
            true
        );


        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->AddPage('P', 'a4');
        $this->pdf->SetMargins(10, 10, 10);

        $this->pdf->Ln(8);
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(190, 7, 'Data Alamat Rumah Orang Tua', '0', 1, 'L');
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Ln(3);

        $this->pdf->Cell(55, 5, 'Alamat', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->MultiCell(100, 5, $student->alamat_pd, '0', 'L',);
        //$this->pdf->Cell(50,5,$student->alamat_pd,'0',1,'L');

        $this->pdf->Cell(55, 5, 'Jarak Rumah Ke Sekolah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, '' . $student->jarak . ' Km', '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Waktu Tempuh', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, '' . $student->waktu . ' Km', '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Desa / Kelurahan', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, Str::upper($student->desa_pd), '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Kecamatan', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->kec_pd, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Kabupaten', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->kota_pd, '0', 1, 'L');

        $this->pdf->Cell(55, 5, 'Provinsi', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $student->provinsi_pd, '0', 1, 'L');

        $this->pdf->Ln(8);
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(190, 7, 'Unggah File', '0', 1, 'L');
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Ln(3);
        $this->pdf->Cell(55, 5, 'Unggah Akte Lahir', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        if ($student->doc_akte == null) {
            $this->pdf->MultiCell(100, 5, 'Belum Unggah', '0', 'L',);
        } else {
            $this->pdf->MultiCell(100, 5, 'Sudah Unggah', '0', 'L',);
        }
        $this->pdf->Cell(55, 5, 'Unggah Kartu Keluarga', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        if ($student->doc_kk == null) {
            $this->pdf->MultiCell(100, 5, 'Belum Unggah', '0', 'L',);
        } else {
            $this->pdf->MultiCell(100, 5, 'Sudah Unggah', '0', 'L',);
        }
        //        $this->pdf->Ln(5);
        //        $this->pdf->SetFont('Arial', 'B', 12);
        //        $this->pdf->Cell(190, 7, 'Data Prestasi Pendaftar', '0', 1, 'L');
        //        $this->pdf->SetFont('Arial', '', 11);
        //        $this->pdf->Ln(3);
        //
        //        $this->pdf->SetFillColor(228, 38, 44);
        //        $this->pdf->Cell(10, 6, 'No', '1', 0, 'C', true);
        //        $this->pdf->Cell(80, 6, 'Nama Kegiatan', '1', 0, 'C', true);
        //        $this->pdf->Cell(25, 6, 'Jenis', '1', 0, 'C', true);
        //        $this->pdf->Cell(30, 6, 'Tingkat', '1', 0, 'C', true);
        //        $this->pdf->Cell(20, 6, 'Tahun', '1', 0, 'C', true);
        //        $this->pdf->Cell(30, 6, 'Pencapaian', '1', 1, 'C', true);

        //        $prestasi = Prestasi::where('student_id', $student->id)->get();


        //        $no = 1;
        //        foreach ($prestasi as $item) {
        //            $this->pdf->Cell(10, 6, $no++, '1', 0, 'C');
        //            $this->pdf->Cell(80, 6, $item->nama_kegiatan, '1', 0, 'L');
        //            $this->pdf->Cell(25, 6, $item->jenis_kegiatan, '1', 0, 'C');
        //            $this->pdf->Cell(30, 6, $item->tingkat, '1', 0, 'C');
        //            $this->pdf->Cell(20, 6, $item->tahun, '1', 0, 'C');
        //            $this->pdf->Cell(30, 6, $item->hasil, '1', 1, 'C');
        //        }
        //        //dd($prestasi);

        $cetak = Carbon::now()->isoFormat('dddd, D MMMM Y');


        $this->pdf->Ln(5);

        $this->pdf->SetFont('Arial', 'I', 8);
        $this->pdf->Cell(20, 5, 'Dicetak pada', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(50, 5, $cetak, '0', 0, 'L');


        $this->pdf->Ln(30);
        $this->pdf->SetFont('ZapfDingbats', 'B', 12);
        $this->pdf->Cell(5, 5, 4, 0, 0, 'L');
        $this->pdf->SetFont('Arial', 'I', 8);
        $this->pdf->Cell(
            150,
            5,
            'Cetak formulir pendaftaran PPDB SMA TELKOM menggunakan kertas berukuran minimal A4',
            0,
            1,
            'L'
        );
        $this->pdf->SetFont('ZapfDingbats', 'B', 12);
        $this->pdf->Cell(5, 5, 4, 0, 0, 'L');
        $this->pdf->SetFont('Arial', 'I', 8);
        $this->pdf->MultiCell(
            180,
            5,
            'Kartu peserta PPDB SMA TELKOM diberikan kepada pendaftar sebagai tanda bukti bahwa siswa yang bersangkutan telah melengkapi berkas-berkas pendaftaran',
            0,
            1,
            false
        );
        $this->pdf->SetFont('ZapfDingbats', 'B', 12);
        $this->pdf->Cell(5, 5, 4, 0, 0, 'L');
        $this->pdf->SetFont('Arial', 'I', 8);
        $this->pdf->Cell(
            150,
            5,
            'Jika terdapat kesalahan data silahkan perbaiki data terlebih dahulu, kemudian cetak kembali',
            0,
            1,
            'L'
        );

        $this->pdf->Output('I', 'Formulir ' . $student->name . '.pdf');

        exit;
    }
}
