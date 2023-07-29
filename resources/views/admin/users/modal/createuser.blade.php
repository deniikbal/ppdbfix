<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="image-upload" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" id="name" class="form-control"
                                   placeholder="Nama Lengkap" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid
                            @enderror" placeholder="Email" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Role</label>
                        <div class="col-sm-8">
                            <select name="role" id="role" class="form-control select2">
                                <option value="">--Pilih--</option>
                                <option value="Admin" {{old('role')=="Admin" ? 'selected' :
                                ''}}>Admin</option>
                                <option value="Student" {{old('role')=="Student" ? 'selected' :
                                ''}}>Student</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">No Handphone</label>
                        <div class="col-sm-8">
                            <input type="text" name="no_handphone" id="no_handphone" class="form-control @error('no_handphone')
                            is-invalid @enderror"
                                   placeholder="No Handphone" value="{{old('no_handphone')}}">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" id="password" class="form-control @error('password')
                            is-invalid
                            @enderror"
                                   placeholder="Password" value="{{old('password')}}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="formSubmit">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
    <script>
        $(document).ready(function(){
            $('#formSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {

                        'X-CSRF-TOKEN': '{{csrf_token()}}',
                    }
                });
                $.ajax({
                    url: "{{ url('/createusers') }}",
                    method: 'post',
                    data: {
                        name: $('#name').val(),
                        email:$('#email').val(),
                        role:$('#role').val(),
                        no_handphone:$('#no_handphone').val(),
                        password:$('#password').val(),
                    },
                    success: function(result){
                        if(result.errors)
                        {
                            $('.alert-danger').html('');
                            $.each(result.errors, function(key, value){
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>'+value+'</li>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').hide();
                            $(".modal-body input").val("")
                            $('#exampleModal').modal('hide');
                            toastr.success('{{ session('success') }}', 'User Baru Berhasil dibuat');
                            window.location.reload();
                        }
                    }
                });
            });
        });
    </script>

@endsection
