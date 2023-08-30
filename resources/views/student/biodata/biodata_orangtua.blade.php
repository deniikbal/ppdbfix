@extends('layouts.student.main')
@section('title')
    Edit Biodata Orang Tua
@endsection
@section('main')
    Biodata
@endsection
@section('data')
    Edit Biodata Orang Tua
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">Biodata Orang Tua</h6>
                <nav class="nav nav-with-icon tx-13">
                    <a href="{{ route('isibiodata') }}" class="btn btn-danger btn-sm"><i data-feather="skip-back"></i>
                        Kembali</a>
                </nav>
            </div><!-- card-header -->
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('updateorangtua', $student->uuid) }}" method="post">
                        @csrf
                        <div class="form-row mb-1">
                            <div class="form-group col-md-6">
                                <label>No Kartu Keluarga: <span class="tx-danger">*</span></label>
                                <input
                                    class="form-control @error('no_kk')
                                    is-invalid
                                @enderror"
                                    name="no_kk" value="{{ old('no_kk', $student->no_kk) }}" type="text">
                                @error('no_kk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="divider-text">DATA AYAH</div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Nama Ayah: <span class="tx-danger">*</span></label>
                                <input id="name"
                                    class="form-control @error('nama_ayah') is-invalid
                                @enderror"
                                    name="nama_ayah" value="{{ $student->nama_ayah }}" type="text">
                                @error('nama_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>NIK Ayah: <span class="tx-danger">*</span></label>
                                <input id="lastname" class="form-control @error('nik_ayah') is-invalid @enderror"
                                    name="nik_ayah" type="text" value="{{ old('nik_ayah', $student->nik_ayah) }}">
                                @error('nik_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tanggal Lahir Ayah: <span class="tx-danger">*</span></label>
                                <input id="lastname" class="form-control @error('tahun_ayah') is-invalid @enderror"
                                    name="tahun_ayah" type="date" value="{{ old('tahun_ayah', $student->tahun_ayah) }}">
                                @error('tahun_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Pendidikan Ayah: <span class="tx-danger">*</span></label>
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
                            <div class="form-group col-md-4">
                                <label>Pekerjaan Ayah: <span class="tx-danger">*</span></label>
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
                            <div class="form-group col-md-4">
                                <label>Penghasilan Ayah: <span class="tx-danger">*</span></label>
                                <select class="form-control select2 @error('penghasilan_ayah') is-invalid @enderror"
                                    name="penghasilan_ayah">
                                    <option value="">--Pilih--</option>
                                    @foreach ($penghasilan as $item)
                                        <option value="{{ $item }}"
                                            {{ $item == old('penghasilan_ayah', $student->penghasilan_ayah) ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('penghasilan_ayah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="divider-text">DATA IBU</div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Nama Ibu: <span class="tx-danger">*</span></label>
                                <input id="name"
                                    class="form-control @error('nama_ibu') is-invalid
                                @enderror"
                                    name="nama_ibu" value="{{ old('nama_ibu', $student->nama_ibu) }}" type="text">
                                @error('nama_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>NIK Ibu: <span class="tx-danger">*</span></label>
                                <input id="lastname" class="form-control @error('nik_ibu') is-invalid @enderror"
                                    name="nik_ibu" type="text" value="{{ old('nik_ibu', $student->nik_ibu) }}">
                                @error('nik_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tanggal Lahir Ibu: <span class="tx-danger">*</span></label>
                                <input id="lastname" class="form-control @error('tahun_ibu') is-invalid @enderror"
                                    name="tahun_ibu" type="date" value="{{ old('tahun_ibu', $student->tahun_ibu) }}">
                                @error('tahun_ibu')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Pendidikan ibu: <span class="tx-danger">*</span></label>
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
                            <div class="form-group col-md-4">
                                <label>Pekerjaan ibu: <span class="tx-danger">*</span></label>
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
                            <div class="form-group col-md-4">
                                <label>Penghasilan ibu: <span class="tx-danger">*</span></label>
                                <select class="form-control select2 @error('penghasilan_ibu') is-invalid @enderror"
                                    name="penghasilan_ibu">
                                    <option value="">--Pilih--</option>
                                    @foreach ($penghasilan as $item)
                                        <option value="{{ $item }}"
                                            {{ $item == old('penghasilan_ibu', $student->penghasilan_ibu) ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('penghasilan_ibu')
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
            <div class="card-footer">

            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header bg-secondary tx-white">ALAMAT DOMISILI</div>
            <div class="card-body">
                <form action="{{ route('updatealamat', $student->uuid) }}" method="post">
                    @csrf
                    <div class="form-row mb-1">
                        <div class="form-group col-md-6">
                            <label>Alamat Rumah<span class="tx-danger">*</span></label>
                            <input
                                class="form-control @error('alamat_pd')
                                    is-invalid
                                @enderror"
                                name="alamat_pd" value="{{ old('alamat_pd', $student->alamat_pd) }}" type="text">
                            @error('alamat_pd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>Jarak Rumah Ke Sekolah<span class="tx-danger">*</span></label>
                            <input
                                class="form-control @error('jarak')
                                    is-invalid
                                @enderror"
                                name="jarak" value="{{ old('jarak', $student->jarak) }}" type="text">
                            @error('jarak')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>Waktu Tempuh<span class="tx-danger">*</span></label>
                            <input
                                class="form-control @error('waktu')
                                    is-invalid
                                @enderror"
                                name="waktu" value="{{ old('waktu', $student->waktu) }}" type="text">
                            @error('waktu')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-6">
                            <label>Provinsi<span class="tx-danger">*</span></label>
                            <input
                                class="form-control @error('provinsi_pd')
                                    is-invalid
                                @enderror"
                                name="provinsi_pd" value="{{ old('provinsi_pd', $student->provinsi_pd) }}"
                                type="text">
                            @error('provinsi_pd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kabupaten / Kota<span class="tx-danger">*</span></label>
                            <input
                                class="form-control @error('kota_pd')
                                    is-invalid
                                @enderror"
                                name="kota_pd" value="{{ old('kota_pd', $student->kota_pd) }}" type="text">
                            @error('kota_pd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-6">
                            <label>Kecamatan<span class="tx-danger">*</span></label>
                            <input
                                class="form-control @error('kec_pd')
                                    is-invalid
                                @enderror"
                                name="kec_pd" value="{{ old('kec_pd', $student->kec_pd) }}" type="text">
                            @error('kec_pd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Desa<span class="tx-danger">*</span></label>
                            <input
                                class="form-control @error('desa_pd')
                                    is-invalid
                                @enderror"
                                name="desa_pd" value="{{ old('desa_pd', $student->desa_pd) }}" type="text">
                            @error('desa_pd')
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
    @endsection
    @section('script')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    theme: "bootstrap",
                });
            });
        </script>
    @endsection
