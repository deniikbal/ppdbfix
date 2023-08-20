@extends('layouts.student.main')
@section('title')
    Edit Asal Sekolah
@endsection
@section('main')
    Asal Sekolah
@endsection
@section('data')
    Daftar Calon Siswa
@endsection
@section('content')
    <div class="col-lg-12 col-sm-6">
        <div class="card mt-3">
            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">Asal Sekolah SMP / MTs</h6>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                            data-toggle="modal" data-target="#exampleModal{{ $student->uuid }}"><i
                                data-feather="plus"></i>
                        Edit Asal
                        Sekolah
                    </button>
                    <a href="{{route('isibiodata')}}" class="ml-2 btn btn-sm btn-danger">
                        <i data-feather="skip-back"></i> Kembali</a>
                </div>
            </div><!-- card-header -->
            <div class="card-body pd-25">
                <div class="media d-block d-sm-flex">
                    <div class="wd-80 ht-80 bg-ui-04 rounded d-flex align-items-center justify-content-center">
                        <i data-feather="briefcase" class="tx-white-7 wd-40 ht-40"></i>
                    </div>
                    <div class="media-body pd-t-25 pd-sm-t-0 pd-sm-l-25">
                        <h5 class="mg-b-5">Asal Sekolah SMP / MTs</h5>
                        <p class="mg-b-3 tx-color-02"><span class="tx-medium tx-color-01">Jika ada Kesalahan Asal
                                    Sekolah, silahkan untuk mengedit dengan mengklik tombol edit asal sekolah</span></p>
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

@endsection