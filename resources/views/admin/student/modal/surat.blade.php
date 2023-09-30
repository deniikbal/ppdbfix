<div class="modal fade" id="nosurat" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah No Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php
                $wa = App\Models\WhatsApp::first();
            @endphp
            <form class="image-upload" method="post" action="{{ route('updatesurat', $wa->id) }}"
                enctype="multipart/form-data" id="locations">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $wa->id }}">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">Nomor Surat {{ $wa->id }}</label>
                            <input type="text" name="no_surat" id="no_surat" class="form-control"
                                placeholder="Nomor Surat" value="{{ old('no_surat', $wa->no_surat) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" id="tanggal_surat"
                                class="form-control @error('tanggal_surat') is-invalid @enderror"
                                placeholder="Nama Ayah" value="{{ old('tanggal_surat', $wa->tanggal_surat) }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="formSubmit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
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
                    url: "{{ url('/updatesurat') }}",
                    method: 'post',
                    data: {
                        no_surat: $('#no_surat').val(),
                        tanggal_surat: $('#tanggal_surat').val(),
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
                            toastr.success('{{ session('success', 'Edit Berhasil') }}');
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
