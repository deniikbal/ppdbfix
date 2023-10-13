<div class="modal fade" id="addschool" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH SEKOLAH</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="image-upload" method="post" action="{{ route('student.store') }}"
                enctype="multipart/form-data" id="locations">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">Nama Sekolah</label>
                            <input type="text" name="sekolah" id="sekolah" class="form-control"
                                placeholder="Nama Sekolah SMP/MTs" value="{{ old('sekolah') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">NPSN</label>
                            <input type="text" name="npsn" id="npsn"
                                class="form-control @error('npsn') is-invalid @enderror" placeholder="NPSN"
                                value="{{ old('npsn') }}">

                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="provinces_id">Provinsi Domisili</label>
                            <select name="provinces_id" id="provinces_id" class="form-control select2"
                                v-model="provinces_id" v-if="provinces">
                                <option v-for="province in provinces" :value="province.id">@{{ province.name }}
                                </option>
                            </select>
                            <select v-else class="form-control">--Pilih--</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="regencies_id">Kota/Kabupaten Domisili</label>
                            <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id"
                                v-if="regencies">
                                <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}
                                </option>
                            </select>
                            <select v-else class="form-control"></select>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="districts_id">Kecamatan Domisili</label>
                            <select name="districts_id" id="districts_id" class="form-control" v-model="districts_id"
                                v-if="districts">
                                <option v-for="district in districts" :value="district.id">@{{ district.name }}
                                </option>
                            </select>
                            <select v-else class="form-control"></select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Status</label>
                            <select name="status" id="status" class="form-control select2">
                                <option value="">--Pilih--</option>
                                <option value="N" {{ old('status') == 'N' ? 'selected' : '' }}>
                                    Negeri
                                </option>
                                <option value="S" {{ old('status') == 'S' ? 'selected' : '' }}>
                                    Swasta
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail3">Bentuk</label>
                            <select name="bentuk" id="bentuk" class="form-control select2">
                                <option value="">--Pilih--</option>
                                <option value="SMP" {{ old('bentuk') == 'SMP' ? 'selected' : '' }}>
                                    SMP
                                </option>
                                <option value="MTs" {{ old('bentuk') == 'MTs' ? 'selected' : '' }}>
                                    MTs
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="formSubmit">Add New School</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: "bootstrap",
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#formSubmit').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {

                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                });
                $.ajax({
                    url: "{{ url('/tambahsekolah') }}",
                    method: 'post',
                    data: {
                        sekolah: $('#sekolah').val(),
                        npsn: $('#npsn').val(),
                        provinces_id: $('#provinces_id').val(),
                        regencies_id: $('#regencies_id').val(),
                        districts_id: $('#districts_id').val(),
                        status: $('#status').val(),
                        bentuk: $('#bentuk').val(),
                    },
                    success: function(result) {
                        if (result.errors) {
                            $('.alert-danger').html('');
                            $.each(result.errors, function(key, value) {
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>' + value + '</li>');
                            });
                        } else {
                            $('.alert-danger').hide();
                            toastr.success(
                                '{{ session('success', 'Tambah Sekolah Berhasil') }}');
                            $(".modal-body input").val("")
                            $('#exampleModal').modal('hide');
                            window.location.reload();
                        }
                    }
                });
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
