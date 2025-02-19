@extends('layouts.student.main')

@section('title')
    Welcome to Dashboard, {{ auth()->user()->name }}
@endsection

@section('main')
    Dashboard
@endsection

@section('data')
    Daftar Calon Peserta Didik
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-6">
        <div class="card">
            <div class="card-header">
                Daftar Siswa Baru
            </div>
            <div class="card-body">
                <div class="container mt-5" id="locations">
                    <form class="image-upload" method="post" action="{{ route('student.store') }}"
                        enctype="multipart/form-data" id="locations">
                        @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}">
                        @error('name')
                            <div class="text text-danger mt-1">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control" placeholder="Nama Ayah" value="{{ old('nama_ayah') }}">
                            @error('nama_ayah')
                            <div class="text text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">NIK PD</label>
                            <input type="text" name="nik" id="nik" class="form-control"
                                   placeholder="Nomor Induk Kependudukan" value="{{ old('nik') }}">
                                   @error('nik')
                                   <div class="text text-danger mt-1">{{ $message }}</div>
                                   @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">Tanggal Lahir PD</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                   placeholder="" value="{{ old('tanggal_lahir') }}">
                                   @error('tanggal_lahir')
                            <div class="text text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control select2">
                                <option value="">--Pilih--</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="text text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">No Whatsapp Siswa</label>
                            <input type="text" name="nohp_siswa" id="nohp_siswa"
                                class="form-control"
                                placeholder="085722671817" value="{{ old('nohp_siswa') }}">
                            @error('nohp_siswa')
                            <div class="text text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">Asal Sekolah</label>
                            <select class="form-control select2" id="asal_sekolah" name="asal_sekolah">
                                <option value="">---Pilih---</option>
                                @foreach ($schools as $item)
                                    <option
                                        value="{{ $item->id }}"{{ $item->sekolah == old('asal_sekolah') ? 'selected' : '' }}>
                                        {{ $item->sekolah }} || {{ $item->kecamatan }}</option>
                                @endforeach
                            </select>
                            @error('asal_sekolah')
                            <div class="text text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="provinces_id">Provinsi Domisili</label>
                            <select name="provinces_id" id="provinces_id" class="form-control select2"
                                v-model="provinces_id" v-if="provinces">
                                <option v-for="province in provinces" :value="province.id">@{{ province.name }}
                                </option>
                            </select>
                            <select v-else class="form-control">--Pilih--</select>
                            @error('provinces_id')
                            <div class="text text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="regencies_id">Kota/Kabupaten Domisili</label>
                            <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id"
                                v-if="regencies">
                                <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}
                                </option>
                            </select>
                            <select v-else class="form-control"></select>
                            @error('regencies_id')
                            <div class="text text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="districts_id">Kecamatan Domisili</label>
                            <select name="districts_id" id="districts_id" class="form-control" v-model="districts_id"
                                v-if="districts">
                                <option v-for="district in districts" :value="district.id">@{{ district.name }}
                                </option>
                            </select>
                            <select v-else class="form-control"></select>
                            @error('districts_id')
                            <div class="text text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ asset('vendor/vue/vue.js') }}"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var locations = new Vue({
            el: "#locations",
            mounted() {
                this.getProvincesData();
            },
            data: {
                provinces: null,
                regencies: null,
                districts: null,
                provinces_id: null,
                regencies_id: null,
                districts_id: null,
            },
            methods: {
                getProvincesData() {
                    var self = this;
                    axios.get('{{ route('api-provincies') }}')
                        .then(function(response) {
                            self.provinces = response.data;
                        })
                },
                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                        .then(function(response) {
                            self.regencies = response.data;
                        })
                },
                getDistrictsData() {
                    var self = this;
                    axios.get('{{ url('api/districts') }}/' + self.regencies_id)
                        .then(function(response) {
                            self.districts = response.data;
                        })
                },

            },
            watch: {
                provinces_id: function(val, oldVal) {
                    this.regencies_id = null;
                    this.getRegenciesData();
                },
                regencies_id: function(val, oldVal) {
                    this.districts_id = null;
                    this.getDistrictsData();
                },
            }
        });
    </script>
@endpush
