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
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-solid alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <p>Silahkan untuk mengisi data biodata dengan lengkap jika sudah lengkap.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#diri" role="tab"
                               aria-controls="home" aria-selected="true">Data Diri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ayah" role="tab"
                               aria-controls="profile" aria-selected="false">Data Ayah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#ibu" role="tab"
                               aria-controls="contact" aria-selected="false">Data Ibu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#asal" role="tab"
                               aria-controls="contact" aria-selected="false">Asal Sekolah</a>
                        </li>
                    </ul>
                    <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
                        <div class="tab-pane fade show active" id="diri" role="tabpanel" aria-labelledby="home-tab">
                            <form action="{{route('updatestudent',$student->id)}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">NIK</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nik" value="{{ old('nik', $student->nik) }}" class="form-control @error('nik') is-invalid @enderror"
                                               id="inputEmail3" placeholder="Nomor Induk Kependudukan (NIK)">
                                        @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name', $student->name) }}" placeholder="Nama Lengkap">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">NISN</label>
                                    <div class="col-sm-10">
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="alamat_pd" value="{{ old('alamat_pd', $student->alamat_pd) }}"
                                               class="form-control @error('alamat_pd') is-invalid @enderror"
                                               id="inputEmail3" placeholder="Alamat Tempat Tinggal">
                                        @error('alamat_pd')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Desa / Kelurahan</label>
                                    <div class="col-sm-10">
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kecamatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="kec_pd" value="{{ old('kec_pd', $student->kec_pd) }}"
                                               class="form-control"
                                               id="inputEmail3" placeholder="Kecamatan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kabupaten</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="kota_pd" value="{{ old('kota_pd', $student->kota_pd) }}"
                                               class="form-control"
                                               id="inputEmail3" placeholder="Kabupaten">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Provinsi</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="provinsi_pd"
                                               value="{{ old('provinsi_pd', $student->provinsi_pd) }}" class="form-control"
                                               placeholder="Provinsi">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Pos</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="kode_pos"
                                               value="{{ old('kode_pos', $student->kode_pos) }}"
                                               class="form-control @error('kode_pos') is-invalid @enderror"
                                               placeholder="Kode Pos">
                                        @error('kode_pos')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Agama</label>
                                    <div class="col-sm-10">
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Suku</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="suku"
                                               value="{{ old('suku', $student->suku) }}" class="form-control @error('suku') is-invalid @enderror"
                                               placeholder="Contoh : Sunda">
                                        @error('suku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Bahasa Sehari-hari</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="bahasa"
                                               value="{{ old('bahasa', $student->bahasa) }}" class="form-control @error('bahasa') is-invalid @enderror"
                                               placeholder="Contoh : Bahasa Sunda">
                                        @error('bahasa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Anak Ke- Berapa</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="anak_ke"
                                               value="{{ old('anak_ke', $student->anak_ke) }}" class="form-control @error('anak_ke') is-invalid @enderror"
                                               placeholder="Anak Ke">
                                        @error('anak_ke')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Golongan Darah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="golongan"
                                               value="{{ old('golongan', $student->golongan) }}" class="form-control
                                               @error('golongan') is-invalid @enderror"
                                               placeholder="Golongan Darah">
                                        @error('golongan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No WhatsApp</label>
                                    <div class="col-sm-10">
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
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email"
                                               value="{{ old('email',$student->email) }}"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Email Calon Peserta Didik">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mg-b-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-danger">SUBMIT FORM</button>
                                    </div>
                                </div>
                            </form  >

                        </div>
                        <div class="tab-pane fade" id="ayah" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{route('updateayah',$student->id)}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Ayah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_ayah"
                                               value="{{ old('nama_ayah',$student->nama_ayah) }}"
                                               class="form-control @error('nama_ayah') is-invalid @enderror"
                                               placeholder="Nama Lengkap Ayah">
                                        @error('nama_ayah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Usia Ayah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="usia_ayah"
                                               value="{{ old('usia_ayah',$student->usia_ayah) }}"
                                               class="form-control @error('usia_ayah') is-invalid @enderror"
                                               placeholder="Usia Ayah">
                                        @error('usia_ayah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat Ayah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="alamat_ayah"
                                               value="{{ old('alamat_ayah',$student->alamat_ayah) }}"
                                               class="form-control @error('alamat_ayah') is-invalid @enderror"
                                               placeholder="Desa / Kelurahan">
                                        @error('alamat_ayah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No WhatsApp Ayah</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nowa_ayah"
                                               value="{{ old('nowa_ayah',$student->nowa_ayah) }}"
                                               class="form-control @error('nowa_ayah') is-invalid @enderror"
                                               placeholder="No WhatsApp Ayah">
                                        @error('nowa_ayah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pendidikan Ayah</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2 @error('pendidikan_ayah') is-invalid @enderror"
                                                name="pendidikan_ayah">
                                            <option value="">--Pilih--</option>
                                            @foreach ($pendidikan as $item)
                                                <option value="{{ $item }}"
                                                    {{ $item == old('pendidikan_ayah', $student->pendidikan_ayah) ? 'selected' : '' }}>
                                                    {{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pendidikan_ayah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pekerjaan Ayah</label>
                                    <div class="col-sm-10">
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
                                <div class="form-group row mg-b-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-danger">SUBMIT FORM</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="ibu" role="tabpanel" aria-labelledby="contact-tab">
                            <form action="{{route('updateibu',$student->id)}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Ibu</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama_ibu"
                                               value="{{ old('nama_ibu',$student->nama_ibu) }}"
                                               class="form-control @error('nama_ibu') is-invalid @enderror"
                                               placeholder="Nama Lengkap Ibu">
                                        @error('nama_ibu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Usia Ibu</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="usia_ibu"
                                               value="{{ old('usia_ibu',$student->usia_ibu) }}"
                                               class="form-control @error('usia_ibu') is-invalid @enderror"
                                               placeholder="Usia Ibu">
                                        @error('usia_ibu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat Ibu</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="alamat_ibu"
                                               value="{{ old('alamat_ibu',$student->alamat_ibu) }}"
                                               class="form-control @error('alamat_ibu') is-invalid @enderror"
                                               placeholder="Alamat Ibu">
                                        @error('alamat_ibu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No WhatsApp Ibu</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nowa_ibu"
                                               value="{{ old('nowa_ibu',$student->nowa_ibu) }}"
                                               class="form-control @error('nowa_ibu') is-invalid @enderror"
                                               placeholder="No WhatsApp Ibu">
                                        @error('nowa_ibu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pendidikan Ibu</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2 @error('pendidikan_ibu') is-invalid @enderror"
                                                name="pendidikan_ibu">
                                            <option value="">--Pilih--</option>
                                            @foreach ($pendidikan as $item)
                                                <option value="{{ $item }}"
                                                    {{ $item == old('pendidikan_ibu', $student->pendidikan_ibu) ? 'selected' : '' }}>
                                                    {{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pendidikan_ibu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pekerjaan Ibu</label>
                                    <div class="col-sm-10">
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
                                <div class="form-group row mg-b-0">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-danger">SUBMIT FORM</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="asal" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="media-body pd-t-25 pd-sm-t-0 pd-sm-l-25">
                                <h5 class="mg-b-5">Asal Sekolah SMP / MTs</h5>
                                <p class="mg-b-3 tx-color-02"><span class="tx-medium tx-color-01">Jika ada Kesalahan Asal
                                    Sekolah, silahkan untuk mengedit dengan mengklik tombol edit asal sekolah</span></p>
                                <span class="d-block tx-13 tx-color-03">PPDB SMA TELKOM BANDUNG
                                {{ Carbon\Carbon::now()->format('Y') }}</span>

                                <ul class="pd-l-10 mg-0 mg-t-20 tx-13">
                                    <li>NISN : {{ $student->nisn }}</li>
                                    <li>Nama Sekolah : {{ $student->asal_sekolah }}</li>
                                    <li>NPSN : {{ $student->npsn }}</li>
                                    <li>Kecamatan : {{ $student->kec_sekolah }}</li>
                                    <li>Kabupaten / Kota : {{ $student->kota_sekolah }}</li>
                                    <li>Provinsi : {{ $student->provinsi_sekolah }}</li>
                                </ul>
                                <button type="button" class="btn btn-sm pd-x-15 btn-danger btn-xs btn-uppercase mg-l-5"
                                        data-toggle="modal" data-target="#exampleModal{{ $student->uuid }}"><i
                                        data-feather="plus"></i>
                                    Edit Asal
                                    Sekolah
                                </button>
                            </div>
                            @include('student.modal.editsekolah')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
