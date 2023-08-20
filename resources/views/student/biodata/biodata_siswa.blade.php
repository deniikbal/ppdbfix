@extends('layouts.student.main')
@section('title')
    Edit Biodata Calon Siswa
@endsection
@section('main')
    Biodata
@endsection
@section('data')
    Edit Biodata Calon Siswa
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header pd-y-15 pd-x-20 bg-primary-light d-flex align-items-center justify-content-between">
                <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">BIODATA SISWA</h6>
                <nav class="nav nav-with-icon tx-13">
                    <a href="{{route('student.index')}}" class="btn btn-danger btn-sm"><i data-feather="skip-back"></i>
                        Kembali</a>
                </nav>
            </div><!-- card-header -->
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('updatebiodata', $student->uuid) }}" method="post">
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
                            <div class="form-group col-md-6">
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
                        <div class="form-row d-flex justify-content-center">
                            <button class="btn btn-success" type="submit">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

