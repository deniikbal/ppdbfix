<div class="modal fade" id="profilepicture{{$student->id}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DAFTAR SISWA BARU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="image-upload" method="post" action="{{ route('updatefoto', $student->id) }}"
                enctype="multipart/form-data" id="locations">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-12">
                            <label for="inputEmail3">Profile Picture</label>
                            <input type="file" name="foto" class="form-control"
                                placeholder="Pas Foto" value="{{ old('foto') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="formSubmit">Save Foto</button>
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
                    url: "{{ url('/createstudent') }}",
                    method: 'post',
                    data: {
                        name: $('#name').val(),
                        nama_ayah: $('#nama_ayah').val(),
                        jenis_kelamin: $('#jenis_kelamin').val(),
                        provinces_id: $('#provinces_id').val(),
                        regencies_id: $('#regencies_id').val(),
                        districts_id: $('#districts_id').val(),
                        asal_sekolah: $('#asal_sekolah').val(),
                        nohp_siswa: $('#nohp_siswa').val(),
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
                            toastr.success('{{ session('success', 'Pendaftaran Berhasil') }}');
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
