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
        $settled = App\Models\payment_xendit::where('status','settled')->where('student_id',
                    $student->id)->where('description', 'Titipan Pembayaran')->count();
    @endphp
    @if($settled !=0)
        <div class="row row-xs">
            <div class="col-sm-6 col-lg-6">
                <div class="card card-body border-danger">
                    <h6 class="tx-uppercase d-flex justify-content-between tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                        <a href="{{route('biodata.edit')}}"
                           class="stretched-link text-black text-decoration-none">
                            Biodata Calon Siswa</a>
                        @if($student->cita==null)
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
                                <p class="tx-medium mg-b-0">{{$student->name}}</p>
                                <small class="tx-12 tx-color-03 mg-b-0">{{$student->nodaftar}}</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- col -->
            <div class="col-sm-6 col-lg-6 mg-t-10 mg-sm-t-0">
                <div class="card card-body border-primary">
                    <h6 class="tx-uppercase tx-11 d-flex justify-content-between tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                        <a href="{{route('editsekolah')}}"
                           class="stretched-link text-black text-decoration-none">
                            Asal Sekolah</a>
                        @if($student->npsn==null)
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
                                <p class="tx-medium mg-b-0">{{$student->asal_sekolah}}</p>
                                <small class="tx-12 tx-color-03 mg-b-0">{{$student->kota_sekolah}}</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- col -->
        </div>
        <div class="row row-xs mt-2">
            <div class="col-sm-6 col-lg-6 mg-t-10 mg-lg-t-0">
                <div class="card card-body border-warning">
                    <h6 class="tx-uppercase d-flex justify-content-between tx-11 tx-spacing-1 tx-color-02
                tx-semibold mg-b-8">
                        <a href="{{route('editorangtua')}}"
                           class="stretched-link text-black text-decoration-none">
                            Biodata Orang Tua</a>
                        @if($student->no_kk==null)
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
                                <p class="tx-medium mg-b-0">{{$student->nama_ayah}}</p>
                                <p class="tx-medium mg-b-0">{{$student->nama_ibu}}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- col -->
            <div class="col-sm-6 col-lg-6 mg-t-10 mg-lg-t-0">
                <div class="card card-body border-danger">
                    <h6 class="tx-uppercase d-flex justify-content-between tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                        <a href=""
                           class="stretched-link text-black text-decoration-none">
                            Upload File</a>
                        @if($student->ijazah==null)
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
                                <small class="tx-12 tx-color-03 mg-b-0">{{$student->nodaftar}}</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- col -->
        </div>
    @else
        <div class="card-body">
            <div class="alert alert-solid alert-info alert-dismissible fade show" role="alert">
                <p>Pada menu pembayaran ini silahkan untuk mengikuti </p>
            </div>
        </div>
    @endif

@endsection
