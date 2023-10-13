@extends('layouts.student.main')
@section('title')
    Biodata Diri, {{ auth()->user()->name }}
@endsection
@section('main')
    Biodata
@endsection
@section('data')
    Edit Biodata
@endsection
@section('content')
    @php
        $student = App\Models\Student::where('user_id', auth()->id())->first();
        $countverifikasi = App\Models\Payment::where('student_id', $student->id)
            ->where('verifikasi', 1)
            ->where('jenis_bayar', 'Titipan Pembayaran')
            ->count();
    @endphp
    @if ($countverifikasi != 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-solid alert-secondary alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p>Silahkan untuk mengisi data biodata dengan lengkap jika sudah lengkap maka akan ada tombol download
                        formulir.
                    </p>
                    @if ($student->doc_kk == null)
                        <span class="badge badge-danger"></span>
                    @elseif($student->doc_akte == null)
                        <span class="badge badge-danger"></span>
                    @elseif($student->foto == null)
                        <span class="badge badge-danger"></span>
                    @else
                        <span class="badge badge-success">
                            <a class="btn btn-danger btn-sm" target="_blank"
                                href="{{ route('printform', $student->uuid) }}">Download
                                Formulir</a>
                        </span>
                    @endif

                </div>

            </div>
        </div>
        <div class="row row-xs">

            <div class="col-sm-6 col-lg-6">

                <div class="card card-body border-danger">

                    <h6
                        class="tx-uppercase d-flex justify-content-between tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                        <a href="{{ route('biodata.edit') }}" class="stretched-link text-black text-decoration-none">
                            Biodata Calon Siswa</a>
                        @if ($student->cita == null)
                            <span class="badge badge-danger">Belum Lengkap</span>
                        @else
                            <span class="badge badge-success">Lengkap</span>
                        @endif
                    </h6>
                    <ul class="list-group list-group-flush tx-13">
                        <li class="list-group-item d-flex pd-sm-x-20">
                            <div class="avatar"><span class="avatar-initial rounded">
                                    <i data-feather="user" class="tx-white wd-20 ht-20"></i>
                                </span></div>
                            <div class="pd-l-10">
                                <p class="tx-medium mg-b-0">{{ $student->name }}</p>
                                <small class="tx-12 tx-color-03 mg-b-0">{{ $student->nodaftar }}</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- col -->
            <div class="col-sm-6 col-lg-6 mg-t-10 mg-sm-t-0">
                <div class="card card-body border-primary">
                    <h6
                        class="tx-uppercase tx-11 d-flex justify-content-between tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                        <a href="{{ route('editsekolah') }}" class="stretched-link text-black text-decoration-none">
                            Asal Sekolah</a>
                        @if ($student->npsn == null)
                            <span class="badge badge-danger">Belum Lengkap</span>
                        @elseif($student->nisn == null)
                            <span class="badge badge-danger">Belum Lengkap</span>
                        @else
                            <span class="badge badge-success">Lengkap</span>
                        @endif
                    </h6>
                    <ul class="list-group list-group-flush tx-13">
                        <li class="list-group-item d-flex pd-sm-x-10">
                            <div class="avatar"><span class="avatar-initial rounded">
                                    <i data-feather="briefcase" class="tx-white wd-20 ht-20"></i>
                                </span></div>
                            <div class="pd-l-10">
                                <p class="tx-medium mg-b-0">{{ $student->asal_sekolah }}</p>
                                <small class="tx-12 tx-color-03 mg-b-0">{{ $student->kota_sekolah }}</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- col -->
        </div>
        <div class="row row-xs mt-2">
            <div class="col-sm-6 col-lg-6 mg-t-10 mg-lg-t-0">
                <div class="card card-body border-warning">
                    <h6
                        class="tx-uppercase d-flex justify-content-between tx-11 tx-spacing-1 tx-color-02
                tx-semibold mg-b-8">
                        <a href="{{ route('editorangtua') }}" class="stretched-link text-black text-decoration-none">
                            Biodata Orang Tua</a>
                        @if ($student->no_kk == null)
                            <span class="badge badge-danger">Belum Lengkap</span>
                        @else
                            <span class="badge badge-success">Lengkap</span>
                        @endif
                    </h6>
                    <ul class="list-group list-group-flush tx-13">
                        <li class="list-group-item d-flex pd-sm-x-20">
                            <div class="avatar"><span class="avatar-initial rounded">
                                    <i data-feather="users" class="tx-white wd-20 ht-20"></i>
                                </span></div>
                            <div class="pd-l-10">
                                <p class="tx-medium mg-b-0">{{ $student->nama_ayah }}</p>
                                <p class="tx-medium mg-b-0">{{ $student->nama_ibu }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- col -->
            <div class="col-sm-6 col-lg-6 mg-t-10 mg-lg-t-0">
                <div class="card card-body border-danger">
                    <h6
                        class="tx-uppercase d-flex justify-content-between tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                        <a href="{{ route('file') }}" class="stretched-link text-black text-decoration-none">
                            Upload File</a>
                        @if ($student->doc_kk == null)
                            <span class="badge badge-danger">Belum Lengkap</span>
                        @elseif($student->doc_akte == null)
                            <span class="badge badge-danger">Belum Lengkap</span>
                        @elseif($student->foto == null)
                            <span class="badge badge-danger">Belum Lengkap</span>
                        @else
                            <span class="badge badge-success">Lengkap</span>
                        @endif
                    </h6>
                    <ul class="list-group list-group-flush tx-13">
                        <li class="list-group-item d-flex pd-sm-x-20">
                            <div class="avatar"><span class="avatar-initial rounded bg-blue-600">
                                    <i data-feather="file" class="tx-white wd-20 ht-20"></i>
                                </span></div>
                            <div class="pd-l-10">
                                <p class="tx-medium mg-b-0">Silahkan Upload File Ijazah, Akte Lahir, dan KK</p>
                                <small class="tx-12 tx-color-03 mg-b-0">{{ $student->nodaftar }}</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- col -->
        </div>
    @else
        <div class="card-body">
            <div class="alert alert-solid alert-info alert-dismissible fade show" role="alert">
                <p>Ananda {{ $student->name }} Belum diperkenankan untuk mengisi biodata, Silahkan Ananda
                    {{ $student->name }} untuk melakukan titipan pembayaran terlebih dahulu. Info lebih lanjut silahkan
                    menghubungi Admin PPDB SMA TELKOM BANDUNG
                </p>
            </div>
        </div>
    @endif

@endsection
