<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Surat;
use App\Models\Student;
use App\Models\WhatsApp;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    protected $pdf;

    public function __construct(Surat $pdf)
    {
        $this->pdf = $pdf;
    }

    public function surat($id)
    {
        $wa = WhatsApp::first();
        $student = Student::where('uuid', $id)->first();
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->AddPage('P', 'a4');
        //$this->pdf->SetCreator($student->name);
        $this->pdf->SetMargins(10, 10, 10);
        $this->pdf->Ln(7);
        $this->pdf->SetFont('Arial', 'BU', 16);
        $this->pdf->Cell(190, 5, 'SURAT KETERANGAN', '0', 0, 'C');
        $this->pdf->Ln(6);
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->Cell(190, 5, 'Nomor : ' . $wa->no_surat, '0', 0, 'C');
        $this->pdf->Ln(30);
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Cell(55, 5, 'Kepala SMA Telkom Bandung dengan ini menerangkan bahwa :', '0', 0, '');
        $this->pdf->Ln(7);
        $this->pdf->Cell(55, 5, 'Kode Pendaftaran', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(50, 5, $student->nodaftar, '0', 1, 'L');
        //$this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Cell(55, 5, 'Nama', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(50, 5, $student->name, '0', 1, 'L');
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Cell(55, 5, 'Asal Sekolah', '0', 0, 'L');
        $this->pdf->Cell(5, 5, ':', '0', 0, 'L');
        $this->pdf->Cell(1, 5, '', '0', 0, 'L');
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(50, 5, $student->asal_sekolah, '0', 1, 'L');
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Cell(55, 5, 'Berdasarkan hasil seleksi Test PPDB tahun 2023, yang bersangkutan dinyatakan :', '0', 0, '');
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', 'B', 22);
        $this->pdf->Cell(45);
        $this->pdf->Cell(100, 15, 'DITERIMA', 1, 0, 'C');
        $this->pdf->Ln(20);
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Cell(55, 5, 'Menjadi peserta didik baru kelas X SMA Telkom Bandung tahun pelajaran 2023-2024.', '0', 0, '');
        $this->pdf->Ln(5);
        $this->pdf->Cell(55, 5, 'Demikian surat keterangan ini kami buat untuk diketahui dan dipergunakan sebagaimana mestinya.', '0', 0, '');
        $this->pdf->Ln(20);
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Cell(120);
        $this->pdf->Cell(100, 15, 'Bandung, ' . Carbon::parse($wa->tanggal_surat)->isoFormat('D MMMM Y'), 0, 0, 'L');
        $this->pdf->Ln(5);
        $this->pdf->Cell(120);
        $this->pdf->Cell(100, 15, 'Kepala,', 0, 0, 'L');
        $this->pdf->Ln(40);
        $this->pdf->Cell(120);
        $this->pdf->SetFont('Arial', 'BU', 11);
        $this->pdf->Cell(100, 15, 'Drs. TATANG TARYANA, M.M', 0, 0, 'L');
        $this->pdf->Ln(5);
        $this->pdf->Cell(120);
        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Cell(100, 15, 'NIP. 19640403 198803 1 010', 0, 0, 'L');
        $this->pdf->Output('I', 'Formulir ' . $student->name . '.pdf');
    }
}
