@extends('layouts.student.app')
@section('content')
    <div class="card-body">
        <div class="alert alert-solid alert-secondary alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <p>Selamat datang di web PPDB SMA TELKOM BANDUNG Tahun Ajaran 2023-2024,
                Berikut Langkah-langkah pendaftaran Calon Siswa <strong>SMA TELKOM BANDUNG</strong></p>
            <ol>
                <li>Klik tombol Tambah Siswa Baru {{$count}}
                    @if($count != 1)
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
                <li>Isi data siswa dengan mengklik
                    <diV class="badge badge-danger"> Verifikasi Data Siswa dan Sekolah</diV>
                    , harap di isi data siswa dengan
                    data sebenar-benarnya dan jika sudah terisi semua klik simpan permananen diakhir mengisi.
                </li>
                <li>Klik tombol
                    <div class="badge badge-primary">Pembayaran Biaya Pendidikan</div>
                    , upload bukti transfernya.
                </li>
                <li>Jika pembayaran sudah diverifikasi Download file
                    <div class="badge badge-dark">Kartu Peserta dan Kartu Formulir</div>
                </li>
            </ol>
        </div>
    </div>
    @if($student==null)
        <div class="col-lg-12">

        </div><!-- col -->
    @else
        <div class="col-sm-6 col-lg-6">
            <div class="card card-body border-danger">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                    @if($student->verifikasi==1)
                        <a href="{{route('verifikasisiswa', $student)}}" class="stretched-link text-black text-decoration-none">
                            Verifikasi Data Siswa dan Sekolah</a>
                    @else
                        <a href="{{route('student.edit', $student)}}" class="stretched-link text-black text-decoration-none">
                            Verifikasi Data Siswa dan Sekolah</a>
                    @endif
                </h6>
                <ul class="list-group list-group-flush tx-13">
                    <li class="list-group-item d-flex pd-sm-x-20">
                        <div class="avatar"><span class="avatar-initial rounded-circle bg-blue-600">V</span></div>
                        <div class="pd-l-10">
                            <p class="tx-medium mg-b-0">{{$student->name}}</p>
                            <small class="tx-12 tx-color-03 mg-b-0">{{$student->nodaftar}}</small>
                        </div>
                        <div class="mg-l-auto d-flex align-self-center">
                            <nav class="nav nav-icon-only">
                                <a href="" class="nav-link d-none d-sm-block"><i data-feather="mail"></i></a>
                                <a href="" class="nav-link d-none d-sm-block"><i data-feather="slash"></i></a>
                                <a href="" class="nav-link d-none d-sm-block"><i data-feather="user"></i></a>
                                <a href="" class="nav-link d-sm-none"><i data-feather="more-vertical"></i></a>
                            </nav>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- col -->
        <div class="col-sm-6 col-lg-6 mg-t-10 mg-sm-t-0">
            <div class="card card-body border-danger">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                    <a href="#" class="stretched-link text-black text-decoration-none">
                        Pembayaran Biaya Pendidikan</a>
                </h6>
                <ul class="list-group list-group-flush tx-13">
                    <li class="list-group-item d-flex pd-sm-x-20">
                        <div class="avatar"><span class="avatar-initial rounded-circle bg-red-600">B</span></div>
                        <div class="pd-l-10">
                            <p class="tx-medium mg-b-0">{{$student->name}}</p>
                            <small class="tx-12 tx-color-03 mg-b-0">{{$student->nodaftar}}</small>
                        </div>
                        <div class="mg-l-auto d-flex align-self-center">
                            <nav class="nav nav-icon-only">
                                <a href="" class="nav-link d-none d-sm-block"><i data-feather="mail"></i></a>
                                <a href="" class="nav-link d-none d-sm-block"><i data-feather="slash"></i></a>
                                <a href="" class="nav-link d-none d-sm-block"><i data-feather="user"></i></a>
                                <a href="" class="nav-link d-sm-none"><i data-feather="more-vertical"></i></a>
                            </nav>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- col -->
    @endif

    @include('student.modal.createnewstudent')
@endsection