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
    @php
        $hitung = App\Models\Student::where('user_id', auth()->id())
            ->get()
            ->count();
        $siswa = App\Models\Student::with('user')->first();
        
    @endphp
    @if ($count != 1)
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
    @endif
    @include('student.modal.createnewstudent')
    @if (!empty($student))
        <div class="content-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">Profile Picture</h6>
                                <nav class="nav nav-with-icon tx-13">
                                    <button type="button"
                                        class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                                        data-toggle="modal" data-target="#exampleModal{{ $student->id }}">
                                        <i data-feather="plus"></i>
                                    </button>
                                </nav>
                            </div><!-- card-header -->
                            <div class="card-body">
                                <div class="media d-block d-sm-flex">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="avatar avatar-xl mb-3"><img src="https://via.placeholder.com/500"
                                                class="rounded-circle" alt=""></div>
                                    </div>
                                    <div class="media-body pd-t-25 pd-sm-t-0 pd-sm-l-25">
                                        <h5 class="mg-b-5">{{ $student->name }}</h5>
                                        <p class="mg-b-3 tx-color-02"><span
                                                class="tx-medium tx-color-01">{{ auth()->user()->email }}</p>
                                        <span class="d-block tx-13 tx-color-03">TIM PPDB SMA TELKOM
                                            {{ Carbon\carbon::now()->format('Y') }}</span>
                                    </div>
                                </div><!-- media -->
                            </div>
                        </div>
                    </div><!-- col -->
                    <div class="col-lg-8">
                        <div class="card mg-b-20 mg-lg-b-25">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">BIODATA SISWA</h6>
                                <nav class="nav nav-with-icon tx-13">
                                    <a href="" class="nav-link"><i data-feather="plus"></i> Add New</a>
                                </nav>
                            </div><!-- card-header -->
                            <div class="card-body pd-25">
                                <div class="media d-block d-sm-flex">
                                    <div
                                        class="wd-80 ht-80 bg-ui-04 rounded d-flex align-items-center justify-content-center">
                                        <i data-feather="briefcase" class="tx-white-7 wd-40 ht-40"></i>
                                    </div>
                                    <div class="media-body pd-t-25 pd-sm-t-0 pd-sm-l-25">
                                        <h5 class="mg-b-5">Biodata Calon Siswa</h5>
                                        <p class="mg-b-3 tx-color-02"><span class="tx-medium tx-color-01">Silahkan untuk
                                                Melengkapi Biodata Dengan Data yang Sesuai</p>
                                        <span class="d-block tx-13 tx-color-03">TIM PPDB SMA TELKOM
                                            {{ Carbon\carbon::now()->format('Y') }}</span>

                                        <ul class="pd-l-10 mg-0 mg-t-20 tx-13">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <li class="font-weight-bold">Nama Lengkap : {{ $student->name }}</li>
                                                    <li class="font-weight-bold">Jenis Kelamin :
                                                        {{ $student->jenis_kelamin }}
                                                    </li>
                                                    <li class="font-weight-bold">Tempat Lahir : {{ $student->tempat_lahir }}
                                                    </li>
                                                    <li class="font-weight-bold">Tanggal Lahir :
                                                        {{ $student->tanggal_lahir }}
                                                    </li>
                                                    <li class="font-weight-bold">NIK : {{ $student->nik }}</li>
                                                    <li class="font-weight-bold">Agama : {{ $student->agama }}</li>
                                                    <li class="font-weight-bold">No Handphone : {{ $student->nohp_siswa }}
                                                    </li>
                                                    <li class="font-weight-bold">Anak Ke : {{ $student->anak_ke }}</li>
                                                </div>
                                                <div class="col-lg-6">
                                                    <li class="font-weight-bold">Jumlah Saudara :
                                                        {{ $student->jumlah_saudara }}
                                                    </li>
                                                    <li class="font-weight-bold">Tinggi Badan :
                                                        {{ $student->tinggi_badan }}
                                                    </li>
                                                    <li class="font-weight-bold">Berat Badan : {{ $student->berat_badan }}
                                                    </li>
                                                    <li class="font-weight-bold">Hoby : {{ $student->hoby }}</li>
                                                    <li class="font-weight-bold">Cita - cita : {{ $student->cita }}</li>
                                                </div>
                                            </div>


                                        </ul>
                                    </div>
                                </div><!-- media -->
                            </div>
                            {{-- <div class="card-footer bg-transparent pd-y-15 pd-x-20">
                            <nav class="nav nav-with-icon tx-13">
                                <a href="" class="nav-link">
                                    Show More Experiences (4)
                                    <i data-feather="chevron-down" class="mg-l-2 mg-r-0 mg-t-2"></i>
                                </a>
                            </nav>
                        </div><!-- card-footer --> --}}
                        </div><!-- card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mt-3">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">Asal Sekolah</h6>
                                <nav class="nav nav-with-icon tx-13">
                                    <button type="button"
                                        class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                                        data-toggle="modal" data-target="#exampleModal{{ $student->uuid }}"><i
                                            data-feather="plus"></i>
                                        Edit Asal
                                        Sekolah</button>
                                </nav>
                            </div><!-- card-header -->

                            <div class="card-body">
                                <div class="card-body pd-25">
                                    <div class="media d-block d-sm-flex">
                                        <div
                                            class="wd-80 ht-80 bg-ui-04 rounded d-flex align-items-center justify-content-center">
                                            <i data-feather="briefcase" class="tx-white-7 wd-40 ht-40"></i>
                                        </div>
                                        <div class="media-body pd-t-25 pd-sm-t-0 pd-sm-l-25">
                                            <h5 class="mg-b-5">Asal Sekolah SMP / MTs</h5>
                                            <p class="mg-b-3 tx-color-02"><span class="tx-medium tx-color-01">Jika ada
                                                    Kesalahan Asal
                                                    Sekolah, silahkan untuk mengedit dengan mengklik tombol edit asal
                                                    sekolah</span></p>
                                            <span class="d-block tx-13 tx-color-03">PPDB SMA TELKOM BANDUNG
                                                {{ Carbon\Carbon::now()->format('Y') }}</span>

                                            <ul class="pd-l-10 mg-0 mg-t-20 tx-13">
                                                <li>Nama Sekolah : {{ $student->asal_sekolah }}</li>
                                                <li>NPSN : {{ $student->npsn }}</li>
                                                <li>Kecamatan : {{ $student->kec_sekolah }}</li>
                                                <li>Kabupaten / Kota : {{ $student->kota_sekolah }}</li>
                                                <li>Provinsi : {{ $student->provinsi_sekolah }}</li>
                                            </ul>
                                        </div>
                                    </div><!-- media -->
                                    @include('student.modal.editsekolah')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mt-3">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">BIODATA ORANG TUA</h6>
                                <nav class="nav nav-with-icon tx-13">
                                    <button type="button"
                                        class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                                        data-toggle="modal" data-target="#exampleModal{{ $student->uuid }}"><i
                                            data-feather="plus"></i>
                                        Edit</button>
                                </nav>
                            </div><!-- card-header -->

                            <div class="card-body">
                                <div class="card-body pd-25">
                                    <div class="media d-block d-sm-flex">
                                        <div
                                            class="wd-80 ht-80 bg-ui-04 rounded d-flex align-items-center justify-content-center">
                                            <i data-feather="briefcase" class="tx-white-7 wd-40 ht-40"></i>
                                        </div>
                                        <div class="media-body pd-t-25 pd-sm-t-0 pd-sm-l-25">
                                            <h5 class="mg-b-5">BIODATA ORANG TUA</h5>
                                            <p class="mg-b-3 tx-color-02"><span class="tx-medium tx-color-01">Jika ada
                                                    Kesalahan Biodata Orang Tua, silahkan untuk mengedit dengan mengklik
                                                    tombol
                                                    edit</span></p>
                                            <span class="d-block tx-13 tx-color-03">PPDB SMA TELKOM BANDUNG
                                                {{ Carbon\Carbon::now()->format('Y') }}</span>

                                            <ul class="pd-l-10 mg-0 mg-t-20 tx-13">
                                                <li>Nomor KK : {{ $student->no_kk }}</li>
                                                <li>Nama Ayah : {{ $student->nama_ayah }}</li>
                                                <li>Tahun Lahir : {{ $student->tahun_ayah }}</li>
                                                <li>Pendidikan Ayah : {{ $student->pendidikan_ayah }}</li>
                                                <li>Pekerjaan Ayah : {{ $student->pekerjaan_ayah }}</li>
                                                <li>Penghasilan Ayah : {{ $student->penghasilan_ayah }}</li>
                                                <li>Nama Ibu : {{ $student->nama_ibu }}</li>
                                                <li>Tahun Lahir : {{ $student->tahun_Ibu }}</li>
                                                <li>Pendidikan Ibu : {{ $student->pendidikan_ibu }}</li>
                                                <li>Pekerjaan Ibu : {{ $student->pekerjaan_ibu }}</li>
                                                <li>Penghasilan Ibu : {{ $student->penghasilan_ibu }}</li>
                                            </ul>
                                        </div>
                                    </div><!-- media -->
                                    @include('student.modal.editsekolah')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">Alamat Domisili</h6>
                                <nav class="nav nav-with-icon tx-13">
                                    <a href="" class="nav-link"><i data-feather="plus"></i> Add New</a>
                                </nav>
                            </div><!-- card-header -->
                            <div class="card-body">
                                <div class="media d-block d-sm-flex">
                                    <div
                                        class="wd-80 ht-80 bg-ui-04 rounded d-flex align-items-center justify-content-center">
                                        <i data-feather="briefcase" class="tx-white-7 wd-40 ht-40"></i>
                                    </div>
                                    <div class="media-body pd-t-25 pd-sm-t-0 pd-sm-l-25">
                                        <h5 class="mg-b-5">Biodata Calon Siswa</h5>
                                        <p class="mg-b-3 tx-color-02"><span class="tx-medium tx-color-01">Silahkan untuk
                                                Melengkapi Biodata Dengan Data yang Sesuai</p>
                                        <span class="d-block tx-13 tx-color-03">TIM PPDB SMA TELKOM
                                            {{ Carbon\carbon::now()->format('Y') }}</span>

                                        <ul class="pd-l-10 mg-0 mg-t-20 tx-13">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <li class="font-weight-bold">Alamat Rumah : {{ $student->alamat_pd }}
                                                    </li>
                                                    <li class="font-weight-bold">Jarak :
                                                        {{ $student->jarak . ' ' . 'Km' }}
                                                    </li>
                                                    <li class="font-weight-bold">Waktu : {{ $student->waktu . 'Menit' }}
                                                    </li>
                                                    <li class="font-weight-bold">Tanggal Lahir :
                                                        {{ $student->tanggal_lahir }}
                                                    </li>
                                                    <li class="font-weight-bold">NIK : {{ $student->nik }}</li>
                                                    <li class="font-weight-bold">Agama : {{ $student->agama }}</li>
                                                    <li class="font-weight-bold">No Handphone : {{ $student->nohp_siswa }}
                                                    </li>
                                                    <li class="font-weight-bold">Anak Ke : {{ $student->anak_ke }}</li>
                                                </div>
                                            </div>


                                        </ul>
                                    </div>
                                </div><!-- media -->
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    @endif

@endsection
