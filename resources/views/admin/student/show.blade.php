@extends('layouts.admin.app')

@section('welcome')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Student</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Edit Student</h4>
    </div>
    <div class="d-none d-md-block">
        <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="clock"
                                                                               class="wd-10 mg-r-5"></i>
            {{ \Carbon\Carbon::now()->format('D, d M Y H:i:s') }}
        </button>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header tx-uppercase bg-indigo-light">
                    BIODATA {{ $student->name }}
                </div>
                <div class="card-body">
                    <form action="{{ route('updatestudentadmin', $student->uuid) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-row mb-1">
                            <div class="form-group col-md-6">
                                <label>Nama Lengkap: <span class="tx-danger">*</span></label>
                                <input id="name" class="form-control" name="name" value="{{ $student->name }}"
                                       type="text">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label>No Daftar: <span class="tx-danger">*</span></label>
                                <input id="name" class="form-control @error('nodaftar') is-invalid @enderror"
                                       name="nodaftar" value="{{
                                $student->nodaftar
                                 }}"
                                       type="text">
                                @error('nodaftar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label>Jenis Kelamin: <span class="tx-danger">*</span></label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin" id="">
                                    <option value="">--Pilih--</option>
                                    @foreach ($jenis_kelamin as $item)
                                        <option value="{{ $item }}"
                                                {{ $item == old('jenis_kelamin', $student->jenis_kelamin) ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tempat Lahir: <span class="tx-danger">*</span></label>
                                <input id="lastname" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                       name="tempat_lahir" type="text"
                                       value="{{ old('tempat_lahir', $student->tempat_lahir) }}">
                                @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Lahir: <span class="tx-danger">*</span></label>
                                <input id="lastname" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                       name="tanggal_lahir" type="date"
                                       value="{{ old('tanggal_lahir', $student->tanggal_lahir) }}">
                                @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>NIK: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('nik') is-invalid @enderror" name="nik" type="text"
                                       value="{{ old('nik', $student->nik) }}">
                                @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Agama: <span class="tx-danger">*</span></label>

                                <select class="form-control select2 @error('agama') is-invalid @enderror" name="agama"
                                        id="">
                                    <option value="">--Pilih--</option>
                                    @foreach ($agama as $item)
                                        <option value="{{ $item }}"
                                                {{ $item == old('agama', $student->agama) ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('agama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>
                            <div class="form-group col-md-4">
                                <label>No HP: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('nohp_siswa') is-invalid @enderror" name="nohp_siswa"
                                       type="text"
                                       value="{{ $student->nohp_siswa === null ? old('nohp_siswa') : $student->nohp_siswa }}">
                                @error('nohp_siswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Anak Ke-: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('anak_ke') is-invalid @enderror" name="anak_ke"
                                       type="text"
                                       value="{{ $student->anak_ke === null ? old('anak_ke') : $student->anak_ke }}">
                                @error('anak_ke')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Jumlah Saudara: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('jumlah_saudara') is-invalid @enderror"
                                       name="jumlah_saudara" type="text"
                                       value="{{ $student->jumlah_saudara === null ? old('jumlah_saudara') : $student->jumlah_saudara }}">
                                @error('jumlah_saudara')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tinggi Badan: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('tinggi_badan') is-invalid @enderror"
                                       name="tinggi_badan"
                                       type="text"
                                       value="{{ $student->tinggi_badan === null ? old('tinggi_badan') : $student->tinggi_badan }}">
                                @error('tinggi_badan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Berat Badan: <span class="tx-danger">*</span></label>
                                <input class="form-control @error('berat_badan') is-invalid @enderror"
                                       name="berat_badan"
                                       type="text"
                                       value="{{ $student->berat_badan === null ? old('berat_badan') : $student->berat_badan }}">
                                @error('berat_badan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Hoby: <span class="tx-danger">*</span></label>
                                <select class="form-control select2 @error('hoby') is-invalid @enderror" name="hoby"
                                        id="">
                                    <option value="">--Pilih--</option>
                                    @foreach ($hoby as $item)
                                        <option value="{{ $item }}"
                                                {{ $item == old('hoby', $student->hoby) ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('hoby')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Cita - Cita: <span class="tx-danger">*</span></label>
                                <select class="form-control select2 @error('cita') is-invalid @enderror" name="cita"
                                        id="">
                                    <option value="">--Pilih--</option>
                                    @foreach ($cita as $item)
                                        <option value="{{ $item }}"
                                                {{ $item == old('cita', $student->cita) ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cita')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end bg-indigo-light">
                <a href="{{route('allstudent')}}" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-save"></i> Simpan
                </button>

            </div>
            </form>
        </div>
        <div class="card mt-3">
            <div class="card-header bg-indigo-light pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">Asal Sekolah SMP / MTs</h6>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm pd-x-15 btn-primary btn-xs btn-uppercase mg-l-5"
                            data-toggle="modal" data-target="#exampleModal{{ $student->uuid }}"><i
                                data-feather="plus"></i>
                        Edit Asal
                        Sekolah
                    </button>
                </div>
            </div><!-- card-header -->
            <div class="card-body">
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
            <div class="card-footer d-flex justify-content-end bg-indigo-light">
                <a href="{{route('allstudent')}}" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </div>
        </div>
    </div>
    </div>
@endsection
