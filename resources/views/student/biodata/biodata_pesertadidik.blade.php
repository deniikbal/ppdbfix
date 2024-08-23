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
        <div class="col-lg-3 mb-2">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <p>Silahkan untuk mengisi biodata calon peserta didik dengan benar</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <form action="{{route('savebiodata', $student->id)}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{ $student->name }}" class="form-control"
                                       id="inputEmail3" placeholder="Nama Lengkap">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">NISN</label>
                            <div class="col-sm-9">
                                <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}"
                                       class="form-control @error('nisn') is-invalid @enderror"
                                       placeholder="Nomor Induk Siswa Nasional">
                                @error('nisn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" name="tempat_lahir"
                                       value="{{ old('tempat_lahir', $student->tempat_lahir) }}"
                                       class="form-control @error('tempat_lahir') is-invalid @enderror"
                                       placeholder="Kota / Kabupaten Tempat Lahir">
                                @error('tempat_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal_lahir"
                                       value="{{ old('tanggal_lahir', $student->tanggal_lahir) }}"
                                       class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                       placeholder="Nomor Induk Siswa Nasional">
                                @error('tanggal_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
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
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Agama</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('agama') is-invalid @enderror" name="agama"
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
                                <select class="form-control select2" name="asal_sekolah">
                                    <option value="">---Pilih---</option>
                                    @foreach ($schools as $item)
                                        <option
                                            value="{{ $item->sekolah }}"{{ $item->sekolah == $student->asal_sekolah ? 'selected' : '' }}>
                                            {{ $item->sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('asal_sekolah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">No WA Calon PD</label>
                            <div class="col-sm-9">
                                <input type="text" name="nohp_siswa"
                                       value="{{ old('nohp_siswa',$student->nohp_siswa) }}"
                                       class="form-control @error('nohp_siswa') is-invalid @enderror"
                                       placeholder="Desa / Kelurahan">
                                @error('nohp_siswa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="divider-text">DATA ORANGTUA</div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_ayah" value="{{ old('nama_ayah',$student->nama_ayah) }}"
                                       class="form-control @error('nama_ayah') is-invalid @enderror"
                                       id="inputEmail3" placeholder="Nama Ayah">
                                @error('nama_ayah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 @error('pekerjaan_ayah') is-invalid @enderror"
                                        name="pekerjaan_ayah">
                                    <option value="">--Pilih--</option>
                                    @foreach ($pekerjaan as $item)
                                        <option value="{{ $item }}"
                                            {{ $item == old('pekerjaan_ayah', $student->pekerjaan_ayah) ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pekerjaan_ayah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_ibu" value="{{ old('nama_ibu',$student->nama_ibu) }}"
                                       class="form-control @error('nama_ibu') is-invalid @enderror"
                                       id="inputEmail3" placeholder="Nama Ibu">
                                @error('nama_ibu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 @error('pekerjaan_ibu') is-invalid @enderror"
                                        name="pekerjaan_ibu">
                                    <option value="">--Pilih--</option>
                                    @foreach ($pekerjaan as $item)
                                        <option value="{{ $item }}"
                                            {{ $item == old('pekerjaan_ibu', $student->pekerjaan_ibu) ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pekerjaan_ibu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">No WA Orang Tua</label>
                            <div class="col-sm-9">
                                <input type="text" name="nohp_ortu" value="{{ old('nohp_ortu',$student->nohp_ortu) }}"
                                       class="form-control @error('nohp_ortu') is-invalid @enderror"
                                       id="inputEmail3" placeholder="Desa / Kelurahan">
                                @error('nohp_ortu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="divider-text">ALAMAT ORANGTUA</div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Jalan</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat_pd" value="{{ old('alamat_pd', $student->alamat_pd) }}"
                                       class="form-control @error('alamat_pd') is-invalid @enderror"
                                       id="inputEmail3" placeholder="Jalan">
                                @error('alamat_pd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">RT</label>
                            <div class="col-sm-3">
                                <input type="text" name="rt" value="{{ old('rt', $student->rt) }}"
                                       class="form-control @error('rt') is-invalid @enderror"
                                       placeholder="RT">
                                @error('rt')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">RW</label>
                            <div class="col-sm-4">
                                <input type="text" name="rw" value="{{ old('rw', $student->rw) }}"
                                       class="form-control @error('rw') is-invalid @enderror"
                                       id="inputEmail3" placeholder="RW">
                                @error('rw')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Desa / Kelurahan</label>
                            <div class="col-sm-9">
                                <input type="text" name="desa_pd" value="{{ old('desa_pd', $student->desa_pd) }}"
                                       class="form-control @error('desa_pd') is-invalid @enderror"
                                       id="inputEmail3" placeholder="Desa / Kelurahan">
                                @error('desa_pd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                <input type="text" name="kec_pd" value="{{ old('kec_pd', $student->kec_pd) }}"
                                       class="form-control"
                                       id="inputEmail3" placeholder="Kecamatan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Kabupaten</label>
                            <div class="col-sm-9">
                                <input type="text" name="kota_pd" value="{{ old('kota_pd', $student->kota_pd) }}"
                                       class="form-control"
                                       id="inputEmail3" placeholder="Kabupaten">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                <input type="text" name="provinsi_pd"
                                       value="{{ old('provinsi_pd', $student->provinsi_pd) }}" class="form-control"
                                       placeholder="Provinsi">
                            </div>
                        </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
