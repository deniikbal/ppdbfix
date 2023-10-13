@extends('layouts.student.main')
@section('title')
    Welcome to Dashboard, {{ auth()->user()->name }}
@endsection
@section('main')
    Dashbaord
@endsection
@section('data')
    Daftar Calon Siswa
@endsection
@section('content')
    <div class="row">
        <div class="card-body">
            <div class="alert alert-solid alert-secondary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <p>Selamat datang di web PPDB SMA TELKOM BANDUNG Tahun Ajaran 2023-2024,
                    Berikut Langkah-langkah pendaftaran Calon Siswa <strong>SMA TELKOM BANDUNG</strong></p>
                <ol>
                    <li>Klik tombol Tambah Siswa Baru
                        @if ($count != 1)
                            <button type="button" class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                                data-toggle="modal" data-target="#exampleModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file wd-10 mg-r-5">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <polyline points="13 2 13 9 20 9"></polyline>
                                </svg>
                                Daftar Siswa Baru
                            </button>
                        @else
                            <button type="button" class="btn btn-sm pd-x-15 btn-warning btn-xs btn-uppercase mg-l-5"
                                disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file wd-10 mg-r-5">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <polyline points="13 2 13 9 20 9"></polyline>
                                </svg>
                                Daftar Siswa Baru
                            </button>
                        @endif
                        Isi dengan nama calon siswa yang akan didaftarkan.
                    </li>
                    <li>
                        Selanjutnya silahkan melakukan upload bukti transfer Titipan Pembayaran di menu pembayaran.
                    </li>
                    <li>
                        Jika sudah upload bukti transfer tunggu sampai pembayaran diverifikasi oleh admin.
                    </li>
                    <li>
                        Setelah diverifikasi oleh admin selanjutnya untuk mengisi <a class="badge badge-danger">
                            Biodata Calon Siswa, Asal Sekolah, Biodata
                            Orang Tua, dan upload Gambar Pas Foto, Akte Lahir dan Kartu Keluarga.
                        </a>
                    </li>
                    <li>
                        Jika mengisi biodata sudah lengkap maka akan ada tombol <a class="badge badge-primary">download
                            formulir.</a>
                    </li>
                </ol>
            </div>
        </div>
        @include('student.modal.createnewstudent')
    </div>
@endsection
