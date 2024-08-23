@extends('layouts.student.main')
@section('title')
    Biodata Calon Peserta Didik, {{ $student->name }}
@endsection
@section('main')
    Biodata
@endsection
@section('data')
    Edit Biodata
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
        </div>
        <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                    <input type="text" name="name" value="{{ $student->name }}" class="form-control" id="inputEmail3" placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">NISN</label>
                    <div class="col-sm-9">
                    <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}" class="form-control" id="inputEmail3" placeholder="Nomor Induk Siswa Nasional">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-9">
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $student->tempat_lahir) }}" class="form-control" id="inputEmail3" placeholder="Kota / Kabupaten Tempat Lahir">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $student->tanggal_lahir) }}" class="form-control" id="inputEmail3" placeholder="Nomor Induk Siswa Nasional">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                    <select class="form-control select2 @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="">
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
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Agama</label>
                    <div class="col-sm-9">
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
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Asal Sekolah</label>
                    <div class="col-sm-9">
                        <select class="form-control select2" id="asal_sekolah" name="asal_sekolah">
                            <option value="">---Pilih---</option>
                                @foreach ($schools as $item)
                                    <option
                                            value="{{ $item->id }}"{{ $item->sekolah == $student->asal_sekolah ? 'selected' : '' }}>
                                        {{ $item->sekolah }}
                                    </option>
                                @endforeach
                        </select>

                        @error('agama')
                            <div class="invalid-feedback">
                                    {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <hr>
            </div>
        </div>
        </div>
    </div>
@endsection
