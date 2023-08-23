@extends('layouts.admin.app')
@section('content')
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                Edit Sekolah
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('schoolupdate', $school->id) }}" id="locations">
                    @method('put')
                    @csrf
                    <div class="form-row mb-1">
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">Nama Sekolah</label>
                            <input type="text" name="sekolah" id="sekolah" class="form-control @error('sekolah')
                            is-invalid @enderror"
                                   placeholder="Nama Sekolah SMP/MTs" value="{{ $school->sekolah }}">
                            @error('sekolah')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">NPSN</label>
                            <input type="text" name="npsn" id="npsn"
                                   class="form-control @error('npsn') is-invalid @enderror" placeholder="NPSN"
                                   value="{{ $school->npsn }}">

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="provinces_id">Provinsi</label>
                            <select name="provinces_id" id="provinces_id" class="form-control @error('provinces_id')
                            is-invalid @enderror
                             select2"
                                    v-model="provinces_id" v-if="provinces">
                                <option v-for="province in provinces" :value="province.id">@{{ province.name }}
                                </option>
                            </select>
                            @error('provinces_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <select v-else class="form-control">--Pilih--</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="regencies_id">Kota/Kabupaten Domisili</label>
                            <select name="regencies_id" id="regencies_id"
                                    class="form-control  @error('regencies_id') is-invalid @enderror"
                                    v-model="regencies_id"
                                    v-if="regencies">
                                <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}
                                </option>
                            </select>
                            @error('regencies_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <select v-else class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="districts_id">Kecamatan Domisili</label>
                            <select name="districts_id" id="districts_id" class="form-control
                            @error('districts_id') is-invalid @enderror" v-model="districts_id"
                                    v-if="districts">
                                <option v-for="district in districts" :value="district.id">@{{ district.name }}
                                </option>
                            </select>
                            @error('districts_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <select v-else class="form-control"></select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Status</label>
                            <select name="status" id="status" class="form-control select2">
                                <option value="">--Pilih--</option>
                                <option value="N" {{ $school->status == 'N' ? 'selected' : '' }}>
                                    Negeri
                                </option>
                                <option value="S" {{ $school->status == 'S' ? 'selected' : '' }}>
                                    Swasta
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Bentuk</label>
                            <select name="bentuk" id="bentuk" class="form-control select2">
                                <option value="">--Pilih--</option>
                                <option value="SMP" {{ $school->bentuk == 'SMP' ? 'selected' : '' }}>
                                    SMP
                                </option>
                                <option value="MTs" {{ $school->bentuk == 'MTs' ? 'selected' : '' }}>
                                    MTs
                                </option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Update</button>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
        @endsection

        @section('script')
            <script>
                $(document).ready(function () {
                    $('.select2').select2({
                        theme: "bootstrap",
                    });
                });
            </script>
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
                                .then(function (response) {
                                    self.provinces = response.data;
                                })
                        },
                        getRegenciesData() {
                            var self = this;
                            axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                                .then(function (response) {
                                    self.regencies = response.data;
                                })
                        },
                        getDistrictsData() {
                            var self = this;
                            axios.get('{{ url('api/districts') }}/' + self.regencies_id)
                                .then(function (response) {
                                    self.districts = response.data;
                                })
                        },

                    },
                    watch: {
                        provinces_id: function (val, oldVal) {
                            this.regencies_id = null;
                            this.getRegenciesData();
                        },
                        regencies_id: function (val, oldVal) {
                            this.districts_id = null;
                            this.getDistrictsData();
                        },
                    }
                });
            </script>
    @endpush